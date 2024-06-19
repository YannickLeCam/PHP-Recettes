<?php
ob_start();
$title = "Home";
?>

<h1>Salmon Rift</h1>


<?php
$content = ob_get_clean();
require_once './template.php';
?>