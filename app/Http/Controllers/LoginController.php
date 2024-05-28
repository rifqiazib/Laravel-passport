<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    public function index () {
        return view('authentication.index');
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return Redirect::route('login')->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return Redirect::back()->withInput()->with('invalid_account', 'the email and password invalid');
        } else {
            return view('dashboard.index');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        session()->flush();
        return redirect(route('login'));
    }
}
