<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = ['email'=>$request->email, 'password'=>$request->password];

        if ($validator->passes()) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json(['success'=>'Login Succcess.', 'url'=>route('dashboard')]);
            } else {
                return response()->json(['error'=> ['email'=>['The provided credentials do not match our records']]]);
            }
        }
        return response()->json(['error'=>$validator->messages()->get('*')]);
    }
}
