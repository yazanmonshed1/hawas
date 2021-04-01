<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Meta;
use Helper;

class ContactUsController extends Controller
{
    public function index()
    {
        Meta::title('الحواس - تواصل معنا');
        Meta::set('image', asset('storage/' . Helper::setting('meta.contact_us_page_image')));
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone_number = $request->has('phone_number') ? $request->phone_number : null;
        $contact->message = $request->message;
        $contact->save();

        session()->flash('success_message', Helper::setting('admin.success_contact_text'));

        return redirect()->back();
    }
}
