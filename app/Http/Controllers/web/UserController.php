<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = User::paginate(20);
        return view('users.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('users.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // validate the request
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
            "email" => 'required|email|unique:users,email',
            'roles_list' => 'required|array'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'email.unique' => 'هذا الايميل موجود بالفعل',
            'email.required' => 'الايميل مطلوب',
            'password.required' => 'كلمه المرور مطلوبه',
            'password.confirmed' => 'كلمه المرور غير متطابقه',
            'roles_list.required' => 'الرتب مطلوبه',

        ]);

        // store the record
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ])->roles()->attach($request->roles_list);



        // redirect to the index page
        return redirect()->route('users.index')->with('success', 'تم اضافه  المستخدم  وصلاحياته  بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $record = User::findOrFail($id);

        return view('users.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = User::findOrFail($id);
        return view('users.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // validate the request
        $request->validate([
            'name' => 'required|string',
            'password' => 'confirmed',
            "email" => 'required|email|unique:users,email,' . $id,
            'roles_list' => 'required|array'
        ], [
            'name.required' => 'اسم الرتبه مطلوب',
            'email.unique' => 'هذا الايميل موجود بالفعل',
            'email.required' => 'الايميل مطلوب',
            'password.required' => 'كلمه المرور مطلوبه',
            'password.confirmed' => 'كلمه المرور غير متطابقه',
            'roles_list.required' => 'الرتب مطلوبه',

        ]);

        // store the record
        $user = User::findOrFail($id);
        tap($user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]))->roles()->sync($request->roles_list);



        // redirect to the index page
        return back()->with('success', 'تم تعديل  المستخدم  وصلاحياته  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the record
        User::findOrFail($id)->delete();

        // redirect to the index page
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
