SELECT recipe.name,ingredient.name,quantity,unitMeasure 
FROM RECIPE 
INNER JOIN quantify
ON RECIPE.id_recipe = QUANTIFY.id_recipe
INNER JOIN INGREDIENT
ON QUANTIFY.id_ingredient = INGREDIENT.id_ingredent;
