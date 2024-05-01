<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactsMailRequest;
use App\Models\ContactMail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactMailController extends Controller
{
    public function index($contact_id)
    {
        $mails = ContactMail::where('contact_id', $contact_id)->get();
        if ($mails->isEmpty()) {
            return response()->json(['message' => 'No mails found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($mails, Response::HTTP_OK);
    }
    public function show($contact_id, $id)
    {
        $mail = ContactMail::where('contact_id', $contact_id)->where('id', $id)->get();
        if ($mail->isEmpty()) {
            return response()->json(['message' => 'Mail not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($mail, Response::HTTP_OK);
    }

    public function store($contact_id, contactsMailRequest $request)
    {
        $mail = ContactMail::create([
            'contact_id' => $contact_id,
            'mail' => $request->mail
        ]);
        return response(["Data created " => $mail], Response::HTTP_CREATED);
    }
    public function destroy($contact_id, $id)
    {
        ContactMail::where('id', $id)->delete();
        return response()->json(['message' => 'Deleted Successfull'], 200);
    }
    public function update($contact_id, $id, contactsMailRequest $request)
    {
        ContactMail::where('id', $id)->update([
            'mail' => $request->mail,
            'contact_id' => $contact_id
        ]);
        return response(["message " => "Updated Successfull"], Response::HTTP_OK);
    }
}
