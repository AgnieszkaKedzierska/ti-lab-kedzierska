<?php

require 'auth.php';

echo 'Witaj, ' . htmlspecialchars($_SESSION['uzytkownik']);
?>

<br>
<a href="wyloguj.php">Wyloguj</a>