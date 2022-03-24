<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        // dentro istanza classe ContactEmail posso passare come argomento newContact
        // (ho il costruttore nella classe ContactEmail)
        Mail::to("esempio@sito.com")->send(new ContactEmail($newContact));
           // ritorno un json
        return response()->json($newContact);
    }
}
