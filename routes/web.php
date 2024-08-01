<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\VoyageController;
use App\Models\Admin;
use App\Models\Responsable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/add', [AdminController::class, 'add']);
// Route::get('/send', [SectionController::class, 'sendMail']);


Route::get('/contact', [SectionController::class, 'pageContact']);
Route::get('/propos', [SectionController::class, 'pagePropos']);
Route::get('/à_étranger', [VoyageController::class, 'voyageEtrange']);
Route::get('/hajj_oumra', [VoyageController::class, 'voyageHajj']);
Route::get('/au_maroc', [VoyageController::class, 'voyageMaroc']);
Route::get('/meilleures_offres', [VoyageController::class, 'meilleures_offres']);
Route::post('/voyagesParPays', [VoyageController::class, 'voyagesParPays']);
Route::get('/voyages/{id}', [VoyageController::class, 'voyageDetails'])->middleware('restrict_agence_voyages');
Route::get('/mot_de_passe_oublié', [PasswordController::class, 'pagePassword']);
Route::get('/vérification', [PasswordController::class, 'pageCode']);
Route::post('/sendCode', [PasswordController::class, 'sendCode']);
Route::post('/verificationCode', [PasswordController::class, 'verificationCode']);
Route::get('/nouveau_mot_de_passe', [PasswordController::class, 'pageNewPassword']);
Route::get('/code_vérification', [PasswordController::class, 'pageCode']);
Route::post('/resetPassword', [PasswordController::class, 'resetPassword']);



Route::group(['middleware' => ['already_logged_client', 'already_logged_agence', 'already_logged_admin', 'already_logged_responsable']], function() {
    Route::get('/connexion/client', [ConnexionController::class, 'pageConnexionClient']);
    Route::get('/connexion/agence', [ConnexionController::class, 'pageConnexionAgence']);
    Route::get('/inscription/client', [ClientController::class, 'pageInscription']);
    Route::get('/inscription/agence', [AgenceController::class, 'pageInscription']); 
    Route::get('/connexion/admin', [ConnexionController::class, 'pageConnexionAdmin']);
    Route::get('/connexion/responsable', [ConnexionController::class, 'pageConnexionResponsable']);
    Route::get('/', [SectionController::class, 'pageAccueil'])->name('home');
});

Route::group(['middleware' => ['have_to_log_in_agence']], function() {
    Route::get('/accueil-agence', [AgenceController::class, 'pageAccueil']);
    Route::get('/nos_voyages', [AgenceController::class, 'nosVoyages']);
    Route::get('/nos_voyages_btob', [AgenceController::class, 'nosVoyagesBtoB']);
    Route::get('/voyages_btob', [AgenceController::class, 'voyagesBtoB']);
    Route::get('/ajouter-voyage', [VoyageController::class, 'pageVoyage']);
    Route::post('/ajouterVoyage', [VoyageController::class, 'ajouterVoyage']);
    Route::get('/agence/modifier/voyage/{id}', [VoyageController::class, 'pageModifierVoyage']);
    Route::put('/agenceModifierVoyage/{id}', [VoyageController::class, 'agenceModifierVoyage']);
    Route::get('/agence/supprimer/voyage/{id}', [VoyageController::class, 'agenceSupprimerVoyage']);
    Route::get('/agence/réservations', [AgenceController::class, 'pageReservations']);
    Route::get('/agence/reservations/nonvalidées', [AgenceController::class, 'pageReservationsNonValidees']);
    Route::get('/agence/valider/reservation/{id}', [AgenceController::class, 'validerReservation']);
    Route::get('/agence/valider/reservation/btob/{id}', [AgenceController::class, 'validerReservationBtob']);
    Route::get('/agence/supprimer/reservation/{id}', [AgenceController::class, 'supprimerReservation']);
    Route::get('/voyages/btob/{id}', [VoyageController::class, 'voyageDetailsBtob']);
    Route::get('/agence/reservations/btob', [AgenceController::class, 'pageReservationsBtob']);
    Route::post('/reserver/btob/{id_voyage}', [AgenceController::class, 'reserverVoyage']);
    Route::get('/agence/reservations/validées', [AgenceController::class, 'pageReservationsValidees']);
    Route::get('/agence/reservations/btob/validées', [AgenceController::class, 'pageReservationsValideesBtob']);
    Route::get('/agence/chiffre_affaire', [AgenceController::class, 'chiffreAffaire']);
});


Route::post('/ajouterClient', [ClientController::class, 'ajouterClient']);
Route::post('/loginClient', [ClientController::class, 'loginClient']);
Route::get('/logoutClient', [ClientController::class, 'logoutClient']);

Route::group(['middleware' => ['have_to_log_in_client']], function() {
    Route::get('/accueil-client', [ClientController::class, 'pageAccueil']);
    Route::post('/reserver/{id_voyage}', [ClientController::class, 'reserverVoyage']);
    Route::get('/mes_réservations', [ClientController::class, 'reservations']);
    Route::get('/profil/{id}', [ClientController::class, 'pageProfil']);
    Route::post('/modifierProfil/{id}', [ClientController::class, 'modifierProfil']);
});

Route::post('/ajouterAgence', [AgenceController::class, 'ajouterAgence']);
Route::post('/loginAgence', [AgenceController::class, 'loginAgence']);
Route::get('/logoutAgence', [AgenceController::class, 'logoutAgence']);


Route::fallback([SectionController::class, 'notFound'])->name('404');


// ============================= RESPONSABLE ========================================
Route::post('/loginResponsable', [ResponsableController::class, 'loginResponsable']);
Route::get('/logoutResponsable', [ResponsableController::class, 'logoutResponsable']);

