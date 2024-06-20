<?php
session_start();
require_once 'Fonct/errorController.php';
require_once 'Fonct/BDD_access.php';
var_dump($_POST);
die();

function uploadImg($file){
    
}


if (isset($_POST['submit'])) {
    /**
     * Verification de la présence des attributs OBLIGATOIRE
     */
    if (isset($_POST['nameRecette'])) {
       $nameRecette = htmlentities($_POST['nameRecette']);
    }else {
        setMessage("error","Nom de la Recette manquant . . .");
        redirection();
    }
    if (isset($_POST['timeCook'])) {
        $timeCook = filter_input(INPUT_POST,"timeCook",FILTER_VALIDATE_INT);
        if ($timeCook<0 && $timeCook>3600) {
            setMessage("error","Le temps de préparation semble etre invalide");
        }
    }else {
        setMessage("error","Le temps de préparation manquant . . .");
        redirection();
    }
    if (isset($_POST['typeMeal'] )|| $_POST['typeMeal']==0) {
        $typeMeal = filter_input(INPUT_POST,"typeMeal",FILTER_VALIDATE_INT);
        if (!inBDDTypeMeal($mysqlClient , $typeMeal)) {
            setMessage("error","La catégorie de repas semble être invalide . . .");
            redirection();
        }

    }else {
        setMessage("error","La catégorie de repas est manquant . . .");
        redirection();
    }
    if (isset($_POST['instructions'])) {
        $instructions = htmlentities($_POST['instructions']);
        if ($instructions == "") {
            setMessage("error","Il semble manquer des instructions . . .");
            redirection();
        }
    }else {
        setMessage("error","Il semble manquer des instructions . . .");
        redirection();
    }

    /**
     * Verification du fichier
     */
    if (isset($_FILES['file'])) {
        if (!empty($_FILES['file']['error'])) {
            setMessage("error","Erreur dans l'upload de l'image \n".$_FILES['file']["error"]);
            $image=null;
        }else{
            $image=uploadImg($_FILES['file']);
        }
        
    }else {
        $image=null;
    }
}


redirection();

?>