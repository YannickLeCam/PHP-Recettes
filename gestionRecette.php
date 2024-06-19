<?php
var_dump($_POST);
die();
if (isset($_POST['submit'])) {
    
}


if (isset($_GET["from"])) {
    $provenance = $_GET["from"];
    header("Location:$provenance");
}else {
    header("Location:./index.php");
}


?>