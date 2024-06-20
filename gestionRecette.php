<?php
session_start();
require_once 'Fonct/errorController.php';
require_once 'Fonct/BDD_access.php';


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


/**
 * The function `checkDoubleIngredient` checks if there are any duplicate ingredients in an array.
 * 
 * @param array tabIdIngredient An array containing the IDs of ingredients.
 * 
 * @return bool The function `checkDoubleIngredient` returns a boolean value. It returns `true` if
 * there is at least one ingredient that occurs more than once in the input array ``,
 * otherwise it returns `false`.
 */
function checkDoubleIngredient(array $tabIdIngredient):bool{
    $occurence=array_count_values($tabIdIngredient);
    foreach ($occurence as $value) {
        if ($value>1) {
            return true;
        }
    }
    return false;
}

if (isset($_POST['submit'])) {
    /**
     * Verification de la présence des attributs OBLIGATOIRE
     */
    if (isset($_POST['nameRecette'])) {
       $nameRecette = filter_input(INPUT_POST,"nameRecette",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if ($nameRecette=="") {
            setMessage("error","Nom de la Recette manquant . . .");
            redirection("./NewRecette.php");
       }
    }else {
        setMessage("error","Nom de la Recette manquant . . .");
        redirection("./NewRecette.php");
    }
    if (isset($_POST['timeCook'])) {
        $timeCook = filter_input(INPUT_POST,"timeCook",FILTER_VALIDATE_INT);
        if ($timeCook<1 && $timeCook>3600) {
            setMessage("error","Le temps de préparation semble etre invalide");
        }
    }else {
        setMessage("error","Le temps de préparation manquant . . .");
        redirection("./NewRecette.php");
    }
    if (isset($_POST['typeMeal'] )|| $_POST['typeMeal']==0) {
        $typeMeal = filter_input(INPUT_POST,"typeMeal",FILTER_VALIDATE_INT);
        if (!inBDDTypeMeal($mysqlClient , $typeMeal)) {
            setMessage("error","La catégorie de repas semble être invalide . . .");
            redirection("./NewRecette.php");
        }

    }else {
        setMessage("error","La catégorie de repas est manquant . . .");
        redirection("./NewRecette.php");
    }
    if (isset($_POST['instructions'])) {
        $instructions = filter_input(INPUT_POST,"instructions",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($instructions == "") {
            setMessage("error","Il semble manquer des instructions . . .");
            redirection("./NewRecette.php");
        }
    }else {
        setMessage("error","Il semble manquer des instructions . . .");
        redirection("./NewRecette.php");
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
                if (checkDoubleIngredient($_POST['ingredient']['id'])) {
                    setMessage('error','Un ingrédient été retrouvé en double dans la recette . . .');
                    redirection();
                }
                foreach ($_POST['ingredient']['id'] as $key => $value) {

                    $ingredients[$key]['id']=(int) $_POST['ingredient']['id'][$key]; //A DEMANDER A MICKAEL COMMENT UTILISER FILTER-INPUT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                    $ingredients[$key]['qtt']=(int) $_POST['ingredient']['qtt'][$key];
                }
                if(!inBDDIngredients($mysqlClient,$ingredients)){
                    setMessage("error","Il semble avoir une erreur sur l'entrée de vos ingrédients . . .");
                    redirection(); //Cancel because it's a suspect situation
                }
            }
        }
    }
    /**
     * Happy end !
     */

    echo "<pre>";
    var_dump($_SESSION);
    var_dump($ingredients);
    var_dump($nameRecette);
    var_dump($instructions);
    var_dump($timeCook);
    var_dump($typeMeal);
    echo "</pre>";
    die();
    redirection("./NewRecette.php");
}

redirection();

?>