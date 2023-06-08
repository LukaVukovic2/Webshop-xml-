<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $username = $_POST['ime'];
    $lozinka = $_POST['pass'];

    $xml = simplexml_load_file('users.xml');
    $pronadenKorisnik = false;

    foreach ($xml->korisnik as $korisnik) {
        if ($username == (string) $korisnik->korisnickoIme && $lozinka == (string) $korisnik->lozinka) {
            $pronadenKorisnik = true;
            break;
        }
    }

    if ($pronadenKorisnik) {
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        $msg = "Uspješna prijava!";
        header('Location: index.php');
        exit();
    } else {
        $msg = "Pogrešno korisničko ime ili lozinka. Molimo pokušajte ponovno.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Naslovnica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kosarica.php">Košarica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Račun</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container mt-4">
        <h2>Prijava</h2>
        <form method="post">
            <label for="ime">Korisničko ime:</label><br>
            <input type="text" name="ime" required><br>
            <label for="pass">Lozinka:</label><br>
            <input type="password" name="pass" required><br>
            <input class="gumb btn-primary mt-2" type="submit" value="Pošalji">
        </form>
        <?php if (isset($msg)) : ?>
            <p style="color: red;"><?php echo $msg; ?></p>
        <?php endif; ?>
        <p>Nemate račun?</p>
        <a class="primary" href="registracija.php">Link za registraciju</a>
    </main>
    <footer class="text-center bg-info pt-4 pb-4" style="position: fixed; bottom:0; width: 100%;">
        xml projekt
    </footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
