<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use App\Models\Post;
use Illuminate\Http\Request;

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

        $requests = $requests->paginate(5);

        return view('front.requests', ['requests' => $requests]);
    }
    public function showRequest(string $id)
    {
        $request = DonationRequest::findOrFail($id);
        return view('front.request-details', ['request' => $request]);
    }
}
