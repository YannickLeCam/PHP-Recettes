SELECT DISTINCT recipe.name,SUM(price*quantify.quantity) 
FROM INGREDIENT
INNER JOIN QUANTIFY
ON quantify.id_ingredient = ingredient.id_ingredent
INNER JOIN RECIPE
ON recipe.id_recipe = quantify.id_recipe
WHERE recipe.id_recipe = 5
GROUP BY quantify.id_recipe;