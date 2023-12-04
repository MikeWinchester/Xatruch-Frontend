<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

define('userUrl', 'http://localhost:8080/usuarios');
define('flightUrl', 'http://localhost:8080/vuelos');
define('client', new Client());


class VueloController extends Controller
{
    public function cityFlights(Request $req, $idUsuario){

        $requestParams = [
            'origen'=>$req->input('origen'),
            'destino'=>$req->input('destino')
        ];

        $flightUrl = flightUrl.'/obtener/ciudades';
        $flightUrl .= '?'.http_build_query($requestParams);

        $response = client->get($flightUrl);
        $vuelos = json_decode($response->getBody());

        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userUrl = userUrl.'/obtener';
        $userUrl .= '?'.http_build_query($userRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());


        return view('home', compact('vuelos', 'usuario'));
    }
}
