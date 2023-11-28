<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        background-color: #e13232;
        color: #fff;
        width: 30%;
        padding: 15px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }

    button:hover{
        background-color: #852828;
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
        <img id="check" src="{{URL::asset('img/cross.png')}}" alt="">
        <h2>Ha habido un problema. Es probable que el correo electrónico ingresado ya esté en uso.</h2>
        <button><a href="{{route('usuario.register')}}">Regresar</a></button>
    </div>
</body>
</html>