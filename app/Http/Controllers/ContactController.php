<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

use function Termwind\render;

class ContactController extends Controller
{

     public function index() {
        try {
            $allContacts = Contact::all();
            return view('contacts.index', compact('allContacts'));
        } catch(\Exception $e) {
            Log::error('Error occured while fetching all contacts -> ' . ' ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch contacts.');
        }
    }
 
    public function store(CreateContactRequest $request) {
        try {
            Contact::create($request->validated());
            return redirect()->route('contacts.index')->with('success', 'contact created successfully');
        } catch(\Exception $e) {
            Log::error('Error occured -> ' . ' ' . $e->getMessage());
            return redirect()->route('contacts.index')->with('error', 'Error while creating contact');
        }
    }

    public function create() {
        return view('contacts.create');
    }

    public function update(UpdateContactRequest $request, Contact $contact) {
        try {

            $contact->update($request->validated());

            return redirect()->route('contacts.index')->with('success', 'contact updated successfully');

        } catch(\Exception $e) {
            Log::error('Error occured while updating contact -> ' . ' ' . $e->getMessage());
            return redirect()->route('contacts.index')->with('error', 'Error while updating contact');
        }
    }

    public function edit(Contact $contact) {
        try  {

        return view('contacts.update', compact('contact'));

        } catch(\Exception $e) {
             Log::error('Error occured while fetching contact -> ' . ' ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch contact');
        }
    }

    public function destroy(Contact $contact) {
        try {
            $contact->delete();
            return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
        } catch(\Exception $e) {
             Log::error('Error occured while removing contact -> ' . ' ' . $e->getMessage());
            return redirect('contacts.index')->with('success', 'Contact deleted successfully');
        }
    }

}
