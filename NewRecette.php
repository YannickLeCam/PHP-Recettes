<?php
ob_start();
require_once './Fonct/BDD_access.php';
$title = "Nouvelle Recette";

$typeMeal=getTypeMealTab($mysqlClient);
$ingredients = getIngredients($mysqlClient);

/**
 * The function setTypeMealOption generates HTML options for a dropdown menu based on an array of type
 * meals.
 * 
 * @param array typeMeals An array containing information about different meal types. Each element in
 * the array is an associative array with keys 'id_type' and 'typeMeal'.
 * 
 * @return string The function `setTypeMealOption` returns a string containing HTML `<option>` elements
 * based on the input array of type meals. Each `<option>` element has a value attribute set to the
 * `id_type` value from the array and the text content of the option is set to the `typeMeal` value
 * from the array.
 */
function setTypeMealOptions(array $typeMeals):string{
    $htmlContent ="";
    foreach ($typeMeals as $typeMeal) {
        $htmlContent .= ' <option value="'.$typeMeal['id_type'].'">'.$typeMeal['typeMeal'].'</option>';
    }
    return $htmlContent;
}

/**
 * The function `setIngredientsOptions` generates HTML options for a dropdown menu based on an array of
 * ingredients.
 * 
 * @param array ingredients Here is the corrected code for the `setIngredientsOptions` function:
 * 
 * @return string The function `setIngredientsOptions` returns a string containing HTML `<option>`
 * elements for each ingredient in the provided array. Each `<option>` element includes the
 * ingredient's ID and name as its value and text content respectively.
 */
function setIngredientsOptions(array $ingredients):string {
    $htmlContent = "";
    foreach ($ingredients as $ingredient) {
        $htmlContent.='<option value"'.$ingredient['id_ingredent'].'">'.$ingredient['name'].'</option>'; // a modifier pour retirer les éléments qui sont deja dans la recette 
    }
    return $htmlContent;
}
?>

<h1>Entrez votre nouvelle Recette</h1>

<form method="post" action="./gestionRecette.php?from=./NewRecette.php">
    <h2>Details recette</h2>
    <div class="d-flex">
        <div class="form-floating mb-3 p-2 flex-fill">
            <input type="text" class="form-control" id="floatingInputDisabled" name="nameRecette" placeholder="Nom de la recette">
            <label for="floatingInputDisabled">Nom de la recette</label>
        </div>

        <div class="form-floating mb-3 p-2 flex-fill">
            <input type="number" class="form-control" id="floatingInputDisabled" name="timeCook" placeholder="Durée de la préparation en minutes">
            <label for="floatingInputDisabled">Durée de la préparation en minutes</label>
        </div>
        
        <div class="p-2 flex-fill">
            <select class="form-select form-select-lg mb-3 " aria-label="Large select example" name="typeMeal">
                <option selected>Catégorie de plat</option>
                <?=setTypeMealOptions($typeMeal)?>
            </select>
        </div>
    </div>
    <h2>Ingrédients</h2>
    <div class="d-flex" id="ingredientBox">
        <div class="p-2 flex-fill">
            <select class="form-select form-select-lg mb-3 " aria-label="Large select example" name="typeMeal">
                <option selected>Choisir un ingrédient</option>
                <?=setIngredientsOptions($ingredients)?>
            </select>
        </div>

        <div class="form-floating mb-3 p-2 flex-fill">
            <input type="number" class="form-control" id="floatingInputDisabled" name="quantite" placeholder="Quantité">
            <label for="floatingInputDisabled">Quantité</label>
        </div>
        <div class="buttonDeleteLine">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <div id="buttonAddNewLineIngredient">
        <i class="fa-solid fa-plus"></i>
    </div>
    
    <h2>Instruction</h2>

    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
$content = ob_get_clean();
require_once './template.php';
?>