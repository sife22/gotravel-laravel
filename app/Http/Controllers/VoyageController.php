<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Image;
use App\Models\Voyage;
use App\Notifications\voyageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\VoyageNotifs;
use App\Models\Agence;
use Illuminate\Support\Facades\File;


class VoyageController extends Controller
{
    // ======================== Retourner la page d'ajoute voyage ========================
    public function pageVoyage(){
        return view('agence.ajouter_voyage');
    }
    // =================================================================================

    // ======================== Retourner la page des voyages à l'etrenge ========================
    public function voyageEtrange(){
        $voyages = Voyage::all()->where('categorie', '=', "À l'étranger")->where('type', '=', 'Client')->where('date_expiration', '>', now());
        if(count($voyages) > 0){
            $voyages = Voyage::all()->where('categorie', '=', "À l'étranger")->where('type', '=', 'Client')->where('date_expiration', '>', now())->toQuery()->paginate(30);
            return view('sections.etranger')->with('voyages', $voyages);
        }else{
            $voyages = Voyage::all()->where('categorie', '=', "À l'étranger")->where('type', '=', 'Client')->where('date_expiration', '>', now());
            return view('sections.etranger')->with(['voyages'=>$voyages]);
        }
    }
    // =================================================================================

    // ======================== Retourner la page offres ========================
    public function meilleures_offres(){
        $voyages = Voyage::all()->where('vip', '=', true)->where('type', '=', 'Client')->where('date_expiration', '>', now());
        if(count($voyages) > 0){
            $voyages = Voyage::all()->where('vip', '=', true)->where('type', '=', 'Client')->where('date_expiration', '>', now())->toQuery()->paginate(30);
            return view('sections.meilleures_offres')->with('voyages', $voyages);
        }else{
            $voyages = Voyage::all()->where('vip', '=', true)->where('type', '=', 'Client')->where('date_expiration', '>', now());
            return view('sections.meilleures_offres')->with(['voyages'=>$voyages]);
        }
        
    }
    // =================================================================================

    // ======================== Retourner la page des voyages au maroc ========================
    public function voyageMaroc(){
        $voyages = Voyage::all()->where('categorie', '=', 'Au Maroc')->where('type', '=', 'Client')->where('date_expiration', '>', now());
        if(count($voyages) > 0){
            $voyages = Voyage::all()->where('categorie', '=', 'Au Maroc')->where('type', '=', 'Client')->where('date_expiration', '>', now())->toQuery()->paginate(30);
            return view('sections.maroc')->with('voyages', $voyages);
        }else{
            $voyages = Voyage::all()->where('categorie', '=', 'Au Maroc')->where('type', '=', 'Client')->where('date_expiration', '>', now());
            return view('sections.maroc')->with(['voyages'=>$voyages]);
        }
    }
    // =================================================================================

    // ======================== Retourner la page des voyages au Hajj ========================
    public function voyageHajj(){
        $voyages = Voyage::all()->where('categorie', '=', 'Haj et oumra')->where('type', '=', 'Client')->where('date_expiration', '>', now());
        if(count($voyages) > 0){
            $voyages = Voyage::all()->where('categorie', '=', 'Haj et oumra')->where('type', '=', 'Client')->where('date_expiration', '>', now())->toQuery()->paginate(30);
            return view('sections.hajj')->with('voyages', $voyages);
        }else{
            $voyages = Voyage::all()->where('categorie', '=', 'Haj et oumra')->where('type', '=', 'Client')->where('date_expiration', '>', now());
            return view('sections.hajj')->with(['voyages'=>$voyages]);
        }
    }
    // =================================================================================

