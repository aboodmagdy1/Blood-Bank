<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showClientRegisterForm()
    {
        return view('front.auth.register');
    }
    public function clientRegister(RegisterRequest $request)
    {
        $validated = $request->validated();

        // create Client 
        $client = Client::create($validated);
        if (!$client) {
            return redirect()->back()->withErrors($request->errors())->withInput();
        }

        // attach client to governorate and blood type
        $client->governorates()->attach($request->governorate_id);
        $client->bloodTypes()->attach($request->blood_type_id);

        // login the client
        Auth::guard('web-client')->login($client);


        return redirect()->route('home');
    }

    public function showClientLoginForm()
    {
        return view('front.auth.login');
    }
    public function clientLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:clients,email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web-client')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid Credentials'])->withInput();
        }
    }

    public function clientLogout(Request $request)
    {
        Auth::guard('web-client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }


    public function showForgotForm()
    {
        return view('front.auth.forgot');
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email'
        ]);

        // 2) send the reset link email 
        $client = Client::where('email', $request->email)->first();
        $code = rand(111111, 999999);

        $client->reset_code = $code;
        $client->save();

        //3) send the email

        Mail::to($client->email)->send(new ResetPassword($code));

        // 4) return password 
        return redirect()->route('client.forgot')->with('success', 'Password reset code sent to your email.');
    }
}
