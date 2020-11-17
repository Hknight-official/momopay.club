-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 17, 2020 lúc 02:28 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `momopay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trans_log`
--

CREATE TABLE `trans_log` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `amount` bigint(20) NOT NULL DEFAULT 0,
  `sdtnhan` text DEFAULT NULL,
  `sdtgui` text DEFAULT NULL,
  `name_nhan` text CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `trans_id` text NOT NULL,
  `ghichu` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `trans_log`
--

INSERT INTO `trans_log` (`id`, `username`, `amount`, `sdtnhan`, `sdtgui`, `name_nhan`, `status`, `trans_id`, `ghichu`, `date`) VALUES
(9, 'hackerkillT', 0, '0976469520', NULL, 'NGUYEN THI THAO', 1, '5n209e', 'e7bf633d4d9ad8f07465f2fb592c35ec', '2020-11-17 13:23:13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `trans_log`
--
ALTER TABLE `trans_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `trans_log`
--
ALTER TABLE `trans_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
