<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use function App\utils\responseJson;

class PostController extends Controller
{

    /**
     * Display list of filterd posts .
     */
    public function index(Request $request)
    {
        // validation 
        $rules = [
            'category_id' => 'exists:categories,id',
            'query' => 'string'
        ];
        $request->validate($rules);

        $posts = Post::where(function ($qurery) use ($request) {
            if ($request->has('category_id')) {
                $qurery->where('category_id', $request->category_id);
            }
            if ($request->has('query')) {
                $qurery->where('title', 'like', '%' . $request->input('query') . '%')
                    ->orWhere('content', 'like', '%' . $request->input('query') . '%');
            }
        })->get();

        return responseJson(1, 'success', $posts);
    }

    /**
     * display a specific post
     */
    public function show(Request $request, string $id)
    {

        $post = Post::find($id);
        if (!$post) {
            return responseJson(0, 'post with tihs id not found ');
        }
        return responseJson(1, 'success', $post);
    }

    /**
     * Toggle favorites 
     */

    public function toggleFavourite(Request $request)
    {
        //1) validation 
        $rules = [
            'post_id' => 'required|exists:posts,id'
        ];
        $request->validate($rules);

        //2) get the post
        $post = Post::find($request->post_id);
        $client = $request->user();

        // 3) toggle sync 
        $client->posts()->toggle($post->id);

        // 4) return response
        return responseJson(1, 'success', [
            'favourites' => $client->posts()->get()
        ]);
    }
    public function myFavourites(Request $request)
    {

        //  1) get the client
        $client = $request->user();


        // 2) get the favourites
        $favourites = $client->posts()->paginate(10);


        // 3) return response
        return responseJson(1, 'success', $favourites);
    }
}
