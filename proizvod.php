<?php
session_start();

if (isset($_GET['id'])) {
    $proizvodId = $_GET['id'];
    $xml = simplexml_load_file('proizvodi.xml');
    $proizvod = $xml->xpath("//proizvod[id='$proizvodId']");
    if ($proizvod) {
        $id = $proizvod[0]->id;
        $naziv = $proizvod[0]->naziv;
        $cijena = $proizvod[0]->cijena;
        $slika = 'slike/' . $proizvod[0]->slika;
        $opis = $proizvod[0]->opis;
        $jamstvo = $proizvod[0]->jamstvo;
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $naziv; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .cijena{
            font-size: 25px;
            width: 150px;
            color: red;
            margin-bottom: 10px;
        }
    </style>
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

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6">
                <img src="<?php echo $slika; ?>" alt="<?php echo $naziv; ?>" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <h2><?php echo $naziv; ?></h2>
                <p>Opis: <?php echo $opis; ?></p>
                <p>Jamstvo: <?php echo $jamstvo; ?></p>
                <div class="cijena">Cijena: <?php echo $cijena; ?></div>
                <button class="btn btn-primary" onclick="addToCart(<?php echo $id; ?>, '<?php echo $naziv; ?>', '<?php echo $cijena; ?>')">Dodaj u košaricu</button>
            </div>
        </div>
    </div>
    <footer>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function addToCart(id, naziv, cijena) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "kosarica.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Proizvod je dodan u košaricu!");
                }
            };
        var params = "id=" + encodeURIComponent(id) + "&naziv=" + encodeURIComponent(naziv) + "&cijena=" + encodeURIComponent(cijena);
        xhr.send(params);
        }
    </script>
</body>
</html>
