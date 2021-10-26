-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 26, 2021 lúc 03:43 PM
-- Phiên bản máy phục vụ: 5.7.24
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `luanvan2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `idkhuvuc` bigint(20) UNSIGNED NOT NULL,
  `tenban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trangthai` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Rãnh - 1: Bận',
  `hidden` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Hiện - 1: Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`id`, `idquan`, `idkhuvuc`, `tenban`, `trangthai`, `hidden`) VALUES
(10, 1, 3, 'Bàn 1', 0, 0),
(11, 1, 3, 'Bàn 2', 0, 0),
(12, 1, 3, 'Bàn 3', 0, 0),
(13, 1, 2, 'Bàn 1', 0, 0),
(14, 1, 2, 'Bàn 2', 0, 0),
(15, 1, 2, 'Bàn 3', 0, 0),
(16, 1, 3, 'Bàn 4', 0, 0),
(17, 1, 3, 'Bàn 5', 0, 0),
(21, 1, 2, 'Bàn 4', 0, 0),
(22, 1, 3, 'Bàn 6', 0, 0),
(23, 1, 5, 'Bàn 1', 0, 0),
(24, 1, 5, 'Bàn 2', 0, 0),
(25, 1, 5, 'Bàn 3', 0, 0),
(26, 1, 5, 'Bàn 4', 0, 0),
(27, 1, 4, 'Bàn 1', 0, 0),
(28, 1, 4, 'Bàn 2', 0, 0),
(29, 1, 4, 'Bàn 3', 0, 0),
(30, 1, 4, 'Bàn 4', 0, 0),
(31, 1, 1, 'Bàn 1', 0, 0),
(32, 1, 1, 'Bàn 2', 0, 0),
(33, 1, 1, 'Bàn 3', 0, 0),
(34, 1, 1, 'Bàn 4', 0, 0),
(35, 1, 1, 'Bàn 5', 0, 0),
(36, 1, 1, 'Bàn 6', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `calam`
--

CREATE TABLE `calam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `tencalam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tu` time NOT NULL,
  `den` time NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Hiện - 1: Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `calam`
--

