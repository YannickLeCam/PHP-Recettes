<?php
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