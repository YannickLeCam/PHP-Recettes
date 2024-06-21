<?php
/**
 * The function `createBadge` generates a styled badge based on the type of meal provided as input.
 * 
 * @param string typeMeal The `createBadge` function takes a string parameter `` and returns
 * an HTML badge element based on the value of ``. The function uses a switch statement to
 * determine the appropriate styling for the badge based on the type of meal.
 * 
 * @return string The `createBadge` function takes a string parameter `` and returns an HTML
 * span element with a specific class based on the value of ``.
 */
function createBadge(string $typeMeal):string{
    switch ($typeMeal) {
        case 'Cocktail':
            return '<span class="badge text-bg-danger">'.$typeMeal.'</span>';
            break;
        case 'Dessert':
            return '<span class="badge text-bg-success">'.$typeMeal.'</span>';
            break;
        case 'Entrée':
            return '<span class="badge text-bg-info">'.$typeMeal.'</span>';
            break;
        case 'Plat':
            return '<span class="badge text-bg-primary">'.$typeMeal.'</span>';
            break;
        default:
            return '<span class="badge text-bg-success-emphasis">'.$typeMeal.'</span>';
            break;
    }
}
?>