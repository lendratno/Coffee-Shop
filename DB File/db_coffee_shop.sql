-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 05:13 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_coffee_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `send_to` int(5) NOT NULL,
  `send_by` int(3) NOT NULL,
  `message` tinytext NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `komentar` text NOT NULL,
  `time` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `nama`, `komentar`, `time`) VALUES
(13, 'Administrator', 'Halo, terima kasih telah berkunjung dan mengirimkan feedback disini yaa..', 'Jumat, 13 Mei 2022');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `kopi` varchar(128) NOT NULL,
  `deskrpsi` varchar(1024) NOT NULL,
  `image` varchar(128) NOT NULL,
  `harga` varchar(128) NOT NULL,
  `category` varchar(25) NOT NULL,
  `rekomendasi` varchar(18) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `kopi`, `deskrpsi`, `image`, `harga`, `category`, `rekomendasi`, `date_created`) VALUES
(23, 'Fruit Mix', 'Minuman segar dengan kombinasi rasa buah-buahan yang bervariasi, soda dan mint', 'Fruit_Mix_1.jpg', '15000', 'Non Coffee', 'Tidak Rekomendasi', 1652969734),
(25, 'Blueberry Yakult', 'Minuman segar dengan kombinasi rasa buah blueberry, susu dan rasa manis, asam, segar dari yakult', 'Blueberry_Yakult1.PNG', '17000', 'Non Coffee', 'Tidak Rekomendasi', 1652969819),
(27, 'Thai Tea', 'Minuman teh segar dengan campuran teh dan susu serta bahan lain yang menciptakan variasi rasa', 'Thai_Tea1.PNG', '15000', 'Non Coffee', 'Tidak Rekomendasi', 1652969881),
(28, 'Chocolate', 'Minuman segar dengan campuran coklat dan susu', 'Chocolate1.PNG', '17000', 'Non Coffee', 'Tidak Rekomendasi', 1652969918),
(29, 'Red Velvet', 'Minuman segar dengan citarasa manis dan ciri khas berwarna merah', 'Red_Velvet1.PNG', '17000', 'Non Coffee', 'Rekomendasi', 1652969958),
(30, 'Ice Cream', 'Cemilan es dengan rasa yang manis dan segar yang memiliki tekstur kenyal dan dingin', 'Ice_Cream1.jpg', '5000', 'Non Coffee', 'Rekomendasi', 1652970026),
(31, 'Espresso', 'Minuman kopi yang dihasilkan dari proses penyeduhan dengan tekanan tinggi', 'Espresso1.PNG', '10000', 'Coffee', 'Tidak Rekomendasi', 1652970071),
(32, 'Americano', 'Minuman kopi asil hasil pengembangan dari kopi espresso', 'Americano1.PNG', '14000', 'Coffee', 'Tidak Rekomendasi', 1652970116),
(33, 'Cappucino', 'Minuman kopi yang secara umum dikenal masyarakat luas sebagai kopi khas asal italia', 'Capuccino1.PNG', '17000', 'Coffee', 'Rekomendasi', 1652970149),
(34, 'Caffe Latte', 'Minuman kopi dengan campuran susu yang pada bagian permukaan air nya ditambahkan hiasan berbagai bentuk', 'Cafe_Latte1.PNG', '17000', 'Coffee', 'Rekomendasi', 1652970181),
(35, 'Moccacino', 'Minuman kopi dengan kombinasi rasa kopi, coklat, dan susu', 'Moccacino1.PNG', '17000', 'Coffee', 'Rekomendasi', 1652970218),
(36, 'Matcha Spro', 'Minuman kopi dengan kombinasi rasa kopi, matcha, dan susu', 'Matcha_spro1.PNG', '17000', 'Coffee', 'Rekomendasi', 1652970260),
(38, 'Vietnam Drip', 'Minuman kopi yang dibuat dari biji kopi dan alat yang berasal dari vietnam', 'Vietnam_Drip1.PNG', '14000', 'Non Coffee', 'Rekomendasi', 1652970330),
(39, 'Kopi Tubruk', 'Minuman kopi yang penyajianya adalah dengan menyampurkan air panas ke dalam wadah yang sudah diisi bubuk kopi', 'Kopi_Tubruk1.PNG', '10000', 'Coffee', 'Tidak Rekomendasi', 1652970366),
(40, 'Affogato', 'Minuman kopi yang unik dengan cara penyajian yaitu dengan mencampurkan espresso dengan es krim (gellato)', 'Affogato1.PNG', '15000', 'Coffee', 'Rekomendasi', 1652970400),
(41, 'Kentang Goreng', 'Makanan tradisional berbahan dasar kentang yang digoreng hingga menjadi crispy', 'French_Fries1.PNG', '14000', 'Makanan', 'Tidak Rekomendasi', 1652970433),
(42, 'Sempol', 'Makanan yang berbahan dasar tepung tapioka dengan campuran daging ayam yang digoreng sampai crispy', 'Sempol1.PNG', '15000', 'Makanan', 'Tidak Rekomendasi', 1652970462),
(43, 'Manggo Yakult', 'Minuman segar dengan kombinasi rasa buah mangga, susu dan rasa manis, asam, segar dari yakult', 'Mango_Yakult2.PNG', '17000', 'Non Coffee', 'Tidak Rekomendasi', 1652971919),
(44, 'Kopsu Palm Sugar', 'Minuman kopi dengan kombinasi rasa kopi, susu, dan gula aren', 'Kopsu_Palm_Sugar_2.PNG', '15000', 'Coffee', 'Tidak Rekomendasi', 1652971989),
(45, 'Lemon Tea', 'Minuman teh segar dengan campuran ekstrak lemon', 'Lemon_tea_2.jpg', '13000', 'Non Coffee', 'Tidak Rekomendasi', 1652972516),
(46, 'Lime Squadsh', 'Minuman segar dengan kombinasi rasa jeruk nipis, soda, dan mint', 'Lime_Squash2.PNG', '15000', 'Non Coffee', 'Tidak Rekomendasi', 1652972614),
(47, 'Green Tea', 'Minuman teh segar original yang dihasilkan dari hasil seduhan ekstrak daun teh asli', 'Green_Tea2.PNG', '17000', 'Non Coffee', 'Tidak Rekomendasi', 1652972643);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `total_bayar` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(2) NOT NULL,
  `order` varchar(12) NOT NULL,
  `subtotal` varchar(128) NOT NULL,
  `lunas` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `no_pesanan`, `username`, `menu_id`, `quantity`, `order`, `subtotal`, `lunas`) VALUES
(89, 3, '', 7, 1, '', '8000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `unique_id` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `name` varchar(35) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `user_status` varchar(20) NOT NULL,
  `date_created` int(11) NOT NULL,
  `last_logout` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `unique_id`, `email`, `username`, `name`, `password`, `role_id`, `is_active`, `user_status`, `date_created`, `last_logout`) VALUES
(1, '841157', 'admin@admin.com', 'Admin', 'Administrator', '$2y$10$rVy68lv6hY4dMYbmQNnNbOLkllSf7f1BJRYMw/Xw5WdMv.V1Sdeyu', 1, 1, 'active', 1649402646, ''),
(2, 'fe367e', 'tester@yahoo.com', 'Tester', 'Tester', '$2y$10$IfY6KHiiu3bOCusb/FFGzevVcBh1wIQsYKx4XmNSCHeRg9pH3kVsq', 2, 1, 'active', 1652339290, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `time` datetime(6) NOT NULL,
  `sender_message_id` varchar(20) NOT NULL,
  `receiver_message_id` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`time`, `sender_message_id`, `receiver_message_id`, `message`) VALUES
('2022-04-23 21:54:27.000000', '2bc812', '7c9bc3', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `sent_to` (`send_to`),
  ADD KEY `send_by` (`send_by`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
