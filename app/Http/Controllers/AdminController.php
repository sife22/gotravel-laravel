<?php

namespace App\Http\Controllers;

use App\Mail\VoyageNotifs;
use App\Models\Admin;
use App\Models\Agence;
use App\Models\Client;
use App\Models\Image;
use App\Models\Reservation;
use App\Models\Responsable;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function add()
    {
        // $admin = new Admin();
        // $admin->nom = 'ADMIN';
        // $admin->prenom = 'Admin';
        // $admin->cin = 'AS12222';
        // $admin->tel = '0669084487';
        // $admin->email = 'admin@gmail.com';
        // $admin->mot_de_passe = Hash::make('0000');
        // $admin->save();

        // return 'Compte admin a été créé avec succès';
    }

    // ====================== Page accueil Admin ======================
    public function pageAccueil()
    {
        $nombre_agences = Agence::all()->count();
        $nombre_voyages = Voyage::all()->count();
        $nombre_clients = Client::all()->count();
        $nombre_reservations = Reservation::all()->count();

        // chiffre affaire
        $voyages = Voyage::all();
        $prix = [];
        foreach ($voyages as $voyage) {
            foreach ($voyage->reservations as $reservation) {
                if ($reservation->etat_validation === 1) {
                    array_push($prix, $reservation->voyage->prix);
                }
            }
        }
        $chiffre = array_sum($prix);

        return view('admin.accueil')->with(['nombre_agences' => $nombre_agences, 'nombre_voyages' => $nombre_voyages, 'nombre_clients' => $nombre_clients, 'nombre_reservations' => $nombre_reservations, 'chiffre' => $chiffre]);
    }
    // ==================================================================

    // ====================== Page agences ======================
    public function pageAgences()
    {
        $agences = Agence::all();

        return view('admin.agences.agences')->with(['agences' => $agences]);
    }
    // ==================================================================

    // ====================== find agence ======================
    public function trouverAgence(Request $request)
    {
        $raison_sociale = strtolower($request['raison_sociale']);
        $agence = Agence::whereRaw('LOWER(raison_sociale) = ?', [$raison_sociale])->get();
        $agences = Agence::all();
        if (count($agence) > 0) {
            // return dd($agence);
            return view('admin.agences.agences')->with(['agences' => $agence]);
        } else {
            // dd($agences);
            return view('admin.agences.agences')->with(['agences' => $agences]);
        }
    }
    // ==================================================================

    // ====================== find voyage ======================
    public function trouverVoyage(Request $request)
    {
        $titre = strtolower($request['titre']);
        $voyage = Voyage::whereRaw('LOWER(titre) = ?', [$titre])->get();
        $voyages = Voyage::all();
        if (count($voyage) > 0 and $voyage[0]->type === 'Client') {
            return view('admin.voyages.voyages')->with(['voyages' => $voyage]);
        } elseif (count($voyage) > 0 and $voyage[0]->type === 'Agence') {
            return view('admin.voyages.voyages_btob')->with(['voyages' => $voyage]);
        } else {
            return view('admin.voyages.voyages')->with(['voyages' => $voyages]);
        }
    }
    // ==================================================================

    // ====================== find client ======================
    public function trouverClient(Request $request)
    {
        $nom = strtolower($request['nom']);
        $client = Client::whereRaw('LOWER(nom) = ?', [$nom])->get();
        $clients = Client::all();
        if (count($client) > 0) {
            return view('admin.clients.clients')->with(['clients' => $client]);
        } else {
            // dd($agences);
            return view('admin.clients.clients')->with(['clients' => $clients]);
        }
    }
    // ==================================================================

    // ====================== Page voyages ======================
    public function pageVoyages()
    {
        $voyages = Voyage::all()->where('type', '=', 'Client');

        return view('admin.voyages.voyages')->with(['voyages' => $voyages]);
    }

    public function pageVoyagesBtob()
    {
        $voyages = Voyage::all()->where('type', '=', 'Agence');

        return view('admin.voyages.voyages_btob')->with(['voyages' => $voyages]);
    }
    // ==================================================================

    // ====================== Page clients ======================
    public function pageClients()
    {
        $clients = Client::all();

        return view('admin.clients.clients')->with(['clients' => $clients]);
    }
    // ==================================================================

    // ====================== Page responsables ======================
    public function pageResponsables()
    {
        $responsables = Responsable::all();

        return view('admin.responsables.responsables')->with(['responsables' => $responsables]);
    }
    // ==================================================================

    // ======================== Le Login ========================
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ],
            [
                'email.required' => '*Le email est obligatoire.',
                'email.email' => '*Le champs doit être email.',
                'mot_de_passe.required' => '*Le mot de passe est obligatoire.',
            ]);

        $admin = Admin::where('email', '=', $request['email'])->first();
        if ($admin and Hash::check($request['mot_de_passe'], $admin->mot_de_passe)) {
            $request->session()->put('admin_id', $admin->id);
            if (session('url')) {
                return redirect($request->session()->get('url'));
            }

            // return redirect('/accueil-admin');
            return redirect('/accueil-admin');
        } else {
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
    public function logoutAdmin()
    {
        if (session()->has('admin_id')) {
            session()->pull('admin_id');
            session()->pull('url');

            return redirect('/connexion/admin');
        }

        return redirect()->back();
    }
    // =================================================================================

    // ================================== AGENCES =================================================

    public function pageAjouterAgence()
    {
        return view('admin.agences.ajouter_agence');
    }

    public function adminAjouterAgence(Request $request)
    {
        $validateData = $request->validate([
            'raison_sociale' => 'required|string|max:50',
            'tel' => 'required|string|max:15',
            'ville' => 'required|string|max:50',
            'ice' => 'required|integer|digits_between:14,14',
            'email' => 'required|max:30',
            'mot_de_passe' => 'required|min:2|max:20',
        ], [
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

            'mot_de_passe.required' => 'Le mot de passe est obligatoire.',
            'mot_de_passe.min' => 'Mot de passe très court.',
            'mot_de_passe.max' => 'Mot de passe trés long.',
        ]
        );

        if ($validateData) {
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
            session()->flash('ajoute_agence_succes', "Vous avez ajouté l'agence ".$validateData['raison_sociale'].' avec succés');

            return redirect('/accueil-admin/agences');
        } else {
            return redirect()->back()->withErrors($validateData)->withInput();
        }
    }

    public function pageModifierAgence($id)
    {
        $agence = Agence::find($id);

        return view('admin.agences.modifier_agence')->with(['agence' => $agence]);
    }

    public function adminModifierAgence(Request $request, $id)
    {
        $validateData = $request->validate([
            'raison_sociale' => 'required|string|max:50',
            'tel' => 'required|string|max:15',
            'ville' => 'required|string|max:50',
            'ice' => 'required|integer|digits_between:14,14',
            'email' => 'required|max:30|unique:responsables,email|unique:clients,email',
            // 'mot_de_passe' => 'required|min:2|max:20',
        ], [
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

            // 'mot_de_passe.required' => "Le mot de passe est obligatoire.",
            // 'mot_de_passe.min' => "Mot de passe très court.",
            // 'mot_de_passe.max' => "Mot de passe trés long.",
        ]
        );

        if ($validateData) {
            $agence = Agence::find($id);
            $agence->raison_sociale = $validateData['raison_sociale'];
            $agence->ville = $validateData['ville'];
            $agence->tel = $validateData['tel'];
            $agence->ice = $validateData['ice'];
            $agence->date_inscription = date('Y-m-d');
            $agence->email = $validateData['email'];
            // ===================== Crypter le mot de passe ============================
            // $mot_de_passe_hashed = Hash::make($validateData['mot_de_passe']);
            // =================================================
            $agence->mot_de_passe = $agence->mot_de_passe;
            $agence->save();
            session()->flash('modifier_agence_succes', 'Votre avez modifier les données de '.$agence->raison_sociale.' avec succés.');

            return redirect('/accueil-admin/agences');
        } else {
            return redirect()->back()->withErrors($validateData)->withInput();
        }
    }

    public function supprimerAgence($id)
    {
        $agence = Agence::find($id);
        // $agence->voyages->delete();
        foreach ($agence->voyages as $voyage) {
            foreach ($voyage->reservations as $reservation) {
                $reservation->delete();
            }
            foreach ($voyage->images as $image) {
                File::delete(public_path('/images/voyages/'.$image->url));
                $image->delete();
            }
            $voyage->delete();
        }
        $agence->delete();
        session()->flash('supprimer_agence_succes', "Vous avez supprimé l'agence ".$agence->raison_sociale.' avec succés');

        return redirect('/accueil-admin/agences');
    }

    // ===================================================================================

    // ==================================== Voyages ========================================
    public function pageAjouterVoyage()
    {
        $agences = Agence::all();

        return view('admin.voyages.ajouter_voyage')->with('agences', $agences);
    }

    public function adminAjouterVoyage(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'titre' => 'required|string',
            'desc' => 'required|string|max:50',
            'prix' => 'required',
            'categorie' => 'required',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'date_expiration' => 'required|date',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date|after:date_depart',
            'agence_id' => 'required',
            'images' => 'required',
        ], [
            'titre.required' => '*Le titre est obligatoire.',
            'titre.string' => '*Le titre doit être une chaine de caractéres.',
            'desc.required' => '*La description est obligatoire.',
            'desc.string' => '*La description doit être une chaine de caractéres.',
            'description.max' => '*La description est trés long.',
            'prix.required' => '*Le prix est obligatoire.',
            // 'prix.fload' => '*Le prix doit etre un nombre.',
            'categorie.required' => '*La catégorie est obligatoire.',
            'pays.required' => '*La pays est obligatoire.',
            'ville.required' => '*La ville est obligatoire.',
            'date_expiration.required' => "*La date d'expiration est obligatoire.",
            'date_expiration.' => "*La date d'expiration  doit etre une date.",
            'date_depart.required' => '*La date de départ est obligatoire.',
            'date_depart.date' => '*La date de départ doit etre une date.',
            'date_retour.required' => '*La date de retour est obligatoire.',
            'date_retour.date' => '*La date de retour doit etre une date.',
            'date_retour.after' => '*La date de routeur doit être postérieure à la date de départ.',
            'agence_id.required' => "*L'agence est obligatoire.",
            'images.required' => "*L'image est obligatoire.",
        ]);

        if ($validateData) {
            $new_voyage = new Voyage();
            $new_voyage->titre = $validateData['titre'];
            $new_voyage->desc = $validateData['desc'];
            $new_voyage->description = json_encode($request['descriptions']);
            $new_voyage->prix = $validateData['prix'];
            $new_voyage->date_ajoute = date('Y-m-d');
            $new_voyage->categorie = $validateData['categorie'];
            $new_voyage->pays = $validateData['pays'];
            $new_voyage->ville = $validateData['ville'];
            $new_voyage->date_expiration = $validateData['date_depart'];
            $new_voyage->date_depart = $validateData['date_depart'];
            $new_voyage->date_retour = $validateData['date_retour'];
            $new_voyage->nombre_vues = 0;
            $new_voyage->agence_id = $validateData['agence_id'];
            $new_voyage->save();
            // =================== sauvgarde d'une photo ================
            $images = $request->file('images');
            $i = 0;
            foreach ($images as $image) {
                ++$i;
                $new_image = new Image();
                $extension_image = $image->getClientOriginalExtension();
                $nom_image = $validateData['ville'].$i.'.'.$extension_image;
                $chemin = 'images/voyages/'.$validateData['pays'];
                $image->move($chemin, $nom_image);
                $new_image->url = $nom_image;
                $new_image->voyage_id = $new_voyage->id;
                $new_image->save();
            }
            $clients = Client::all();
            foreach ($clients as $client) {
                Mail::to($client->email)->send(new VoyageNotifs($new_voyage));
            }
            session()->flash('ajouter_voyage_succes', 'Vous avez ajouté le voyage avec succés.');

            return redirect('accueil-admin/voyages');
        }
    }

    public function pageModifierVoyage($id)
    {
        $voyage = Voyage::find($id);
        $agences = Agence::all();

        return view('admin.voyages.modifier_voyage')->with(['voyage' => $voyage, 'agences' => $agences]);
    }

    public function adminModifierVoyage(Request $request, $id)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'titre' => 'required|string',
            'desc' => 'required|string',
            'prix' => 'required',
            'categorie' => 'required',
            'pays' => 'required|string',
            'ville' => 'required|string',
            'date_expiration' => 'required|date',
            'date_depart' => 'required|date',
            'date_retour' => 'required|date|after:date_depart',
            'agence_id' => 'required',
            // 'images'=>'required',
        ], [
            'titre.required' => '*Le titre est obligatoire.',
            'titre.string' => '*Le titre doit être une chaine de caractéres.',
            'desc.required' => '*La description est obligatoire.',
            'desc.string' => '*La description doit être une chaine de caractéres.',
            'prix.required' => '*Le prix est obligatoire.',
            // 'prix.fload' => '*Le prix doit etre un nombre.',
            'categorie.required' => '*La catégorie est obligatoire.',
            'pays.required' => '*La pays est obligatoire.',
            'ville.required' => '*La ville est obligatoire.',
            'date_expiration.required' => "*La date d'expiration est obligatoire.",
            'date_expiration.' => "*La date d'expiration  doit etre une date.",
            'date_depart.required' => '*La date de départ est obligatoire.',
            'date_depart.date' => '*La date de départ doit etre une date.',
            'date_retour.required' => '*La date de retour est obligatoire.',
            'date_retour.date' => '*La date de retour doit etre une date.',
            'date_retour.after' => '*La date de routeur doit être postérieure à la date de départ.',
            'agence_id.required' => "*L'agence est obligatoire.",
            // 'images.required' => "*L'image est obligatoire.",
        ]);

        if ($validateData) {
            $voyage = Voyage::find($id);
            $voyage->titre = $validateData['titre'];
            $voyage->desc = $validateData['desc'];
            $voyage->description = json_encode($request['descriptions']);
            $voyage->prix = $validateData['prix'];
            $voyage->date_ajoute = $voyage->date_ajoute;
            $voyage->categorie = $validateData['categorie'];
            $voyage->pays = $validateData['pays'];
            $voyage->ville = $validateData['ville'];
            $voyage->date_expiration = $validateData['date_depart'];
            $voyage->date_depart = $validateData['date_depart'];
            $voyage->date_retour = $validateData['date_retour'];
            $voyage->nombre_vues = $voyage->nombre_vues;
            $voyage->agence_id = $validateData['agence_id'];
            $voyage->save();
            // =================== sauvgarde d'une photo ================
            $images = $request->file('images');
            if (!$images) {
                session()->flash('modifier_voyage_succes', 'Vous avez modifier le voyage avec succés.');

                return redirect('/accueil-admin/voyages');
            } else {
                $old_images = Image::all()->where('voyage_id', '=', $voyage->id);
                foreach ($old_images as $image) {
                    $image->delete();
                }
                $i = 0;
                foreach ($images as $image) {
                    ++$i;
                    $new_image = new Image();
                    $extension_image = $image->getClientOriginalExtension();
                    $nom_image = $validateData['ville'].$i.'.'.$extension_image;
                    $chemin = 'images/voyages/'.$validateData['pays'];
                    $image->move($chemin, $nom_image);
                    $new_image->url = $nom_image;
                    $new_image->voyage_id = $voyage->id;
                    $new_image->save();
                }

                session()->flash('modifer_voyage_succes', 'Vous avez modifier le voyage avec succés.');

                return redirect('accueil-admin/voyages');
            }
        }
    }

    public function supprimerVoyage($id)
    {
        $voyage = Voyage::find($id);
        // $agence->voyages->delete();
        foreach ($voyage->reservations as $reservation) {
            $reservation->delete();
        }
        foreach ($voyage->images as $image) {
            File::delete(public_path('/images/voyages/'.$voyage->pays.'/'.$image->url));
            $image->delete();
        }
        $voyage->delete();
        session()->flash('supprimer_voyage_succes', 'Vous avez supprimé le voyage : '.$voyage->titre.' avec succés');

        return redirect('/accueil-admin/voyages');
    }
    // =====================================================================

    // ==================================== Responsables ========================================
    public function pageAjouterResponsable()
    {
        return view('admin.responsables.ajouter_responsable');
    }

    public function adminAjouterResponsable(Request $request)
    {
        $validateData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'cin' => 'required|string|max:20|unique:responsables,cin',
            'tel' => 'required|string|max:15',
            'email' => 'required|max:30|unique:responsables,email|unique:agences,email|unique:clients,email',
            'mot_de_passe' => 'required|min:2|max:20',
        ], [
            'nom.required' => '*Le nom est obligatoire.',
            'nom.string' => '*Le nom doit être une chaine de caractères.',
            'nom.max' => '*Nom très long',

            'prenom.required' => '*Le prénom est obligatoire.',
            'prenom.string' => '*Le prénom doit être une chaine de caractères.',
            'prenom.max' => '*Prénom très long',

            'cin.required' => '*CIN est obligatoire.',
            'cin.string' => '*CIN doit être une chaine de caractères.',
            'cin.max' => '*CIN très long',
            'cin.unique' => '*Cette CIN est déja existe',

            'tel.required' => '*Le numéro de tél est obligatoire.',
            'tel.max' => '*Numéro de tél très long.',

            'email.required' => "L'email est obligatoire.",
            'email.max' => "L'email est très long.",
            'email.unique' => "L'email est déja existe.",

            'mot_de_passe.required' => 'Le mot de passe est obligatoire.',
            'mot_de_passe.min' => 'Mot de passe très court.',
            'mot_de_passe.max' => 'Mot de passe trés long.',
        ]
        );

        if ($validateData) {
            $new_responsable = new Responsable();
            $new_responsable->nom = $validateData['nom'];
            $new_responsable->prenom = $validateData['prenom'];
            $new_responsable->tel = $validateData['tel'];
            $new_responsable->cin = $validateData['cin'];
            $new_responsable->date_inscription = date('Y-m-d');
            $new_responsable->email = strtolower($validateData['email']);
            // ===================== Crypter le mot de passe ============================
            $mot_de_passe_hashed = Hash::make($validateData['mot_de_passe']);
            // =================================================
            $new_responsable->mot_de_passe = $mot_de_passe_hashed;
            $new_responsable->save();
            session()->flash('ajoute_responsable_succes', 'Vous avez ajouté le responsable '.$validateData['prenom'].' avec succes.');

            return redirect('/accueil-admin/responsables');
        } else {
            return redirect()->back()->withErrors($validateData)->withInput();
        }
    }

    public function pageModifierResponsable($id)
    {
        $responsable = Responsable::find($id);

        return view('admin.responsables.modifier_responsable')->with(['responsable' => $responsable]);
    }

    public function adminModifierResponsable(Request $request, $id)
    {
        $validateData = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'cin' => 'required|string|max:20',
            'tel' => 'required|string|max:15',
            'email' => 'required|max:30|unique:agences,email|unique:clients,email',
            // 'mot_de_passe' => 'required|min:2|max:20',
        ], [
            'nom.required' => '*Le nom est obligatoire.',
            'nom.string' => '*Le nom doit être une chaine de caractères.',
            'nom.max' => '*Nom très long',

            'prenom.required' => '*Le prénom est obligatoire.',
            'prenom.string' => '*Le prénom doit être une chaine de caractères.',
            'prenom.max' => '*Prénom très long',

            'cin.required' => '*CIN est obligatoire.',
            'cin.string' => '*CIN doit être une chaine de caractères.',
            'cin.max' => '*CIN très long',
            'cin.unique' => '*Cette CIN est déja existe',

            'tel.required' => '*Le numéro de tél est obligatoire.',
            'tel.max' => '*Numéro de tél très long.',

            'email.required' => "L'email est obligatoire.",
            'email.max' => "L'email est très long.",
            'email.unique' => "L'email est déja existe.",

            // 'mot_de_passe.required' => "Le mot de passe est obligatoire.",
            // 'mot_de_passe.min' => "Mot de passe très court.",
            // 'mot_de_passe.max' => "Mot de passe trés long.",
        ]
        );

        if ($validateData) {
            $responsable = Responsable::find($id);
            $responsable->nom = $validateData['nom'];
            $responsable->prenom = $validateData['prenom'];
            $responsable->tel = $validateData['tel'];
            $responsable->cin = $validateData['cin'];
            $responsable->date_inscription = $responsable->date_inscription;
            $responsable->email = $validateData['email'];
            // ===================== Crypter le mot de passe ============================
            // $mot_de_passe_hashed = Hash::make($validateData['mot_de_passe']);
            // =================================================
            // $responsable->mot_de_passe = $mot_de_passe_hashed;
            $responsable->save();
            session()->flash('modifier_responsable_succes', 'Vous avez modifier le responsable '.$validateData['prenom'].' avec succes.');

            return redirect('/accueil-admin/responsables');
        } else {
            return redirect()->back()->withErrors($validateData)->withInput();
        }
    }

    public function supprimerResponsable($id)
    {
        $responsable = Responsable::find($id);
        $responsable->delete();
        session()->flash('supprimer_responsable_succes', 'Vous avez supprimé le responsable '.$responsable->prenom.' avec succés');

        return redirect('/accueil-admin/responsables');
    }

    // =====================================================================

    // ========================== Client ========================
    public function supprimerClient($id)
    {
        $client = Client::find($id);
        foreach ($client->reservations as $reservation) {
            $reservation->delete();
        }
        $client->delete();
        session()->flash('supprimer_client_succes', 'Vous avez supprimé le client '.$client->prenom.' avec succés');

        return redirect('/accueil-admin/clients');
    }
    // ====================================================

    public function vipVoyage($id)
    {
        $voyage = Voyage::find($id);
        $voyage->vip = true;
        $voyage->save();
        session()->flash('vip_succes', 'Le voyage '.$voyage->titre.' est premium maintenant');

        return redirect('/accueil-admin/voyages');
    }

    public function chiffreAffaire()
    {
        $voyages = Voyage::all();
        $prix = [];
        foreach ($voyages as $voyage) {
            foreach ($voyage->reservations as $reservation) {
                if ($reservation->etat_validation === 1) {
                    array_push($prix, $reservation->voyage->prix);
                }
            }
        }
        $sum = array_sum($prix);

        return view('admin.chiffre')->with(['chiffre' => $sum]);
    }
}
