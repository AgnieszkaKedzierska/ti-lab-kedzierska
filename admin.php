<?php

require 'auth.php';
require 'baza.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $akcja = $_POST['akcja'] ?? '';

    if ($akcja === 'dodaj') {
        $nazwa = trim($_POST['nazwa'] ?? '');
        $cena = (int) ($_POST['cena'] ?? 0);

        if ($nazwa !== '' && $cena > 0) {
            $z = $pdo->prepare(
                'INSERT INTO uslugi (nazwa, cena) VALUES (:nazwa, :cena)'
            );

            $z->execute(['nazwa' => $nazwa, 'cena' => $cena]);

            header('Location: admin.php?ok=dodano');
            exit;
        }
    }
}

$uslugi = $pdo->query(
    'SELECT id, nazwa, cena FROM uslugi ORDER BY nazwa'
)->fetchAll();

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
</head>
<body>

    <h1>Panel administratora</h1>

    <p>Witaj, <?= htmlspecialchars($_SESSION['uzytkownik']) ?></p>


    <?php if (($_GET['ok'] ?? '') === 'dodano'): ?>
        <p>Dodano usługę.</p>
    <?php endif; ?>

    <h2>Lista usług</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena (zł)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uslugi as $usluga): ?>
                <tr>
                    <td><?= $usluga['id'] ?></td>
                    <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                    <td><?= $usluga['cena'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Dodaj usługę</h2>

    <form method="post">
        <input type="hidden" name="akcja" value="dodaj">

        <label for="nazwa">Nazwa</label>
        <input id="nazwa" name="nazwa" required maxlength="100">

        <label for="cena">Cena (zł)</label>
        <input id="cena" name="cena" type="number" min="1" required>

        <button>Dodaj</button>
    </form>

<br>
 <a href="wyloguj.php">Wyloguj</a>

</body>
</html>
