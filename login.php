<?php

session_start();

// Ponistiti prethodne bedzeve
$_SESSION = [];

// Proveriti da li su parametri ispravni (ako su uopste uneti)
if (isset($_POST['username'], $_POST['password']))
{
    $korisnicko_ime = $_POST['username'];
    $lozinka = $_POST['password'];
    
    
    
    require_once("config.php");
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        
    }
    $sql= ("SELECT salt FROM User WHERE username = '$korisnicko_ime'");
    $salt = $conn->query($sql)->fetch_object()->salt;

    

    $hes_lozinke = md5($lozinka.$salt);

    // autentikacija
    $sql = "SELECT * FROM User WHERE username = '$korisnicko_ime' AND password = '$hes_lozinke'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // korisnik je uneo ispravnu lozinku
        
        
            $_SESSION['korisnik'] = $korisnicko_ime;
            header('Location: index.php');
    }
    else die("Pogresno korisnicko ime ili lozinka");
}
else {
    die("Morate uneti korisnicko ime i lozinku!");
}
