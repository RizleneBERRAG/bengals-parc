<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessage;
use App\Models\ContactMessage;
use App\Models\Review;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact', [
            'objets' => ContactMessage::OBJETS,
            'points' => config('bengal.carte'),
            'avis'   => Review::publies()->get(),
        ]);
    }

    public function store(StoreContactMessage $request)
    {
        $message = ContactMessage::create($request->safe()->except('rgpd', 'site'));

        // TODO brancher la notification a l'elevage une fois le SMTP configure.

        return redirect()
            ->route('contact')
            ->with('succes', "Merci {$message->prenom}, votre message est bien arrivé. Nous vous répondons sous 48 heures.")
            ->withFragment('formulaire');
    }
}
