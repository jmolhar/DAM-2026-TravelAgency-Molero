CREATE DATABASE IF NOT EXISTS xabi_travels;
USE xabi_travels;


CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `es_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`)
);

CREATE TABLE IF NOT EXISTS `viajes` (
  `id_viaje` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT 0,
  `tipo_viaje` varchar(50) NOT NULL,
  `plazas` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `continente` varchar(100) DEFAULT NULL,
  `destino` varchar(100) DEFAULT NULL,
  `itinerario` text DEFAULT NULL,
  PRIMARY KEY (`id_viaje`)
);

INSERT INTO `viajes` (`titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `precio`, `destacado`, `tipo_viaje`, `plazas`, `imagen`, `continente`, `destino`, `itinerario`) VALUES
('Escapada a Granada', 'Disfruta de la Alhambra y el encanto de Granada en este viaje de fin de semana.', '2026-03-15', '2026-03-17', 250.00, 1, 'Cultural', 20, '60granada.png', 'Europa', 'España', 'Día 1: Llegada y visita al centro.\nDía 2: Visita guiada a la Alhambra.\nDía 3: Tiempo libre y regreso.'),
('Aventura en Albacete', 'Descubre los paisajes ocultos de Albacete y su gastronomía única.', '2026-04-10', '2026-04-12', 150.00, 0, 'Aventura', 15, 'albacete.webp', 'Europa', 'España', 'Día 1: Ruta de senderismo.\nDía 2: Visita a bodegas locales.'),
('Buceo en Bolivia', 'Una experiencia única de buceo en altura en los lagos de Bolivia.', '2026-06-01', '2026-06-10', 1200.00, 1, 'Deportivo', 10, 'buceobolivia.webp', 'América', 'Bolivia', 'Día 1-3: Aclimatación y visitas culturales.\nDía 4-8: Inmersiones en el Lago Titicaca.\nDía 9-10: Regreso.'),
('Supercopa Balonmano', 'Viaje organizado para asistir a la final de la Supercopa de Balonmano.', '2026-05-20', '2026-05-22', 300.00, 0, 'Deportivo', 50, 'bmsupercopa.webp', 'Europa', 'España', 'Entradas incluidas para las semifinales y la final.'),
('Egipto Místico', 'Recorre las pirámides, el Nilo y los templos antiguos de la civilización egipcia.', '2026-09-05', '2026-09-15', 1800.00, 1, 'Cultural', 25, 'mujer-observa-puesta-de-sol-en-las-pirámides-de-guiza-mira-a-través-del-desierto-del-sahara.webp', 'África', 'Egipto', 'Día 1: Llegada a El Cairo.\nDía 2: Pirámides de Giza.\nDía 3-7: Crucero por el Nilo.\nDía 8-10: Hurghada.');


