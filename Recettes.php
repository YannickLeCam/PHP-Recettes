<?php
ob_start();
$title = "Recettes";
?>

<h1>Le livre de Recettes</h1>

<div id="cardsBox">
    <div class="card">
    <img src="..." class="card-img-top" alt="...">

    <div class="card-body">
        <h5 class="card-title">Card title <span class="badge text-bg-secondary">Plat</span></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    </div>

    <div class="card">
    <img src="https://th.bing.com/th/id/OIP.avb9nDfw3kq7NOoP0grM4wHaEK?rs=1&pid=ImgDetMain" class="card-img-top" alt="...">

    <div class="card-body">
        <h5 class="card-title">Card title <span class="badge text-bg-secondary">Plat</span></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    </div>

    <div class="card">
    <img src="..." class="card-img-top" alt="...">

    <div class="card-body">
        <h5 class="card-title">Card title <span class="badge text-bg-secondary">Plat</span></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    </div>

    <div class="card">
    <img src="..." class="card-img-top" alt="...">

    <div class="card-body">
        <h5 class="card-title">Card title <span class="badge text-bg-secondary">Plat</span></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    </div>

    <div class="card">
    <img src="..." class="card-img-top" alt="...">

    <div class="card-body">
        <h5 class="card-title">Card title <span class="badge text-bg-secondary">Plat</span></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once './template.php';
?>