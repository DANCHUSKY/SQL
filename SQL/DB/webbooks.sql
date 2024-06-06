
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webbooks`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`phpmyadmin`@`localhost` PROCEDURE `deletebook` (IN `isbn_value` VARCHAR(20))  BEGIN
    DELETE FROM llibre WHERE isbn = isbn_value;
END$$

CREATE DEFINER=`phpmyadmin`@`localhost` PROCEDURE `insertbook` (IN `isbn` VARCHAR(255), IN `autor` VARCHAR(255), IN `titol` VARCHAR(255), IN `preu` DECIMAL(10,2))  BEGIN
    INSERT INTO llibre (isbn, autor, titol, preu)
    VALUES (isbn, autor, titol, preu);
END$$

CREATE DEFINER=`phpmyadmin`@`localhost` PROCEDURE `modifybook` (IN `isbn_value` VARCHAR(20), IN `autor_value` VARCHAR(255), IN `titol_value` VARCHAR(255), IN `preu_value` DECIMAL(10,2))  BEGIN
    UPDATE llibre
    SET autor = autor_value, titol = titol_value, preu = preu_value
    WHERE isbn = isbn_value;
END$$

CREATE DEFINER=`phpmyadmin`@`localhost` PROCEDURE `showbooks` ()  BEGIN
    SELECT * from llibre;
    END$$

CREATE DEFINER=`phpmyadmin`@`localhost` PROCEDURE `showusers` ()  BEGIN
       SELECT * FROM client;
     END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CL`
--

CREATE TABLE `CL` (
  `isbn` char(13) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id` mediumint UNSIGNED NOT NULL,
  `quantity` tinyint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` smallint UNSIGNED NOT NULL,
  `nom` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `adreca` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `ciutat` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `nom`, `adreca`, `ciutat`) VALUES
(1, 'Joan Bruna', 'Carrer Barcelona 123 1r', 'Barcelona'),
(2, 'Marc Bruna', 'Carrer Barcelona 123 1r', 'Barcelona'),
(3, 'Pep Bru', 'Carrer Prat 123 1r', 'Barcelona'),
(4, 'Joan Bruch', 'Carrer Prat 12 1r', 'Barcelona'),
(5, 'Pol Bruch', 'Carrer Gav&agrave; 3 3r', 'Gava'),
(6, 'Pau Bruch', 'Carrer Gav&agrave; 3 3r', 'Gava'),
(7, 'Lluch Bruch', 'Carrer Pi 33 3r', 'Gava'),
(8, 'Pol Cinta', 'Carrer Gana 31 3r', 'El Prat'),
(9, 'Lluch Jou', 'Carrer del Pi 3 2n', 'El Prat'),
(10, 'Bru L&oacute;pez', 'Carrer Mas 43 2n', 'El Prat'),
(11, 'Administrador', NULL, NULL),
(12, 'Administrador', NULL, NULL),
(13, 'Administrador', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `id` mediumint UNSIGNED NOT NULL,
  `data` date NOT NULL,
  `idclient` smallint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credencials`
--

CREATE TABLE `credencials` (
  `usuari` char(6) COLLATE utf8mb3_spanish_ci NOT NULL,
  `contrassenya` varchar(40) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id` smallint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `credencials`
--

INSERT INTO `credencials` (`usuari`, `contrassenya`, `id`) VALUES
('admin', '1111', 11),
('bluser', '1111', 10),
('jbuser', '1111', 1),
('jruser', '1111', 4),
('lbuser', '1111', 7),
('ljuser', '1111', 9),
('mbuser', '1111', 2),
('pbuser', '1111', 3),
('pcuser', '1111', 8),
('pruser', '1111', 5),
('puuser', '1111', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llibre`
--

CREATE TABLE `llibre` (
  `isbn` char(13) COLLATE utf8mb3_spanish_ci NOT NULL,
  `autor` char(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `titol` char(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `preu` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `llibre`
--

INSERT INTO `llibre` (`isbn`, `autor`, `titol`, `preu`) VALUES
('9784565555555', 'Mart&iacute; Anglada', 'Art i g&egrave;nere', '11.50'),
('9784567777443', 'J. Rouco', 'A dios rogando...', '10.00'),
('9784567890000', 'N&uacute;ria Feliu', 'Can&ccedil;ons o canons', '15.00'),
('9784567891003', 'Curry Valenzuela', 'Nombres con clase', '18.50'),
('9784567891120', 'Joan Marc&egrave;', 'D&egrave;ficit fiscal', '12.50'),
('9784567891177', 'test5', 'Un catalán destruirá el universo', '11.00'),
('9784567891777', 'test2', 'Estraña pareja', '12.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinio`
--

CREATE TABLE `opinio` (
  `isbn` char(13) COLLATE utf8mb3_spanish_ci NOT NULL,
  `id` mediumint UNSIGNED NOT NULL,
  `opinio` text COLLATE utf8mb3_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `opinio`
--

INSERT INTO `opinio` (`isbn`, `id`, `opinio`) VALUES
('9784567891120', 1, 'Un llibre molt t&egrave;cnic recomanat per les grans revistes d\'economia'),
('9784567891120', 2, 'Recomanable a estudiants d\'economia'),
('9784567894565', 3, 'Una hist&ograve;ria que ens il&middot;lustra el cam&iacute; a seguir a partir del cam&iacute; que altres van seguir'),
('9784565555555', 4, 'Un tost&oacute; de tres parells de collons que nomes agradar&agrave; a una rata de biblioteca'),
('9784567891777', 5, 'Premi sonrisa vertical 2003'),
('9784567891777', 6, 'Llanos de Luna el va descriure com la mes sublim obra mai publicada'),
('9785555451124', 7, 'Poemari a partir del que Chiquetete es va inspirar el 2005 per al seu &agrave;lbum'),
('9784567890000', 8, 'La diva de Sants ens sorpr&egrave;n amb una obra que no parla de sexe explicit'),
('9784555555555', 9, 'Una entrevista amb els Gipsy kings novelada ens far&agrave; veure que lluny i que a prop tenim el Rossell&oacute;'),
('9784563333333', 10, 'El sant pare ens desvela en prim&iacute;cia que al pesebre no hi havia ni una burra, ni un bou, nom&eacute;s hi havia una gallina i dos ratolins'),
('9784567777443', 11, 'Lo que no deben lograr las regiones del nordeste conforman el onceavo mandamiento de todo buen rouquiano'),
('9784569999888', 12, 'Una divertida com&egrave;dia, o segons com es miri drama, de les aventures i desventures d\'un psic&egrave;tic no diagnosticat i amb poder'),
('9784567891177', 13, 'Abstenir-se de llegir-la les persones que pateixin del cor'),
('9784567891003', 14, 'No recomanable per a la gent que estimem'),
('9784560011113', 15, 'L\'autora ens il&middot;lustra sobre com fer amb diners publics un alli&ccedil;onament tendenci&oacute;s i en to crispat');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CL`
--
ALTER TABLE `CL`
  ADD PRIMARY KEY (`isbn`,`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comandaClient` (`idclient`);

--
-- Indices de la tabla `credencials`
--
ALTER TABLE `credencials`
  ADD PRIMARY KEY (`usuari`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `llibre`
--
ALTER TABLE `llibre`
  ADD PRIMARY KEY (`isbn`);

--
-- Indices de la tabla `opinio`
--
ALTER TABLE `opinio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opinio`
--
ALTER TABLE `opinio`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comandaClient` FOREIGN KEY (`idclient`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `credencials`
--
ALTER TABLE `credencials`
  ADD CONSTRAINT `crClient` FOREIGN KEY (`id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
