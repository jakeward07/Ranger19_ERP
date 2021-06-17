-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2021 at 02:05 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `arbl`
--

CREATE TABLE `arbl` (
  `bl_id` int(11) NOT NULL,
  `bl_cust` int(9) DEFAULT NULL,
  `bl_inv` int(9) DEFAULT NULL,
  `bl_site` int(5) DEFAULT NULL,
  `bl_amt` decimal(65,4) DEFAULT NULL,
  `bl_period` varchar(15) DEFAULT NULL,
  `bl_status` varchar(15) DEFAULT 'Owing',
  `bl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bl_stampuser` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ardc`
--

CREATE TABLE `ardc` (
  `dc_id` int(11) NOT NULL,
  `dc_docnum` int(9) DEFAULT NULL,
  `dc_apply` int(9) DEFAULT NULL,
  `dc_type` varchar(5) DEFAULT NULL,
  `dc_docdate` varchar(20) DEFAULT NULL,
  `dc_ponum` varchar(50) DEFAULT NULL,
  `dc_value` decimal(65,4) DEFAULT NULL,
  `dc_bal` decimal(65,4) DEFAULT NULL,
  `dc_stampuser` varchar(30) DEFAULT NULL,
  `dc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `arsc`
--

CREATE TABLE `arsc` (
  `sc_id` int(11) NOT NULL,
  `sc_allowcuidoverride` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arsc`
--

INSERT INTO `arsc` (`sc_id`, `sc_allowcuidoverride`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bdmf`
--

CREATE TABLE `bdmf` (
  `bd_id` int(11) NOT NULL,
  `bd_name` varchar(100) DEFAULT NULL,
  `bd_abn` varchar(20) DEFAULT NULL,
  `bd_acn` varchar(20) DEFAULT NULL,
  `bd_logo` varchar(1000) DEFAULT NULL,
  `bd_stampuser` varchar(30) DEFAULT NULL,
  `bd_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bdmf`
--

INSERT INTO `bdmf` (`bd_id`, `bd_name`, `bd_abn`, `bd_acn`, `bd_logo`, `bd_stampuser`, `bd_timestamp`) VALUES
(1, 'SnakeBite Software Solutions', '12312424233', '545345345', '/erp/uploads/logo/snakebite_logo.png', 'admjward', '2020-05-18 01:34:22'),
(2, 'Ranger 5', '12434534', '452342', '/erp/uploads/logo/ranger_logo.png', 'admjward', '2020-07-09 01:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `bg_id` int(11) NOT NULL,
  `bg_title` varchar(50) DEFAULT NULL,
  `bg_content` varchar(1000) DEFAULT NULL,
  `bg_user` varchar(30) DEFAULT NULL,
  `bg_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `borp`
--

CREATE TABLE `borp` (
  `bo_id` int(11) NOT NULL,
  `bo_order` int(9) DEFAULT NULL,
  `bo_sku` varchar(50) DEFAULT NULL,
  `bo_qty` decimal(9,4) DEFAULT NULL,
  `bo_bor` decimal(9,4) DEFAULT NULL,
  `bo_state` int(1) DEFAULT '0',
  `bo_user` varchar(30) DEFAULT NULL,
  `bo_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cbra`
--

CREATE TABLE `cbra` (
  `cb_id` int(11) NOT NULL,
  `cb_user` varchar(30) DEFAULT NULL,
  `cb_site` int(5) DEFAULT NULL,
  `cb_stampuser` varchar(30) DEFAULT NULL,
  `cb_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crhd`
--

CREATE TABLE `crhd` (
  `cr_id` int(11) NOT NULL,
  `cr_credit` int(6) DEFAULT NULL,
  `cr_cust` int(9) DEFAULT NULL,
  `cr_inv` int(6) DEFAULT NULL,
  `cr_site` int(5) DEFAULT NULL,
  `cr_status` varchar(10) DEFAULT 'New',
  `cr_stampuser` varchar(15) DEFAULT NULL,
  `cr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crln`
--

CREATE TABLE `crln` (
  `cl_id` int(11) NOT NULL,
  `cl_credit` int(6) DEFAULT NULL,
  `cl_site` int(5) DEFAULT NULL,
  `cl_sku` varchar(30) DEFAULT NULL,
  `cl_desc` varchar(50) DEFAULT NULL,
  `cl_qty` decimal(65,4) DEFAULT NULL,
  `cl_price` decimal(65,4) DEFAULT NULL,
  `cl_stkret` int(1) DEFAULT NULL,
  `cl_lnamt` decimal(65,4) DEFAULT NULL,
  `cl_stampuser` varchar(30) DEFAULT NULL,
  `cl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cthd`
--

CREATE TABLE `cthd` (
  `ct_id` int(11) NOT NULL,
  `ct_contract` varchar(15) DEFAULT NULL,
  `ct_cust` int(9) DEFAULT NULL,
  `ct_startdate` varchar(20) DEFAULT NULL,
  `ct_expdate` varchar(20) DEFAULT NULL,
  `ct_contuser` varchar(50) DEFAULT NULL,
  `ct_stampuser` varchar(30) DEFAULT NULL,
  `ct_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ct_maintuser` varchar(30) DEFAULT NULL,
  `ct_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ctln`
--

CREATE TABLE `ctln` (
  `cl_id` int(11) NOT NULL,
  `cl_code` varchar(30) DEFAULT NULL,
  `cl_sku` varchar(50) DEFAULT NULL,
  `cl_pval` decimal(65,4) DEFAULT NULL,
  `cl_bval` decimal(65,4) DEFAULT NULL,
  `cl_type` varchar(15) DEFAULT NULL,
  `cl_stampuser` varchar(30) DEFAULT NULL,
  `cl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `culd`
--

CREATE TABLE `culd` (
  `ld_id` int(11) NOT NULL,
  `ld_name` varchar(30) DEFAULT NULL,
  `ld_desc` varchar(100) DEFAULT NULL,
  `ld_stampuser` varchar(30) DEFAULT NULL,
  `ld_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ld_maintuser` varchar(30) DEFAULT NULL,
  `ld_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `culd`
--

INSERT INTO `culd` (`ld_id`, `ld_name`, `ld_desc`, `ld_stampuser`, `ld_timestamp`, `ld_maintuser`, `ld_mainttime`) VALUES
(1, 'Cash', 'Instant Payment via Cash/Card', 'admjward', '2020-03-22 12:21:53', NULL, '2020-03-22 12:21:53'),
(2, 'Trade', 'Given terms to pay outstanding invoices', 'admjward', '2020-03-22 12:21:53', NULL, '2020-03-22 12:21:53'),
(3, 'TradeX', 'Given terms to pay outstanding invoices but never expires', 'admjward', '2020-03-22 12:21:53', NULL, '2020-03-22 12:21:53'),
(4, 'LEGAL', 'Legal Status - Account must not be used', 'admjward', '2020-03-22 12:21:53', NULL, '2020-03-22 12:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `cumf`
--

CREATE TABLE `cumf` (
  `cu_dbid` int(11) NOT NULL,
  `cu_id` int(11) NOT NULL,
  `cu_billto` int(9) DEFAULT NULL,
  `cu_name` varchar(100) DEFAULT NULL,
  `cu_alias` varchar(15) DEFAULT NULL,
  `cu_jb` int(1) DEFAULT '0',
  `cu_po` int(1) DEFAULT '0',
  `cu_addr1` varchar(100) DEFAULT NULL,
  `cu_sub1` varchar(50) DEFAULT NULL,
  `cu_pc1` int(4) DEFAULT NULL,
  `cu_state1` varchar(3) DEFAULT NULL,
  `cu_addr2` varchar(100) DEFAULT NULL,
  `cu_sub2` varchar(50) DEFAULT NULL,
  `cu_pc2` int(4) DEFAULT NULL,
  `cu_state2` varchar(3) DEFAULT NULL,
  `cu_phone1` varchar(15) DEFAULT NULL,
  `cu_phone2` varchar(15) DEFAULT NULL,
  `cu_bpay` int(50) DEFAULT NULL,
  `cu_type` int(9) DEFAULT NULL,
  `cu_terms` int(4) DEFAULT NULL,
  `cu_ledger` int(9) DEFAULT NULL,
  `cu_fallback` decimal(65,4) DEFAULT '0.0000',
  `cu_fbtype` varchar(50) DEFAULT NULL,
  `cu_acn` varchar(15) DEFAULT NULL,
  `cu_abn` varchar(15) DEFAULT NULL,
  `cu_site` int(9) DEFAULT NULL,
  `cu_hldsts` int(9) DEFAULT NULL,
  `cu_limit` decimal(9,2) DEFAULT NULL,
  `cu_sptp` int(3) DEFAULT NULL,
  `cu_slsrep` varchar(10) DEFAULT NULL,
  `cu_stampuser` varchar(30) DEFAULT NULL,
  `cu_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cu_maintuser` varchar(30) DEFAULT NULL,
  `cu_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cu_status` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cupr`
--

CREATE TABLE `cupr` (
  `pr_id` int(11) NOT NULL,
  `pr_name` varchar(30) DEFAULT NULL,
  `pr_stampuser` varchar(30) DEFAULT NULL,
  `pr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pr_maintuser` varchar(30) DEFAULT NULL,
  `pr_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cupr`
--

INSERT INTO `cupr` (`pr_id`, `pr_name`, `pr_stampuser`, `pr_timestamp`, `pr_maintuser`, `pr_mainttime`) VALUES
(1, 'Trade Price', NULL, '2020-03-22 01:57:45', NULL, '2021-06-17 11:55:06'),
(2, 'Retail Price', NULL, '2020-03-22 01:57:59', NULL, '2021-06-17 11:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `cutp`
--

CREATE TABLE `cutp` (
  `tp_id` int(11) NOT NULL,
  `tp_name` varchar(30) DEFAULT NULL,
  `tp_desc` varchar(100) DEFAULT NULL,
  `tp_stampuser` varchar(30) DEFAULT NULL,
  `tp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cutp`
--

INSERT INTO `cutp` (`tp_id`, `tp_name`, `tp_desc`, `tp_stampuser`, `tp_timestamp`) VALUES
(1, 'Trade', 'Trade Based Customer', 'admjward', '2020-03-21 09:49:03'),
(2, 'Retail', 'Retail Based Customer', 'admjward', '2020-03-21 09:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `cutr`
--

CREATE TABLE `cutr` (
  `tr_id` int(11) NOT NULL,
  `tr_name` varchar(30) DEFAULT NULL,
  `tr_yearbd` decimal(9,4) DEFAULT '0.0000',
  `tr_stampuser` varchar(30) DEFAULT NULL,
  `tr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tr_maintuser` varchar(30) DEFAULT NULL,
  `tr_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cutr`
--

INSERT INTO `cutr` (`tr_id`, `tr_name`, `tr_yearbd`, `tr_stampuser`, `tr_timestamp`, `tr_maintuser`, `tr_mainttime`) VALUES
(1, '30 Days', '12.1666', 'admjward', '2020-03-22 12:26:42', NULL, '2020-03-22 12:28:04'),
(2, '60 Days', '6.0833', 'admjward', '2020-03-22 12:27:36', NULL, '2020-03-22 12:28:53'),
(3, '90 Days', '4.0555', 'admjward', '2020-03-22 12:28:53', NULL, '2020-03-22 12:28:53'),
(4, '120 Days', '3.0416', 'admjward', '2020-03-22 12:28:53', NULL, '2020-03-22 12:28:53'),
(5, '0 Days', '0.0000', 'admjward', '2020-03-22 12:28:53', NULL, '2020-03-22 12:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `eshd`
--

CREATE TABLE `eshd` (
  `es_id` int(11) NOT NULL,
  `es_quote` int(9) DEFAULT NULL,
  `es_site` int(5) DEFAULT NULL,
  `es_status` varchar(15) DEFAULT 'Open',
  `es_cust` int(9) DEFAULT NULL,
  `es_cuname` varchar(50) DEFAULT NULL,
  `es_title` varchar(100) DEFAULT NULL,
  `es_addr` varchar(100) DEFAULT NULL,
  `es_sub` varchar(60) DEFAULT NULL,
  `es_pc` int(4) DEFAULT NULL,
  `es_state` varchar(5) DEFAULT NULL,
  `es_exgst` decimal(65,4) DEFAULT NULL,
  `es_incgst` decimal(65,4) DEFAULT NULL,
  `es_type` varchar(10) DEFAULT NULL,
  `es_expdate` varchar(30) DEFAULT NULL,
  `es_user` varchar(30) DEFAULT NULL,
  `es_stampuser` varchar(30) DEFAULT NULL,
  `es_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `es_maintuser` varchar(30) DEFAULT NULL,
  `es_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eshd`
--

INSERT INTO `eshd` (`es_id`, `es_quote`, `es_site`, `es_status`, `es_cust`, `es_cuname`, `es_title`, `es_addr`, `es_sub`, `es_pc`, `es_state`, `es_exgst`, `es_incgst`, `es_type`, `es_expdate`, `es_user`, `es_stampuser`, `es_timestamp`, `es_maintuser`, `es_maintime`) VALUES
(1, 300000, 770, 'Open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-17 11:49:53', NULL, '2021-06-17 11:49:53'),
(2, 300000, 771, 'Open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-17 11:49:53', NULL, '2021-06-17 11:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `esln`
--

CREATE TABLE `esln` (
  `el_id` int(11) NOT NULL,
  `el_seq` int(9) DEFAULT '5',
  `el_quote` int(9) DEFAULT NULL,
  `el_site` int(5) DEFAULT NULL,
  `el_sku` varchar(50) DEFAULT NULL,
  `el_desc` varchar(255) DEFAULT NULL,
  `el_qty` decimal(65,4) DEFAULT NULL,
  `el_per` decimal(65,4) DEFAULT NULL,
  `el_uom` varchar(10) DEFAULT NULL,
  `el_price` decimal(65,4) DEFAULT NULL,
  `el_disc` decimal(65,4) DEFAULT NULL,
  `el_netprice` decimal(65,4) DEFAULT NULL,
  `el_marg` decimal(65,4) DEFAULT NULL,
  `el_prcex` decimal(65,4) DEFAULT NULL,
  `el_cost` decimal(65,4) DEFAULT NULL,
  `el_cnote` varchar(1000) DEFAULT NULL,
  `el_onote` varchar(1000) DEFAULT NULL,
  `el_stampuser` varchar(30) DEFAULT NULL,
  `el_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estp`
--

CREATE TABLE `estp` (
  `et_id` int(11) NOT NULL,
  `et_name` varchar(50) DEFAULT NULL,
  `et_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estp`
--

INSERT INTO `estp` (`et_id`, `et_name`, `et_desc`) VALUES
(1, 'Day-to-day Quotation', 'For day to day Quotes'),
(2, 'Project', 'Quotation for major projects');

-- --------------------------------------------------------

--
-- Table structure for table `gnmf`
--

CREATE TABLE `gnmf` (
  `gn_id` int(11) NOT NULL,
  `gn_name` varchar(100) DEFAULT NULL,
  `gn_defstat` int(9) DEFAULT NULL,
  `oe_pswd` varchar(30) DEFAULT NULL,
  `gn_tax` varchar(10) NOT NULL DEFAULT '10%',
  `gn_taxval` decimal(3,2) NOT NULL DEFAULT '1.10',
  `gn_maintuser` varchar(30) DEFAULT NULL,
  `gn_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gnmf`
--

INSERT INTO `gnmf` (`gn_id`, `gn_name`, `gn_defstat`, `oe_pswd`, `gn_tax`, `gn_taxval`, `gn_maintuser`, `gn_mainttime`) VALUES
(1, 'SnakeBite Software', 3, 'override', '10%', '1.10', 'admjward', '2020-07-29 14:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `hlst`
--

CREATE TABLE `hlst` (
  `hl_id` int(11) NOT NULL,
  `hl_name` varchar(30) DEFAULT NULL,
  `hl_desc` varchar(50) DEFAULT NULL,
  `hl_action` varchar(100) DEFAULT NULL,
  `hl_stampuser` varchar(30) DEFAULT NULL,
  `hl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hl_maintuser` varchar(30) DEFAULT NULL,
  `hl_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hlst`
--

INSERT INTO `hlst` (`hl_id`, `hl_name`, `hl_desc`, `hl_action`, `hl_stampuser`, `hl_timestamp`, `hl_maintuser`, `hl_mainttime`) VALUES
(1, 'No Status', 'Customer is free to use account', '', 'admjward', '2020-03-22 02:07:42', NULL, '2020-04-23 09:09:00'),
(2, 'Limit', 'Customer has limited credit', 'msg', 'admjward', '2020-03-22 02:08:43', NULL, '2020-03-22 02:08:43'),
(3, 'Terms', 'Customer has exceeded payment terms', 'msg + password', 'admjward', '2020-03-22 02:08:43', NULL, '2020-04-23 08:38:47'),
(4, 'Held', 'Customer is on hard hold', 'msg + no_use', 'admjward', '2020-03-22 02:08:43', NULL, '2020-03-22 02:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `imic`
--

CREATE TABLE `imic` (
  `ic_id` int(11) NOT NULL,
  `ic_code` varchar(10) DEFAULT NULL,
  `ic_name` varchar(100) DEFAULT NULL,
  `ic_supp` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imic`
--

INSERT INTO `imic` (`ic_id`, `ic_code`, `ic_name`, `ic_supp`) VALUES
(2, '300000', 'Undefined Class\r\n', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `imlc`
--

CREATE TABLE `imlc` (
  `lc_id` int(11) NOT NULL,
  `lc_name` varchar(40) DEFAULT NULL,
  `lc_loc` varchar(6) DEFAULT NULL,
  `lc_site` int(5) DEFAULT NULL,
  `lc_stampuser` varchar(30) DEFAULT NULL,
  `lc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `immf`
--

CREATE TABLE `immf` (
  `im_id` int(11) NOT NULL,
  `im_sku` varchar(50) DEFAULT NULL,
  `im_desc` varchar(100) DEFAULT NULL,
  `im_brand` varchar(20) DEFAULT NULL,
  `im_range` varchar(20) DEFAULT NULL,
  `im_scls` varchar(10) DEFAULT NULL,
  `im_icls` varchar(10) DEFAULT NULL,
  `im_cosf` int(3) DEFAULT NULL,
  `im_supp` int(9) DEFAULT NULL,
  `im_stdc` decimal(9,4) DEFAULT NULL,
  `im_trd` decimal(9,2) DEFAULT NULL,
  `im_ret` decimal(9,2) DEFAULT NULL,
  `im_uom` varchar(5) NOT NULL,
  `im_per` decimal(65,4) DEFAULT NULL,
  `im_barcode` varchar(100) DEFAULT NULL,
  `im_alt1` varchar(50) NOT NULL,
  `im_stkctrl` int(1) DEFAULT '1',
  `im_alt2` varchar(50) NOT NULL,
  `im_stampuser` varchar(30) DEFAULT NULL,
  `im_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `im_maintuser` varchar(30) DEFAULT NULL,
  `im_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `immv`
--

CREATE TABLE `immv` (
  `mv_id` int(11) NOT NULL,
  `mv_sku` varchar(50) DEFAULT NULL,
  `mv_type` varchar(20) DEFAULT NULL,
  `mv_user` varchar(30) DEFAULT NULL,
  `mv_qty` decimal(9,2) DEFAULT NULL,
  `mv_bal` decimal(9,2) DEFAULT NULL,
  `mv_avg` decimal(9,4) DEFAULT NULL,
  `mv_site` int(5) DEFAULT NULL,
  `mv_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `impc`
--

CREATE TABLE `impc` (
  `pc_id` int(11) NOT NULL,
  `pc_code` varchar(10) DEFAULT NULL,
  `pc_name` varchar(255) DEFAULT NULL,
  `pc_vendor` int(11) DEFAULT NULL,
  `pc_stampuser` varchar(30) DEFAULT NULL,
  `pc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imsc`
--

CREATE TABLE `imsc` (
  `sc_id` int(11) NOT NULL,
  `sc_ret` decimal(65,4) DEFAULT '80.0000',
  `sc_trd` decimal(65,4) DEFAULT '50.0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imsc`
--

INSERT INTO `imsc` (`sc_id`, `sc_ret`, `sc_trd`) VALUES
(1, '80.0000', '50.0000');

-- --------------------------------------------------------

--
-- Table structure for table `imwh`
--

CREATE TABLE `imwh` (
  `wh_id` int(11) NOT NULL,
  `im_id` int(99) DEFAULT NULL,
  `wh_site` varchar(6) DEFAULT NULL,
  `wh_stk` decimal(9,2) DEFAULT '0.00',
  `wh_alloc` decimal(9,2) DEFAULT '0.00',
  `wh_onor` decimal(9,2) DEFAULT '0.00',
  `wh_bor` decimal(9,2) DEFAULT '0.00',
  `wh_loc` varchar(10) DEFAULT NULL,
  `wh_avgcst` decimal(9,4) DEFAULT '0.0000',
  `wh_stampuser` varchar(30) DEFAULT NULL,
  `wh_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wh_maintuser` varchar(30) DEFAULT NULL,
  `wh_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invh`
--

CREATE TABLE `invh` (
  `vh_id` int(11) NOT NULL,
  `vh_inv` int(9) DEFAULT NULL,
  `vh_order` int(9) DEFAULT NULL,
  `vh_po` varchar(50) DEFAULT NULL,
  `vh_job` varchar(50) DEFAULT NULL,
  `vh_site` int(5) DEFAULT NULL,
  `vh_user` varchar(30) DEFAULT NULL,
  `vh_cust` int(9) DEFAULT NULL,
  `vh_cuname` varchar(100) DEFAULT NULL,
  `vh_amtex` decimal(65,4) DEFAULT NULL,
  `vh_amtinc` decimal(65,4) DEFAULT NULL,
  `vh_marg` decimal(65,4) DEFAULT NULL,
  `vh_stampuser` varchar(15) DEFAULT NULL,
  `vh_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invh`
--

INSERT INTO `invh` (`vh_id`, `vh_inv`, `vh_order`, `vh_po`, `vh_job`, `vh_site`, `vh_user`, `vh_cust`, `vh_cuname`, `vh_amtex`, `vh_amtinc`, `vh_marg`, `vh_stampuser`, `vh_timestamp`) VALUES
(1, 100000, NULL, NULL, NULL, 770, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-17 11:49:53'),
(2, 100000, NULL, NULL, NULL, 771, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-17 11:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `invl`
--

CREATE TABLE `invl` (
  `vl_id` int(11) NOT NULL,
  `vl_inv` int(9) DEFAULT NULL,
  `vl_order` int(9) DEFAULT NULL,
  `vl_site` int(5) DEFAULT NULL,
  `vl_sku` varchar(50) DEFAULT NULL,
  `vl_desc` varchar(200) DEFAULT NULL,
  `vl_per` int(5) DEFAULT NULL,
  `vl_uom` varchar(5) DEFAULT NULL,
  `vl_price` decimal(9,4) DEFAULT NULL,
  `vl_oqty` decimal(9,4) DEFAULT NULL,
  `vl_qty` decimal(9,4) DEFAULT NULL,
  `vl_bor` decimal(9,4) DEFAULT NULL,
  `vl_incgst` decimal(9,4) DEFAULT NULL,
  `vl_cost` decimal(65,4) DEFAULT NULL,
  `vl_marg` decimal(65,4) DEFAULT NULL,
  `vl_lnval` decimal(65,4) DEFAULT NULL,
  `vl_stampuser` varchar(50) DEFAULT NULL,
  `vl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `iuom`
--

CREATE TABLE `iuom` (
  `um_id` int(11) NOT NULL,
  `uom_shrt` varchar(3) DEFAULT NULL,
  `uom_long` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iuom`
--

INSERT INTO `iuom` (`um_id`, `uom_shrt`, `uom_long`) VALUES
(1, 'EA', 'Each'),
(2, 'MTR', 'Meter'),
(3, 'BX', 'Box'),
(4, 'LTH', 'Length'),
(5, 'PK', 'Pack'),
(6, 'BG', 'Bag');

-- --------------------------------------------------------

--
-- Table structure for table `menb`
--

CREATE TABLE `menb` (
  `bt_id` int(11) NOT NULL,
  `bt_name` varchar(20) DEFAULT NULL,
  `bt_link` varchar(255) DEFAULT NULL,
  `bt_sec` varchar(3) DEFAULT NULL,
  `bt_menu` int(9) DEFAULT NULL,
  `bt_mod` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menb`
--

INSERT INTO `menb` (`bt_id`, `bt_name`, `bt_link`, `bt_sec`, `bt_menu`, `bt_mod`) VALUES
(1, 'Create a Sale', 'sale/oe_header.php', '*', 2, 'oe'),
(2, 'Raise Credit', 'credit/oe_credit.php', '*', 4, 'oe');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `mn_id` int(11) NOT NULL,
  `mn_mod` varchar(3) DEFAULT NULL,
  `mn_button` varchar(30) DEFAULT NULL,
  `mn_menu` varchar(5) DEFAULT NULL,
  `mn_path` varchar(255) DEFAULT NULL,
  `mn_perm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`mn_id`, `mn_mod`, `mn_button`, `mn_menu`, `mn_path`, `mn_perm`) VALUES
(1, 'oe', 'Sale Processing', 'enq', '/oe/action/oe_header.php', '*'),
(2, 'im', 'Product Enquiry', 'enq', '/im/enq/im_enq.php', '*'),
(3, 'im', 'National Stock Check', 'enq', '/im/enq/im_nstk.php', '*'),
(4, 'im', 'National Cost Enquiry', 'enq', '/im/enq/im_ncst.php', 'ADM'),
(5, 'im', 'Stock Adjustment', 'maint', '/im/maint/im_stkadj.php', 'ADM'),
(6, 'im', 'Stock Adjustment', 'maint', '/im/maint/im_stkadj.php', 'STM'),
(7, 'im', 'Average Cost Adjustment', 'maint', '/im/maint/im_avgadj.php', 'ADM'),
(8, 'po', 'Raise PO', 'act', '/po/po_header.php', '*'),
(9, 'po', 'Receipt a PO', 'act', '/po/po_rcpt.php', '*'),
(10, 'es', 'Quotation Entry', 'act', '/qe/action/es_header.php', '*'),
(11, 'sf', 'Menu Maintenance', 'maint', '/sf/maint/sf_menu.php', 'ADM'),
(12, 'sf', 'User Maintenance', 'maint', '/sf/maint/sf_user.php', 'ADM'),
(13, 'sf', 'Site Access Maintenance', 'maint', '/sf/maint/sf_ucbra.php', 'ADM'),
(14, 'sf', 'Shortcut Maintenance', 'maint', '/sf/maint/sf_progsc.php', 'ADM'),
(15, 'sf', 'Site Maintenance', 'maint', '/sf/maint/sf_sites.php', 'ADM'),
(16, 'sf', 'Switch Sites', 'act', '/sf/action/sf_cbra.php', '*'),
(17, 'im', 'Product Maintenance', 'maint', '/im/maint/im_prodc.php', 'ADM'),
(18, 'ar', 'Debtor Balance', 'enq', '/ar/enq/ar_bal.php', '*'),
(19, 'ar', 'Customer Statistics', 'enq', '/ar/enq/ar_stat.php', '*'),
(20, 'oe', 'Sales Processing', 'act', '/oe/action/oe_header.php', '*'),
(21, 'po', 'Supplier Requirements', 'maint', '/po/maint/po_supreq.php', '*'),
(22, 'im', 'Stocktake', 'act', '/im/action/im_stktake.php', '*'),
(23, 'im', 'Stocktake Status Enquiry', 'enq', '/im/enq/im_stktstat.php', '*'),
(24, 'sf', 'Change Background Image', 'maint', '/sf/maint/sf_bgimg.php', '*'),
(25, 'oe', 'Standard Entry Codes', 'maint', '/oe/maint/oe_stdc.php', 'ADM'),
(26, 'im', 'Variance Report', 'rep', '/im/report/im_variance.php', '*'),
(27, 'oe', 'Invoice Values', 'enq', '/oe/enq/oe_invval.php', '*'),
(28, 'an', 'Customer Sales Export', 'exp', '/an/exp/an_cusales.php', '*'),
(29, 'sf', 'Security File', 'maint', '/sf/maint/sf_secf.php', 'ADM'),
(30, 'sp', 'Price Enquiry', 'enq', '/sp/enq/sp_price.php', '*'),
(31, 'im', 'Price Enquiry', 'enq', '/sp/enq/sp_price.php', '*'),
(32, 'oe', 'Price Enquiry', 'enq', '/sp/enq/sp_price.php', '*'),
(33, 'sf', 'ERP Information', 'enq', '/sf/enq/sf_info.php', 'ADM'),
(34, 'oe', 'Credit Note Entry', 'act', '/oe/action/oe_credit.php', '*'),
(35, 'sf', 'Server File Count', 'enq', '/sf/enq/R5-FileCount.ps1', 'ADM'),
(36, 'sf', 'Truncate DB', 'maint', '/db/db_trunc.php', 'ADM');

-- --------------------------------------------------------

--
-- Table structure for table `modl`
--

CREATE TABLE `modl` (
  `md_id` int(11) NOT NULL,
  `md_name` varchar(25) DEFAULT NULL,
  `md_desc` varchar(255) DEFAULT NULL,
  `md_icon` varchar(255) DEFAULT NULL,
  `md_secgrp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modl`
--

INSERT INTO `modl` (`md_id`, `md_name`, `md_desc`, `md_icon`, `md_secgrp`) VALUES
(1, 'Accounts Recievable', 'AR Module to do commit AR activities', 'ar.png', '*');

-- --------------------------------------------------------

--
-- Table structure for table `oedp`
--

CREATE TABLE `oedp` (
  `dp_id` int(11) NOT NULL,
  `dp_cust` int(9) DEFAULT NULL,
  `dp_to` varchar(50) DEFAULT NULL,
  `dp_addr` varchar(255) DEFAULT NULL,
  `dp_sub` varchar(50) DEFAULT NULL,
  `dp_state` varchar(5) DEFAULT NULL,
  `dp_pc` int(4) DEFAULT NULL,
  `dp_order` int(9) DEFAULT NULL,
  `dp_wh` int(9) DEFAULT NULL,
  `dp_specins` varchar(500) DEFAULT NULL,
  `dp_deltp` varchar(4) DEFAULT NULL,
  `dp_inv` int(9) DEFAULT NULL,
  `dp_stampuser` varchar(30) DEFAULT NULL,
  `dp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oesc`
--

CREATE TABLE `oesc` (
  `sc_id` int(11) NOT NULL,
  `sc_allowstkoverride` int(1) DEFAULT NULL,
  `sc_orderapproval` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oesc`
--

INSERT INTO `oesc` (`sc_id`, `sc_allowstkoverride`, `sc_orderapproval`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orhd`
--

CREATE TABLE `orhd` (
  `oh_hdid` int(11) NOT NULL,
  `oh_order` int(9) DEFAULT NULL,
  `oh_site` int(9) DEFAULT NULL,
  `oh_cust` int(9) DEFAULT NULL,
  `oh_cuname` varchar(50) DEFAULT NULL,
  `oh_user` varchar(30) DEFAULT NULL,
  `oh_cupo` varchar(30) DEFAULT NULL,
  `oh_cujb` varchar(30) DEFAULT NULL,
  `oh_status` varchar(15) DEFAULT 'Open',
  `oh_stampuser` varchar(30) DEFAULT NULL,
  `oh_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `oh_maintuser` varchar(30) DEFAULT NULL,
  `oh_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `oh_quoteno` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orhd`
--

INSERT INTO `orhd` (`oh_hdid`, `oh_order`, `oh_site`, `oh_cust`, `oh_cuname`, `oh_user`, `oh_cupo`, `oh_cujb`, `oh_status`, `oh_stampuser`, `oh_timestamp`, `oh_maintuser`, `oh_maintime`, `oh_quoteno`) VALUES
(1, 200000, 770, NULL, NULL, NULL, NULL, NULL, 'Invoiced', NULL, '2021-06-17 11:49:53', NULL, '2021-06-17 11:49:53', NULL),
(2, 200000, 771, NULL, NULL, NULL, NULL, NULL, 'Invoiced', NULL, '2021-06-17 11:49:53', NULL, '2021-06-17 11:49:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orln`
--

CREATE TABLE `orln` (
  `ln_id` int(11) NOT NULL,
  `ln_seq` int(4) DEFAULT '1',
  `ln_reqdate` varchar(20) DEFAULT NULL,
  `ln_order` int(9) DEFAULT NULL,
  `ln_site` int(5) DEFAULT NULL,
  `ln_sku` varchar(50) DEFAULT NULL,
  `ln_desc` varchar(200) DEFAULT NULL,
  `ln_per` int(5) DEFAULT NULL,
  `ln_uom` varchar(5) DEFAULT NULL,
  `ln_oqty` decimal(9,4) DEFAULT NULL,
  `ln_alloc` decimal(9,4) DEFAULT NULL,
  `ln_bor` decimal(9,4) DEFAULT NULL,
  `ln_listprice` decimal(65,4) DEFAULT NULL,
  `ln_disc` decimal(65,4) DEFAULT NULL,
  `ln_netprice` decimal(9,4) DEFAULT NULL,
  `ln_val` decimal(65,4) DEFAULT NULL,
  `ln_marg` decimal(9,2) DEFAULT NULL,
  `ln_cost` decimal(65,4) DEFAULT NULL,
  `ln_onotes` varchar(1000) DEFAULT NULL,
  `ln_cnotes` varchar(1000) DEFAULT NULL,
  `ln_stampuser` varchar(30) DEFAULT NULL,
  `ln_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ln_maintuser` varchar(30) DEFAULT NULL,
  `ln_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `podp`
--

CREATE TABLE `podp` (
  `dp_id` int(11) NOT NULL,
  `dp_order` int(9) DEFAULT NULL,
  `dp_site` int(5) DEFAULT NULL,
  `dp_delto` varchar(100) DEFAULT NULL,
  `dp_addr` varchar(100) DEFAULT NULL,
  `dp_sub` varchar(100) DEFAULT NULL,
  `dp_postcode` int(9) DEFAULT NULL,
  `dp_state` varchar(5) DEFAULT NULL,
  `dp_notes` varchar(1000) DEFAULT NULL,
  `dp_stampuser` varchar(30) DEFAULT NULL,
  `dp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pofr`
--

CREATE TABLE `pofr` (
  `fr_id` int(11) NOT NULL,
  `fr_imid` int(9) DEFAULT NULL,
  `fr_supp` int(9) DEFAULT NULL,
  `fr_qty` decimal(9,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pohd`
--

CREATE TABLE `pohd` (
  `ph_id` int(11) NOT NULL,
  `ph_order` int(9) DEFAULT NULL,
  `ph_supp` int(9) DEFAULT NULL,
  `ph_user` varchar(30) DEFAULT NULL,
  `ph_site` int(6) DEFAULT NULL,
  `ph_totalex` decimal(65,4) DEFAULT '0.0000',
  `ph_contract` varchar(30) DEFAULT NULL,
  `hd_stat` varchar(10) DEFAULT 'OPEN',
  `ph_trans` varchar(15) DEFAULT NULL,
  `ph_ref` varchar(255) DEFAULT NULL,
  `ph_stampuser` varchar(30) DEFAULT NULL,
  `ph_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ph_maintuser` varchar(30) DEFAULT NULL,
  `ph_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pohd`
--

INSERT INTO `pohd` (`ph_id`, `ph_order`, `ph_supp`, `ph_user`, `ph_site`, `ph_totalex`, `ph_contract`, `hd_stat`, `ph_trans`, `ph_ref`, `ph_stampuser`, `ph_timestamp`, `ph_maintuser`, `ph_maintime`) VALUES
(1, 100000, NULL, NULL, 770, '0.0000', NULL, 'OPEN', NULL, NULL, NULL, '2021-06-17 11:49:53', NULL, '2021-06-17 11:49:53'),
(2, 100000, NULL, NULL, 771, '0.0000', NULL, 'OPEN', NULL, NULL, NULL, '2021-06-17 11:49:53', NULL, '2021-06-17 11:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `poln`
--

CREATE TABLE `poln` (
  `ln_id` int(11) NOT NULL,
  `ln_seq` int(10) DEFAULT NULL,
  `ln_sku` varchar(50) DEFAULT NULL,
  `ln_desc` varchar(150) DEFAULT NULL,
  `ln_order` int(9) DEFAULT NULL,
  `ln_wh` int(5) DEFAULT NULL,
  `ln_qty` decimal(9,4) DEFAULT NULL,
  `ln_finflag` varchar(3) DEFAULT 'no',
  `ln_rjqty` decimal(65,4) DEFAULT NULL,
  `ln_rcqty` decimal(65,4) DEFAULT NULL,
  `ln_price` decimal(9,4) DEFAULT NULL,
  `ln_per` int(9) DEFAULT NULL,
  `ln_uom` varchar(5) DEFAULT NULL,
  `ln_gst` decimal(9,4) DEFAULT NULL,
  `ln_reqdate` varchar(20) DEFAULT NULL,
  `ln_stampuser` varchar(30) DEFAULT NULL,
  `ln_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ln_maintuser` varchar(30) DEFAULT NULL,
  `ln_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posr`
--

CREATE TABLE `posr` (
  `sr_id` int(11) NOT NULL,
  `sr_supp` int(9) DEFAULT NULL,
  `sr_mov` decimal(9,2) DEFAULT NULL,
  `sr_prtr` varchar(6) DEFAULT NULL,
  `sr_email` varchar(255) DEFAULT NULL,
  `sr_efax` varchar(20) DEFAULT NULL,
  `sr_edi` varchar(255) DEFAULT NULL,
  `sr_edi2` varchar(255) DEFAULT NULL,
  `sr_cont` int(9) DEFAULT NULL,
  `sr_site` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `potr`
--

CREATE TABLE `potr` (
  `tr_id` int(11) NOT NULL,
  `tr_supp` int(9) DEFAULT NULL,
  `tr_edi` int(1) DEFAULT NULL,
  `tr_email` int(1) DEFAULT NULL,
  `tr_efax` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potr`
--

INSERT INTO `potr` (`tr_id`, `tr_supp`, `tr_edi`, `tr_email`, `tr_efax`) VALUES
(1, 1001, 0, 1, 0),
(2, 1002, 1, 1, 0),
(3, 1003, 1, 1, 0),
(4, 1004, 0, 1, 0),
(5, 1005, 1, 1, 0),
(6, 1006, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prcs`
--

CREATE TABLE `prcs` (
  `cs_id` int(11) NOT NULL,
  `cs_code` int(9) DEFAULT NULL,
  `cs_cust` int(9) DEFAULT NULL,
  `cs_stampuser` varchar(30) DEFAULT NULL,
  `cs_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prhd`
--

CREATE TABLE `prhd` (
  `pr_id` int(11) NOT NULL,
  `pr_code` int(9) DEFAULT NULL,
  `pr_site` int(5) DEFAULT NULL,
  `pr_startdate` varchar(20) DEFAULT NULL,
  `pr_expdate` varchar(20) DEFAULT NULL,
  `pr_stampuser` varchar(30) DEFAULT NULL,
  `pr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `priv`
--

CREATE TABLE `priv` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(3) DEFAULT NULL,
  `p_desc` varchar(50) DEFAULT NULL,
  `p_vis` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priv`
--

INSERT INTO `priv` (`p_id`, `p_name`, `p_desc`, `p_vis`) VALUES
(1, 'ADM', 'Administrator User', 0),
(2, 'AR', 'AR User', 0),
(3, 'ARS', 'AR Supervisor', 0),
(4, 'AP', 'AP User', 0),
(5, 'APS', 'AP Supervisor', 0),
(6, 'STM', 'Site Manager', 0),
(7, 'STU', 'Site User', 1),
(8, 'STS', 'Site Supervisor', 1),
(9, 'LTD', 'Limited User', 1),
(10, 'IMS', 'Inventory Master User', 1),
(11, 'IT', 'IT User', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prln`
--

CREATE TABLE `prln` (
  `pl_id` int(11) NOT NULL,
  `pl_code` int(9) DEFAULT NULL,
  `pl_sku` varchar(30) DEFAULT NULL,
  `pl_price` decimal(65,4) DEFAULT NULL,
  `pl_stampuser` varchar(30) DEFAULT NULL,
  `pl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prsc`
--

CREATE TABLE `prsc` (
  `sc_id` int(11) NOT NULL,
  `sc_code` varchar(10) DEFAULT NULL,
  `sc_name` varchar(60) DEFAULT NULL,
  `sc_prog` varchar(20) DEFAULT NULL,
  `sc_path` varchar(255) DEFAULT NULL,
  `sc_users` varchar(255) DEFAULT NULL,
  `sc_group` varchar(255) DEFAULT NULL,
  `sc_visible` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prsc`
--

INSERT INTO `prsc` (`sc_id`, `sc_code`, `sc_name`, `sc_prog`, `sc_path`, `sc_users`, `sc_group`, `sc_visible`) VALUES
(1, 'improdc', 'Product Creation', 'im_prodc', '/im/maint/im_prodc.php', '!', 'ADM,IMS,!', 1),
(2, 'impcls', 'Price Class Maintenance', 'im_pcls', '/im/maint/im_pcls.php', '!', 'ADM,!', 1),
(3, 'sale', 'Sales Order Entry', 'oe_header', '/oe/action/oe_header.php', '*', '*', 1),
(4, 'pocreate', 'Purchase Order Header', 'po_header', '/po/po_header.php', '*', '*', 1),
(5, 'imenq', 'Detailed Product Enquiry', 'im_enq', '/im/enq/im_enq.php', '*', '*', 1),
(6, 'imhome', 'IM Home Menu', 'im_home', '/im/im_home.php', '*', '*', 1),
(7, 'arhome', 'AR Home Menu', 'ar_home', '/ar/ar_home.php', '*', '*', 1),
(8, 'oehome', 'OE Home Menu', 'oe_home', '/oe/oe_home.php', '*', '*', 1),
(9, 'qehome', 'QE Home Menu', 'es_home', '/qe/qe_home.php', '*', '*', 1),
(10, 'pohome', 'PO Home Menu', 'po_home', '/po/po_home.php', '*', '*', 1),
(11, 'popena', 'PO Pending Approval', 'po_pena', '/po/enq/po_pena.php', '*', '*', 1),
(12, 'imadj', 'Stock Adjustment', 'im_stkadj', '/im/maint/im_stkadj.php', '*', '*', 1),
(13, 'imavgadj', 'Average Cost Adjustment', 'im_avgadj', '/im/maint/im_avgadj.php', '!', 'ADM,!', 1),
(14, 'imalloc', 'Allocated Goods Enquiry', 'im_alloc', '/im/enq/im_alloc.php', '*', '*', 1),
(15, 'imnstk', 'National Stock Check Enquiry', 'im_nstk', '/im/enq/im_nstk.php', '*', 'ADM,!', 1),
(16, 'imncst', 'National Cost Enquiry', 'im_ncst', '/im/enq/im_ncst.php', '!', 'ADM,!', 1),
(17, 'immov', 'Movement Enquiry', 'im_mvmt', '/im/enq/im_mvmt.php', '*', '*', 1),
(18, 'receipt', 'PO Receipting', 'po_rcpt', '/po/action/po_rcpt.php', '*', '*', 1),
(19, 'arcred', 'AR Credit Control', 'ar_credit', '/ar/maint/ar_credit.php', '!', 'ADM,AR,ARS,!', 1),
(21, NULL, '', NULL, '/skel.php', '!', 'ADM,!', 0),
(22, 'sfprogsc', 'Program Shortcuts', 'sf_progsc', '/sf/maint/sf_progsc.php', '!', 'ADM,!', 1),
(23, 'spcost', 'Special Pricing Header', 'sp_header', '/sp/action/sp_header.php', '*', '*', 1),
(24, 'user', 'User Maintenance', 'sf_user', '/sf/maint/sf_user.php', '!', 'ADM,!', 1),
(25, 'db666', 'Truncate Database', 'sf_dbtrunc', '/db/db_trunc.php', '!', 'ADM,!', 1),
(26, 'logout', 'Logout', 'sf_logout', '/erp/software_dependants/dep/logout.php', '!', 'ADM,!', 1),
(27, 'oeinv', 'Invoice Enquiry', 'oe_inv', '/oe/enq/oe_inv.php', '*', '*', 1),
(28, 'oeinvcust', 'Invoice vs Customer Enquiry', 'oe_ixcust', '/oe/enq/oe_ixcust.php', '*', '*', 1),
(29, 'oeinvprod', 'Invoice vs Product Enquiry', 'oe_ixprod', '/oe/enq/oe_ixprod.php', '*', '*', 1),
(30, 'sfsite', 'Site Maintenance', 'sf_sites', '/sf/maint/sf_sites.php', '!', 'ADM,!', 1),
(31, 'armaint', 'AR Masterfile Maintenance', 'ar_maint', '/ar/maint/ar_maint.php', '!', 'ADM,AR,ARS,!', 1),
(32, 'sfmenu', 'Menu Maintenance', 'sf_menu', '/sf/maint/sf_menu.php', '!', 'ADM,!', 1),
(33, 'sfhome', 'SF Home', 'sf_home', '/sf/sf_home.php', '!', 'ADM,!', 1),
(34, 'sphome', 'SP Home', 'sp_home', '/sp/sp_home.php', '*', '*', 1),
(35, 'quote', 'Quote Entry Header', 'es_header', '/qe/action/es_header.php', '!', 'ADM,!', 1),
(36, NULL, 'Quote Entry Lines', 'es_lines', '/qe/action/es_lines.php', '!', 'ADM,!', 0),
(37, 'oeopenord', 'Open Order Enquiry', 'oe_oord', '/oe/enq/oe_oord.php', '*', '*', 1),
(38, 'oeopencust', 'Open Order vs Customer Enquiry', 'oe_oxcust', '/oe/enq/oe_oxcust.php', '*', '*', 1),
(39, 'switch', 'Switch Site', 'sf_cbra', '/sf/action/sf_cbra.php', '*', '*', 1),
(40, 'cobra', 'Switch Site', 'sf_cbra', '/sf/action/sf_cbra.php', '*', '*', 1),
(41, 'sfsite', 'Site Switching Maintenace', 'sf_ucbra', '/sf/maint/sf_ucbra.php', '!', 'ADM,!', 1),
(42, 'arbal', 'AR Balance Enquiry', 'ar_bal', '/ar/enq/ar_bal.php', '*', '*', 1),
(43, 'arstat', 'AR Statistics Enquiry', 'ar_stat', '/ar/enq/ar_stat.php', '*', '*', 1),
(44, 'pomod', 'Modify Purchase Order', 'po_modhd', '/po/action/po_modhd.php', '!', 'ADM,!', 1),
(45, 'quoteenq', 'Quote Enquiry', 'es_quote', '/qe/enq/es_quote.php', '*', '*', 1),
(46, 'access', 'Access Error', 'access', '/erp/software_dependants/dep/access_error.php', '!', 'ADM,!', 0),
(47, 'posupp', 'PO vs Supplier Enquiry', 'po_enq-supp', '/po/enq/po_enq-supp.php', '*', '*', 1),
(48, 'poenq', 'PO Enquiry', 'po_enq', '/po/enq/po_enq.php', '*', '*', 1),
(49, 'posupreq', 'Supplier Requirements Maintenance', 'po_supreq', '/po/maint/po_supreq.php', '*', '*', 1),
(50, 'secm', 'Program Security File Maintenance', 'sf_secf', '/sf/maint/sf_secf.php', 'admjward,!', 'ADM,!', 1),
(52, NULL, 'SPI Document Base', 'SPI\'s', 'https://spi.com.au', '*', '*', 1),
(53, 'apmaint', 'Accounts Payable Maintenance', 'ap_maint', '/ap/maint/ap_maint.php', '!', 'ADM,APS,AP,!', 1),
(54, NULL, 'Order Entry Lines v2', 'oe_lines', '/oe/action/oe_lines.php', '*', '*', 0),
(55, 'pofrom', 'Purchase From Maintenance', 'po_from', '/po/maint/po_from.php', '!', 'ADM,AP,APS,!', 1),
(56, 'armaint', 'AR Maintenance V2', 'ar106b', '/ar/maint/ar_maint.php', '!', 'ADM,!', 1),
(57, 'arenq', 'AR Enquiry', 'ar_deb', '/ar/enq/ar_deb.php', '*', '*', 1),
(58, 'oestdc', 'Order Entry Standard Codes', 'oe_stdc', '/oe/maint/oe_stdc.php', '!', 'ADM,!', 1),
(59, NULL, 'oe_invO', 'oe_invO', '/oe/action/oe_inv.php', '*', '*', 0),
(60, NULL, 'po_lines', 'po_lines', '/po/po_lines.php', '*', '*', 0),
(61, NULL, 'po_del', 'po_del', '/po/po_del.php', '*', '*', 0),
(62, NULL, 'po_rcpt_b', 'po_rcpt_b', '/po/action/po_rcpt_b.php', '*', '*', 0),
(63, 'imstktake', 'Stocktake', 'im_stktake', '/im/action/stocktake/im_stktake.php', '*', '*', 1),
(64, 'home', 'home', 'home', '/erp/home.php', '*', '*', 1),
(65, NULL, 'oe_invdet', 'oe_invdet', '/oe/enq/oe_invdet.php', '*', '*', 0),
(66, 'imstakeenq', 'Stocktake Status Enquiry', 'im_stktstat', '/im/enq/im_stktstat.php', '*', '*', 1),
(67, 'impurge', 'Purge Stocktake', 'im_stktkpurge', '/im/action/stocktake/im_stktkpurge.php', '*', '*', 1),
(68, 'imcount', 'Stocktake Counts Entry', 'im_stktkenter', '/im/action/stocktake/im_stktkenter.php', '*', '*', 1),
(69, 'imvariance', 'Stocktake Variance Report', 'im_variance', '/im/report/im_variance.php', '*', '*', 1),
(70, 'impoststk', 'Post Stocktake', 'im_poststktk', '/im/action/stocktake/im_poststktk.php', '*', '*', 1),
(71, NULL, 'Order Detailed Enquiry', 'oe_orddet', '/oe/enq/oe_orddet.php', '*', '*', 0),
(72, 'imbinm', 'Bin Locations Maintenance', 'im_binl', '/im/maint/im_binl.php', '*', '*', 1),
(73, 'imbin', 'Bin Locate a Product', 'im_locprod', '/im/maint/im_locprod.php', '*', '*', 1),
(74, NULL, 'PO Modify Lines', 'po_modln', '/po/action/po_modln.php?', '*', '*', 0),
(75, NULL, 'SP Lines', 'sp_lines', '/sp/action/sp_lines.php', '*', '*', 0),
(76, 'background', 'Change Background Image', 'sf_bgimg', '/sf/maint/sf_bgimg.php', '*', '*', 1),
(77, 'massbg', 'Mass Change Background', 'sf_msbgimg', '/sf/maint/sf_msbgimg.php', '!', 'ADM,!', 1),
(78, 'oeinvval', 'Invoice Value for Date Enquiry', 'oe_invval', '/oe/enq/oe_invval.php', '*', '*', 1),
(79, 'anhome', 'Analytics Home', 'an_home', '/an/an_home.php', '*', '*', 1),
(80, 'ansalesexp', 'Customer Sales Export', 'an_cusales', '/an/exp/an_cusales.php', '*', '*', 1),
(81, 'ansalesexc', 'Executive Customer Sales Export', 'an_cusales_exec', '/an/exp/an_cusales_exec.php', '!', 'ADM,EXC,ARS,!', 1),
(82, 'pomass', 'Mass Purchasing via Vendor', 'po_masspo', '/po/action/po_masspo.php', '!', 'ADM,STM,!', 1),
(83, 'aphome', 'AP Enquiry', 'ap_enq', '/ap/enq/ap_enq.php', '*', '*', 1),
(84, 'impo', 'Outstanding Purchase Orders', 'im_po', '/im/enq/im_po.php', '*', '*', 1),
(85, 'spprice', 'Price Enquiry', 'sp_price', '/sp/enq/sp_price.php', '*', '*', 1),
(86, 'erp', 'ERP Information', 'sf_info', '/sf/enq/sf_info.php', '!', 'ADM,!', 1),
(87, 'myprofile', 'My Profile', 'sf_myprofile', '/sf/enq/sf_myprofile.php', '*', '*', 1),
(88, 'password', 'Change Password', 'sf_changepassword', '/sf/maint/sf_changepassword.php', '*', '*', 1),
(89, 'credit', 'Credit Note Entry', 'oe_credit', '/oe/action/oe_credit.php', '*', '*', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sacd`
--

CREATE TABLE `sacd` (
  `sa_id` int(11) NOT NULL,
  `sa_name` varchar(30) DEFAULT NULL,
  `sa_desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sacd`
--

INSERT INTO `sacd` (`sa_id`, `sa_name`, `sa_desc`) VALUES
(1, 'Stock Gain', 'Increasing Stock Level'),
(2, 'Stock Loss', 'Decreasing Stock Level'),
(3, 'For Store Use', 'Write off for store use');

-- --------------------------------------------------------

--
-- Table structure for table `sdhd`
--

CREATE TABLE `sdhd` (
  `sd_id` int(11) NOT NULL,
  `sd_supp` int(10) DEFAULT NULL,
  `sd_name` varchar(50) DEFAULT NULL,
  `sd_code` int(11) DEFAULT NULL,
  `sd_startdate` varchar(15) DEFAULT NULL,
  `sd_expdate` varchar(15) DEFAULT NULL,
  `sd_site` int(5) DEFAULT NULL,
  `sd_stampuser` varchar(30) DEFAULT NULL,
  `sd_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sd_maintuser` varchar(30) DEFAULT NULL,
  `sd_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sdln`
--

CREATE TABLE `sdln` (
  `sl_id` int(11) NOT NULL,
  `sl_code` int(11) DEFAULT NULL,
  `sl_site` int(5) DEFAULT NULL,
  `sl_sku` varchar(50) DEFAULT NULL,
  `sl_price` decimal(9,4) DEFAULT NULL,
  `sl_bval` decimal(9,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secm`
--

CREATE TABLE `secm` (
  `sc_id` int(11) NOT NULL,
  `sc_prog` varchar(20) DEFAULT NULL,
  `sc_users` varchar(255) DEFAULT NULL,
  `sc_groups` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spcs`
--

CREATE TABLE `spcs` (
  `sc_id` int(11) NOT NULL,
  `sc_code` int(9) DEFAULT NULL,
  `sc_cust` int(9) DEFAULT NULL,
  `sc_stampuser` varchar(30) DEFAULT NULL,
  `sc_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sphd`
--

CREATE TABLE `sphd` (
  `hd_id` int(11) NOT NULL,
  `hd_code` int(9) DEFAULT NULL,
  `hd_name` varchar(30) DEFAULT NULL,
  `hd_site` int(5) DEFAULT NULL,
  `hd_startdate` varchar(20) DEFAULT NULL,
  `hd_expdate` varchar(20) DEFAULT NULL,
  `hd_stampuser` varchar(30) DEFAULT NULL,
  `hd_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sphd`
--

INSERT INTO `sphd` (`hd_id`, `hd_code`, `hd_name`, `hd_site`, `hd_startdate`, `hd_expdate`, `hd_stampuser`, `hd_timestamp`) VALUES
(1, 770, 'Test Branch', 770, '2020-05-01', '2020-12-01', 'admjward', '2020-07-29 13:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `spln`
--

CREATE TABLE `spln` (
  `sl_id` int(11) NOT NULL,
  `sl_code` int(9) DEFAULT NULL,
  `sl_sku` varchar(50) DEFAULT NULL,
  `sl_pval` decimal(65,4) DEFAULT NULL,
  `sl_bval` decimal(65,4) DEFAULT NULL,
  `sl_ptype` varchar(15) DEFAULT NULL,
  `sl_stampuser` varchar(30) DEFAULT NULL,
  `sl_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spmf`
--

CREATE TABLE `spmf` (
  `sp_id` int(11) NOT NULL,
  `sp_cust` int(8) DEFAULT NULL,
  `sp_code` varchar(50) DEFAULT NULL,
  `sp_type` varchar(10) DEFAULT NULL,
  `sp_ptyp` varchar(10) DEFAULT NULL,
  `sp_pval` decimal(9,4) DEFAULT NULL,
  `sp_stampuser` varchar(30) DEFAULT NULL,
  `sp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sp_maintuser` varchar(30) DEFAULT NULL,
  `sp_maintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `srmf`
--

CREATE TABLE `srmf` (
  `sr_id` int(11) NOT NULL,
  `sr_salesid` varchar(10) DEFAULT NULL,
  `sr_name` varchar(100) DEFAULT NULL,
  `sr_usernm` varchar(30) DEFAULT NULL,
  `sr_site` int(5) DEFAULT NULL,
  `sr_stampuser` varchar(30) DEFAULT NULL,
  `sr_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sr_maintuser` varchar(30) DEFAULT NULL,
  `sr_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stat`
--

CREATE TABLE `stat` (
  `stt_id` int(11) NOT NULL,
  `stt_name` varchar(100) DEFAULT NULL,
  `stt_abrv` varchar(10) DEFAULT NULL,
  `stt_ctry` varchar(100) DEFAULT NULL,
  `stt_stampuser` varchar(30) DEFAULT NULL,
  `stt_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stat`
--

INSERT INTO `stat` (`stt_id`, `stt_name`, `stt_abrv`, `stt_ctry`, `stt_stampuser`, `stt_timestamp`) VALUES
(1, 'New South Wales', 'NSW', 'Australia', 'admjward', '2020-03-23 12:33:31'),
(2, 'Queensland', 'QLD', 'Australia', 'admjward', '2020-03-23 12:33:31'),
(3, 'Northern Territory', 'NT', 'Australia', 'admjward', '2020-03-23 12:33:31'),
(4, 'Western Australia', 'WA', 'Australia', 'admjward', '2020-03-23 12:33:31'),
(5, 'Victoria', 'VIC', 'Australia', 'admjward', '2020-03-23 12:33:31'),
(6, 'South Australia', 'SA', 'Australia', 'admjward', '2020-03-23 12:33:31'),
(7, 'Tasmania', 'TAS', 'Australia', 'admjward', '2020-03-23 12:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `sthd`
--

CREATE TABLE `sthd` (
  `st_id` int(11) NOT NULL,
  `st_code` int(11) NOT NULL,
  `st_site` int(5) DEFAULT NULL,
  `st_cyclicflag` int(1) DEFAULT NULL,
  `st_prodfrom` varchar(50) DEFAULT NULL,
  `st_prodto` varchar(50) DEFAULT NULL,
  `st_locfrom` varchar(5) DEFAULT NULL,
  `st_locto` varchar(5) DEFAULT NULL,
  `st_inczero` varchar(3) DEFAULT NULL,
  `st_status` varchar(15) DEFAULT 'Active',
  `st_stampuser` varchar(30) DEFAULT NULL,
  `st_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stln`
--

CREATE TABLE `stln` (
  `ln_id` int(11) NOT NULL,
  `ln_stkid` int(9) DEFAULT NULL,
  `ln_site` int(5) DEFAULT NULL,
  `ln_sku` varchar(50) DEFAULT NULL,
  `ln_desc` varchar(100) DEFAULT NULL,
  `ln_stkoh` decimal(65,4) DEFAULT NULL,
  `ln_stkct` decimal(65,4) DEFAULT NULL,
  `ln_avgcst` decimal(65,4) DEFAULT NULL,
  `ln_stdcst` decimal(65,4) DEFAULT NULL,
  `ln_stampuser` varchar(30) DEFAULT NULL,
  `ln_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stmf`
--

CREATE TABLE `stmf` (
  `stdb_id` int(11) NOT NULL,
  `st_code` varchar(6) DEFAULT NULL,
  `st_name` varchar(30) DEFAULT NULL,
  `st_addr` varchar(100) DEFAULT NULL,
  `st_sub` varchar(30) DEFAULT NULL,
  `st_pstcd` int(4) DEFAULT NULL,
  `st_state` varchar(3) DEFAULT NULL,
  `st_brand` int(9) DEFAULT NULL,
  `st_phone` varchar(20) NOT NULL,
  `st_manager` varchar(30) DEFAULT NULL,
  `st_stampuser` varchar(30) DEFAULT NULL,
  `st_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stmf`
--

INSERT INTO `stmf` (`stdb_id`, `st_code`, `st_name`, `st_addr`, `st_sub`, `st_pstcd`, `st_state`, `st_brand`, `st_phone`, `st_manager`, `st_stampuser`, `st_timestamp`) VALUES
(1, '770', 'Test Store 1', '123 ABC Street', 'Sydney', 2000, 'NSW', 1, '1300 123 456', NULL, NULL, '2020-07-25 10:21:01'),
(2, '771', 'Test Store 2', '456 ABC Street', 'Sydney', 2000, 'NSW', 1, '1300 123 456', NULL, NULL, '2020-11-08 02:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `sumf`
--

CREATE TABLE `sumf` (
  `su_code` int(11) NOT NULL,
  `su_name` varchar(100) DEFAULT NULL,
  `su_alias` varchar(15) DEFAULT NULL,
  `su_trans` varchar(5) DEFAULT NULL,
  `su_addr1` varchar(100) DEFAULT NULL,
  `su_sub1` varchar(50) DEFAULT NULL,
  `su_pc1` int(4) DEFAULT NULL,
  `su_state1` varchar(3) DEFAULT NULL,
  `su_addr2` varchar(100) DEFAULT NULL,
  `su_sub2` varchar(50) DEFAULT NULL,
  `su_pc2` int(4) DEFAULT NULL,
  `su_state2` varchar(3) DEFAULT NULL,
  `su_phone` varchar(15) DEFAULT NULL,
  `su_fax` varchar(15) DEFAULT NULL,
  `su_apemail` varchar(255) DEFAULT NULL,
  `su_termscd` int(9) DEFAULT NULL,
  `su_contract` varchar(30) DEFAULT NULL,
  `su_abn` varchar(20) DEFAULT NULL,
  `su_acn` varchar(20) DEFAULT NULL,
  `su_status` int(1) DEFAULT '1',
  `su_stampuser` varchar(30) DEFAULT NULL,
  `su_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `su_maintuser` varchar(30) DEFAULT NULL,
  `su_mainttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sumf`
--

INSERT INTO `sumf` (`su_code`, `su_name`, `su_alias`, `su_trans`, `su_addr1`, `su_sub1`, `su_pc1`, `su_state1`, `su_addr2`, `su_sub2`, `su_pc2`, `su_state2`, `su_phone`, `su_fax`, `su_apemail`, `su_termscd`, `su_contract`, `su_abn`, `su_acn`, `su_status`, `su_stampuser`, `su_timestamp`, `su_maintuser`, `su_mainttime`) VALUES
(1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2020-07-25 10:21:34', NULL, '2020-07-25 10:21:34'),
(1001, 'Rockstar Games', 'rockstar', 'email', '994 Game Loop', 'Sydney', 2000, 'NSW', '994 Game Loop', 'Sydney', 2000, 'NSW', '1300 653 663', '', 'ap@rockstar.com', 1, NULL, '12 423 123 123', '654 956 959', 1, 'admjward', '2020-07-25 10:27:08', NULL, '2020-07-25 10:27:08'),
(1002, 'Test Supplier', 'test', 'edi', '27 Voyager Street', 'Wadalba', 2259, 'NSW', '27 Voyager Street', 'Wadalba', 2259, 'NSW', '0450 098 133', '', 'ap@test.com', 2, NULL, '12 312 313 123', '545 545 434', 1, 'admjward', '2020-07-29 13:45:43', NULL, '2020-07-29 13:45:43'),
(1003, 'Ford Australia', 'Ford', 'edi', '25 Ford Lane', 'Melbourne', 3000, 'VIC', '25 Ford Lane', 'Melbourne', 3000, 'VIC', '03 8449 9656', '', 'ap@ford.com.au', 1, NULL, '51 665 658 988', '515 659 659', 1, 'admjward', '2020-07-30 01:50:51', NULL, '2020-07-30 01:50:51'),
(1004, 'Rubbish Collectors', 'rubbish', 'email', '1/445 Heat Road', 'Windsor', 2756, 'NSW', '1/445 Heat Road', 'Windsor', 2756, 'NSW', '02 4577 6553', '', 'ap@rubbishcollection.com.au', 1, NULL, '12 365 966 995', '132 626 355', 1, 'admjward', '2020-07-30 01:55:57', NULL, '2020-07-30 01:55:57'),
(1005, 'Food Distributors NSW', 'food', 'email', '445-476 Larry\'s Lane', 'Larry Town', 2633, 'NSW', '445-476 Larry\'s Lane', 'Larry Town', 2633, 'NSW', '02 4665 3626', '', 'ap@fooddistributors.com.au', 1, NULL, '51 632 626 632', '326 956 666', 1, 'admjward', '2020-07-30 01:57:04', NULL, '2020-07-30 01:57:04'),
(1006, 'Billabong', 'billabong', 'edi', '132 Billabong Road', 'Gold Cost', 3000, 'QLD', '132 Billabong Road', 'Gold Cost', 3000, 'QLD', '1300 992 223', '1300 992 225', 'accounts.payable@billabong.com.au', 1, NULL, '12 312 312 312', '999 999 999', 1, 'Reenie.Ward', '2020-11-08 02:22:18', NULL, '2020-11-08 02:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `usmf`
--

CREATE TABLE `usmf` (
  `us_id` int(11) NOT NULL,
  `us_user` varchar(30) DEFAULT NULL,
  `us_name` varchar(60) DEFAULT NULL,
  `us_password` varchar(100) DEFAULT NULL,
  `us_email` varchar(255) DEFAULT NULL,
  `us_sec` varchar(3) DEFAULT NULL,
  `us_stkadj` int(1) DEFAULT NULL,
  `us_link` int(1) DEFAULT '0',
  `us_polmt` decimal(9,2) DEFAULT '0.00',
  `us_site` int(3) DEFAULT NULL,
  `us_bgimg` varchar(255) DEFAULT NULL,
  `us_bgcol` varchar(100) DEFAULT NULL,
  `us_stampuser` varchar(30) DEFAULT NULL,
  `us_stampdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usmf`
--

INSERT INTO `usmf` (`us_id`, `us_user`, `us_name`, `us_password`, `us_email`, `us_sec`, `us_stkadj`, `us_link`, `us_polmt`, `us_site`, `us_bgimg`, `us_bgcol`, `us_stampuser`, `us_stampdate`) VALUES
(1, 'admin', 'Admin', '$2y$10$1g3hrfsqHEZ5bSRDGtF57OIPh/7Oo.sTceu3Vjtm3tBQPeBC5fgAq', 'admin@admin.net', 'ADM', 1, 0, '10000.00', 770, NULL, NULL, 'root', '2021-06-17 12:02:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arbl`
--
ALTER TABLE `arbl`
  ADD PRIMARY KEY (`bl_id`);

--
-- Indexes for table `ardc`
--
ALTER TABLE `ardc`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexes for table `arsc`
--
ALTER TABLE `arsc`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `bdmf`
--
ALTER TABLE `bdmf`
  ADD PRIMARY KEY (`bd_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`bg_id`);

--
-- Indexes for table `borp`
--
ALTER TABLE `borp`
  ADD PRIMARY KEY (`bo_id`);

--
-- Indexes for table `cbra`
--
ALTER TABLE `cbra`
  ADD PRIMARY KEY (`cb_id`);

--
-- Indexes for table `crhd`
--
ALTER TABLE `crhd`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `crln`
--
ALTER TABLE `crln`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `cthd`
--
ALTER TABLE `cthd`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `ctln`
--
ALTER TABLE `ctln`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `culd`
--
ALTER TABLE `culd`
  ADD PRIMARY KEY (`ld_id`);

--
-- Indexes for table `cumf`
--
ALTER TABLE `cumf`
  ADD UNIQUE KEY `cu_dbid_2` (`cu_dbid`),
  ADD KEY `cu_dbid` (`cu_dbid`);

--
-- Indexes for table `cupr`
--
ALTER TABLE `cupr`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `cutp`
--
ALTER TABLE `cutp`
  ADD PRIMARY KEY (`tp_id`);

--
-- Indexes for table `cutr`
--
ALTER TABLE `cutr`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `eshd`
--
ALTER TABLE `eshd`
  ADD PRIMARY KEY (`es_id`);

--
-- Indexes for table `esln`
--
ALTER TABLE `esln`
  ADD PRIMARY KEY (`el_id`);

--
-- Indexes for table `estp`
--
ALTER TABLE `estp`
  ADD PRIMARY KEY (`et_id`);

--
-- Indexes for table `gnmf`
--
ALTER TABLE `gnmf`
  ADD PRIMARY KEY (`gn_id`);

--
-- Indexes for table `hlst`
--
ALTER TABLE `hlst`
  ADD PRIMARY KEY (`hl_id`);

--
-- Indexes for table `imic`
--
ALTER TABLE `imic`
  ADD PRIMARY KEY (`ic_id`);

--
-- Indexes for table `imlc`
--
ALTER TABLE `imlc`
  ADD PRIMARY KEY (`lc_id`);

--
-- Indexes for table `immf`
--
ALTER TABLE `immf`
  ADD PRIMARY KEY (`im_id`);

--
-- Indexes for table `immv`
--
ALTER TABLE `immv`
  ADD PRIMARY KEY (`mv_id`);

--
-- Indexes for table `impc`
--
ALTER TABLE `impc`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `imsc`
--
ALTER TABLE `imsc`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `imwh`
--
ALTER TABLE `imwh`
  ADD PRIMARY KEY (`wh_id`);

--
-- Indexes for table `invh`
--
ALTER TABLE `invh`
  ADD PRIMARY KEY (`vh_id`);

--
-- Indexes for table `invl`
--
ALTER TABLE `invl`
  ADD PRIMARY KEY (`vl_id`);

--
-- Indexes for table `iuom`
--
ALTER TABLE `iuom`
  ADD PRIMARY KEY (`um_id`);

--
-- Indexes for table `menb`
--
ALTER TABLE `menb`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`mn_id`);

--
-- Indexes for table `modl`
--
ALTER TABLE `modl`
  ADD PRIMARY KEY (`md_id`);

--
-- Indexes for table `oedp`
--
ALTER TABLE `oedp`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `oesc`
--
ALTER TABLE `oesc`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `orhd`
--
ALTER TABLE `orhd`
  ADD PRIMARY KEY (`oh_hdid`);

--
-- Indexes for table `orln`
--
ALTER TABLE `orln`
  ADD PRIMARY KEY (`ln_id`);

--
-- Indexes for table `podp`
--
ALTER TABLE `podp`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `pofr`
--
ALTER TABLE `pofr`
  ADD PRIMARY KEY (`fr_id`);

--
-- Indexes for table `pohd`
--
ALTER TABLE `pohd`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `poln`
--
ALTER TABLE `poln`
  ADD PRIMARY KEY (`ln_id`);

--
-- Indexes for table `posr`
--
ALTER TABLE `posr`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `potr`
--
ALTER TABLE `potr`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `prcs`
--
ALTER TABLE `prcs`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `prhd`
--
ALTER TABLE `prhd`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `priv`
--
ALTER TABLE `priv`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `prln`
--
ALTER TABLE `prln`
  ADD PRIMARY KEY (`pl_id`);

--
-- Indexes for table `prsc`
--
ALTER TABLE `prsc`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `sacd`
--
ALTER TABLE `sacd`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `sdhd`
--
ALTER TABLE `sdhd`
  ADD PRIMARY KEY (`sd_id`);

--
-- Indexes for table `sdln`
--
ALTER TABLE `sdln`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `secm`
--
ALTER TABLE `secm`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `spcs`
--
ALTER TABLE `spcs`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `sphd`
--
ALTER TABLE `sphd`
  ADD PRIMARY KEY (`hd_id`);

--
-- Indexes for table `spln`
--
ALTER TABLE `spln`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `spmf`
--
ALTER TABLE `spmf`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `srmf`
--
ALTER TABLE `srmf`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `stat`
--
ALTER TABLE `stat`
  ADD PRIMARY KEY (`stt_id`);

--
-- Indexes for table `sthd`
--
ALTER TABLE `sthd`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `stln`
--
ALTER TABLE `stln`
  ADD PRIMARY KEY (`ln_id`);

--
-- Indexes for table `stmf`
--
ALTER TABLE `stmf`
  ADD PRIMARY KEY (`stdb_id`);

--
-- Indexes for table `sumf`
--
ALTER TABLE `sumf`
  ADD PRIMARY KEY (`su_code`);

--
-- Indexes for table `usmf`
--
ALTER TABLE `usmf`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arbl`
--
ALTER TABLE `arbl`
  MODIFY `bl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ardc`
--
ALTER TABLE `ardc`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `arsc`
--
ALTER TABLE `arsc`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bdmf`
--
ALTER TABLE `bdmf`
  MODIFY `bd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `bg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `borp`
--
ALTER TABLE `borp`
  MODIFY `bo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbra`
--
ALTER TABLE `cbra`
  MODIFY `cb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crhd`
--
ALTER TABLE `crhd`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crln`
--
ALTER TABLE `crln`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cthd`
--
ALTER TABLE `cthd`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ctln`
--
ALTER TABLE `ctln`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `culd`
--
ALTER TABLE `culd`
  MODIFY `ld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cumf`
--
ALTER TABLE `cumf`
  MODIFY `cu_dbid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cupr`
--
ALTER TABLE `cupr`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cutp`
--
ALTER TABLE `cutp`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cutr`
--
ALTER TABLE `cutr`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `eshd`
--
ALTER TABLE `eshd`
  MODIFY `es_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `esln`
--
ALTER TABLE `esln`
  MODIFY `el_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estp`
--
ALTER TABLE `estp`
  MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gnmf`
--
ALTER TABLE `gnmf`
  MODIFY `gn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hlst`
--
ALTER TABLE `hlst`
  MODIFY `hl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `imic`
--
ALTER TABLE `imic`
  MODIFY `ic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `imlc`
--
ALTER TABLE `imlc`
  MODIFY `lc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immf`
--
ALTER TABLE `immf`
  MODIFY `im_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `immv`
--
ALTER TABLE `immv`
  MODIFY `mv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `impc`
--
ALTER TABLE `impc`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imsc`
--
ALTER TABLE `imsc`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imwh`
--
ALTER TABLE `imwh`
  MODIFY `wh_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invh`
--
ALTER TABLE `invh`
  MODIFY `vh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invl`
--
ALTER TABLE `invl`
  MODIFY `vl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iuom`
--
ALTER TABLE `iuom`
  MODIFY `um_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menb`
--
ALTER TABLE `menb`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `mn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `modl`
--
ALTER TABLE `modl`
  MODIFY `md_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oedp`
--
ALTER TABLE `oedp`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oesc`
--
ALTER TABLE `oesc`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orhd`
--
ALTER TABLE `orhd`
  MODIFY `oh_hdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orln`
--
ALTER TABLE `orln`
  MODIFY `ln_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `podp`
--
ALTER TABLE `podp`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pofr`
--
ALTER TABLE `pofr`
  MODIFY `fr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pohd`
--
ALTER TABLE `pohd`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poln`
--
ALTER TABLE `poln`
  MODIFY `ln_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posr`
--
ALTER TABLE `posr`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `potr`
--
ALTER TABLE `potr`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prcs`
--
ALTER TABLE `prcs`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prhd`
--
ALTER TABLE `prhd`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priv`
--
ALTER TABLE `priv`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prln`
--
ALTER TABLE `prln`
  MODIFY `pl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prsc`
--
ALTER TABLE `prsc`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `sacd`
--
ALTER TABLE `sacd`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sdhd`
--
ALTER TABLE `sdhd`
  MODIFY `sd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sdln`
--
ALTER TABLE `sdln`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secm`
--
ALTER TABLE `secm`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spcs`
--
ALTER TABLE `spcs`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sphd`
--
ALTER TABLE `sphd`
  MODIFY `hd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spln`
--
ALTER TABLE `spln`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spmf`
--
ALTER TABLE `spmf`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `srmf`
--
ALTER TABLE `srmf`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stat`
--
ALTER TABLE `stat`
  MODIFY `stt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sthd`
--
ALTER TABLE `sthd`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stln`
--
ALTER TABLE `stln`
  MODIFY `ln_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stmf`
--
ALTER TABLE `stmf`
  MODIFY `stdb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sumf`
--
ALTER TABLE `sumf`
  MODIFY `su_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `usmf`
--
ALTER TABLE `usmf`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
