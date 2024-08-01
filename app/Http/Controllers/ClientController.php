<?php

namespace App\Http\Controllers;

use App\Mail\ReservationNotifs;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    // ====================== Page accueil client ======================
    public function pageAccueil(){
        $voyages_vip = Voyage::where('date_expiration', '>', now())->where('vip', '=', true)->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyages_au_maroc = Voyage::where('categorie', '=', 'Au Maroc')->where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyages_a_etranger = Voyage::where('categorie', '=', "À l'étranger")->where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyages_haj_oumra = Voyage::where('categorie', '=', 'Haj et oumra')->where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        return view('client.accueil')->with(['voyages_au_maroc'=> $voyages_au_maroc, 'voyages_a_etranger'=>$voyages_a_etranger, 'voyages_haj_oumra'=> $voyages_haj_oumra, 'voyages_vip'=>$voyages_vip]);
    }
    // ==================================================================

    // ======================== Le Login ========================
    public function loginClient(Request $request){
        $request->validate([
            'email'=>'required|email',
            'mot_de_passe'=>'required',
        ],
        [
            'email.required'=>'*Le email est obligatoire.',
            'email.email'=>'*Le champs doit être email.',
            'mot_de_passe.required'=>'*Le mot de passe est obligatoire.',
        ]);

        $client = Client::where('email','=',$request['email'])->first();
        if($client and Hash::check($request['mot_de_passe'], $client->mot_de_passe)){
            $request->session()->put('client_id', $client->id);
            if (session('url')) {
                return redirect($request->session()->get('url'));
            }
            return redirect('/accueil-client');
        }else{
            session()->flash('failed_connexion', 'Email ou Mot de passe est incorrect');
            return redirect()->back()->onlyInput('email', 'mot_de_passe');
        }
        
        // if(Auth::guard('client')->attempt(['email' => $request['email'], 'password' => $request['mot_de_passe']])){
        //     return "Bienvenu sur votre espace :|";
        // }else{
        //     return "Ghalatte";
        // }
    }
    // =================================================================================

    // ======================== Le Logout ========================
    public function logoutClient(){
        if(session()->has('client_id')){
            session()->pull('client_id');
            session()->pull('url');
            return redirect('/connexion/client');
        }
        return redirect()->back();

    }
    // =================================================================================


    // ======================== Retourner la page d'inscription ========================
    public function pageInscription(){
        return view('client.inscription');
    }
    // =================================================================================

    // ======================== Ajouter un nouveau client =============================
    public function ajouterClient(Request $request){
        $validateData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'tel' => 'required|string|max:15',
            'email' => 'required|max:70|unique:responsables,email|unique:agences,email|unique:clients,email|unique:admins,email',
            'mot_de_passe' => 'required|min:2|max:20',
        ],[
            'nom.required' => '*Le nom est obligatoire.',
            'nom.string' => '*Le nom doit être une chaine de caractères.',
            'nom.max' => '*Nom très long',

            'prenom.required' => '*Le prénom est obligatoire.',
            'prenom.string' => '*Le prénom doit être une chaine de caractères.',
            'prenom.max' => '*Prénom très long',

            'tel.required' => '*Le numéro de tél est obligatoire.',
            'tel.max' => '*Numéro de tél très long.',

            'email.required' => "*L'email est obligatoire.",
            'email.max' => "*L'email est très long.",
            'email.unique' => "*L'email est déja existe.",

            'mot_de_passe.required' => "*Le mot de passe est obligatoire.",
            'mot_de_passe.min' => "*Mot de passe très court.",
            'mot_de_passe.max' => "*Mot de passe trés long.",
        ]
        );
        
        if($validateData){
            $new_client = new Client();
            $new_client->nom = $validateData['nom'];
            $new_client->prenom = $validateData['prenom'];
            $new_client->tel = $validateData['tel'];
            $new_client->date_inscription = date('Y-m-d');
            $new_client->email = strtolower($validateData['email']);
            // ===================== Crypter le mot de passe ============================
            $mot_de_passe_hashed = Hash::make($validateData['mot_de_passe']);
            // =================================================
            $new_client->mot_de_passe = $mot_de_passe_hashed;
            $new_client->save();
            $request->session()->put('client_id', $new_client->id);
            if (session('url')) {
                return redirect($request->session()->get('url'));
            }
            return redirect('/accueil-client');
            // session()->flash('inscription_succes', 'Votre compte a bien été créé.');
            // return redirect("/connexion/client");
        }else{
            return redirect()->back()->withErrors($validateData)->withInput();
        }
    }
    // ===================================================================================

    // ======================== Réserver un voyage ========================
    public function reserverVoyage($id_voyage){
        $id_client = session()->get('client_id');
        $agence = Voyage::find($id_voyage)->agence;
        $voyage = Voyage::find($id_voyage);
        $client = Client::find($id_client);
        $deja_reserve = Reservation::all()->where('client_id', '=', $id_client)->where('voyage_id', '=', $id_voyage)->first();
        if($deja_reserve){
            session()->flash('reservation_added', 'Vous avez déja réservé ce voyage.');
            return redirect()->back();
        }else{
            $new_reservation = new Reservation();
            $new_reservation->date_reservation = date("Y-m-d");
            $new_reservation->type = 'client';
            $new_reservation->client_id = $id_client;
            $new_reservation->voyage_id = $id_voyage;
            $new_reservation->save();
            session()->flash('reservation_succes', 'Votre demande a été effectuée avec succès.');
            Mail::to($agence->email)->send(new ReservationNotifs($client, $voyage, ''));
            return redirect()->back();
        }
    }
    // =================================================================================

    // ======================== Les réservations d'un client ========================
    public function reservations(){
        $id_client = session()->get('client_id');
        $client = Client::find($id_client);
        $reservations = $client->reservations;
        // les donnees de client et les infos des voyages réservés
        $voyages = [];
        foreach($reservations as $reservation){
            $voyages = Arr::add($voyages, $reservation->voyage->id, $reservation->voyage);
        }
        return view('client.reservations')->with(['voyages'=>$voyages]);
    }
    // =================================================================================


    public function pageProfil($id){
        $client = Client::find($id);
        return view('client.profil')->with('client', $client);
    }

    public function modifierProfil(Request $request, $id){
        $client = Client::find($id);
        $validateData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'tel' => 'required|string|max:15',
            'email' => 'required|max:30|unique:agences,email',
        ], [
            'nom.required' => '*Le nom est obligatoire.',
            'nom.string' => '*Le nom doit être une chaine de caractères.',
            'nom.max' => '*Nom très long',

            'prenom.required' => '*Le prénom est obligatoire.',
            'prenom.string' => '*Le prénom doit être une chaine de caractères.',
            'prenom.max' => '*Prénom très long',

            'tel.required' => '*Le numéro de tél est obligatoire.',
            'tel.max' => '*Numéro de tél très long.',

            'email.required' => "L'email est obligatoire.",
            'email.max' => "L'email est très long.",
            'email.unique' => "Cet email est déja existe.",

            // 'mot_de_passe.required' => "Le mot de passe est obligatoire.",
            // 'mot_de_passe.min' => "Mot de passe très court.",
            // 'mot_de_passe.max' => "Mot de passe trés long.",
        ]);

        if($validateData){
            $client->nom = $validateData['nom'];
            $client->prenom = $validateData['prenom'];
            $client->tel = $validateData['tel'];
            $client->email = $validateData['email'];
            $client->save();
            session()->flash('modification_succes', 'Vous avez modifier votre compte avec succés.');
            return redirect("/accueil-client");
        }else{
            return redirect()->back()->withErrors($validateData)->withInput();
        }
        // return view('client.profil')->with('client', $client);
    }
}

// $client = Client::find()
// $voyage = Voyage::find($id_voyage);
// $client = $reservation->client;
// foreach($voyages as $voyage){
//     var_dump($voyage->titre);
//     echo "<br>";
// echo "<br>";
// }
// var_dump($voyages);