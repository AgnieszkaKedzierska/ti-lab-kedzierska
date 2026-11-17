<?php

require __DIR__ . '/baza.php';

$pdo->exec('
    CREATE TABLE IF NOT EXISTS uslugi (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nazwa TEXT NOT NULL,
        cena INTEGER NOT NULL
    )
');

$pdo->exec('
    CREATE TABLE IF NOT EXISTS uzytkownicy (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        login TEXT NOT NULL UNIQUE,
        haslo_hash TEXT NOT NULL
    )
');

if ($pdo->query('SELECT COUNT(*) FROM uslugi')->fetchColumn() == 0) {

    $cennik = [
        ['Przegląd roweru', 120],
        ['Regulacja hamulców', 40],
        ['Regulacja przerzutek', 40],
        ['Wymiana opony lub dętki', 30],
        ['Centrowanie koła', 70]
    ];

    $z = $pdo->prepare(
        'INSERT INTO uslugi (nazwa, cena)
        VALUES (?, ?)'
    );

    foreach ($cennik as $usluga) {
        $z->execute($usluga);
    }
}

if ($pdo->query('SELECT COUNT(*) FROM uzytkownicy')->fetchColumn() == 0) {

    $haslo = getenv('SZPRYCHA_ADMIN_PASSWORD');
    }

if ($pdo->query('SELECT COUNT(*) FROM uzytkownicy')->fetchColumn() == 0) {

    $z = $pdo->prepare(
        'INSERT INTO uzytkownicy (login, haslo_hash)
        VALUES (:login, :hash)'
    );

    $z->execute([
        'login' => 'admin',
        'hash' => password_hash('Szprycha!2026', PASSWORD_DEFAULT)
    ]);
}

echo 'Baza gotowa.';