<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('api', ['except' => ['login']]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request){
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $user = User::create($credentials);
        $token = \Auth::guard('api')->attempt($credentials);
        if ($token === false) {
            return response()->apiError('認証に失敗しました', Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
            'current_user' => $user,
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request){
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $token = \Auth::guard('api')->attempt($credentials);
        if ($token === false) {
            return response()->apiError('ログインに失敗しました', Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60,
            'current_user' => \Auth::guard('api')->user(),
        ], Response::HTTP_CREATED);
    }

}
