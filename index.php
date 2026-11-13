<?php
$firma = 'Szprycha';
$rok = date('Y');

$cennik = [
    ['nazwa' => 'Przegląd roweru', 'cena' => 120],
    ['nazwa' => 'Regulacja hamulców', 'cena' => 40],
    ['nazwa' => 'Regulacja przerzutek', 'cena' => 40],
    ['nazwa' => 'Wymiana opony lub dętki', 'cena' => 30],
    ['nazwa' => 'Centrowanie koła', 'cena' => 70],
    ['nazwa' => 'Smarowanie łańcucha', 'cena' => 20]
];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szprycha - serwis rowerowy</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
</head>
<body>

    <header class="site-header">
    <a class="logo" href="#">
    <svg
        viewBox="0 0 120 64"
        width="72"
        height="38"
        role="img"
        aria-labelledby="logo-tytul">

        <title id="logo-tytul">Logo rowerowe Szprycha</title>

        <circle
            cx="28"
            cy="42"
            r="18"
            fill="none"
            stroke="#a5dae5"
            stroke-width="5"
        />

        <circle
            cx="92"
            cy="42"
            r="18"
            fill="none"
            stroke="#a5dae5"
            stroke-width="5"
        />

        <polyline
            points="28,42 48,14 80,14 92,42"
            fill="none"
            stroke="white"
            stroke-width="5"
            stroke-linejoin="round"
        />

        <polyline
            points="48,14 60,42 80,14"
            fill="none"
            stroke="white"
            stroke-width="5"
            stroke-linejoin="round"
        />

    </svg>

    <span>Szprycha</span>
</a>

    <button
        class="menu-toggle"
        type="button"
        aria-expanded="false"
        aria-controls="menu-glowne">
        Menu
    </button>

    <nav class="menu" id="menu-glowne" aria-label="Menu główne">
        <a href="#uslugi">Usługi</a>
        <a href="#cennik">Cennik</a>
        <a href="#kontakt">Kontakt</a>
    </nav>
</header>

    <main>
        <h1>Serwis Rowerowy Szprycha</h1>

        
<section id="uslugi">
    <h2>Nasze usługi</h2>

    <div class="cards">

        <article class="card card--highlight">
            <p class="card__badge">Najczęściej wybierane</p>
            <h3>Przegląd roweru</h3>
            <p>
                Sprawdzamy stan techniczny roweru
                oraz regulujemy hamulce i przerzutki.
            </p>
            <p class="card__price">od 120 zł</p>
        </article>

        <article class="card">
            <h3>Regulacja hamulców</h3>
            <p>
                Regulujemy hamulce, aby zwiększyć skuteczność
                hamowania oraz zapobiec przedwczesnemu zużyciu
                klocków i szczęk hamulcowych roweru.
            </p>
            <p class="card__price">od 40 zł</p>
        </article>

        <article class="card">
            <h3>Wymiana opony</h3>
            <p>
                Wymieniamy opony i dętki
                oraz sprawdzamy stan kół, aby zoptymalizować
                przyczepność na drodze.
            </p>
            <p class="card__price">od 30 zł</p>
        </article>

    </div>
</section>

<section id="cennik">
    <h2>Cennik usług</h2>

    <table class="price-table">
        <thead>
            <tr>
                <th scope="col">Usługa</th>
                <th scope="col" class="num">Cena</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($cennik as $usluga): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($usluga['nazwa'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td class="num">
                        <?= $usluga['cena'] ?> zł
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

    </main>

    
<footer id="kontakt">
    <h2>Kontakt</h2>

    <p>Pracownia Rowerowa Szprycha</p>
    <p>Bydgoszcz, Polska</p>

    <p>
        Telefon:
        <a href="tel:+48777666555">777 666 555</a>
    </p>

    <p>
        E-mail:
        <a href="mailto:kontakt@szprycha.pl">
            kontakt@szprycha.pl
        </a>
    </p>

    <p>&copy; <?= $rok ?> <?= $firma ?></p>
</footer>

</body>
</html>
