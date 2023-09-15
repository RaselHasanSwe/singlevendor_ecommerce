<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index( Request $request )
    {
        $data['contacts']  = Contact::latest()->paginate(20);
        return view('admin.contact.index', $data);
    }

    public function show(Contact $contact)
    {
        return view('admin.contact.view-contact', ['data' => $contact]);
    }
}
