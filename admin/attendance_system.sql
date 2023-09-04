-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2023 at 08:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent_student`
--

CREATE TABLE `absent_student` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `absent_date` varchar(200) NOT NULL,
  `branch_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absent_student`
--

INSERT INTO `absent_student` (`id`, `student_id`, `absent_date`, `branch_id`) VALUES
(4, 3, '2023-09-02', 5),
(5, 4, '2023-09-02', 5),
(6, 3, '2023-09-03', 5);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `phone`, `password`) VALUES
(1, 'admin', '', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `attend_date` varchar(200) NOT NULL,
  `attend_time` varchar(150) NOT NULL,
  `branch_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `attend_date`, `attend_time`, `branch_id`) VALUES
(20, 4, '2023-09-03', '9/3/2023 6:20 AM', 5),
(21, 4, '2023-09-03', '9/3/2023 7:02 AM', 5),
(22, 2, '2023-09-03', '9/3/2023 12:25 PM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `from_date` varchar(200) NOT NULL,
  `to_date` varchar(200) NOT NULL,
  `teacher_name` varchar(200) NOT NULL,
  `student_num` int NOT NULL,
  `course_desc` text NOT NULL,
  `course_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `from_date`, `to_date`, `teacher_name`, `student_num`, `course_desc`, `course_image`) VALUES
(1, 'الكورس الاول تعديل ', '2023-09-04', '2023-09-13', 'محمد رمضان ', 10, 'وصف الكورس ', 'dklcmkm.jpg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `main_university`
--

CREATE TABLE `main_university` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `main_university`
--

INSERT INTO `main_university` (`id`, `name`, `email`, `location`) VALUES
(2, 'الجهه  الرئيسية   الاولي ', 'mr319242@gmail.com', 'الموقع الاول '),
(4, 'الجهه  الرئيسية الثانية ', 'mr319242@gmail.com', 'الموقع الاول ');

-- --------------------------------------------------------

--
-- Table structure for table `public_supervisor`
--

CREATE TABLE `public_supervisor` (
  `id` int NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `kind` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `employe_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `public_supervisor`
--

INSERT INTO `public_supervisor` (`id`, `user_name`, `name`, `kind`, `id_number`, `employe_name`, `email`, `phone`, `password`) VALUES
(2, 'main_super', 'محمد رمضان السيد ابو سالم ', 'ذكر', '0100229285610', 'مبرمج ', 'mr319242@gmail.com', '+201011642731', '11111111');

-- --------------------------------------------------------

--
-- Table structure for table `registeration`
--

CREATE TABLE `registeration` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `specialist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `university_branch` int DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `kind` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `employe_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `university_branch`, `name`, `kind`, `id_number`, `employe_name`, `email`, `phone`) VALUES
(2, 2, 'محمد رمضان السيد', 'ذكر', '01002292856', 'مبرمج ', 'mr319242@gmail.com', '+201011642731'),
(3, 5, 'لمار محمد ', 'ذكر', '01002292856sd', 'مبرمج ', 'mr319242@gmail.com', '1011642731'),
(4, 5, 'احمد محمد ', 'انثي', '0100229285610', 'مبرمج ', 'mr319242@gmail.com', '1011642731');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int NOT NULL,
  `university_branch` int DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `kind` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `employe_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `university_branch`, `name`, `kind`, `id_number`, `employe_name`, `email`, `phone`, `user_name`, `password`) VALUES
(4, 2, 'mohamed ramadan', 'ذكر', '01002292856', 'مشرف ', 'mr319242@gmail.com', '1011642731', 'super1', '11111111'),
(5, 5, 'ali mohamed ', 'انثي', '01002292856sd', 'مشرف ', 'mr3192s42@gmail.com', '+201011642731', 'super2', '11111111');

-- --------------------------------------------------------

--
-- Table structure for table `university_branches`
--

CREATE TABLE `university_branches` (
  `id` int NOT NULL,
  `main_university` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `university_branches`
--

INSERT INTO `university_branches` (`id`, `main_university`, `name`, `email`, `location`) VALUES
(2, 2, 'الجهه الاولي ', 'mr319242@gmail.com', 'الموقع الاول '),
(3, 2, 'الجهه الثانية ', 'mr319242@gmail.com', 'Menoufia'),
(5, 4, 'فرع دمنهور ', 'mr319242@gmail.com', 'alex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absent_student`
--
ALTER TABLE `absent_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_link` (`student_id`),
  ADD KEY `brach_link` (`branch_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_link` (`student_id`),
  ADD KEY `brach_links` (`branch_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_university`
--
ALTER TABLE `main_university`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_supervisor`
--
ALTER TABLE `public_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registeration`
--
ALTER TABLE `registeration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD KEY `employee_branch` (`university_branch`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_number` (`id_number`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `employee_branch` (`university_branch`);

--
-- Indexes for table `university_branches`
--
ALTER TABLE `university_branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_univer` (`main_university`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absent_student`
--
ALTER TABLE `absent_student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `main_university`
--
ALTER TABLE `main_university`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `public_supervisor`
--
ALTER TABLE `public_supervisor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registeration`
--
ALTER TABLE `registeration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `university_branches`
--
ALTER TABLE `university_branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absent_student`
--
ALTER TABLE `absent_student`
  ADD CONSTRAINT `brach_link` FOREIGN KEY (`branch_id`) REFERENCES `university_branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_link` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `brach_links` FOREIGN KEY (`branch_id`) REFERENCES `university_branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_link` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `student_branch` FOREIGN KEY (`university_branch`) REFERENCES `university_branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `employee_branch` FOREIGN KEY (`university_branch`) REFERENCES `university_branches` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `university_branches`
--
ALTER TABLE `university_branches`
  ADD CONSTRAINT `main_univer` FOREIGN KEY (`main_university`) REFERENCES `main_university` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
