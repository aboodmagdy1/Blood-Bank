<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\QueryBuilders\ClientQueryBuilder;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = (new ClientQueryBuilder());//NOTE : Use Filter pattern =>create object by executing number of steps 

        // Apply city filter if selected
        if ($request->filled('city_id')) {
            $query->city($request->city_id);//##:step 1
        }

        // Apply blood type filter if selected
        if ($request->filled('blood_type_id')) {
            $query->bloodType($request->blood_type_id);//##:step 2
        }

        // Get the filtered records
        $records = $query->paginate(20);//##:step 3

        return view('clients.index', compact('records'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //  toggle the active field
        $client = Client::findOrFail($id);
        $client->update(['is_active' => !$client->is_active]);

        // redirect to the index page
        return redirect()->route('client.index')->with('success', 'تم تعديل المستخدم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        Client::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('client.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
