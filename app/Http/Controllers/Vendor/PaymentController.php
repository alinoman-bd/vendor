<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resource;
use App\Entertainment;
use App\Package;
use Session;
use App\Paysera\WebToPay;
use App\EntPayment;
use App\RecPayment;

class PaymentController extends Controller
{
    public function index(Request $request, $rec_or_ent = null, $id = null)
    {
        if(empty($rec_or_ent) && empty($id)){
            return redirect(route('vendors.all'));
        }
    	$model = 'App\Resource';
    	if($rec_or_ent == 'ent'){
    		$model = 'App\Entertainment';
    	}
        $model::findOrFail($id);
    	$data['item'] = $model::where('id',$id)->first();
        if($data['item']->end_date){
            $current_date = date('Y-m-d H:i:s');
            if(strtotime($data['item']->end_date) > strtotime($current_date)){
                return redirect(route('profile',['id'=>auth()->user()->id]));
            }
        }

    	$data['pkgs'] = Package::all();
    	$data['payment_info'] = Package::where('id',1)->first();
    	$data['rec_or_ent'] = $rec_or_ent;
    	$data['id'] = $id;
        $data['done'] = $request->done;
    	return view('vendor.payment.payment',$data);
    }
    public function getPackage(Request $request)
    {
    	$data['payment_info'] = Package::where('id',$request->id)->first();
    	$amount_duration = view('vendor.payment.amount-duration',$data)->render();
    	$description = view('vendor.payment.description',$data)->render();
    	return response()->json(['amount_duration'=>$amount_duration, 'description'=>$description]);
    }

    public function goToPayment(Request $request)
    {
    	$payment_info['id'] = $request->id;
    	$payment_info['rec_or_ent'] = $request->rec_or_ent;
    	$payment_info['pkg_id'] = $request->pkg_id;
    	$payment_info['order_id'] = uniqid();
    	Session::put('payment_info',$payment_info);
    	$pkg = Package::where('id',$request->pkg_id)->first();
    	$url = $this->payseraUrl($pkg->price, $payment_info['order_id']);
    	return redirect($url);

    }
    public function payseraAccept()
    {
        if(!Session::has('payment_info')){
        	return redirect(route('vendors.all'));
        }
    	$payment_info = Session::get('payment_info');
    	if($payment_info['rec_or_ent'] == 'ent'){
    		$item = Entertainment::find($payment_info['id']);
    	}else{
    		$item = Resource::find($payment_info['id']);
    	}
    	$item->end_date = date('Y-m-d H:i:s', strtotime('+1 years'));
        $item->package_id = $payment_info['pkg_id'];
    	$item->save();
    	$this->savePaymentHistory();
    	Session::forget('payment_info');
    	return redirect(route('payment.history.index'));
    }

    public function savePaymentHistory()
    {
    	$payment_info = Session::get('payment_info');
    	if($payment_info['rec_or_ent'] == 'ent'){
    		$history = new EntPayment;
    		$history->entertainment_id = $payment_info['id'];
    	}else{
    		$history = new RecPayment;
    		$history->resource_id = $payment_info['id'];
    	}
    	$pkg = Package::where('id',$payment_info['pkg_id'])->first();
    	$history->package_id = $payment_info['pkg_id'];
    	$history->user_id = auth()->user()->id;
    	$history->price = $pkg->price;
    	$history->package_name = $pkg->name;
    	$history->duration = $pkg->duration;
    	$history->start_date = date('Y-m-d H:i:s');
    	$history->end_date = date('Y-m-d H:i:s', strtotime('+1 years'));
    	$history->payment_method = 'Paysera';
    	$history->order_id = $payment_info['order_id'];
    	$history->save();
    }
    public function payseraCancel()
    {
    	Session::forget('payment_info');
        return redirect(route('vendors.all'));
    }
    public function payseraUrl($totalAmount, $order_id)
    {
        try {
            $self_url = $this->get_self_url();
            $paysera_ammount = $totalAmount * 100;
            $request = WebToPay::redirectToPayment(array(
                'projectid'     => 130442,
                'sign_password' => '873a420964dbfac72c5b49ce65cb1991',
                'orderid'       => $order_id,
                'amount'        => $paysera_ammount,
                'currency'      => 'EUR',
                'country'       => 'LT',
                'accepturl'     => $self_url . 'payment/accepted',
                'cancelurl'     => $self_url . 'payment/cancel',
                'callbackurl'   => $self_url . 'payment/callback',
                'test'          => 0,
            ));
            return $request;
        } catch (WebToPayException $e) {
            // handle exception
        }
    }
    public function get_self_url()
    {
        $s = substr(
            strtolower($_SERVER['SERVER_PROTOCOL']),
            0,
            strpos($_SERVER['SERVER_PROTOCOL'], '/')
        );

        if (!empty($_SERVER["HTTPS"])) {
            $s .= ($_SERVER["HTTPS"] == "on") ? "s" : "";
        }

        $s .= '://' . $_SERVER['HTTP_HOST'];

        if (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80') {
            $s .= ':' . $_SERVER['SERVER_PORT'];
        }

        $s .= dirname($_SERVER['SCRIPT_NAME']);

        return $s;
    }
    public function payseraCallback()
    {
        try {
            $response = WebToPay::checkResponse($_GET, array(
                'projectid'     => 130442,
                'sign_password' => '873a420964dbfac72c5b49ce65cb1991',
            ));
            if ($response['test'] !== '0') {
                throw new Exception('Testing, real payment was not made');
            }
            if ($response['type'] !== 'macro') {
                throw new Exception('Only macro payment callbacks are accepted');
            }

            $orderId = $response['orderid'];
            $amount = $response['amount'];
            $currency = $response['currency'];

            echo 'OK';
        } catch (Exception $e) {
            echo get_class($e) . ': ' . $e->getMessage();
        }
    }
}
