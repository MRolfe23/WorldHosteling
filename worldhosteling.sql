-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2018 at 12:15 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worldhosteling`
--

-- --------------------------------------------------------

--
-- Table structure for table `acct`
--

CREATE TABLE `acct` (
  `ACCT_ID` int(11) NOT NULL,
  `ACCT_fname` varchar(50) NOT NULL,
  `ACCT_lname` varchar(80) NOT NULL,
  `ACCT_email` varchar(320) NOT NULL,
  `ACCT_pass` varchar(255) NOT NULL,
  `ACCT_profile` varchar(100) DEFAULT NULL,
  `ACCT_background` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acct`
--

INSERT INTO `acct` (`ACCT_ID`, `ACCT_fname`, `ACCT_lname`, `ACCT_email`, `ACCT_pass`, `ACCT_profile`, `ACCT_background`) VALUES
(1, 'Michael', 'Rolfe', 'michael.rolfe23@gmail.com', '$2a$07$YourSaltIsA22ChrStrinejsyhiqK/NRJZLi.CV8edZpy3VajzPJq', 'zipR.jpg', 'DDAA9565-467E-4154-B41E-92ECB25621B8.jpeg'),
(2, 'Judy', 'Admin', 'admin@gmail.com', '$2a$07$YourSaltIsA22ChrStrineMyo2WS3FYi.FNzE6VKh2qJmEF9epHaO', 'my-girl.jpg', 'pexels-photo-mountain.jpeg'),
(3, 'Kristin', 'Skrove ', 'kristinrolfe@gmail.com', '$2a$07$YourSaltIsA22ChrStrineSzrxuLCePUsGiAzrkNMTSV37Cr2Qw4q', 'icons8-customer-filled-52.png', NULL),
(4, 'Carmin', 'Caspera', '009846@mtka.com', '$2a$07$YourSaltIsA22ChrStrineU8cRuAsa1MHcUK0.Y4zQYnN5LruiCoe', 'icons8-customer-filled-52.png', NULL),
(5, 'Kelly', 'Rolfe', 'rolfe_kelly@yahoo.com', '$2a$07$YourSaltIsA22ChrStrine7A1t12aLrqMxu9.wl1.QqwBg62SyYLO', 'icons8-customer-filled-52.png', NULL),
(6, 'test', 'signup', 'test@signup.com', '$2a$07$YourSaltIsA22ChrStrine4kZKo9usvAuITMUox4hw36CBTfhYTZC', 'icons8-customer-filled-52.png', NULL),
(7, 'Chris', 'Fulton', 'cfulton@dunwoody.edu', '$2a$07$YourSaltIsA22ChrStrineopPdPQvWqfROCRzHHrVU7V65MbG9kf6', 'icons8-customer-filled-52.png', NULL),
(8, 'Paula', 'Merns', 'pmerns@dunwoody.edu', '$2a$07$YourSaltIsA22ChrStrinegnNoxVsTScpaNFj62cX6xpZTDSpDUXu', 'icons8-customer-filled-52.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acct_friend`
--

CREATE TABLE `acct_friend` (
  `ACCT_ID` int(11) NOT NULL,
  `ACCT_FRIEND_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acct_friend`
--

INSERT INTO `acct_friend` (`ACCT_ID`, `ACCT_FRIEND_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(2, 5),
(3, 1),
(3, 5),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(6, 6),
(7, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `acct_hostel`
--

CREATE TABLE `acct_hostel` (
  `ACCT_HOSTEL_ID` int(11) NOT NULL,
  `HOSTEL_ID` int(11) NOT NULL,
  `ACCT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acct_hostel`
--

INSERT INTO `acct_hostel` (`ACCT_HOSTEL_ID`, `HOSTEL_ID`, `ACCT_ID`) VALUES
(9, 2, 1),
(8, 3, 1),
(13, 3, 7),
(15, 4, 1),
(4, 5, 2),
(14, 5, 1),
(6, 6, 1),
(5, 7, 2),
(12, 7, 1),
(2, 8, 2),
(7, 8, 1),
(1, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `COMMENT_ID` int(11) NOT NULL,
  `COMMENT_comment` varchar(1000) DEFAULT NULL,
  `COMMENT_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `POST_ID` int(11) NOT NULL,
  `ACCT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`COMMENT_ID`, `COMMENT_comment`, `COMMENT_date`, `POST_ID`, `ACCT_ID`) VALUES
(1, 'helloooooo', '2018-12-17 03:13:32', 5, 2),
(2, 'Sorry! trying to fix this thing! hello :)', '2018-12-17 03:42:23', 5, 1),
(3, 'Hello Judy!', '2018-12-17 04:05:36', 6, 1),
(4, 'Gita', '2018-12-17 04:20:36', 9, 3),
(5, 'I mean, heya! lol ', '2018-12-17 04:20:50', 9, 3),
(6, 'Where to travel to next?!', '2018-12-17 04:21:06', 9, 3),
(7, 'May I suggest the Rustic Bug ðŸ˜', '2018-12-17 04:23:29', 9, 1),
(8, 'test2', '2018-12-18 21:44:17', 12, 1),
(9, 'hello =]', '2018-12-19 07:53:07', 7, 1),
(10, 'Comment back!!!', '2018-12-20 16:50:27', 14, 1),
(11, 'hey!', '2018-12-20 16:51:01', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `HOSTEL_ID` int(11) NOT NULL,
  `HOSTEL_name` varchar(100) NOT NULL,
  `HOSTEL_state` varchar(50) DEFAULT NULL,
  `HOSTEL_city` varchar(50) NOT NULL,
  `HOSTEL_price` decimal(5,2) NOT NULL,
  `HOSTEL_description` varchar(5000) DEFAULT NULL,
  `HOSTEL_rating` decimal(2,1) DEFAULT NULL,
  `HOSTEL_latitude` decimal(10,8) DEFAULT NULL,
  `HOSTEL_longitude` decimal(11,8) DEFAULT NULL,
  `HOSTEL_pic1` varchar(100) DEFAULT NULL,
  `HOSTEL_pic2` varchar(100) DEFAULT NULL,
  `HOSTEL_pic3` varchar(100) DEFAULT NULL,
  `HOSTEL_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`HOSTEL_ID`, `HOSTEL_name`, `HOSTEL_state`, `HOSTEL_city`, `HOSTEL_price`, `HOSTEL_description`, `HOSTEL_rating`, `HOSTEL_latitude`, `HOSTEL_longitude`, `HOSTEL_pic1`, `HOSTEL_pic2`, `HOSTEL_pic3`, `HOSTEL_url`) VALUES
(1, 'test', 'California', 'Miami', '29.99', 'testing', '5.0', '42.33500000', '-80.12440000', 'generatorMiami.jpg', NULL, NULL, 'www.google.com'),
(2, 'Rustic Bug', 'California', 'Midpines', '21.60', 'Located right next to Yosemite national park. Great grounds for hiking with a well priced dinner and a soothing spa. Accommodations include: Tents, dorms, and full cabins.', '5.0', '37.57460000', '-119.95130000', 'yosemite-bug-rustic-mountain.jpg', 'yosemite-bug-rustic-mountain.jpg', 'yosemite-bug-rustic-mountain.jpg', 'https://yosemitebug.com/'),
(3, 'New York Hostel', 'New York', 'New York', '33.00', 'Located in the most perfect location in New York City! We have all the amenities that you could want and activities to go with it. Explore the city and we have a very cheap but incredibly luxurious bar when you return or to start the night out!', '4.9', '40.71280000', '74.00600000', 'NY-hi-nyc-gallery-01.jpg', 'NY-hi-nyc-gallery-01.jpg', 'NY-hi-nyc-gallery-01.jpg', 'https://www.hiusa.org/hostels/new-york/new-york/new-york-city'),
(4, 'SPENARD HOSTEL INTERNATIONAL', 'Alaska', 'Anchorage', '25.00', 'In addition to our dormitory and camping accommodations, Spenard Hostel has a large yard with a barbecue and plenty of lawn furniture to enjoy during the long sunny days.\r\n\r\nWe have plenty of space to spread out, including 3 fully-stocked kitchens, 3 common areas (one for conversation, a library for book exchange and using computers, and a TV room) and 4 private, home-style bathrooms.\r\n\r\nWe are happy to offer bike rentals to help you further explore the city\'s extensive, paved, bike paths. Our coin operated laundry includes free detergent. We provide free high-speed WI-FI and have a pay kiosk computer available.\r\n\r\nFree lockers (space available) are available to our guests, as well as inexpensive long-term storage if you need to leave some things behind while exploring Alaska.\r\n\r\nWe also offer a bear spray and camp fuel exchange. You can\'t take it with you so you may as well help out a fellow traveler! And we host what one guest called \'the best free-bin in the state of Alaska.\'', '4.0', '61.18250000', '-149.93900000', 'spenardHostel.jpg', 'spenardHostel.jpg', 'spenardHostel.jpg', 'http://www.alaskahostel.org/'),
(5, '9TH AVE HOSTEL', 'Alaska', 'Fairbanks', '27.78', 'Located only few blocks from heart of downtown Fairbanks, 9th Ave Hostel provides a perfect base for sightseeing and adventure.\r\nEnjoy our entertaining area, see night sky with the telescope, and have pleasant night in comfy bed.\r\n\r\nAbout our facilities:\r\n4 bunk bed mixed dorm \r\n4 bunk bed female/mixed dorm\r\n(Note: Rooms may be co-ed especially during the summer.)\r\n\r\nEntertaining room with satellite TV and a public PC.\r\nSitting area with game table\r\nSun room with chat set\r\nPatio deck and back yard\r\nFully equipped kitchen\r\nFree WiFi\r\nFree bicycle rental(When available)\r\nFree storage(contact us for oversize item storage)\r\nFree coffee&tea\r\nFree linens\r\nFree local phone\r\nFree DVD and Blu-ray watching\r\nTent space available(contact us for detail)\r\nGarage space available for motorcycle parking\r\nNo curfew\r\n\r\n\r\n\r\nPlease note:\r\nGuests must inform the hostel for late check in after 9:00pm\r\nCancellation policy: 72h advance notice\r\nLate cancellation or noshow- one night charge\r\nPayment upon arrival', '4.3', '64.84120000', '-147.73500000', '9aveHostel.jpg', '9aveHostel.jpg', '9aveHostel.jpg', 'http://www.9thavehostel.com/'),
(6, 'HOSTEL DETROIT', 'Michigan', 'Detroit', '34.80', 'Hostel Detroit is an educational non-profit that believes that experiential travel is the best way to learn and experience the City of Detroit. It is a social space. Expect to make friends! We are located in a bright and vibrant 100-year-old building in a neighborhood that is full of urban farms and innovative projects. Easy transit- located 2 blocks from the $2 FAST Michigan airport bus line at Rosa Parks St. and Michigan Ave. and 10 minutes walk from the Greyhound bus station.\r\n\r\nWe want to connect visitors to Detroit with the people and places that make our city great. We seek to provide context in an often misunderstood city. Our goal is to teach each of our visitors about the history and evolving future of our city. We want our guests to leave Detroit with the perspective of someone who has experienced it first-hand and was able to interact at a hyper-local level. We want them to eat from our urban farms, cycle our streets, enjoy the cities thriving small business community', '4.5', '42.33500000', '-83.07530000', 'detroitHostel.jpg', 'detroitHostel.jpg', 'detroitHostel.jpg', 'https://www.hosteldetroit.com/'),
(7, 'SAVANNAH PENSIONE', '', 'Savannah', '33.00', 'Welcome to Savannah, where the past comes alive. A city that was spared in the Civil War that is now the largest historic district in North America. \r\n\r\nThe Pensione is located inside the Historic District in a large Victorian home that features 12 foot ceilings, several balconies and a courtyard inside the historic district two blocks from beautiful Forsyth park, walking distance to all the squares, City Market, and River Street. \r\n\r\nA short drive away are three Forts that played a key role in protecting Savannah, Tybee Island with her beautiful sand beaches, and marshland all around sporting wildlife.\r\nThe Pensione is open all year.\r\n\r\nPlease note we only have private rooms and group rooms for 3 or more (know each other). \r\n\r\nPlease note:\r\nCheck in between 07.00-10.00 and 17.00-23.00\r\nCheck out before 11.00\r\nCancellation policy: 48h advance notice\r\nTax included\r\nBreakfast Not Included\r\nPayment upon arrival by cash or credit cards', '3.7', '32.07617600', '-81.08837100', 'savannahp.jpg', 'savannahp.jpg', 'savannahp.jpg', 'http://savannahpensione.com/'),
(8, 'GENERATOR MIAMI', 'Florida', 'Miami', '21.60', 'Rich in heritage dating back to the 1940’s the new Generator Miami location was previously home to the Atlantic Princess Condominium. Generator Miami and its 8-level property lies in the ever-bustling heart of Miami’s famous South Beach district, located at 3120 Collins Avenue, just steps away from the iconic Miami Beach front.\r\nThis once old building has been completely transformed into Miami’s latest trending social hub, complete with elegant designs, bustling social spaces, swimming pool, designer bars and incredible outdoor and indoor restaurant.\r\n\r\nBeing in the perfect location for anyone who wants to live the Miami vibe for their Miami get-away, the Generator Miami location is surrounded by incredible cityscape views of Downtime Miami and amazing panoramic views of both the Atlantic Ocean and the fascinating Miami Beach Canals.\r\n\r\nWith 103 rooms housing 344 guests the atmosphere is always buzzing, the vibe is always strong, and the experiences to be had are like no other.', '4.6', '25.80710000', '-80.12440000', 'generatorMiami.jpg', 'generatorMiami.jpg', 'generatorMiami.jpg', 'https://generatorhostels.com/destinations/miami?utm_source=google-my-business&utm_medium=organic&utm_campaign=hostel-miami'),
(9, 'THE NORTHSHORE HOSTEL MAUI', 'Hawaii', 'Wailuku', '26.22', 'Aloha & E Komo Mai - We Welcome You! Free Airport, Beach & Iao Valley Shuttle*, Free Breakfast, Free \r\n\r\nInternational Phone. The Northshore Hostel - Book Today & Enjoy Paradise Tomorrow at Maui\'s best hostel! We \r\n\r\nare happy to share our friendly Aloha spirit and the natural beauty of our Tropical island! We hope to \r\n\r\nwelcome you soon.\r\n\r\nOur private rooms are clean and comfortable as are the dormitories. Our restrooms are also newly renovated \r\n\r\nand we keep them exceptionally clean. Our hostel is a very friendly, comfortable accommodation. You will \r\n\r\nlove your stay with us and the new friends you will meet here.\r\n\r\nCome enjoy this tropical paradise and the friendly environment at the NorthShore Hostel. We are the best \r\n\r\nbudget accommodation on Maui and working hard to provide you the best stay possible. We hope to see you \r\n\r\nsoon in paradise! \r\nMixed dormitory is for couples only!\r\n\r\nRemember the door code! \r\nIt will be in your confirmation email sent from the hostel. Thank you!', '4.3', '20.88910000', '-156.50350000', 'northshoremaui.jpg', 'northshoremaui.jpg', 'northshoremaui.jpg', 'http://www.northshorehostel.com/');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `POST_ID` int(11) NOT NULL,
  `POST_comment` varchar(1000) DEFAULT NULL,
  `POST_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ACCT_ID` int(11) NOT NULL,
  `postTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`POST_ID`, `POST_comment`, `POST_date`, `ACCT_ID`, `postTO`) VALUES
(4, 'Hey!', '2018-12-17 02:59:46', 2, 1),
(5, 'hello', '2018-12-17 03:09:51', 2, 1),
(6, 'hello worldhosteling!', '2018-12-17 03:15:59', 2, 2),
(7, 'hello', '2018-12-17 03:18:25', 2, 2),
(8, 'O what a great day to make your own hostel search site and social media platform', '2018-12-17 03:31:48', 1, 1),
(9, 'Hey!!', '2018-12-17 04:19:02', 1, 3),
(10, 'Hey Carmin!!! ðŸ˜ðŸ˜ðŸ˜ðŸ˜', '2018-12-17 07:55:01', 1, 4),
(11, 'Eyyyy!', '2018-12-17 15:03:41', 1, 5),
(12, 'test', '2018-12-18 21:44:10', 1, 1),
(13, 'hello', '2018-12-18 22:00:56', 6, 6),
(14, 'Hey Kristin!', '2018-12-20 16:50:16', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acct`
--
ALTER TABLE `acct`
  ADD PRIMARY KEY (`ACCT_ID`);

--
-- Indexes for table `acct_friend`
--
ALTER TABLE `acct_friend`
  ADD PRIMARY KEY (`ACCT_ID`,`ACCT_FRIEND_ID`),
  ADD KEY `fk_ACCT_has_ACCT_FRIEND_ACCT1_idx` (`ACCT_ID`);

--
-- Indexes for table `acct_hostel`
--
ALTER TABLE `acct_hostel`
  ADD PRIMARY KEY (`ACCT_HOSTEL_ID`,`HOSTEL_ID`,`ACCT_ID`),
  ADD KEY `fk_ACCT_HOSTEL_HOSTEL1_idx` (`HOSTEL_ID`),
  ADD KEY `fk_ACCT_HOSTEL_ACCT1_idx` (`ACCT_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`COMMENT_ID`,`POST_ID`,`ACCT_ID`),
  ADD KEY `fk_COMMENT_POST_idx` (`POST_ID`),
  ADD KEY `fk_COMMENT_ACCT1_idx` (`ACCT_ID`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`HOSTEL_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`POST_ID`,`ACCT_ID`),
  ADD KEY `fk_POST_ACCT1_idx` (`ACCT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acct`
--
ALTER TABLE `acct`
  MODIFY `ACCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `acct_hostel`
--
ALTER TABLE `acct_hostel`
  MODIFY `ACCT_HOSTEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `COMMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `HOSTEL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `POST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acct_friend`
--
ALTER TABLE `acct_friend`
  ADD CONSTRAINT `fk_ACCT_has_ACCT_FRIEND_ACCT1` FOREIGN KEY (`ACCT_ID`) REFERENCES `acct` (`ACCT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `acct_hostel`
--
ALTER TABLE `acct_hostel`
  ADD CONSTRAINT `fk_ACCT_HOSTEL_ACCT1` FOREIGN KEY (`ACCT_ID`) REFERENCES `acct` (`ACCT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ACCT_HOSTEL_HOSTEL1` FOREIGN KEY (`HOSTEL_ID`) REFERENCES `hostel` (`HOSTEL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_COMMENT_ACCT1` FOREIGN KEY (`ACCT_ID`) REFERENCES `acct` (`ACCT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMMENT_POST` FOREIGN KEY (`POST_ID`) REFERENCES `post` (`POST_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_POST_ACCT1` FOREIGN KEY (`ACCT_ID`) REFERENCES `acct` (`ACCT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
