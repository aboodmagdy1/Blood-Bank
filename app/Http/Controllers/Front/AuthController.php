<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
