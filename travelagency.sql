-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 03:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelagency`
--

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `description` varchar(600) NOT NULL,
  `category` varchar(20) NOT NULL,
  `imageLink` varchar(400) NOT NULL,
  `kidsPrice` int(11) NOT NULL,
  `adultPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `city`, `description`, `category`, `imageLink`, `kidsPrice`, `adultPrice`) VALUES
(1, 'Ksamil', 'Ksamil is a picturesque coastal village in southern Albania, renowned for its crystal-clear waters and white sandy beaches. Located on the Albanian Riviera near the UNESCO World Heritage site of Butrint, it offers a perfect blend of historical intrigue and beachside relaxation. The village is especially popular in summer, attracting visitors with its charming islets easily accessible for swimming or boating.', 'sea', 'https://thetravelmum.com/content/uploads/2023/08/ksamil.webp', 60, 80),
(2, 'Vlora', 'Vlora is a vibrant coastal city in southwestern Albania, known for its historical significance and beautiful landscapes. It boasts a scenic coastline that stretches along the Adriatic and Ionian Seas, featuring popular beaches like Vlore Bay and the more secluded beaches around the Karaburun Peninsula. The city is also famous for its role in Albanian independence, housing the Independence Monument commemorating Albania\'s declaration from the Ottoman Empire in 1912.', 'sea', 'https://vloramarina.com/wp-content/uploads/2024/01/sadgg.jpg', 30, 60),
(3, 'Gjirokastra', 'Gjirokastra is a picturesque city in southern Albania, distinguished by its unique Ottoman-era architecture and steep, stone-paved streets. It is often referred to as the \"City of Stone\" due to its historic hillside houses covered with gray slate roofs. Gjirokastra is a UNESCO World Heritage site, celebrated for its well-preserved castle, bazaar, and old town, which offer a deep dive into Albania\'s rich history and cultural heritage.', 'historical', 'https://media.tacdn.com/media/attractions-splice-spp-674x446/07/87/2f/bc.jpg', 25, 40),
(4, 'Korabi', 'Korabi is Albania\'s highest mountain, towering at 2,764 meters above sea level, and part of the Korab mountain range which stretches between Albania and North Macedonia. This majestic peak is a popular destination for hikers and mountaineers, offering challenging climbs and breathtaking views of the surrounding landscape. The area around Mount Korabi is also known for its rich biodiversity and is a prime spot for nature lovers and outdoor enthusiasts seeking solitude and unspoiled natural beauty.', 'mountain', 'https://www.visitalbania.app/wp-content/uploads/2022/07/Korab-mountain-2.jpg', 35, 55),
(5, 'Valbona', 'Valbona is a stunning valley located in the northern Albanian Alps, known for its dramatic mountain landscapes and crystal-clear rivers. It is a popular destination for hikers and nature enthusiasts, offering a network of trails that wind through picturesque villages and alpine terrain. Valbona is part of the Valbona Valley National Park, which preserves a rich biodiversity and provides a tranquil escape into one of Albania’s most beautiful and remote natural areas.', 'mountain', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/a6/51/80/img-20190520-173608-673.jpg?w=1100&h=1100&s=1', 55, 75),
(6, 'Castle Of Kruja', 'The Castle of Kruja is a historic fortress located in the town of Kruja, Albania. Perched on a strategic hilltop, it dates back to the 5th and 6th centuries and is famed for its significant role in the resistance against the Ottoman Empire under the leadership of Albania\'s national hero, Skanderbeg, in the 15th century. Today, the castle is a major tourist attraction featuring a museum dedicated to Skanderbeg, traditional shops, and panoramic views of the surrounding landscape.', '', 'https://albaniatourguide.com/wp-content/uploads/2022/01/Kruje-2-Shutterstock-large-1.jpg', 30, 45),
(7, 'Saranda', 'Saranda is a charming coastal town in southern Albania, nestled on the shores of the Ionian Sea. Known for its stunning deep blue waters and vibrant nightlife, Saranda is a popular destination during the summer months, attracting visitors with its beautiful beaches and lively atmosphere. The town also serves as a gateway to the ancient ruins of Butrint, a UNESCO World Heritage site, and offers spectacular views across the sea to the nearby Greek island of Corfu.', 'sea', 'https://elitesrealtygroup.com/wp-content/uploads/2023/06/AdobeStock_443014771-1024x554.jpeg', 40, 65);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `adults` int(11) NOT NULL,
  `kids` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `place` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `surname`, `adults`, `kids`, `fromDate`, `toDate`, `totalPrice`, `place`, `email`) VALUES
(32, 'Ilian', 'Janopullo', 1, 1, '2024-05-15', '2024-05-17', 280, 'Ksamil', 'ijanopullo22@epoka.edu.al'),
(33, 'Ilian', 'Janopullo', 3, 0, '2024-06-19', '2024-06-20', 180, 'Vlora', 'ijanopullo22@epoka.edu.al');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `status`) VALUES
(1, 'Ilian', 'Janopullo', 'ijanopullo22@epoka.edu.al', '4a6923f14b7917f8d9f572424fa6f3cf', 1),
(2, 'Erdi', 'Kale', 'erdi18kale@gmail.com', '4ef6d05cb65f5ed7f510292c5c1ce441', 0),
(4, 'Arion', 'Samarxhiu', 'asamarxhiu22@epoka.edu.al', '139b224a7ed89be14e4154b15012a3df', 0),
(5, 'Erdi', 'Koci', 'ekoci22@epoka.edu.al', '37f933eae725e640333500df902165fc', 0),
(6, 'Unejs', 'Isufaj', 'uisufaj22@epoka.edu.al', '70e4907a602994ad3f86c494f6686277', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
