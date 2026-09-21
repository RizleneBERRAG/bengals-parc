<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessage;
use App\Models\ContactMessage;
use App\Models\Review;
use App\Models\Setting;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact', [
            'objets' => ContactMessage::OBJETS,
            'points' => config('bengal.carte'),
            'avis'   => Review::publies()->get(),
            'itineraire' => self::itineraire(),
        ]);
    }

    /**
     * Le lien d'itineraire. Par defaut il vise la COMMUNE et non l'adresse
     * exacte : la page annonce que l'adresse est communiquee au rendez-vous, et
     * un itineraire porte-a-porte la publierait. Un reglage permet de le
     * remplacer, par exemple par la fiche Google de l'elevage.
     */
    private static function itineraire(): string
    {
        if ($choisi = Setting::get('contact.itineraire')) {
            return $choisi;
        }

        $commune = trim(Setting::get('elevage.ville', "L'Isle d'Abeau").' '
            .Setting::get('elevage.code_postal', '38080').' France');

        return 'https://www.google.com/maps/dir/?api=1&destination='.urlencode($commune);
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
