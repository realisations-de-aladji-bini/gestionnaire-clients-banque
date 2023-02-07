<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
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
    Route::prefix('/v1')->group(function () {
	//Routes des abonnés
  	Route::get('/abonnes', [AbonneController::class,'index'])->name('liste-abonnes');
    Route::get('/abonnes/{id}', [AbonneController::class,'show'])->name('infos-abonne');
	Route::post('/abonnes', [AbonneController::class,'store'])->name('ajouter-abonne');
    Route::put('/abonnes/{id}', [AbonneController::class,'update'])->name('modifier-abonne');
    Route::delete('/abonnes/{id}', [AbonneController::class,'destroy'])->name('supprimer-abonne');
    Route::get('/abonnes/comptes', [AbonneController::class,'comptesAbonnes'])->name('comptes-abonnes');
    Route::get('/abonnes/{id}/comptes', [AbonneController::class,'detailsComptesAbonne'])->name('details-comptes-abonne');
	Route::put('/liaisons', [AbonneController::class,'lierCompteAbonne'])->name('liaison-compte-abonne');
	Route::get('/stats/abonnes/{id}', [AbonneController::class,'statisticAbonne'])->name('statistiques-abonne');

	//Routes des comptes
  	Route::get('/comptes', [CompteController::class,'index'])->name('liste-abonnes');
    Route::get('/comptes/{id}', [CompteController::class,'show'])->name('info-abonne');
	Route::post('/comptes', [CompteController::class,'store'])->name('ajout-abonne');
    Route::put('/comptes/{id}', [CompteController::class,'update'])->name('modifier-abonne');
    Route::delete('/comptes/{id}', [CompteController::class,'destroy'])->name('supprimer-abonne');
	Route::get('/stats', [CompteController::class,'statisticGeneral'])->name('statistiques-generales');
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
