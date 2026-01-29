-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 10:00 AM
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
-- Database: `ims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(64) NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `event`, `subject_type`, `subject_id`, `description`, `meta`, `created_at`, `updated_at`) VALUES
(1, 1, 'PRODUCT_CREATE', 'App\\Models\\Product', 10, 'Created product WDG - 0015', NULL, '2025-10-16 04:30:51', '2025-10-16 04:30:51'),
(2, 1, 'PRODUCT_DELETE', 'App\\Models\\Product', 9, 'Deleted product WDG - 0009', NULL, '2025-10-16 04:31:34', '2025-10-16 04:31:34'),
(3, 1, 'PRODUCT_UPDATE', 'App\\Models\\Product', 10, 'Updated product WDG - 0013', NULL, '2025-10-16 04:31:51', '2025-10-16 04:31:51'),
(4, 1, 'PO_CREATE', 'App\\Models\\PurchaseOrder', 11, 'Created PO PO-20250928', NULL, '2025-10-16 04:54:47', '2025-10-16 04:54:47'),
(5, 3, 'PO_CREATE', 'App\\Models\\PurchaseOrder', 12, 'Created PO PO-20250929', NULL, '2025-10-16 04:58:03', '2025-10-16 04:58:03'),
(6, 1, 'USER_CREATE', 'App\\Models\\User', 6, 'Created user DAMI@GMAIL.COM', '{\"by\":1}', '2025-10-17 00:18:23', '2025-10-17 00:18:23'),
(7, 1, 'USER_UPDATE', 'App\\Models\\User', 6, 'Updated user DAMI@GMAIL.COM', '{\"by\":1}', '2025-10-17 00:18:39', '2025-10-17 00:18:39'),
(8, 1, 'USER_DELETE', 'App\\Models\\User', 6, 'Deleted user DAMI@GMAIL.COM', '{\"by\":1}', '2025-10-17 00:18:44', '2025-10-17 00:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(64) NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `event`, `subject_type`, `subject_id`, `description`, `meta`, `created_at`, `updated_at`) VALUES
(1, 1, 'USER_UPDATE', 'App\\Models\\User', 3, 'Updated user clerks@example.com', '{\"by\":1}', '2025-09-18 02:41:24', '2025-09-18 02:41:24'),
(2, 1, 'USER_UPDATE', 'App\\Models\\User', 3, 'Updated user clerk@example.com', '{\"by\":1}', '2025-09-18 02:41:37', '2025-09-18 02:41:37'),
(3, 1, 'PRODUCT_CREATE', 'App\\Models\\Product', 1, 'Created product WDG - 0001', NULL, '2025-09-18 04:28:52', '2025-09-18 04:28:52'),
(4, 1, 'PRODUCT_UPDATE', 'App\\Models\\Product', 1, 'Updated product WDG - 0001', NULL, '2025-09-18 04:29:16', '2025-09-18 04:29:16'),
(5, 1, 'PRODUCT_UPDATE', 'App\\Models\\Product', 1, 'Updated product WDG - 0001', NULL, '2025-09-18 04:29:25', '2025-09-18 04:29:25'),
(6, 1, 'PRODUCT_CREATE', 'App\\Models\\Product', 2, 'Created product hyt', NULL, '2025-09-18 04:29:50', '2025-09-18 04:29:50'),
(7, 1, 'PRODUCT_DELETE', 'App\\Models\\Product', 2, 'Deleted product hyt', NULL, '2025-09-18 04:29:55', '2025-09-18 04:29:55'),
(8, 1, 'USER_CREATE', 'App\\Models\\User', 5, 'Created user dahana@gmail.com', '{\"by\":1}', '2025-09-18 05:04:12', '2025-09-18 05:04:12'),
(9, 1, 'USER_UPDATE', 'App\\Models\\User', 1, 'Updated user admin@example.com', '{\"by\":1}', '2025-09-18 05:16:05', '2025-09-18 05:16:05'),
(10, 1, 'PRODUCT_CREATE', 'App\\Models\\Product', 3, 'Created product WDG-0002', NULL, '2025-09-19 03:13:58', '2025-09-19 03:13:58'),
(11, 1, 'USER_UPDATE', 'App\\Models\\User', 1, 'Updated user dilshankumara255@gmail.com.com', '{\"by\":1}', '2025-09-22 04:22:39', '2025-09-22 04:22:39'),
(12, 1, 'USER_UPDATE', 'App\\Models\\User', 1, 'Updated user dilshankumara255@gmail.com', '{\"by\":1}', '2025-09-22 04:22:51', '2025-09-22 04:22:51'),
(13, 2, 'PRODUCT_CREATE', 'App\\Models\\Product', 4, 'Created product WDG - 0003', NULL, '2025-09-25 04:31:25', '2025-09-25 04:31:25'),
(14, 2, 'PRODUCT_CREATE', 'App\\Models\\Product', 5, 'Created product WDG-0004', NULL, '2025-09-27 05:33:25', '2025-09-27 05:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_levels`
--

