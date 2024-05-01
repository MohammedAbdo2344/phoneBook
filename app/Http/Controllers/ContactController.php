<?php

namespace App\Http\Controllers;

use App\Http\Requests\contactsRequest;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contacts::with(['contractsMail', 'contractsMobile'])->get();
        if (!$contacts) {
            return response()->json([
                'message' => 'Contacts Not found'
            ],  Response::HTTP_NOT_FOUND);
        }
        return response()->json($contacts, Response::HTTP_OK);
    }
    public function show(Contacts $id)
    {
        $contact = Contacts::with(['contractsMail', 'contractsMobile'])->find($id);
        if (!$contact) {
            return response()->json([
                'message' => 'Contact Not found'
            ],  Response::HTTP_NOT_FOUND);
        }
        return response()->json($contact, Response::HTTP_OK);
    }
    public function store(contactsRequest $request)
    {
        $contacts = Contacts::create($request->all());
        return response(["Data created " => $contacts], Response::HTTP_CREATED);
    }
    public function destroy(Contacts $id)
    {
        $id->delete();
        return response()->json(['message' => 'Deleted Successfull'], 200);
    }
    public function update(contactsRequest $request, Contacts $id)
    {
        $id->update($request->all());
        return response(["message " => "Updated Successfull"], Response::HTTP_OK);
    }
}
