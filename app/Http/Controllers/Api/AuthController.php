<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditNotificationSettings;
use App\Http\Requests\EditProfile;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function App\utils\responseJson;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // 1) validation in the request
        $validated = $request->validated();

        // 2) create new client
        // $request->merge(['password' => Hash::make($request->password)]);
        $newClient = Client::create($validated);

        // 3) log the client ( create token )
        $newClient->api_token = Str::random(60);
        $newClient->save();


        // 4) set notification settings 
        $newClient->governorates()->attach($request->governorate_id);
        $newClient->bloodTypes()->attach($request->blood_type_id);

        // 5) return response

        return responseJson(1, 'client created successfuly', [
            'api_token' => $newClient->api_token,
            'client' => $newClient
        ]);
    }
    public function login(LoginRequest $request)
    {

        // 1) make validation
        $credentials = $request->validated();


        // 2) check if the client exists
        $client = Client::where('email', $credentials['email'])->first();
        if (!$client) {
            return responseJson(0, 'Invalid credentials');
        }

        // 3) check if the password is correct
        if (!Hash::check($credentials['password'], $client->password)) {
            return responseJson(0, 'Invalid credentials');
        }

        //4) generate token 
        $client->api_token = Str::random(60);
        $client->save();

        // 5) return response
        return responseJson(1, 'logged in successfully', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }

    public function profile(Request $request)
    {
        $client = $request->user();
        return responseJson(1, 'User data', [$client]);
    }
    // edit Profile  
    public function editProfile(ProfileRequest $request)
    {

        // 1) validation
        $validated = $request->validated();

        // 2) update the client data 
        $client = $request->user();
        $client->update($validated); // the password will increpted by the model mutator
        $client->save();


        // 3)  update notification setting 
        if ($request->has('blood_type_id')) {
            $client->bloodTypes()->sync([$request->blood_type_id]);
        }

        if ($request->has('governorate_id')) {
            $client->governorates()->sync([$request->governorate_id]);
        }

        // 4) return response 
        return responseJson(1, 'User updated successfuly ', [$client->fresh()]);
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return responseJson(0, 'you are not logged in');
        }
        $request->user()->api_token = null;
        $request->user()->save();
        return responseJson(1, 'logged out successfully');
    }

    public function forgotPassword(Request $request)
    {
        // 1) validation 
        $rules = ["email" => ['required', 'string', 'email', 'exists:clients,email']];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        // 2) send the reset link email 
        $client = Client::where('email', $request->email)->first();
        $code = rand(111111, 999999);

        $client->reset_code = $code;
        $client->save();

        //3) send the email

        Mail::to($client->email)->send(new ResetPassword($code));


        //4) return response
        return responseJson(1, 'Password reset code sent to your email.');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        // 1) validation 

        // 2) check if the reset code is correct
        $client = Client::where('email', $request->email)->first();
        if ($request->reset_code !== $client->reset_code) {
            return responseJson(0, 'Invalid reset code');
        }


        // 3) update the password 
        $client->password = Hash::make($request->password);
        $client->reset_code = null;
        $client->save();

        // 4) return response
        return responseJson(1, 'Password reset successfully');
    }


    public function getNotificationSettings(Request $request)
    {
        $client = $request->user();
        $notification_settings_text = Setting::first()->get('notification_setting_text');


        return responseJson(1, 'Notification settings', [
            'governorates' => $client->governorates,
            'blood_types' => $client->bloodTypes,
            "notification_text" => $notification_settings_text
        ]);
    }

    public function editNotificationSettings(EditNotificationSettings $request)
    {

        $client = $request->user();
        if ($request->has('blood_types_id')) {
            $client->bloodTypes()->sync($request->blood_types_id);
        }

        if ($request->has('governorates_id')) {
            $client->governorates()->sync($request->governorates_id);
        }

        return responseJson(1, 'Notification settings updated successfully', [
            'governorates' => $client->governorates,
            'blood_types' => $client->bloodTypes
        ]);
    }
}
