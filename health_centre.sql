-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2015 at 10:19 AM
-- Server version: 5.5.41
-- PHP Version: 5.4.36-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `health_centre`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE IF NOT EXISTS `consultation` (
  `PatientId` varchar(11) NOT NULL,
  `Dependent` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Cause` varchar(255) NOT NULL,
  `MedicineName` varchar(255) NOT NULL,
  `Timings` varchar(25) NOT NULL,
  `NoOfDays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`PatientId`, `Dependent`, `Date`, `Cause`, `MedicineName`, `Timings`, `NoOfDays`) VALUES
('b120381cs', 'mom', '2015-05-01', 'fever', 'paracetamol', '1-0-1', 10),
('b120381cs', 'mom', '2015-05-01', 'fever', 'deuterox-591', '1-1-1', 2),
('b120381cs', '', '2015-05-01', 'vomiting', 'haley-11', '3-3-0', 12),
('b120806cs', '', '2015-05-01', 'dry skin', 'nivea', '0-0-1', 100),
('b120806cs', '', '2015-05-01', 'tooth ache', 'pain killer', '1-1-1', 3),
('b120806cs', '', '2015-05-01', 'tooth ache', 'deuterox-591', '9-9-9', 20),
('b120806cs', '', '2015-05-01', 'tooth ache', 'deuterox-591', '9-9-9', 10),
('b120806cs', '', '2015-05-01', 'fever', 'paracetamol', '1-1-1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Medical_Certificate`
--

CREATE TABLE IF NOT EXISTS `Medical_Certificate` (
  `CftNo` int(15) NOT NULL,
  `IssueDate` date NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PatientType` varchar(255) NOT NULL DEFAULT 'Student',
  `RollNo` varchar(255) NOT NULL,
  `Dependent` varchar(255) NOT NULL,
  `FromDate` date NOT NULL,
  `NoOfDays` int(4) NOT NULL,
  `Cause` varchar(1000) NOT NULL,
  `Doctor` varchar(255) NOT NULL,
  PRIMARY KEY (`CftNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Medical_Certificate`
--

INSERT INTO `Medical_Certificate` (`CftNo`, `IssueDate`, `Name`, `PatientType`, `RollNo`, `Dependent`, `FromDate`, `NoOfDays`, `Cause`, `Doctor`) VALUES
(1, '2015-05-05', 'asif muhammad', 'student', 'b120381cs', '', '2015-05-05', 10, 'vomiting', 'dr. sankar'),
(2, '2015-04-27', 'asif muhammad', 'student', 'b120381cs', 'mom', '2015-05-14', 2, 'fever', 'dr. akbar'),
(3, '2015-05-05', 'Vishal Peter', 'student', 'b120806cs', '', '2015-05-05', 23, 'yyy', 'dr.akbar'),
(4, '2015-05-01', 'Vishal Peter', 'Student', 'B120806CS', 'Asif Muhammad', '2015-05-01', 2, 'Cough', 'AA Celine'),
(5, '2015-05-05', 'Abhijith K A', 'Student', 'B120771CS', '', '2015-05-01', 20, 'Viral Fever', 'AA Celine'),
(6, '2015-04-28', 'b', 'Student', '1234', 'b', '2015-05-02', 20, 'Cancer', 'Shiva Sundar'),
(7, '2015-05-12', 'b', 'Faculty', '1234', 'b', '2015-05-02', 2, 'Whooping Cough', 'Sankar Lal');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_stock`
--

CREATE TABLE IF NOT EXISTS `medicine_stock` (
  `Date` date NOT NULL,
  `BillNo` varchar(255) NOT NULL,
  `RecievedFrom` varchar(255) NOT NULL,
  `MedicineName` varchar(255) NOT NULL,
  `BatchNo` varchar(255) NOT NULL,
  `Expiry` date NOT NULL,
  `Qty` int(11) NOT NULL,
  `Cost` float NOT NULL,
  PRIMARY KEY (`MedicineName`,`BatchNo`),
  KEY `Medicine Name` (`MedicineName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_stock`
--

INSERT INTO `medicine_stock` (`Date`, `BillNo`, `RecievedFrom`, `MedicineName`, `BatchNo`, `Expiry`, `Qty`, `Cost`) VALUES
('2015-04-30', 'a', 'a', 'a', 'a', '2015-04-30', 1890, 3978.95),
('2015-05-01', '44444', 'Essar ec', 'gggg', 'b234', '2015-05-21', 15, 750),
('2015-04-09', 'jh', 'kjh', 'kjh', 'kjh', '2021-04-14', 80, 80),
('2015-05-06', '1212', 'm10', 'medicine1', '11', '2015-05-12', 2, 12),
('2015-05-02', '1233', 'NITC', 'paracetamol', 'b12', '2015-05-06', 50, 500);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`) VALUES
('admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `Patient_Id` varchar(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Dependent` varchar(255) NOT NULL DEFAULT '',
  `Sex` varchar(255) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Ph.No` varchar(255) DEFAULT NULL,
  `Alt.Ph.No` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `PermanentAddress` text,
  `LocalAddress` text,
  PRIMARY KEY (`Patient_Id`,`Name`,`Dependent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`Patient_Id`, `Name`, `Dependent`, `Sex`, `Age`, `Ph.No`, `Alt.Ph.No`, `DOB`, `PermanentAddress`, `LocalAddress`) VALUES
('1111', 'san', '', 'Male', 20, '', '', '2015-05-05', '', ''),
('123', 'a', 'a', 'Male', 0, '', '', '1999-01-01', '', ''),
('123', 'a', 'aa', 'Male', 0, '', '', '1979-01-01', 'putty', 'putty'),
('12333333', 'jujuju', '', 'Male', 0, '', '', '1970-01-01', '', ''),
('1234', 'b', '', 'Male', 0, '', '', '1970-01-01', '', ''),
('1234', 'b', 'b', 'Male', 0, '', '', '2015-05-05', '', ''),
('1234', 'b', 'bb', 'Male', 0, '', '', '2022-05-24', '', ''),
('133', 'anjal', '', 'Male', 20, '', '', '2001-05-01', '', ''),
('B120301CS', 'Akshay J Nambiar', '', 'Male', 20, '8547045231', '', '1995-02-21', 'c-228', 'c-228'),
('b120381cs', 'asif muhammad', '', 'Male', 19, '5678', '6789', '2015-01-10', 'dufai', 'dubai'),
('b120381cs', 'asif muhammad', 'mom', 'Male', 50, '111122', '222233', '1979-05-14', 'duf', 'dufff'),
('b120771cs', 'Abhijith K A', '', 'Male', 20, '', '', '1994-07-27', 'Cheruvila h', 'cheruvila veedu'),
('B120806cs', 'Vishal Peter', '', 'Male', 20, '000', '9887', '1994-08-27', 'myaliparampil House\r\nPoozhikol PO\r\nKaduthuruthy\r\nKottayam\r\nKerala', 'myaliparamp'),
('b120877cs', 'arpit', '', 'Male', 20, '', '', '2015-05-05', 'iuvbuivbou', 'iuvbuivbou'),
('b120999cs', 'francis', '', 'Male', 0, '655', 'uuhfjhfjf', '2015-05-07', 'gjgjgjgj', 'gjgjgjgj');

-- --------------------------------------------------------

--
-- Table structure for table `Remarks`
--

CREATE TABLE IF NOT EXISTS `Remarks` (
  `Date` date NOT NULL,
  `Pat_Id` varchar(64) NOT NULL,
  `Dep_Name` varchar(256) NOT NULL,
  `Remark` varchar(1024) NOT NULL,
  `Entered_By` varchar(255) NOT NULL,
  KEY `Date` (`Date`,`Pat_Id`,`Dep_Name`,`Remark`(767))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Remarks`
--

INSERT INTO `Remarks` (`Date`, `Pat_Id`, `Dep_Name`, `Remark`, `Entered_By`) VALUES
('2015-05-01', 'b120381cs', '', ' Patient is allergic to Vomiting', ''),
('2015-05-01', 'b120381cs', 'mom', ' Allergic to PEanuTs!!', ''),
('2015-05-01', 'b120806cs', '', ' too many allergies', ''),
('2015-05-01', 'b120301cs', '', ' Akshay has issues!!', ''),
('2015-05-01', 'b120806cs', '', ' allergy!!!', ''),
('2015-05-08', 'b120771cs', '', ' X-ray report : 2aex', 'lab (labadmin) ');

-- --------------------------------------------------------

--
-- Table structure for table `temp_consultation`
--

CREATE TABLE IF NOT EXISTS `temp_consultation` (
  `PatientId` varchar(11) NOT NULL,
  `Dependent` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Cause` varchar(255) NOT NULL,
  `MedicineName` varchar(255) NOT NULL,
  `Timings` varchar(25) NOT NULL,
  `NoOfDays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Temp_Medical_Certificate`
--

CREATE TABLE IF NOT EXISTS `Temp_Medical_Certificate` (
  `CftNo` int(15) NOT NULL,
  `IssueDate` date NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PatientType` varchar(255) NOT NULL DEFAULT 'Student',
  `RollNo` varchar(255) NOT NULL,
  `Dependent` varchar(255) NOT NULL,
  `FromDate` date NOT NULL,
  `NoOfDays` int(4) NOT NULL,
  `Cause` varchar(1000) NOT NULL,
  `Doctor` varchar(255) NOT NULL,
  PRIMARY KEY (`CftNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Temp_Medical_Certificate`
--

INSERT INTO `Temp_Medical_Certificate` (`CftNo`, `IssueDate`, `Name`, `PatientType`, `RollNo`, `Dependent`, `FromDate`, `NoOfDays`, `Cause`, `Doctor`) VALUES
(1, '2015-05-03', 'Abhijith K A', 'Student', 'b120771cs', '', '2015-05-03', 20, 'Cold', 'AA Celine');

-- --------------------------------------------------------

--
-- Table structure for table `temp_medicine_stock`
--

CREATE TABLE IF NOT EXISTS `temp_medicine_stock` (
  `Date` date NOT NULL,
  `BillNo` varchar(255) NOT NULL,
  `RecievedFrom` varchar(255) NOT NULL,
  `MedicineName` varchar(255) NOT NULL,
  `BatchNo` varchar(255) NOT NULL,
  `Expiry` date DEFAULT '3000-01-01',
  `Qty` int(11) NOT NULL,
  `Cost` float NOT NULL,
  PRIMARY KEY (`MedicineName`,`BatchNo`),
  KEY `Medicine Name` (`MedicineName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Transactions`
--

CREATE TABLE IF NOT EXISTS `Transactions` (
  `Type` varchar(30) NOT NULL DEFAULT 'Addition',
  `Transaction_Date` date NOT NULL,
  `Date` date NOT NULL,
  `BillNo` varchar(255) NOT NULL,
  `RecievedFrom` varchar(255) NOT NULL,
  `MedicineName` varchar(255) NOT NULL,
  `BatchNo` varchar(255) NOT NULL,
  `Expiry` date NOT NULL,
  `Qty` int(11) NOT NULL,
  `Cost` float NOT NULL,
  KEY `Medicine Name` (`MedicineName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Transactions`
--

INSERT INTO `Transactions` (`Type`, `Transaction_Date`, `Date`, `BillNo`, `RecievedFrom`, `MedicineName`, `BatchNo`, `Expiry`, `Qty`, `Cost`) VALUES
('Addition', '2015-04-30', '2015-04-30', 'io', 'io', 'io', 'io', '2015-04-30', 99, 99),
('Removal', '2015-04-30', '2015-04-30', 'jj', 'jjjj', 'jj', 'jj', '2015-04-30', 100, 0),
('Removal', '2015-04-30', '2015-04-30', 'io', 'io', 'io', 'io', '2015-04-30', 98, 0),
('Removal', '2015-04-30', '2015-04-30', 'io', 'io', 'io', 'io', '2015-04-30', 1, 0),
('Addition', '2015-04-30', '2015-04-30', 'a', 'a', 'a', 'a', '2015-04-30', 2000, 4000),
('Removal', '2015-04-30', '2015-04-30', 'a', 'a', 'a', 'a', '2015-04-30', 100, 0),
('Addition', '2015-04-30', '2015-04-09', 'kjh', 'kjh', 'kjh', 'kjh', '2021-04-14', 87, 87),
('Removal', '2015-04-30', '2015-04-30', 'a', 'a', 'a', 'a', '2015-04-30', 10, 21.0526),
('Addition', '2015-05-01', '2015-05-06', '11', 'm10', 'medicine1', '11', '2015-05-12', 2, 12),
('Addition', '2015-05-01', '2015-05-02', 'b12', 'NITC', 'paracetamol', 'b12', '2015-05-06', 100, 1000),
('Removal', '2015-05-01', '2015-05-02', 'b12', 'NITC', 'paracetamol', 'b12', '2015-05-06', 50, 500),
('Removal', '2015-05-01', '2015-04-09', 'kjh', 'kjh', 'kjh', 'kjh', '2021-04-14', 7, 7),
('Addition', '2015-05-01', '2015-05-01', 'b234', 'Essar ec', 'gggg', 'b234', '2015-05-21', 20, 1000),
('Removal', '2015-05-01', '2015-05-01', 'b234', 'Essar ec', 'gggg', 'b234', '2015-05-21', 5, 250);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Name` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `SecQn1` text NOT NULL,
  `Ans1` varchar(255) NOT NULL,
  `SecQn2` text NOT NULL,
  `Ans2` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL DEFAULT 'Doctor',
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `UserName`, `Password`, `SecQn1`, `Ans1`, `SecQn2`, `Ans2`, `Type`) VALUES
('Abraham Lincoln', 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
('ajn', 'ajn', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'abcd', '81fe8bfe87576c3ecb22426f8e57847382917acf', 'abcd', '81fe8bfe87576c3ecb22426f8e57847382917acf', 'Doctor'),
('anjal', 'anjal', '17ca20cfa601aec3e03f5c4d6e8aa042c97f7744', 'how are you?', '2a1b875b84fa7245c2d4dfa761170884db7b31d9', 'what are you?', 'd787f56b080945c1ec0b3343cbf962ca427bb8ef', 'Doctor'),
('anjalsan', 'anjal.saneen', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1+1', 'da4b9237bacccdf19c0760cab7aec4a8359010b0', '2+5', '902ba3cda1883801594b6e1b452790cc53948fda', 'Doctor'),
('doctor', 'doctor', '1f0160076c9f42a157f0a8f0dcc68e02ff69045b', 'doctor', '1f0160076c9f42a157f0a8f0dcc68e02ff69045b', 'doctor', '1f0160076c9f42a157f0a8f0dcc68e02ff69045b', 'Doctor'),
('lab', 'lab', '3953f9ddf975ab5097ee468d99555c5b441169bf', 'lab', '3953f9ddf975ab5097ee468d99555c5b441169bf', 'lab', '3953f9ddf975ab5097ee468d99555c5b441169bf', 'labadmin');

-- --------------------------------------------------------

--
-- Table structure for table `Yearly_Report`
--

CREATE TABLE IF NOT EXISTS `Yearly_Report` (
  `Year` int(4) NOT NULL AUTO_INCREMENT,
  `OpeningBal` float NOT NULL,
  `Purchase` float DEFAULT NULL,
  `Consumption` float DEFAULT NULL,
  `ClosingBal` float DEFAULT NULL,
  PRIMARY KEY (`Year`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2015 ;

--
-- Dumping data for table `Yearly_Report`
--

INSERT INTO `Yearly_Report` (`Year`, `OpeningBal`, `Purchase`, `Consumption`, `ClosingBal`) VALUES
(2013, 0, 0, 0, 0),
(2014, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
