<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequestRequest;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\utils\responseJson;

class MainController extends Controller
{

    //-------------------------------------------- General --------------------------------------------
    public function home(Request $request)
    {
        $posts = Post::take(9)->get();
        $requests = DonationRequest::take(8);
        if ($request->filled('blood-type-id')) {
            $requests->where('blood_type_id', $request->input('blood-type-id'));
        }
        if ($request->filled('city-id')) {
            $requests->where('city_id', $request->input('city-id'));
        }
        $requests = $requests->get();
        return view('front.home', ['posts' => $posts, 'requests' => $requests]);
    }

    public function about()
    {
        return view('front.about');
    }
    public function showContactForm()
    {
        return view('front.contact');
    }

    public function submitContact(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string'
        ];
        $request->validate($rules);

        // create contact 
        Contact::create($request->all());
        return redirect()->back()->with('success', 'تم ارسال الرسالة بنجاح');
    }


    //-------------------------------------------- Posts  --------------------------------------------

    public function listPosts(Request $request)
    {
        $posts = Post::query();
        if ($request->filled('category-id')) {
            $posts->where('category_id', $request->input('category-id'));
        }
        $posts = $posts->paginate(8);
        return view('front.listPosts', ['posts' => $posts]);
    }

    public function showPost(string $id)
    {
        $post = Post::findOrFail($id);
        return view('front.post', ['post' => $post]);
    }
    public function toggleFavourite(Request $request)
    {
        $post = Post::findOrFail($request->input('post_id'));
        $post->is_favourite = !$post->is_favourite;
        $post->save();

        $toggle =  $request->user('web-client')->posts()->toggle($request->input('post_id'));
        return responseJson(1, 'success', $toggle);
    }

    public function myFavourite(Request $request)
    {
        $user = $request->user('web-client');
        $posts = $user->posts()->paginate(5);
        return view('front.myFavourite', ['posts' => $posts]);
    }



    //  ------------------------------------- Donation Requests -------------------------------------
    public function requests(Request $request)
    {
        $requests = DonationRequest::query();
        if ($request->filled('blood-type-id')) {
            $requests->where('blood_type_id', $request->input('blood-type-id'));
        }
        if ($request->filled('city-id')) {
            $requests->where('city_id', $request->input('city-id'));
        }
        $requests->orderBy('created_at', 'desc');
        $requests = $requests->paginate(5);

        return view('front.requests', ['requests' => $requests]);
    }
    public function showRequest(string $id)
    {
        $request = DonationRequest::findOrFail($id);
        return view('front.request-details', ['request' => $request]);
    }

    public function requestCreateForm(Request $request)
    {
        return view('front.request-create');
    }

    public function requestCreateSubmit(Request $request)
    {
        //     // 1) validation 
        $rules = [
            'patient_name' => 'required|string',
            'patient_age' => 'required|integer',
            'patient_phone' => 'required|string',
            'blood_type_id' => 'required|exists:blood_types,id',
            'city_id' => 'required|exists:cities,id',
            'bags_num' => 'required|integer',
            'hospital_name' => 'required|string',
            'hospital_address' => 'required|string',
            'details' => 'nullable|string'
        ];

        $request->validate($rules, [
            'required' => 'هذا الحقل مطلوب'

        ]);
        // 2) store in db
        // 2) create donation request
        $donationRequest = $request->user('web-client')->donationRequests()->create($request->all());

        // 3)notification logic 
        $clientsIds = $donationRequest->city->governorate->clients()->whereHas('bloodTypes', function ($query) use ($request) {
            $query->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();

        if (count($clientsIds) > 0) {
            // 4)attach notification for clients 
            //  4.1) create notification 
            $notification = $donationRequest->notification()->create([
                'title' => '',
                'content' => $donationRequest->patient_name . ' needs ' . $donationRequest->bags_num . 'bags of : ' . $donationRequest->bloodType->name
            ]);

            // 4.2) attach clients to notification 
            $notification->clients()->attach($clientsIds);

            // 4.3) send 
        }

        // 3) redirect to requests page
        return redirect()->back()->with('success', 'تم اضافة طلب التبرع بنجاح');
    }



    // ------------------------------------- Notification Setting -------------------------------------
    public function showNotificationSettingPage()
    {
        return view('front.notification');
    }
    public function updateNotificationSetting(Request $request)
    {
        // validation 
        $request->validate([
            'governorate_list' => 'array',
            'governorate_list.*' => 'exists:governorates,id',
            'type_list' => 'array',
            'type_list.*' => 'exists:blood_types,id'
        ]);
        // update
        $client = $request->user('web-client');
        $client->governorates()->sync($request->input('governorate_list'));
        $client->bloodTypes()->sync($request->input('type_list'));
        $client->save();

        //redirect
        return redirect()->back()->with('success', 'تم تحديث الاعدادات بنجاح');
    }
}
