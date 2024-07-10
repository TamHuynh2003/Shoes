<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;
class ContactController extends Controller
{
    public function index()
    {

        return view('client.contact.index');
    }
    public function contact_handle(Request $request)
    {
        $contact = new Contacts();
        $contact->email = auth('users')->user()->email;
        $contact->description = $request->description;
        $contact->save();
        return redirect()->route('contact');
    }
}
