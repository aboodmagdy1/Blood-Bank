<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Governorate::paginate(20);

        return view('governorates.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'دخل الاسم يلاااااا',
            'name.string' => 'نص مش رقم',
            'name.max' => 'كده طويييييل '
        ]);


        // Create a new governorate
        $governorate = Governorate::create($request->all());

        return redirect()->route('governorate.index')->with('success', 'تم الانشاء بنجاح.');
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
        $record = Governorate::findOrFail($id);
        return view('governorates.edit', ['record' => $record]);
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
        $record = Governorate::findOrFail($id);
        $record->update($request->all());
        return redirect()->route('governorate.index')->with('success', 'تم التعديل بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the governorate
        $record = Governorate::findOrFail($id);

        if ($record->cities()->count() > 0 || $record->clients()->count() > 0) {
            return redirect()->route('governorate.index')->with('error', 'لا يمكن حذف المحافظة لوجود مدن و عملاء مرتبطين بها.');
        }



        // Delete the governorate
        $record->delete();

        return redirect()->route('governorate.index')->with('success', 'تم الحذف بنجاح.');
    }
}
