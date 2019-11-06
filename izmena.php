<?php
    session_start();
    require_once("config.php");
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
    if($conn->connect_error){
        die("Connection failed: " .
        $conn->connect_error);
    }


   $ime = $_SESSION['korisnik'];
   $staraloz = mysqli_real_escape_string($conn, $_POST['stara']);
   $novaloz = mysqli_real_escape_string($conn, $_POST['nova']);

      $upit = "SELECT salt FROM User WHERE username = '$ime'";
      $rez = mysqli_query($conn,$upit);
      $row=mysqli_fetch_assoc($rez);

      $salt = $row['salt'];//salt u bazi

      $upit2 = "SELECT password FROM User WHERE username = '$ime'";
      $rez2 = mysqli_query($conn,$upit2);
      $row=mysqli_fetch_assoc($rez2);

      $pass = $row['password'];//hes stare lozinke u bazi

      $hes_loz = md5($staraloz.$salt);


      if($hes_loz == $pass){
          $hes_nova = md5($novaloz.$salt);;//hes nove lozinke

          $upit3 = "UPDATE User SET password = '$hes_nova' where username = '$ime' "; 
          $rez3 = mysqli_query($conn,$upit3);
          //$row = mysqli_num_rows($rez3);

          die("uspesno promenjena lozinka");

      }else
           {
          echo "pogresna lozinka";
      }


   
