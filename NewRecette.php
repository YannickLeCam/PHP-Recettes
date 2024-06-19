<?php
ob_start();
require_once './Fonct/BDD_access.php';
$title = "Nouvelle Recette";

$typeMeal=getTypeMealTab($mysqlClient);


function setTypeMealOption(array $typeMeals):string{
    $htmlContent ="";
    foreach ($typeMeals as $typeMeal) {
        $htmlContent .= ' <option value="'.$typeMeal['id_type'].'">'.$typeMeal['typeMeal'].'</option>';
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
                <?=setTypeMealOption($typeMeal)?>
            </select>
        </div>
    </div>
    <h2>Ingrédients</h2>
    <h2>Instruction</h2>

    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
$content = ob_get_clean();
require_once './template.php';
?>