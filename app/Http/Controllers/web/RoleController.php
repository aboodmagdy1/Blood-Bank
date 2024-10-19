<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Role::paginate(20);
        return view('roles.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate the request
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions_list' => 'required|array'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'permissions_list.required' => 'الصلاحيات مطلوبه',

        ]);

        // store the record
        Role::create([
            'name' => $request->name
        ])->permissions()->attach($request->permissions_list);



        // redirect to the index page
        return redirect()->route('roles.index')->with('success', 'تم اضافه الرتبه  وصلاحياته  بنجاح');
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
        $record = Role::findOrFail($id);
        return view('roles.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions_list' => 'required|array'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'permissions_list.required' => 'الصلاحيات مطلوبه',
        ]);

        // update the record
        $role =  Role::findOrFail($id);
        $role->update([
            'name' => $request->name
        ]);


        if ($request->permissions_list) {
            $role->permissions()->sync($request->permissions_list);
        }



        // redirect to the index page
        return back()->with('success', 'تم تعديل الرتبه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        Role::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('roles.index')->with('success', 'تم حذف الرتبه بنجاح');
    }
}
