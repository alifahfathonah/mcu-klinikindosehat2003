-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 05:31 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcu_klinikindosehat2003`
--

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `name`, `address`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`) VALUES
(1, 'Klinik Indosehat 2003 Cilincing', 'Eks. Komp. Gaya Motor Jl. Isuzu No. 32 RT. 004 RW. 008 Semper Timur, Cilincing, Jakarta Utara', '2021-08-31 09:00:47', NULL, 0, NULL),
(2, 'Klinik Indosehat 2003 Semarang', 'Jl. Anjasmoro Raya No. 38-A/7 Karangayu, Semarang Barat', '2021-08-31 09:00:47', NULL, 0, NULL),
(3, 'Klinik Indosehat 2003 Surabaya', 'Jl. Sultan Iskandar Muda (Danakarya) No. 12-14 Blok 1 Kel. Ujung Kec. Semampir, Surabaya', '2021-08-31 09:00:47', NULL, 0, NULL),
(4, 'Klinik Indosehat 2003 Tegal', 'Jl. Kapten Sudibyo No. 128/I Kemandungan, Tegal Barat', '2021-08-31 09:00:47', NULL, 0, NULL),
(5, 'Klinik Indosehat 2003 Warakas', 'Klinik Indosehat 2003 Warakas', '2021-08-31 09:00:47', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mcus_v1`
--

CREATE TABLE `mcus_v1` (
  `id` int(11) NOT NULL,
  `medical_record_number` varchar(128) NOT NULL,
  `mcu_manual` varchar(32) DEFAULT NULL,
  `id_clinic` int(11) NOT NULL DEFAULT 0,
  `id_patient` int(11) NOT NULL,
  `id_number_patient` varchar(128) NOT NULL,
  `name_patient` varchar(128) NOT NULL,
  `no_transaction` varchar(128) NOT NULL,
  `type_examination` enum('umum','rev','mcu') NOT NULL,
  `is_fit` enum('0','1','2') DEFAULT NULL,
  `date_examination` date NOT NULL,
  `validity_period` enum('0','1') NOT NULL DEFAULT '0',
  `image` text NOT NULL,
  `qrcode` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mcus_v2`
--

CREATE TABLE `mcus_v2` (
  `id` int(11) NOT NULL,
  `medical_record_number` varchar(128) NOT NULL,
  `alcohol_history` enum('0','1') DEFAULT NULL,
  `allergic_history` enum('0','1') DEFAULT NULL,
  `amputation` enum('0','1') DEFAULT NULL,
  `blood_disorder` enum('0','1') DEFAULT NULL,
  `balance_problem` enum('0','1') DEFAULT NULL,
  `back_or_joint_problem` enum('0','1') DEFAULT NULL,
  `colour_blindness` enum('0','1') DEFAULT NULL,
  `cancer` enum('0','1') DEFAULT NULL,
  `diabetes` enum('0','1') DEFAULT NULL,
  `digestive_disorder` enum('0','1') DEFAULT NULL,
  `depresion` enum('0','1') DEFAULT NULL,
  `epilepsy` enum('0','1') DEFAULT NULL,
  `eye_vision_problem` enum('0','1') DEFAULT NULL,
  `ear_problem` enum('0','1') DEFAULT NULL,
  `fracture` enum('0','1') DEFAULT NULL,
  `genital_disorder` enum('0','1') DEFAULT NULL,
  `heart_surgery` enum('0','1') DEFAULT NULL,
  `heart_disease` enum('0','1') DEFAULT NULL,
  `high_blood_pressure` enum('0','1') DEFAULT NULL,
  `hernia` enum('0','1') DEFAULT NULL,
  `infectious_disease` enum('0','1') DEFAULT NULL,
  `kidney_problem` enum('0','1') DEFAULT NULL,
  `lung_disease` enum('0','1') DEFAULT NULL,
  `liver_problem` enum('0','1') DEFAULT NULL,
  `lost_of_memory` enum('0','1') DEFAULT NULL,
  `narcotic_history` enum('0','1') DEFAULT NULL,
  `neurogical_disease` enum('0','1') DEFAULT NULL,
  `operation_surgery` enum('0','1') DEFAULT NULL,
  `psychiatric_problem` enum('0','1') DEFAULT NULL,
  `restricted_mobility` enum('0','1') DEFAULT NULL,
  `skin_problem` enum('0','1') DEFAULT NULL,
  `sleep_problem` enum('0','1') DEFAULT NULL,
  `thyroid_problem` enum('0','1') DEFAULT NULL,
  `tuberculosis` enum('0','1') DEFAULT NULL,
  `height` decimal(6,2) UNSIGNED DEFAULT NULL,
  `weight` decimal(6,2) UNSIGNED DEFAULT NULL,
  `blood_pressure` varchar(128) DEFAULT NULL,
  `pulse_regular` decimal(6,2) UNSIGNED DEFAULT NULL,
  `respiratory_rate` decimal(6,2) UNSIGNED DEFAULT NULL,
  `right_eye_without` varchar(128) DEFAULT NULL,
  `left_eye_without` varchar(128) DEFAULT NULL,
  `both_eye_without` varchar(128) DEFAULT NULL,
  `right_eye_with` varchar(128) DEFAULT NULL,
  `left_eye_with` varchar(128) DEFAULT NULL,
  `both_eye_with` varchar(128) DEFAULT NULL,
  `color_vision` enum('0','1','2') DEFAULT NULL,
  `general_appearance` enum('0','1') DEFAULT NULL,
  `eyes` enum('0','1') DEFAULT NULL,
  `ears` enum('0','1') DEFAULT NULL,
  `nose` enum('0','1') DEFAULT NULL,
  `mouth` enum('0','1') DEFAULT NULL,
  `throat` enum('0','1') DEFAULT NULL,
  `neck` enum('0','1') DEFAULT NULL,
  `throid` enum('0','1') DEFAULT NULL,
  `lymp_node` enum('0','1') DEFAULT NULL,
  `lungs` enum('0','1') DEFAULT NULL,
  `hearts` enum('0','1') DEFAULT NULL,
  `abdomen` enum('0','1') DEFAULT NULL,
  `urogenital_system` enum('0','1') DEFAULT NULL,
  `upper_extremities` enum('0','1') DEFAULT NULL,
  `lower_extremities` enum('0','1') DEFAULT NULL,
  `back_abnormality` enum('0','1') DEFAULT NULL,
  `hernia_2` enum('0','1') DEFAULT NULL,
  `central_nervous_system` enum('0','1') DEFAULT NULL,
  `skin_nails` enum('0','1') DEFAULT NULL,
  `speech` enum('0','1') DEFAULT NULL,
  `other` enum('0','1') DEFAULT NULL,
  `right_ear` enum('0','1') DEFAULT NULL,
  `left_ear` enum('0','1') DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mcus_v3`
--

CREATE TABLE `mcus_v3` (
  `id` int(11) NOT NULL,
  `medical_record_number` varchar(128) NOT NULL,
  `haemoglobin` decimal(6,2) DEFAULT NULL,
  `white_blood_cell_count` decimal(6,2) DEFAULT NULL,
  `esr` decimal(6,2) DEFAULT NULL,
  `haematoerit` int(11) DEFAULT NULL,
  `trombosit` int(11) DEFAULT NULL,
  `basophil` int(11) DEFAULT NULL,
  `eosinophil` int(11) DEFAULT NULL,
  `stab` int(11) DEFAULT NULL,
  `segment` int(11) DEFAULT NULL,
  `limphocyte` int(11) DEFAULT NULL,
  `monocyt` int(11) DEFAULT NULL,
  `gdp` int(11) DEFAULT NULL,
  `blood_sugar_2_pp` int(11) DEFAULT NULL,
  `sgot` int(11) DEFAULT NULL,
  `sgpt` int(11) DEFAULT NULL,
  `creatinin` decimal(6,2) DEFAULT NULL,
  `total_cholestrol` int(11) DEFAULT NULL,
  `triglyseride` int(11) DEFAULT NULL,
  `asam_urat` decimal(6,2) DEFAULT NULL,
  `ureum` int(11) DEFAULT NULL,
  `hdl` int(11) DEFAULT NULL,
  `ldl` int(11) DEFAULT NULL,
  `vdrl` enum('0','1') DEFAULT NULL,
  `hbsag` enum('0','1') DEFAULT NULL,
  `spesific_gravity` int(11) DEFAULT NULL,
  `albumin` enum('0','1') DEFAULT NULL,
  `glucose` enum('0','1') DEFAULT NULL,
  `ph` decimal(6,2) DEFAULT NULL,
  `epithels_hpf` enum('0','1') DEFAULT NULL,
  `wbc_hpf` varchar(128) DEFAULT NULL,
  `rbc_hpf` varchar(128) DEFAULT NULL,
  `cast` enum('0','1') DEFAULT NULL,
  `crystal` enum('0','1') DEFAULT NULL,
  `bacteria` enum('0','1') DEFAULT NULL,
  `other_2` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `id_number` varchar(128) NOT NULL,
  `passport_number` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` varchar(128) NOT NULL,
  `place_of_birth` varchar(128) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text DEFAULT NULL,
  `basic_safety_training` varchar(128) NOT NULL,
  `nationality` varchar(128) NOT NULL,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `occupation` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `no_transaction` varchar(128) NOT NULL,
  `id_clinic` int(11) NOT NULL DEFAULT 0,
  `id_patient` int(11) NOT NULL,
  `id_company` int(11) NOT NULL DEFAULT 0,
  `medical_record_number` varchar(128) NOT NULL,
  `patient_name` varchar(128) NOT NULL,
  `patient_id_number` varchar(128) NOT NULL,
  `type_examination` enum('umum','rev','mcu') NOT NULL,
  `type_transaction` enum('cash','debit','company') NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `site` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `site`, `created_at`, `updated_at`) VALUES
(1, 'Superuser', 'superuser@gmail.com', '$2y$10$26Q/lgzQS3F31FVTf6hs9uMD.f41eQIFlJhC8wVnWB7UwtQJfenbu', 'superuser', 1, 0, '2021-08-31 08:58:01', NULL),
(2, 'Admin Cilincing', 'admincilincing@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'admin', 1, 1, '2021-08-31 09:10:12', '2021-09-01 04:25:39'),
(3, 'Doctor Cilincing', 'doctorcilincing@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'doctor', 1, 1, '2021-08-31 09:10:12', '2021-09-01 06:53:36'),
(4, 'Admin Semarang', 'adminsemarang@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'admin', 1, 2, '2021-08-31 09:10:12', '2021-09-01 04:26:46'),
(5, 'Doctor Semarang', 'doctorsemarang@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'doctor', 1, 2, '2021-08-31 09:10:12', '2021-09-01 06:53:42'),
(6, 'Admin Surabaya', 'adminsurabaya@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'admin', 1, 3, '2021-08-31 09:10:12', '2021-09-01 04:27:10'),
(7, 'Doctor Surabaya', 'doctorsurabaya@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'doctor', 1, 3, '2021-08-31 09:10:12', '2021-09-01 06:53:48'),
(8, 'Admin Tegal', 'admintegal@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'admin', 1, 4, '2021-08-31 09:10:12', '2021-09-01 04:27:46'),
(9, 'Doctor Tegal', 'doctortegal@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'doctor', 1, 4, '2021-08-31 09:10:12', '2021-09-01 06:53:52'),
(10, 'Admin Warakas', 'adminwarakas@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'admin', 1, 5, '2021-08-31 09:10:12', '2021-09-01 04:28:03'),
(11, 'Doctor Warakas', 'doctorwarakas@indosehat2003.com', '$2y$10$T.nw8mRv2ugeIqXZCEU.zeuZFrToxsZHljufVfm6KUJSBYz1tblfe', 'doctor', 1, 5, '2021-08-31 09:10:12', '2021-09-01 06:53:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcus_v1`
--
ALTER TABLE `mcus_v1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mrn` (`medical_record_number`),
  ADD UNIQUE KEY `no_transaction` (`no_transaction`),
  ADD UNIQUE KEY `mcu_manual` (`mcu_manual`);

--
-- Indexes for table `mcus_v2`
--
ALTER TABLE `mcus_v2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mrn` (`medical_record_number`);

--
-- Indexes for table `mcus_v3`
--
ALTER TABLE `mcus_v3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mrn` (`medical_record_number`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_transaction` (`no_transaction`),
  ADD UNIQUE KEY `mrn` (`medical_record_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcus_v1`
--
ALTER TABLE `mcus_v1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcus_v2`
--
ALTER TABLE `mcus_v2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcus_v3`
--
ALTER TABLE `mcus_v3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
