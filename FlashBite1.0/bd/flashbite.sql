-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2026 a las 23:58:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `flashbite`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combos`
--

CREATE TABLE `combos` (
  `id_combo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio_original` decimal(8,2) NOT NULL,
  `precio_descuento` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `estado` enum('Disponible','Agotado') DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `combos`
--

INSERT INTO `combos` (`id_combo`, `nombre`, `descripcion`, `precio_original`, `precio_descuento`, `stock`, `imagen`, `estado`) VALUES
(1, ' Combo Ahorro', 'Hamburguesa Clásica + Papas + Gaseosa', 35.90, 24.90, 9, 'combo1.jpg', 'Disponible'),
(2, ' Combo Pizza Lovers', 'Pizza Personal + Brownie + Gaseosa', 42.90, 29.90, 0, 'combo2.jpg', 'Disponible'),
(3, ' Combo Familiar', '2 Pollos Broaster + Papas Familiares + 2 Gaseosas', 68.90, 49.90, 4, 'combo3.jpg', 'Disponible'),
(4, ' Combo Saludable', 'Ensalada César + Jugo Natural', 26.90, 18.90, 12, 'combo4.jpg', 'Disponible'),
(5, ' Combo Nocturno', 'Hamburguesa BBQ + Papas + Bebida', 38.90, 27.90, 7, 'combo5.jpg', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo` enum('producto','combo') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `direccion_entrega` varchar(200) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(30) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `direccion_entrega`, `fecha`, `estado`) VALUES
(4, 1, 'general varela 233', '2026-07-08 21:41:03', 'Pendiente'),
(5, 1, 'general varela 233', '2026-07-08 21:49:02', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio_original` decimal(8,2) DEFAULT NULL,
  `precio_descuento` decimal(8,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `es_oferta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio_original`, `precio_descuento`, `stock`, `imagen`, `es_oferta`) VALUES
(1, 'Pizza Familiar', 'Pizza con queso y pepperoni', 40.00, 25.00, 17, 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38', 1),
(2, 'Hamburguesa', 'Hamburguesa doble carne', 30.00, 18.00, 20, 'https://images.unsplash.com/photo-1550547660-d9450f859349', 0),
(3, 'Pollo Broaster', 'Pollo crocante con papas', 28.00, 15.00, 19, 'https://images.unsplash.com/photo-1504674900247-0877df9cc836', 1),
(4, 'Ensalada', 'Ensalada saludable fresca', 20.00, 10.00, 18, 'https://images.unsplash.com/photo-1529042410759-befb1204b468', 0),
(5, 'Pay de Limón', 'Una tajada', 9.00, 5.00, 19, 'https://www.cocinadelirante.com/sites/default/files/images/2024/09/como-hacer-el-pay-de-limon-helado-estilo-vips-con-leche-condensada.jpg', 1),
(6, 'Pay de Manzana', 'Para 20 personas', 70.00, 29.50, 17, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSG0khN8AC5_GOFrJn-1dxRQOU03Jb3UndFA&s', 0),
(7, 'Brownie', '16 piezas', 35.00, 19.30, 14, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwXDgxkhDSo59_ajNGWe6kJ4T4DEOle-AQ5A&s', 0),
(8, 'Donas', 'Caja de 6 unidades', 65.40, 30.00, 19, 'https://pbs.twimg.com/media/BbNLddDCEAEVXRx.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `metodo_pago` varchar(30) DEFAULT NULL,
  `cuenta_pago` varchar(30) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `modo` varchar(10) NOT NULL DEFAULT 'claro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contraseña`, `telefono`, `direccion`, `metodo_pago`, `cuenta_pago`, `fecha_registro`, `modo`) VALUES
(1, 'MARYO', 'maryo@gmail.com', '123456', '958083218', 'No registrada', NULL, NULL, '2026-07-14 17:48:27', 'claro'),
(8, 'Maryori Mirella', 'mirella123@gmail.com', '123456', '958083218', 'No registrada', 'Mastercard', '2012356734328164', '2026-07-16 16:18:23', 'claro'),
(9, 'Dayana Prado', 'dayanaprado@gmail.com', '1234567892', '947113389', 'No registrada', 'Yape', '947113389', '2026-07-16 17:42:04', 'oscuro'),
(24, 'Sesar Jose Montes Pereida', 'sesarmontes@gmail.com', '123456', '945873248', 'No registrada', 'Plin', '154877264', '2026-07-16 21:12:17', 'claro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id_combo`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_pedido` (`id_pedido`),
  ADD KEY `fk_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `combos`
--
ALTER TABLE `combos`
  MODIFY `id_combo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
