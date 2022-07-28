<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; 
use Mail; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ContactController extends Controller
{
    public function index() { 

        return view('landlord.landing2'); 
    } 
 
    public function save(Request $request) { 
 
         $this->validate($request, [
             'name' => 'required',
             'email' => 'required|email',
             'phone_number' => 'required',
             'message' => 'required',
             'privacy' => 'required'
         ]);
 
         $contact = new Contact;
 
         $contact->name = $request->name;
         $contact->email = $request->email;
         //$contact->subject = $request->subject;
         $contact->phone_number = $request->phone_number;
         $contact->message = $request->message;
 
         $contact->save();

         \Mail::send('emails.contattoMail',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'subject' => "Nuova richiesta di contatto da Radicando",
                 'phone_number' => $request->get('phone_number'),
                 'user_message' => $request->get('message'),
             ), function($message) use ($request)
               {
                  //$message->from('no-reply@radicando.it');
                  $message->to('info@radicando.it');
               });
         //return Redirect::to(URL::previous() . "#contatti");
         return back()->with('success', 'Grazie per averci contattato!');
    }
}
