-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2015 at 03:29 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pce`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `empID` int(11) NOT NULL COMMENT 'รหัสพนักงาน',
  `firstName` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'ชื่อจริง',
  `lastName` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'นามสกุล',
  `username` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'ชื่อผู้ใช้(เข้าสู่ระบบ)',
  `password` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'รหัสผ่าน(เข้าสู่ระบบ)',
  `type` enum('A','P','S') COLLATE utf8_bin NOT NULL COMMENT 'ประเภทพนักงาน(A=ผู้บริหาร,P=ฝ่ายผลิต,S=ฝ่ายขาย)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `memberID` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `firstName` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'ชื่อจริง',
  `lastName` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'นามสกุล',
  `tel` varchar(15) COLLATE utf8_bin NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `username` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'ชื่อผู้ใช้(เข้าสู่ระบบ)',
  `password` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'รหัสผ่าน(เข้าสู่ระบบ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `orderID` int(11) NOT NULL COMMENT 'รหัสออเดอร์',
  `memberID` int(11) NOT NULL COMMENT 'รหัสสมาชิก',
  `productID` int(11) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `price` int(11) DEFAULT NULL COMMENT 'ราคา(จากการตกลง)',
  `note` text COLLATE utf8_bin NOT NULL COMMENT 'หมายเหตุ',
  `status` enum('0','1','2','3','4','5','6','7') COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT 'สถานะ(0=รอการตอบกลับจากผู้บริหาร,1=ผู้บริหารปฏิเสธราคา,2=ลูกค้ายอมรับราคา,3=ผู้บริหารยืนยัน,4=กำลังผลิต,5=ผลิตเสร็จสิ้น,6=รอส่งมอบ,7=จบการขาย)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(11) NOT NULL COMMENT 'รหัสสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน';
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสลูกค้า';
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสออเดอร์';
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
