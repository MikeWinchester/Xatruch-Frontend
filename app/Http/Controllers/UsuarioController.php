<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UsuarioController extends Controller
{

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function registerSuccess(){
        return view('register_success');
    }

    public function registerFailure(){
        return view('register_fail');
    }

    public function save(Request $req){

        $client = new Client();

        $newUser = [
            'nombre' => $req->input('nombre'),
            'apellido' => $req->input('apellido'),
            'correo' => $req->input('correo'),
            'contrasenia' => $req->input('contrasenia')
        ];

        $response = $client->post('http://localhost:8080/usuarios/crear', [
            'json' => $newUser,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        if($response->getBody() != ""){
            return redirect()->route('usuario.register.success');
        }

        return view('register');
    }

    public function home(Request $req){

        $client = new Client();

        $userAuth = [
            'correo' => $req->input('correo'),
            'contrasenia' => $req->input('contrasenia')
        ];
        
        $response = $client->post('http://localhost:8080/usuarios/login', [
            'json' => $userAuth,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $response2 = $client->get('http://localhost:8080/vuelos/obtener/todos');

        if($response->getBody() != ""){
            $usuarioActual = json_decode($response->getBody());
            $vuelos = json_decode($response2->getBody());
            return view('home', compact('usuarioActual'), compact('vuelos'));
        }
    }
}
