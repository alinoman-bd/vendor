<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\AuthValidation;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\InvitationCode;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\RegisterService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class AuthController extends ApiController
{
    private $registerService;
    public $successStatus = 200;
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function login(AuthValidation $request)
    {
        if ($this->checkIfLoggedin($request->email)) {
            return $this->sendError([], 'You already loged in by different browser. Please logout first', 401);
        }
        $http = new \GuzzleHttp\Client;
        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                ],
            ]);
            $result = json_decode($response->getBody(), true);
            return  $this->sendResponse($result);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() == 400) {
                $message = 'Invalid Request, Please enter email and password';
            } else if ($e->getCode() == 401) {
                $message = 'Invalid Credintials, Please try again';
            } else {
                $message = 'Sorry, something went wrong, try again later';
            }
            return $this->sendError([], $message, $e->getCode());
        }
    }
    public function register(RegisterRequest $request)
    {
        $input = $request->all();

        $url = $this->registerService->register($request);

        $success = [
            'verification_url' => $url,
            'login_url' => route('api.login'),
        ];
        return $this->sendResponse($success, 201);
    }

    public function show($user)
    {
        if ($user == 0) {
            if (!Auth::user()) {
                return $this->sendError([], 'Unauthenticated! Please login first', 401);
            }else{
                $user = Auth::user();
            }
        }else{
            $user = User::where('id', $user)->first();
        }

        return $this->sendResponse($user);
    }

    public function logoutOnly()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return $this->sendResponse([], 'logged out.');
    }

    public function logoutAll()
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', Auth::user()->id)
            ->update([
                'revoked' => true
            ]);
        return $this->sendResponse([], 'logged out from all devices.');
    }

    public function checkIfLoggedin($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return DB::table('oauth_access_tokens')
                ->where('user_id', $user->id)
                ->where('revoked', 0)
                ->exists();;
        }
        return false;
    }
}