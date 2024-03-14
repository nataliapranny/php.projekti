<?php
include_once 'config/db_config.php';
?>
<!DOCTYPE html>
<html lang="fi">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serverin kouluruokaäänestys - Kirjaudu sisään</title>
    <img src="vamklogo.png" alt="Kuva" class="logo">
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .screen__background {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        .screen__background__shape {
            position: absolute;
            transform: rotate(45deg);
        }
        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #FFAF58;	
            top: -50px;
            right: 120px;	
            border-radius: 0 72px 0 0;
            z-index: -1;
        }
        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            background: #A769C3;	
            top: -172px;
            right: 0;	
            border-radius: 32px;
        }
        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            background: linear-gradient(270deg, #6C5B91, #856FA2);
            top: -24px;
            right: 0;	
            border-radius: 32px;
        }
        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #7E7BB9;	
            top: 420px;
            right: 50px;	
            border-radius: 60px;
        }
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #FFAF58;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #FF9F33;
        }
        a {
            display: block;
            text-align: center;
            text-decoration: none;
            color: #A769C3;
            margin-top: 10px;
        }
        .logo {
            width: 150px; 
            height: auto; 
            position: absolute; 
            top: 10px; 
            left: 10px; 
            z-index: 999; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sisäänkirjautuminen onnistui!</h1>
        <h2>Tervetuloa!</h2>
        <form action="aanestys.php" method="post">
            <input type="submit" value="Äänestys">
        </form>
        <form action="https://kurnii.fi/" method="post">
            <input type="submit" value="Viikon ateriat">
        </form>
    </div>
    
            <div class="log-out">
				<h4><a href="uloskirjaus.php">Kirjaudu ulos</a></h4>
			</div>
           
            <div class="screen__background">
                <div class="screen__background__shape screen__background__shape1"></div>
                <div class="screen__background__shape screen__background__shape2"></div>
                <div class="screen__background__shape screen__background__shape3"></div>
                <div class="screen__background__shape screen__background__shape4"></div>
            
            </div>
    </div>
</body>
</html>
