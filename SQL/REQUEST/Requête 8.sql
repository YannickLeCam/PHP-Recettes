SELECT DISTINCT recipe.name,count(price*quantify.quantity) 
FROM INGREDIENT
INNER JOIN QUANTIFY
ON quantify.id_ingredient = ingredient.id_ingredent
INNER JOIN RECIPE
ON recipe.id_recipe = quantify.id_recipe
GROUP BY quantify.id_recipe;