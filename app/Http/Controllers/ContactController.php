<?php

namespace App\Http\Controllers;

use App\Exceptions\ContactNotFoundException;
use App\Http\Requests\ContactDestroyRequest;
use App\Http\Requests\contactsRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contacts;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    //  !get all contacts
    public function index()
    {
        $contacts = ContactResource::collection(Contacts::with(['contractsMail', 'contractsMobile'])->get());
        if (!$contacts) {
            return response()->json([
                'message' => 'Contacts Not found'
            ],  Response::HTTP_NOT_FOUND);
        }
        return $contacts;
    }
    //  !show  one contact by id
    public function show(Contacts $contact)
    {
        $contact = ContactResource::collection(Contacts::with(['contractsMail', 'contractsMobile'])->find($contact));
        if (!$contact) {
            return response()->json([
                'message' => 'Contacts Not found'
            ],  Response::HTTP_NOT_FOUND);
        }
        return $contact;
    }
    // !create new contact
    public function store(contactsRequest $request)
    {
        $contacts = Contacts::create($request->all());
        return new ContactResource($contacts, Response::HTTP_CREATED);
    }
    //   !update existing contact
    public function update(ContactUpdateRequest $request)
    {
        Contacts::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['message' => 'Updated Successfull'], 200);
    }
    // !delete a contact
    public function destroy(ContactDestroyRequest $request)
    {
        Contacts::where('id',$request->id)->delete();
        return response()->json(['message' => 'Deleted Successfull'], 200);
    }
}