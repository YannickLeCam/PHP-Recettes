<form id="ingredientForm" action="./gestionRecette.php" method="post">
    <h1>Ajouter un nouvel Ingredient</h1>
    <div class="form-floating mb-3 p-2">
        <input type="text" class="form-control" id="floatingInputDisabled" name="name" placeholder="Nom de l'ingrédient" required>
        <label for="floatingInputDisabled">Nom de l'ingrédient</label>
    </div>
    <div class="form-floating mb-3 p-2">
        <input type="text" class="form-control" id="floatingInputDisabled" name="price" placeholder="Prix de l'ingrédient" required>
        <label for="floatingInputDisabled">Prix de l'ingredient</label>
    </div>
    <div class="form-floating mb-3 p-2 flex-fill">
        <input type="text" class="form-control" id="floatingInputDisabled" name="unitMeasure" placeholder="Unité de mesure" required>
        <label for="floatingInputDisabled">Unité de mesure</label>
    </div>
    <div id="buttonIngredientForm">
        <input  id="cancelButton" class="btn btn-danger" value="Annuler">
        <input name="submitBtnIngredient" type="submit" class="btn btn-primary" value="Ajouter">
    </div>

</form>