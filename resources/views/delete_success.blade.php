<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xatruch Airlines | Registro</title>
    <link rel="stylesheet" href="">
</head>
<style>
    body{
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: rgb(245, 245, 245);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    #check{
        width: 300px; 
    }

    #check-cont{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    
    button{
        background-color: #5144b1;
        color: #fff;
        width: 30%;
        padding: 15px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }

    button:hover{
        background-color: #332885;
        transition: all .1s ease-in;
    }

    button a{
        text-decoration: none;
        color: white;
        font-weight: bold;
    }
</style>
<body>
    <div id="check-cont">
        <img id="check" src="{{URL::asset('img/check.png')}}" alt="">
        <h1>Tu cuenta se ha eliminado exitosamente.</h1>
        <button><a href="{{route('usuario.login')}}">Entendido</a></button>
    </div>
</body>
</html>