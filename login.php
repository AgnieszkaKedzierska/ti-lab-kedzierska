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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logowanie</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Szprycha – logowanie</span>
        </div>
    </nav>

    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-4">

                <h1>Logowanie</h1>

                <?php if ($blad): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($blad) ?>
                    </div>
                <?php endif; ?>

                <form method="post">

                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" id="login" name="login" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="haslo" class="form-label">Hasło</label>
                        <input type="password" id="haslo" name="haslo" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Zaloguj</button>

                </form>
            </div>
        </div>
    </main>

</body>
</html>
