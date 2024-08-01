<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VoyageNotifs;

class SectionController extends Controller
{
    // ======================== Retourner la page accueil =============================
    public function pageAccueil(){
        $voyages_vip = Voyage::where('date_expiration', '>', now())->where('vip', '=', true)->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyages_au_maroc = Voyage::where('categorie', '=', 'Au Maroc')->where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyages_a_etranger = Voyage::where('categorie', '=', "À l'étranger")->where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyages_haj_oumra = Voyage::where('categorie', '=', 'Haj et oumra')->where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        return view('sections.accueil')->with(['voyages_au_maroc'=> $voyages_au_maroc, 'voyages_a_etranger'=>$voyages_a_etranger, 'voyages_haj_oumra'=> $voyages_haj_oumra, 'voyages_vip'=>$voyages_vip]);
    }
    // ================================================================================

    // ======================== Retourner la page de contact ========================
    public function pageContact(){
        return view('sections.contact');
    }
    // =================================================================================

    // ======================== Retourner la page à propos ========================
    public function pagePropos(){
        return view('sections.propos');
    }
    // =================================================================================

    // ======================== Retourner la page à propos ========================
    public function notFound(){
        return view('erreurs.404');
    }
    // =================================================================================

    
    
    // public function sendMail(){
    //     $voyages = Voyage::all();
    //     Mail::to('sifeddinehadi10@gmail.com')->send(new VoyageNotifs($voyages));
    //     echo 'yes';
    // }
}
