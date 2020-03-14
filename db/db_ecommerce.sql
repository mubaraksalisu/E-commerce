-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2019 at 07:39 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumber`
--

CREATE TABLE `tblautonumber` (
  `ID` int(11) NOT NULL,
  `AUTOSTART` varchar(11) NOT NULL,
  `AUTOINC` int(11) NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOKEY` varchar(12) NOT NULL,
  `AUTONUM` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblautonumber`
--

INSERT INTO `tblautonumber` (`ID`, `AUTOSTART`, `AUTOINC`, `AUTOEND`, `AUTOKEY`, `AUTONUM`) VALUES
(1, '2017', 1, 43, 'PROID', 10),
(2, '0', 1, 122, 'ordernumber', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `CARTID` int(11) NOT NULL,
  `PROID` int(11) NOT NULL,
  `COSID` int(11) NOT NULL,
  `DATEADDED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`CARTID`, `PROID`, `COSID`, `DATEADDED`) VALUES
(1, 201737, 10, '2019-12-01 23:00:00'),
(2, 201738, 10, '2019-12-01 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CATEGID` int(11) NOT NULL,
  `CATEGORIES` varchar(255) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CATEGID`, `CATEGORIES`, `USERID`) VALUES
(5, 'SHOES', 0),
(12, 'BAGS', 0),
(14, 'HOUSEHOLDS', 0),
(16, 'KIDS', 0),
(17, 'WOMENS', 0),
(19, 'baby wears', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `CUSTOMERID` int(11) NOT NULL,
  `FNAME` varchar(30) NOT NULL,
  `LNAME` varchar(30) NOT NULL,
  `CITYADD` text NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `PHONE` varchar(20) NOT NULL,
  `CUSUNAME` varchar(20) NOT NULL,
  `CUSPASS` varchar(90) NOT NULL,
  `CUSPHOTO` varchar(255) NOT NULL,
  `TERMS` tinyint(4) NOT NULL,
  `DATEJOIN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`CUSTOMERID`, `FNAME`, `LNAME`, `CITYADD`, `GENDER`, `PHONE`, `CUSUNAME`, `CUSPASS`, `CUSPHOTO`, `TERMS`, `DATEJOIN`) VALUES
(10, 'Mubarak', 'salisu', 'kano', 'Male', '2348069245966', 'mubarak', '4edfb6fbed29a0df3673213f5a7f503ccd88a321', 'customer_image/1514714650476 (2).jpg', 1, '2019-10-11'),
(11, 'maryam', 'salisu', 'kofar ruwa, dala, kano', 'Female', '08069245966', 'maryam', '9d609932935f5003d8f388d8c6072d6db9ba64a0', '', 1, '2019-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `ORDERID` int(11) NOT NULL,
  `PROID` int(11) NOT NULL,
  `ORDEREDQTY` int(11) NOT NULL,
  `ORDEREDPRICE` double NOT NULL,
  `ORDEREDNUM` int(11) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`ORDERID`, `PROID`, `ORDEREDQTY`, `ORDEREDPRICE`, `ORDEREDNUM`, `USERID`) VALUES
(1, 201738, 1, 199, 114, 0),
(2, 201737, 1, 119, 115, 0),
(3, 201738, 1, 199, 116, 0),
(4, 201738, 1, 199, 117, 0),
(5, 201750, 1, 2200, 117, 0),
(6, 201754, 1, 2300, 117, 0),
(7, 201738, 3, 597, 118, 0),
(8, 201750, 2, 4400, 118, 0),
(9, 201754, 1, 2300, 118, 0),
(10, 201750, 1, 2200, 119, 0),
(11, 201737, 1, 119, 119, 0),
(12, 201750, 1, 2200, 120, 0),
(13, 201737, 1, 119, 120, 0),
(14, 201754, 1, 2300, 121, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `PROID` int(11) NOT NULL,
  `PRODESC` varchar(255) DEFAULT NULL,
  `PROQTY` int(11) DEFAULT NULL,
  `ORIGINALPRICE` double NOT NULL,
  `PROPRICE` double DEFAULT NULL,
  `CATEGID` int(11) DEFAULT NULL,
  `IMAGES` varchar(255) DEFAULT NULL,
  `PROSTATS` varchar(30) DEFAULT NULL,
  `OWNERNAME` varchar(90) NOT NULL,
  `OWNERPHONE` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`PROID`, `PRODESC`, `PROQTY`, `ORIGINALPRICE`, `PROPRICE`, `CATEGID`, `IMAGES`, `PROSTATS`, `OWNERNAME`, `OWNERPHONE`) VALUES
