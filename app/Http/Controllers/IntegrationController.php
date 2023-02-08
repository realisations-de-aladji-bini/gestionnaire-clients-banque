<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IntegrationController extends Controller
{
    public function getppl()
    {
        $response = Http::get('http://pplapi.com/random.json');
        $rep = $response->json();
        return $rep;
    }
    public function getRandomPeople()
    {
        $response = Http::get('http://pplapi.com/random.json');
        $wiki_rep = $response()->json();
        $wiki = Http::get('https://fr.wikipedia.org/w/api.php?action=query&titles='.$wiki_rep['county_name'].'&prop=extracts&exchars=500&explaintext&utf8&format=json
        ');
        $rep_wiki = $wiki->json([
            'name'=>$wiki->json()['title'],
            'info'=>$wiki->json()['query']['pages']
        ]);

        $rep = $response->json();
        return response()->json([
          
            'langue'=> $rep['language'],
            'genre'=>$rep['gender'],
           'religion'=>$rep['religion'],
            'pays'=> $rep['country_name'],
            'regions'=> $rep['age'],
            'Longitude'=>$rep['longitude'],
            'sex'=>$rep['sex'],
            'date_of_birth'=>$rep['date_of_birth'],
            'country'=> $rep_wiki    
        ]);                                         
    }
    //Impossible d'acceder à la ressource : GuzzleHttp\Exception\RequestException: cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://rawcdn.githack.com/kamikazechaser/administrative-divisions%02db/master/api/CI.json in file                        
    public function getAdminDivisionDB()
    {
        $response = Http::get('https://rawcdn.githack.com/kamikazechaser/administrative-divisionsdb/master/api/CI.json');
        return $response->json();
    }
}
