<?php
session_start();

function isUserLoggedIn(){
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}
if (isset($_POST['naziv']) && isset($_POST['cijena'])) {
    $naziv = $_POST['naziv'];
    $cijena = $_POST['cijena'];

    $_SESSION['cart'][] = array(
        'naziv' => $naziv,
        'cijena' => floatval($cijena)
    );
    exit;
}
if (isset($_POST['ukloni'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}
if (isset($_POST['naruci'])) {
    if (isUserLoggedIn()) {
        $_SESSION['cart'] = array();
        echo "<script>alert('Uspješno obavljena narudžba');</script>";
    } else {
        header("Location: registracija.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košarica</title>
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
                        <a class="nav-link active" href="kosarica.php">Košarica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Račun</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <section class="container mt-4">
            <h2>Košarica</h2>
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $totalPrice = 0;
                foreach ($_SESSION['cart'] as $index => $item) {
                    $naziv = $item['naziv'];
                    $cijena = $item['cijena'];
                    if (is_numeric($cijena)) {
                        $totalPrice += floatval($cijena);
                    }
                    ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $naziv; ?></h5>
                            <p class="card-text">Cijena: <?php echo $cijena; ?> €</p>
                            <form action="kosarica.php" method="post">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="ukloni" class="btn btn-info">Ukloni</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <h4 class="mt-4">Ukupna cijena: <?php echo $totalPrice; ?> €</h4>
                <?php
            } else {
                ?>
                <p>Košarica je prazna.</p>
                <?php
            }
            
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 && isUserLoggedIn()) {
                ?>
                <form action="kosarica.php" method="post">
                    <button type="submit" name="naruci" class="btn btn-info">Naruči</button>
                </form>
                <?php
            } elseif (!isUserLoggedIn()) {
                ?>
                <p>Morate se prijaviti da biste mogli naručiti.</p> <a class="btn btn-primary" href="registracija.php">Registracija</a> <a class="btn btn-primary" href="prijava.php">Prijava</a>
                <?php
            }
            ?>
        </section>
    </main>
    <?php if(!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1){
    ?>
    <footer class="text-center bg-info pt-4 pb-4" style="position: fixed; bottom:0; width: 100%;">
        xml projekt
    </footer>
    <?php } 
        else{
            echo "<footer></footer>";
        }
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
