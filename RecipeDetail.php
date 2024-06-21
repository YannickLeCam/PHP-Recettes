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

function priceTotalGuess(array $ingredients):float{
    $price = 0;
    foreach ($ingredients as $ingredient) {
        $price+=($ingredient['price']*$ingredient['quantity']);
    }
    return round($price,2);
}

function createIngredientsList(array $ingredients):string {
    $htmlContent="<ul>";
    foreach ($ingredients as $ingredient) {
        $htmlContent.='<li>'.$ingredient['name'].' : '.$ingredient['quantity'].' '. $ingredient["unitMeasure"] .'</li>';
    }
    $htmlContent.="</ul>";
    return $htmlContent;
}

$title = $recipeDetail['recipe']['name'];
?>
<h1><?=$title.' '.createBadge($recipeDetail['recipe']['type']['typeMeal'])?></h1>

<div id="detailBox">
    <?php
        if ($recipeDetail['recipe']['image']!=null) {
            echo '<img src="'.$recipeDetail['recipe']['image'].'" alt="image représentant la recette">';
        }
    ?>
    <div id="infoRecette">
        <p>Temps de préparation : <?=$recipeDetail['recipe']['timeCook']?> minute<?=($recipeDetail['recipe']['timeCook']>1 ? "s" : "")?></p>
        <p>Le coût estimé de la recette est : <?=priceTotalGuess($recipeDetail['ingredients'])?> €</p>
    </div>
    <div id="ingredientsList">
        <h2>Ingrédients :</h2>
        <?=createIngredientsList($recipeDetail['ingredients'])?>    
    </div>
    <div id="instructionsBox">
        <h2>Instructions :</h2>
        <pre>
            <?=$recipeDetail['recipe']['instruction']?>  
        </pre>
    </div>
</div>
<div id="buttonDetailBox">
    <?php
        if ($recipeDetail['previous_recipe']!=null) {
            echo '<a href="./RecipeDetail.php?id_recipe='.$recipeDetail['previous_recipe']['id_recipe'].'"> ←  '.$recipeDetail['previous_recipe']['name'].'</a>';
        }
        if ($recipeDetail['next_recipe']!=null) {
            echo '<a href="./RecipeDetail.php?id_recipe='.$recipeDetail['next_recipe']['id_recipe'].'">'.$recipeDetail['next_recipe']['name'].'  →</a>';
        }
    ?>
</div>

<?php
$content = ob_get_clean();
require_once './template.php';
?>