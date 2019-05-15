-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: localhost:3306
-- Χρόνος δημιουργίας: 15 Μάη 2019 στις 14:16:17
-- Έκδοση διακομιστή: 10.3.14-MariaDB
-- Έκδοση PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `id9568648_eshop`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) COLLATE greek_bin NOT NULL,
  `qty` int(10) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=greek COLLATE=greek_bin;

--
-- Άδειασμα δεδομένων του πίνακα `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`, `customer_id`) VALUES
(20, '213.16.231.120', 2, 4),
(11, '213.16.231.120', 1, 4),
(16, '213.16.231.120', 1, 4),
(11, '2a02:214c:822d:d000:947d:3e42:c5a8:bc0a', 1, 16);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text COLLATE greek_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=greek COLLATE=greek_bin;

--
-- Άδειασμα δεδομένων του πίνακα `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(5, 'Αξεσουάρ'),
(4, 'Άλμπουμ'),
(6, 'Ρούχα'),
(7, 'Άλλα');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) COLLATE greek_bin NOT NULL,
  `customer_name` text COLLATE greek_bin NOT NULL,
  `customer_email` varchar(100) COLLATE greek_bin NOT NULL,
  `customer_pass` varchar(100) COLLATE greek_bin NOT NULL,
  `customer_country` text COLLATE greek_bin NOT NULL,
  `customer_city` text COLLATE greek_bin NOT NULL,
  `customer_contact` varchar(255) COLLATE greek_bin NOT NULL,
  `customer_address` text COLLATE greek_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=greek COLLATE=greek_bin;

--
-- Άδειασμα δεδομένων του πίνακα `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`) VALUES
(3, '::1', '?????½?????±?½?????½?± ?????????½????????', 'gkounidou@hotmail.com', '1234', '???»?»?¬???±', '???»?????±?½???????????»?·', '2551021197', '???±???¬?»?· 8'),
(4, '::1', 'Papia', 'papia@gmail.com', 'papia', '???»?»?¬???±', 'ellada', 'papia', 'papia 12'),
(16, '2a02:214c:822d:d000:947d:3e42:c5a8:bc0a', 'A', 'Sss', 'a', 'Επιλογή Χώρας', 'Sss', 'Sd', 'D'),
(10, '2a02:214c:822d:d000:947d:3e42:c5a8:bc0a', 'Simon', 'Simon', 'simon', 'Επιλογή Χώρας', 'Bd', 'Ddf', 'F');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_price` float NOT NULL,
  `product_image` text COLLATE greek_bin NOT NULL,
  `product_desc` text COLLATE greek_bin NOT NULL,
  `product_keywords` text COLLATE greek_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=greek COLLATE=greek_bin;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_title`, `product_price`, `product_image`, `product_desc`, `product_keywords`) VALUES
(4, 6, 'Μπλουζάκι \"A head full of dreams\"', 13.99, 'sh.jpg', 'Μπλουζάκι \"A head full of dreams\"', 'Μπλουζάκι \"A head full of dreams\"'),
(6, 5, 'Κούπα \"A head full of dreams\"', 14.99, 'm.jpg', 'Κούπα \"A head full of dreams\"', 'Κούπα \"A head full of dreams\"'),
(14, 4, '\"X&Y\" Άλμπουμ', 25.99, 'x.jpg', '\"X&Y\" Άλμπουμ', '\"X&Y\" Άλμπουμ'),
(11, 5, 'Κούπα \"X&Y\"', 12.99, 'mug.jpg', 'Κούπα \"X&Y\"', 'Κούπα \"X&Y\"'),
(12, 4, '\"Parachutes\" Άλμπουμ', 26.99, 'p.jpg', '\"Parachutes\" Άλμπουμ', '\"Parachutes\" Άλμπουμ'),
(15, 6, 'Φούτερ \"Live in Buenos Aires\"', 23.12, 'b.jpg', 'Φούτερ \"Live in Buenos Aires\"', 'Φούτερ \"Live in Buenos Aires\"'),
(16, 6, ' Μπλουζάκι \"A head full of dreams\"', 13.44, 'shirt.jpg', ' Μπλουζάκι \"A head full of dreams\"', ' Μπλουζάκι \"A head full of dreams\"'),
(17, 5, 'Τσάντα \"A head full of dreams\"', 18.99, 'bag.jpg', 'Τσάντα \"A head full of dreams\"', 'Τσάντα \"A head full of dreams\"'),
(18, 4, 'Άλμπουμ \"A head full of dreams\"', 25.95, 'h.png', 'Άλμπουμ \"A head full of dreams\"', 'Άλμπουμ \"A head full of dreams\"'),
(19, 4, 'Άλμπουμ \"Mylo Xyloto\"', 24.55, 'my.jpg', 'Άλμπουμ \"Mylo Xyloto\"', 'Άλμπουμ \"Mylo Xyloto\"'),
(20, 4, 'Άλμπουμ \"Viva la Vida\"', 21.33, 'v.jpg', 'Άλμπουμ \"Viva la Vida\"', 'Άλμπουμ \"Viva la Vida\"'),
(21, 4, 'Άλμπουμ \"Gost Stories\"', 27.88, 'g.png', 'Άλμπουμ \"Gost Stories\"', 'Άλμπουμ \"Gost Stories\"'),
(22, 4, 'Άλμπουμ \"A rush of blood to the head\"', 24.49, 'a.jpg', 'Άλμπουμ \"A rush of blood to the head\"', 'Άλμπουμ \"A rush of blood to the head\"'),
(23, 6, 'Ελληνικά', 33, 'a.jpg', 'Ελληνικά', 'Ελληνικά');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);
ALTER TABLE `categories` ADD FULLTEXT KEY `cat_title` (`cat_title`);
ALTER TABLE `categories` ADD FULLTEXT KEY `cat_title_2` (`cat_title`);

--
-- Ευρετήρια για πίνακα `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT για πίνακα `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
