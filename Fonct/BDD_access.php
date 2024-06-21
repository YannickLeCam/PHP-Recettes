<?php
try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=recipe_demo;charset=utf8',
        'root',
        ''
    );
    // Activer les erreurs PDO
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

/**
 * The function getTypeMealTab retrieves all records from the "type" table in a MySQL database using a
 * PDO connection and returns them as an array.
 * 
 * @param PDO mysqlClient The `mysqlClient` parameter in the `getTypeMealTab` function is an instance
 * of the PDO class, which represents a connection to a database. It is used to prepare and execute SQL
 * queries against the database to retrieve data.
 * 
 * @return array An array of all the rows from the "type" table in the database is being returned.
 */
function getTypeMealTab(PDO $mysqlClient):array{
    $processRequest = $mysqlClient->prepare("SELECT * FROM type");
    $processRequest->execute();
    $typeMeal = $processRequest->fetchAll(PDO::FETCH_NAMED);
    return $typeMeal;
}

/**
 * This PHP function retrieves a specific type of meal from a database table based on the provided ID.
 * 
 * @param PDO mysqlClient The `` parameter is an instance of the PDO class, which is used
 * to interact with a database in PHP. It represents a connection to a MySQL database and allows you to
 * perform various database operations like querying, inserting, updating, and deleting data.
 * @param int id The `id` parameter in the `getTypeMealTabById` function is used to specify the ID of
 * the type of meal that you want to retrieve from the database. This ID is used in the SQL query to
 * fetch the specific type of meal information from the `type` table based on the provided
 * 
 * @return array An array containing the details of the meal type with the specified ID from the
 * database table.
 */
function getTypeMealTabById(PDO $mysqlClient,int $id):array{
    $processRequest = $mysqlClient->prepare("SELECT typeMeal FROM type WHERE id_type=$id");
    $processRequest->execute();
    $typeMeal = $processRequest->fetchAll(PDO::FETCH_NAMED);
    return $typeMeal;
}

/**
 * This PHP function retrieves all ingredients from a database using a PDO MySQL client and returns
 * them as an array.
 * 
 * @param PDO mysqlClient The `mysqlClient` parameter in the `getIngredients` function is of type
 * `PDO`, which is a class representing a connection to a database in PHP. It is used to interact with
 * the database using prepared statements for security and efficiency. In this function, the
 * `mysqlClient` parameter is used
 * 
 * @return array An array of all ingredients fetched from the database table "ingredient" is being
 * returned.
 */
function getIngredients(PDO $mysqlClient):array{
    $processRequest = $mysqlClient->prepare("SELECT * FROM ingredient");
    $processRequest->execute();
    $ingredient = $processRequest->fetchAll(PDO::FETCH_NAMED);
    return $ingredient;
}

/**
 * This PHP function retrieves all recipes from a database using a PDO connection and returns them as
 * an array.
 * 
 * @param PDO mysqlClient The `mysqlClient` parameter in the `getRecipeTab` function is of type `PDO`,
 * which is a PHP data object representing a connection between PHP and a database server. In this
 * case, it is used to interact with a MySQL database to retrieve recipe data.
 * 
 * @return array An array of recipes is being returned.
 */
function getRecipeTab(PDO $mysqlClient):array{
    $processRequest = $mysqlClient->prepare("SELECT * FROM recipe");
    $processRequest->execute();
    $recipe = $processRequest->fetchAll(PDO::FETCH_NAMED);
    return $recipe;
}

/**
 * The function checks if a given type of meal exists in a database table.
 * 
 * @param PDO mysqlClient The `mysqlClient` parameter is an instance of the PDO class in PHP, which
 * represents a connection to a MySQL database. It is used to interact with the database by executing
 * queries and fetching results.
 * @param idTypeMeal The `inBDDTypeMeal` function takes a PDO object `` and an
 * `` as parameters. The function checks if the `` exists in the array of type
 * meals fetched from the database using the `getTypeMealTab` function.
 * 
 * @return bool The function `inBDDTypeMeal` is returning a boolean value - `true` if the ``
 * is found in the `id_type` field of the `` array, and `false` otherwise.
 */
function inBDDTypeMeal(PDO $mysqlClient , int $idTypeMeal):bool{
    $tabTypeMeal=getTypeMealTab($mysqlClient);
    foreach ($tabTypeMeal as $typeMeal) {
        if ($idTypeMeal==$typeMeal["id_type"]) {
            return true;
        }
    }
    return false;
}

