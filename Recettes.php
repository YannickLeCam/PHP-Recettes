<?php
ob_start();
$title = "Recettes";
require_once './Fonct/BDD_access.php';
require_once './Fonct/badgeCreator.php';
function createRecipeCard(PDO $mysqlClient):string{
    $htmlContent = "";
    $tabRecipe=getRecipeTab($mysqlClient);
    foreach ($tabRecipe as $recipe) {
        $id_recipe = $recipe['id_recipe'];
        $RecipeName = $recipe['name'];
        $srcImg = $recipe['image'];
        $timeCook = $recipe['timeCook'];
        $typeMeal = getTypeMealTabById($mysqlClient, $recipe['id_type'])[0]['typeMeal']; //create badge !
        $badgeTypeMeal = createBadge($typeMeal);
        $instruction = mb_substr($recipe['instruction'], 0, 100, 'UTF-8'); //A voir pour ajouter un Alt dans la BDD
        if ($timeCook>1) {
            $minute="minutes";
        }else {
            $minute="minute";
        }
        $htmlContent.=<<<HTML
        <div class="card">
        <img src="$srcImg" class="card-img-top" alt="..."> 
            <div class="card-body">
                <h5 class="card-title">$RecipeName  $badgeTypeMeal</h5>
                <p class="card-text">Temps de préparation : $timeCook $minute</p>
                <p class="card-text">$instruction</p>   
                <a href="./RecipeDetail.php?id_recipe=$id_recipe" class="btn btn-primary">Voir plus</a>
            </div>
        </div>
HTML;

    }
    return $htmlContent;
}

?>

<h1>Le livre de Recettes</h1>

<div id="cardsBox">
    <?= createRecipeCard($mysqlClient)?>
</div>

<?php
$content = ob_get_clean();
require_once './template.php';
?>