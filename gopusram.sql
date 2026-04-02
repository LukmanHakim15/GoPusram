-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2026 at 01:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gopusram`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2026-04-01 17:56:11', '2026-04-01 17:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(2, 'Makanan Ringan', '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(3, 'Mie & Makanan Instan', '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(4, 'Roti & Kue', '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(5, 'Permen & Cokelat', '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(6, 'Kebutuhan Sehari-hari', '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(7, 'Frozen Food', '2026-04-01 17:35:00', '2026-04-01 17:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `order_id`, `nama_penerima`, `kelas`, `lokasi_ruangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Budi Santoso', 'XI RPL 1', 'C205', '2026-04-01 17:56:44', '2026-04-01 17:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_28_110712_add_role_kelas_to_users_table', 1),
(5, '2026_03_28_120001_create_categories_table', 1),
(6, '2026_03_28_120002_create_products_table', 1),
(7, '2026_03_28_120003_create_carts_table', 1),
(8, '2026_03_28_120004_create_cart_items_table', 1),
(9, '2026_03_28_120005_create_orders_table', 1),
(10, '2026_03_28_120006_create_order_items_table', 1),
(11, '2026_03_28_120007_create_deliveries_table', 1),
(12, '2026_03_28_120008_create_operating_hours_table', 1),
(13, '2026_03_28_120009_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `pesan`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 3, 'Pesanan #0001 berhasil dibuat. Total: Rp 25.000. Status: Menunggu konfirmasi.', 0, '2026-04-01 17:56:44', '2026-04-01 17:56:44'),
(2, 3, 'Pesanan #0001 diperbarui: Menunggu → Sedang Diproses.', 0, '2026-04-01 17:58:18', '2026-04-01 17:58:18'),
(3, 3, 'Pesanan #0001 diperbarui: Sedang Diproses → Sedang Diantar.', 0, '2026-04-01 17:58:26', '2026-04-01 17:58:26'),
(4, 3, 'Pesanan #0001 diperbarui: Sedang Diantar → Selesai.', 0, '2026-04-01 17:58:52', '2026-04-01 17:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `operating_hours`
--

CREATE TABLE `operating_hours` (
  `id` bigint UNSIGNED NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT '0',
  `jam_buka` time NOT NULL DEFAULT '07:00:00',
  `jam_tutup` time NOT NULL DEFAULT '14:00:00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operating_hours`
--

INSERT INTO `operating_hours` (`id`, `is_open`, `jam_buka`, `jam_tutup`, `created_at`, `updated_at`) VALUES
(1, 1, '00:00:00', '23:59:00', '2026-04-01 17:35:00', '2026-04-01 17:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `metode_pengambilan` enum('ambil_sendiri','diantar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ambil_sendiri',
  `metode_pembayaran` enum('cash','ewallet') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status_pesanan` enum('pending','diproses','siap_diambil','diantar','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_pembayaran` enum('belum_bayar','sudah_bayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_bayar',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_harga`, `metode_pengambilan`, `metode_pembayaran`, `status_pesanan`, `status_pembayaran`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 3, '25000.00', 'diantar', 'ewallet', 'selesai', 'sudah_bayar', NULL, '2026-04-01 17:56:44', '2026-04-01 17:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '25000.00', '2026-04-01 17:56:44', '2026-04-01 17:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `nama_produk`, `harga`, `stok`, `deskripsi`, `gambar`, `expired_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Aqua Botol 1000ml', '5000.00', 120, 'Air mineral segar kemasan botol 600ml', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 18:01:46'),
(2, 1, 'Aqua Galon 19L', '25000.00', 29, 'Air mineral galon isi ulang 19 liter', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:56:44'),
(3, 1, 'Teh Botol Sosro 350ml', '5000.00', 80, 'Teh manis dalam kemasan botol', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(4, 1, 'Pocari Sweat 500ml', '8000.00', 60, 'Minuman isotonik pengganti ion tubuh', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(5, 1, 'Mizone 500ml', '7000.00', 55, 'Minuman bernutrisi rasa jeruk/passion fruit', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(6, 1, 'Coca Cola Kaleng 330ml', '8000.00', 45, 'Minuman bersoda klasik kemasan kaleng', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(7, 1, 'Fanta Strawberry 390ml', '7000.00', 40, 'Minuman bersoda rasa stroberi', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(8, 1, 'Kopi Good Day Sachet', '2500.00', 100, 'Kopi susu instan sachet siap seduh', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(9, 1, 'Nutrisari Jeruk Sachet', '2000.00', 90, 'Minuman serbuk rasa jeruk vitamin C', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(10, 1, 'Susu Ultra Milk 200ml', '5000.00', 70, 'Susu UHT full cream kemasan kecil', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(11, 2, 'Chitato Sapi Panggang 68g', '10000.00', 55, 'Keripik kentang rasa sapi panggang', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(12, 2, 'Pringles Original 107g', '22000.00', 30, 'Keripik kentang premium rasa original', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(13, 2, 'Oreo Original 137g', '9000.00', 50, 'Biskuit sandwich cokelat dengan krim vanilla', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(14, 2, 'Roma Marie 225g', '8000.00', 45, 'Biskuit marie klasik renyah', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(15, 2, 'Tango Wafer Cokelat', '5000.00', 70, 'Wafer berlapis cokelat crispy', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(16, 2, 'Qtela Singkong 230g', '12000.00', 40, 'Keripik singkong aneka rasa', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(17, 2, 'Cheetos Jagung Bakar', '7000.00', 60, 'Snack jagung rasa jagung bakar', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(18, 2, 'Lays Original 68g', '10000.00', 35, 'Keripik kentang tipis rasa original', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(19, 2, 'Richeese Nabati 145g', '8000.00', 65, 'Wafer keju lezat berlapis krim keju', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(20, 2, 'Beng-Beng Share It', '5000.00', 80, 'Wafer karamel berlapis cokelat', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(21, 3, 'Indomie Goreng Original', '3500.00', 150, 'Mie goreng instan rasa original terpopuler', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(22, 3, 'Indomie Soto Ayam', '3500.00', 120, 'Mie kuah rasa soto ayam gurih', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(23, 3, 'Indomie Rendang', '4000.00', 80, 'Mie goreng rasa rendang pedas', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(24, 3, 'Mie Sedaap Goreng', '3000.00', 100, 'Mie goreng instan dengan bumbu spesial', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(25, 3, 'Supermi Ayam Bawang', '2500.00', 90, 'Mie kuah rasa ayam bawang', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(26, 3, 'Pop Mie Ayam 75g', '5000.00', 60, 'Mie cup instan rasa ayam, tinggal seduh', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(27, 3, 'Sarimi Soto Koya', '3000.00', 70, 'Mie kuah dengan taburan koya gurih', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(28, 3, 'Bihun Jagung Instan', '3500.00', 50, 'Bihun instan berbahan jagung lebih sehat', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(29, 4, 'Roti Tawar Sari Roti', '12000.00', 30, 'Roti tawar lembut kemasan 10 lembar', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(30, 4, 'Roti Kasur Cokelat', '5000.00', 45, 'Roti isi cokelat empuk dan lembut', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(31, 4, 'Monde Butter Cookies', '18000.00', 25, 'Kue kering butter premium dalam kaleng', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(32, 4, 'Serabi Solo Mini (isi 5)', '8000.00', 20, 'Serabi tradisional Solo isi 5 pcs', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(33, 4, 'Bolu Gulung Pandan', '7000.00', 30, 'Bolu gulung rasa pandan lembut', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(34, 4, 'Croissant Mini (isi 3)', '8000.00', 25, 'Croissant mentega mini renyah', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(35, 5, 'Silver Queen Cashew 95g', '15000.00', 35, 'Cokelat susu dengan kacang mete premium', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(36, 5, 'KitKat 2 Finger', '8000.00', 50, 'Wafer cokelat renyah KitKat 2 jari', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(37, 5, 'Kopiko Kopi Candy', '3000.00', 80, 'Permen rasa kopi arabika asli', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(38, 5, 'Relaxa Mint', '2000.00', 70, 'Permen mint menyegarkan', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(39, 5, 'Sugus Aneka Rasa', '2000.00', 60, 'Permen lunak aneka rasa buah', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(40, 5, 'Yupi Gummy Bears', '5000.00', 45, 'Permen gummy berbentuk beruang lucu', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(41, 5, 'Mentos Fruit Roll', '5000.00', 55, 'Permen mint rasa buah-buahan', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(42, 6, 'Tisu Paseo 250 lembar', '8000.00', 40, 'Tisu serbaguna lembut 250 lembar', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(43, 6, 'Tisu Basah Freshtex', '10000.00', 30, 'Tisu basah pembersih 50 lembar', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(44, 6, 'Masker Earloop 1 pcs', '2000.00', 100, 'Masker 3 lapis pelindung debu dan virus', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(45, 6, 'Hand Sanitizer 60ml', '10000.00', 35, 'Gel pembersih tangan tanpa air 60ml', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(46, 6, 'Pulpen Standard AE7', '3000.00', 80, 'Pulpen tinta biru lancar untuk menulis', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(47, 6, 'Pensil 2B Faber-Castell', '3500.00', 60, 'Pensil 2B untuk menulis dan menggambar', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(48, 6, 'Buku Tulis Sidu 38 lembar', '4500.00', 50, 'Buku tulis bergaris 38 lembar', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(49, 6, 'Penghapus Steadler', '3000.00', 70, 'Penghapus bersih tidak merusak kertas', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(50, 7, 'Sosis So Good 375g', '25000.00', 20, 'Sosis ayam siap goreng kemasan 375g', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(51, 7, 'Nugget So Good 500g', '35000.00', 15, 'Nugget ayam crispy kemasan 500g', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(53, 7, 'Dimsum Ayam Frozen 200g', '18000.00', 22, 'Dimsum ayam kukus siap makan kemasan beku', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00'),
(54, 7, 'Otak-otak Ikan 200g', '15000.00', 25, 'Otak-otak ikan gurih kemasan beku', NULL, NULL, 1, '2026-04-01 17:35:00', '2026-04-01 17:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2sXLN2LjldeJYl1vH2pyRd9FKgH4pTeA5lrFq8gD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'eyJfdG9rZW4iOiJTVDFDVjhDbG5qU1N6VWZBWFhzdUxPQlFPckV5UDhvTUhFUVhjUVhNIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImxhbmRpbmcifX0=', 1775091725);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','siswa','pm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `kelas`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gopusram.test', 'admin', NULL, NULL, '$2y$12$inCsjXCm9Yg.KN9RAPJ3Ge409jNfFvlWNSOPLBzmh/IeqCj7Wgi5.', NULL, '2026-04-01 17:34:59', '2026-04-01 17:34:59'),
(2, 'Petugas PM', 'pm@gopusram.test', 'pm', 'XII PM 1', NULL, '$2y$12$ulzgj/RNDjdmp.VJ0M83tOTXFapJNuKO.cUBylNvKH4APITIs5n..', NULL, '2026-04-01 17:34:59', '2026-04-01 17:34:59'),
(3, 'Budi Santoso', 'budi@gopusram.test', 'siswa', 'XI RPL 1', NULL, '$2y$12$tpdqltyI4VFbborrw5hHHuUR5xdqDcP4sDj/TbUshzIZo.6Wghmgi', NULL, '2026-04-01 17:35:00', '2026-04-01 17:35:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `operating_hours`
--
ALTER TABLE `operating_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `operating_hours`
--
ALTER TABLE `operating_hours`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
