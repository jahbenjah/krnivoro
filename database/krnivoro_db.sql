-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-02-2026 a las 22:14:20
-- Versión del servidor: 5.7.23-23
-- Versión de PHP: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `krnivoro_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BlogArticulos`
--

CREATE TABLE `BlogArticulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_publicacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` enum('admin','directorio') COLLATE utf8_unicode_ci DEFAULT 'directorio',
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `puesto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `empresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pais` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `aprobado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `nombre`, `email`, `password_hash`, `telefono`, `rol`, `creado_en`, `puesto`, `empresa`, `ciudad`, `estado`, `pais`, `imagen`, `bio`, `aprobado`) VALUES
(2, 'Benjamin Camacho', 'benjamin.camcho@rosaritocentro.com', '$2y$10$yD3xctau9lRuXCbggWzAKe9bgbNkdtp0rtkyqHkmWUbufPjnCyXsK', '5551594567', 'admin', '2025-06-16 06:46:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Ana Sofía Méndez', 'ana.sofia@grupoaltamar.com', '$2y$10$e0NR1Qw1Qw1Qw1Qw1Qw1Qe0NR1Qw1Qw1Qw1Qw1Qw1Qw1Qw1Qw1Qw', '6611234567', 'directorio', '2025-12-01 16:00:00', 'Directora de Relaciones', 'Grupo Altamar', 'Ensenada', 'B.C.', 'México', NULL, 'Especialista en relaciones públicas y networking.', 1),
(4, 'Luis Alberto Castañeda', 'luis.casta@borderlink.com', '$2y$10$e0NR2Qw2Qw2Qw2Qw2Qw1Qe0NR2Qw2Qw2Qw2Qw2Qw2Qw2Qw2Qw', '6649876543', 'directorio', '2025-12-02 17:00:00', 'Socio Fundador', 'Borderlink Capital Partners', 'Tijuana', 'B.C.', 'México', NULL, 'Experto en inversiones y capital privado.', 0),
(5, 'Elena Ruiz', 'elena.ruiz@innovatrade.com', '$2y$10$e0NR3Qw3Qw3Qw3Qw3Qw1Qe0NR3Qw3Qw3Qw3Qw3Qw3Qw3Qw3Qw', '6865554321', 'directorio', '2025-12-03 18:00:00', 'Directora General', 'Innova Trade Group', 'Mexicali', 'B.C.', 'México', NULL, 'Líder en comercio exterior y logística.', 1),
(6, 'Carlos Pérez', 'carlos.perez@consulting.com', '$2y$10$e0NR4Qw4Qw4Qw4Qw4Qw1Qe0NR4Qw4Qw4Qw4Qw4Qw4Qw4Qw4Qw', '6641237890', 'directorio', '2025-12-04 19:00:00', 'Consultor Senior', 'Consulting Group', 'Tijuana', 'B.C.', 'México', NULL, 'Consultor en estrategia empresarial.', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `BlogArticulos`
--
ALTER TABLE `BlogArticulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `BlogArticulos`
--
ALTER TABLE `BlogArticulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Categorías (si no existen)
INSERT INTO BlogCategorias (nombre, slug) VALUES ('Mindset & Liderazgo', 'mindset-liderazgo');
INSERT INTO BlogCategorias (nombre, slug) VALUES ('Negocios & Estrategia', 'negocios-estrategia');

-- Artículo 1: El Hombre de Valor
INSERT INTO BlogArticulos (
  titulo, slug, autor, contenido, resumen, fecha_publicacion, estado, seo_title, seo_description, categoria_id
) VALUES (
  'El Hombre de Valor La filosofía KRNIVORO hecha historia',
  'el-hombre-de-valor',
  'Equipo KRNIVORO',
  '“El Hombre de Valor” — la filosofía KRNIVORO hecha historia.\n\nNO TODOS LOS HOMBRES SON IGUALES\nAlgunos se alimentan de excusas. Otros… de propósito.\nEl Hombre KRNIVORO no busca aprobación ni aplausos; busca precisión, energía y resultados.\nNo come por ansiedad, ni trabaja por ego. Se nutre para rendir, piensa para construir y se entrena para liderar.\nFUERZA ANTES QUE FORMA\nEn un mundo saturado de distracciones, el cuerpo se convierte en el primer reflejo del carácter.\nPor eso en KRNIVORO, la salud no es estética: es estrategia.\nLa dieta carnívora, los sueros IV, la medicina regenerativa, los entrenamientos funcionales y la suplementación inteligente no son moda — son el sistema operativo del líder moderno.\nCada corte de carne grass-fed, cada hora en el gimnasio, cada decisión en la mesa o en la junta… es parte de un solo objetivo: mantenerte indestructible.',
  'La filosofía KRNIVORO aplicada al liderazgo y salud.',
  '2025-10-17',
  'publicado',
  'El Hombre de Valor | KRNIVORO',
  'Descubre la filosofía KRNIVORO para líderes: salud, mindset y fuerza.',
  (SELECT id FROM BlogCategorias WHERE slug='mindset-liderazgo')
);

-- Artículo 2: KRNIVORO Business Week
INSERT INTO BlogArticulos (
  titulo, slug, autor, contenido, resumen, fecha_publicacion, estado, seo_title, seo_description, categoria_id
) VALUES (
  'KRNIVORO Business Week Lo más importante que debes saber',
  'krnivoro-business-week',
  'Equipo KRNIVORO',
  'KRNIVORO Business Week: Lo más importante que debes saber\nPanorama General\nEsta semana destaca por movimientos estratégicos en infraestructura, comercio exterior y reformas arancelarias que apuntan a ajustar el rumbo empresarial del país. Aquí tienes las piezas clave:\nMéxico encara retos de inversión en infraestructura\nA pesar de un aparente crecimiento en planes presupuestarios 2026, expertos advierten que el verdadero impulso está estancado. La inversión pública real muestra señales de fatiga, mientras que la iniciativa privada exige certidumbre y reglas claras.\nAranceles alineados con tendencias globales\nLa Presidencia revisa una reforma arancelaria ambiciosa para 2026 que busca adaptarse al nuevo mapa comercial mundial. Se espera que México redefina su estrategia con EE.UU., China y bloque regionales.\nFormación para la industria 4.0\nFrente a la ola de nearshoring, empiezan a surgir nuevas alianzas entre empresas y universidades para capacitar talento en competencias tecnológicas avanzadas. La meta: que México sea un polo de manufactura especializada.\nRecomendación estratégica\nMonitorea las reformas arancelarias: quienes ajusten rápido ganarán posición.\nInvolúcrate en programas de capacitación 4.0: tu ventaja competitiva estará ahí.\nEvalúa inversiones en activos tangibles (infraestructura privada) frente a incertidumbre pública.',
  'Resumen de la semana de negocios y estrategia en KRNIVORO.',
  '2025-10-17',
  'publicado',
  'KRNIVORO Business Week | KRNIVORO',
  'Lo más importante de la semana en negocios, estrategia y formación.',
  (SELECT id FROM BlogCategorias WHERE slug='negocios-estrategia')
);


-- --------------------------------------------------------
-- Modelo de base de datos para blogs optimizado para SEO

CREATE TABLE BlogCategorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE BlogEtiquetas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE BlogArticulos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  autor VARCHAR(100),
  contenido LONGTEXT NOT NULL,
  resumen TEXT,
  imagen_destacada VARCHAR(255),
  fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,
  actualizado_en TIMESTAMP NULL DEFAULT NULL,
  estado ENUM('publicado','borrador') DEFAULT 'borrador',
  seo_keywords VARCHAR(255),
  seo_title VARCHAR(255),
  seo_description VARCHAR(255),
  canonical_url VARCHAR(255),
  robots_meta VARCHAR(50),
  categoria_id INT,
  FOREIGN KEY (categoria_id) REFERENCES BlogCategorias(id)
);

CREATE TABLE BlogArticuloEtiquetas (
  articulo_id INT NOT NULL,
  etiqueta_id INT NOT NULL,
  PRIMARY KEY (articulo_id, etiqueta_id),
  FOREIGN KEY (articulo_id) REFERENCES BlogArticulos(id) ON DELETE CASCADE,
  FOREIGN KEY (etiqueta_id) REFERENCES BlogEtiquetas(id) ON DELETE CASCADE
);

CREATE TABLE BlogComentarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  articulo_id INT NOT NULL,
  nombre VARCHAR(100),
  email VARCHAR(100),
  comentario TEXT NOT NULL,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  aprobado TINYINT(1) DEFAULT 0,
  FOREIGN KEY (articulo_id) REFERENCES BlogArticulos(id) ON DELETE CASCADE
);


-- --------------------------------------------------------
-- Estructura de tabla para la tabla `UsuarioImagenes`
--
CREATE TABLE `UsuarioImagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `imagen_base64` longtext COLLATE utf8_unicode_ci NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `fk_usuario_imagen` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
