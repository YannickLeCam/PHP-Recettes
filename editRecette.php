<?php
ob_start();
require_once './Fonct/BDD_access.php';
require_once './Fonct/errorController.php';
require_once './Fonct/badgeCreator.php';
require_once './Fonct/formFonctCreator.php';

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
function setIngredientBox(PDO $mysqlClient, int $id_recipe):string{
    $htmlContent="";
    return $htmlContent;
}
$typeMeal=getTypeMealTab($mysqlClient);
$ingredients = getIngredients($mysqlClient);
$instructions =  html_entity_decode($recipeDetail['recipe']['instruction']);
$title = $recipeDetail['recipe']['name'];
?>
<h1>Edition de recette</h1>
<form id="recetteForm" method="post" action="./gestionRecette.php?action=edit&id_recipe=<?=$id_recipe?>" enctype="multipart/form-data">
    <h2>Details recette</h2>
    <div id="form">
        <div class="d-flex" id="infoBase">
            <div class="form-floating mb-3 p-2 flex-fill">
                <input type="text" class="form-control" id="floatingInputDisabled" name="nameRecette" placeholder="Nom de la recette" value="<?=$recipeDetail['recipe']['name']?>" required>
                <label for="floatingInputDisabled">Nom de la recette</label>
            </div>

            <div class="form-floating mb-3 p-2 flex-fill">
                <input type="number" class="form-control" id="floatingInputDisabled" name="timeCook" placeholder="Durée de la préparation en minutes" value="<?=$recipeDetail['recipe']['timeCook']?>" required>
                <label for="floatingInputDisabled">Durée de la préparation en minutes</label>
            </div>
            
            <div class="p-2 flex-fill">
                <select class="form-select form-select-lg mb-3 " aria-label="Large select example" name="typeMeal" required>
                    <?=setTypeMealOptionsEdit($typeMeal,$recipeDetail['recipe']['id_type'])?>
                </select>
            </div>
        </div>
            <label for="formFileLg" class="form-label">Image de la recette :</label>
            <input class="form-control form-control-lg" id="formFileLg" name="file" type="file">
        <h2>Ingrédients</h2>
        <div id="formIngredient">
            <?=setIngredientsEdit($ingredients,$recipeDetail['ingredients'])?>
        </div>
        <div id="buttonAddNewLineIngredient">
            <i class="fa-solid fa-plus"></i>
        </div>
        
        <h2>Instructions</h2>
        <div id="instructionsForm">
            <div id="floatingTextarea2"><?=$instructions?></div>
            <input type="hidden" name="instructions">
        </div>
    </div>
    <input name="submitBtn" type="submit" class="btn btn-primary" value="Valider le changement">
</form>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#floatingTextarea2', {
            placeholder: 'Entrer les instructions de la recettes',
            theme: 'snow'
        });
        const recipeForm = document.getElementById('recetteForm');
        function handleSubmit(event) {
        //event.preventDefault(); // Prevent the default form submission

        var content = htmlspecialchars(quill.root.innerHTML);
        console.log("Quill content:", content); // Debugging log
        document.querySelector('[name="instructions"]').value = content;
        console.log("Hidden input value:", document.querySelector('[name="instructions"]').value); // Debugging log
        // Manually submit the form
        recipeForm.submit();
    }
    
    recipeForm.addEventListener('submit', handleSubmit);
    </script>


<?php
$content = ob_get_clean();
require_once './template.php';
?>