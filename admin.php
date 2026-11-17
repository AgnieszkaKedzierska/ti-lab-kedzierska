
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

           $_SESSION['komunikat'] = 'Usługa dodana.';
            header('Location: admin.php');
            exit;       
        }
    }

    if ($akcja === 'usun') {
        $z = $pdo->prepare('DELETE FROM uslugi WHERE id = :id');
        $z->execute(['id' => (int) $_POST['id']]);

        $_SESSION['komunikat'] = 'Usługa usunięta.';
        header('Location: admin.php');
        exit;
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel administratora</title>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Szprycha – panel administratora</span>
            <a href="wyloguj.php" class="btn btn-outline-light">Wyloguj</a>
        </div>
    </nav>

    <main class="container py-4">

        <h1>Witaj, <?= htmlspecialchars($_SESSION['uzytkownik']) ?></h1>

        <?php if (isset($_SESSION['komunikat'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['komunikat']) ?>
            </div>
            <?php unset($_SESSION['komunikat']); ?>
        <?php endif; ?>

        <div class="row">

            <div class="col-lg-8">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Usługa</th>
            <th>Cena</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($uslugi as $usluga): ?>
            <tr>
                <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                <td><?= $usluga['cena'] ?> zł</td>
                <td>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="akcja" value="usun">
                        <input type="hidden" name="id" value="<?= (int) $usluga['id'] ?>">
                        <button class="btn btn-sm btn-outline-danger">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
            </div>

            <div class="col-lg-4">
            
                <form method="post">
                    <input type="hidden" name="akcja" value="dodaj">

                    <div class="mb-3">
                        <label for="nazwa" class="form-label">Nazwa usługi</label>
                        <input id="nazwa" name="nazwa" class="form-control" required maxlength="100">
                    </div>

                    <div class="mb-3">
                        <label for="cena" class="form-label">Cena (zł)</label>
                        <input id="cena" name="cena" type="number" min="1" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Dodaj</button>
                </form>
            </div>

        </div>
    </main>

</body>
</html>
