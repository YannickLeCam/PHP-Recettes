<?php
$mainColor="#ffa07a";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: <?=$mainColor?>;">   
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">Salmoner Rift</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link <?=$title=="Home" ? "active" : ""?>" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?=$title=="Recettes" ? "active" : ""?>" href="./Recettes.php">Recettes</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?=$title=="Nouvelle Recette" ? "active" : ""?>" href="./NewRecette.php">Nouvelle Recette</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        $_SESSION=[];
        echo <<<HTML
        <div class="alert alert-success" role="alert">
            $msg
        </div>
HTML;
    }
    if (isset($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        $_SESSION=[];
        echo <<<HTML
        <div class="alert alert-danger" role="alert">
            $msg
        </div>
HTML;
    }
    ?>
    <?=$content?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>
</html>