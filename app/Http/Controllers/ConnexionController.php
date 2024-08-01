<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    // ============== page connexion ====================
    public function pageConnexion(){
        return view('sections.connexion');
    }
    // ==========================================

    // ============== page connexion de client ====================
    public function pageConnexionClient(){
        return view('client.connexion');
    }
    // ==========================================

    // ============== page connexion de'agence ====================
    public function pageConnexionAgence(){
        return view('agence.connexion');
    }
    // ==========================================

    // ============== page connexion de respo ====================
    public function pageConnexionResponsable(){
        return view('responsable.connexion');
    }
    // ==========================================

     // ============== page connexion d'admin ====================
     public function pageConnexionAdmin(){
        return view('admin.connexion');
    }
    // ==========================================

    
}
