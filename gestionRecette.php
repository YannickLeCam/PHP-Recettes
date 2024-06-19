<?php
if (isset($_POST['newRecette'])) {
    # code...
}


if (isset($_GET["from"])) {
    $provenance = $_GET["from"];
    header("Location:$provenance");
}
header("Location:./index.php");

?>