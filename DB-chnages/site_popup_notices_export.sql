-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bhabhfdt_mohitdb_new
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `site_popup_notices`
--

DROP TABLE IF EXISTS `site_popup_notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_popup_notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(150) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `link` varchar(500) NOT NULL DEFAULT '',
  `color_class` varchar(50) NOT NULL DEFAULT 'is-navy',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_popup_notices`
--

LOCK TABLES `site_popup_notices` WRITE;
/*!40000 ALTER TABLE `site_popup_notices` DISABLE KEYS */;
INSERT INTO `site_popup_notices` VALUES (1,'RESULT NOTIFICATION • B.PHARM','🎓 B.Pharm – 4th Semester (Regular)','Examination results declared and published on the official portal.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-navy',5,1,'2026-10-05 05:59:04'),(2,'RESULT NOTIFICATION • DIPLOMA HMCT','🍽️ Diploma HMCT – 1st Year (Regular)','1st Year annual examination marksheet and result live.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-gold',6,1,'2026-10-05 05:59:04'),(3,'RESULT NOTIFICATION • M.PHARM','🔬 M.Pharm – 2nd Semester (Regular)','Post-graduate semester examination results available online.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-blue',7,1,'2026-10-05 05:59:04'),(4,'RESULT NOTIFICATION • B.SC. B.ED','📖 B.Sc. B.Ed – 2nd Semester (Regular)','4-Year integrated programme results declared.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-green',8,1,'2026-10-05 05:59:04'),(5,'RESULT NOTIFICATION • B.PHARM','🎓 B.Pharm – 2nd Semester (Regular)','2nd Semester regular examination results declared.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-navy',9,1,'2026-10-05 05:59:04'),(6,'RESULT NOTIFICATION • B.SC. B.ED','📖 B.Sc. B.Ed – 6th Semester (Regular)','June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-green',1,1,'2026-10-06 10:22:31'),(7,'RESULT NOTIFICATION • B.SC. B.ED','📖 B.Sc. B.Ed – 5th, 3rd & 1st Semester (Ex)','June-2026 examination results declared (05 Oct 2026). All concerned students please check your results online.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-gold',2,1,'2026-10-06 10:22:31'),(8,'RESULT NOTIFICATION • M.SC.','🔬 M.Sc. – 2nd Semester (Regular) – All Branches','June-2026 post-graduate results declared (05 Oct 2026). All concerned students please check your results online.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-blue',3,1,'2026-10-06 10:22:31'),(9,'RESULT NOTIFICATION • M.SC.','🔬 M.Sc. – 1st Semester (Ex) – All Branches','June-2026 post-graduate examination results declared (05 Oct 2026). All concerned students please check your results online.','https://bhabha.accsofterp.com/Accsoft/StudentLogin.aspx','is-purple',4,1,'2026-10-06 10:22:31');
/*!40000 ALTER TABLE `site_popup_notices` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-06 16:07:31
