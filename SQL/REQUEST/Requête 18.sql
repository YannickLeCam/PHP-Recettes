SELECT ingredient.*
FROM ingredient
INNER JOIN quantify 
ON quantify.id_ingredient = ingredient.id_ingredent
GROUP BY ingredient.id_ingredent
HAVING COUNT(quantify.id_ingredient) > 2;
