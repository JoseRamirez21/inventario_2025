-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 10-06-2025 a las 17:52:39
-- Versión del servidor: 5.7.39
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_JC`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes_institucion`
--

CREATE TABLE `ambientes_institucion` (
  `id` bigint(20) NOT NULL,
  `id_ies` int(11) NOT NULL,
  `encargado` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `detalle` varchar(300) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `otros_detalle` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ambientes_institucion`
--

INSERT INTO `ambientes_institucion` (`id`, `id_ies`, `encargado`, `codigo`, `detalle`, `otros_detalle`) VALUES
(1, 1, 'ys', '102B', 'AULA DPW 1', 'LABORATORIO'),
(2, 1, 'rrsss', '122', '121', '122'),
(3, 2, '', '213', '123', '123'),
(4, 1, 'prueba', 's', 's', 's'),
(5, 1, 'Ramirez Ramos', '1212', 'ventas', 'se compro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes`
--

CREATE TABLE `bienes` (
  `id` bigint(20) NOT NULL,
  `id_ingreso_bienes` int(11) NOT NULL,
  `id_ambiente` bigint(20) NOT NULL,
  `cod_patrimonial` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `denominacion` varchar(300) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `color` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `serie` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dimensiones` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `situacion` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado_conservacion` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `observaciones` varchar(400) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_registro` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `bienes`
--

INSERT INTO `bienes` (`id`, `id_ingreso_bienes`, `id_ambiente`, `cod_patrimonial`, `denominacion`, `marca`, `modelo`, `tipo`, `color`, `serie`, `dimensiones`, `valor`, `situacion`, `estado_conservacion`, `observaciones`, `fecha_registro`, `usuario_registro`, `estado`) VALUES
(1, 1, 2, '', 'PRUEBARRasdasd', 'PP', 'RR', 'UU', 'EE', 'BB', 'AA', '12.20', 'UUU', 'REGULARR', 'BIEN DE PRUENARRRsadasdasdsdasdasdasdasdasdsad', '2025-04-05 12:28:04', 1, 0),
(2, 1, 2, '1234567', 'S', 'S', 'S', 'S', 'S', 'S', 'S', '123.00', 'S', 'S', 'S', '2025-04-05 12:28:53', 1, 0),
(3, 6, 2, '123456', 'Bien de prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', 'prueba', '0.00', 'prueb', 'prueba', 'prueba', '2025-04-17 22:32:06', 1, 1),
(4, 6, 1, '11212', 'aasd', 'asdas', 'dasd', 'asdas', 'asdasd', 'asdas', 'dasdasd', '0.00', 'asdas', 'dasd', 'asd', '2025-04-17 22:34:24', 1, 1),
(5, 7, 1, '12312', '312', '312', '312', '123', '123', '213123', '123', '123.00', '123', '123123', '123', '2025-04-17 22:41:16', 1, 1),
(6, 8, 1, 'as', 'wqeasd', 'asd', 'asd', 'asdasd', 'asdas', 'asdasd', 'dsad', '0.00', 'dasd', 'asd', 'asd', '2025-04-17 22:42:29', 1, 1),
(7, 9, 1, 'sad', 'asd', 'asd', 'asd', 'asd', 'asdasd', 'asdasd', 'asdas', '0.00', 'asdas', 'asd', 'asd', '2025-04-17 22:42:45', 1, 1),
(8, 10, 1, '', 'jk', 'hk', 'hjk', 'hkj', 'hk', 'jh', 'kjh', '0.00', 'hkj', 'hkj', 'fd', '2025-04-17 22:46:41', 1, 1),
(9, 11, 1, 'hjasbdkj', 'lj', 'k', 'b', 'b', 'jb', 'kjb', 'jh', '0.00', 'hjklj', 'kl', 'j', '2025-04-22 15:18:04', 1, 1),
(10, 11, 1, '', 'jk', 'kj', 'jk', 'dfdf', 'kjj', 'jk', 'klj', '0.00', 'hjk', 'h', 'kjh', '2025-04-22 15:18:04', 1, 1),
(11, 12, 1, '', 'klñ', 'ñ', 'j', 'k', 'jkl', 'j', 'lkj', '0.00', 'jlk', 'j', 'lkj', '2025-04-22 15:50:52', 1, 1),
(12, 12, 1, '', 'kjkj', 'njk', 'nk', 'j', 'kjh', 'kj', 'hjk', '0.00', 'kh', 'jkh', 'ui', '2025-04-22 15:50:52', 1, 1),
(13, 12, 1, '', 'kjhk', 'hkj', 'hj', 'h', 'jkh', 'j', 'h', '0.00', 'k', 'hjk', 'sdf', '2025-04-22 15:50:52', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_movimiento`
--

CREATE TABLE `detalle_movimiento` (
  `id` bigint(20) NOT NULL,
  `id_movimiento` bigint(20) NOT NULL,
  `id_bien` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_movimiento`
--

INSERT INTO `detalle_movimiento` (`id`, `id_movimiento`, `id_bien`) VALUES
(1, 2, 3),
(2, 2, 4),
(3, 3, 3),
(4, 3, 4),
(5, 4, 7),
(6, 4, 3),
(7, 4, 4),
(8, 5, 3),
(9, 5, 4),
(10, 5, 1),
(11, 5, 8),
(12, 5, 7),
(13, 6, 1),
(14, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_bienes`
--

CREATE TABLE `ingreso_bienes` (
  `id` int(11) NOT NULL,
  `detalle` varchar(1000) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ingreso_bienes`
--

INSERT INTO `ingreso_bienes` (`id`, `detalle`, `id_usuario`, `fecha_registro`) VALUES
(1, 'primer ingreso', 1, '2025-04-17 13:31:07'),
(2, 'Ingreso de Bienes', 1, '2025-04-17 22:23:06'),
(3, 'Ingreso de Bienes', 1, '2025-04-17 22:32:06'),
(4, 'Ingreso de Bienes', 1, '2025-04-17 22:32:59'),
(5, 'Ingreso de Bienes', 1, '2025-04-17 22:34:05'),
(6, '234234', 1, '2025-04-17 22:34:24'),
(7, 'sdsd', 1, '2025-04-17 22:41:16'),
(8, 'asdasd', 1, '2025-04-17 22:42:29'),
(9, 'sadasd', 1, '2025-04-17 22:42:45'),
(10, 'sfaasf', 1, '2025-04-17 22:46:41'),
(11, 'transferencia del gore', 1, '2025-04-22 15:18:04'),
(12, 'ingreso de bienes de prueba', 1, '2025-04-22 15:50:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `beneficiario` int(11) NOT NULL,
  `cod_modular` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id`, `beneficiario`, `cod_modular`, `ruc`, `nombre`) VALUES
(1, 1, '0671107', '20608381385', 'huanta'),
(2, 3, '1231', '2144214', 'ayacucho'),
(3, 1, '235468', '3246842.031', 'Prueba'),
(4, 3, '1212', '212121212', 'dadsaasffaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) NOT NULL,
  `id_ambiente_origen` bigint(20) NOT NULL,
  `id_ambiente_destino` bigint(20) NOT NULL,
  `id_usuario_registro` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(2000) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_ies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `id_ambiente_origen`, `id_ambiente_destino`, `id_usuario_registro`, `fecha_registro`, `descripcion`, `id_ies`) VALUES
(1, 1, 4, 1, '2025-04-18 00:00:00', 'movimiento de prueba', 1),
(2, 1, 4, 1, '2025-04-18 00:00:00', 'movimiento de prueba', 1),
(3, 4, 1, 1, '2025-04-18 00:00:00', 'sas', 1),
(4, 1, 2, 1, '2025-04-21 00:00:00', 'ff', 1),
(5, 2, 1, 1, '2025-04-21 00:00:00', 'rt', 1),
(6, 1, 2, 1, '2025-04-22 00:00:00', 'jdsfsdkjf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime NOT NULL,
  `token` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id`, `id_usuario`, `fecha_hora_inicio`, `fecha_hora_fin`, `token`) VALUES
(1, 1, '2025-04-04 16:29:36', '2025-04-04 16:31:36', 'Nwk7ysUyIz)Itj7XM16MM4&xp#1xwQ'),
(2, 1, '2025-04-04 16:30:08', '2025-04-04 16:32:08', ']MOJmj[bnm[F0lbTw]czK&RE0(b]OO'),
(3, 1, '2025-04-04 16:32:01', '2025-04-04 22:16:08', 'xSme*)4BwdsR(w)lv&z{vN56w7Jduk'),
(4, 1, '2025-04-04 22:16:07', '2025-04-04 22:18:07', 'Fdz3]2fNNm/Dd96J89AtGn])87YG{b'),
(5, 1, '2025-04-04 22:16:17', '2025-04-04 22:18:05', 'U6ZveFDq8L)w*2(K}3qv3jsLNJM2Ge'),
(7, 1, '2025-04-04 22:22:50', '2025-04-04 22:29:21', 'z9j3[13PC8$u7yfG(5AwbW4eCIp(Ss'),
(8, 1, '2025-04-04 22:28:30', '2025-04-04 22:30:30', 'xfBz{8[PsKhIcI4x[SiF(Tn8l&5*[7'),
(9, 1, '2025-04-04 22:28:31', '2025-04-04 22:30:31', 'jjX)Y%G}e$dyASQKE@NtqWH2abV&sD'),
(10, 1, '2025-04-04 22:28:32', '2025-04-04 22:30:32', 'u%EB)bxP1wj/5onQ@{aLIWcsyh*%xn'),
(11, 1, '2025-04-04 22:28:55', '2025-04-04 22:30:55', 'ODKDpGdn%)BZI*R)TZC$ToslqFTzit'),
(12, 1, '2025-04-04 22:29:47', '2025-04-04 22:31:47', '9a&gCiI{@E6I9HbzEqUG7lm$e7ySFt'),
(13, 1, '2025-04-04 22:30:35', '2025-04-04 22:33:14', 'Xaj6%d7hmI0YcrPTj7nxkOGY]6)WC5'),
(14, 1, '2025-04-04 22:32:35', '2025-04-04 23:39:42', 'rGU%cjZm%OP(0RZ1jIQJ}0Ns}zm8O@'),
(15, 1, '2025-04-05 11:37:22', '2025-04-05 13:59:19', '$ywNpMwR/HlcLf71cb5HaYJV]5ids('),
(16, 1, '2025-04-07 20:59:24', '2025-04-07 22:59:50', 'D0md%s7R0FTK]{21trnSJkmDvsBkSz'),
(17, 1, '2025-04-08 09:19:33', '2025-04-08 09:25:56', '[ZcY#UnB$S#cBSoyf@cSpF)TCaefw@'),
(18, 1, '2025-04-08 21:41:02', '2025-04-08 21:43:02', 'Kw}}E0A12CXsIoInE(1V28)1UWWxX['),
(19, 1, '2025-04-08 21:41:11', '2025-04-08 23:39:07', 'jUpdfvsD3VDp17A7Uhs6xSwryPZWt&'),
(20, 1, '2025-04-15 15:17:22', '2025-04-15 18:34:28', 'mx[7aYCLlvsbfyvZLJ[k%ea#ZN&LQU'),
(21, 1, '2025-04-16 10:32:27', '2025-04-16 10:47:02', '}$K]bKqGQ@BXEfDj(DVvBzNygOwkPd'),
(22, 1, '2025-04-16 21:14:53', '2025-04-16 21:37:47', ']p]#9us03N8mtqTRQT8Y#1g7QY*q)9'),
(23, 1, '2025-04-17 13:31:57', '2025-04-17 23:04:48', ']JHHCm%6OCeZGpIkK%v}{YX)GC1u/A'),
(24, 1, '2025-04-18 10:50:05', '2025-04-18 12:49:12', '#Vxl3OP6A7H$OncAf{VCpldCjH)O6T'),
(25, 1, '2025-04-21 20:21:24', '2025-04-21 23:35:27', 'Z5HZY{Rq1pruf6kvNg]V3yRvWmbLSE'),
(26, 1, '2025-04-22 15:16:21', '2025-04-22 15:55:05', 'UcD@)T%3)0@Kb$NPAYWt[Hcxg&N$*p'),
(27, 1, '2025-04-25 23:00:03', '2025-04-25 23:05:24', 'LBD4)}(SXASrzkuK&hj%aOKz((]xvv'),
(28, 1, '2025-05-06 10:10:30', '2025-05-06 11:47:41', '855WtqFhd1#k@D2MoOlsV*i[nisWN4'),
(29, 1, '2025-05-06 11:48:37', '2025-05-06 11:57:37', 'G@MDwO#zR1}$kRUnMj[SqF]juPGErS'),
(30, 1, '2025-05-06 11:56:47', '2025-05-06 12:52:13', '5#ZY*UA8F{oci%7pU2Q]*JiF$q0gUc'),
(31, 1, '2025-05-12 11:44:18', '2025-05-12 12:19:28', 'Mi5Ve)g4PiMfDN#wPC[}kO[Akvjol1'),
(32, 5, '2025-05-12 12:18:37', '2025-05-12 12:19:37', 'p&/W}hg6d52Ji(3ZE1EKj&x/N4opTn'),
(33, 1, '2025-05-13 07:58:12', '2025-05-13 08:01:29', '7]11(pN][sv8[MuhzyL&W#ldbTLCZr'),
(34, 1, '2025-05-13 08:00:59', '2025-05-13 08:02:13', '&7&{0$*L}oWr5JTeFTmwf)[[9*xtGp'),
(35, 6, '2025-05-13 08:01:27', '2025-05-13 12:13:42', 'Y%9C6iKKM)sK&1FBdogniO(oTWeTzI'),
(36, 1, '2025-05-13 12:12:50', '2025-05-13 12:53:37', '3]57/x$Gi69TLSMD*P%quDWMXRFQAj'),
(37, 1, '2025-05-20 08:38:13', '2025-05-20 12:23:57', '@8$2}yoRW24{g/mj4lBl#2&{PhAz0r'),
(38, 6, '2025-05-20 12:23:16', '2025-05-20 12:50:07', '%xrJ%tYH%cuvSlfyt9NzX#84Jo5Gqy'),
(39, 1, '2025-06-03 08:41:46', '2025-06-03 08:43:06', 'ryJE1WD$ET(H*[zx8KhHnwIu1b1lRz'),
(40, 6, '2025-06-03 08:42:21', '2025-06-03 08:44:22', 'FEiuqdSeZEOfSq1GPytWK5%G)$@x5e'),
(41, 1, '2025-06-03 08:50:37', '2025-06-03 08:52:16', 'hLaswsSLQqCi5}OJ/x3bds#[3D{Wz6'),
(42, 6, '2025-06-03 08:51:31', '2025-06-03 10:47:05', '6741#R3#%#T4$FK/e}n}Pigr{Uy9MA'),
(43, 6, '2025-06-03 10:46:20', '2025-06-03 11:04:48', 'm]kyL{W4xAGz6SO(7AJhl{OUY9k[ss'),
(44, 6, '2025-06-03 11:27:26', '2025-06-03 11:51:28', 'vh/*%rAGGcnmdqjnt)5BovnC)QjfQF'),
(45, 6, '2025-06-03 11:50:46', '2025-06-03 12:44:05', 'ZlwtdZX*wOVhRY}yNY*v*YMPsoou[O'),
(46, 1, '2025-06-10 09:47:21', '2025-06-10 09:48:38', 'asCZD)Ld%{]ebqofCg@D9tzj5H]dGk'),
(47, 6, '2025-06-10 09:47:50', '2025-06-10 10:02:59', 'r2$u90AYGveRijWr/v%2#{VNUZe6jA'),
(48, 1, '2025-06-10 10:10:30', '2025-06-10 10:13:48', 'lbw/$/FYVQRRw9xbf65S1wOtVv8kd%'),
(49, 7, '2025-06-10 10:13:01', '2025-06-10 12:49:59', 'fWJtqNrKQA5s&]LepvosoGm3NQ]&Kg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `dni` varchar(11) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombres_apellidos` varchar(140) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `password` varchar(1000) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `reset_password` int(1) NOT NULL DEFAULT '0',
  `token_password` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '',
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombres_apellidos`, `correo`, `telefono`, `estado`, `password`, `reset_password`, `token_password`, `fecha_registro`) VALUES
(1, '11112222', 'admin', 'admin@gmail.comm', '987654321', 1, '$2y$10$IeNRkcso2I60YiFEo8gKmeQEyWhTVq9TETpTgSenx380IaeWOSbv6', 1, 'ABOLnG*L)7[kzZiX@8BlC%Ls7SiKLN', '2025-04-04 16:20:51'),
(2, '70198965', 'yucra curo ', 'yucrac@gmail.com', '12345611', 1, '$2y$10$eYm6sJB.gf6SWDfad1CDT.ZHcpTBI/3XfL/fA5KT4KXdv3ZgPSW6C', 0, '', '2025-04-04 16:54:14'),
(3, 'ss', 'ss', 'ss', 'ss', 1, '$2y$10$o4roS5UGJWwdbRqzLD7QYexqmtnZli9blSKQGfdAFXL6K7h0Ef1Bq', 0, '', '2025-04-04 21:20:33'),
(4, '1111', 'jose', 'joseK@c.com', '342341', 1, '$2y$10$5OkeFTMoLKN9wekkfKhZoOWxe0C/s818qNbM9zAdDnJT6TOuAFCeC', 0, '', '2025-05-12 11:50:59'),
(5, '1212', 'jose', 'sads@.com', '12121', 1, '$2y$10$0kw/tCThdvSXh7ALElBYbec3EL/XMj0Cal49piOH7N3Fv.vSHQ0em', 0, '', '2025-05-12 12:18:29'),
(7, '76122823', 'Ramirez Ramos', 'josexitorap@gmail.com', '901267943', 1, '$2y$10$mSItRbggeSa5uS0Up0ODMOEQCo0A9FDNshojYUkj/919M1O6ISDiO', 1, 'y6)8BWjcusiBNRf7z$XJ1%G#Uar0jL', '2025-06-10 10:12:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambientes_institucion`
--
ALTER TABLE `ambientes_institucion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ies` (`id_ies`);

--
-- Indices de la tabla `bienes`
--
ALTER TABLE `bienes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ambiente` (`id_ambiente`),
  ADD KEY `usuario_registro` (`usuario_registro`),
  ADD KEY `id_ingreso_bienes` (`id_ingreso_bienes`);

--
-- Indices de la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bien` (`id_bien`),
  ADD KEY `id_movimiento` (`id_movimiento`);

--
-- Indices de la tabla `ingreso_bienes`
--
ALTER TABLE `ingreso_bienes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiario` (`beneficiario`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ambiente_origen` (`id_ambiente_origen`),
  ADD KEY `id_ambiente_destino` (`id_ambiente_destino`),
  ADD KEY `id_usuario_registro` (`id_usuario_registro`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambientes_institucion`
--
ALTER TABLE `ambientes_institucion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `bienes`
--
ALTER TABLE `bienes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ingreso_bienes`
--
ALTER TABLE `ingreso_bienes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ambientes_institucion`
--
ALTER TABLE `ambientes_institucion`
  ADD CONSTRAINT `ambientes_institucion_ibfk_1` FOREIGN KEY (`id_ies`) REFERENCES `institucion` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `bienes`
--
ALTER TABLE `bienes`
  ADD CONSTRAINT `bienes_ibfk_1` FOREIGN KEY (`id_ambiente`) REFERENCES `ambientes_institucion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bienes_ibfk_2` FOREIGN KEY (`usuario_registro`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bienes_ibfk_3` FOREIGN KEY (`id_ingreso_bienes`) REFERENCES `ingreso_bienes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD CONSTRAINT `detalle_movimiento_ibfk_1` FOREIGN KEY (`id_bien`) REFERENCES `bienes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_movimiento_ibfk_2` FOREIGN KEY (`id_movimiento`) REFERENCES `movimientos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso_bienes`
--
ALTER TABLE `ingreso_bienes`
  ADD CONSTRAINT `ingreso_bienes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD CONSTRAINT `institucion_ibfk_1` FOREIGN KEY (`beneficiario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`id_ambiente_origen`) REFERENCES `ambientes_institucion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`id_ambiente_destino`) REFERENCES `ambientes_institucion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`id_usuario_registro`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
