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

?>