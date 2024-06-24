<?php
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
        $htmlContent.='<option value="'.$ingredient['id_ingredent'].'">'.$ingredient['name'].'</option>'; // a modifier pour retirer les éléments qui sont deja dans la recette 
    }
    return $htmlContent;
}

function setTypeMealOptionsEdit(array $typeMeals, int $id_typeMeal):string{
    $htmlContent ="";
    foreach ($typeMeals as $typeMeal) {
        $htmlContent .= ' <option value="'.$typeMeal['id_type'].'" '.($typeMeal['id_type']==$id_typeMeal ? "selected" : "").'>'.$typeMeal['typeMeal'].'</option>';
    }
    return $htmlContent;
}

function setIngredientsEdit(array $ingredients,array $ingredientsCurrentRecipe):string {
    $htmlContent = "";
    foreach ($ingredientsCurrentRecipe as $value) {
        $htmlContent .= <<<HTML
        <div class="d-flex" id="ingredientBox">
            <div class="p-2 flex-fill">
            <select class="form-select form-select-lg mb-3 " aria-label="Large select example" name="ingredient[id][]">
HTML;
        foreach ($ingredients as $ingredient) {
            $htmlContent.='<option value="'.$ingredient['id_ingredent'].'" '.($ingredient['name']==$value['name'] ? "selected" : "").'>'.$ingredient['name'].'</option>'; // a modifier pour retirer les éléments qui sont deja dans la recette 
        }
        $qtt=$value['quantity'];
        $htmlContent .= <<<HTML
                </select>
                </div>

                <div class="form-floating mb-3 p-2 flex-fill">
                    <input type="text" class="form-control" id="floatingInputDisabled" name="ingredient[qtt][]" placeholder="Quantité" value="$qtt">
                    <label for="floatingInputDisabled" class="floatingLabel">Quantité</label>
                </div>
                <div class="buttonDeleteLine">
                    <i class="fa-solid fa-xmark"></i>
                </div>
    </div>

HTML;

    }
    return $htmlContent;
}




?>