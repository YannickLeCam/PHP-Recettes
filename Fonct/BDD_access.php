<?php
try {
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=recipe_demo;charset=utf8',
        'root',
        ''
    );
    // Activer les erreurs PDO
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

function getTypeMealTab(PDO $mysqlClient){
    $processRequest = $mysqlClient->prepare("SELECT * FROM type");
    $processRequest->execute();
    $typeMeal = $processRequest->fetchAll();
    return $typeMeal;
}



?>