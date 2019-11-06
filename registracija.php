<?php
session_start();

// ako kod ne postoji redirekcija

if (!isset($_SESSION['kod'])){
    header('Location: reg.html');
    exit();
}

//Provera da li je dostavljena ispravna vrednost
if ($_SESSION['kod'] === (int) $_POST['kod'])
{
    unset($_SESSION['kod']);  
}
else{
    echo "Kod nije ispravan.";
        unset($_SESSION['kod']);  
    die(header('Location: reg.html'));
    
}
    $korisnicko_ime = $_POST['username'];
    $lozinka = $_POST['password'];
    $ponovljena_lozinka = $_POST['rep_password'];
    $salt = getSalt();
    $hes_lozinke = md5($lozinka.$salt);
    
    

    if ($lozinka == $ponovljena_lozinka) {
        if (strlen($lozinka) < 4) die("Lozinka mora biti duza od 3 karaktera");
        
        // obradi podatke i upisi u bazu
        require_once("config.php");
        
        $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // provera postojanja korisnika u bazi
        $sql = "SELECT * FROM User WHERE username = '$korisnicko_ime'";
        $result = $conn->query($sql);
                
        if ($result->num_rows>0) {
            // korisnik postoji
            die("Korisnik <b>$korisnicko_ime</b> vec postoji!");
        }
        else {
            // dodaj korisnika
            $sql = "INSERT INTO User (username, password, enabled, salt) VALUES('$korisnicko_ime', '$hes_lozinke', 'Y', '$salt')";
            $result = $conn->query($sql);
            echo "Korisnik je uspesno dodat u bazu!";
        }

    }
    else {
        die("<br>Lozinka <b>$lozinka</b> i ponovljena lozinka <b>$ponovljena_lozinka</b> moraju da se poklapaju!");
    }

function getSalt() {
     $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
     $randString = "";
     $randStringLen = 16;

     while(strlen($randString) < $randStringLen) {
         $randChar = substr(str_shuffle($charset), mt_rand(0, strlen($charset)), 1);
         $randString .= $randChar;
     }

     return $randString;
}

