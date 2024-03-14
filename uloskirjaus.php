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
       
        h1 {
            text-align: center;
            color: #333;
        }

        h3 {
            text-align: center;
            color: #FFAF58;
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
        .login__field {
    margin-bottom: 20px;
}

.log-out label {
    display: block;
    margin-bottom: 5px;
}


.log-out input[type="submit"] {
    background-color: #FFAF58;
    color: #fff;
    cursor: pointer;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: none;
    border-radius: 5px;
}



    </style>
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h3>Uloskirjaus onnistui!</h3>
                
              
               
            </div>
            <div class="log-out">
				<h4><a href="index.php">Kirjaudu sisään</a></h4>
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
