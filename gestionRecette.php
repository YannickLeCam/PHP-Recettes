<?php
session_start();
require_once 'Fonct/errorController.php';
require_once 'Fonct/BDD_access.php';
var_dump($_POST);
die();

function uploadImg($file){
    $tmp_name=$file['tmp_name'];
    $name = $file['name'];
    $size = $file['size'];

    //image trop grosse
    if ($size > 400000) {
        setMessage('error',"L'image est trop grosse . . .");
        return null;
    }
    $tabExtensionValide = ["jpeg", "png", "svg", "jpg", "gif", "bmp", "webp"];
    $extension=explode(".",$name);
    $extension=strtolower(end($extension));
    //Si l'extension du fichier n'est pas dans les valide on l'exclue directement
    if (!in_array($extension,$tabExtensionValide)) {
        setMessage('error',"Erreur sur l'extension du fichier envoyer nous reprenons que les format jpeg, png , svg ou jpg . . .");
        return null;
    }else {
        // ici la fichier on est sur que c'est une image
        $imageLocation = "./AssetRecipeImg/".$name;
        move_uploaded_file($tmp_name,$imageLocation);
        return $imageLocation;
    }
    setMessage("error","Erreur inconnue sur image dans la fonction verificationImage . . .");
    return null; //Si l'image a eu un pb un endroit car il n'a pas passé tout les tests il se retrouve ici (Juste sécurité).
}


if (isset($_POST['submit'])) {
    /**
     * Verification de la présence des attributs OBLIGATOIRE
     */
    if (isset($_POST['nameRecette'])) {
       $nameRecette = htmlentities($_POST['nameRecette']);

       if ($nameRecette=="") {
            setMessage("error","Nom de la Recette manquant . . .");
            redirection();
       }
    }else {
        setMessage("error","Nom de la Recette manquant . . .");
        redirection();
    }
    if (isset($_POST['timeCook'])) {
        $timeCook = filter_input(INPUT_POST,"timeCook",FILTER_VALIDATE_INT);
        if ($timeCook<1 && $timeCook>3600) {
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
     * file checking if invalid/no image then $image ==null
     * don't forgot to add recipe image attribute
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
    /**
     * Ingredients checking
     */
    if (isset($_POST['ingredient'])) {
        if (isset($_POST['ingredient']['id']) && isset($_POST['ingredient']['qtt'])) {
            if (count($_POST['ingredient']['id'])!=count($_POST['ingredient']['qtt'])) {
                setMessage('error','Une quantité ou un ingrédient semble avoir été oublié . . .');
                redirection();
            }else {
                $ingredients=[];
                foreach ($_POST['ingredient']['id'] as $key => $value) {
                    $ingredients[$key]['id']=(int) $_POST['ingredient']['id'][$key]; //A DEMANDER A MICKAEL COMMENT UTILISER FILTER-INPUT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                    $ingredients[$key]['qtt']=(int) $_POST['ingredient']['qtt'][$key];
                }
                //verification si les ingrédient existe
                if(inBDDIngredients($mysqlClient,$ingredients)){

                }
            }
        }
    }
    
}

redirection();

?>