(201737, 'KILY Korean Casual Sleeveless Dress Printed Dress 5a0019                                                                                        ', 100, 100, 119, 12, 'uploaded_photos/korean.jpeg', 'Available', 'janobe', ''),
(201738, 'terno top and pants korean fashion boho terno summer terno for women                                                                    ', 109, 150, 199, 12, 'uploaded_photos/terno.jpg', 'Available', 'janobe', ''),
(201739, '4Color Menâ€²S Denim Pants STRETCHABLE Skinny Black/Blue                      ', 20, 250, 289, 18, 'uploaded_photos/jeans.jpg', 'Available', 'janobe', ''),
(201741, 'ICM #T146 BESTSELLER TOPS TSHIRT FOR MEN                      ', 200, 50, 89, 18, 'uploaded_photos/shirt2.jpg', 'Available', 'janobe', ''),
(201743, 'kjduhdsbsc shgbjksb chsbujkdjilkds jsdnlkdfnjldnf djnd ndkndlnd idnkdnkd jdn kdndkndkndkndhbyhsjpeoue indhvsvja sihandaw ', 49, 2000, 1800, 11, 'uploaded_photos/2018-Luxury-Male-Leather-Purse-Men-s-Clutch-Wallets-Handy-Bags-Business-Carteras-Mujer-Wallets-Men.jpg', 'Available', 'Mubarak', '08069245966'),
(201747, 'ladies gown made from wax', 130, 4000, 3800, 17, 'uploaded_photos/IMG-20191121-WA0014.jpg', 'Available', 'hafsat', '08069245966'),
(201748, 'ladies skirt', 120, 3600, 2800, 17, 'uploaded_photos/IMG-20191121-WA0016.jpg', 'Available', 'hafsat', '08069245966'),
(201749, 'Baby cap and shoes', 130, 1200, 1000, 19, 'uploaded_photos/IMG-20191121-WA0002.jpg', 'Available', 'hafsat', '08069245966'),
(201750, 'White bag with a silver circle buckle', 107, 2400, 2200, 12, 'uploaded_photos/IMG-20191121-WA0013.jpg', 'Available', 'hafsat', '08069245966'),
(201751, 'ladies wax', 123, 3200, 3000, 17, 'uploaded_photos/IMG-20191121-WA0026.jpg', 'Available', 'hafsat', '08069245966'),
(201752, 'girl baby wool gown', 230, 1300, 1100, 19, 'uploaded_photos/IMG-20191121-WA0008.jpg', 'Available', 'hafsat', '08069245966'),
(201753, 'kid white sweater ', 67, 800, 700, 16, 'uploaded_photos/IMG-20191121-WA0021.jpg', 'Available', 'hafsat', '08069245966'),
(201754, 'fancy ladies bag', 117, 2400, 2300, 12, 'uploaded_photos/IMG-20191121-WA0012.jpg', 'Available', 'hafsat', '08069245966'),
(201755, 'ladies top made from wax', 230, 2200, 2000, 17, 'uploaded_photos/IMG-20191121-WA0015.jpg', 'Available', 'hafsat', '08069245966'),
(201756, 'portable ladies pus with different color', 130, 2500, 2300, 12, 'uploaded_photos/IMG-20191121-WA0010.jpg', 'Available', 'hafsat', '08069245966'),
(201757, 'turtle neck sweater for ladies', 210, 1200, 1000, 17, 'uploaded_photos/IMG-20191121-WA0009.jpg', 'Available', 'hafsat', '08069245966'),
(201758, 'cute maroon ladies pus', 119, 1100, 950, 12, 'uploaded_photos/IMG-20191121-WA0011.jpg', 'Available', 'hafsat', '08069245966');

-- --------------------------------------------------------

--
-- Table structure for table `tblpromopro`
--