CREATE TABLE `inventory_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `on_hand` int(11) NOT NULL DEFAULT 0,
  `on_order` int(11) NOT NULL DEFAULT 0,
  `allocated` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_levels`
--

INSERT INTO `inventory_levels` (`id`, `product_id`, `warehouse_id`, `on_hand`, `on_order`, `allocated`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 5, 0, 0, '2025-09-19 03:14:41', '2025-09-19 03:14:42'),
(2, 1, 3, 43, 0, 0, '2025-09-19 03:31:51', '2025-09-25 04:34:36'),
(3, 1, 1, 2, 0, 0, '2025-09-24 01:20:42', '2025-09-25 04:34:36'),
(4, 4, 3, 0, 1, 0, '2025-09-27 05:46:16', '2025-09-27 05:46:16'),
(5, 5, 3, 2, 2, 0, '2025-09-27 05:46:16', '2025-09-27 05:46:16'),
(6, 7, 3, 0, 0, 0, '2025-10-16 10:17:31', '2025-10-17 04:29:53'),
(7, 7, 1, 5, 0, 0, '2025-10-16 22:11:17', '2025-10-17 04:29:53'),
(9, 6, 1, 3, 0, 0, '2025-10-17 04:36:03', '2025-10-17 06:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"e36dbbbd-c2b9-4074-bc7d-8059de0c00b1\",\"displayName\":\"App\\\\Mail\\\\LowStockSummary\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":16:{s:8:\\\"mailable\\\";O:24:\\\"App\\\\Mail\\\\LowStockSummary\\\":3:{s:4:\\\"rows\\\";a:1:{i:0;a:4:{s:3:\\\"sku\\\";s:10:\\\"WDG - 0001\\\";s:4:\\\"name\\\";s:3:\\\"LED\\\";s:7:\\\"on_hand\\\";i:5;s:13:\\\"reorder_point\\\";i:10;}}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:17:\\\"admin@example.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1758523172,\"delay\":null}', 0, NULL, 1758523172, 1758523172);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_17_073910_create_permission_tables', 2),
(5, '2025_09_17_082431_add_role_to_users_table', 3),
(6, '2025_09_18_055712_create_activity_logs_table', 4),
(7, '2025_09_18_063708_create_inventory_levels_table', 5),
(8, '2025_09_18_063708_create_products_table', 5),
(9, '2025_09_18_063708_create_warehouses_table', 5),
(10, '2025_09_18_063709_create_purchase_orders_table', 5),
(11, '2025_09_18_063709_create_stock_movements_table', 5),
(12, '2025_09_18_094316_add_missing_fields_to_products_table', 6),
(13, '2025_09_18_095037_add_missing_fields_to_products_table', 7),
(14, '2025_09_18_092544_add_meta_columns_to_products_table', 8),
(15, '2025_09_18_151857_add_columns_to_warehouses_table', 9),
(16, '2025_09_18_151857_add_columns_to_inventory_levels_table', 10),
(17, '2025_09_18_151858_add_columns_to_stock_movements_table', 11),
(18, '2025_09_20_080835_create_suppliers_table', 12),
(19, '2025_09_20_080913_create_product_suppliers_table', 13),
(20, '2025_09_18_093837_create_products_table', 14),
(21, '2025_09_18_150026_add_columns_to_inventory_levels_table', 14),
(22, '2025_09_18_150026_add_columns_to_warehouses_table', 14),
(23, '2025_09_18_150027_add_columns_to_stock_movements_table', 14),
(24, '2025_09_20_055001_alter_purchase_orders_add_basic_fields', 14),
(25, '2025_09_20_055045_create_purchase_order_items_table', 14),
(26, '2025_09_22_040315_alter_purchase_orders_add_status_expected', 14),
(27, '2025_09_22_050119_add_supplier_id_to_purchase_orders_table', 15),
(28, '2025_09_22_050235_ensure_qty_ordered_on_purchase_order_items', 16),
(29, '2025_09_22_054045_add_received_qty_and_indexes', 17),
(30, '2025_09_22_064915_add_approval_columns_to_stock_movements', 18),
(31, '2025_09_23_070627_add_status_to_stock_movements', 19),
(32, '2025_09_18_055712_create_activity_logs_table', 20),
(33, '2025_09_18_055712_create_activity_logs_table', 20),
(34, '2025_09_23_150246_widen_po_status_column', 21),
(35, '2025_09_24_042257_alter_purchase_orders_status_column', 21),
(36, '2025_09_24_064724_add_indexes_for_perf', 22),
(37, '2025_09_24_070140_add_unique_index_to_purchase_orders_po_number', 23),
(38, '2025_09_24_094500_create_stock_transfers_table', 24),
(39, '2025_09_25_042625_add_attachment_path_to_stock_movements', 25),
(40, '2025_10_15_102314_create_suppliers_table', 21),
(41, '2025_10_17_033051_extend_type_column_in_stock_movements_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('nadunravindra@gmail.com', '$2y$12$905vYxRnP8vYBNGKDkssIOxX5wiJKa8R/NxXe6QGfa3q5U0KnPqdO', '2025-11-19 02:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(64) DEFAULT NULL,
  `uom` varchar(32) DEFAULT NULL,
  `reorder_point` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `description`, `category`, `uom`, `reorder_point`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'WDG - 0001', 'LED', '(red,green,blue,yellow)', 'Components', 'pcs', 10, 1, '2025-09-18 04:28:52', '2025-09-18 04:29:16'),
