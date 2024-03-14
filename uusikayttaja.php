<?php

include_once 'config/db_config.php';

session_start();

$access_denied_error = '';


// Luo yhteys tietokantaan
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteyden onnistuminen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = null;
// Tarkista, onko lomakkeen tiedot lähetetty POST-metodilla
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tarkista, onko lomakkeen tiedot lähetetty rekisteröitymistarkoituksessa
    if (isset($_POST['signup'])) {
        // Otetaan lomakkeen tiedot
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Valmistellaan SQL-lauseke käyttäjätietojen lisäämiseksi tietokantaan
        $sql = "INSERT INTO users_table (username, email, password) VALUES (?, ?, ?)";
        
        // Valmistellaan lauseke
        $stmt = $conn->prepare($sql);

        // Tarkista, että lauseke on valmisteltu oikein
        if ($stmt === false) {
            die("Error: " . $conn->error);
        }
        
        // Aseta parametrit ja suorita lauseke
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            // Rekisteröinti onnistui, ohjaa käyttäjä haluttuun sivulle
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_email'] = $email;
            header('Location: luotukayttaja.php');
            exit;
        } else {
            // Näytä virheilmoitus, jos rekisteröinti epäonnistui
            echo "Error: " . $stmt->error;
        }
    }
}

// Sulje SQL-lauseke ja tietokantayhteys
if ($stmt !== null) {
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fi">
    <head>
        <meta charset="utf-8">
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
            width: 90%; 
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

        h3 {
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

        .login__field {
    margin-bottom: 20px;
}

.login__field label {
    display: block;
    margin-bottom: 5px;
}

.login__field input[type="text"],
.login__field input[type="password"],
.login__field input[type="email"] {
    
    padding: 10px;
    margin-bottom: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 95%; 
}

.login__field input[type="submit"] {
    background-color: #FFAF58;
    color: #fff;
    cursor: pointer;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
}

.login__field input[type="submit"]:hover {
    background-color: #FF9F33;
}
.login__submit {
    background-color: #FFAF58;
    color: #fff;
    cursor: pointer;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
}

.login__submit:hover {
    background-color: #FF9F33;
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
    <h3>Luo uusi käyttäjä</h3>
    <form class="login" action="luotukayttaja.php" method="post">
        <div class="login__field">
            <label for="username">Käyttäjätunnus:</label>
            <input type="text" id="username" name="username" class="login__input" placeholder="Käyttäjätunnus" required>
        </div>
        <div class="login__field">
            <label for="email">Sähköposti:</label>
            <input type="email" id="email" name="email" class="login__input" placeholder="Sähköposti" required>
        </div>
        <div class="login__field">
            <label for="password">Salasana:</label>
            <input type="password" id="password" name="password" class="login__input" placeholder="Salasana" required>
        </div>
        <button class="button login__submit" type="submit">
            <span class="button__text">Luo uusi käyttäjä</span>
            <i class="button__icon fas fa-chevron-right"></i>
        </button>              
    </form>
</div>

		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>

</body>
</html>