CREATE TABLE `tblpromopro` (
  `PROMOID` int(11) NOT NULL,
  `PROID` int(11) NOT NULL,
  `PRODISCOUNT` double NOT NULL,
  `PRODISPRICE` double NOT NULL,
  `PROBANNER` tinyint(4) NOT NULL,
  `PRONEW` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpromopro`
--

INSERT INTO `tblpromopro` (`PROMOID`, `PROID`, `PRODISCOUNT`, `PRODISPRICE`, `PROBANNER`, `PRONEW`) VALUES
(1, 201737, 20, 95.2, 1, 0),
(2, 201738, 0, 199, 0, 0),
(3, 201739, 0, 289, 0, 0),
(5, 201741, 0, 89, 0, 0),
(7, 201743, 0, 1800, 0, 0),
(11, 201747, 0, 3800, 0, 0),
(12, 201748, 0, 2800, 0, 0),
(13, 201749, 0, 1000, 0, 0),
(14, 201750, 0, 2200, 0, 0),
(15, 201751, 0, 3000, 0, 0),
(16, 201752, 0, 1100, 0, 0),
(17, 201753, 0, 700, 0, 0),
(18, 201754, 0, 2300, 0, 0),
(19, 201755, 0, 2000, 0, 0),
(20, 201756, 0, 2300, 0, 0),
(21, 201757, 0, 1000, 0, 0),
(22, 201758, 0, 950, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsetting`
--

CREATE TABLE `tblsetting` (
  `SETTINGID` int(11) NOT NULL,
  `PLACE` text NOT NULL,
  `DELPRICE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsetting`
--

INSERT INTO `tblsetting` (`SETTINGID`, `PLACE`, `DELPRICE`) VALUES
(1, 'Kano', 500),
(2, 'Kaduna City', 700),
(3, 'Jos', 600),
(4, 'Gombe', 400),
(5, 'Kastina', 300),
(6, 'zamfara', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tblsummary`
--

CREATE TABLE `tblsummary` (
  `SUMMARYID` int(11) NOT NULL,
  `ORDEREDDATE` datetime NOT NULL,
  `CUSTOMERID` int(11) NOT NULL,
  `ORDEREDNUM` int(11) NOT NULL,
  `DELFEE` double NOT NULL,
  `PAYMENT` double NOT NULL,
  `PAYMENTMETHOD` varchar(30) NOT NULL,
  `ORDEREDSTATS` varchar(30) NOT NULL,
  `ORDEREDREMARKS` varchar(125) NOT NULL,
  `CLAIMEDADTE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsummary`
--

INSERT INTO `tblsummary` (`SUMMARYID`, `ORDEREDDATE`, `CUSTOMERID`, `ORDEREDNUM`, `DELFEE`, `PAYMENT`, `PAYMENTMETHOD`, `ORDEREDSTATS`, `ORDEREDREMARKS`, `CLAIMEDADTE`) VALUES
(1, '2019-12-18 07:48:26', 10, 114, 600, 799, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(2, '2019-12-19 02:06:19', 10, 115, 600, 719, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(3, '2019-12-20 07:36:45', 10, 116, 600, 799, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(4, '2019-12-20 08:36:56', 10, 117, 600, 5299, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(7, '2019-12-20 10:03:15', 10, 118, 700, 7997, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(10, '2019-12-22 07:18:26', 10, 119, 600, 2919, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(12, '2019-12-22 07:19:51', 10, 120, 400, 2319, 'PayPal', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00'),
(14, '2019-12-22 04:22:38', 11, 121, 500, 2800, 'Cash on Delivery', 'Paid', 'Your order is on the way.', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `USERID` int(11) NOT NULL,
  `U_NAME` varchar(122) NOT NULL,
  `U_USERNAME` varchar(122) NOT NULL,
  `U_PASS` varchar(122) NOT NULL,
  `U_ROLE` varchar(30) NOT NULL,
  `USERIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`USERID`, `U_NAME`, `U_USERNAME`, `U_PASS`, `U_ROLE`, `USERIMAGE`) VALUES
(127, 'hafsat', 'hafsat', '9a39907d144639e076701c1742dfddb092348fb6', 'Administrator', 'photos/baby.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblwishlist`
--

CREATE TABLE `tblwishlist` (
  `WISHID` int(11) NOT NULL,
  `CUSID` int(11) NOT NULL,
  `PROID` int(11) NOT NULL,
  `WISHDATE` date NOT NULL,
  `WISHSTATS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblwishlist`
--

INSERT INTO `tblwishlist` (`WISHID`, `CUSID`, `PROID`, `WISHDATE`, `WISHSTATS`) VALUES
(2, 9, 201742, '2019-08-21', '0'),
(3, 0, 0, '2019-10-12', '0'),
(4, 10, 201739, '2019-10-12', '0'),
(5, 10, 201744, '2019-11-15', '0'),
(6, 10, 201738, '2019-11-24', '0'),
(7, 0, 0, '2019-12-06', '0'),
(8, 0, 0, '2019-12-22', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblautonumber`
--
ALTER TABLE `tblautonumber`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`CARTID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CATEGID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`CUSTOMERID`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`ORDERID`),
  ADD KEY `USERID` (`USERID`),
  ADD KEY `PROID` (`PROID`),
  ADD KEY `ORDEREDNUM` (`ORDEREDNUM`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`PROID`),
  ADD KEY `CATEGID` (`CATEGID`);

--
-- Indexes for table `tblpromopro`
--
ALTER TABLE `tblpromopro`
  ADD PRIMARY KEY (`PROMOID`),
  ADD UNIQUE KEY `PROID` (`PROID`);

--
-- Indexes for table `tblsetting`
--
ALTER TABLE `tblsetting`
  ADD PRIMARY KEY (`SETTINGID`);

--
-- Indexes for table `tblsummary`
--
ALTER TABLE `tblsummary`
  ADD PRIMARY KEY (`SUMMARYID`),
  ADD UNIQUE KEY `ORDEREDNUM` (`ORDEREDNUM`),
  ADD KEY `CUSTOMERID` (`CUSTOMERID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`USERID`);

--
-- Indexes for table `tblwishlist`
--
ALTER TABLE `tblwishlist`
  ADD PRIMARY KEY (`WISHID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblautonumber`
--
ALTER TABLE `tblautonumber`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `CARTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CATEGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `CUSTOMERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `ORDERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblpromopro`
--
ALTER TABLE `tblpromopro`
  MODIFY `PROMOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblsetting`
--
ALTER TABLE `tblsetting`
  MODIFY `SETTINGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsummary`
--
ALTER TABLE `tblsummary`
  MODIFY `SUMMARYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tblwishlist`
--
ALTER TABLE `tblwishlist`
  MODIFY `WISHID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
