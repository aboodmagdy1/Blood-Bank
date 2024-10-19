<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use Illuminate\Http\Request;

class BloodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = BloodType::paginate(20);

        return view('bloodTypes.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bloodTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:20',
        ], [
            'name.required' => 'دخل الاسم يلاااااا',
            'name.string' => 'نص مش رقم',
            'name.max' => 'كده طويييييل '
        ]);


        // Create a new governorate
        $governorate = BloodType::create($request->all());

        return redirect()->route('blood-type.index')->with('success', 'تم الانشاء بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the governorate
        $record = BloodType::findOrFail($id);
        return view('bloodTypes.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validation 
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'دخل الاسم يلاااااا',
            'name.string' => 'نص مش رقم',
            'name.max' => 'كده طويييييل '
        ]);

        // update record 
        $record = BloodType::findOrFail($id);
        $record->update($request->all());
        return redirect()->route('blood-type.index')->with('success', 'تم التعديل بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the governorate
        $record = BloodType::findOrFail($id);

        // Delete the governorate
        $record->delete();

        return redirect()->route('blood-type.index')->with('success', 'تم الحذف بنجاح.');
    }
}
