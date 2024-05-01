<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactsMobileRequest;
use App\Models\ContactMobile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactMobileController extends Controller
{
    public function index($contact_id)
    {
        $numbers = ContactMobile::where('contact_id', $contact_id)->get();
        if ($numbers->isEmpty()) {
            return response()->json(['message' => 'No numbers found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($numbers, Response::HTTP_OK);
    }

    public function show($contact_id, $id)
    {
        $number = ContactMobile::where('contact_id', $contact_id)->where('id', $id)->get();
        if ($number->isEmpty()) {
            return response()->json(['message' => 'Number not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($number, Response::HTTP_OK);
    }

    public function store($contact_id, contactsMobileRequest $request)
    {
        $number = ContactMobile::create([
            'number' => $request->number,
            'contact_id' => $contact_id
        ]);
        return response(["Data created " => $number], Response::HTTP_CREATED);
    }

    public function update($contact_id, $id, contactsMobileRequest $request)
    {
        ContactMobile::where('id', $id)->update([
            'number' => $request->number,
            'contact_id' => $contact_id
        ]);
        return response(["message " => "Updated Successfull"], Response::HTTP_OK);
    }

    public function destroy($contact_id, $id)
    {
        ContactMobile::where('id', $id)->delete();
        return response()->json(['message' => 'Deleted Successfull'], 200);
    }
}
