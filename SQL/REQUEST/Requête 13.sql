SELECT recipe.name 
FROM recipe
INNER JOIN quantify
ON quantify.id_recipe = recipe.id_recipe
INNER JOIN ingredient
ON ingredient.id_ingredent = quantify.id_ingredient
WHERE ingredient.name = "Poulet";