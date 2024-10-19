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
        return view('permissions.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate the request
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'display_name' => 'required|string|unique:permissions,display_name'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'display_name.required' => 'اسم العرض مطلوب',
            'display_name.unique' => 'اسم العرض موجود بالفعل',

        ]);

        // store the record
        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        // redirect to the index page
        return redirect()->route('permissions.index')->with('success', 'تم اضافه الصلاحيه   بنجاح');
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
        return view('permissions.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // validate the request
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
            'display_name' => 'required|string|unique:permissions,display_name,' . $id
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'display_name.required' => 'اسم العرض مطلوب',
            'display_name.unique' => 'اسم العرض موجود بالفعل',

        ]);

        // update the record
        Permission::findOrFail($id)->update($request->all());

        // redirect to the index page
        return back()->with('success', 'تم تعديل الصلاحيه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        Permission::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('permissions.index')->with('success', 'تم حذف الصلاحيه بنجاح');
    }
}
