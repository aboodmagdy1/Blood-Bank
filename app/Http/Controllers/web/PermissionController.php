<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Permission::paginate(20);
        return view('permissons.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissons.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate the request
        $request->validate([
            'name' => 'required|string|unique:permissons,name',
            'permissions_list' => 'required|array'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'permissions_list.required' => 'الصلاحيات مطلوبه',

        ]);

        // store the record
        Permission::create([
            'name' => $request->name
        ])->permissions()->attach($request->permissions_list);



        // redirect to the index page
        return redirect()->route('permissons.index')->with('success', 'تم اضافه الرتبه  وصلاحياته  بنجاح');
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
        $record = Permission::findOrFail($id);
        return view('permissons.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions_list' => 'array'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
        ]);

        // update the record
        Permission::findOrFail($id)->update($request->all());

        // redirect to the index page
        return redirect()->route('permissons.index')->with('success', 'تم تعديل الرتبه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        Permission::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('permissons.index')->with('success', 'تم حذف الرتبه بنجاح');
    }
}
