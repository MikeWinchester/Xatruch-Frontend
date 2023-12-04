<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

//URL para obtener informacion de los vuelos
define('userUrl', 'http://localhost:8080/usuarios');

//URL para obtener informacion de los asientos
define('seatUrl', 'http://localhost:8080/asientos');

//URL para obtener informacion de las escalas
define('scaleUrl', 'http://localhost:8080/escala/vuelo');

//URL para obtener informacion de las escalas
define('ticketUrl', 'http://localhost:8080/boletos/vuelo');

//Cliente de Guzzle
define('client', new Client());


class BoletoController extends Controller
{   
    //Peticion para obtener la vista de comprar el boleto
    public function buy($idUsuario, $idVuelo){

        //URL para obtener un usuario
        $userUrl = userUrl.'/obtener';

        //URL para obtener los asientos de un vuelo
        $seatUrl = seatUrl.'/obtener/vuelo';

        //URL para obtener las escalas de un vuelo
        $scaleUrl = scaleUrl.'/obtener';

        //Parametros de la peticion del usuario
        $requestParams = [
            'idUsuario'=>$idUsuario
        ];

        //Parametros de la peticion del vuelo
        $requestParams2 = [
            'idVuelo'=> $idVuelo
        ];

        //Se actualiza las URL de las peticiones con sus respectivos parametros
        $userUrl .= '?'.http_build_query($requestParams);
        $seatUrl .= '?'.http_build_query($requestParams2);
        $scaleUrl .= '?'.http_build_query($requestParams2);


        //Se guardan las respuestas de la peticion
        $response = client->get($userUrl);
        $response2 = client->get($seatUrl);
        $response3 = client->get($scaleUrl);

        //Las respuestas transformadas en arreglos asociativos
        $usuario = json_decode($response->getBody());
        $asientos = json_decode($response2->getBody());
        $escalas = json_decode($response3->getBody());

        //Se retorna la vista para comprar el boleto con el usuario, el vuelo, las escalas del vuelo y los asientos del vuelo
        return view('buy_ticket', compact('usuario', 'asientos', 'escalas'));
    }

        //Peticion para obtener la vista de comprar el boleto
        public function buySuccess($idUsuario, $idVuelo, $numeroAsiento){

            $seatUrl = seatUrl.'/obtener/vuelo/numero-asiento';

            $requestParams = [
                'idVuelo'=>$idVuelo,
                'numeroAsiento'=>$numeroAsiento
            ];

            $seatUrl .= '?'.http_build_query($requestParams);

            $response = client->get($seatUrl);
            $asiento = json_decode($response->getBody());

            $requestParams2 = [
                'idUsuario' => $idUsuario,
                'idAsiento' => $asiento->idAsiento
            ];

            $ticketUrl = ticketUrl.'/crear';
            $ticketUrl .= '?'.http_build_query($requestParams2);

            $response2 = client->post($ticketUrl);

            //URL para obtener un usuario
            $userUrl = userUrl.'/obtener';

            $requestParams3 = [
                'idUsuario'=>$idUsuario
            ];

            $userUrl .= '?'.http_build_query($requestParams3);

            $response = client->get($userUrl);

            $usuario = json_decode($response->getBody());

            return view('buy_success', compact('usuario'));
        }
}
