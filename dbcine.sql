-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2022 a las 23:08:51
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbcine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores`
--

CREATE TABLE `actores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellidos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actores`
--

INSERT INTO `actores` (`id`, `nombre`, `apellidos`) VALUES
(1, 'Marlon', 'Brando'),
(2, 'Al', 'Pacino'),
(3, 'Robert', 'Duval'),
(4, 'James', 'Caan'),
(5, 'Richard', 'Castellano'),
(6, 'Diane', 'Keaton'),
(7, 'Tom', 'Hanks'),
(8, 'Robin', 'Wright'),
(9, 'Gary', 'Sinise'),
(10, 'Sally', 'Field'),
(11, 'Judy', 'Garland'),
(12, 'Frank', 'Morgan'),
(13, 'Ray', 'Bolger'),
(14, 'Jack', 'Haley'),
(15, 'Bert', 'Lahr'),
(16, 'Billie', 'Burke'),
(17, 'Margaret', 'Hamilton'),
(18, 'John', 'Travolta'),
(19, 'Olivia', 'Newton-John'),
(20, 'José', 'Sazatornil'),
(21, 'Antonio', 'Resines'),
(22, 'Jim', 'Carrey'),
(23, 'Cameron', 'Diaz'),
(24, 'Peter', 'Greene'),
(25, 'Ivana', 'Baquero'),
(26, 'Ariadna', 'Gil'),
(27, 'Sergi', 'López'),
(28, 'Doug', 'Jones'),
(29, 'Maribel', 'Verdú'),
(30, 'Álex', 'Angulo'),
(31, 'Johnny', 'Depp'),
(32, 'Winona', 'Ryder'),
(33, 'Dianne', 'Wiest'),
(34, 'Anthony Michael', 'Hall'),
(35, 'Alan', 'Arkin'),
(36, 'Kathy', 'Baker'),
(37, 'Vincent', 'Price'),
(38, 'Caroline', 'Aaron'),
(39, 'Robert', 'Oliveri'),
(40, 'Conchata', 'Ferrell'),
(41, 'Ricardo', 'Darín'),
(42, 'Soledad', 'Villamil'),
(43, 'Ryan', 'Gosling'),
(44, 'Rachel', 'McAdams'),
(45, 'James', 'Garner'),
(46, 'Sam', 'Shepard'),
(47, 'Gena', 'Rowlands'),
(48, 'James', 'Marsden'),
(49, 'Kevin', 'Connolly'),
(50, 'Joan', 'Allen'),
(51, 'Adèle', 'Exarchopoulos'),
(52, 'Léa', 'Seydoux'),
(53, 'Jodie', 'Foster'),
(54, 'Anthony', 'Hopkins'),
(55, 'Scott', 'Glenn'),
(56, 'Jack', 'Nicholson'),
(57, 'Shelley', 'Duvall'),
(58, 'Danny', 'Lloyd'),
(59, 'Scatman', 'Crothers'),
(60, 'Charlton', 'Heston'),
(61, 'Janet', 'Leigh'),
(62, 'Orson', 'Welles'),
(63, 'Marlene', 'Dietrich'),
(64, 'Joseph', 'Calleia'),
(65, 'Akim', 'Tamiroff'),
(66, 'Dennis', 'Weaver'),
(67, 'Ray', 'Collins'),
(68, 'Mercedes', 'McCambridge'),
(69, 'Joseph', 'Cotten'),
(70, 'Zsa Zsa', 'Gabor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores_peliculas`
--

