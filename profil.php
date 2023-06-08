<?php
session_start();
function isUserLoggedIn() {
    return isset($_SESSION['username']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: prijava.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Račun</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Naslovnica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kosarica.php">Košarica</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="profil.php">Račun</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="container mt-4">
            <?php if (isUserLoggedIn()): ?>
                <h1 class="mt-4">Dobrodošli, <?php echo $_SESSION['username']?>!</h1>
                <form action="profil.php" method="post">
                    <button type="submit" name="logout" class="btn btn-primary mt-4">Odjavi me</button>
                </form>
            <?php else: ?>
                <h2>Nemate račun još uvijek?</h2>
                <a class="btn btn-primary mt-4" href="registracija.php">Registracija</a>
                <a class="btn btn-primary mt-4" href="prijava.php">Prijava</a>
            <?php endif; ?>
        </section>
    </main>
    <footer class="text-center bg-info pt-4 pb-4" style="position: fixed; bottom:0; width: 100%;">
        xml projekt
    </footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
