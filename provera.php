<?php

session_start();

// ako kod ne postoji redirekcija
if (!isset($_SESSION['kod']))
{
    header('Location: formular.html');
    exit();
}

// Provera da li je dostavljena ispravna vrednost
if ($_SESSION['kod'] === (int) $_GET['kod'])
{
    unset($_SESSION['kod']);
    echo "kod je ispravan";
}
else
{
    echo "kod nije ispravan";
}
