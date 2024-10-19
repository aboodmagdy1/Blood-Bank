<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Token;
use Illuminate\Http\Request;

use function App\utils\responseJson;

class NotificationController extends Controller
{
    /**
     * Display a listing of Notifications.
     */
    public function myNotification(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(10);
        return responseJson(1, 'success', $notifications);
    }



    /**
     * *
     * Register device token (after login )
     */
    public function registerToken(Request $request)
    {
        // 1) validation 
        $rules = [
            'token' => 'required',
            'platform' => 'required|in:android,ios'
        ];

        $request->validate($rules);

        // 2) delete old token if exists ( prevent duplication )
        Token::where('token', $request->input('token'))->delete();

        // 3) store token
        $token = $request->user()->tokens()->create($request->all());

        return responseJson(1, 'Token registered successfully', $token);
    }

    /**
     * *
     * remove device token (before logout)
     * prevent the dublication of tokens 
     */
    public function removeToken(Request $request)
    {
        // 1) validation 
        $rules = [
            'token' => 'required',
        ];

        $request->validate($rules);

        // 2) delete  token 
        Token::where('token', $request->input('token'))->delete();



        return responseJson(1, 'Token removed successfully',);
    }
}
