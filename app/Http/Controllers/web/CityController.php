<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = City::paginate(20);

        return view('cities.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
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
            'governorate_id' => 'required|exists:governorates,id',
        ], [
            'name.required' => 'اسم المدينه مطلوب',
            'name.string' => 'اسم المدينه يجب ان يكون نص',
            'name.max' => 'اسم المدينه يجب الا يزيد عن 255 حرف',
            'governorate_id.required' => 'اسم المحافظه مطلوب',
            'governorate_id.exists' => 'اسم المحافظه غير موجود',
        ]);

        // store the record
        City::create($request->all());

        // redirect to the index page
        return redirect()->route('city.index')->with('success', 'تم اضافه المدينه بنجاح');
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
        $record = City::findOrFail($id);
        return view('cities.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'governorate_id' => 'required|exists:governorates,id',
        ], [
            'name.required' => 'اسم المدينه مطلوب',
            'name.string' => 'اسم المدينه يجب ان يكون نص',
            'name.max' => 'اسم المدينه يجب الا يزيد عن 255 حرف',
            'governorate_id.required' => 'اسم المحافظه مطلوب',
            'governorate_id.exists' => 'اسم المحافظه غير موجود',
        ]);

        // update the record
        City::findOrFail($id)->update($request->all());

        // redirect to the index page
        return redirect()->route('city.index')->with('success', 'تم تعديل المدينه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        City::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('city.index')->with('success', 'تم حذف المدينه بنجاح');
    }
}