CREATE TABLE `actores_peliculas` (
  `idpelicula` int(11) NOT NULL,
  `idactor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actores_peliculas`
--

INSERT INTO `actores_peliculas` (`idpelicula`, `idactor`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(4, 18),
(4, 19),
(5, 20),
(5, 21),
(6, 22),
(6, 23),
(6, 24),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(7, 29),
(7, 30),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(8, 35),
(8, 36),
(8, 37),
(8, 38),
(8, 39),
(8, 40),
(9, 41),
(9, 42),
(10, 7),
(11, 43),
(11, 44),
(11, 45),
(11, 46),
(11, 47),
(11, 48),
(11, 49),
(11, 50),
(12, 51),
(12, 52),
(13, 53),
(13, 54),
(13, 55),
(14, 56),
(14, 57),
(14, 58),
(14, 59),
(15, 60),
(15, 61),
(15, 62),
(15, 63),
(15, 64),
(15, 65),
(15, 66),
(15, 67),
(15, 68),
(15, 69),
(15, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

CREATE TABLE `directores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellidos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`id`, `nombre`, `apellidos`) VALUES
(1, 'Francis Ford', 'Coppola'),
(2, 'Robert', 'Zemeckis'),
(3, 'Victor', 'Fleming'),
(4, 'Randar', 'Kleiser'),
(5, 'José Luis', 'Cuerda'),
(6, 'Chuck', 'Russell'),
(7, 'Guillermo', 'del Toro'),
(8, 'Tim', 'Burton'),
(9, 'Juan José', 'Campanella'),
(10, 'Nick', 'Cassavetes'),
(11, 'Abdellatif', 'Kechiche'),
(12, 'Jonathan', 'Demme'),
(13, 'Stanley', 'Kubric'),
(14, 'Orson', 'Welles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `pais` varchar(250) NOT NULL,
  `genero` varchar(500) NOT NULL,
  `anio` int(11) NOT NULL,
  `director` int(11) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `pais`, `genero`, `anio`, `director`, `sinopsis`) VALUES
(1, 'El padrino', 'Estados Unidos', 'Drama', 1972, 1, 'Don Vito Corleone es el respetado y temido jefe de una de las cinco familias \r\nde la mafia de Nueva York en los años 40. El hombre tiene cuatro hijos: Connie, Sonny, Fredo y Michael, que no quiere saber nada de \r\nlos negocios sucios de su padre. Cuando otro capo, Sollozzo, intenta asesinar a Corleone, empieza una cruenta lucha entre los distintos clanes.'),
(2, 'Forrest Gump', 'Estados Unidos', 'Drama', 1994, 2, 'Sentado en un banco en Savannah, Georgia, Forrest Gump espera al autobús. Mientras éste tarda en llegar, el joven cuenta su vida a las personas que se sientan a esperar con él. Aunque sufre un pequeño retraso mental, esto no le impide hacer cosas maravillosas. Sin entender del todo lo que sucede a su alrededor, Forrest toma partido en los eventos más importantes de la historia de los Estados Unidos.'),
(3, 'El mago de Oz', 'Estados Unidos', 'Musical', 1939, 3, 'Dorothy, que sueña con viajar más allá del arco iris, ve su deseo hecho \r\nrealidad cuando un tornado se la lleva con su perrito al mundo de \r\nOz. Entonces se dirige por el Camino Amarillo hacia la Ciudad Esmeralda, donde vive el todopoderoso Mago de Oz, que puede ayudarla a regresar a Kansas. Durante el viaje, se hace amiga del Espantapájaros que desea un cerebro, el Hombre de Hojalata que quiere un corazón y el León Cobarde le hace falta el coraje, por lo que deciden unirse a Dorothy en su odisea.'),
(4, 'Grease', 'Estados Unidos', 'Musical', 1978, 4, 'El rebelde Danny Zuko y la inocente australiana Sandy mantienen un romance durante las vacaciones de verano, creyendo que no se volverán a ver. Sin embargo, para la sorpresa de ambos, acaban estudiando juntos en el mismo instituto durante el nuevo curso. Cuando vuelven a reencontrarse, Sandy se da cuenta de que Danny no es el mismo chico atento y encantador, sino un chico engreído e insensible.'),
(5, 'Amanece, que no es poco', 'España', 'Comedia', 1989, 5, 'A un remoto pueblo manchego llegan un joven ingeniero español, profesor de la Universidad de Oklahoma que disfruta de un año sabático, y su padre, que le ha comprado una moto con sidecar a modo de compensación por la muerte de su madre.'),
(6, 'La máscara', 'Estados Unidos', 'Comedia', 1994, 6, 'Un aburrido empleado de banca encuentra una máscara que representa a Loki, \r\nun dios de la malicia y la travesura, la cual le transformará por \r\ncompleto.'),
(7, 'El laberinto del fauno', 'España', 'Fantasía, Drama', 2006, 7, 'Ofelia es una niña solitaria que conoce a un fauno en un antiguo laberinto. El fauno, una extraña criatura, le hace una sorprendente revelación: ella es en realidad una princesa, la última de su \r\nestirpe, y los suyos la esperan desde hace mucho tiempo. Para poder regresar a su mágico reino, la niña deberá enfrentarse a tres pruebas.'),
(8, 'Eduardo Manostijeras', 'Estados Unidos', 'Fantasía', 1990, 8, 'Un inventor que vive solo en un castillo crea a Edward, un hombre artificial. Sin embargo, el inventor muere antes de acabar su proyecto y deja a Edward con cuchillas en lugar de manos. Después de la muerte de su creador, Edward vive en la oscuridad hasta que conoce a Peg, que se lo lleva a su casa. Pronto Edward será conocido en el vecindario gracias a sus dotes de jardinería y peluquería. Sin embargo, los problemas empiezan cuando Edward se enamora de Kim, la hija de Peg.'),
(9, 'El secreto de sus ojos', 'Argentina', 'Drama', 2009, 9, 'Benjamín Espósito es un oficial de un Juzgado de Instrucción de Buenos Aires que acaba de jubilarse. Su sueño es escribir una novela y, \r\npara ello, intentará dar solución a un caso abierto desde hace varias décadas, del cual fue testigo y protagonista. Reviviendo el caso, vuelve también a su memoria el recuerdo de una mujer, a quien \r\nha amado en silencio durante todos esos años.'),
(10, 'Naufrago', 'Estados Unidos', 'Aventuras', 2000, 2, 'Tras una accidente aéreo, Chuck Noland, ingeniero de Federal Express, trata de sobrevivir durante años en una isla completamente desierta.'),
(11, 'El diario de Noa', 'Estados Unidos', 'Drama', 2004, 10, 'Historia de amor entre Allie Hamilton y Noah Calhoun y recordada en una residencia de ancianos, décadas después de que sucediera. Basada en el libro de Nicholas Sparks.'),
(12, 'La vida de Adele', 'Francia', 'Drama', 2013, 11, 'La película nos cuenta la historia de Adèle, una joven de 15 años que no tiene dudas en que un chico debe salir siempre con una chica, pero cuando una noche conoce a Emma, una joven de pelo azul, sus sentimientos e identidad sexual se volverán confusos y la someterán a un juicio de valores por parte de su familia y amigos.'),
(13, 'El silencio de los corderos', 'Estados Unidos', 'Terror, Suspense', 1991, 12, 'Tras una serie de crímenes donde a las víctimas les faltaba parte de la piel, una agente del FBI inicia su carrera particular para dar con el asesino. Para resolver el caso la agente encargada deberá envtrevistarse con el doctor Hannibal Lecter.'),
(14, 'El resplandor', 'Reino Unido', 'Terror', 1980, 13, 'Jack Torrance es un hombre que se muda con su familia a un hotel aislado que debe cuidar, con la esperanza de salir del bloqueo creativo de \r\nsu escritura. Mientras Jack no puede escapar del bloqueo, las visiones psíquicas de su hijo van en aumento.'),
(15, 'Sed de mal', 'Estados Unidos', 'Cine negro', 1958, 14, 'Un agente de la policía de narcóticos (Heston) llega a la frontera mexicana con su esposa justo en el momento en que explota una bomba. \r\nInmediatamente se hace cargo de la investigación contando con la colaboración de Quinlan (Welles), el jefe de la policía local, muy \r\nconocido en la zona por sus métodos expeditivos y poco ortodoxos. \r\nUna lucha feroz se desata entre los dos hombres, pues cada uno de \r\nellos tiene pruebas contra el otro.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actores`
--
ALTER TABLE `actores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actores_peliculas`
--
ALTER TABLE `actores_peliculas`
  ADD PRIMARY KEY (`idpelicula`,`idactor`),
  ADD KEY `idactor` (`idactor`);

--
-- Indices de la tabla `directores`
--
ALTER TABLE `directores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `director` (`director`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actores`
--
ALTER TABLE `actores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `directores`
--
ALTER TABLE `directores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actores_peliculas`
--
ALTER TABLE `actores_peliculas`
  ADD CONSTRAINT `actores_peliculas_ibfk_2` FOREIGN KEY (`idpelicula`) REFERENCES `peliculas` (`id`),
  ADD CONSTRAINT `actores_peliculas_ibfk_3` FOREIGN KEY (`idactor`) REFERENCES `actores` (`id`);

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`director`) REFERENCES `directores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
