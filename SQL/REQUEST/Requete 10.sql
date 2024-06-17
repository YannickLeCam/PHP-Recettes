SELECT DISTINCT ingredient.name,quantity,price
FROM quantify
INNER JOIN INGREDIENT
ON quantify.id_ingredient = ingredient.id_ingredent
WHERE quantify.id_recipe = 3;