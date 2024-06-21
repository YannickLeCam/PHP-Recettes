<?php
ob_start();
require_once './Fonct/BDD_access.php';
require_once './Fonct/errorController.php';
if (isset($_GET['id_recipe'])) {
    
}else {
    redirection();
}


$title = "Home";
?>

<h1>Salmon Rift</h1>


<?php
$content = ob_get_clean();
require_once './template.php';
?>