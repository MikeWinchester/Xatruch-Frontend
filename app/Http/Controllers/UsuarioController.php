<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

define('userUrl', 'http://localhost:8080/usuarios');
define('flightUrl', 'http://localhost:8080/vuelos');
define('ticketUrl', 'http://localhost:8080/boletos/vuelo');

define('client', new Client());

class UsuarioController extends Controller
{   

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function edit(Request $req, $idUsuario){

        $userUrl = userUrl.'/obtener';
        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userUrl .= '?'.http_build_query($userRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());

        $updatedUser = [
            'nombre' => $req->input('nombre'),
            'apellido' => $req->input('apellido'),
            'correo' => $req->input('correo'),
            'contrasenia' => $req->input('contrasenia')
        ];

        return view('edit', compact('usuario', 'updatedUser'));
    }

    public function updateSuccess(Request $req,$idUsuario){

        $updatedUser = [
            'nombre' => $req->input('nombre'),
            'apellido' => $req->input('apellido'),
            'correo' => $req->input('correo'),
            'contrasenia' => $req->input('contrasenia')
        ];

        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];

        $userResponse = client->put(userUrl.'/actualizar', [
            'query'=> $userRequestParams,
            'json' => $updatedUser,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $userUrl = userUrl.'/obtener';
        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userUrl .= '?'.http_build_query($userRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());

        return view('update_success', compact('usuario'));
    }

    public function delete($idUsuario){
        $userUrl = userUrl.'/obtener';
        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userUrl .= '?'.http_build_query($userRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());

        return view('delete', compact('usuario'));
    }

    public function deleteSuccess($idUsuario){
        $userUrl = userUrl.'/obtener';
        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userUrl .= '?'.http_build_query($userRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());

        $userUrl2 = userUrl.'/eliminar';
        $userUrl2 .= '?'.http_build_query($userRequestParams);
        $userResponse2 = client->delete($userUrl2);

        return view('delete_success', compact('usuario'));
    }

    public function account($idUsuario){
        $userUrl = userUrl.'/obtener';
        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userUrl .= '?'.http_build_query($userRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());

        return view('account', compact('usuario'));
    }

    public function flights($idUsuario){

        $ticketURL = ticketUrl.'/obtener/todos';
        $ticketRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $ticketURL .= '?'.http_build_query($ticketRequestParams);
        $ticketResponse = client->get($ticketURL);
        $boletosDeUsuario = json_decode($ticketResponse->getBody());

        $userUrl = userUrl.'/obtener';
        $userUrl .= '?'.http_build_query($ticketRequestParams);
        $userResponse = client->get($userUrl);
        $usuario = json_decode($userResponse->getBody());

        return view('user_flights', compact('boletosDeUsuario', 'usuario'));
    }

    public function homeScreen($idUsuario){

        $userURL = userUrl.'/obtener';
        $flightURL = flightUrl.'/obtener/todos';
        $userRequestParams = [
            'idUsuario'=>$idUsuario
        ];
        $userURL .= '?'.http_build_query($userRequestParams);
        
        $userResponse = client->get($userURL);
        $flightResponse = client->get($flightURL);

        $usuario = json_decode($userResponse->getBody()); 
        $vuelos = json_decode($flightResponse->getBody());

        return view('home', compact('usuario', 'vuelos'));
    }

    public function registerSuccess(){
        return view('register_success');
    }

    public function save(Request $req){

        $newUser = [
            'nombre' => $req->input('nombre'),
            'apellido' => $req->input('apellido'),
            'correo' => $req->input('correo'),
            'contrasenia' => $req->input('contrasenia')
        ];

        $userResponse = client->post(userUrl.'/crear', [
            'json' => $newUser,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        if($userResponse->getBody() != ""){
            return redirect()->route('usuario.register.success');
        }

        return view('register');
    }


    public function home(Request $req){

        $userAuth = [
            'correo' => $req->input('correo'),
            'contrasenia' => $req->input('contrasenia')
        ];
        
        $userResponse = client->post(userUrl.'/login', [
            'json' => $userAuth,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $flightResponse = client->get(flightUrl.'/obtener/todos');
 
        if($userResponse->getBody() != ""){
            $usuario = json_decode($userResponse->getBody());
            $vuelos = json_decode($flightResponse->getBody());

            return view('home', compact('usuario','vuelos'));
        }
    }
}
