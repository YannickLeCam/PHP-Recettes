INSERT INTO Ingredient (name, price, unitMeasure) VALUES 
('Spaghetti', 2.50, 'gramme'),
('Parmesan', 5.00, 'gramme'),
('Pancetta', 4.00, 'gramme');

INSERT INTO RECIPE (recipe.name, instruction, timeCook, id_type) VALUES 
(
    'Pates Carbonara',
    '1. Faites cuire les pâtes dans de l\'eau salée selon les instructions sur l\'emballage.\n2. Dans un bol séparé, battez les œufs et mélangez-les avec le parmesan râpé.\n3. Faites frire la pancetta dans une poêle jusqu\'à ce qu\'elle soit croustillante.\n4. Égouttez les pâtes et remettez-les dans la casserole. Retirez du feu.\n5. Mélangez rapidement la pancetta, puis le mélange d\'œufs et de fromage. Remuez vigoureusement pour créer une sauce crémeuse.\n6. Assaisonnez avec du sel et du poivre selon votre goût, et servez immédiatement.',
    20,
    2
);

INSERT INTO quantify (Id_Recipe, Id_Ingredient, quantity) VALUES 
(3, 20, 500),  -- 500g de Spaghetti
(3, 1, 3),    -- 3 œufs
(3, 21, 100),  -- 100g de Parmesan
(3, 22, 150),  -- 150g de Pancetta
(3, 6, 5),    -- 5g de Sel
(3, 19, 2);    -- 2g de Poivre