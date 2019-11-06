<?php
    session_start();
    // Ponistavanje sesije
    $_SESSION = [];
    die(header('Location: login.html'));
