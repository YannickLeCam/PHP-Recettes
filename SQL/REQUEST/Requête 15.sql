SELECT recipe.name
FROM recipe
INNER JOIN quantify
ON quantify.id_recipe = recipe.id_recipe
INNER JOIN ingredient
ON quantify.id_ingredient = ingredient.id_ingredent

GROUP BY quantify.id_recipe
HAVING SUM(price*quantity)<2;