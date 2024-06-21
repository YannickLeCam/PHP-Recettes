<?php
ob_start();
$title = "Recettes";
require_once './Fonct/BDD_access.php';

function createBadge(string $typeMeal):string{
    switch ($typeMeal) {
        case 'Cocktail':
            return '<span class="badge text-bg-danger">'.$typeMeal.'</span>';
            break;
        case 'Dessert':
            return '<span class="badge text-bg-success">'.$typeMeal.'</span>';
            break;
        case 'Entrée':
            return '<span class="badge text-bg-info">'.$typeMeal.'</span>';
            break;
        case 'Plat':
            return '<span class="badge text-bg-primary">'.$typeMeal.'</span>';
            break;
        default:
            return '<span class="badge text-bg-success-emphasis">'.$typeMeal.'</span>';
            break;
    }
}

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
        $htmlContent.=<<<HTML
        <div class="card">
        <img src="$srcImg" class="card-img-top" alt="..."> 
            <div class="card-body">
                <h5 class="card-title">$RecipeName  $badgeTypeMeal</h5>
                <p class="card-text">Temps de préparation : $timeCook</p>
                <p class="card-text">$instruction</p>   
                <a href="./RecipeDetail?id_recipe=$id_recipe" class="btn btn-primary">Voir plus</a>
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