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
        return redirect()->route('client.reset')->with('success', 'تفقد الايميل الخاص بك ');
    }
    public function showResetForm()
    {
        return view('front.auth.reset');
    }
    public function resetPassword(Request $request)
    {
        // 1) validation 
        $request->validate([
            'email' => 'required|email|exists:clients,email',
            'reset_code' => 'required|numeric',
            'password' => 'required|confirmed'
        ]);
        // 2) check if the reset code is correct
        $client = Client::where('email', $request->email)->first();
        if ($request->reset_code !== $client->reset_code) {
            return redirect()->back()->withErrors(['reset_code' => 'كود خاطئ أو منتهي الصلاحيه']);
        }


        // 3) update the password 
        $client->password = $request->password;
        $client->reset_code = null;
        $client->save();

        // 4) return response
        return redirect()->back()->with('success', 'تم تغير كلمة المرور بنجاح');
    }

    public function showProfile()
    {
        $client = request()->user('web-client');

        return view('front.auth.profile', compact('client'));
    }

    public function profile(Request $request)
    {
        $client = request()->user('web-client');

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'last_donation_date' => 'required',
            'blood_type_id' => 'exists:blood_types,id',
            'password' => 'required|confirmed'
        ]);

        $client->update($request->all());
        $client->bloodTypes()->sync($request->blood_type_id);

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
