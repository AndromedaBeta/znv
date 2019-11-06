<?php
  session_start();

    if (!isset($_SESSION['korisnik'])) die ("Pristup odbijen");

       //echo file_get_contents("view/zasticeno.html");
?>
<html>
    <body>
        STROGO POVERLJIVO!
        <br>
        <a href="izmena.html">Promeni sifru</a>
        <br>
        <a href="logout.php">Odloguj me</a>
    </body>
</html>
