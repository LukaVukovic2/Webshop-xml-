<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proizvodi</title>
    <style>
        .cijena{
            font-size: 25px;
            width: 150px;
            color: red;
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item active">
                        <a class="nav-link active" href="index.php">Naslovnica</a>
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
    <main>
        <section class="container mb-4">
            <h1 class="mt-4">Proizvodi</h1>
            <div class="row">
                <?php
                $xml = simplexml_load_file('proizvodi.xml');

                foreach ($xml->proizvod as $proizvod) {
                    $naziv = $proizvod->naziv;
                    $opis = $proizvod->opis;
                    $jamstvo = $proizvod->jamstvo;
                    $cijena = $proizvod->cijena;
                    $slika = 'slike/' . $proizvod->slika;
                    $id = $proizvod->id;
                ?>
                <div class="col-md-4 mt-4 mb-4">
                    <div class="card">
                    <a href="proizvod.php?id=<?php echo $id; ?>"><img class="card-img-top" src="<?php echo $slika; ?>" alt=""></a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $naziv; ?></h5>
                            <p class="card-text cijena"><?php echo $cijena; ?></p>
                            <button class="btn btn-info" onclick="addToCart(<?php echo $id; ?>, '<?php echo $naziv; ?>', '<?php echo $cijena; ?>')">Dodaj u košaricu</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
    <footer class="text-center bg-info pt-4 pb-4">
        xml projekt
    </footer>

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