    // ======================== Retourner la page des voyages de la ville ========================
    public function voyagesParPays(Request $request){
        if(!$request->pays ){
            return redirect('/');
        }
        session()->pull('null_pays');
        $pays = strtolower($request['pays']);
        $voyages = Voyage::where('type', '=', 'Client')->whereRaw('LOWER(pays) = ?', [$pays])->orWhereRaw('LOWER(ville) = ?', [$pays])->get();
        // dd($voyages);
        if(count($voyages) === 0){
            $voyages = Voyage::all()->where('type', '=', 'Client');
            session()->flash('null_pays', 'Pas de voyage vers '.$pays.', Consulter les autres voyages :');
            return view('sections.voyages_pays')->with(['allVoyages'=>$voyages, 'pays'=>ucwords($pays)]);
        }else{
            return view('sections.voyages_pays')->with(['voyages'=>$voyages, 'pays'=>ucwords($pays)]);
        }
    }
    // =================================================================================

    // ======================== Retourner la page des details ========================
    public function voyageDetails($id){
        $voyage = Voyage::find($id);
        $voyages = Voyage::where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyage->nombre_vues += 1;
        $voyage->save();
        // dd($voyage->agence->raison_sociale);
        return view('sections.voyage_details')->with(['voyage'=>$voyage, 'voyages'=>$voyages]);
    }
    // =================================================================================

    // ======================== Retourner la page des details ========================
    public function voyageDetailsBtob($id){
        $voyage = Voyage::find($id);
        // $voyages = Voyage::where('date_expiration', '>', now())->where('type', '=', 'Client')->orderBy('date_expiration', 'asc')->take(10)->get();
        $voyage->nombre_vues += 1;
        $voyage->save();
        return view('agence.voyage_details')->with(['voyage'=>$voyage]);
    }
    // =================================================================================


