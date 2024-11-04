<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Notifications\DonationRequestNotification;
use App\Http\Requests\DonationRequestRequest;
use App\Models\DonationRequest;
use App\Models\Token;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

use function App\utils\responseJson;

class DonationRequestController extends Controller
{
    public function index(Request $request)
    {


        // 2) get donation requests
        $donationRequests = DonationRequest::where(function ($query) use ($request) {
            if ($request->filled('governorate_id')) {
                $query->whereHas('city', function ($query) use ($request) {
                    $query->where('governorate_id', $request->governorate_id);
                });
            }

            if ($request->filled('blood_type_id')) {
                $query->where('blood_type_id', $request->blood_type_id);
            }
        })->get();

        $count = count($donationRequests);
        return responseJson(1, 'success', [
            'count' => $count,
            'donation_requests' => $donationRequests
        ]);
    }

    public function store(DonationRequestRequest $request)
    {

        // 1) validation 
        $data = $request->validated();

        // 2) create donation request
        $donationRequest = $request->user()->donationRequests()->create($request->all());
        if (!$donationRequest) {
            return responseJson(0, 'Failed to create donation request');
        }

        //3) find suitable clients for this request   
        // query
        $clients = $donationRequest->city->governorate
            ->clients()->whereHas('bloodTypes', (function ($query) use ($request) {
                $query->where('blood_types.id', $request->blood_type_id);
            }))->get();
        $clientsIds = $clients->pluck('id')->toArray();

        // 4) send notification to clients
        if (count($clientsIds) > 0) {
            try {
                DB::beginTransaction();
                // 4.1) create notification
                $notification = $donationRequest->notification()->create(
                    [
                        'title' => 'من فضلك ساعد فى انقاذ حياة احد',
                        'content' =>
                        $donationRequest->patient_name . ' يحتاج '
                            . $donationRequest->bags_num . ' أكياس دم فصيلة ' . $donationRequest->bloodType->name,
                    ]
                );

                // 4.2 attach notification to clients ( determine who will receive this notification )
                $notification->clients()->attach($clientsIds);

                // 4.3 send notification 
                Notification::send($clients, new DonationRequestNotification($notification));
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return responseJson(0, $e->getMessage());
            }
        }

        return responseJson(1, 'Donation request created successfully', $donationRequest);
    }
}
