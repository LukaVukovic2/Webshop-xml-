<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $xml = simplexml_load_file('users.xml');
    $usernames = [];
    foreach ($xml->korisnik as $korisnik) {
        $usernames[] = (string) $korisnik->korisnickoIme;
    }

    $zeljenoIme = $_POST['korisnickoIme'];
    if (in_array($zeljenoIme, $usernames)) {
        $msg = "Korisničko ime je zauzeto!<br>";
    } else {
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $lozinka = $_POST['pass'];
        $noviKorisnik = $xml->addChild('korisnik');
        $noviKorisnik->addChild('ime', $_POST['ime']);
        $noviKorisnik->addChild('prezime', $_POST['prezime']);
        $noviKorisnik->addChild('korisnickoIme', $zeljenoIme);
        $noviKorisnik->addChild('lozinka', $_POST['pass']);
    
        $xml->asXML('users.xml');
        $msg = "Registracija je uspješna!";
        $_SESSION['username'] = $zeljenoIme; // Set the username in the session
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
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
            <h2>Registracija</h2>
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-item">
                    <label for="ime">Ime: </label>
                    <div class="form-field">
                        <input type="text" name="ime" id="ime" class="form-field-textual" required>
                    </div>
                </div>
                <div class="form-item">
                    <label for="prezime">Prezime: </label>
                    <div class="form-field">
                        <input type="text" name="prezime" id="prezime" class="form-field-textual" required>
                    </div>
                </div>
                <div class="form-item">
                    
                    <label for="korisnickoIme">Korisničko ime:</label>
                    <div class="form-field">
                        <input type="text" name="korisnickoIme" id="username" class="form-field-textual" required>
                    </div>
                </div>
                <div class="form-item">
                    <label for="pass">Lozinka: </label>
                    <div class="form-field">
                        <input type="password" name="pass" id="pass" class="form-field-textual" required>
                    </div>
                </div>
                <div class="form-item">
                    <button type="submit" class="gumb btn-primary mt-2" value="Registracija" id="slanje">Registracija</button>
                </div>
                <span id="porukaUsername" class="bojaPoruke"><?php echo isset($msg) ? $msg : ''; ?></span>
            </form>

            <br>
            <p>Već imate račun?</p>
            <a class="gumb" href="prijava.php">Prijava</a>
        </main>
        <footer class="text-center bg-info pt-4 pb-4" style="position: fixed; bottom:0; width: 100%;">
            xml projekt
        </footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