(3, 'WDG-0002', 'Microcontroller', NULL, 'Components', 'pcs', 5, 1, '2025-09-19 03:13:58', '2025-09-19 03:13:58'),
(4, 'WDG - 0003', 'LED', 'more', 'Components', 'pcs', 8, 1, '2025-09-25 04:31:25', '2025-09-25 04:31:25'),
(5, 'WDG-0004', 'wires', 'jumper', 'Components', 'pcs', 5, 1, '2025-09-27 05:33:25', '2025-09-27 05:33:25'),
(6, 'WDG - 0005', 'Arudino', NULL, 'Components', 'pcs', 8, 1, '2025-10-16 04:10:09', '2025-10-16 04:10:09'),
(7, 'WDG - 0007', 'Arudino', NULL, 'Components', 'pcs', 8, 1, '2025-10-16 04:15:46', '2025-10-16 04:15:46'),
(8, 'WDG - 0010', 'Arudino', NULL, 'Components', 'pcs', 8, 1, '2025-10-16 04:17:38', '2025-10-16 04:17:38'),
(10, 'WDG - 0013', 'Arudino', NULL, 'Components', 'pcs', 5, 1, '2025-10-16 04:30:51', '2025-10-16 04:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_suppliers`
--

CREATE TABLE `product_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_sku` varchar(255) DEFAULT NULL,
  `last_price` decimal(12,2) DEFAULT NULL,
  `lead_time_days` smallint(5) UNSIGNED DEFAULT NULL,
  `is_preferred` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'open',
  `order_date` date NOT NULL DEFAULT curdate(),
  `expected_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `supplier_id`, `supplier`, `status`, `order_date`, `expected_date`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'PO-20250922-050331', 1, NULL, 'closed', '2025-09-22', '2025-09-29', NULL, NULL, '2025-09-21 23:33:31', '2025-09-24 01:04:16'),
(3, 'PO-20250924-053450', 1, NULL, 'sent', '2025-09-24', '2025-10-01', NULL, NULL, '2025-09-24 00:04:50', '2025-09-24 00:04:58'),
(4, 'PO-20250924-064953', 1, NULL, 'SENT', '2025-09-24', '2025-09-26', NULL, NULL, '2025-09-24 01:19:53', '2025-10-16 05:14:59'),
(5, 'PO-20250924-064954', 1, NULL, 'cancelled', '2025-09-24', '2025-09-26', NULL, NULL, '2025-09-24 01:19:54', '2025-09-24 01:46:36'),
(6, 'PO-20250924-071617-MMWC', 1, NULL, 'SENT', '2025-09-24', '2025-09-27', NULL, NULL, '2025-09-24 01:46:17', '2025-10-16 00:42:31'),
(7, 'PO-20250927-044322-MUZI', 1, NULL, 'APPROVED', '2025-09-27', '2025-10-01', NULL, NULL, '2025-09-26 23:13:22', '2025-10-16 00:43:02'),
(8, 'PO-20250927-050641-9URJ', 1, NULL, 'CANCELLED', '2025-09-27', '2025-10-11', NULL, NULL, '2025-09-26 23:36:41', '2025-10-16 04:48:03'),
(9, 'PO-20250927-051632-DDNR', 1, NULL, 'SENT', '2025-09-27', '2025-10-10', NULL, NULL, '2025-09-26 23:46:32', '2025-10-16 00:44:36'),
(10, 'PO-20250927-110601-VWTA', 1, NULL, 'sent', '2025-09-27', '2025-10-07', NULL, NULL, '2025-09-27 05:36:01', '2025-09-27 05:46:16'),
(11, 'PO-20250928', 1, NULL, 'DRAFT', '2025-10-16', '2025-10-30', NULL, 1, '2025-10-16 04:54:47', '2025-10-16 04:54:47'),
(12, 'PO-20250929', 1, NULL, 'SENT', '2025-10-16', '2025-10-30', NULL, 3, '2025-10-16 04:58:03', '2025-10-16 05:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty_ordered` int(11) NOT NULL,
  `received_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `qty_received` int(11) NOT NULL DEFAULT 0,
  `uom` varchar(32) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `product_id`, `qty_ordered`, `received_qty`, `qty_received`, `uom`, `price`, `created_at`, `updated_at`, `warehouse_id`) VALUES
(1, 2, 1, 5, 5, 0, NULL, 500.00, '2025-09-21 23:33:31', '2025-09-24 01:04:16', 3),
(2, 3, 3, 10, 0, 0, NULL, 1000.00, '2025-09-24 00:04:50', '2025-09-24 00:04:50', 3),
(3, 4, 1, 10, 0, 0, NULL, 200.00, '2025-09-24 01:19:53', '2025-09-24 01:19:53', 1),
(4, 5, 1, 10, 0, 0, NULL, 200.00, '2025-09-24 01:19:54', '2025-09-24 01:19:54', 1),
(5, 6, 3, 1, 0, 0, NULL, 20.00, '2025-09-24 01:46:17', '2025-09-24 01:46:17', 1),
(6, 7, 3, 3, 0, 0, NULL, 100.00, '2025-09-26 23:13:22', '2025-09-26 23:13:22', 3),
(7, 7, 1, 1, 0, 0, NULL, 500.00, '2025-09-26 23:13:22', '2025-09-26 23:13:22', 3),
(8, 8, 4, 1, 0, 0, NULL, 0.01, '2025-09-26 23:36:41', '2025-09-26 23:36:41', 3),
(9, 9, 3, 1, 0, 0, NULL, 0.01, '2025-09-26 23:46:32', '2025-09-26 23:46:32', 1),
(10, 10, 5, 2, 2, 0, NULL, 500.00, '2025-09-27 05:36:01', '2025-09-27 05:36:01', 3),
(11, 10, 4, 1, 0, 0, NULL, 1.00, '2025-09-27 05:36:01', '2025-09-27 05:36:01', 3),
(12, 11, 7, 5, 0, 0, NULL, 100.00, '2025-10-16 04:54:47', '2025-10-16 04:54:47', 3),
(13, 11, 3, 3, 0, 0, NULL, 250.00, '2025-10-16 04:54:47', '2025-10-16 04:54:47', 3),
(14, 12, 5, 1, 0, 0, NULL, 5.00, '2025-10-16 04:58:03', '2025-10-16 04:58:03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('s4K5i7GaWKOSXXOJ0WmFanqXmkGMEWJblBcktdWq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2Q0SjZqd0ZoRkxMWDhXa3MxdEhQSVByNW5nSEUxQjhicDlPZ2hjSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXQtcGFzc3dvcmQvMTk1YmRjNmRjYTdmYmEyY2ZkYzcyYTgzYjc3Mzc5NDI2MDdlNDIwOGE3ZWU2ODYyZDhmOGNkOTRiMDNjNjg0ZD9lbWFpbD1uYWR1bnJhdmluZHJhJTQwZ21haWwuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763538202),
('WZcG5kbfDcs5Kkyz2YTqq2dDsbpkldJvuvBkHieW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOHkyZ3VwVUFESFhJd1BXc0xSUjdKOXZpMVpCUkpMcjd1QnBvcjVNcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1763542745);

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'posted',
  `qty` int(11) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_id`, `warehouse_id`, `type`, `status`, `qty`, `reference`, `notes`, `attachment_path`, `user_id`, `created_at`, `updated_at`, `approved_at`, `approved_by`) VALUES
