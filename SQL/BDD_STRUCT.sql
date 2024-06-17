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
  PRIMARY KEY (`id_ingredent`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.ingredient : ~19 rows (environ)
INSERT IGNORE INTO `ingredient` (`id_ingredent`, `name`, `price`, `unitMeasure`) VALUES
	(1, 'Oeuf', 0.53, 'unité'),
	(2, 'Lait', 1.23, 'litre'),
	(3, 'Chocolat', 0.23, 'gramme'),
	(4, 'Beurre', 1.56, 'gramme'),
	(5, 'Levure chimique', 1.23, 'sachet'),
	(6, 'Sel', 0.12, 'gramme'),
	(7, 'Farine', 1.23, 'gramme'),
	(8, 'Sucre', 0.25, 'gramme'),
	(9, 'Riz basmati', 1.13, 'gramme'),
	(10, 'Poivron rouge', 0.52, 'unité'),
	(11, 'Poivron jaune', 0.53, 'unité'),
	(12, 'Tomate', 0.15, 'unité'),
	(13, 'Maïs', 0.78, 'gramme'),
	(14, 'Petit poid', 0.52, 'gramme'),
	(15, 'Dés de Jambon', 1.34, 'gramme'),
	(16, 'Frommage Feta', 4.23, 'gramme'),
	(17, 'Huile d\'olive', 2.60, 'cL'),
	(18, 'Vinaigre balsamique', 4.23, 'cL'),
	(19, 'Poivre', 0.23, 'gramme');

-- Listage de la structure de table recipe_demo. quantify
CREATE TABLE IF NOT EXISTS `quantify` (
  `quantity` float unsigned DEFAULT NULL,
  `id_ingredient` int unsigned NOT NULL,
  `id_recipe` int unsigned NOT NULL,
  KEY `FK_ingredient` (`id_ingredient`),
  KEY `FK_recipe` (`id_recipe`),
  CONSTRAINT `FK_ingredient` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id_ingredent`),
  CONSTRAINT `FK_recipe` FOREIGN KEY (`id_recipe`) REFERENCES `recipe` (`id_recipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.quantify : ~19 rows (environ)
INSERT IGNORE INTO `quantify` (`quantity`, `id_ingredient`, `id_recipe`) VALUES
	(200, 3, 1),
	(4, 1, 1),
	(150, 8, 1),
	(100, 7, 1),
	(150, 4, 1),
	(1, 5, 1),
	(12, 6, 1),
	(200, 9, 2),
	(1, 10, 2),
	(1, 11, 2),
	(2, 12, 2),
	(150, 13, 2),
	(100, 14, 2),
	(100, 15, 2),
	(100, 16, 2),
	(6, 17, 2),
	(4, 18, 2),
	(6, 6, 2),
	(6, 19, 2);

-- Listage de la structure de table recipe_demo. recipe
CREATE TABLE IF NOT EXISTS `recipe` (
  `id_recipe` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `instruction` text NOT NULL,
  `timeCook` int unsigned NOT NULL DEFAULT '0',
  `id_type` int unsigned NOT NULL,
  PRIMARY KEY (`id_recipe`),
  KEY `Index 2` (`id_type`),
  CONSTRAINT `FK_recipe_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.recipe : ~2 rows (environ)
INSERT IGNORE INTO `recipe` (`id_recipe`, `name`, `instruction`, `timeCook`, `id_type`) VALUES
	(1, 'gateau au chocolat', 'Instructions\r\nPréparation du four et des ingrédients :\r\n\r\nPréchauffez votre four à 180°C (350°F).\r\nBeurrez et farinez un moule à gâteau (environ 22 cm de diamètre) ou chemisez-le de papier sulfurisé.\r\nFaire fondre le chocolat et le beurre :\r\n\r\nCassez le chocolat en morceaux et faites-le fondre au bain-marie ou au micro-ondes avec le beurre, en remuant régulièrement jusqu\'à obtention d\'un mélange lisse.\r\nMélanger les œufs et le sucre :\r\n\r\nDans un grand bol, battez les œufs avec le sucre jusqu\'à ce que le mélange blanchisse et devienne mousseux.\r\nAjouter le chocolat fondu :\r\n\r\nIncorporez le mélange de chocolat et de beurre fondu au mélange œufs-sucre. Mélangez bien.\r\nAjouter les ingrédients secs :\r\n\r\nTamisez la farine et la levure chimique au-dessus du bol, puis ajoutez une pincée de sel. Mélangez délicatement jusqu\'à obtention d\'une pâte homogène.\r\nAjouter l\'extrait de vanille :\r\n\r\nSi vous le souhaitez, ajoutez l\'extrait de vanille à la pâte et mélangez.\r\nCuisson :\r\n\r\nVersez la pâte dans le moule préparé.\r\nEnfournez et faites cuire pendant environ 25 à 30 minutes. Pour vérifier la cuisson, insérez un cure-dent au centre du gâteau : il doit en ressortir propre ou avec quelques miettes.\r\nRefroidissement :\r\n\r\nLaissez le gâteau refroidir dans le moule pendant quelques minutes avant de le démouler sur une grille pour qu\'il refroidisse complètement.\r\nDégustation :\r\n\r\nVous pouvez saupoudrer le gâteau de sucre glace ou le napper d\'une ganache au chocolat pour une touche supplémentaire.\r\nBon appétit !\r\n', 55, 1),
	(2, 'Salade de riz', 'Instructions\r\nCuire le riz :\r\n\r\nFaites cuire le riz selon les instructions du paquet. Égouttez-le et laissez-le refroidir complètement.\r\nPréparer les légumes :\r\n\r\nLavez et coupez les poivrons en petits dés.\r\nÉpluchez et coupez le concombre en petits dés.\r\nLavez et coupez les tomates en petits dés, en retirant les graines si vous le souhaitez.\r\nÉgouttez le maïs.\r\nFaites cuire les petits pois surgelés dans de l\'eau bouillante pendant environ 2-3 minutes, puis égouttez-les et laissez-les refroidir.\r\nMélanger les ingrédients :\r\n\r\nDans un grand saladier, mélangez le riz refroidi, les poivrons, le concombre, les tomates, le maïs et les petits pois.\r\nAjoutez le jambon et le fromage feta ou de chèvre émietté, si vous en utilisez.\r\nAssaisonner la salade :\r\n\r\nDans un petit bol, mélangez l\'huile d\'olive et le vinaigre balsamique ou le jus de citron. Assaisonnez avec du sel et du poivre selon votre goût.\r\nVersez cette vinaigrette sur la salade et mélangez bien pour enrober tous les ingrédients.\r\nGarniture et service :\r\n\r\nGarnissez la salade de feuilles de basilic ou de persil frais.\r\nServez immédiatement ou réfrigérez pendant une heure pour permettre aux saveurs de se mélanger.\r\nAstuces\r\nVous pouvez ajouter d\'autres ingrédients selon vos goûts, comme des olives noires, des carottes râpées, des oignons rouges finement tranchés, ou des herbes fraîches comme de la menthe ou de la coriandre.\r\nPour une version végétarienne, omettez le jambon.', 30, 2);

-- Listage de la structure de table recipe_demo. type
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int unsigned NOT NULL AUTO_INCREMENT,
  `typeMeal` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table recipe_demo.type : ~4 rows (environ)
INSERT IGNORE INTO `type` (`id_type`, `typeMeal`) VALUES
	(1, 'dessert'),
	(2, 'plat'),
	(3, 'entrée'),
	(4, 'cocktail');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
