<?php
include_once 'config/db_config.php';   // Sisällytetään tietokantatiedosto

$kusername = $_POST['username'];
$kemail = $_POST['email'];
$kpassword = $_POST['password'];


// Lisää tuo $sql lauseke tietokantaan
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteys
if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

// Valmistellaan SQL-lauseke käyttäjätietojen lisäämiseksi tietokantaan
$kusername = mysqli_real_escape_string($conn, $kusername);
$kemail = mysqli_real_escape_string($conn, $kemail);
$kpassword = mysqli_real_escape_string($conn, $kpassword);
$sql = "INSERT INTO users_table (username, email, password) VALUES ('$kusername','$kemail','$kpassword')";

// Suorita SQL-lause
if ($conn->query($sql) === TRUE) {
    echo '<div class="message-box"><h5>Käyttäjätiedot lisättiin onnistuneesti</h5></div>';
} else {
    echo '<div class="message-box"><h5>Virhe: ' . $sql . '<br>' . $conn->error . '</h5></div>';
}

// Suljetaan tietokantayhteys
$conn->close();

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

        .message-box {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: #ffffff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Käyttäjätilin luominen onnistui!</h1>
        <h2>Tervetuloa!</h2>
        <form action="etusivu.php" method="post">
            <input type="submit" value="Etusivu">
        </form>
        
        <form action="uloskirjaus.php" method="post">
            <input type="submit" value="Kirjaudu ulos">
        </form>
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
