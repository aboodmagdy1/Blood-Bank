<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Apply city filter if selected
        if ($request->filled('email')) {
            $query->where('email', $request->email);
        }

        // Get the filtered records
        $records = $query->paginate(20);

        return view('contacts.index', compact('records'));
    }


    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Contact deleted successfully');
    }
}
