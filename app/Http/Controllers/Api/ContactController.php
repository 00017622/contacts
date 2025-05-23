<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index () {
         try {
            $allContacts = Contact::all();
            return response()->json([
                'contacts' => $allContacts,
                'status' => 'success',
            ], 200);
        } catch(\Exception $e) {
            Log::error('Error occured while fetching all contacts -> ' . ' ' . $e->getMessage());
            return response()->json([
                'status' => 'error 500',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(CreateContactRequest $request) {
        try {
            $contact = Contact::create($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'You successfully created a contact',
                'created_contact_data' => $contact,
            ]);
        } catch(\Exception $e) {
            Log::error('Error occured -> ' . ' ' . $e->getMessage());
            return response()->json([
                'status' => 'error 500',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateContactRequest $request, Contact $contact) {
        try {

            $contact->update($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'You successfully updated a contact',
                'updated_contact_data' => $contact->fresh(),
            ]);

        } catch(\Exception $e) {
            Log::error('Error occured while updating contact -> ' . ' ' . $e->getMessage());
            return response()->json([
                'status' => 'error 500',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Contact $contact) {
        try {
            $contact->delete();
              return response()->json([
                'status' => 'success',
                'message' => 'You successfully deleted a contact',
            ]);
        } catch(\Exception $e) {
             Log::error('Error occured while removing contact -> ' . ' ' . $e->getMessage());
           return response()->json([
                'status' => 'error 500',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
