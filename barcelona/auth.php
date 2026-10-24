<?php
session_start();

// Jezeli nie zalogowany – przekieruj na login
if (!isset($_SESSION["zalogowany"]) || $_SESSION["zalogowany"] !== true) {
    // Zapisz adres strony do ktorej chcial wejsc
    $_SESSION["redirect_after_login"] = $_SERVER["REQUEST_URI"];
    header("Location: login.php");
    exit;
}