INSERT INTO `calam` (`id`, `idquan`, `tencalam`, `tu`, `den`, `hidden`) VALUES
(1, 1, 'Sáng', '05:00:00', '10:00:00', 0),
(2, 1, 'Trưa', '10:00:00', '15:00:00', 0),
(3, 1, 'Chiều', '15:00:00', '20:00:00', 0),
(4, 1, 'Tối', '20:00:00', '12:00:00', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet`
--

CREATE TABLE `chitiet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idhoadon` bigint(20) UNSIGNED NOT NULL,
  `idthucdon` bigint(20) UNSIGNED NOT NULL,
  `soluong` bigint(20) UNSIGNED NOT NULL,
  `gia` bigint(20) NOT NULL,
  `ghichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` bigint(20) NOT NULL DEFAULT '0',
  `phucvu` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giamgia`
--

CREATE TABLE `giamgia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `hoadontodiem` bigint(20) UNSIGNED NOT NULL,
  `diemtohoadon` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giamgia`
--

INSERT INTO `giamgia` (`id`, `idquan`, `hoadontodiem`, `diemtohoadon`) VALUES
(1, 1, 10000, 1000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `idkhuvuc` bigint(20) UNSIGNED NOT NULL,
  `idban` bigint(20) UNSIGNED NOT NULL,
  `idthanhvien` bigint(20) UNSIGNED NOT NULL,
  `idkhachhang` bigint(20) UNSIGNED DEFAULT NULL,
  `thoigian` datetime NOT NULL,
  `giamgia` bigint(20) NOT NULL DEFAULT '0',
  `thanhtien` bigint(20) NOT NULL DEFAULT '0',
  `trangthai` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Chưa xong - 1: Đã thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonluu`
--

CREATE TABLE `hoadonluu` (
  `id` bigint(20) NOT NULL,
  `idquan` bigint(20) DEFAULT NULL,
  `idhoadon` bigint(20) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `tenkhuvuc` varchar(255) DEFAULT NULL,
  `tenban` varchar(255) DEFAULT NULL,
  `tenthanhvien` varchar(255) DEFAULT NULL,
  `tenkhachhang` varchar(255) DEFAULT NULL,
  `sdtkh` bigint(20) DEFAULT NULL,
  `loaimon` varchar(255) DEFAULT NULL,
  `tenmon` varchar(255) DEFAULT NULL,
  `dongia` bigint(20) DEFAULT NULL,
  `soluong` bigint(20) DEFAULT NULL,
  `gia` bigint(20) DEFAULT NULL,
  `giamgia` bigint(20) DEFAULT NULL,
  `thanhtien` bigint(20) DEFAULT NULL,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoadonluu`
--

INSERT INTO `hoadonluu` (`id`, `idquan`, `idhoadon`, `thoigian`, `tenkhuvuc`, `tenban`, `tenthanhvien`, `tenkhachhang`, `sdtkh`, `loaimon`, `tenmon`, `dongia`, `soluong`, `gia`, `giamgia`, `thanhtien`, `ghichu`) VALUES
(139, 1, 6, '2021-09-24 02:20:49', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', 'Bùi Hữu Chánh', 918624198, NULL, NULL, NULL, NULL, NULL, 16000, 70000, NULL),
(140, 1, 139, '2021-09-24 02:20:49', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 2, 50000, NULL, NULL, NULL),
(141, 1, 139, '2021-09-24 02:20:49', NULL, NULL, NULL, NULL, NULL, '1', 'Nước chanh', 18000, 2, 36000, NULL, NULL, NULL),
(142, 1, 7, '2021-09-24 02:31:35', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 106000, NULL),
(143, 1, 142, '2021-09-24 02:31:35', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 1, 25000, NULL, NULL, NULL),
(144, 1, 142, '2021-09-24 02:31:35', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 1, 35000, NULL, NULL, NULL),
(145, 1, 142, '2021-09-24 02:31:35', NULL, NULL, NULL, NULL, NULL, '1', 'Nước chanh', 18000, 1, 18000, NULL, NULL, NULL),
(146, 1, 142, '2021-09-24 02:31:35', NULL, NULL, NULL, NULL, NULL, '2', 'SODA', 28000, 1, 28000, NULL, NULL, NULL),
(147, 1, 1, '2021-09-26 10:02:59', 'Phòng lạnh', 'Bàn 2', 'PHUCVUquan1', 'Bùi Hữu Chánh', 918624198, NULL, NULL, NULL, NULL, NULL, 5000, 90000, NULL),
(148, 1, 147, '2021-09-26 10:02:59', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 2, 70000, NULL, NULL, NULL),
(149, 1, 147, '2021-09-26 10:02:59', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 1, 25000, NULL, NULL, NULL),
(150, 1, 1, '2021-09-27 10:13:14', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', 'Bùi Hữu Chánh', 918624198, NULL, NULL, NULL, NULL, NULL, 10000, 85000, NULL),
(151, 1, 150, '2021-09-27 10:13:14', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 1, 25000, NULL, NULL, NULL),
(152, 1, 150, '2021-09-27 10:13:14', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 2, 70000, NULL, NULL, NULL),
(153, 1, 4, '2021-09-27 10:48:11', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', 'Võ Thị Quý Mỹ', 899152095, NULL, NULL, NULL, NULL, NULL, 0, 924000, NULL),
(154, 1, 153, '2021-09-27 10:48:11', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 2, 70000, NULL, NULL, NULL),
(155, 1, 153, '2021-09-27 10:48:11', NULL, NULL, NULL, NULL, NULL, '3', 'Rau muống xào tỏi', 30000, 1, 30000, NULL, NULL, NULL),
(156, 1, 153, '2021-09-27 10:48:11', NULL, NULL, NULL, NULL, NULL, '2', 'Gà hấp hành', 200000, 2, 400000, NULL, NULL, NULL),
(157, 1, 153, '2021-09-27 10:48:11', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 2, 400000, NULL, NULL, NULL),
(158, 1, 153, '2021-09-27 10:48:11', NULL, NULL, NULL, NULL, NULL, '3', 'Sữa chua', 12000, 2, 24000, NULL, NULL, NULL),
(159, 1, 4, '2021-10-05 18:53:55', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 375000, NULL),
(160, 1, 159, '2021-10-05 18:53:55', NULL, NULL, NULL, NULL, NULL, '2', 'Bê tái chanh Bê tái chanh Bê tái chanh Bê tái chanh', 150000, 1, 150000, NULL, NULL, NULL),
(161, 1, 159, '2021-10-05 18:53:55', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(162, 1, 159, '2021-10-05 18:53:55', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 1, 25000, NULL, NULL, NULL),
(163, 1, 5, '2021-10-05 18:54:57', 'Phòng lạnh', 'Bàn 3', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 45000, NULL),
(164, 1, 163, '2021-10-05 18:54:57', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 1, 35000, NULL, NULL, NULL),
(165, 1, 163, '2021-10-05 18:54:57', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm trắng', 10000, 1, 10000, NULL, NULL, NULL),
(166, 1, 6, '2021-10-05 19:01:33', 'Phòng lạnh', 'Bàn 5', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 12000, NULL),
(167, 1, 166, '2021-10-05 19:01:33', NULL, NULL, NULL, NULL, NULL, '3', 'Sữa chua', 12000, 1, 12000, NULL, NULL, NULL),
(168, 1, 9, '2021-10-05 19:40:03', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 200000, NULL),
(169, 1, 168, '2021-10-05 19:40:03', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(170, 1, 10, '2021-10-05 19:45:29', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 15000, NULL),
(171, 1, 170, '2021-10-05 19:45:29', NULL, NULL, NULL, NULL, NULL, '3', 'Khoai tây chiên', 15000, 1, 15000, NULL, NULL, NULL),
(172, 1, 13, '2021-10-05 20:00:58', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', 'Bùi Hữu Châu', 763232505, NULL, NULL, NULL, NULL, NULL, 0, 220000, NULL),
(173, 1, 172, '2021-10-05 20:00:58', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(174, 1, 172, '2021-10-05 20:00:58', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm trắng', 10000, 2, 20000, NULL, NULL, NULL),
(175, 1, 1, '2021-10-06 18:04:08', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 375000, 'khách khó tính'),
(176, 1, 175, '2021-10-06 18:04:08', NULL, NULL, NULL, NULL, NULL, '2', 'Bê tái chanh Bê tái chanh Bê tái chanh Bê tái chanh', 150000, 1, 150000, NULL, NULL, NULL),
(177, 1, 175, '2021-10-06 18:04:08', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(178, 1, 175, '2021-10-06 18:04:08', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 1, 25000, NULL, NULL, NULL),
(179, 1, 2, '2021-10-06 18:11:20', 'Phòng lạnh', 'Bàn 3', 'CHUQUANquan1', 'Võ Thị Quý Mỹ', 899152095, NULL, NULL, NULL, NULL, NULL, 5000, 40000, NULL),
(180, 1, 179, '2021-10-06 18:11:20', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 1, 35000, NULL, NULL, NULL),
(181, 1, 179, '2021-10-06 18:11:20', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm trắng', 10000, 1, 10000, NULL, NULL, NULL),
(182, 1, 3, '2021-10-06 18:46:31', 'Phòng lạnh', 'Bàn 5', 'CHUQUANquan1', 'Bùi Hữu Châu', 763232505, NULL, NULL, NULL, NULL, NULL, 22000, 26000, 'bạn của chủ quán'),
(183, 1, 182, '2021-10-06 18:46:31', NULL, NULL, NULL, NULL, NULL, '1', 'Nước chanh', 18000, 1, 18000, NULL, NULL, NULL),
(184, 1, 182, '2021-10-06 18:46:31', NULL, NULL, NULL, NULL, NULL, '3', 'Rau muống xào tỏi', 30000, 1, 30000, NULL, NULL, NULL),
(185, 1, 1, '2021-10-17 08:27:00', 'Phòng lạnh', 'Bàn 1', 'PHUCVUquan1', 'Bùi Hữu Chánh', 918624198, NULL, NULL, NULL, NULL, NULL, 4000, 768000, NULL),
(186, 1, 185, '2021-10-17 08:27:00', NULL, NULL, NULL, NULL, NULL, '2', 'Bê tái chanh Bê tái chanh Bê tái chanh Bê tái chanh', 150000, 2, 300000, NULL, NULL, NULL),
(187, 1, 185, '2021-10-17 08:27:00', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 2, 400000, NULL, NULL, NULL),
(188, 1, 185, '2021-10-17 08:27:00', NULL, NULL, NULL, NULL, NULL, '1', 'Nước chanh', 18000, 4, 72000, NULL, NULL, NULL),
(189, 1, 2, '2021-10-17 08:53:56', 'Phòng lạnh', 'Bàn 1', 'PHUCVUquan1', 'Bùi Hữu Chánh', 918624198, NULL, NULL, NULL, NULL, NULL, 17000, 273000, 'khách quen'),
(190, 1, 189, '2021-10-17 08:53:56', NULL, NULL, NULL, NULL, NULL, '1', 'Nước chanh', 18000, 5, 90000, NULL, NULL, NULL),
(191, 1, 189, '2021-10-17 08:53:56', NULL, NULL, NULL, NULL, NULL, '2', 'Thịt kho tàu', 100000, 2, 200000, NULL, NULL, NULL),
(192, 1, 3, '2021-10-17 17:53:20', 'Sân thượng', 'Bàn 1 Sân thượng', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 350000, NULL),
(193, 1, 192, '2021-10-17 17:53:20', NULL, NULL, NULL, NULL, NULL, '2', 'Bê tái chanh Bê tái chanh Bê tái chanh Bê tái chanh', 150000, 1, 150000, NULL, NULL, NULL),
(194, 1, 192, '2021-10-17 17:53:20', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(195, 1, 4, '2021-10-17 18:04:53', 'Sân thượng', 'Bàn 2 Sân thượng', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 200000, NULL),
(196, 1, 195, '2021-10-17 18:04:53', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(197, 1, 6, '2021-10-17 18:14:41', 'Phòng lạnh', 'Bàn 1', 'CHUQUANquan1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 410000, NULL),
(198, 1, 197, '2021-10-17 18:14:41', NULL, NULL, NULL, NULL, NULL, '2', 'Bê tái chanh Bê tái chanh Bê tái chanh Bê tái chanh', 150000, 1, 150000, NULL, NULL, NULL),
(199, 1, 197, '2021-10-17 18:14:41', NULL, NULL, NULL, NULL, NULL, '2', 'Bò trứng', 200000, 1, 200000, NULL, NULL, NULL),
(200, 1, 197, '2021-10-17 18:14:41', NULL, NULL, NULL, NULL, NULL, '3', 'Cooktail', 25000, 1, 25000, NULL, NULL, NULL),
(201, 1, 197, '2021-10-17 18:14:41', NULL, NULL, NULL, NULL, NULL, '2', 'Cơm sườn', 35000, 1, 35000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `hotenkh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` bigint(20) NOT NULL,
  `ngaydangky` date NOT NULL,
  `diem` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id`, `idquan`, `hotenkh`, `sdt`, `ngaydangky`, `diem`) VALUES
(8, 1, 'Bùi Hữu Chánh', 918624198, '2021-09-22', 177),
(9, 1, 'Bùi Hữu Châu', 763232505, '2021-09-22', 3),
(10, 1, 'Võ Thị Quý Mỹ', 899152095, '2021-09-22', 91);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

CREATE TABLE `kho` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `idnguyenlieu` bigint(20) UNSIGNED NOT NULL,
  `dongia` bigint(20) UNSIGNED NOT NULL,
  `soluong` bigint(20) UNSIGNED NOT NULL,
  `thanhtien` bigint(20) NOT NULL,
  `ngaynhap` date NOT NULL,
  `ngayhet` date DEFAULT NULL,
  `trangthai` bigint(20) NOT NULL DEFAULT '1' COMMENT '1: còn hàng, 0: hết hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`id`, `idquan`, `idnguyenlieu`, `dongia`, `soluong`, `thanhtien`, `ngaynhap`, `ngayhet`, `trangthai`) VALUES
(12, 1, 2, 3000, 2000, 6000000, '2021-02-13', '2021-08-30', 0),
(13, 1, 1, 18000, 250, 4500000, '2021-03-13', '2021-08-30', 0),
(14, 1, 4, 50000, 110, 5500000, '2021-04-13', '2021-08-30', 0),
(15, 1, 2, 5000, 1000, 5000000, '2021-05-13', '2021-09-12', 0),
(16, 1, 1, 20000, 250, 5000000, '2021-06-13', NULL, 1),
(17, 1, 4, 45000, 99, 4455000, '2021-07-13', '2021-09-26', 0),
(18, 1, 2, 6000, 900, 5400000, '2021-08-13', NULL, 1),
(19, 1, 4, 50000, 100, 5000000, '2021-09-26', '2021-09-26', 0),
(20, 1, 4, 42000, 200, 8400000, '2021-09-26', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuvuc`
--

CREATE TABLE `khuvuc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `tenkhuvuc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0: Hiện - 1: Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuvuc`
--

INSERT INTO `khuvuc` (`id`, `idquan`, `tenkhuvuc`, `hidden`) VALUES
(1, 1, 'Vỉa hè', '0'),
(2, 1, 'Sân thượng', '0'),
(3, 1, 'Phòng lạnh', '0'),
(4, 1, 'Sân trước', '0'),
(5, 1, 'Phòng VIP', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichlamviec`
--

CREATE TABLE `lichlamviec` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `idcalam` bigint(20) UNSIGNED NOT NULL,
  `idkhuvuc` bigint(20) UNSIGNED NOT NULL,
  `idthanhvien` bigint(20) UNSIGNED NOT NULL,
  `thoigian` date NOT NULL,
  `diemdanh` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Vắng - 1: Có mặt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichlamviec`
--

INSERT INTO `lichlamviec` (`id`, `idquan`, `idcalam`, `idkhuvuc`, `idthanhvien`, `thoigian`, `diemdanh`) VALUES
(76, 1, 1, 1, 1, '2021-07-01', 1),
(77, 1, 1, 1, 3, '2021-07-01', 1),
(78, 1, 1, 1, 4, '2021-07-01', 1),
(79, 1, 1, 1, 2, '2021-07-01', 1),
(80, 1, 1, 2, 1, '2021-08-01', 1),
(81, 1, 1, 2, 3, '2021-08-01', 1),
(82, 1, 1, 2, 4, '2021-08-01', 1),
(83, 1, 1, 2, 2, '2021-08-01', 1),
(84, 1, 1, 3, 1, '2021-08-01', 1),
(85, 1, 1, 3, 3, '2021-08-01', 1),
(86, 1, 1, 3, 4, '2021-08-01', 1),
(87, 1, 1, 3, 2, '2021-08-01', 1),
(96, 1, 1, 1, 1, '2021-08-01', 1),
(97, 1, 1, 1, 3, '2021-08-01', 1),
(98, 1, 1, 1, 4, '2021-08-01', 1),
(99, 1, 1, 1, 2, '2021-08-01', 1),
(100, 1, 1, 2, 1, '2021-08-09', 1),
(101, 1, 1, 2, 3, '2021-08-09', 1),
(102, 1, 1, 2, 4, '2021-08-09', 1),
(103, 1, 1, 2, 2, '2021-08-09', 1),
(104, 1, 1, 3, 1, '2021-08-09', 1),
(105, 1, 1, 3, 3, '2021-08-09', 1),
(106, 1, 1, 3, 4, '2021-08-09', 1),
(107, 1, 1, 3, 2, '2021-08-09', 1),
(108, 1, 1, 1, 1, '2021-08-09', 1),
(109, 1, 1, 1, 3, '2021-08-09', 1),
(110, 1, 1, 1, 4, '2021-08-09', 1),
(111, 1, 1, 1, 2, '2021-08-09', 1),
(112, 1, 1, 2, 1, '2021-05-02', 1),
(113, 1, 1, 2, 3, '2021-05-02', 1),
(114, 1, 1, 2, 4, '2021-05-02', 1),
(115, 1, 1, 2, 2, '2021-05-02', 1),
(116, 1, 1, 3, 1, '2021-05-02', 1),
(117, 1, 1, 3, 3, '2021-05-02', 1),
(118, 1, 1, 3, 4, '2021-05-02', 1),
(119, 1, 1, 3, 2, '2021-05-02', 1),
(120, 1, 1, 1, 1, '2021-05-02', 1),
(121, 1, 1, 1, 3, '2021-05-02', 1),
(122, 1, 1, 1, 4, '2021-05-02', 1),
(123, 1, 1, 1, 2, '2021-05-02', 1),
(124, 1, 1, 1, 1, '2021-08-29', 1),
(125, 1, 1, 1, 3, '2021-08-29', 1),
(126, 1, 1, 1, 4, '2021-08-29', 0),
(127, 1, 2, 1, 2, '2021-09-03', 0),
(128, 1, 3, 2, 3, '2021-09-03', 0),
(129, 1, 4, 5, 3, '2021-09-03', 0),
(130, 1, 4, 5, 4, '2021-09-03', 0),
(131, 1, 1, 1, 1, '2021-09-26', 1),
(132, 1, 1, 1, 3, '2021-09-26', 1),
(133, 1, 1, 1, 4, '2021-09-26', 1),
(134, 1, 1, 1, 2, '2021-09-26', 0),
(135, 1, 2, 2, 3, '2021-09-26', 0),
(147, 1, 2, 3, 4, '2021-09-26', 0),
(148, 1, 2, 3, 2, '2021-09-26', 0),
(151, 1, 1, 1, 3, '2021-10-17', 0),
(152, 1, 1, 1, 4, '2021-10-17', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luong`
--

CREATE TABLE `luong` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `idthanhvien` bigint(20) UNSIGNED NOT NULL,
  `mucluong` bigint(20) NOT NULL,
  `tu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `luong`
--

INSERT INTO `luong` (`id`, `idquan`, `idthanhvien`, `mucluong`, `tu`) VALUES
(1, 1, 1, 500001, '2021-05-01'),
(2, 1, 2, 400001, '2021-05-01'),
(3, 1, 3, 300001, '2021-05-01'),
(4, 1, 4, 200001, '2021-05-01'),
(5, 1, 1, 500000, '2021-07-09'),
(6, 1, 2, 400000, '2021-07-09'),
(7, 1, 3, 300000, '2021-07-09'),
(8, 1, 4, 200000, '2021-07-09'),
(15, 1, 3, 300000, '2021-08-09'),
(18, 1, 1, 500000, '2021-09-12'),
(19, 1, 4, 200000, '2021-10-26'),
(20, 1, 1, 500000, '2021-10-26'),
(21, 1, 2, 400000, '2021-10-26'),
(22, 1, 3, 300000, '2021-10-26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_25_164657_create_quan_table', 1),
(5, '2021_06_26_014953_create_ban_table', 1),
(6, '2021_06_26_022913_create_sessions_table', 1),
(7, '2021_06_26_022932_create_thanhvien_table', 1),
(8, '2021_06_27_152924_create_khuvuc_table', 1),
(9, '2021_06_27_153156_create_calam_table', 1),
(10, '2021_06_27_154703_create_lichlamviec_table', 1),
(11, '2021_06_27_155354_create_thucdon_table', 1),
(12, '2021_06_27_160512_create_hoadon_table', 1),
(13, '2021_06_27_161731_create_chitiet_table', 1),
(14, '2021_06_27_163444_create_nguyenlieu_table', 1),
(15, '2021_06_27_164020_create_kho_table', 1),
(16, '2021_06_28_124955_create_quyen_table', 1),
(17, '2021_06_28_131930_create_vaitro_table', 1),
(18, '2021_06_28_132116_create_vaitro_quyen_table', 1),
(19, '2021_07_01_162154_create_khachhang_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguyenlieu`
--

CREATE TABLE `nguyenlieu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `tennguyenlieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xuatxu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donvitinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Hiện - 1: Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguyenlieu`
--

INSERT INTO `nguyenlieu` (`id`, `idquan`, `tennguyenlieu`, `xuatxu`, `donvitinh`, `hidden`) VALUES
(1, 1, 'Đường hạt to', 'Đường Tinh luyên Hòa Phát, Sài Gòn, 0733123456', 'Kg', 0),
(2, 1, 'Đá xay', 'Cty Nước Đá', 'Thùng', 0),
(3, 1, 'Mía', 'CTy TNHH Mía đường', 'Cây', 0),
(4, 1, 'Bánh pía', 'Tân Huê Viên, Sóc Trăng, Việt Nam', 'Cây', 0),
(7, 1, 'Sữa đặc', 'Vinamilk Cần Thơ', 'Hộp 1L', 0),
(8, 1, 'Hạt Cafe', 'Buôn Mê Thuộc', 'Kg', 0),
(9, 1, 'Siro', 'Việt Nam', 'lít', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenquyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`id`, `tenquyen`) VALUES
(1, 'Xem bàn'),
(2, 'Thêm bàn'),
(3, 'Sửa bàn'),
(4, 'Xóa bàn'),
(5, 'Xem ca làm'),
(6, 'Thêm ca làm'),
(7, 'Sửa ca làm'),
(8, 'Xóa ca làm'),
(9, 'Xem hóa đơn'),
(10, 'Thêm hóa đơn'),
(11, 'Sửa hóa đơn'),
(12, 'Xóa hóa đơn'),
(13, 'Xem khách hàng'),
(14, 'Thêm khách hàng'),
(15, 'Sửa khách hàng'),
(16, 'Xóa khách hàng'),
(17, 'Xem kho'),
(18, 'Thêm kho'),
(19, 'Sửa kho'),
(20, 'Xóa kho'),
(21, 'Xem khu vực'),
(22, 'Thêm khu vực'),
(23, 'Sửa khu vực'),
(24, 'Xóa khu vực'),
(25, 'Xem lịch làm việc'),
(26, 'Thêm lịch làm việc'),
(27, 'Sửa lịch làm việc'),
(28, 'Xóa lịch làm việc'),
(29, 'Xem nguyên liệu'),
(30, 'Thêm nguyên liệu'),
(31, 'Sửa nguyên liệu'),
(32, 'Xóa nguyên liệu'),
(33, 'Xem thực đơn'),
(34, 'Thêm thực đơn'),
(35, 'Sửa thực đơn'),
(36, 'Xóa thực đơn'),
(37, 'Quản lý ngân sách'),
(38, 'Quản lý nhập hàng'),
(39, 'Quản lý bán hàng'),
(40, 'Quản lý lương nhân viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `acc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinhtv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namsinh` date NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` bigint(20) NOT NULL,
  `ngayvaolam` date NOT NULL,
  `luong` bigint(20) NOT NULL,
  `idvaitro` bigint(20) UNSIGNED NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '1' COMMENT '0: Hiện - 1: Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvien`
--

INSERT INTO `thanhvien` (`id`, `idquan`, `acc`, `pwd`, `hoten`, `hinhtv`, `namsinh`, `sex`, `diachi`, `sdt`, `ngayvaolam`, `luong`, `idvaitro`, `hidden`) VALUES
(1, 1, 'quan1_chuquan', 'af764227394c645a864f77e7b103ded2', 'CHUQUANquan1', 'storage/hinhanh/WPDQ1TrHuepRYdWPtX16zyAGRekdaLNGtXx6p3Dq.jpg', '1999-04-21', '0', 'B1-6 KDC An Thới P Bui huu nghia', 763232505, '2021-05-01', 500000, 1, 0),
(2, 1, 'quan1_quanly', 'af764227394c645a864f77e7b103ded2', 'QUANLYquan1', 'storage/hinhanh/tCc7BIksPdI5GzkZcIXShW4YmgEXpNItARt0xAD5.jpg', '1999-04-22', '1', 'B1-6 KDC An Thới P Bui huu nghia', 763232505, '2021-05-01', 400000, 2, 0),
(3, 1, 'quan1_phache', 'af764227394c645a864f77e7b103ded2', 'PHACHEquan1', 'storage/hinhanh/TKTYIkVuLOTIHmayZ1W3w6JK8XoWEbMMG4JNvmFC.jpg', '1999-04-21', '0', 'B1-6 KDC An Thới', 763232505, '2021-05-01', 300000, 8, 0),
(4, 1, 'quan1_phucvu', 'af764227394c645a864f77e7b103ded2', 'PHUCVUquan1', 'storage/hinhanh/cWhZTrNw4xGo5q5V0SRLGK2BXQwjf6PGsdYYkI9c.jpg', '1999-04-21', '0', 'B1-6 KDC An Thới', 763232505, '2021-05-01', 200000, 9, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thucdon`
--

CREATE TABLE `thucdon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `loaimon` bigint(20) NOT NULL COMMENT '1-món nước, 2-món ăn, 3-món phụ',
  `tenmon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dongia` bigint(20) UNSIGNED NOT NULL,
  `hinhmon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden` bigint(20) NOT NULL DEFAULT '0' COMMENT '0: Hiện - 1: Ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thucdon`
--

INSERT INTO `thucdon` (`id`, `idquan`, `loaimon`, `tenmon`, `dongia`, `hinhmon`, `mota`, `hidden`) VALUES
(15, 1, 1, 'Cafe đá', 15000, 'storage/hinhanh/xLd0stf4W5qfoUlmx3xWhzt2FllLe27pB74ZOJVg.jpg', 'Không', 0),
(16, 1, 1, 'Cafe sữa', 18000, 'storage/hinhanh/nPGMN6OZfXoHpL3fvIvA1OZqKbIu0j9tg70AsU5q.jpg', 'Không', 0),
(17, 1, 1, 'Espresso', 18000, 'storage/hinhanh/VwTQL3w5BNvl8TmxcJz4W4dmuCjVfRMEfW4COaI4.jpg', 'Không', 0),
(18, 1, 1, 'Capuchino', 25000, 'storage/hinhanh/jQWUWobnEUKSnLLVc7RI6sCgo4ToqWY85h4sUp8w.jpg', 'Không', 0),
(19, 1, 1, 'Sinh tố cà chua', 12000, 'storage/hinhanh/VmIXLjoXuz97bF0mfJ4RYIFvpibn9bmpYXTwoMhX.jpg', 'Không', 0),
(20, 1, 1, 'Sinh tố cà rốt', 12000, 'storage/hinhanh/zBRIFHWsqYV34lBB8Hs8dSRJhJlD2ry7yu8nTM67.jpg', 'Không', 0),
(21, 1, 1, 'Sinh tố mãng cầu', 12000, 'storage/hinhanh/nzN153vw9HnnLaeRzkCyy6bI9Sdpr1NSTab5uVL8.jpg', 'Không', 0),
(22, 1, 1, 'Sinh tố bơ', 12000, 'storage/hinhanh/g5AFHajYccMhaCJsT5s1EWynv5SqPdT6Wkd1UWCW.jpg', 'Không', 0),
(23, 1, 1, 'Nước suối', 8000, 'storage/hinhanh/8r3yJUFSdPcMEeKzgRitV8S8JPICzZUyEI9Vkxi3.jpg', 'Không', 0),
(24, 1, 1, 'Nước dừa', 25000, 'storage/hinhanh/qG81j9i3y6HEwygTpSI3BFx9flwxfmScA8L1kC8D.jpg', 'Không', 0),
(25, 1, 2, 'Bò tái chanh', 150000, 'storage/hinhanh/5KfVNjgg7W1GuHR5ERwSMEdtqPQ7v6IGNQOboHEV.jpg', 'Không', 0),
(26, 1, 2, 'Bò xào thập cẩm', 150000, 'storage/hinhanh/cVntLRTt8vPoZboc958Tdg4ryfldOkMMBJcOSkSC.jpg', 'Không', 0),
(27, 1, 2, 'Bò cuốn cải', 180000, 'storage/hinhanh/gdkJfMIoFi6PCYSsDn3OS7LOHjw32HSNHpGL6tIl.jpg', 'Không', 0),
(28, 1, 2, 'Bò tơ nướng lá lốt + banh tráng', 100000, 'storage/hinhanh/VbHsTWma59YaK3TOVPLdd6BuXJhvQpc44WAv6gQF.jpg', 'Không', 0),
(29, 1, 2, 'Bò tơ hấp lá tía tô', 120000, 'storage/hinhanh/jrCjfj9ggkM5pifB82OMnWkTDCYy5GoaUjm8R3BW.jpg', 'Không', 0),
(30, 1, 2, 'Dê tái chanh', 90000, 'storage/hinhanh/lTeuU7WZfZnwYlkMdhfdV0nWV0A3oeDzq9UhopaY.jpg', 'Không', 0),
(31, 1, 2, 'Bao tử dê hầm tiêu', 90000, 'storage/hinhanh/CQRdVlQJK9zmPiMSmraG8NNBrwgIBcN7j5IJpMEi.jpg', 'Không', 0),
(32, 1, 2, 'Dê bóp thấu', 110000, 'storage/hinhanh/mi6wVOCxIOwnhwORxLzkR4A7MwCgXKDFkyybgkdJ.jpg', 'Không', 0),
(33, 1, 2, 'Dê xào sả ớt', 110000, 'storage/hinhanh/qqkvBBQkJy7agEJglOtPbo2r1LoNPvqH83DHieu2.jpg', 'Không', 0),
(34, 1, 2, 'Lẩu dê', 180000, 'storage/hinhanh/mZxcbtzQqnEPEbQuS5DHfo0ZiK6UnFSBxNqipP60.jpg', 'Không', 0),
(35, 1, 2, 'Cầy quay', 150000, 'storage/hinhanh/DbzCj7BmQ0fztHimX28DNRxKuoNd5SBp1gFNsDJ4.jpg', 'Không', 0),
(36, 1, 2, 'Cầy hấp', 100000, 'storage/hinhanh/O1HdqbM8qSGSLTuqiB8vb0W357jDTCA5oD7vmDPP.jpg', 'Không', 0),
(37, 1, 2, 'Cầy xào lăn', 100000, 'storage/hinhanh/8wo3MC1LvnSeeHxZRN9Dw4kPVDSoPv9VBW8da667.jpg', 'Không', 0),
(38, 1, 2, 'Cầy xào rau má', 120000, 'storage/hinhanh/ySWkVMVPAStnV5EVZrg3T9W55uj4X9r5JNxTjxAg.jpg', 'Không', 0),
(39, 1, 2, 'Dồi cầy', 100000, 'storage/hinhanh/jVmEZs4fnIKET3DsxxCDmKKD5CRMEho8yzkwV8P6.jpg', 'Không', 0),
(40, 1, 3, 'Cá viên chiên', 15000, 'storage/hinhanh/6Ace7rNU2BC7LFpkrZExsEaKmv24jnGL9F6qZ2jW.jpg', 'Không', 0),
(41, 1, 3, 'Tàu hũ chiên', 15000, 'storage/hinhanh/y9V6MdkGwImn2hXFa1mIVw59M0gJ3xgVqr3gEvkN.jpg', 'Không', 0),
(42, 1, 3, 'Kem', 15000, 'storage/hinhanh/DatZeiCwqQDNQ3tztFfKB9m9wMzCaosWi2TmeEBU.jpg', 'Không', 0),
(43, 1, 3, 'Rau câu', 10000, 'storage/hinhanh/wPwEfJOZ1aPxW7HUeXabGbwgycg099rXfuMzbswR.jpg', 'Không', 0),
(44, 1, 3, 'Khoai tây chiên', 12000, 'storage/hinhanh/yyYs4ol0pdSdttu7YnzVqn5RicXPGF3YI10KtZC8.jpg', 'Không', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinhquan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diachiquan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdtquan` bigint(20) NOT NULL,
  `ngaythanhlap` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `hinhquan`, `diachiquan`, `website`, `sdtquan`, `ngaythanhlap`, `created_at`, `updated_at`) VALUES
(1, 'quan1', 'buihuuchau99@gmail.com', '2021-07-20 12:40:15', '$2y$10$h.vbPZuk.HBB.GBf3DN2XOq4iZX/JBFeGVx8.w17AOPw1JKhuCX.K', 'uOHdDZsfHJe2baPVLbWfcnRfPheL2er5rwJ8Wo8edegLLJ5hh19GA7tB429u', 'storage/hinhanh/IXRAdtukfhs9jij5OLUOppUfXhX7iTiIWPkSD4f9.jpg', 'Sóc Trăng', 'http://huuchaurestaurant.com', 123456789, '2021-07-20', '2021-07-20 09:52:14', '2021-09-05 13:52:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitro`
--

CREATE TABLE `vaitro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idquan` bigint(20) UNSIGNED NOT NULL,
  `tenvaitro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`id`, `idquan`, `tenvaitro`) VALUES
(1, 1, 'Chủ quán'),
(2, 1, 'Quản lý'),
(8, 1, 'Pha chế'),
(9, 1, 'Phục vụ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitro_quyen`
--

CREATE TABLE `vaitro_quyen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idvaitro` bigint(20) UNSIGNED NOT NULL,
  `idquyen` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vaitro_quyen`
--

INSERT INTO `vaitro_quyen` (`id`, `idvaitro`, `idquyen`) VALUES
(41, 8, 29),
(42, 2, 1),
(43, 2, 2),
(44, 2, 3),
(45, 2, 4),
(46, 2, 5),
(47, 2, 6),
(48, 2, 7),
(49, 2, 8),
(50, 2, 9),
(51, 2, 10),
(52, 2, 11),
(53, 2, 12),
(54, 2, 13),
(55, 2, 14),
(56, 2, 15),
(57, 2, 16),
(58, 2, 17),
(59, 2, 18),
(60, 2, 19),
(61, 2, 20),
(62, 2, 21),
(63, 2, 22),
(64, 2, 23),
(65, 2, 24),
(66, 2, 25),
(67, 2, 26),
(68, 2, 27),
(69, 2, 28),
(70, 2, 29),
(71, 2, 30),
(72, 2, 31),
(73, 2, 32),
(74, 2, 33),
(75, 2, 34),
(76, 2, 35),
(77, 2, 36),
(78, 9, 9),
(79, 9, 10),
(80, 9, 11),
(81, 9, 12),
(82, 9, 13),
(83, 9, 14),
(84, 9, 15),
(85, 9, 16),
(86, 1, 1),
(87, 1, 2),
(88, 1, 3),
(89, 1, 4),
(90, 1, 5),
(91, 1, 6),
(92, 1, 7),
(93, 1, 8),
(94, 1, 9),
(95, 1, 10),
(96, 1, 11),
(97, 1, 12),
(98, 1, 13),
(99, 1, 14),
(100, 1, 15),
(101, 1, 16),
(102, 1, 17),
(103, 1, 18),
(104, 1, 19),
(105, 1, 20),
(106, 1, 21),
(107, 1, 22),
(108, 1, 23),
(109, 1, 24),
(110, 1, 25),
(111, 1, 26),
(112, 1, 27),
(113, 1, 28),
(114, 1, 29),
(115, 1, 30),
(116, 1, 31),
(117, 1, 32),
(118, 1, 33),
(119, 1, 34),
(120, 1, 35),
(121, 1, 36),
(122, 1, 37),
(123, 1, 38),
(124, 1, 39),
(125, 1, 40);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banfkquan` (`idquan`),
  ADD KEY `banfkkhuvuc` (`idkhuvuc`);

--
-- Chỉ mục cho bảng `calam`
--
ALTER TABLE `calam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calamfkquan` (`idquan`);

--
-- Chỉ mục cho bảng `chitiet`
--
ALTER TABLE `chitiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chitietfkhoadon` (`idhoadon`),
  ADD KEY `chitietfkmon` (`idthucdon`);

--
-- Chỉ mục cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `giamgiafkquan` (`idquan`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoadonfkquan` (`idquan`),
  ADD KEY `hoadonfkkhuvuc` (`idkhuvuc`),
  ADD KEY `hoadonfkban` (`idban`),
  ADD KEY `hoadonfkthanhvien` (`idthanhvien`),
  ADD KEY `hoadonfkkhachhang` (`idkhachhang`);

--
-- Chỉ mục cho bảng `hoadonluu`
--
ALTER TABLE `hoadonluu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khachhangfkquan` (`idquan`);

--
-- Chỉ mục cho bảng `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khofkquan` (`idquan`),
  ADD KEY `khofknguyenlieu` (`idnguyenlieu`);

--
-- Chỉ mục cho bảng `khuvuc`
--
ALTER TABLE `khuvuc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khuvucfkquan` (`idquan`);

--
-- Chỉ mục cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lichlamviecfkquan` (`idquan`),
  ADD KEY `lichlamviecfkcalam` (`idcalam`),
  ADD KEY `lichlamviecfkkhuvuc` (`idkhuvuc`),
  ADD KEY `lichlamviecfkthanhvien` (`idthanhvien`);

--
-- Chỉ mục cho bảng `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `luongfkthanhvien` (`idthanhvien`),
  ADD KEY `luongfkquan` (`idquan`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguyenlieufkquan` (`idquan`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thanhvienfkquan` (`idquan`),
  ADD KEY `thanhvienfkvaitro` (`idvaitro`);

--
-- Chỉ mục cho bảng `thucdon`
--
ALTER TABLE `thucdon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thucdonfkquan` (`idquan`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `va` (`idquan`);

--
-- Chỉ mục cho bảng `vaitro_quyen`
--
ALTER TABLE `vaitro_quyen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkvaitro` (`idvaitro`),
  ADD KEY `fkquyen` (`idquyen`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ban`
--
ALTER TABLE `ban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `calam`
--
ALTER TABLE `calam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `chitiet`
--
ALTER TABLE `chitiet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hoadonluu`
--
ALTER TABLE `hoadonluu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `kho`
--
ALTER TABLE `kho`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `khuvuc`
--
ALTER TABLE `khuvuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT cho bảng `luong`
--
ALTER TABLE `luong`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `quyen`
--
ALTER TABLE `quyen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thucdon`
--
ALTER TABLE `thucdon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `vaitro_quyen`
--
ALTER TABLE `vaitro_quyen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ban`
--
ALTER TABLE `ban`
  ADD CONSTRAINT `banfkkhuvuc` FOREIGN KEY (`idkhuvuc`) REFERENCES `khuvuc` (`id`),
  ADD CONSTRAINT `banfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `calam`
--
ALTER TABLE `calam`
  ADD CONSTRAINT `calamfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `chitiet`
--
ALTER TABLE `chitiet`
  ADD CONSTRAINT `chitietfkhoadon` FOREIGN KEY (`idhoadon`) REFERENCES `hoadon` (`id`),
  ADD CONSTRAINT `chitietfkthucdon` FOREIGN KEY (`idthucdon`) REFERENCES `thucdon` (`id`);

--
-- Các ràng buộc cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD CONSTRAINT `giamgiafkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadonfkban` FOREIGN KEY (`idban`) REFERENCES `ban` (`id`),
  ADD CONSTRAINT `hoadonfkkhachhang` FOREIGN KEY (`idkhachhang`) REFERENCES `khachhang` (`id`),
  ADD CONSTRAINT `hoadonfkkhuvuc` FOREIGN KEY (`idkhuvuc`) REFERENCES `khuvuc` (`id`),
  ADD CONSTRAINT `hoadonfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hoadonfkthanhvien` FOREIGN KEY (`idthanhvien`) REFERENCES `thanhvien` (`id`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhangfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `kho`
--
ALTER TABLE `kho`
  ADD CONSTRAINT `khofknguyenlieu` FOREIGN KEY (`idnguyenlieu`) REFERENCES `nguyenlieu` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `khofkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `khuvuc`
--
ALTER TABLE `khuvuc`
  ADD CONSTRAINT `khuvucfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD CONSTRAINT `lichlamviecfkcalam` FOREIGN KEY (`idcalam`) REFERENCES `calam` (`id`),
  ADD CONSTRAINT `lichlamviecfkkhuvuc` FOREIGN KEY (`idkhuvuc`) REFERENCES `khuvuc` (`id`),
  ADD CONSTRAINT `lichlamviecfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lichlamviecfkthanhvien` FOREIGN KEY (`idthanhvien`) REFERENCES `thanhvien` (`id`);

--
-- Các ràng buộc cho bảng `luong`
--
ALTER TABLE `luong`
  ADD CONSTRAINT `luongfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `luongfkthanhvien` FOREIGN KEY (`idthanhvien`) REFERENCES `thanhvien` (`id`);

--
-- Các ràng buộc cho bảng `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  ADD CONSTRAINT `nguyenlieufkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD CONSTRAINT `thanhvienfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `thanhvienfkvaitro` FOREIGN KEY (`idvaitro`) REFERENCES `vaitro` (`id`);

--
-- Các ràng buộc cho bảng `thucdon`
--
ALTER TABLE `thucdon`
  ADD CONSTRAINT `thucdonfkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  ADD CONSTRAINT `vaitrofkquan` FOREIGN KEY (`idquan`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `vaitro_quyen`
--
ALTER TABLE `vaitro_quyen`
  ADD CONSTRAINT `fkquyen` FOREIGN KEY (`idquyen`) REFERENCES `quyen` (`id`),
  ADD CONSTRAINT `fkvaitro` FOREIGN KEY (`idvaitro`) REFERENCES `vaitro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
