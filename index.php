<?php
include_once 'config/db_config.php';  // Sisällytetään tietokantatiedosto

session_start();  // Aloittaa istunnon

$access_denied_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Tarkistaa, onko pyyntö lähetetty POST-metodilla
    $conn = new mysqli($servername, $username, $password, $dbname);  // Luodaan uusi mysqli-yhteys tietokantaan

   // Tarkista yhteys
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['login'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['pswd'];

        $sql = "SELECT id, username, email, password FROM users_table WHERE email = ?";
        $stmt = $conn->prepare($sql);  // Valmistellaan SQL-lauseke
        $stmt->bind_param("s", $email);
        $stmt->execute(); // Suoritetaan SQL-kysely
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];

                header('Location: etusivu.php');
                exit;
            } else {
                $access_denied_error = "Access denied. Incorrect password.";
                echo "<script>alert('Access denied. Incorrect password.');</script>";
            }
        } else {
            $access_denied_error = "Access denied. User not found.";
            echo "<script>alert('Access denied. User not found.');</script>";
        }
        $stmt->close();  // Suljetaan valmisteltu lauseke
    }
    $conn->close(); // Suljetaan tietokantayhteys
}

?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serverin kouluruokaäänestys - Kirjaudu sisään</title>
    <img src="vamklogo.png" alt="Kuva" class="logo">
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

        
        #username,
        #password {
        width: 95%; 
         }


        form {
        margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="screen__background">
        <span class="screen__background__shape screen__background__shape4"></span>
        <span class="screen__background__shape screen__background__shape3"></span>		
        <span class="screen__background__shape screen__background__shape2"></span>
        <span class="screen__background__shape screen__background__shape1"></span>
    </div>	
    <div class="container">
        <h1>Serverin kouluruokaäänestys</h1>
        <form action="etusivu.php" method="post">
            <label for="username">Käyttäjätunnus:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Salasana:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Kirjaudu sisään">
        </form>
        <a href="uusikayttaja.php">Luo uusi käyttäjä</a>
    </div>
</body>
</html>
