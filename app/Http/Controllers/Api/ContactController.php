<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // validation
        $data = $request->validate([
            "name" => "nullable|string",
            "email" => "required|email",
            "message" => "required|string"
        ]);
        //  nuova istanza di contact
        $newContact = new Contact();
        // fillo i dati
        $newContact->fill($data);
        // salvo
        $newContact->save();
        // ritorno un json

        return response()->json($newContact);
    }
}
