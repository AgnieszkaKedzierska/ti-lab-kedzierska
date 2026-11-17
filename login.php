<?php

session_start();
require 'baza.php';

$blad = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $z = $pdo->prepare(
        'SELECT login, haslo_hash FROM uzytkownicy WHERE login = :login');

    $z->execute(['login' => trim($_POST['login'] ?? '')]);
    $u = $z->fetch();

    if ($u && password_verify($_POST['haslo'] ?? '', $u['haslo_hash'])) {
        session_regenerate_id(true);
        $_SESSION['uzytkownik'] = $u['login'];
        header('Location: admin.php'); exit;
    }

    $blad = 'Błędny login lub hasło.';
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>

    <h1>Logowanie</h1>

    <?php if ($blad): ?>
        <p><?= htmlspecialchars($blad) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Login:
            <input type="text" name="login" required>
        </label>
    <br>
        <label>Hasło:
            <input type="password" name="haslo" required>
        </label>
    
    <br>
        <button type="submit">Zaloguj</button>
    
    </form>

</body>
</html>