(1, 3, 3, 'IN', 'posted', 5, 'PO-0001', 'hkjy', NULL, 1, '2025-09-19 03:14:41', '2025-09-19 03:14:41', NULL, NULL),
(2, 1, 3, 'IN', 'posted', 5, 'PO-0002', 'good', NULL, 1, '2025-09-19 03:31:51', '2025-09-19 03:31:51', NULL, NULL),
(3, 1, 3, 'IN', 'posted', 15, NULL, 'kloii', NULL, 1, '2025-09-22 04:29:40', '2025-09-22 04:29:40', NULL, NULL),
(4, 1, 3, 'IN', 'posted', 20, 'PO-20250922-050331', NULL, NULL, 1, '2025-09-22 04:46:32', '2025-09-22 04:46:32', NULL, NULL),
(5, 1, 3, 'IN', 'posted', 5, 'PO-2', 'kjjhytg', NULL, 2, '2025-09-23 18:30:00', '2025-09-24 01:04:16', NULL, NULL),
(6, 1, 3, 'OUT', 'posted', 2, 'TRF-6', 'Transfer out', NULL, 2, '2025-09-25 04:34:36', '2025-09-25 04:34:36', NULL, NULL),
(7, 1, 1, 'IN', 'posted', 2, 'TRF-6', 'Transfer in', NULL, 2, '2025-09-25 04:34:36', '2025-09-25 04:34:36', NULL, NULL),
(8, 7, 3, 'IN', 'posted', 2, NULL, NULL, NULL, 1, '2025-10-16 04:47:31', '2025-10-16 04:47:31', NULL, NULL),
(9, 7, 3, 'TRANSFER', 'posted', -2, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"approved\"}', NULL, 1, '2025-10-16 22:10:12', '2025-10-16 22:11:17', NULL, NULL),
(10, 7, 3, 'OUT', 'posted', -2, 'Transfer: Transfer Request', 'Approved transfer request #9', NULL, 1, '2025-10-16 22:11:17', '2025-10-16 22:11:17', NULL, NULL),
(11, 7, 1, 'IN', 'posted', 2, 'Transfer: Transfer Request', 'Approved transfer request #9', NULL, 1, '2025-10-16 22:11:17', '2025-10-16 22:11:17', NULL, NULL),
(12, 7, 3, 'TRANSFER', 'posted', -1, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"approved\"}', NULL, 1, '2025-10-16 22:16:36', '2025-10-16 22:17:02', NULL, NULL),
(13, 7, 3, 'OUT', 'posted', -1, 'Transfer: Transfer Request', 'Approved transfer request #12', NULL, 1, '2025-10-16 22:17:02', '2025-10-16 22:17:02', NULL, NULL),
(14, 7, 1, 'IN', 'posted', 1, 'Transfer: Transfer Request', 'Approved transfer request #12', NULL, 1, '2025-10-16 22:17:02', '2025-10-16 22:17:02', NULL, NULL),
(15, 7, 3, 'TRANSFER', 'posted', -1, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"approved\"}', NULL, 1, '2025-10-16 22:26:22', '2025-10-16 22:39:03', NULL, NULL),
(16, 7, 3, 'OUT', 'posted', -1, 'Transfer: Transfer Request', 'Approved transfer request #15', NULL, 1, '2025-10-16 22:39:03', '2025-10-16 22:39:03', NULL, NULL),
(17, 7, 1, 'IN', 'posted', 1, 'Transfer: Transfer Request', 'Approved transfer request #15', NULL, 1, '2025-10-16 22:39:03', '2025-10-16 22:39:03', NULL, NULL),
(18, 7, 3, 'TRANSFER', 'posted', -1, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"pending\"}', NULL, 1, '2025-10-16 22:40:42', '2025-10-16 22:40:42', NULL, NULL),
(19, 7, 3, 'TRANSFER_REQ', 'posted', -1, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"approved\",\"approved_by\":1,\"approved_at\":\"2025-10-17 04:29:53\"}', NULL, 1, '2025-10-16 22:58:07', '2025-10-16 22:59:53', NULL, NULL),
(20, 7, 3, 'OUT', 'posted', -1, 'Transfer: Transfer Request', 'Approved transfer #19', NULL, 1, '2025-10-16 22:59:53', '2025-10-16 22:59:53', NULL, NULL),
(21, 7, 1, 'IN', 'posted', 1, 'Transfer: Transfer Request', 'Approved transfer #19', NULL, 1, '2025-10-16 22:59:53', '2025-10-16 22:59:53', NULL, NULL),
(22, 6, 3, 'TRANSFER_REQ', 'posted', -1, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"approved\",\"approved_by\":1,\"approved_at\":\"2025-10-17 04:36:03\"}', NULL, 1, '2025-10-16 23:05:47', '2025-10-16 23:06:03', NULL, NULL),
(23, 6, 3, 'OUT', 'posted', -1, 'Transfer: Transfer Request', 'Approved transfer #22', NULL, 1, '2025-10-16 23:06:03', '2025-10-16 23:06:03', NULL, NULL),
(24, 6, 1, 'IN', 'posted', 1, 'Transfer: Transfer Request', 'Approved transfer #22', NULL, 1, '2025-10-16 23:06:03', '2025-10-16 23:06:03', NULL, NULL),
(25, 6, 3, 'TRANSFER_REQ', 'posted', -2, 'Transfer Request', '{\"to_warehouse_id\":\"1\",\"notes\":null,\"status\":\"approved\",\"approved_by\":1,\"approved_at\":\"2025-10-17 06:23:52\"}', NULL, 1, '2025-10-16 23:10:07', '2025-10-17 00:53:52', NULL, NULL),
(26, 6, 3, 'OUT', 'posted', -2, 'Transfer: Transfer Request', 'Approved transfer #25', NULL, 1, '2025-10-17 00:53:52', '2025-10-17 00:53:52', NULL, NULL),
(27, 6, 1, 'IN', 'posted', 2, 'Transfer: Transfer Request', 'Approved transfer #25', NULL, 1, '2025-10-17 00:53:52', '2025-10-17 00:53:52', NULL, NULL),
(28, 5, 3, 'IN', 'posted', 2, 'PO Item #10', NULL, NULL, 3, '2025-11-06 00:23:11', '2025-11-06 00:23:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfers`
--

CREATE TABLE `stock_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `from_warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `to_warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `requested_by` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_transfers`
--

INSERT INTO `stock_transfers` (`id`, `product_id`, `from_warehouse_id`, `to_warehouse_id`, `qty`, `reason`, `status`, `requested_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 3, 'kjhyttf', 'pending', 3, NULL, '2025-09-25 00:26:34', '2025-09-25 00:26:34'),
(2, 1, 1, 3, 3, 'rtgyh', 'pending', 3, NULL, '2025-09-25 01:36:05', '2025-09-25 01:36:05'),
(3, 1, 1, 3, 4, 'sadfrr', 'pending', 3, NULL, '2025-09-25 01:50:30', '2025-09-25 01:50:30'),
(4, 1, 1, 3, 5, 'good', 'pending', 3, NULL, '2025-09-25 01:55:25', '2025-09-25 01:55:25'),
(5, 1, 1, 3, 5, 'good', 'pending', 3, NULL, '2025-09-25 02:00:21', '2025-09-25 02:00:21'),
(6, 1, 3, 1, 2, 'swderf', 'approved', 3, 2, '2025-09-25 04:34:11', '2025-09-25 04:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `contact_name`, `address`, `is_active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Nadun Wijerathne', 'nadunravindra@gmail.com', '0771167521', 'Nadun Wijerathne', 'Udispattuwa', 1, 'hgtrd', '2025-09-20 05:22:17', '2025-09-20 05:22:17'),
(2, 'PC', 'PCstore@gmail.com', '0742586987', NULL, 'kandy', 1, NULL, '2025-09-27 05:34:22', '2025-09-27 05:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Inventory Manager','Clerk','Viewer') NOT NULL DEFAULT 'Viewer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'nadunravindra@gmail.com', NULL, '$2y$12$0VApQCikrQsDmt4WKl9Qd.JywlIrz1Q7bitr3z5JhEdR5KAfT3no6', 'Admin', NULL, '2025-09-17 03:44:58', '2025-09-27 05:20:12'),
(2, 'Manager', 'manager@example.com', NULL, '$2y$12$S9vPTk3UgEl23SWIPFh.nOCkQ7ItT44Qho05B7BVG.Knki8jnKhK6', 'Inventory Manager', NULL, '2025-09-17 22:06:39', '2025-09-17 22:06:39'),
(3, 'Clerk', 'clerk@example.com', NULL, '$2y$12$QNrWd/OzmCBCo2EUKRP3/.6s/zHhu5mDkn7gW8xwfRJjvZJK/XgPy', 'Clerk', NULL, '2025-09-17 22:06:39', '2025-09-18 02:41:37'),
(4, 'Viewer', 'viewer@example.com', NULL, '$2y$12$iztJZnUWLPqBsuPAuAQe0OI6x8mt3xru8QzC/v.ssrCccnGOEfq1i', 'Viewer', NULL, '2025-09-17 22:06:40', '2025-09-17 22:06:40'),
(5, 'Dhananjalie', 'dahana@gmail.com', NULL, '$2y$12$SHQxnC2hUtjvMyPDITiFRuA2BZGIZxE5oMo3axIWWCInpjy920CF6', 'Viewer', NULL, '2025-09-18 05:04:12', '2025-09-18 05:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `code`, `name`, `location`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'WH01', 'Main warehouse', 'Kundasale', 1, '2025-09-18 10:20:07', '2025-09-18 10:20:25'),
(3, 'WH02', 'Sub Warehouse', 'Kundasale', 1, '2025-09-19 03:05:47', '2025-09-19 03:05:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_event_subject_type_subject_id_index` (`event`,`subject_type`,`subject_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_event_subject_type_subject_id_index` (`event`,`subject_type`,`subject_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_levels`
--
ALTER TABLE `inventory_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inv_levels_prod_wh_unique` (`product_id`,`warehouse_id`),
  ADD KEY `inventory_levels_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `inventory_levels_product_id_warehouse_id_index` (`product_id`,`warehouse_id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`);

--
-- Indexes for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_suppliers_product_id_supplier_id_unique` (`product_id`,`supplier_id`),
  ADD KEY `product_suppliers_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_po_number_unique` (`po_number`),
  ADD KEY `purchase_orders_created_by_foreign` (`created_by`),
  ADD KEY `purchase_orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `po_number_idx` (`po_number`),
  ADD KEY `po_status_expected_idx` (`status`,`expected_date`),
  ADD KEY `purchase_orders_status_index` (`status`),
  ADD KEY `purchase_orders_expected_date_index` (`expected_date`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_items_product_id_foreign` (`product_id`),
  ADD KEY `purchase_order_items_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `poi_po_prod_wh_idx` (`purchase_order_id`,`product_id`,`warehouse_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_user_id_foreign` (`user_id`),
  ADD KEY `movements_prod_wh_type_idx` (`product_id`,`warehouse_id`,`type`),
  ADD KEY `sm_prod_wh_idx` (`product_id`,`warehouse_id`),
  ADD KEY `sm_ref_prod_wh_idx` (`reference`,`product_id`,`warehouse_id`),
  ADD KEY `stock_movements_status_type_index` (`status`,`type`),
  ADD KEY `stock_movements_product_id_index` (`product_id`),
  ADD KEY `stock_movements_warehouse_id_index` (`warehouse_id`),
  ADD KEY `stock_movements_created_at_index` (`created_at`);

--
-- Indexes for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transfers_product_id_foreign` (`product_id`),
  ADD KEY `stock_transfers_from_warehouse_id_foreign` (`from_warehouse_id`),
  ADD KEY `stock_transfers_to_warehouse_id_foreign` (`to_warehouse_id`),
  ADD KEY `stock_transfers_requested_by_foreign` (`requested_by`),
  ADD KEY `stock_transfers_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_index` (`role`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warehouses_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_levels`
--
ALTER TABLE `inventory_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_levels`
--
ALTER TABLE `inventory_levels`
  ADD CONSTRAINT `inventory_levels_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_levels_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  ADD CONSTRAINT `product_suppliers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_suppliers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_items_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stock_movements_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transfers`
--
ALTER TABLE `stock_transfers`
  ADD CONSTRAINT `stock_transfers_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stock_transfers_from_warehouse_id_foreign` FOREIGN KEY (`from_warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transfers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transfers_requested_by_foreign` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_transfers_to_warehouse_id_foreign` FOREIGN KEY (`to_warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
