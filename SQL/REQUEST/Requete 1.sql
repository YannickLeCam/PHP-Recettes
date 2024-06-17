SELECT name,typeMeal,timeCook 
FROM RECIPE 
INNER JOIN TYPE 
ON RECIPE.id_type = TYPE.id_type
ORDER BY timeCook DESC;