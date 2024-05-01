<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactsMailRequest;
use App\Http\Resources\ContactMailResource;
use App\Models\ContactMail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactMailController extends Controller
{
    // !get all contacts mail
    public function index($contact)
    {
        $mails = ContactMailResource::collection(ContactMail::where('contact_id', $contact)->get()); 
        if ($mails->isEmpty()) {
            return response()->json(['message' => 'No mails found'], Response::HTTP_NOT_FOUND);
        }
        return $mails;
    }
    //  ! get  one contact mail by id
    public function show($contact, $mail)
    {
        $mail = ContactMailResource::collection(ContactMail::where('contact_id', $contact)->where('id', $mail)->get());
        if ($mail->isEmpty()) {
            return response()->json(['message' => 'Mail not found'], Response::HTTP_NOT_FOUND);
        }
        return $mail;
    }
    // ! create new contact mail
    public function store($contact, contactsMailRequest $request)
    {
        $mail = ContactMail::create([
            'contact_id' => $contact,
            'mail' => $request->mail
        ]);
        return new ContactMailResource( $mail, Response::HTTP_CREATED);
    }
    // ! update contact mail
    public function update($contact, $mail, contactsMailRequest $request)
    {
        ContactMail::where('id', $mail)->update([
            'mail' => $request->mail,
            'contact_id' => $contact
        ]);
        return response(["message " => "Updated Successfull"], Response::HTTP_OK);
    }
    // ! delete contact mail
    public function destroy($contact, $mail)
    {
        ContactMail::where('id', $mail)->delete();
        return response()->json(['message' => 'Deleted Successfull'], 200);
    }
}
