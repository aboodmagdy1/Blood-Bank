<?php

namespace App\Http\Controllers;

use App\Imports\CountryImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CountryController extends Controller
{
    public function import()
    {
        return view('countries.import');
    }
    public function importSubmit(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new CountryImport, $file);
        $array = Excel::toCollection(new CountryImport, $file);
        dd($array);
        return back()->withStatus('Countries imported successfully!');
    }
}
