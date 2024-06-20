-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour recipe_demo
CREATE DATABASE IF NOT EXISTS `recipe_demo` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `recipe_demo`;

-- Listage de la structure de table recipe_demo. ingredient
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id_ingredent` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `unitMeasure` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ingredent`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.ingredient : ~38 rows (environ)
INSERT INTO `ingredient` (`id_ingredent`, `name`, `price`, `unitMeasure`) VALUES
	(1, 'Oeuf', 0.53, 'unité'),
	(2, 'Lait', 1.23, 'litre'),
	(3, 'Chocolat', 2.23, 'kg'),
	(4, 'Beurre', 8.80, 'kg'),
	(5, 'Levure chimique', 1.23, 'sachet'),
	(6, 'Sel', 0.12, 'gramme'),
	(7, 'Farine', 1.23, 'kg'),
	(8, 'Sucre', 1.23, 'kg'),
	(9, 'Riz basmati', 1.13, 'gramme'),
	(10, 'Poivron rouge', 0.52, 'unité'),
	(11, 'Poivron jaune', 0.53, 'unité'),
	(12, 'Tomate', 0.21, 'unité'),
	(13, 'Maïs', 0.78, 'gramme'),
	(14, 'Petit poid', 0.52, 'gramme'),
	(15, 'Dés de Jambon', 1.34, 'gramme'),
	(16, 'Frommage Feta', 4.23, 'gramme'),
	(17, 'Huile d\'olive', 2.60, 'cL'),
	(18, 'Vinaigre balsamique', 4.23, 'cL'),
	(19, 'Poivre', 0.23, 'gramme'),
	(20, 'Spaghetti', 1.12, 'kg'),
	(21, 'Parmesan', 5.00, 'kg'),
	(22, 'Pancetta', 4.00, 'kg'),
	(26, 'Poulet', 1.56, 'kg'),
	(27, 'Carotte', 0.45, 'unité'),
	(28, 'Pomme de terre', 0.60, 'unité'),
	(29, 'Crevette', 4.20, 'kg'),
	(30, 'Citron', 0.80, 'unité'),
	(31, 'Menthe', 4.35, 'kg'),
	(32, 'Rhum', 20.00, 'L'),
	(34, 'Blanc de poulet', 10.50, 'kg'),
	(35, 'Yaourt', 1.50, 'tasse'),
	(36, 'Garam Masala', 0.75, 'c. à café'),
	(37, 'Ail', 0.50, 'gousse'),
	(38, 'Gingembre', 0.60, 'c. à café'),
	(39, 'Purée de tomate', 1.00, 'tasse'),
	(40, 'Crème épaisse', 2.00, 'tasse'),
	(41, 'Cumin', 0.30, 'c. à café'),
	(42, 'Paprika', 0.40, 'c. à café');

