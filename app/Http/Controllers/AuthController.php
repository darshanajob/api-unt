<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\PersonalAccessTokenResult;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
    	 if(Auth::attempt($request->only(['email','password']))){
           $user = Auth::user();

           $token = $user->createToken('admin')->accessToken; 

           return [
           	'token' => $token,
           ];
        }
        return response([
            'error' => 'invalied credencials'
            ],Response::HTTP_UNAUTHORIZED);  
    }
    
    public function register(RegisterRequest $request){
        $user = User::create(
            $request->only('name','email')
            + ['password' => Hash::make($request->input('password'))]
        );
        return response($user, Response::HTTP_CREATED);
    }
}
