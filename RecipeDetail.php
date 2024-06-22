<?php
ob_start();
require_once './Fonct/BDD_access.php';
require_once './Fonct/errorController.php';
require_once './Fonct/badgeCreator.php';


if (isset($_GET['id_recipe'])) {
    $id_recipe = (int) $_GET['id_recipe'];
    /**
        *array(2) {
        *  ["recipe"]=>
        *  array(7) {
        *    ["id_recipe"]
        *    ["name"]
        *    ["instruction"]
        *    ["timeCook"]
        *    ["id_type"]
        *    ["image"]
        *    ["type"]=>
        *    array(1) {
        *     ["typeMeal"]
        *   }
        * }
        * ["ingredients"]=>
        * array(N) {
        *   [N]=>
        *    array(4) {
        *    ["name"]
        *    ["quantity"]
        *    ["unitMeasure"]
        *    ["price"]
        *    }
        * }
        *['previous_Recipe']=>
        *array(2){
        *    ['id_recipe']
        *    ['name']
        *    }
        *['next_Recipe]=>
        *array(2){
        *   ['id_recipe']
        *   ['name]
        *   }     
        *}
     */
    $recipeDetail = getRecipeDetail($mysqlClient,$_GET['id_recipe']);
    //Si l'id demander est mauvais on redirige
    if ($recipeDetail['recipe']==[]) {
        redirection("./Recettes.php");
    }
}else {
    redirection();
}

/**
 * The function calculates the total price of ingredients based on their individual prices and
 * quantities.
 * 
 * @param array ingredients The function `priceTotalGuess` calculates the total price of a list of
 * ingredients based on their individual prices and quantities. The function takes an array of
 * ingredients as input, where each ingredient is represented as an associative array with keys 'price'
 * and 'quantity'.
 * 
 * @return float The function `priceTotalGuess` is returning the total price calculated by multiplying
 * the price of each ingredient by its quantity, summing them up, and rounding the result to 2 decimal
 * places.
 */
function priceTotalGuess(array $ingredients):float{
    $price = 0;
    foreach ($ingredients as $ingredient) {
        $price+=($ingredient['price']*$ingredient['quantity']);
    }
    return round($price,2);
}

/**
 * The function `createIngredientsList` generates an HTML list of ingredients with their names,
 * quantities, and unit measurements.
 * 
 * @param array ingredients The `createIngredientsList` function takes an array of ingredients as input
 * and generates an HTML list (`<ul>`) with each ingredient displayed as a list item (`<li>`). Each
 * ingredient in the array should be an associative array with keys `name`, `quantity`, and
 * `unitMeasure`.
 * 
 * @return string The function `createIngredientsList` returns a string containing an HTML unordered
 * list (`<ul>`) with list items (`<li>`) for each ingredient in the input array. Each list item
 * includes the ingredient's name, quantity, and unit of measure.
 */
function createIngredientsList(array $ingredients):string {
    $htmlContent="<ul>";
    foreach ($ingredients as $ingredient) {
        $htmlContent.='<li> <i class="fa-solid fa-angle-right"></i>  '.$ingredient['name'].' : '.$ingredient['quantity'].' '. $ingredient["unitMeasure"] .'</li>';
    }
    $htmlContent.="</ul>";
    return $htmlContent;
}

$title = $recipeDetail['recipe']['name'];
?>
<h1><?=$title.' '.createBadge($recipeDetail['recipe']['type']['typeMeal'])?></h1>

<div id="detailBox">
    <div id="imgRecetteDetail">
    <?php
        if ($recipeDetail['recipe']['image']!=null) {
            echo '<img src="'.$recipeDetail['recipe']['image'].'" alt="image représentant la recette">';
        }
    ?>
    </div>
    <div id="infoRecette">
        <p><span>Temps de préparation :</span> <?=$recipeDetail['recipe']['timeCook']?> minute<?=($recipeDetail['recipe']['timeCook']>1 ? "s" : "")?></p>
        <p><span>Le coût estimé de la recette est :</span> <?=priceTotalGuess($recipeDetail['ingredients'])?> €</p>
    </div>
    <div id="ingredientsList">
        <h2>Ingrédients :</h2>
        <?=createIngredientsList($recipeDetail['ingredients'])?>    
    </div>
    <div id="instructionsBox">
        <h2>Instructions :</h2>
        
        <?="<p>".$recipeDetail['recipe']['instruction']."</p>"?>  
    
    </div>
</div>
<div id="buttonDetailBox">
    <a href="" id="editButton"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
    <a href="" id="deleteButton"><i class="fa-solid fa-trash" style="color:#ffffff;"></i></a>
    <?php
        if ($recipeDetail['previous_recipe']!=null) {
            echo '<a id="prevButton" href="./RecipeDetail.php?id_recipe='.$recipeDetail['previous_recipe']['id_recipe'].'"> ←  '.$recipeDetail['previous_recipe']['name'].'</a>';
        }
        if ($recipeDetail['next_recipe']!=null) {
            echo '<a id="nextButton" href="./RecipeDetail.php?id_recipe='.$recipeDetail['next_recipe']['id_recipe'].'">'.$recipeDetail['next_recipe']['name'].'  →</a>';
        }
    ?>
</div>

<?php
$content = ob_get_clean();
require_once './template.php';
?>