    // ============================== Ajouter voyage =====================================
    public function ajouterVoyage(Request $request)
    {
        
        $validateData = $request->validate([
            'titre'=>'required|string',
            'type'=>'required',
            'desc'=>'required|string',
            'prix'=>'required',
            'categorie'=>'required',
            'pays'=>'required|string',
            'ville'=>'required|string',
            'date_expiration'=>'required|date',
            'date_depart'=>'required|date|after:date_expiration',
            'date_retour'=>'required|date|after:date_depart',
            'images' => 'required',

        
        ],[
            'titre.required' => '*Le titre est obligatoire.',
            'titre.string' => '*Le titre doit être une chaine de caractéres.',
            'type.required' => '*Le type est obligatoire.',
            'desc.required' => '*La description est obligatoire.',
            'desc.string' => '*La description doit être une chaine de caractéres.',
            'prix.required' => '*Le prix est obligatoire.',
            'categorie.required' => '*La catégorie est obligatoire.',
            'pays.required' => '*La pays est obligatoire.',
            'ville.required' => '*La ville est obligatoire.',
            'date_expiration.required' => "*La date d'expiration est obligatoire.",
            'date_expiration.' => "*La date d'expiration  doit etre une date.",
            'date_depart.required' => '*La date de départ est obligatoire.',
            'date_depart.date' => '*La date de départ doit etre une date.',
            'date_retour.required' => '*La date de retour est obligatoire.',
            'date_retour.date' => '*La date de retour doit etre une date.',
            'date_depart.after' => "*La date de départ doit être postérieure à la date d'expiration.",
            'date_retour.after' => '*La date de routeur doit être postérieure à la date de départ.',
            'images.required' => "*L'image est obligatoire.",
        ]);

        // dd($validateData['images']);

        if($validateData){
            $new_voyage = new Voyage();
            $new_voyage->titre = $validateData['titre'];
            $new_voyage->type = $validateData['type'];
            $new_voyage->desc = $validateData['desc'];
            $new_voyage->description = json_encode($request['descriptions']);
            $new_voyage->prix = $validateData['prix'];
            $new_voyage->date_ajoute = date('Y-m-d');
            $new_voyage->categorie = $validateData['categorie'];
            $new_voyage->pays = $validateData['pays'];
            $new_voyage->ville = $validateData['ville'];
            $new_voyage->date_expiration = $validateData['date_expiration'];
            $new_voyage->date_depart = $validateData['date_depart'];
            $new_voyage->date_retour = $validateData['date_retour'];
            $new_voyage->nombre_vues = 0;
            $new_voyage->agence_id = session()->get('agence_id');
            $new_voyage->save();
            // =================== sauvgarde d'une photo ================
            $images = $request->file('images');
            $i = 0;
            foreach($images as $image){
                $i +=1;
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
            foreach($clients as $client){
                Mail::to($client->email)->send(new VoyageNotifs($new_voyage));
            }
            session()->flash('ajouter_voyage_succes', 'Votre voyage a été ajouter avec succés.');
            if($new_voyage->type === 'Client'){
                return redirect('/nos_voyages');
            }else{
                return redirect('/nos_voyages_btob');
            }
        }
        // dd(json_encode($request['descriptions']));

    }
    // ===========================================================================================
    public function agenceSupprimerVoyage($id){
        $voyage = Voyage::find($id);
        foreach($voyage->reservations as $reservation){
            $reservation->delete();
        }
        foreach($voyage->images as $image){
            File::delete(public_path('/images/voyages/'.$voyage->pays.'/'.$image->url));
            $image->delete();
        }
        $voyage->delete();
        session()->flash('supprimer_voyage_succes', "Vous avez supprimé le voyage : ".$voyage->titre.' avec succés');
        return redirect("/nos_voyages");
    }

    public function pageModifierVoyage($id){
        $voyage = Voyage::find($id);
        $agences = Agence::all();
        return view('agence.modifier_voyage')->with(['voyage'=> $voyage, 'agences'=>$agences]);
    }

    public function agenceModifierVoyage(Request $request, $id)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'titre'=>'required|string',
            'type'=>'required',
            'desc'=>'required|string',
            'prix'=>'required',
            'categorie'=>'required',
            'pays'=>'required|string',
            'ville'=>'required|string',
            'date_expiration'=>'required|date',
            'date_depart'=>'required|date',
            'date_retour'=>'required|date|after:date_depart',
        ],[
            'titre.required' => '*Le titre est obligatoire.',
            'titre.string' => '*Le titre doit être une chaine de caractéres.',
            'type.required' => '*Le type est obligatoire.',
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
        ]);

        if($validateData){
            $voyage = Voyage::find($id);
            $voyage->titre = $validateData['titre'];
            $voyage->type = $validateData['type'];
            $voyage->desc = $validateData['desc'];
            $voyage->description = json_encode($request['descriptions']);
            $voyage->prix = $validateData['prix'];
            $voyage->date_ajoute = $voyage->date_ajoute;
            $voyage->categorie = $validateData['categorie'];
            $voyage->pays = $validateData['pays'];
            $voyage->ville = $validateData['ville'];
            $voyage->date_expiration = $validateData['date_expiration'];
            $voyage->date_depart = $validateData['date_depart'];
            $voyage->date_retour = $validateData['date_retour'];
            $voyage->nombre_vues = $voyage->nombre_vues;
            $voyage->save();
            // =================== sauvgarde d'une photo ================
            $images = $request->file('images');
            if(!$images){
            session()->flash('modifier_voyage_succes', 'Vous avez modifier le voyage avec succés.');
            return redirect('/nos_voyages');    
            }else{
                $old_images = Image::all()->where('voyage_id', '=', $voyage->id);
                foreach($old_images as $image){
                    $image->delete();
                }
                $i = 0;
                foreach($images as $image){
                $i +=1;
                $new_image = new Image();
                $extension_image = $image->getClientOriginalExtension();
                $nom_image = $validateData['ville'].$i.'.'.$extension_image;
                $chemin = 'images/voyages/'.$validateData['pays'];
                $image->move($chemin, $nom_image);
                $new_image->url = $nom_image;
                $new_image->voyage_id = $voyage->id;
                $new_image->save();
            }
            session()->flash('modifier_voyage_succes', 'Vous avez modifier le voyage avec succés.');
            return redirect('/nos_voyages');
        }
        }
    }
}
