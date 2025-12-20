--
-- Estructura de tabla para la tabla `BlogArticulos`
--

CREATE TABLE `BlogArticulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_publicacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `actualizado_en` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
  `bio` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id`, `nombre`, `email`, `password_hash`, `telefono`, `rol`, `creado_en`, `puesto`, `empresa`, `ciudad`, `estado`, `pais`, `imagen`, `bio`, `aprobado`) VALUES
(2, 'Benjamin Camacho', 'benjamin.camcho@rosaritocentro.com', '$2y$10$yD3xctau9lRuXCbggWzAKe9bgbNkdtp0rtkyqHkmWUbufPjnCyXsK', '5551594567', 'admin', '2025-06-16 06:46:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'Ana Sofía Méndez', 'ana.sofia@grupoaltamar.com', '$2y$10$e0NR1Qw1Qw1Qw1Qw1Qw1Qe0NR1Qw1Qw1Qw1Qw1Qw1Qw1Qw1Qw1Qw', '6611234567', 'directorio', '2025-12-01 10:00:00', 'Directora de Relaciones', 'Grupo Altamar', 'Ensenada', 'B.C.', 'México', NULL, 'Especialista en relaciones públicas y networking.', 1),
(4, 'Luis Alberto Castañeda', 'luis.casta@borderlink.com', '$2y$10$e0NR2Qw2Qw2Qw2Qw2Qw1Qe0NR2Qw2Qw2Qw2Qw2Qw2Qw2Qw2Qw', '6649876543', 'directorio', '2025-12-02 11:00:00', 'Socio Fundador', 'Borderlink Capital Partners', 'Tijuana', 'B.C.', 'México', NULL, 'Experto en inversiones y capital privado.', 0),
(5, 'Elena Ruiz', 'elena.ruiz@innovatrade.com', '$2y$10$e0NR3Qw3Qw3Qw3Qw3Qw1Qe0NR3Qw3Qw3Qw3Qw3Qw3Qw3Qw3Qw', '6865554321', 'directorio', '2025-12-03 12:00:00', 'Directora General', 'Innova Trade Group', 'Mexicali', 'B.C.', 'México', NULL, 'Líder en comercio exterior y logística.', 1),
(6, 'Carlos Pérez', 'carlos.perez@consulting.com', '$2y$10$e0NR4Qw4Qw4Qw4Qw4Qw1Qe0NR4Qw4Qw4Qw4Qw4Qw4Qw4Qw4Qw', '6641237890', 'directorio', '2025-12-04 13:00:00', 'Consultor Senior', 'Consulting Group', 'Tijuana', 'B.C.', 'México', NULL, 'Consultor en estrategia empresarial.', 0);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

