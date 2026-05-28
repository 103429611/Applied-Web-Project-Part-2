-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 05:06 AM
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
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `studentid` int(11) NOT NULL,
  `part_1_contributions` text NOT NULL,
  `part_2_contributions` text DEFAULT NULL,
  `quote` varchar(200) NOT NULL,
  `quote_in_different_lang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`firstname`, `lastname`, `studentid`, `part_1_contributions`, `part_2_contributions`, `quote`, `quote_in_different_lang`) VALUES
('Ashley', 'Butler', 103429611, 'CSS files, jobs.html, submitting final ZIP file', 'Turning pages into php, adding header.inc, footer.inc, fixing jobs page, added jobs into MySQL DB, added a jobs search, linked job search to apply page, made whole site mobile responsive, overall project manager, kept tabs on team mates progress and ensured tasks were getting done on time, uploading ZIP of project to canvas', 'I choose a lazy person to do a hard job. Because a lazy person will find an easy way to do it.', '「私は難しい仕事には怠け者を選ぶ。なぜなら、怠け者は楽な方法を見つけるからだ。'),
('William', 'Lloyd', 105913190, 'CSS files, about.html', 'Fixing About.html and converting it into About.php, Applied Web Project Part 2 SQL contributions table', 'Good morning China. Now I have ice cream', '早上好中国.现在我有冰淇淋'),
('Noor', 'Fatima Nisar', 106216609, 'CSS files, index.html', 'Settings.php, login.php, presentation, manage.php, admin.php', 'It is very difficult to keep a lamp lit in the middle of the storm', 'بہت مشکل ہے، آندھیوں میں چراغ جلانا'),
('Alex', 'Stanford', 106340883, 'CSS files, apply.html', 'Mobile header, Hamburger menu, apply.php and process.php', 'We must choose between champagne for a few or drinking water for all', 'Il faut choisir entre le champagne pour quelques-uns ou leau potable pour tous');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

DROP TABLE IF EXISTS `eoi`;
CREATE TABLE `eoi` (
  `eoi_number` int(11) NOT NULL,
  `reference` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `postcode` int(11) NOT NULL,
  `state` varchar(10) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `skills` varchar(200) NOT NULL,
  `other_skills` text NOT NULL,
  `submitted_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoi_number`, `reference`, `first_name`, `last_name`, `dob`, `gender`, `address`, `suburb`, `postcode`, `state`, `email_address`, `phone_number`, `skills`, `other_skills`, `submitted_at`, `status`) VALUES
(20, '10001', 'asggsas', 'kdsnbdsug', '1111-11-11', 'mike', 'oufsahosauf', 'vdsljds', 1111, 'NT', 'dskh@emaik.com', 92719216, 'A can do attitude', '', '0000-00-00 00:00:00.000000', 'New'),
(21, '10002', 'Ashley', 'Butler', '2026-05-21', 'female', '1234 fake street', 'nowhere', 3000, 'VIC', 'test@test.com', 12345678, '3 Years of Senior Leadership, Adobe suite experience', 'none', '0000-00-00 00:00:00.000000', 'New'),
(22, '10003', 'Mario', 'Mario', '2026-05-25', 'male', '112 Mushroom Way', 'Toad Town', 3000, 'VIC', 'mario@plumbing.com', 48392015, 'Expert in infrastructure maintenance, plumbing, high-jump athletics', 'none', '2026-05-25 09:14:22.104938', 'New'),
(23, '10004', 'Peach', 'Toadstool', '2026-05-25', 'female', '1 Castle Grounds', 'Toad Town', 3000, 'VIC', 'peach@mushroomkingdom.gov', 72649103, '15+ Years of Royal Diplomacy, crisis management, baking expertise', 'none', '2026-05-25 09:18:45.332104', 'New'),
(24, '10005', 'Joel', 'Miller', '2026-05-25', 'male', '45 QZ Border Road', 'Boston', 2000, 'NSW', 'joel@smugglers.net', 31940582, '20 Years in logistics, asset protection, survival operations', 'none', '2026-05-25 09:22:11.884721', 'New'),
(25, '10006', 'Ellie', 'Williams', '2026-05-25', 'female', '12 Jackson Colony', 'Jackson', 2000, 'NSW', 'ellie@jacksonrepublic.org', 85039214, 'Sustained field reconnaissance, stealth operations, switchblade proficiency', 'none', '2026-05-25 09:25:34.002913', 'New'),
(26, '10007', 'Kratos', 'Sparta', '2026-05-25', 'male', '88 Wildwoods Path', 'Midgard', 4000, 'QLD', 'kratos@war.org', 19483025, 'Extensive senior military command, heavy weapons handling, pantheon restructuring', 'none', '2026-05-25 09:31:02.441952', 'New'),
(27, '10008', 'Atreus', 'Laufeyjarson', '2026-05-25', 'male', '88 Wildwoods Path', 'Midgard', 4000, 'QLD', 'boy@loki.com', 62049581, 'Multilingual translation, archery tracking, giant lore research', 'none', '2026-05-25 09:36:18.115902', 'New'),
(28, '10009', 'Peter', 'Parker', '2026-05-25', 'male', '20 Ingram Street', 'Queens', 5000, 'SA', 'peter.parker@dailybugle.com', 50392184, 'Professional photojournalism, biophysics research, web-line logistics', 'none', '2026-05-25 09:42:55.603948', 'New'),
(29, '10010', 'Miles', 'Morales', '2026-05-25', 'male', '104 Brooklyn Blvd', 'Brooklyn', 5000, 'SA', 'miles.m@visionacademy.edu', 29401857, 'Audio engineering, street art design, bio-electric energy management', 'none', '2026-05-25 09:47:12.839401', 'New'),
(30, '10011', 'Gustave', 'Expedition', '2026-05-25', 'male', '33 Paint Track', 'Lumiere', 6000, 'WA', 'gustave@expedition33.org', 74102938, 'Resource management, structural engineering, final-year expedition planning', 'none', '2026-05-25 10:02:04.992814', 'New'),
(31, '10001', 'Maelle', 'Expedition', '2026-05-25', 'female', '34 Paint Track', 'Lumiere', 6000, 'WA', 'maelle@expedition33.org', 38291045, 'High-velocity fencing, quick-response strategy, artistic composition', 'none', '2026-05-25 10:05:41.123940', 'New'),
(32, '10002', 'Jesse', 'Faden', '2026-05-25', 'female', '33 Broadway', 'The Oldest House', 7000, 'TAS', 'jesse.faden@fbc.gov', 91048237, 'Executive Director oversight, paranatural containment, Service Weapon clearance', 'none', '2026-05-25 10:14:29.551029', 'New'),
(33, '10003', 'Casper', 'Darling', '2026-05-25', 'male', '404 Research Sector', 'The Oldest House', 7000, 'TAS', 'c.darling@fbc.gov', 54910238, 'Head of Research, HRA development, informational video presentation', 'none', '2026-05-25 10:19:02.384910', 'New'),
(34, '10004', 'Arthur', 'Morgan', '2026-05-25', 'male', '3 Van der Linde Camp', 'Clemens Point', 8000, 'NT', 'arthur@van-der-linde.com', 83029147, 'Debt collection, heavy transit security, journal illustration, tracking', 'none', '2026-05-25 10:33:14.772948', 'New'),
(35, '10005', 'John', 'Marston', '2026-05-25', 'male', '1 Beechers Hope', 'Blackwater', 8000, 'NT', 'john@marstonranch.com', 47291038, 'Agricultural management, fence building, long-range tracking operations', 'none', '2026-05-25 10:38:50.002938', 'New'),
(36, '10006', 'Michael', 'De Santa', '2026-05-25', 'male', '3671 Rockford Hills Drive', 'Los Santos', 3000, 'VIC', 'michael@mediamanagement.com', 10394827, 'Film production consulting, high-stakes tactical planning, asset acquisition', 'none', '2026-05-25 10:52:18.492019', 'New'),
(37, '10007', 'Franklin', 'Clinton', '2026-05-25', 'male', '3671 Vinewood Hills', 'Los Santos', 3000, 'VIC', 'franklin@fclintondigital.com', 69302148, 'High-end vehicle repossession, precision stunt driving, boutique agency operations', 'none', '2026-05-25 10:55:33.118240', 'New'),
(38, '10008', 'Trevor', 'Philips', '2026-05-25', 'male', '1520 Marina Drive', 'Sandy Shores', 3000, 'VIC', 'trevor@tpinternational.com', 25849103, 'CEO of TP Enterprises, aviation transport, aggressive negotiation, corporate restructuring', 'none', '2026-05-25 11:01:05.663921', 'New'),
(39, '10009', 'Chell', 'Aperture', '2026-05-25', 'female', '01 Test Shaft 09', 'Upper Michigan', 3000, 'VIC', 'chell@aperturescience.com', 48201938, 'Extensive kinetic momentum testing, long-fall boot proficiency, silent problem solving', 'none', '2026-05-25 11:22:14.004921', 'New'),
(40, '10010', 'Cave', 'Johnson', '2026-05-25', 'male', '88 Shower Curtain Lane', 'Upper Michigan', 3000, 'VIC', 'cave.johnson@aperturescience.com', 73910248, 'Founder & CEO, aggressive entrepreneurial leadership, moon rock acquisition, lemon engineering', 'none', '2026-05-25 11:25:45.312049', 'New'),
(41, '10011', 'G賴en', 'L蘡er', '2026-05-25', 'female', 'Central AI Chamber', 'Upper Michigan', 3000, 'VIC', 'glados@aperturescience.com', 10492837, 'Facility-wide automated operations, neurotoxin logistics, testing protocol optimization', 'none', '2026-05-25 11:28:02.884710', 'New'),
(42, '10001', 'Gordon', 'Freeman', '2026-05-25', 'male', '14 Anomalous Materials', 'Black Mesa', 2000, 'NSW', 'g.freeman@blackmesa.org', 92014837, 'PhD in Theoretical Physics, hazardous materials handling, anomalous resonance cascade response', 'none', '2026-05-25 11:35:19.112049', 'New'),
(43, '10002', 'Alyx', 'Vance', '2026-05-25', 'female', '4 White Forest Base', 'City 17', 2000, 'NSW', 'alyx@resistance.net', 38102948, 'Subterranean urban navigation, EMP tool fabrication, mechanical combat drone maintenance', 'none', '2026-05-25 11:39:44.603912', 'New'),
(44, '10003', 'Wallace', 'Breen', '2026-05-25', 'male', '01 Citadel Apex', 'City 17', 2000, 'NSW', 'administrator@citadel.gov', 84029137, 'Interdimensional public relations, global resource mediation, high-level administrative bureaucracy', 'none', '2026-05-25 11:42:01.229481', 'New'),
(45, '10004', 'Ezio', 'Auditore', '2026-05-25', 'male', '15 Monteriggioni Villa', 'Florence', 4000, 'QLD', 'ezio.auditore@brotherhood.it', 50192847, '20+ Years of regional organizational leadership, stealth asset auditing, parkour structural navigation', 'none', '2026-05-25 11:51:33.992014', 'New'),
(48, '10005', 'Geralt', 'of Rivia', '2026-05-25', 'male', '1 Kaer Morhen Keep', 'The North', 5000, 'SA', 'geralt@kaermorhen.edu', 63920148, 'Apex tracking, wildlife population control, chemical potion preparation, independent security', 'none', '2026-05-25 12:05:44.772019', 'New'),
(49, '10006', 'Yennefer', 'of Vengerberg', '2026-05-25', 'female', '14 Vengerberg Center', 'Aedirn', 5000, 'SA', 'yennefer@sorceresses.org', 82049137, 'High-level political advisory, macro environmental manipulation, portal logistics, strategic negotiation', 'none', '2026-05-25 12:11:22.003921', 'New'),
(50, '10007', 'Ciri', 'Cirilla', '2026-05-25', 'female', '1 Royal Palace', 'Vizima', 5000, 'SA', 'ciri@elderblood.net', 19482037, 'Inter-spatial navigation, rapid-response physical combat, tracking, multi-realm diplomacy', 'none', '2026-05-25 12:15:39.441920', 'New'),
(51, '10008', 'Lucy', 'MacLean', '2026-05-25', 'female', '33 Overseer Residence', 'Vault 33', 6000, 'WA', 'lucy.maclean@vaulttec.com', 40291384, 'Sub-surface community planning, repair ethics, crisis stabilization, golden-rule mediation', 'none', '2026-05-25 12:22:01.883921', 'New'),
(52, '10009', 'The', 'Ghoul', '2026-05-25', 'male', '10 Hollywood Blvd', 'The Wasteland', 6000, 'WA', 'cooper.howard@prewarcinema.com', 85930214, '200+ Years field survival, precision marksmanship, bounty acquisition, media relations consulting', 'none', '2026-05-25 12:26:45.104938', 'New'),
(53, '10010', 'Maximus', 'Brotherhood', '2026-05-25', 'male', '44 Filly Outpost', 'Wasteland West', 6000, 'WA', 'maximus@brotherhoodofsteel.org', 31920485, 'Heavy mechanized armor operations, squire logistics, field reconnaissance, strategic asset defense', 'none', '2026-05-25 12:31:18.552940', 'New'),
(54, '10011', 'Margret', 'Thatcher', '2026-04-29', 'female', 'land of the tea', 'England', 1234, 'VIC', 'primminister@england.co.uk', 12345678, 'AI infrustructure, A working vehicle, Office 365 experience', '', '0000-00-00 00:00:00.000000', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `job_ref` int(11) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `reports_to` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `pref_requirements` text NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `username` varchar(256) NOT NULL,
  `password_hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password_hash`) VALUES
('admin', '$2y$10$xntFkIlteOj/.G1Uu6LNOujV2fActDV.9hc0zIGlq2NVCcjbv22bW');

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
  ADD PRIMARY KEY (`eoi_number`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_ref`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_ref` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10012;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
