<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = Setting::first();


        return view('settings.index', compact('record'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Setting::findOrFail($id);
        return view('settings.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Setting::findOrFail($id);
        $record->update($request->all());
        return redirect(route('setting.index'));
    }
}