Route::group(['middleware' => ['have_to_log_in_responsable']], function() {
    Route::get('/accueil-responsable', [ResponsableController::class, 'pageAccueil']);
    // ================ agence ================
    Route::get('/accueil-responsable/agences', [ResponsableController::class, 'pageAgences']);
    Route::get('/accueil-responsable/ajouter_agence', [ResponsableController::class, 'pageAjouterAgence']);
    Route::post('/responsableAjouterAgence', [ResponsableController::class, 'responsableAjouterAgence']);
    Route::get('/responsable/supprimer/agence/{id}', [ResponsableController::class, 'supprimerAgence']);
    Route::get('/responsable/modifier/agence/{id}', [ResponsableController::class, 'pageModifierAgence']);
    Route::put('/responsableModifierAgence/{id}', [ResponsableController::class, 'responsableModifierAgence']);
    Route::post('/responsableTrouverAgence', [ResponsableController::class, 'trouverAgence']);
    Route::get('/responsable/chiffre_affaire', [ResponsableController::class, 'chiffreAffaire']);
    // =========================================
    // ================ voyage ================
    Route::get('/accueil-responsable/voyages', [ResponsableController::class, 'pageVoyages']);
    Route::get('/accueil-responsable/ajouter_voyage', [ResponsableController::class, 'pageAjouterVoyage']);
    Route::post('/responsableAjouterVoyage', [ResponsableController::class, 'responsableAjouterVoyage']);
    Route::get('/responsable/modifier/voyage/{id}', [ResponsableController::class, 'pageModifierVoyage']);
    Route::put('/responsableModifierVoyage/{id}', [ResponsableController::class, 'responsableModifierVoyage']);
    Route::get('/responsable/supprimer/voyage/{id}', [ResponsableController::class, 'supprimerVoyage']);
    Route::post('/responsableTrouverVoyage', [ResponsableController::class, 'trouverVoyage']);
    Route::get('/responsable/vip/voyage/{id}', [ResponsableController::class, 'vipVoyage']);
    // =========================================
    //  =================== client ===================
    Route::get('/accueil-responsable/clients', [ResponsableController::class, 'pageClients']);
    Route::get('/responsable/supprimer/client/{id}', [ResponsableController::class, 'supprimerclient']);
    Route::post('/responsableTrouverClient', [ResponsableController::class, 'trouverClient']);
    // =================================================
});
// ==============================================================================

// ====================================== ADMIN ==========================================
Route::post('/loginAdmin', [AdminController::class, 'loginAdmin']);
Route::get('/logoutAdmin', [AdminController::class, 'logoutAdmin']);

Route::group(['middleware' => ['have_to_log_in_admin']], function() {
    Route::get('/accueil-admin', [AdminController::class, 'pageAccueil']);
    // ================ agence ================
    Route::get('/accueil-admin/agences', [AdminController::class, 'pageAgences']);
    Route::get('/accueil-admin/ajouter_agence', [AdminController::class, 'pageAjouterAgence']);
    Route::post('/adminAjouterAgence', [AdminController::class, 'adminAjouterAgence']);
    Route::get('/supprimer/agence/{id}', [AdminController::class, 'supprimerAgence']);
    Route::get('/modifier/agence/{id}', [AdminController::class, 'pageModifierAgence']);
    Route::put('/adminModifierAgence/{id}', [AdminController::class, 'adminModifierAgence']);
    Route::post('/trouverAgence', [AdminController::class, 'trouverAgence']);
    Route::get('/admin/chiffre_affaire', [AdminController::class, 'chiffreAffaire']);

    // =========================================
    // ================ voyage ================
    Route::get('/accueil-admin/voyages', [AdminController::class, 'pageVoyages']);
    Route::get('/accueil-admin/voyages/btob', [AdminController::class, 'pageVoyagesBtob']);
    Route::get('/accueil-admin/ajouter_voyage', [AdminController::class, 'pageAjouterVoyage']);
    Route::post('/adminAjouterVoyage', [AdminController::class, 'adminAjouterVoyage']);
    Route::get('/supprimer/voyage/{id}', [AdminController::class, 'supprimerVoyage']);
    Route::get('/vip/voyage/{id}', [AdminController::class, 'vipVoyage']);
    Route::get('/admin/modifier/voyage/{id}', [AdminController::class, 'pageModifierVoyage']);
    Route::put('/adminModifierVoyage/{id}', [AdminController::class, 'adminModifierVoyage']);
    Route::post('/trouverVoyage', [AdminController::class, 'trouverVoyage']);
    // =========================================
     // ================ responsable ================
    Route::get('/accueil-admin/responsables', [AdminController::class, 'pageResponsables']);
    Route::get('/accueil-admin/ajouter_responsable', [AdminController::class, 'pageAjouterResponsable']);
    Route::post('/adminAjouterResponsable', [AdminController::class, 'adminAjouterResponsable']);
    Route::get('/modifier/responsable/{id}', [AdminController::class, 'pageModifierResponsable']);
    Route::get('/supprimer/responsable/{id}', [AdminController::class, 'supprimerResponsable']);
    Route::put('/adminModifierResponsable/{id}', [AdminController::class, 'adminModifierResponsable']);
     // =========================================
    //  =================== client ===================
    Route::get('/accueil-admin/clients', [AdminController::class, 'pageClients']);
    Route::get('/supprimer/client/{id}', [AdminController::class, 'supprimerclient']);
    Route::post('/trouverClient', [AdminController::class, 'trouverClient']);
    // =================================================
});
// =================================================================================================
