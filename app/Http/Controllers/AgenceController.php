<?php

namespace App\Http\Controllers;

use App\Mail\ReservationNotifs;
use App\Models\Agence;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AgenceController extends Controller
{

    // ====================== Page accueil client ======================
    public function pageAccueil(){
        $agence = Agence::find(session()->get('agence_id'));
        $voyages = Voyage::all()->where('agence_id', '=', $agence->id);
        $nombre_voyages = $voyages->count();
        $nombre_reservations = 0;
        $nombre_reservations_validees = 0;
        $sum = array(); 
        foreach($voyages as $voyage){
            foreach($voyage->reservations as $reservation){
                    $nombre_reservations += 1;
                    array_push($sum, $reservation->voyage->prix);
                    if($reservation->etat_validation === 1){
                        $nombre_reservations_validees += 1;
                    }
            }
        }
        $chiffre_affaire = array_sum($sum);
        return view('agence.accueil')->with(['nombre_voyages'=> $nombre_voyages, 'nombre_reservations'=> $nombre_reservations, 'nombre_reservations_validees'=> $nombre_reservations_validees,'chiffre_affaire'=>$chiffre_affaire]);
    }
    // ==================================================================

    // ======================== Le Login ========================
    public function loginAgence(Request $request){
        $request->validate([
            'email'=>'required|email',
            'mot_de_passe'=>'required',
        ],
        [
            'email.required'=>'*Le email est obligatoire.',
            'email.email'=>'*Le champs doit être email.',
            'mot_de_passe.required'=>'*Le mot de passe est obligatoire.',
        ]);

        $agence = Agence::where('email','=',$request['email'])->first();
        if($agence and Hash::check($request['mot_de_passe'], $agence->mot_de_passe)){
            $request->session()->put('agence_id', $agence->id);
            return redirect('/accueil-agence');
        }else{
            session()->flash('failed_connexion', 'Email ou Mot de passe est incorrect');
            return redirect()->back()->onlyInput('email', 'mot_de_passe');
        }
        
        // if(Auth::guard('client')->check(['email'=>$request['email'], 'password'=>$request['mot_de_passe']])){
        //     return "Bienvenu sur votre espace :|";
        // }else{
        //     return "Ghalatte";
        // }
    }
    // =================================================================================

    // ======================== Le Logout ========================
    public function logoutAgence(){
        if(session()->has('agence_id')){
            session()->pull('agence_id');
            return redirect('/connexion/agence');
        }
        return redirect()->back();
    }
    // =================================================================================

    
    // ======================== Retourner la page d'inscription ========================
    public function pageInscription(){
        return view('agence.inscription');
    }
    // =================================================================================

    // ======================== Ajouter une nouvelle agence =============================
    public function ajouterAgence(Request $request){
        $validateData = $request->validate([
            'raison_sociale' => 'required|string|max:50',
            'tel' => 'required|string|max:15',
            'ville' => 'required|string|max:50',
            'ice' => 'required|integer|digits_between:14,14|unique:agences,ice',
            'email' => 'required|max:30|unique:responsables,email|unique:agences,email|unique:clients,email|unique:admins,email',
            'mot_de_passe' => 'required|min:2|max:20',
        ],[
            'raison_sociale.required' => '*La raison sociale est obligatoire.',
            'raison_sociale.string' => '*La raison sociale doit être une chaine de caractères.',
            'raison_sociale.max' => '*Raison sociale très long',

            'ville.required' => '*La ville est obligatoire.',
            'ville.string' => '*La ville doit être une chaine de caractères.',
            'ville.max' => '*Ville très long',

            'tel.required' => '*Le numéro de tél est obligatoire.',
            'tel.max' => '*Numéro de tél très long.',
            
            'ice.required' => "*Le numéro d'identification fiscale est obligatoire.",
            'ice.digits_between' => "* Numéro d'identification fiscale doit être composé par 14 chiffre.",

            'email.required' => "L'email est obligatoire.",
            'email.max' => "L'email est très long.",
            'email.unique' => "L'email est déja existe.",

            'mot_de_passe.required' => "Le mot de passe est obligatoire.",
            'mot_de_passe.min' => "Mot de passe très court.",
            'mot_de_passe.max' => "Mot de passe trés long.",
        ]
        );
        
        if($validateData){
            $new_agence = new Agence();
            $new_agence->raison_sociale = $validateData['raison_sociale'];
            $new_agence->ville = $validateData['ville'];
            $new_agence->tel = $validateData['tel'];
            $new_agence->ice = $validateData['ice'];
            $new_agence->date_inscription = date('Y-m-d');
            $new_agence->email = strtolower($validateData['email']);
            // ===================== Crypter le mot de passe ============================
            $mot_de_passe_hashed = Hash::make($validateData['mot_de_passe']);
            // =================================================
            $new_agence->mot_de_passe = $mot_de_passe_hashed;
            $new_agence->save();
            $request->session()->put('agence_id', $new_agence->id);
            return redirect('/accueil-agence');
            // session()->flash('inscription_succes', 'Votre compte de votre agence a bien été créé.');
            // return redirect("/connexion/agence");
        }else{
            return redirect()->back()->withErrors($validateData)->withInput();
        }
    }
    // ===================================================================================

    // =================== Les voyages d'une agence =============================
    public function nosVoyages(){
        $agence = Agence::find(session()->get('agence_id'));
        $nos_voyages = $agence->voyages()->where('type', '=', 'Client')->get();
        
        // dd($nos_voyages);
        return view('agence.nos_voyages')->with(['nos_voyages'=> $nos_voyages]);
    }
    // ==================================================================================

    // =================== Les voyages d'une agence =============================
    public function nosVoyagesBtoB(){
        $agence = Agence::find(session()->get('agence_id'));
        $nos_voyages = $agence->voyages()->where('type', '=', 'Agence')->get();
        
        // dd($nos_voyages);
        return view('agence.nos_voyages_btob')->with(['nos_voyages'=> $nos_voyages]);
    }
    // ==================================================================================

    // =================== Les voyages d'une agence =============================
    public function voyagesBtoB(){
        $agence = Agence::find(session()->get('agence_id'));
        $voyages = Voyage::where('type', '=', 'Agence')->where('agence_id', '!=', $agence->id)->get();
        return view('agence.voyages_btob')->with(['voyages'=> $voyages]);
    }
    // ==================================================================================

    // ================ Page réservations ======================
    public function pageReservations(){
        return view('agence.reservations');
    }
    // ====================================================

    // ================ Page réservations ======================
    public function pageReservationsNonValidees(){
        $agence = Agence::find(session()->get('agence_id'));
        $voyages = $agence->voyages;
        $reservations = array();
        foreach($voyages as $voyage){
            foreach($voyage->reservations as $reservation){
                if($reservation->etat_validation === 0 and $reservation->type === 'client'){  
                    array_push($reservations, $reservation);
                }
            }
        }
        return view('agence.reservation_non_validees')->with('reservations', $reservations);
    }

    public function pageReservationsBtob(){
        $agence = Agence::find(session()->get('agence_id'));
        $voyages = $agence->voyages;
        $reservations = array();
        foreach($voyages as $voyage){
            foreach($voyage->reservations as $reservation){
                if($reservation->etat_validation === 0 and $reservation->type === 'agence'){  
                    array_push($reservations, $reservation);
                }
            }
        }
        
        return view('agence.reservation_btob')->with('reservations', $reservations);
    }

    // ======================== Réserver un voyage ========================
    public function reserverVoyage($id_voyage){
        $id_agence = session()->get('agence_id');
        $agence = Voyage::find($id_voyage)->agence;
        $voyage = Voyage::find($id_voyage);
        $agence = Agence::find($id_agence);
        // dd($agence);
        $deja_reserve = Reservation::all()->where('agence_id', '=', $id_agence)->where('voyage_id', '=', $id_voyage)->first();
        if($deja_reserve){
            session()->flash('reservation_added', 'Vous avez déja réservé ce voyage.');
            return redirect()->back();
        }else{
            $new_reservation = new Reservation();
            $new_reservation->date_reservation = date("Y-m-d");
            $new_reservation->type = 'agence';
            $new_reservation->agence_id = $id_agence;
            $new_reservation->voyage_id = $id_voyage;
            $new_reservation->save();
            session()->flash('reservation_succes', 'Votre demande a été effectuée avec succès.');
            Mail::to($agence->email)->send(new ReservationNotifs('', $voyage, $agence));
            return redirect()->back();
        }
    }
    // =================================================================================


    public function validerReservation($id){
        $reservation = Reservation::find($id);
        $reservation->etat_validation = 1;
        $reservation->save();
        return redirect('/agence/reservations/validées');
    }

    public function validerReservationBtob($id){
        $reservation = Reservation::find($id);
        $reservation->etat_validation = 1;
        $reservation->save();
        return redirect('/agence/reservations/btob/validées');
    }

    public function supprimerReservation($id){
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect('/agence/reservations/nonvalidées');
    }

    public function chiffreAffaire(){
        $agence = Agence::find(session()->get('agence_id'));
        $voyages = Voyage::all()->where('agence_id', '=', $agence->id);
        $prix = array(); 
        foreach($voyages as $voyage){
            foreach($voyage->reservations as $reservation){
                if($reservation->etat_validation === 1){
                    array_push($prix, $reservation->voyage->prix);
                }
            }
        }
        $sum = array_sum($prix);
        return view('agence.chiffre')->with(['chiffre'=>$sum]);
    }


    // ================ Page réservations ======================
    public function pageReservationsValidees(){
        $agence = Agence::find(session()->get('agence_id'));
        $voyages = $agence->voyages;
        $reservations = array();
        foreach($voyages as $voyage){
            foreach($voyage->reservations as $reservation){
                if($reservation->etat_validation === 1 and $reservation->type === 'client'){  
                    array_push($reservations, $reservation);
                }
            }
        }
        return view('agence.reservation_validees')->with('reservations', $reservations);
}

// ================ Page réservations btob ======================
public function pageReservationsValideesBtob(){
    $agence = Agence::find(session()->get('agence_id'));
    $voyages = $agence->voyages;
    $reservations = array();
    foreach($voyages as $voyage){
        foreach($voyage->reservations as $reservation){
            if($reservation->etat_validation === 1 and $reservation->type === 'agence' ){  
                array_push($reservations, $reservation);
            }
        }
    }
    return view('agence.reservation_btob_validees')->with('reservations', $reservations);
}
}
