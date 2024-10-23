<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonationRequestRequest;
use App\Models\DonationRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

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

    // Posts 
    public function posts(Request $request)
    {
        $posts = Post::query();
        if ($request->filled('category-id')) {
            $posts->where('category_id', $request->input('category-id'));
        }
        $posts = $posts->paginate(5);
        return view('front.posts', ['posts' => $posts]);
    }
    public function showPost(string $id)
    {
        $post = Post::findOrFail($id);
        return view('front.post', ['post' => $post]);
    }
    public function toggleFavourite(Request $request)
    {

        $request->user()->posts()->toggle($request->input('post_id'));
        return view('front.home');
    }

    //  Donation Requests 
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
        $request = $request->user('web-client')->donationRequests()->create($request->all());

        // 3) redirect to requests page
        return redirect()->back()->with('success', 'تم اضافة طلب التبرع بنجاح');
    }
}
