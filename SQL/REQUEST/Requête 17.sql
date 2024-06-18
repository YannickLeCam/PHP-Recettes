SELECT *
FROM recipe
LEFT JOIN quantify ON recipe.id_recipe = quantify.id_recipe
WHERE quantify.id_recipe IS NULL;