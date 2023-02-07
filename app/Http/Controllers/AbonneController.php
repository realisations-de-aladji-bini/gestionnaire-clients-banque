<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonne;
use App\Models\Compte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class AbonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retourner la liste des abonnes
        return response()->json([
            'hasError'=>false,
            'message'=>"Liste abonnes",
            'data'=> Abonne::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required | unique:abonnes',
            'contact'=>'required',
            'active'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'hasError'=>true,
                'message'=>"Une erreur est survenue lors du traitement",
                'data'=> $validator->errors()->all()
            ]);
        }
        $abonne = Abonne::create([
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'email'=>$request->get('email'),
            'contact'=>$request->get('contact'),
            'active'=>$request->get('active')
        ]);

        return response()->json([
            'hasError'=>false,
            'message'=>$request->get('prenom')." a été ajouté avec succes",
            'data'=> $abonne]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $abonne = Abonne::where('id', $id)->first();

        if($abonne == null){
            return response()->json([
            'hasError'=>true,
            'message'=>"Une erreur est survenue lors du traitement"
            ]);
        }
        return response()->json([
            'hasError'=>false,
            'message'=>$abonne->nom."a été retrouvé",
            'data'=> $abonne
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $abonne = Abonne::where('id', $id)->first();

        $validator = Validator::make($request->all(),[
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required | unique:abonnes',
            'contact'=>'required',
            'active'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'hasError'=>true,
                'message'=>"Une erreur est survenue lors du traitement",
                'data'=> $validator->errors()->all()
            ]);
        }
        $abonne->update([
            'nom'=>$request->get('nom'),
            'prenom'=>$request->get('prenom'),
            'email'=>$request->get('email'),
            'contact'=>$request->get('contact'),
            'active'=>$request->get('active')
        ]);

        return response()->json([
            'hasError'=>false,
            'message'=>$request->get('nom')." a été ajouté avec succes",
            'data'=> $abonne
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $abonne = Abonne::where('id', $id)->first();
        if($abonne == null){
            return response()->json([
            'hasError'=>true,
            'message'=>"Une erreur est survenue lors du traitement: Abonne".$id."n'existe pas",
            ]);
        }
        $abonne->delete();
        return response()->json([
            'hasError'=>false,
            'message'=>"Suppression effectuée avec succès",
            'data'=> null
        ]);
    }

    //Fonction qui renvoie la liste des abonnées avec leurs comptes respectifs
    public function comptesAbonnes(){

         $comptes_abonnes = DB::table('comptes')->join('abonnes', 'comptes.abonne_id', '=', 'abonnes.id')
         ->groupBy('abonne_id')
         ->get();
        if($comptes_abonnes == null){
            return response()->json([
            'hasError'=>true,
            'message'=>"Une erreur est survenue lors du traitement"
            ]);
        }
        return response()->json([
            'hasError'=>false,
            'message'=>"Abonnés avec leurs comptes",
            'data'=> $comptes_abonnes
        ]);
    }

   //Fonction qui renvoie les détails d'un abonné avec ses comptes
    public function detailsComptesAbonne($id){

        $comptes_abonne = Abonne::join('comptes', 'comptes.abonne_id', '=', 'abonnes.id')->where('abonnes.id', $id)->get();
        if($comptes_abonne == null){
            return response()->json([
            'hasError'=>true,
            'message'=>"Une erreur est survenue lors du traitement"
            ]);
        }
        return response()->json([
            'hasError'=>false,
            'message'=>"Comptes  retrouvés",
            'data'=> $comptes_abonne
        ]);
    }
    //Fonction qui lie un abonné à un compte

    public function lierCompteAbonne(Request $request){
        $compte = Compte::where('id', $request->get('compteId'))->first();
            if($compte == null){
                        return response()->json([
                        'hasError'=>true,
                        'message'=>"Une erreur est survenue lors du traitement"
                        ]);
                }

        $compte ->update(['abonne_id'=>$request->get('abonneId')]);
                return response()->json([
                        'hasError'=>false,
                        'message'=>"Compte ".$compte->libelle." lié",
                        'data'=> $compte
                ]);
    }
     //Fonction qui renvoie les statistiques d'un abonné
     public function statisticAbonne($id){


        $comptes_abonne = Abonne::join('comptes', 'comptes.abonne_id', '=', 'abonnes.id')
                        ->where('comptes.abonne_id',$id)
                        ->groupBy('comptes.abonne_id')
                        ->select('abonnes.*', DB::raw('SUM(comptes.montant) as montant_total'),DB::raw('count(*) as total_comptes'), )
                        ->get();
       if($comptes_abonne == null){
           return response()->json([
           'hasError'=>true,
           'message'=>"Une erreur est survenue lors du traitement"
           ]);
       }
       return response()->json([
           'hasError'=>false,
           'message'=>"Statistiques générales",
           'data'=> [
               'Abonné :' =>$comptes_abonne['nom'].' '.$comptes_abonne['prenom'],
               'Nombre de comptes :'=>$comptes_abonne['total_comptes'],
               'Montant total :'=>$comptes_abonne['montant_total'],
           ]
       ]);
   }
}