-- Listage de la structure de table recipe_demo. quantify
CREATE TABLE IF NOT EXISTS `quantify` (
  `quantity` float unsigned DEFAULT NULL,
  `id_ingredient` int unsigned NOT NULL,
  `id_recipe` int unsigned NOT NULL,
  UNIQUE KEY `id_ingredient_id_recipe` (`id_ingredient`,`id_recipe`),
  KEY `FK_ingredient` (`id_ingredient`),
  KEY `FK_recipe` (`id_recipe`),
  CONSTRAINT `FK_ingredient` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredent`),
  CONSTRAINT `FK_recipe` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.quantify : ~35 rows (environ)
INSERT INTO `quantify` (`quantity`, `id_ingredient`, `id_recipe`) VALUES
	(4, 1, 1),
	(3, 1, 3),
	(0.2, 3, 1),
	(0.15, 4, 1),
	(1, 5, 1),
	(12, 6, 1),
	(5, 6, 3),
	(12, 6, 5),
	(0.5, 6, 10),
	(0.1, 7, 1),
	(0.15, 8, 1),
	(0.05, 8, 9),
	(2, 19, 3),
	(12, 19, 10),
	(0.5, 20, 3),
	(0.1, 21, 3),
	(0.15, 22, 3),
	(1.5, 26, 5),
	(1, 26, 10),
	(4, 27, 6),
	(3, 28, 6),
	(0.2, 29, 7),
	(1, 30, 7),
	(2, 30, 8),
	(0.005, 31, 7),
	(0.05, 31, 9),
	(0.05, 32, 9),
	(1, 35, 10),
	(1, 36, 10),
	(4, 37, 10),
	(1, 38, 10),
	(1, 39, 10),
	(1, 40, 10),
	(1, 41, 10),
	(1, 42, 10);

-- Listage de la structure de table recipe_demo. recipe
CREATE TABLE IF NOT EXISTS `recipe` (
  `id_recipe` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `instruction` text NOT NULL,
  `timeCook` int unsigned NOT NULL DEFAULT '0',
  `id_type` int unsigned NOT NULL,
  `image` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id_recipe`),
  KEY `Index 2` (`id_type`),
  CONSTRAINT `FK_recipe_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.recipe : ~10 rows (environ)
INSERT INTO `recipe` (`id_recipe`, `name`, `instruction`, `timeCook`, `id_type`, `image`) VALUES
	(1, 'gateau au chocolat', 'Instructions\r\nPréparation du four et des ingrédients :\r\n\r\nPréchauffez votre four à 180°C (350°F).\r\nBeurrez et farinez un moule à gâteau (environ 22 cm de diamètre) ou chemisez-le de papier sulfurisé.\r\nFaire fondre le chocolat et le beurre :\r\n\r\nCassez le chocolat en morceaux et faites-le fondre au bain-marie ou au micro-ondes avec le beurre, en remuant régulièrement jusqu\'à obtention d\'un mélange lisse.\r\nMélanger les œufs et le sucre :\r\n\r\nDans un grand bol, battez les œufs avec le sucre jusqu\'à ce que le mélange blanchisse et devienne mousseux.\r\nAjouter le chocolat fondu :\r\n\r\nIncorporez le mélange de chocolat et de beurre fondu au mélange œufs-sucre. Mélangez bien.\r\nAjouter les ingrédients secs :\r\n\r\nTamisez la farine et la levure chimique au-dessus du bol, puis ajoutez une pincée de sel. Mélangez délicatement jusqu\'à obtention d\'une pâte homogène.\r\nAjouter l\'extrait de vanille :\r\n\r\nSi vous le souhaitez, ajoutez l\'extrait de vanille à la pâte et mélangez.\r\nCuisson :\r\n\r\nVersez la pâte dans le moule préparé.\r\nEnfournez et faites cuire pendant environ 25 à 30 minutes. Pour vérifier la cuisson, insérez un cure-dent au centre du gâteau : il doit en ressortir propre ou avec quelques miettes.\r\nRefroidissement :\r\n\r\nLaissez le gâteau refroidir dans le moule pendant quelques minutes avant de le démouler sur une grille pour qu\'il refroidisse complètement.\r\nDégustation :\r\n\r\nVous pouvez saupoudrer le gâteau de sucre glace ou le napper d\'une ganache au chocolat pour une touche supplémentaire.\r\nBon appétit !\r\n', 55, 1, 'https://www.thespruceeats.com/thmb/BtnmmYG2O4f-80qrl02cFuTCl_k=/2121x1414/filters:fill(auto,1)/GettyImages-530022653-580e3ecf5f9b58564c94f7b0.jpg'),
	(3, 'Pâtes Carbonara', '1. Faites cuire les pâtes dans de l\'eau salée selon les instructions sur l\'emballage.\n2. Dans un bol séparé, battez les œufs et mélangez-les avec le parmesan râpé.\n3. Faites frire la pancetta dans une poêle jusqu\'à ce qu\'elle soit croustillante.\n4. Égouttez les pâtes et remettez-les dans la casserole. Retirez du feu.\n5. Mélangez rapidement la pancetta, puis le mélange d\'œufs et de fromage. Remuez vigoureusement pour créer une sauce crémeuse.\n6. Assaisonnez avec du sel et du poivre selon votre goût, et servez immédiatement.', 20, 2, 'https://th.bing.com/th/id/R.914136a1a2bafe16a499c7689676b770?rik=gsk7ub3TKLffkA&pid=ImgRaw&r=0'),
	(5, 'Poulet rôti', 'Préchauffer le four. Assaisonner le poulet et cuire au four pendant 90 minutes.', 90, 2, 'https://th.bing.com/th/id/R.a26549b9386f89ada333d3070ed80232?rik=%2b8N8eDJP8EvqWw&riu=http%3a%2f%2fallocouscous17.com%2fwp-content%2fuploads%2f2021%2f04%2fpoulet-roti-1536x922.jpeg&ehk=clPJToCnGqodBqSyHpvmMSywZ8LC02YCUePFLloWYr4%3d&risl=&pid=ImgRaw&r=0'),
	(6, 'Soupe de carottes', 'Éplucher les carottes et les pommes de terre. Cuire dans de l\'eau bouillante et mixer.', 40, 3, 'https://th.bing.com/th/id/R.dbe4b8851be917d2e3b352e329f83e99?rik=7PX2BrGPA5bFdA&pid=ImgRaw&r=0'),
	(7, 'Salade de crevettes', 'Cuire les crevettes. Mélanger avec du citron et de la menthe.', 25, 3, 'https://th.bing.com/th/id/OIP.dOGajLcVp_4-wBNEdO7T0QHaE8?rs=1&pid=ImgDetMain'),
	(8, 'Tarte au citron', 'Préparer la pâte. Faire une crème au citron et cuire au four.', 50, 1, 'https://keyassets.timeincuk.net/inspirewp/live/wp-content/uploads/sites/8/2019/02/tarte-920x869.jpg'),
	(9, 'Cocktail Mojito', 'Mélanger le rhum, le sucre, le citron vert et la menthe. Ajouter de l\'eau gazeuse.', 10, 4, ''),
	(10, 'Poulet Tikka Masala', '1. Mariner le poulet... 2. Cuire le poulet... 3. Préparer la sauce...', 60, 2, 'https://enrilemoine.com/wp-content/uploads/2019/03/Chiken-Tikka-Masala-by-enrilemoine-1.jpg'),
	(11, 'Tasse d\'eau chaude', 'Mettre de l\'eau chaude dans une tasse', 1, 4, 'https://th.bing.com/th/id/OIP.zIu0Wgai-CxJHSUDcyopiwAAAA?w=163&h=180&c=7&r=0&o=5&pid=1.7'),
	(12, 'Sandwich Parisien', 'Prendre une baguette savoureuse afin de la trancher dans la longueur\r\nEtal&eacute; a votre gr&eacute; le beurre\r\nR&eacute;partir le jambons sur le pain beurr&eacute;\r\nRajouter avec parcimonie de l&#039;emmental en tranche', 10, 2, 'https://th.bing.com/th?id=OSK.a79129fade5746447387c81bc65dd6c9');

-- Listage de la structure de table recipe_demo. type
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int unsigned NOT NULL AUTO_INCREMENT,
  `typeMeal` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_type`),
  UNIQUE KEY `typeMeal` (`typeMeal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.type : ~4 rows (environ)
INSERT INTO `type` (`id_type`, `typeMeal`) VALUES
	(4, 'Cocktail'),
	(1, 'Dessert'),
	(3, 'Entrée'),
	(2, 'Plat');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
