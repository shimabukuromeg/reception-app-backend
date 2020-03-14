<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use JWTAuth;
use Illuminate\Auth;

class AuthController extends Controller
{
    /***
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('api', ['except' => ['login']]);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->publishToken($request);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        return $this->publishToken($request);
    }

    /***
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function publishToken($request) {
        $token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password]);
        return $this->respondWithToken($token);
    }

    /***
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'current_user' => \Auth::user(),
        ]);
    }
}
