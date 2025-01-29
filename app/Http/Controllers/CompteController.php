<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Abonne;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class CompteController extends Controller
{
    /**
     * Renvoie la liste de tous les comptes de la bd.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'hasError'=>false,
            'message'=>"Liste des comptes",
            'data'=> Compte::all()]);
    }

    /**
     * Ajoute un nouveau compte.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'abonne_id'=>'required',
            'libelle'=>'required',
            'description'=>'required',
            'agence'=>'required',
            'banque'=>'required',
            'numero'=>'required',
            'rib'=>'required',
            'montant'=>'required',
            'domiciliation'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'hasError'=>true,
                'message'=>"Une erreur est survenue lors du traitement",
                'data'=> $validator->errors()->all()
            ]);
        }
        $compte = Compte::create([

            'abonne_id'=>$request->get('abonne_id'),
            'libelle'=>$request->get('libelle'),
            'description'=>$request->get('description'),
            'agence'=>$request->get('agence'),
            'banque'=>$request->get('banque'),
            'numero'=>$request->get('numero'),
            'rib'=>$request->get('rib'),
            'montant'=>$request->get('montant'),
            'domiciliation'=>$request->get('domiciliation'),
        ]);
        return response()->json([
            'hasError'=>false,
            'message'=>"Le compte".$request->get('libelle')." a été ajouté avec succes",
            'data'=> $compte]);
    }

    /**
     * Affiche les détails d'un compte donné.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $compte = Compte::where('id', $id)->first();

        if($compte == null){
            return response()->json([
            'hasError'=>true,
            'message'=>"Une erreur est survenue lors du traitement"
            ]);
        }
        return response()->json([
            'hasError'=>false,
            'message'=>$compte->libelle." retrouvé",
            'data'=> $compte
        ]);
    }

    /**
     * Modifie un compte existant
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $compte = Compte::where('id', $id)->first();

        $validator = Validator::make($request->all(),[
            'abonne_id'=>'required',
            'libelle'=>'required',
            'description'=>'required',
            'agence'=>'required',
            'banque'=>'required',
            'numero'=>'required',
            'rib'=>'required',
            'montant'=>'required',
            'domiciliation'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'hasError'=>true,
                'message'=>"Une erreur est survenue lors du traitement",
                'data'=> $validator->errors()->all()
            ]);
        }
        $compte->update([
            'abonne_id'=>$request->get('abonne_id'),
            'libelle'=>$request->get('libelle'),
            'description'=>$request->get('description'),
            'agence'=>$request->get('agence'),
            'banque'=>$request->get('banque'),
            'numero'=>$request->get('numero'),
            'rib'=>$request->get('rib'),
            'montant'=>$request->get('montant'),
            'domiciliation'=>$request->get('domiciliation'),
        ]);

        return response()->json([
            'hasError'=>false,
            'message'=>"Le compte ".$request->get('libelle')." modifié avec succes",
            'data'=> $compte
        ]);
    }

    /**
     * Supprime un compte de la bd.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compte = Compte::where('id', $id)->first();
        if($compte == null){
            return response()->json([
            'hasError'=>true,
            'message'=>"Une erreur est survenue lors du traitement: Compte ".$id." n'existe pas",
            ]);
        }
        $compte->delete();
        return response()->json([
            'hasError'=>false,
            'message'=>"Suppression effectuée avec succès",
            'data'=> null
        ]);
    }


    //Fonction qui renvoie les statistiques générales
    public function statisticGeneral(){
        $nombre_abonnes = Abonne::all()->count();
        $nombre_comptes = Compte::all()->count();
        $compte =  Compte::all()->select("*", DB::raw("sum('montant') as montant_total"));

        $comptes_abonnes = Abonne::join('comptes', 'comptes.abonne_id', '=', "abonnes.id")->get();
       if($comptes_abonnes == null){
           return response()->json([
           'hasError'=>true,
           'message'=>"Une erreur est survenue lors du traitement"
           ]);
       }
       return response()->json([
           'hasError'=>false,
           'message'=>"Statistiques générales",
           'data'=> [
               'Nombre d\'abonnées : '=>$nombre_abonnes,
               'Nombre de comptes : '=>$nombre_comptes,
               'Montant total : '=>$compte['montant_total'],
           ]
       ]);
   }
}
