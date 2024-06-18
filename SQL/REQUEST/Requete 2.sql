SELECT recipe.name,COUNT(quantify.id_ingredient) 
FROM RECIPE 
INNER JOIN quantify
ON RECIPE.id_recipe = QUANTIFY.id_recipe
GROUP BY quantify.id_recipe;
