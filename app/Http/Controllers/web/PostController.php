<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Post::paginate(20);

        return view('posts.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        // title and content are translated in the json file
        $request->validate([
            'title' => 'required|array',
            'title.*' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|array',
            'content.*' => 'required|string|max:255',
        ], [
            'title.required' => 'العنوان مطلوب',
            'title.*.required' => 'العنوان مطلوب',
            'category_id' => 'اسم الفئة مطلوب',

            'category_id.exists' => 'اسم الفئة غير موجود',
            'content.required' => 'المحتوي مطلوب',
            'content.ar.required' => 'المحتوي باللغه العربيه مطلوب',
            'content.en.required' => 'المحتوي باللغه الانجليزيه مطلوب',
            'content.max' => 'المحتوي يجب الا يزيد عن 255 حرف',
        ]);

        // store the record
        $post = new Post();
        $post->setTranslations('title', $request->title);
        $post->setTranslations('content', $request->content);
        $post->category_id = $request->category_id;
        $post->save();


        // redirect to the index page
        return redirect()->route('post.index')->with('success', 'تم اضافه المقال بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Post::findOrFail($id);
        return view('posts.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string|max:255',
        ], [
            'name.required' => 'العنوان مطلوب',
            'category_id' => 'اسم الفئة مطلوب',
            'category_id.exists' => 'اسم الفئة غير موجود',
            'content.required' => 'المحتوي مطلوب',
            'content.max' => 'المحتوي يجب الا يزيد عن 255 حرف',
        ]);

        // update the record
        Post::findOrFail($id)->update($request->all());

        // redirect to the index page
        return redirect()->route('post.index')->with('success', 'تم تعديل المقال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        Post::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('post.index')->with('success', 'تم حذف المقال بنجاح');
    }
}
