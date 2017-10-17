-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `honeypot`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackid` int(15) NOT NULL,
  `userid` int(15) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageid` int(15) NOT NULL,
  `userid` int(15) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `photoid` int(15) NOT NULL,
  `path` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `profiel`
--

CREATE TABLE `profiel` (
  `userid` int(15) NOT NULL,
  `photoid` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `profielmessages`
--

CREATE TABLE `profielmessages` (
  `messageid` int(15) NOT NULL,
  `senderid` int(15) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profileid` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(15) NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photoid`);

--
-- Indexes for table `profiel`
--
ALTER TABLE `profiel`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `photoid` (`photoid`);

--
-- Indexes for table `profielmessages`
--
ALTER TABLE `profielmessages`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `profileid` (`profileid`),
  ADD KEY `senderid` (`senderid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `photoid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(15) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiel`
--
ALTER TABLE `profiel`
  ADD CONSTRAINT `profiel_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profiel_ibfk_2` FOREIGN KEY (`photoid`) REFERENCES `photo` (`photoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profielmessages`
--
ALTER TABLE `profielmessages`
  ADD CONSTRAINT `profielmessages_ibfk_1` FOREIGN KEY (`profileid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profielmessages_ibfk_2` FOREIGN KEY (`senderid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
