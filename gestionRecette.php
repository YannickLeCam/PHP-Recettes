<?php
session_start();
require_once 'Fonct/errorController.php';
require_once 'Fonct/BDD_access.php';


/**
 * The function `uploadImg` checks if an uploaded image meets size and extension requirements, then
 * moves it to a specified location and returns the image location if successful.
 * 
 * @param file The `uploadImg` function you provided is used to upload an image file to a specific
 * location on the server after performing some validation checks. Here is a breakdown of the function:
 * 
 * @return The function `uploadImg` will return the location of the uploaded image if it passes all the
 * validation checks for size and extension. If the image is too large or has an invalid extension, the
 * function will set an error message and return `null`. If there is an unknown error during the
 * process, it will also set an error message and return `null`.
 */
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

function verifyFormData($mysqlClient) {
    $data = [];
    if (isset($_POST['nameRecette'])) {
        $data['nameRecette'] = filter_input(INPUT_POST, "nameRecette", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($data['nameRecette'] == "") {
            return ["error" => "Nom de la Recette manquant . . ."];
        }
    } else {
        return ["error" => "Nom de la Recette manquant . . ."];
    }

    if (isset($_POST['timeCook'])) {
        $data['timeCook'] = filter_input(INPUT_POST, "timeCook", FILTER_VALIDATE_INT);
        if ($data['timeCook'] < 1 || $data['timeCook'] > 3600) {
            return ["error" => "Le temps de préparation semble être invalide"];
        }
    } else {
        return ["error" => "Le temps de préparation manquant . . ."];
    }

    if (isset($_POST['typeMeal']) && $_POST['typeMeal'] != 0) {
        $data['typeMeal'] = filter_input(INPUT_POST, "typeMeal", FILTER_VALIDATE_INT);
        if (!inBDDTypeMeal($mysqlClient, $data['typeMeal'])) {
            return ["error" => "La catégorie de repas semble être invalide . . ."];
        }
    } else {
        return ["error" => "La catégorie de repas est manquant . . ."];
    }

    if (isset($_POST['instructions'])) {
        $data['instructions'] = filter_input(INPUT_POST, "instructions", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($data['instructions'] == "") {
            return ["error" => "Il semble manquer des instructions . . ."];
        }
    } else {
        return ["error" => "Il semble manquer des instructions . . ."];
    }

    if (isset($_FILES['file'])) {
        $data['image'] = uploadImg($_FILES['file']);
    } else {
        $data['image'] = null;
    }

    if (isset($_POST['ingredient'])) {
        if (isset($_POST['ingredient']['id']) && isset($_POST['ingredient']['qtt'])) {
            if (count($_POST['ingredient']['id']) != count($_POST['ingredient']['qtt'])) {
                return ["error" => 'Une quantité ou un ingrédient semble avoir été oublié . . .'];
            } else {
                $ingredients = [];
                $args = [
                    "id" => array(
                        'filter' => FILTER_VALIDATE_INT,
                        'flags' => FILTER_FORCE_ARRAY
                    ),
                    "qtt" => array(
                        'filter' => FILTER_VALIDATE_FLOAT,
                        'flags' => FILTER_FORCE_ARRAY
                    )
                ];
                $ingredientsSaint = filter_var_array($_POST['ingredient'], $args);
                if (checkDoubleIngredient($ingredientsSaint['id'])) {
                    return ["error" => 'Un ingrédient été retrouvé en double dans la recette . . .'];
                }
                foreach ($ingredientsSaint['id'] as $key => $value) {
                    $ingredients[$key]['id'] = (int)$ingredientsSaint['id'][$key];
                    $ingredients[$key]['qtt'] = (int)$ingredientsSaint['qtt'][$key];
                }
                if (!inBDDIngredients($mysqlClient, $ingredients)) {
                    return ["error" => "Il semble avoir une erreur sur l'entrée de vos ingrédients . . ."];
                }
                $data['ingredients'] = $ingredients;
            }
        }
    }
    return $data;
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
    $data = verifyFormData($mysqlClient);
    if (isset($data['error'])) {
        setMessage("error", $data['error']);
        redirection("./NewRecette.php");
    } else {
        insertData($mysqlClient, $data);
        redirection("./NewRecette.php");
    }
}


redirection();

?>