/**
 * The function `inBDDIngredients` checks if all ingredients in an array exist in a database table.
 * 
 * @param PDO mysqlClient The `mysqlClient` parameter is an instance of the PDO class, which represents
 * a connection to a MySQL database. It is used to interact with the database to retrieve information
 * about ingredients.
 * @param array ingredients The `inBDDIngredients` function takes a PDO object `` and an
 * array of ingredients `` as parameters. It checks if all the ingredients in the
 * `` array exist in the database by comparing their IDs with the IDs of ingredients
 * fetched from the database using the `get
 * 
 * @return bool The function `inBDDIngredients` returns a boolean value - `true` if all the ingredients
 * in the provided array exist in the database (based on the comparison with the ingredients fetched
 * from the database), and `false` if any of the ingredients in the provided array do not exist in the
 * database.
 */
function inBDDIngredients(PDO $mysqlClient , array $ingredients):bool{
    $tabIngredient=getIngredients($mysqlClient);
    foreach ($ingredients as $ingredient) {
        $checker=false;
        foreach ($tabIngredient as $ingredientBDD) {
            if ($ingredientBDD['id_ingredent']==$ingredient['id']) {
                $checker=true;
            }
        }
        if (!$checker) {
            return false;
        }
        $checker=false;
    }
    return true;
}

/**
 * The function `getRecipeDetail` retrieves detailed information about a recipe, including recipe
 * details, type of recipe, and ingredients with quantities.
 * 
 * @param PDO mysqlClient The function `getRecipeDetail` takes two parameters:
 * @param int id_recipe The function `getRecipeDetail` takes two parameters:
 * 
 * @return array This function is returning an array containing recipe details, including the recipe
 * itself, its type, and the ingredients with their quantities and prices.
 */
function getRecipeDetail(PDO $mysqlClient, int $id_recipe):array{
    $recipeDetail = [];
    //In first take the recipe details
    $recipeQuery = $mysqlClient->prepare("SELECT * FROM recipe WHERE id_recipe=:id_recipe");
    $recipeQuery->bindParam(':id_recipe', $id_recipe, PDO::PARAM_INT);
    $recipeQuery->execute();
    $recipe = $recipeQuery->fetchAll(PDO::FETCH_NAMED);
    $recipeDetail["recipe"]=$recipe[0];
    /**
     * Evolution with the next id and the previous to add in $recipeDetail we will can to explore all recipes
     */
    //After we complete the detail with the type of recipe
    $typeMeal = getTypeMealTabById($mysqlClient,$recipe[0]["id_type"]);
    $recipeDetail["recipe"]["type"] = $typeMeal[0];
    //Finally we take all ingredients about the recipe with the quentity
    $ingredientsRequest = $mysqlClient->prepare("SELECT name,quantity,unitMeasure,price FROM ingredient INNER JOIN quantify ON quantify.id_ingredient = ingredient.id_ingredent WHERE id_recipe = $id_recipe;");
    $ingredientsRequest->execute();
    $ingredients=$ingredientsRequest->fetchAll(PDO::FETCH_NAMED);
    $recipeDetail["ingredients"]=$ingredients;
    //to got the previous recipe
    $prevRecipeQuery = $mysqlClient->prepare("
        SELECT id_recipe,name 
        FROM recipe 
        WHERE id_recipe < :id_recipe 
        ORDER BY id_recipe DESC 
        LIMIT 1
    ");
    $prevRecipeQuery->bindParam(':id_recipe', $id_recipe, PDO::PARAM_INT);
    $prevRecipeQuery->execute();
    $prevRecipe = $prevRecipeQuery->fetch(PDO::FETCH_NAMED);
    //check is not empty
    $recipeDetail["previous_recipe"] = $prevRecipe ? $prevRecipe : null;
    
    //to got the next recipe
    $nextRecipeQuery = $mysqlClient->prepare("
        SELECT id_recipe,name
        FROM recipe 
        WHERE id_recipe > :id_recipe 
        ORDER BY id_recipe 
        LIMIT 1
    ");
    $nextRecipeQuery->bindParam(':id_recipe', $id_recipe, PDO::PARAM_INT);
    $nextRecipeQuery->execute();
    $nextRecipe = $nextRecipeQuery->fetch(PDO::FETCH_NAMED);
    //check is not empty
    $recipeDetail["next_recipe"] = $nextRecipe ? $nextRecipe : null;

    
    return $recipeDetail;
}

?>