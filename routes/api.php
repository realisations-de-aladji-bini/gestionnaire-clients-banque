<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\AbonneController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    
    	//Intégration API

Route::middleware('auth:sanctum')->group(function () {
  Route::prefix('/v1')->group(function () {
    //Endpoints des abonnés
    Route::get('/abonnes', [AbonneController::class,'index'])->name('liste-abonnes');// Liste des clients
    Route::get('/abonnes/{id}', [AbonneController::class,'show'])->name('infos-abonne'); //Détails d'un client
    Route::post('/abonnes', [AbonneController::class,'store'])->name('ajouter-abonne'); // Ajout d'un nouveau client
    Route::put('/abonnes/{id}', [AbonneController::class,'update'])->name('modifier-abonne'); //Modification d'un client existant
    Route::delete('/abonnes/{id}', [AbonneController::class,'destroy'])->name('supprimer-abonne'); // Suppression d'un client
    Route::get('/abonnes/comptes', [AbonneController::class,'comptesAbonnes'])->name('comptes-abonnes'); // Liste des clients avec leurs comptes respectifs
    Route::get('/abonnes/{id}/comptes', [AbonneController::class,'detailsComptesAbonne'])->name('details-comptes-abonne'); // Détail d'un client avec ses comptes
    Route::put('/liaisons', [AbonneController::class,'lierCompteAbonne'])->name('liaison-compte-abonne'); // Liaison d'un client avec son compte
    Route::get('/stats/abonnes/{id}', [AbonneController::class,'statisticAbonne'])->name('statistiques-abonne'); // Statistique d'un client

    //Endpoints des comptes
    Route::get('/comptes', [CompteController::class,'index'])->name('liste-abonnes'); // Liste des comptes
    Route::get('/comptes/{id}', [CompteController::class,'show'])->name('info-abonne'); // Détails d'un compte
    Route::post('/comptes', [CompteController::class,'store'])->name('ajout-abonne'); // Ajout d'un nouveau compte
    Route::put('/comptes/{id}', [CompteController::class,'update'])->name('modifier-abonne'); // Modification d'un compte
    Route::delete('/comptes/{id}', [CompteController::class,'destroy'])->name('supprimer-abonne'); // Suppression d'un compte
    Route::get('/stats', [CompteController::class,'statisticGeneral'])->name('statistiques-generales'); // Statistiques générales
  });
});
