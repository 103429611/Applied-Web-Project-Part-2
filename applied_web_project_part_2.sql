-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: May 14, 2026 at 06:08 AM
-- Server version: 8.4.9
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `applied web project part 2`
--
CREATE DATABASE IF NOT EXISTS `applied web project part 2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `applied web project part 2`;

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
CREATE TABLE `contributions` (
  `firstname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `studentid` int NOT NULL,
  `part_1_contributions` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `part_2_contributions` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quote` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `quote_in_different_lang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`firstname`, `lastname`, `studentid`, `part_1_contributions`, `part_2_contributions`, `quote`, `quote_in_different_lang`) VALUES
('Ashley', 'Butler', 103429611, 'CSS files, jobs.html, submitti', '', 'I choose a lazy person to do a hard job. Because a', '「私は難しい仕事には怠け者を選ぶ。なぜなら、怠け者は楽な方法を見つけるからだ。'),
('William', 'Lloyd', 105913190, 'CSS files, about.html', '', 'Good morning China. Now I have ice cream', '早上好中国.现在我有冰淇淋'),
('Noor', 'Fatima Nisar', 106216609, 'CSS files, index.html', '', 'It is very difficult to keep a lamp lit in the mid', 'بہت مشکل ہے، آندھیوں میں چراغ جلانا'),
('Alex', 'Stanford', 106340883, 'CSS files, apply.html', '', 'We must choose between champagne for a few or drin', 'Il faut choisir entre le champagne pour quelques-u');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

DROP TABLE IF EXISTS `eoi`;
CREATE TABLE `eoi` (
  `eoi number` int NOT NULL,
  `reference` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `suburb` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `postcode` int NOT NULL,
  `state` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` int NOT NULL,
  `skills` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `other_skills` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `job_ref` int NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `salary` int NOT NULL,
  `reports_to` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `essential_requirements` text COLLATE utf8mb4_general_ci NOT NULL,
  `pref_requirements` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_ref`, `job_title`, `salary`, `reports_to`, `description`, `essential_requirements`, `pref_requirements`) VALUES
