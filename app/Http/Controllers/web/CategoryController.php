<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Category::paginate(20);

        return view('categories.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'اسم الفئه مطلوب',

        ]);

        // store the record
        Category::create($request->all());

        // redirect to the index page
        return redirect()->route('category.index')->with('success', 'تم اضافه الفئة بنجاح');
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
        $record = Category::findOrFail($id);
        return view('categories.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'اسم المدينه مطلوب',
        ]);

        // update the record
        Category::findOrFail($id)->update($request->all());

        // redirect to the index page
        return redirect()->route('category.index')->with('success', 'تم تعديل الفئة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        Category::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('category.index')->with('success', 'تم حذف الفئة بنجاح');
    }
}
