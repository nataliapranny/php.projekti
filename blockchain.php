<?php

include_once 'config/db_config.php';

echo "<h2>Äänestystulokset</h2>";

session_start();

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';

$lname = $_POST['name'];
$lschool = $_POST['school'];
$lfood = $_POST['food'];

echo $lname . "<br>";
echo $lschool . "<br>";
echo $lfood . "<br>";


// Yhdistetään tietokantaan
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Haetaan viimeisimmän lohkon nykyinen hash
$sql = "SELECT current_hash FROM projekti1_table ORDER BY block_index DESC LIMIT 1";
$result = $conn->query($sql);

// Alustetaan edellinen hash olemassa olevien lohkojen perusteella tai aseta oletusarvo
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $previous_hash = $row['current_hash'];
} else {
   // Jos olemassa olevia lohkoja ei ole, aseta alkuarvo (genesishash)
    $previous_hash = 'genesis_hash';  
}


// Haetaan syötetty data
$sql = "SELECT MAX(block_index) AS max_index FROM projekti1_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $block_index = $row['max_index'] + 1;
} else {
   // Jos olemassa olevia lohkoja ei ole, aseta lohkon indeksi 1:ksi
    $blockchain_index = 1;
}

$timestamp = date("Y-m-d H:i:sa");
$voter = $_SESSION['user_name']; 
$votes = $_POST['votes'];


// Lasketaan nykyinen hash
$current_hash = hash("sha256", $block_index . $timestamp . $previous_hash . $data . $votes . $voter);

// Lisätään tiedot tietokantaan
$sql = "INSERT INTO projekti1_table (block_index, timestamp, previous_hash, current_hash, data, voter, votes)
        VALUES ('$block_index', '$timestamp', '$previous_hash', '$current_hash', '$data', '$voter', '$votes')";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

echo "<div style='margin-top: 40px; padding: 10px; background-color: #d8bfd8; border: 1px solid #3c763d; color: #3c763d;'>";
echo "Kiitos, $user_name! Äänesi on rekisteröity onnistuneesti.";
echo "</div>";
echo "<br><br>";

// Haetaan ja näytetään lohkoketju tietokannasta
$sql2 = "SELECT block_index, timestamp, data, previous_hash, current_hash, voter, votes FROM projekti1_table";
$result2 = $conn->query($sql2);


echo "<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #f5f5f5;
    overflow-x: auto;
    display: block;
    border: 1px solid #ddd;
}


    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        white-space: nowrap;
        text-align: left;
        max-width: 500px;
        box-sizing: border-box;
    }

    td {
        font-size: 13px;
    }

    th {
        background-color: #FFAF58;
        min-width: 105px;
        box-sizing: border-box;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    h1{
        text-align:center;
        color:#9370DB;
        font-size: 32px;
    }

    h2{
        text-align:center;
        color:#6C5B91;
        font-size: 32px;
    }

    .logo {
        width: 150px; 
        height: auto; 
        position: absolute; 
        top: 10px; 
        left: 10px; 
        z-index: 999; 
    }

    a {
        display: block;
        text-align: center;
        text-decoration: none;
        color: #A769C3;
        margin-top: 10px;
    }
</style>";

// Näytetään lohkoketjun tiedot taulukossa
echo "<table border='1'>";
echo "<tr>
        <th>Block Index</th>
        <th>Timestamp</th>
        <th>Previous Hash</th>
        <th>Current Hash</th>
        <th>Voter</th>
        <th>Votes</th>
      </tr>";

while ($row = mysqli_fetch_array($result2)) {
    echo "<tr>";
    echo "<td>" . $row['block_index'] . "</td>";
    echo "<td>" . $row['timestamp'] . "</td>";
    echo "<td>" . $row['previous_hash'] . "</td>";
    echo "<td>" . $row['current_hash'] . "</td>";
    echo "<td>" . $row['voter'] . "</td>";
    echo "<td>" . $row['votes'] . "</td>";
    echo "</tr>";
}

echo "</table>";

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
</head>
<body>
<div class="log-out">
    <h4><a href="uloskirjaus.php">Kirjaudu ulos</a></h4>
</div>
</body>
</html>
