<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){
        //ricevo i dati dal client
        $data = $request->all();
        //verifico la validità dei dati
        $validator = Validator::make($data,[
            'name'=> 'required|min:2|max:255',
            'email'=> 'required|min:2|max:255',
            'message'=> 'required|min:2',
        ],
        [
            'name.required' => 'il nome è un campo obbligatorio',
            'name.min' => 'il nome deve avere :min caratteri',
            'name.max' => 'il nome deve avere :max caratteri',
            'email.required' => 'il email è un campo obbligatorio',
            'email.min' => 'il email deve avere :min caratteri',
            'email.max' => 'il email deve avere :max caratteri',
            'message.required' => 'il message è un campo obbligatorio',
            'message.min' => 'il message deve avere :min caratteri',

        ]
    );

    // se i dati non sono validi restituisco  success = false e i messaggi di errore
    if($validator->fails()){
        $success = false;
        $errors = $validator->errors();
        return response()->json(compact('success','errors'));
    }
    //se non ci sono errori salvo il dato nel database

    //salvo i dati nel db
    $new_lead =new Lead();
    $new_lead->fill($data);
    $new_lead->save();

    //invio della email prendere lo use della Facades/Mail
    Mail::to('provadinvio@example.com')->send(new NewContact($new_lead));


        $success = true;
        return response()->json(compact('success'));
    }
}
