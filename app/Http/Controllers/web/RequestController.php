<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DonationRequest::query();

        // Apply city filter if selected
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Apply blood type filter if selected
        if ($request->filled('blood_type_id')) {
            $query->where('blood_type_id', $request->blood_type_id);
        }

        // Get the filtered records
        $records = $query->paginate(20);

        return view('requests.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = DonationRequest::findOrFail($id);

        return view('requests.show', compact('record'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = DonationRequest::findOrFail($id);
        $request->delete();


        return redirect()->route('donation-request.index')->with('success', 'Request deleted successfully');
    }
}
