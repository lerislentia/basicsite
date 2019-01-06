<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Support\MessageBag;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Input;
use Auth;

class AuthController extends Controller{

    // public function show(){
    //     return view('auth/login');
    // }

    public function showReset(){
        $token = 'caca';
        $data = [
            'token' => $token
        ];
        return view('auth/passwords/reset', $data);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('admin');
        }
        $errors = new MessageBag(['password' => ['Email and/or password invalid.']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.

        return Redirect::back()->withErrors($errors)->withInput(Input::except('password')); // redirect back to the login page, using ->withErrors($errors) you send the error created above

        }
        return view('auth/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}