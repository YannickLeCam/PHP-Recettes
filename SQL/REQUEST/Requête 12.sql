SELECT typemeal,count(id_recipe)
FROM type
INNER JOIN recipe
ON recipe.id_type = type.id_type
GROUP BY recipe.id_type;