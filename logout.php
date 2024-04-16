<?php
// aloitetaan sessio
session_start();

// tyhjennetään sessiomuuttujat
$_SESSION = array();

// lopetetaan sessio
session_destroy();

// ohjataan käyttäjä takaisin kirjautumissivulle
header("Location: login.php");
exit();
?>