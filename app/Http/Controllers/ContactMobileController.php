<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactsMobileRequest;
use App\Http\Resources\ContactMobileResource;
use App\Models\ContactMobile;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Symfony\Component\HttpFoundation\Response;

class ContactMobileController extends Controller
{
    // !get all contacts mobile number
    public function index($contact)
    {
        $numbers = ContactMobileResource::collection(ContactMobile::where('contact_id', $contact)->get());
        if ($numbers->isEmpty()) {
            return response()->json(['message' => 'No numbers found'], Response::HTTP_NOT_FOUND);
        }
        return $numbers;
    }
    // ! get a contacts mobile number by its id
    public function show($contact, $mobile)
    {
        $number = ContactMobileResource::collection(ContactMobile::where('contact_id', $contact)->where('id', $mobile)->get());
        if ($number->isEmpty()) {
            return response()->json(['message' => 'Number not found'], Response::HTTP_NOT_FOUND);
        }
        return $number;
    }
    // ! create new contact mobile number
    public function store($contact, contactsMobileRequest $request)
    {
        $number = ContactMobile::create([
            'number' => $request->number,
            'contact_id' => $contact
        ]);
        return new ContactMobileResource($number, Response::HTTP_CREATED);
    }
    //   ! update existing contact mobile number
    public function update($contact, $mobile, contactsMobileRequest $request)
    {
        ContactMobile::where('id', $mobile)->update([
            'number' => $request->number,
            'contact_id' => $contact
        ]);
        return response(["message " => "Updated Successfull"], Response::HTTP_OK);
    }
    //  ! delete an existing contact mobile number
    public function destroy($contact, $mobile)
    {
        ContactMobile::where('id', $mobile)->delete();
        return response()->json(['message' => 'Deleted Successfull'], 200);
    }
}
