-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2023 a las 01:24:48
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shop_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(4, 1, 'user1', 'user1@gmail.com', '8125700744', 'Hola, me gusta mucho su pagina!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_products` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(4, 1, 'Gael Alguiar', '8125700744', 'user1@gmail.com', 'Efectivo', '2820, Mirlos, Guadalupe, Nuevo Leon, Mexico - 67169', 'Licuadora Blender P3 (899 x 1) - TV Samsung 60 Pulgadas 4K (10299 x 1) - ', 11198, '2023-03-02', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `details` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_02` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_03` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(1, 'TV Samsung 60 Pulgadas 4K', 'Siente el realismo de la resolución UHD 4K y el brillo de tu televisor con HDR, un diseño minimalista y sin bordes ofrece una experiencia inmersiva, compatible con Barras de Sonido y bocinas Bluetooth. Conecta fácilmente los altavoces para disfrutar de una auténtica experiencia de sonido envolvente inalámbrico, con un sonido envolvente con graves profundos, altos nítidos y diálogos claros desde sus bocinas. ', 10299, 'tv-01.webp', 'tv-02.webp', 'tv-03.webp'),
(2, 'Cámara Canon Rebel T100', 'Disfruta de una visión instantánea en cada toma gracias al monitor o pantalla LCD de 2.7&#34;. Está fabricado con tecnología de muy alta precisión y más del 99.99% de pixeles efectivos. Tiene unas medidas de 22.09 x 16.51 x 13.71 cm.\r\n\r\nDentro de la caja encuentras: una cámara (con marco de ocular y tapa de cuerpo), correa, batería LP-E10 y cargador de batería. Video Full HD, fotografías de revista y tu gran pasión, eso y más obtienes con la cámara Canon Rebel T100. ', 13299, 'camera-1.webp', 'camera-2.webp', 'camera-3.webp'),
(5, 'Licuadora Blender P3', 'Potencia de 600 Watts, 3 velocidades manuales y una función de “Pulso”, evolucionaria cuchilla de acero inoxidable trituradora de hielo, vaso de vidrio refractario con capacidad para 4 litros, cuchilla 50% más grande que las cuchillas Oster tradicionales. Con cuchillas y base de la licuadora más anchas. Con tecnología reversible exclusiva de la marca Oster. Obtiene texturas y mezclas homogéneas ideales en licuados, salsas, sopas, tragos, postres, purés, y mucho más.', 899, 'mixer-1.webp', 'mixer-2.webp', 'mixer-3.webp'),
(6, 'Laptop Lenovo 20', 'Microsoft Surface Laptop Go PC portátil con pantalla táctil de 12.4 pulgadas, Intel Quad-Core i5-1035G1, 4 GB de RAM, 64 GB eMMC, cámara web, Win 10, Bluetooth. Hola', 5999, 'laptop-1.webp', 'laptop-2.webp', 'laptop-3.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'user1', 'user1@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