(10000, 'AI Implementation Lead', 80000, 'Opperations Manager', 'We are looking for a AI Implementation Lead to work closely with a field deployment team and alongside our existing tech development team to implement a range of AI features into our quickly growing fleet of cameras and monitoring equipment that will be rolled out across a number of local, state and federal governments\r\n', 'A stong and up to date understanding of AI infrustructure , 3 years of senior team leadership , A can do attitude that is able to work around a dynamic team enviroment', 'A background in vibe coding and ai agent coordination , \r\nA vehicle and current license to travel to deployment locations , \r\nThe ability to have a laugh with the team'),
(10001, 'Public Liaison Officer', 62000, 'Public Liason Lead', 'As a Public Liaison Officer, your main responsibilities will include: Scouting of potential future deployment locations, gauging of current public sentiment around AI and safety monitoring systems, reporting to the Public Liaison Lead around methods and tactics to go forth with deployments in a friendly and compelling way taking into about business needs while balancing public feedback.', 'A current and valid driving license , \r\nA working vehicle capable of carrying light equipment such as cameras , \r\n3 years in a public facing role', 'Customer service management , \r\nOffice 365 and adobe suite , \r\nA taste for good jokes and coffee'),
(10002, 'Privacy & Compliance Officer', 115000, 'Operations Manager', 'As we scale our camera network, ensuring we meet strict government data protection standards is paramount. You will be responsible for auditing our AI data handling processes, drafting privacy impact assessments, and ensuring all field deployments comply with local and federal surveillance regulations.', 'Degree in Law or Public Policy, 2 years experience in data privacy (GDPR/APP), Deep understanding of facial redaction and data anonymization standards', 'CIPP certification, Experience with government tender processes, A knack for explaining complex legal jargon to engineers'),
(10003, 'Hardware Deployment Technician', 85000, 'AI Implementation Lead', 'This is a boots-on-the-ground role focused on the physical installation and calibration of our smart camera units. You will be mounting hardware on various municipal infrastructure, ensuring connectivity to the central AI hub, and troubleshooting hardware-software integration in the field.', 'Proven experience in electrical or telecommunications hardware installation, Ability to work at heights, Basic networking knowledge (IP addresses, POE, Routers)', 'Working at Heights certification, Experience with ruggedized IoT hardware, A solid playlist for long drives between sites'),
(10004, 'Computer Vision Specialist', 165000, 'AI Implementation Lead', 'We need a specialist to refine our edge-processing algorithms. You will work on optimizing object detection (vehicles, pedestrians, incidents) to run efficiently on low-power hardware while maintaining high accuracy in varied lighting and weather conditions.', 'Master’s or PhD in Computer Science or related field, Proficiency in Python and C++, Deep experience with TensorFlow or PyTorch', 'Experience with NVIDIA Jetson or similar edge computing platforms, Published research in CV, The ability to stay calm when the code breaks at 4 PM'),
(10005, 'Data Labeling Coordinator', 72000, 'Public Liaison Lead', 'Quality data is the lifeblood of our AI. You will manage a team of remote annotators, defining the labeling guidelines for \"incident detection\" and \"public safety events,\" and performing QA on the datasets before they are used to retrain our models.', '2 years in a data-centric or administrative role, High attention to detail, Proficiency in project management software like Jira or Trello', 'Experience with CVAT or Labelbox, Basic understanding of machine learning loops, An obsession with organized spreadsheets'),
(10006, 'Government Relations Manager', 140000, 'Operations Manager', 'You will be the primary bridge between our technical team and city council stakeholders. Your goal is to secure new deployment permits, present safety data reports to committees, and ensure our AI initiatives align with broader \"Smart City\" urban planning goals.', '5 years experience in government relations or urban planning, Exceptional presentation and negotiation skills, Experience managing multi-year government contracts', 'Existing network within state or local government departments, Background in urban tech, Ability to pivot strategies based on political shifts'),
(10007, 'Edge Connectivity Engineer', 130000, 'AI Implementation Lead', 'Your mission is to ensure our fleet of cameras stays online in the most challenging urban environments. You will design and maintain the 5G and mesh network architectures that allow our AI units to transmit telemetry and critical alerts back to government dashboards in real-time.', 'Degree in Network Engineering or similar, Deep knowledge of 4G/5G LTE protocols and VPN tunneling, Experience with outdoor wireless hardware', 'Cisco or CompTIA Network+ certification, Experience with SD-WAN, A high tolerance for troubleshooting connectivity in the rain'),
(10008, 'Urban Safety Analyst', 95000, 'Operations Manager', 'You will take the raw data generated by our AI cameras and turn it into actionable insights for city planners. This involves creating heatmaps of traffic congestion, identifying \"near-miss\" accident hotspots, and drafting reports that justify the continued rollout of safety infrastructure.', 'Strong background in Data Analysis and Statistics, Proficiency in SQL and Tableau/PowerBI, Experience with GIS (Geographic Information Systems)', 'Background in Urban Planning or Civil Engineering, Experience with predictive modeling, The ability to tell a story through data'),
(10009, 'Field Operations Coordinator', 78000, 'Operations Manager', 'This role is the glue between the office and the street. You will manage the scheduling for the Hardware Technicians, coordinate with local councils for site access permits, and ensure all equipment is inventoried and ready for the daily deployment batches.', '3 years in logistics or operations coordination, Exceptional organizational skills, Experience with fleet management software', 'A proactive approach to problem-solving, Basic understanding of site safety (OH&S) requirements, Can handle a fast-paced environment without losing your cool'),
(10010, 'Ethical AI Auditor', 145000, 'Public Liaison Lead', 'You will be responsible for the \"Internal Oversight\" of our algorithms. Your job is to stress-test our models for bias (demographic, socioeconomic, or geographic) to ensure our government partners are deploying fair and equitable technology across all neighborhoods.', 'Post-graduate degree in Data Science, Ethics, or Sociology, Experience in algorithmic bias testing, Strong technical writing skills', 'Experience with Explainable AI (XAI) frameworks, A background in social justice or public advocacy, A philosophical mindset with technical execution'),
(10011, 'Technical Support Specialist (L2)', 68000, 'AI Implementation Lead', 'When a camera goes dark or an AI model starts misidentifying objects, you are the first line of defense. You will provide remote support to field techs, monitor the health of the camera fleet via our internal dashboard, and escalate software bugs to the dev team.', 'Experience in a technical support or helpdesk role, Basic Linux command line skills, Familiarity with API monitoring tools', 'Experience with Docker or containerized environments, Great communication skills over radio/slack, A dedicated \"problem-solver\" personality');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi number`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi number` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_ref` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10012;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
