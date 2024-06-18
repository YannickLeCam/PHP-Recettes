SELECT recipe.*, SUM(price * quantity) AS coutTotal
FROM recipe
INNER JOIN quantify ON quantify.id_recipe = recipe.id_recipe
INNER JOIN ingredient ON ingredient.id_ingredent = quantify.id_ingredient
GROUP BY recipe.id_recipe
HAVING coutTotal >= ALL (
    SELECT sum(price * quantity) AS coutTotal
    FROM recipe
	 INNER JOIN quantify ON quantify.id_recipe = recipe.id_recipe
	 INNER JOIN ingredient ON ingredient.id_ingredent = quantify.id_ingredient
	 GROUP BY recipe.id_recipe
)