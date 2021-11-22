<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Entertainment;
use App\RecPayment;
use App\EntPayment;

class PaymentHistoryController extends Controller
{
    public function index()
    {
    	$data['total_rec'] = Resource::where('user_id',auth()->user()->id)->count(); 
        $data['total_ent'] = Entertainment::where('user_id',auth()->user()->id)->count();
        $data['rec_payments'] = RecPayment::with('resource')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        $data['ent_payments'] = EntPayment::with('entertainment')->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        //dd($data['ent_payments']->toArray());
        return view('vendor.payment.payment-history',compact('data'));
    }


    public function downloadPdf($rec_or_ent, $id)
    {
    	if($rec_or_ent == 'ent'){
    		$data = EntPayment::with('entertainment','user')->where('id',$id)->first();
    	}else{
    		$data = RecPayment::with('resource','user')->where('id',$id)->first();
    	}

    	//dd($data->toArray());
    	$mpdf = new \Mpdf\Mpdf();
    	$mpdf->WriteHTML(\View::make('vendor.payment.pdf')->with(['data'=>$data])->render());
    	$mpdf->Output('invoice.pdf', 'd');


    }
}
