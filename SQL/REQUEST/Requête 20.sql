SELECT recipe.*, SUM(price * quantity)
FROM recipe
INNER JOIN quantify ON quantify.id_recipe = recipe.id_recipe
INNER JOIN ingredient ON ingredient.id_ingredent = quantify.id_ingredient
GROUP BY recipe.id_recipe
ORDER BY SUM(price * quantity) DESC
LIMIT 1;
