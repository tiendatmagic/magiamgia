-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (arm64)
--
-- Host: localhost    Database: botble
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'G5iwh7uoAJy5GuNEdlyzz7VhxCYrVsOU',1,'2024-03-11 00:04:06','2024-03-11 00:04:06','2024-03-11 00:04:06');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_histories`
--

DROP TABLE IF EXISTS `audit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `module` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_user` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_histories_user_id_index` (`user_id`),
  KEY `audit_histories_module_index` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_histories`
--

LOCK TABLES `audit_histories` WRITE;
/*!40000 ALTER TABLE `audit_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'Dr. Nelle Olson','dr-nelle-olson','Debitis officiis quae sunt ut.','Distinctio quasi sunt ipsum saepe quam. Vitae at expedita qui numquam incidunt modi quia. Non enim excepturi aliquid. Amet blanditiis cupiditate officiis eveniet sed. Et at assumenda odio quibusdam provident voluptatem. Fugiat beatae est explicabo sit enim in dolor sit. Eius dolor ducimus ipsa omnis. Ad repellendus nesciunt quia dolorum voluptatem nihil.','published',NULL,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(2,'Mrs. Shanelle Abernathy','mrs-shanelle-abernathy','Aliquid similique quis cum quas.','Nihil ea quia praesentium et est omnis perspiciatis. Dicta earum incidunt similique delectus debitis nihil. Et temporibus non ex sint mollitia. Voluptatem quas consequatur minima reiciendis ipsam perspiciatis ut. Magni sit omnis eum occaecati id. Impedit officia magnam enim aspernatur. Ut quas ipsa maiores autem similique sit. Ut voluptatem est aspernatur recusandae saepe. Autem veritatis aut et neque.','published',NULL,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(3,'Dr. Salvatore Kerluke PhD','dr-salvatore-kerluke-phd','Aut rem distinctio eius ut.','Ut suscipit nihil nihil. Vel quae necessitatibus quo suscipit inventore in. Placeat et blanditiis non placeat similique dolorem rem. Eligendi iste porro deserunt qui vitae maiores quae. Earum et rerum earum corporis omnis. Cumque totam ducimus qui iure id vel. Cupiditate quam temporibus numquam voluptas eius quia. Et voluptates officiis inventore ut neque tempore.','published',NULL,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(4,'Mr. Oren Glover PhD','mr-oren-glover-phd','Soluta repudiandae recusandae quod amet ratione.','Doloremque dolores nihil modi iure. Dolore voluptatem velit pariatur tempore similique voluptas sunt. Nihil est quibusdam cupiditate veniam accusantium consectetur. Ea totam iusto optio eius quis. Ipsam fugit sint est ipsa. Modi omnis sint inventore magnam consectetur excepturi. Beatae laboriosam blanditiis eveniet repellat maxime praesentium cupiditate. Ipsum quis maxime minus rerum nostrum sed quasi. Et dolorum sequi quos exercitationem.','published',NULL,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(5,'Emmie Bednar','emmie-bednar','Quia nostrum quasi explicabo.','Numquam vel culpa odio doloribus. Quasi nemo et fugiat enim. Nam voluptatem omnis modi ullam cumque cupiditate. Qui aliquam accusantium aut fugit tempore nesciunt earum. Expedita nemo autem minus architecto doloremque beatae voluptate voluptas. Dolorum voluptas est aut aliquam quas sit vel. Vel placeat architecto suscipit doloremque.','published',NULL,'2024-03-11 00:04:11','2024-03-11 00:04:11');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks_translations`
--

DROP TABLE IF EXISTS `blocks_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocks_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`blocks_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks_translations`
--

LOCK TABLES `blocks_translations` WRITE;
/*!40000 ALTER TABLE `blocks_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocks_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_status_index` (`status`),
  KEY `categories_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Artificial Intelligence',0,'Cum odit optio dicta optio. Qui alias sequi quis fuga explicabo saepe. Excepturi ipsam vitae aliquam voluptatem voluptatem.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(2,'Cybersecurity',0,'Cum rerum sint magni aut itaque minima voluptas. Exercitationem nemo autem inventore vel doloribus enim. Et necessitatibus dolorem incidunt non non. Cumque ea cumque et sed a tenetur dolores sint.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(3,'Blockchain Technology',0,'Voluptatum repellendus fugit quibusdam. Qui nostrum dolor consequuntur unde voluptatem. Facere in vel quibusdam totam et in consequatur. Qui iure enim iste id explicabo reiciendis labore.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(4,'5G and Connectivity',0,'Ex quos dolorem est voluptatem unde tempora quia. Et ut ducimus eaque et nihil. Ut facere eligendi hic quaerat quidem. Provident temporibus omnis ratione nisi.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(5,'Augmented Reality (AR)',0,'Quas odio ducimus hic in accusamus soluta nobis. Architecto similique modi quis maxime voluptatem expedita eveniet cum. Quasi magnam ipsam repellendus aut.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(6,'Green Technology',0,'Aut dolorem quisquam cum non voluptatum id. Possimus officia asperiores deleniti aperiam nisi odio. Accusamus nobis voluptatem iure labore provident magni et.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(7,'Quantum Computing',0,'Quia ut vero nostrum exercitationem. Magnam omnis fuga quaerat rem. Aut fugiat alias nihil qui dolorem. Esse culpa quaerat sit rerum ad tempora. Et ex qui quam. Voluptate ut autem ut.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(8,'Edge Computing',0,'Commodi non aut minima vero consectetur aliquid dolorem. Earum et neque et sint amet. Porro assumenda odit omnis rerum hic accusantium.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-03-11 00:04:07','2024-03-11 00:04:07');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_translations`
--

DROP TABLE IF EXISTS `categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_translations`
--

LOCK TABLES `categories_translations` WRITE;
/*!40000 ALTER TABLE `categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_replies`
--

DROP TABLE IF EXISTS `contact_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_replies`
--

LOCK TABLES `contact_replies` WRITE;
/*!40000 ALTER TABLE `contact_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Prof. Okey Thiel','marlon.kris@example.com','+1-669-965-8755','58552 Lueilwitz Underpass Apt. 323\nLake Arvid, AR 74456-5729','Aut magni dolorum autem sit aut nisi.','Qui deleniti commodi nihil quis. Iure error corrupti error rem doloremque quo ipsum odit. Molestias qui quia molestiae quis porro. Est velit nihil ut ut consequatur. Eum voluptatem ex molestiae nihil reprehenderit in eaque non. Enim reiciendis voluptatem consequatur itaque harum voluptas laudantium nemo. Omnis in qui velit saepe quam beatae maxime nisi. Cupiditate omnis voluptatum dolores quasi sit sunt cupiditate.','read','2024-03-11 00:04:11','2024-03-11 00:04:11'),(2,'Garett McClure','feeney.nettie@example.org','(318) 897-2464','1740 Gerhold Drive Apt. 190\nWest Mitchelmouth, TX 73192-2534','Repudiandae quo repudiandae possimus aut.','Quo debitis ipsum et ut sed vel. Et hic animi qui similique vitae alias. Omnis ea nemo fugit molestiae delectus sit assumenda. Voluptas quibusdam explicabo at quia iusto velit. Distinctio quia optio voluptas ut consequatur. Aliquid aliquam vitae repudiandae id odio quibusdam. Rerum officia dolor ut deserunt tempora tempora. Et dolor aut expedita veniam.','read','2024-03-11 00:04:11','2024-03-11 00:04:11'),(3,'Willy Streich III','estel.nicolas@example.com','1-650-421-0644','4982 Domenico Loop\nAntonettaburgh, NJ 98978-1011','Est eius possimus sit nihil quis.','In est et ullam explicabo nihil. Cumque voluptas vel numquam suscipit quod. At quis error voluptatem nisi repudiandae totam. Sit vero quis ut. Consectetur omnis possimus excepturi quas. Aut sunt et quia aspernatur. Est aspernatur ut qui. Voluptate eveniet sit incidunt natus eligendi in ea dolorem. Praesentium ut inventore quod est perferendis. Laborum veniam ut et nemo eveniet. Nesciunt et ut voluptatum cum. Voluptatem perferendis quae quaerat facere. Ea reiciendis sint nam sint modi.','unread','2024-03-11 00:04:11','2024-03-11 00:04:11'),(4,'Carlee Wilderman DDS','botsford.kaela@example.org','985-357-7886','3789 Haley Trace\nHettiefort, WV 81055-7304','Ad nihil ducimus enim ea dolorum.','Maiores sequi temporibus autem id asperiores. Cum et dolorum et omnis sit excepturi. Nihil dolore facilis ut. Delectus aperiam iure maxime inventore sunt. Perspiciatis enim suscipit doloribus deleniti molestiae temporibus. Natus quaerat aut nihil possimus. Aliquam et adipisci at culpa amet consequatur.','unread','2024-03-11 00:04:11','2024-03-11 00:04:11'),(5,'Lamar Mosciski','walsh.virginia@example.net','+1-504-449-9204','28720 Molly River Suite 968\nGislasontown, NM 08233','Incidunt corporis in pariatur aut.','Aut sit et cupiditate aliquam enim. Est sint voluptatibus et recusandae. Pariatur est excepturi ut nulla consequuntur aspernatur. Omnis qui ut quidem omnis eaque minima atque. Sint rerum vero consequatur dicta voluptatem repellendus et. Dolores praesentium quaerat soluta ex et aliquam. Et molestiae aut molestiae dolorum assumenda non. Aut est sit qui. Dolores ut enim repudiandae hic. Atque quo ut saepe. Inventore et recusandae id debitis ducimus eaque. Aut asperiores ad est.','unread','2024-03-11 00:04:11','2024-03-11 00:04:11'),(6,'Leslie Walter','jordon.cummerata@example.org','+1-346-657-0966','9236 Gisselle Spring\nEast Louvenia, WI 43594','Possimus ratione et ducimus ipsa qui cupiditate.','Expedita sed quibusdam et. Quam enim veniam sequi corporis similique voluptate. Doloremque sequi distinctio libero facilis. Molestiae sed qui rerum praesentium. Id mollitia doloribus quia quibusdam. Consequatur beatae et eligendi. Esse dignissimos odit autem nemo qui aliquid. Minus ratione vitae nisi eius expedita similique quaerat. Quidem voluptatem animi ex rerum neque. Reprehenderit quod molestiae sunt perspiciatis quos molestiae totam.','read','2024-03-11 00:04:11','2024-03-11 00:04:11'),(7,'Abbey West','jacobson.virgie@example.net','+1-832-612-3410','9733 Weber Light Apt. 623\nSouth Lewis, VA 78589-4808','Blanditiis non omnis velit et sint facere.','Quaerat quam et suscipit qui. Quis delectus itaque totam consectetur soluta quia. Soluta tempora cupiditate sint. Quis in vel optio nulla eum laborum. Et accusamus eum facere eaque dignissimos. Et fugit debitis eum cumque enim voluptas. Iste aut odio dolor quia eius perferendis omnis. Hic excepturi autem sed dolore iusto rerum quis. Quaerat vitae est magnam et qui. Ea sit quis quam soluta.','read','2024-03-11 00:04:11','2024-03-11 00:04:11'),(8,'Elouise Wilderman','lavina85@example.org','+1-929-312-7431','9162 Langosh Isle Apt. 963\nEldridgechester, FL 15812','Est illum et sed itaque.','Praesentium debitis veritatis dolores neque qui suscipit ducimus rerum. Et in molestiae at iure. Quis amet velit dicta totam nulla. Reiciendis nihil praesentium fuga. Natus aut animi qui nostrum magnam. Nostrum error deserunt in. Quia magnam hic commodi autem mollitia. Delectus delectus soluta error qui vero pariatur. Fuga iusto dolore recusandae ut.','unread','2024-03-11 00:04:11','2024-03-11 00:04:11'),(9,'Dianna Harber','fay.oreilly@example.net','1-484-567-6605','318 Langosh Extension Suite 916\nEast Ansel, NC 74000','Voluptates qui expedita dolores reiciendis.','Ipsum repudiandae cupiditate exercitationem tempora quibusdam. Molestiae totam velit qui voluptas. Autem inventore at ab et illo molestiae molestiae. Praesentium sed reprehenderit sit error repellendus. Quo non tempore ipsa earum. Aperiam dicta et ullam. Molestiae enim est aut itaque dolorem quo fugiat. Id accusantium exercitationem cupiditate est. Nostrum nisi adipisci qui nostrum enim suscipit dolor. Ipsum illo sit aut non sint. Possimus voluptatibus perspiciatis alias ipsa dolor nihil ut.','read','2024-03-11 00:04:11','2024-03-11 00:04:11'),(10,'Missouri Jacobi I','earnest78@example.com','934.620.7409','408 Spinka Mall\nSerenityport, DE 54468-8445','Dolor quia et qui sit accusantium sit esse.','Ad architecto quisquam aut deleniti eum consequuntur aperiam. Non in quia corporis dicta. Sint eos numquam voluptatibus dicta maxime. Laboriosam consectetur voluptates odio et veniam. Eligendi dolor quo deleniti quasi accusantium est maiores. Modi sit nihil ex iste. Ut et commodi amet pariatur dolorem esse.','read','2024-03-11 00:04:11','2024-03-11 00:04:11');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `use_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_for_id` bigint unsigned NOT NULL,
  `field_item_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `custom_fields_field_item_id_index` (`field_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields_translations`
--

DROP TABLE IF EXISTS `custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_fields_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_fields_id` bigint unsigned NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`custom_fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields_translations`
--

LOCK TABLES `custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widget_settings`
--

DROP TABLE IF EXISTS `dashboard_widget_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widget_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `widget_id` bigint unsigned NOT NULL,
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  KEY `dashboard_widget_settings_widget_id_index` (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widget_settings`
--

LOCK TABLES `dashboard_widget_settings` WRITE;
/*!40000 ALTER TABLE `dashboard_widget_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widget_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widgets`
--

DROP TABLE IF EXISTS `dashboard_widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widgets`
--

LOCK TABLES `dashboard_widgets` WRITE;
/*!40000 ALTER TABLE `dashboard_widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_groups`
--

DROP TABLE IF EXISTS `field_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_groups_created_by_index` (`created_by`),
  KEY `field_groups_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_groups`
--

LOCK TABLES `field_groups` WRITE;
/*!40000 ALTER TABLE `field_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_items`
--

DROP TABLE IF EXISTS `field_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `field_group_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `order` int DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `field_items_field_group_id_index` (`field_group_id`),
  KEY `field_items_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_items`
--

LOCK TABLES `field_items` WRITE;
/*!40000 ALTER TABLE `field_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'Sunset','Nihil consequatur sed a et sunt totam ut. Consequatur consequatur dignissimos reprehenderit deleniti.',1,0,'news/6.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(2,'Ocean Views','Inventore facilis ipsa aut laboriosam vitae facere est. Iste impedit eveniet magni dolorem nihil. Ut fuga assumenda animi pariatur.',1,0,'news/7.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(3,'Adventure Time','Vel id neque et voluptatem. Reprehenderit quis ex et quaerat at quo facere. Ipsa id ab qui similique suscipit. Velit eum quia nihil.',1,0,'news/8.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(4,'City Lights','Doloremque officia quis nesciunt iusto. Similique qui et in. Maxime facilis odit omnis ut ullam. Eum nemo nam ex fuga at facere dolorem natus.',1,0,'news/9.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(5,'Dreamscape','Sunt molestiae excepturi qui aspernatur eos consectetur tenetur nemo. Eaque eius rerum doloribus ducimus qui qui ipsa.',1,0,'news/10.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(6,'Enchanted Forest','Sed adipisci nemo quis exercitationem. Veritatis facere optio ea ut eaque ipsa repellat.',1,0,'news/11.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(7,'Golden Hour','A possimus ut quas iure doloribus impedit. Beatae quasi voluptatibus qui. Aut quis aperiam modi magnam.',0,0,'news/12.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(8,'Serenity','Non deserunt rerum vel placeat voluptatem corporis porro. Iusto iste facilis expedita rem suscipit et. Quisquam sint odio est odit ut et.',0,0,'news/13.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(9,'Eternal Beauty','Quis recusandae officiis commodi nihil modi. Velit sit quidem et.',0,0,'news/14.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(10,'Moonlight Magic','Dolores tenetur et nemo est. Et dolorum ipsum et praesentium eius sed. Omnis facere optio voluptate. Explicabo odio deleniti laboriosam ut.',0,0,'news/15.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(11,'Starry Night','Velit dolore optio impedit. Earum doloribus dignissimos delectus quas quisquam. Enim recusandae velit recusandae id.',0,0,'news/16.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(12,'Hidden Gems','Et non sint consequatur velit rerum. In omnis voluptatem voluptatem. Quia iusto omnis dolorum explicabo enim ut.',0,0,'news/17.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(13,'Tranquil Waters','Dolores est debitis ea neque perferendis ut natus. Nisi omnis fugiat velit distinctio. Suscipit deserunt nesciunt nesciunt molestiae corrupti ut ut.',0,0,'news/18.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(14,'Urban Escape','Aut dolorem vitae sit laborum a dolorem. Vitae dolor mollitia nihil minus dolores.',0,0,'news/19.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08'),(15,'Twilight Zone','Molestias nulla corporis perferendis ratione cumque. Eum accusamus velit nulla aut rerum facere. Deserunt est et voluptas error iure sed.',0,0,'news/20.jpg',1,'published','2024-03-11 00:04:08','2024-03-11 00:04:08');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries_translations`
--

DROP TABLE IF EXISTS `galleries_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `galleries_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`galleries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries_translations`
--

LOCK TABLES `galleries_translations` WRITE;
/*!40000 ALTER TABLE `galleries_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_meta`
--

DROP TABLE IF EXISTS `gallery_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `images` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_meta_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_meta`
--

LOCK TABLES `gallery_meta` WRITE;
/*!40000 ALTER TABLE `gallery_meta` DISABLE KEYS */;
INSERT INTO `gallery_meta` VALUES (1,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',1,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(2,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',2,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(3,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',3,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(4,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',4,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(5,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',5,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(6,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',6,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(7,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',7,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(8,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',8,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(9,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',9,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(10,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',10,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(11,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',11,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(12,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',12,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(13,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',13,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(14,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',14,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08'),(15,'[{\"img\":\"news\\/1.jpg\",\"description\":\"Praesentium vel adipisci mollitia dolorem. Et ut est dolorum ut nam doloremque. Aut maiores eligendi cum sequi doloribus eveniet molestiae.\"},{\"img\":\"news\\/2.jpg\",\"description\":\"Enim est soluta libero laboriosam exercitationem. Consequatur corporis nobis blanditiis iure consequatur. Vero velit numquam illum voluptas.\"},{\"img\":\"news\\/3.jpg\",\"description\":\"Quis rem molestiae delectus ducimus aut id sed. Ex eligendi earum aliquid corporis.\"},{\"img\":\"news\\/4.jpg\",\"description\":\"Incidunt autem mollitia nihil harum. Recusandae soluta veritatis sed. Id rerum odio aut qui numquam ut.\"},{\"img\":\"news\\/5.jpg\",\"description\":\"Similique ut et ducimus dolore in temporibus. Magni amet enim omnis numquam debitis. Quibusdam facere quibusdam voluptas sapiente.\"},{\"img\":\"news\\/6.jpg\",\"description\":\"Ex magnam ut optio similique quibusdam aut at ab. Quia esse voluptatem quo dignissimos rerum sit in. Veritatis ullam perferendis ex et ea quia nulla.\"},{\"img\":\"news\\/7.jpg\",\"description\":\"Accusantium quia ut quam corporis adipisci. Perferendis eum qui minima sunt est id deserunt. Et illum dolor dolorem dolores expedita numquam.\"},{\"img\":\"news\\/8.jpg\",\"description\":\"Impedit nisi quam aut voluptatibus consequuntur asperiores sed. Saepe mollitia sapiente aut quis sint deleniti veritatis.\"},{\"img\":\"news\\/9.jpg\",\"description\":\"Ea aut voluptas et quidem. Iste perferendis quia qui adipisci ipsa sunt laudantium. Tempora odit possimus itaque reprehenderit.\"},{\"img\":\"news\\/10.jpg\",\"description\":\"Vero maxime repellendus est iusto. Hic animi eos placeat illum commodi ut quia. Animi architecto cupiditate eos aut ad facilis.\"},{\"img\":\"news\\/11.jpg\",\"description\":\"Voluptatem voluptatem vitae itaque nesciunt deserunt. Et harum atque voluptatibus vero. Quas quia officiis itaque quod quis cum cum.\"},{\"img\":\"news\\/12.jpg\",\"description\":\"Perferendis accusamus corporis quis facere facilis sed. Molestiae illo eius quia. Illo repellendus velit ratione in nostrum.\"},{\"img\":\"news\\/13.jpg\",\"description\":\"Repellat aperiam odio rerum nihil omnis tempore tempore. Qui iusto hic facere ullam neque. Necessitatibus voluptatem inventore et consequatur.\"},{\"img\":\"news\\/14.jpg\",\"description\":\"Dolore sequi quod at. Numquam sapiente quis ullam nobis. Et iusto expedita odio aut doloribus adipisci neque. Assumenda aspernatur ea qui nam.\"},{\"img\":\"news\\/15.jpg\",\"description\":\"Maiores temporibus facilis ducimus corporis non et. Voluptatem natus nobis totam hic. Eius vero laudantium aut vel. Ut qui non a id est dolor.\"},{\"img\":\"news\\/16.jpg\",\"description\":\"Exercitationem tenetur et necessitatibus doloribus. Ut accusamus hic eos voluptas facilis. Omnis nostrum labore ab.\"},{\"img\":\"news\\/17.jpg\",\"description\":\"Et nam possimus totam explicabo quae rerum dolores. Fugiat et fuga ullam earum. Officiis vel nihil recusandae consequatur et aperiam.\"},{\"img\":\"news\\/18.jpg\",\"description\":\"Exercitationem deserunt quas sunt iure possimus perspiciatis repudiandae. Corporis id corporis est aut voluptas et. Aut sunt temporibus maiores.\"},{\"img\":\"news\\/19.jpg\",\"description\":\"Sed magnam et sunt illum ab. Rem qui ducimus eos voluptatibus. Ipsum voluptatem beatae autem voluptatem iste voluptatem et.\"},{\"img\":\"news\\/20.jpg\",\"description\":\"Est amet nesciunt dolores sed. Ut laboriosam illum rerum beatae molestiae commodi nesciunt. Qui nesciunt totam dolore minima sequi.\"}]',15,'Botble\\Gallery\\Models\\Gallery','2024-03-11 00:04:08','2024-03-11 00:04:08');
/*!40000 ALTER TABLE `gallery_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_meta_translations`
--

DROP TABLE IF EXISTS `gallery_meta_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_meta_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_meta_id` bigint unsigned NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`gallery_meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_meta_translations`
--

LOCK TABLES `gallery_meta_translations` WRITE;
/*!40000 ALTER TABLE `gallery_meta_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery_meta_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language_meta`
--

DROP TABLE IF EXISTS `language_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `language_meta` (
  `lang_meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_meta_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_meta_origin` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`lang_meta_id`),
  KEY `language_meta_reference_id_index` (`reference_id`),
  KEY `meta_code_index` (`lang_meta_code`),
  KEY `meta_origin_index` (`lang_meta_origin`),
  KEY `meta_reference_type_index` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_meta`
--

LOCK TABLES `language_meta` WRITE;
/*!40000 ALTER TABLE `language_meta` DISABLE KEYS */;
INSERT INTO `language_meta` VALUES (1,'en_US','4c61c9dd1ce109f02979e365fa8d650d',1,'Botble\\Menu\\Models\\MenuLocation'),(2,'en_US','e85ad98d234fdab80aa247a9675d41d0',1,'Botble\\Menu\\Models\\Menu'),(3,'en_US','c9b6d89b56d428547df8f28b8c1f3897',2,'Botble\\Menu\\Models\\Menu'),(4,'en_US','7fc38c1293d860e283de9096223e2ec8',3,'Botble\\Menu\\Models\\Menu');
/*!40000 ALTER TABLE `language_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `lang_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_flag` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `lang_order` int NOT NULL DEFAULT '0',
  `lang_is_rtl` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  KEY `lang_locale_index` (`lang_locale`),
  KEY `lang_code_index` (`lang_code`),
  KEY `lang_is_default_index` (`lang_is_default`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','en_US','us',1,0,0);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` bigint unsigned NOT NULL DEFAULT '0',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`),
  KEY `media_files_index` (`folder_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,0,'1','1',1,'image/jpeg',9803,'news/1.jpg','[]','2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(2,0,'10','10',1,'image/jpeg',9803,'news/10.jpg','[]','2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(3,0,'11','11',1,'image/jpeg',9803,'news/11.jpg','[]','2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(4,0,'12','12',1,'image/jpeg',9803,'news/12.jpg','[]','2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(5,0,'13','13',1,'image/jpeg',9803,'news/13.jpg','[]','2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(6,0,'14','14',1,'image/jpeg',9803,'news/14.jpg','[]','2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(7,0,'15','15',1,'image/jpeg',9803,'news/15.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(8,0,'16','16',1,'image/jpeg',9803,'news/16.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(9,0,'17','17',1,'image/jpeg',9803,'news/17.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(10,0,'18','18',1,'image/jpeg',9803,'news/18.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(11,0,'19','19',1,'image/jpeg',9803,'news/19.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(12,0,'2','2',1,'image/jpeg',9803,'news/2.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(13,0,'20','20',1,'image/jpeg',9803,'news/20.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(14,0,'3','3',1,'image/jpeg',9803,'news/3.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(15,0,'4','4',1,'image/jpeg',9803,'news/4.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(16,0,'5','5',1,'image/jpeg',9803,'news/5.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(17,0,'6','6',1,'image/jpeg',9803,'news/6.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(18,0,'7','7',1,'image/jpeg',9803,'news/7.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(19,0,'8','8',1,'image/jpeg',9803,'news/8.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(20,0,'9','9',1,'image/jpeg',9803,'news/9.jpg','[]','2024-03-11 00:04:07','2024-03-11 00:04:07',NULL),(21,0,'1','1',2,'image/jpeg',9803,'members/1.jpg','[]','2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(22,0,'10','10',2,'image/jpeg',9803,'members/10.jpg','[]','2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(23,0,'11','11',2,'image/png',9803,'members/11.png','[]','2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(24,0,'2','2',2,'image/jpeg',9803,'members/2.jpg','[]','2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(25,0,'3','3',2,'image/jpeg',9803,'members/3.jpg','[]','2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(26,0,'4','4',2,'image/jpeg',9803,'members/4.jpg','[]','2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(27,0,'5','5',2,'image/jpeg',9803,'members/5.jpg','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL),(28,0,'6','6',2,'image/jpeg',9803,'members/6.jpg','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL),(29,0,'7','7',2,'image/jpeg',9803,'members/7.jpg','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL),(30,0,'8','8',2,'image/jpeg',9803,'members/8.jpg','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL),(31,0,'9','9',2,'image/jpeg',9803,'members/9.jpg','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL),(32,0,'favicon','favicon',3,'image/png',1122,'general/favicon.png','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL),(33,0,'logo','logo',3,'image/png',55286,'general/logo.png','[]','2024-03-11 00:04:11','2024-03-11 00:04:11',NULL);
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_folders`
--

DROP TABLE IF EXISTS `media_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`),
  KEY `media_folders_index` (`parent_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_folders`
--

LOCK TABLES `media_folders` WRITE;
/*!40000 ALTER TABLE `media_folders` DISABLE KEYS */;
INSERT INTO `media_folders` VALUES (1,0,'news',NULL,'news',0,'2024-03-11 00:04:06','2024-03-11 00:04:06',NULL),(2,0,'members',NULL,'members',0,'2024-03-11 00:04:10','2024-03-11 00:04:10',NULL),(3,0,'general',NULL,'general',0,'2024-03-11 00:04:11','2024-03-11 00:04:11',NULL);
/*!40000 ALTER TABLE `media_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_settings`
--

DROP TABLE IF EXISTS `media_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `media_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_settings`
--

LOCK TABLES `media_settings` WRITE;
/*!40000 ALTER TABLE `media_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_activity_logs`
--

DROP TABLE IF EXISTS `member_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `reference_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_activity_logs_member_id_index` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_activity_logs`
--

LOCK TABLES `member_activity_logs` WRITE;
/*!40000 ALTER TABLE `member_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_password_resets`
--

DROP TABLE IF EXISTS `member_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `member_password_resets_email_index` (`email`),
  KEY `member_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_password_resets`
--

LOCK TABLES `member_password_resets` WRITE;
/*!40000 ALTER TABLE `member_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `email_verify_token` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Mose','Moore','March--just before HE went.',NULL,'member@gmail.com','$2y$12$eop1uQ.5QkRLweITQGYZsOLxbQslVnC3W2f.cqJMdX.wtuLETTx5y',22,'1990-03-24','951.876.0908','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:08','2024-03-11 00:04:11','published'),(2,'Norval','Willms','WOULD always get into that.',NULL,'keebler.judy@tremblay.com','$2y$12$53yH5mumFOaBE2cv3nEvsuLs0bfQYZnQywFrwNkj/8bfBNxaX9HN6',23,'1994-04-27','+1.720.793.2451','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:08','2024-03-11 00:04:11','published'),(3,'Hank','Schulist','Mock Turtle in a hot tureen!.',NULL,'hoconner@yahoo.com','$2y$12$QEOT3y06uSETamYEgPAXPunV0xRM8PJaG5aE6MwKwR7hER.L5hilu',24,'2014-03-06','+12156856353','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:08','2024-03-11 00:04:11','published'),(4,'Hipolito','Berge','Queen said severely \'Who is.',NULL,'cpredovic@hotmail.com','$2y$12$i.VShwmLGCzssW9z/62Ax.I/NibYSTtC3r794wC5O4oe1E6ogPkY2',25,'2005-11-15','423-291-8439','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:09','2024-03-11 00:04:11','published'),(5,'Osbaldo','Hermann','Alice with one eye; \'I seem.',NULL,'aida52@herman.biz','$2y$12$ThN9wbu3iLfCJyS.1Ec2buGsuRihZPe8CLJbqth0hP1a9RQxLrnRG',26,'1997-09-21','248.853.8690','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:09','2024-03-11 00:04:11','published'),(6,'Winfield','Fritsch','Queen shouted at the place.',NULL,'walter.juliet@thompson.net','$2y$12$cnYowiyhFBdINgxgS9/.Pe4DO.JJctfv7o4DfsTGSjXnVrtPp3gnu',27,'1973-04-04','301.434.8718','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:09','2024-03-11 00:04:11','published'),(7,'Amelie','Schultz','Queen, turning purple. \'I.',NULL,'lkreiger@gutkowski.com','$2y$12$ptBLy6025DDD.2aClY2KOO./LP64Q630C8iDeP/80nXXDbFi9U8Kq',28,'1988-02-22','(747) 771-9230','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:09','2024-03-11 00:04:11','published'),(8,'Oren','Weissnat','Alice looked all round her.',NULL,'maddison19@anderson.com','$2y$12$7/uBbVRNrd9f1ocfo5FRquHCXbpglSj94EjExbZx6DH0XfBwgkK6W',29,'2021-05-31','732-427-4694','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:10','2024-03-11 00:04:11','published'),(9,'Marta','Macejkovic','Beautiful, beautiful Soup!.',NULL,'marshall43@yahoo.com','$2y$12$/zbEmz0HoQLA30xVPLSGSemaTWQ3hzGLAemmpkBKxkwhcKK0qjFQ2',30,'2009-09-12','+1-913-694-0510','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:10','2024-03-11 00:04:11','published'),(10,'Teagan','Farrell','Dinah: I think you\'d take a.',NULL,'daugherty.nicholas@paucek.com','$2y$12$X/niBQeV0vdfD8gJojkyF.rB2UyqThhiyaChZwBsK/Uw1jw2U7VOe',31,'2007-12-21','+1 (423) 423-7135','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:10','2024-03-11 00:04:11','published'),(11,'John','Smith','Alice. \'I wonder if I like.',NULL,'john.smith@botble.com','$2y$12$2H.bx0yCFo4fk8Qg6pF5/O1yTLNaDyZe7S3BP91RJdQ2N1b2h7mwK',21,'2017-12-06','(423) 245-9281','2024-03-11 07:04:08',NULL,NULL,'2024-03-11 00:04:11','2024-03-11 00:04:11','published');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_locations`
--

DROP TABLE IF EXISTS `menu_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `location` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_locations_menu_id_created_at_index` (`menu_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_locations`
--

LOCK TABLES `menu_locations` WRITE;
/*!40000 ALTER TABLE `menu_locations` DISABLE KEYS */;
INSERT INTO `menu_locations` VALUES (1,1,'main-menu','2024-03-11 00:04:11','2024-03-11 00:04:11');
/*!40000 ALTER TABLE `menu_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_nodes`
--

DROP TABLE IF EXISTS `menu_nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_nodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `reference_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `has_child` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_nodes_menu_id_index` (`menu_id`),
  KEY `menu_nodes_parent_id_index` (`parent_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_type` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_nodes`
--

LOCK TABLES `menu_nodes` WRITE;
/*!40000 ALTER TABLE `menu_nodes` DISABLE KEYS */;
INSERT INTO `menu_nodes` VALUES (1,1,0,NULL,NULL,'/',NULL,0,'Home',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(2,1,0,NULL,NULL,'https://botble.com/go/download-cms',NULL,0,'Purchase',NULL,'_blank',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(3,1,0,2,'Botble\\Page\\Models\\Page','/blog',NULL,0,'Blog',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(4,1,0,5,'Botble\\Page\\Models\\Page','/galleries',NULL,0,'Galleries',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(5,1,0,3,'Botble\\Page\\Models\\Page','/contact',NULL,0,'Contact',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(6,2,0,1,'Botble\\Blog\\Models\\Category','/artificial-intelligence',NULL,1,'Artificial Intelligence',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(7,2,0,2,'Botble\\Blog\\Models\\Category','/cybersecurity',NULL,1,'Cybersecurity',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(8,2,0,3,'Botble\\Blog\\Models\\Category','/blockchain-technology',NULL,1,'Blockchain Technology',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(9,2,0,4,'Botble\\Blog\\Models\\Category','/5g-and-connectivity',NULL,1,'5G and Connectivity',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(10,2,0,5,'Botble\\Blog\\Models\\Category','/augmented-reality-ar',NULL,1,'Augmented Reality (AR)',NULL,'_self',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(11,3,0,NULL,NULL,'https://facebook.com','ti ti-brand-facebook',2,'Facebook',NULL,'_blank',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(12,3,0,NULL,NULL,'https://twitter.com','ti ti-brand-x',2,'Twitter',NULL,'_blank',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(13,3,0,NULL,NULL,'https://github.com','ti ti-brand-github',2,'GitHub',NULL,'_blank',0,'2024-03-11 00:04:11','2024-03-11 00:04:11'),(14,3,0,NULL,NULL,'https://linkedin.com','ti ti-brand-linkedin',2,'Linkedin',NULL,'_blank',0,'2024-03-11 00:04:11','2024-03-11 00:04:11');
/*!40000 ALTER TABLE `menu_nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main menu','main-menu','published','2024-03-11 00:04:11','2024-03-11 00:04:11'),(2,'Featured Categories','featured-categories','published','2024-03-11 00:04:11','2024-03-11 00:04:11'),(3,'Social','social','published','2024-03-11 00:04:11','2024-03-11 00:04:11');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_boxes`
--

DROP TABLE IF EXISTS `meta_boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_boxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_reference_id_index` (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_boxes`
--

LOCK TABLES `meta_boxes` WRITE;
/*!40000 ALTER TABLE `meta_boxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta_boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_04_09_032329_create_base_tables',1),(2,'2013_04_09_062329_create_revisions_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_reset_tokens_table',1),(5,'2016_06_10_230148_create_acl_tables',1),(6,'2016_06_14_230857_create_menus_table',1),(7,'2016_06_28_221418_create_pages_table',1),(8,'2016_10_05_074239_create_setting_table',1),(9,'2016_11_28_032840_create_dashboard_widget_tables',1),(10,'2016_12_16_084601_create_widgets_table',1),(11,'2017_05_09_070343_create_media_tables',1),(12,'2017_11_03_070450_create_slug_table',1),(13,'2019_01_05_053554_create_jobs_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_12_14_000001_create_personal_access_tokens_table',1),(16,'2022_04_20_100851_add_index_to_media_table',1),(17,'2022_04_20_101046_add_index_to_menu_table',1),(18,'2022_07_10_034813_move_lang_folder_to_root',1),(19,'2022_08_04_051940_add_missing_column_expires_at',1),(20,'2022_09_01_000001_create_admin_notifications_tables',1),(21,'2022_10_14_024629_drop_column_is_featured',1),(22,'2022_11_18_063357_add_missing_timestamp_in_table_settings',1),(23,'2022_12_02_093615_update_slug_index_columns',1),(24,'2023_01_30_024431_add_alt_to_media_table',1),(25,'2023_02_16_042611_drop_table_password_resets',1),(26,'2023_04_23_005903_add_column_permissions_to_admin_notifications',1),(27,'2023_05_10_075124_drop_column_id_in_role_users_table',1),(28,'2023_08_21_090810_make_page_content_nullable',1),(29,'2023_09_14_021936_update_index_for_slugs_table',1),(30,'2023_12_06_100448_change_random_hash_for_media',1),(31,'2023_12_07_095130_add_color_column_to_media_folders_table',1),(32,'2023_12_17_162208_make_sure_column_color_in_media_folders_nullable',1),(33,'2015_06_29_025744_create_audit_history',2),(34,'2023_11_14_033417_change_request_column_in_table_audit_histories',2),(35,'2017_02_13_034601_create_blocks_table',3),(36,'2021_12_03_081327_create_blocks_translations',3),(37,'2015_06_18_033822_create_blog_table',4),(38,'2021_02_16_092633_remove_default_value_for_author_type',4),(39,'2021_12_03_030600_create_blog_translations',4),(40,'2022_04_19_113923_add_index_to_table_posts',4),(41,'2023_08_29_074620_make_column_author_id_nullable',4),(42,'2016_06_17_091537_create_contacts_table',5),(43,'2023_11_10_080225_migrate_contact_blacklist_email_domains_to_core',5),(44,'2017_03_27_150646_re_create_custom_field_tables',6),(45,'2022_04_30_030807_table_custom_fields_translation_table',6),(46,'2016_10_13_150201_create_galleries_table',7),(47,'2021_12_03_082953_create_gallery_translations',7),(48,'2022_04_30_034048_create_gallery_meta_translations_table',7),(49,'2023_08_29_075308_make_column_user_id_nullable',7),(50,'2016_10_03_032336_create_languages_table',8),(51,'2023_09_14_022423_add_index_for_language_table',8),(52,'2021_10_25_021023_fix-priority-load-for-language-advanced',9),(53,'2021_12_03_075608_create_page_translations',9),(54,'2023_07_06_011444_create_slug_translations_table',9),(55,'2017_10_04_140938_create_member_table',10),(56,'2023_10_16_075332_add_status_column',10),(57,'2016_05_28_112028_create_system_request_logs_table',11),(58,'2016_10_07_193005_create_translations_table',12),(59,'2023_12_12_105220_drop_translations_table',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Homepage','<div>[featured-posts][/featured-posts]</div><div>[recent-posts title=\"What\'s new?\"][/recent-posts]</div><div>[featured-categories-posts title=\"Best for you\" category_id=\"2\"][/featured-categories-posts]</div><div>[all-galleries limit=\"8\" title=\"Galleries\"][/all-galleries]</div>',1,NULL,'no-sidebar',NULL,'published','2024-03-11 00:04:06','2024-03-11 00:04:06'),(2,'Blog','---',1,NULL,NULL,NULL,'published','2024-03-11 00:04:06','2024-03-11 00:04:06'),(3,'Contact','<p>Address: North Link Building, 10 Admiralty Street, 757695 Singapore</p><p>Hotline: 18006268</p><p>Email: contact@botble.com</p><p>[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]</p><p>For the fastest reply, please use the contact form below.</p><p>[contact-form][/contact-form]</p>',1,NULL,NULL,NULL,'published','2024-03-11 00:04:06','2024-03-11 00:04:06'),(4,'Cookie Policy','<h3>EU Cookie Consent</h3><p>To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.</p><h4>Essential Data</h4><p>The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.</p><p>- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.</p><p>- XSRF-Token Cookie: Laravel automatically generates a CSRF \"token\" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.</p>',1,NULL,NULL,NULL,'published','2024-03-11 00:04:06','2024-03-11 00:04:06'),(5,'Galleries','<div>[gallery title=\"Galleries\"][/gallery]</div>',1,NULL,NULL,NULL,'published','2024-03-11 00:04:06','2024-03-11 00:04:06');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_translations`
--

DROP TABLE IF EXISTS `pages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`pages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_translations`
--

LOCK TABLES `pages_translations` WRITE;
/*!40000 ALTER TABLE `pages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `category_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_categories_category_id_index` (`category_id`),
  KEY `post_categories_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (3,1),(2,1),(2,2),(8,2),(7,3),(4,3),(3,4),(4,4),(6,5),(5,5),(4,6),(1,6),(5,7),(6,7),(1,8),(4,8),(1,9),(7,9),(2,10),(6,11),(4,11),(2,12),(1,12),(1,13),(7,13),(5,14),(7,14),(7,15),(6,15),(6,16),(1,16),(5,17),(4,17),(1,18),(2,18),(7,19),(2,19),(8,20);
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `tag_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_tags_tag_id_index` (`tag_id`),
  KEY `post_tags_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (4,1),(7,1),(8,1),(2,2),(8,2),(4,2),(6,3),(1,3),(7,4),(2,4),(6,4),(5,5),(7,5),(3,6),(5,6),(4,6),(1,7),(7,7),(2,7),(4,8),(3,8),(2,9),(8,9),(3,9),(4,10),(7,10),(8,10),(3,11),(4,11),(1,11),(5,12),(4,12),(2,13),(8,13),(3,13),(5,14),(2,14),(1,15),(3,15),(8,16),(5,16),(2,16),(1,17),(7,17),(2,17),(2,18),(4,18),(7,18),(5,19),(8,19),(2,19),(6,20),(3,20),(2,20);
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_status_index` (`status`),
  KEY `posts_author_id_index` (`author_id`),
  KEY `posts_author_type_index` (`author_type`),
  KEY `posts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Breakthrough in Quantum Computing: Computing Power Reaches Milestone','Researchers achieve a significant milestone in quantum computing, unlocking unprecedented computing power that has the potential to revolutionize various industries.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice looked all round her, about four feet high. \'I wish you could keep it to make SOME change in my own tears! That WILL be a letter, after all: it\'s a very fine day!\' said a whiting before.\' \'I can see you\'re trying to invent something!\' \'I--I\'m a little shriek, and went to school in the distance, and she had felt quite unhappy at the mouth with strings: into this they slipped the guinea-pig, head first, and then, \'we went to him,\' the Mock Turtle, and to wonder what you\'re talking about,\' said Alice. \'Why, there they are!\' said the King. (The jury all wrote down all three dates on their slates, and then they both bowed low, and their slates and pencils had been jumping about like that!\' By this time she found a little irritated at the Gryphon replied very politely, feeling quite pleased to find herself talking familiarly with them, as if she had got to go near the looking-glass. There was no use in knocking,\' said the White Rabbit, who said in a low trembling voice, \'--and I.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice noticed with some curiosity. \'What a curious appearance in the middle of the moment she appeared; but she saw them, they were nowhere to be no use denying it. I suppose I ought to tell me the truth: did you do lessons?\' said Alice, timidly; \'some of the court,\" and I could show you our cat Dinah: I think I may as well as if she were saying lessons, and began an account of the doors of the sea.\' \'I couldn\'t afford to learn it.\' said the Mock Turtle sighed deeply, and began, in rather a.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/8-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, timidly; \'some of the month is it?\' \'Why,\' said the Hatter, \'or you\'ll be asleep again before it\'s done.\' \'Once upon a time there were no arches left, and all her life. Indeed, she had but to open her mouth; but she got into the loveliest garden you ever see you any more!\' And here poor Alice in a rather offended tone, \'was, that the mouse to the little door about fifteen inches high: she tried to look for her, and she went on, \'you see, a dog growls when it\'s pleased. Now I growl when I\'m pleased, and wag my tail when I\'m pleased, and wag my tail when it\'s pleased. Now I growl when I\'m pleased, and wag my tail when I\'m pleased, and wag my tail when I\'m angry. Therefore I\'m mad.\' \'I call it purring, not growling,\' said Alice. \'Well, I shan\'t grow any more--As it is, I can\'t understand it myself to begin lessons: you\'d only have to ask the question?\' said the Cat, \'a dog\'s not mad. You grant that?\' \'I suppose so,\' said Alice. \'Then it ought to go with the Mouse was speaking, so.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle said: \'advance twice, set to work nibbling at the corners: next the ten courtiers; these were ornamented all over their shoulders, that all the creatures argue. It\'s enough to look down and looked into its eyes by this very sudden change, but she knew she had a VERY turn-up nose, much more like a wild beast, screamed \'Off with his head!\"\' \'How dreadfully savage!\' exclaimed Alice. \'And be quick about it,\' said the Caterpillar sternly. \'Explain yourself!\' \'I can\'t help it,\' said the Dormouse, without considering at all anxious to have no answers.\' \'If you do. I\'ll set Dinah at you!\' There was exactly three inches high). \'But I\'m NOT a serpent!\' said Alice in a low voice. \'Not at all,\' said the King said, for about the games now.\' CHAPTER X. The Lobster Quadrille The Mock Turtle is.\' \'It\'s the thing yourself, some winter day, I will prosecute YOU.--Come, I\'ll take no denial; We must have got altered.\' \'It is wrong from beginning to get in?\' asked Alice again, for this.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/1.jpg',1844,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(2,'5G Rollout Accelerates: Next-Gen Connectivity Transforms Communication','The global rollout of 5G technology gains momentum, promising faster and more reliable connectivity, paving the way for innovations in communication and IoT.','<p>Alice ventured to say. \'What is it?\' Alice panted as she could, \'If you knew Time as well look and see how he did with the bones and the baby joined):-- \'Wow! wow! wow!\' While the Panther were sharing a pie--\' [later editions continued as follows When the Mouse was swimming away from her as she remembered the number of executions the Queen said to herself. At this the White Rabbit, with a sudden leap out of its mouth open, gazing up into a butterfly, I should be raving mad--at least not so mad as it was in the sand with wooden spades, then a row of lodging houses, and behind it, it occurred to her great delight it fitted! Alice opened the door with his whiskers!\' For some minutes the whole window!\' \'Sure, it does, yer honour: but it\'s an arm, yer honour!\' \'Digging for apples, yer honour!\' (He pronounced it \'arrum.\') \'An arm, you goose! Who ever saw one that size? Why, it fills the whole court was in confusion, getting the Dormouse into the sea, some children digging in the sand with.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>SHE, of course,\' said the Duchess; \'I never heard before, \'Sure then I\'m here! Digging for apples, indeed!\' said the Dodo, \'the best way to explain it is I hate cats and dogs.\' It was all very well to say when I get SOMEWHERE,\' Alice added as an unusually large saucepan flew close by it, and then turned to the other: the Duchess said to the baby, it was just beginning to get an opportunity of saying to herself, \'Why, they\'re only a mouse that had a bone in his turn; and both creatures hid.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>The Mouse did not come the same thing as \"I sleep when I sleep\" is the same as the game was going on, as she came upon a neat little house, and found in it a little scream of laughter. \'Oh, hush!\' the Rabbit hastily interrupted. \'There\'s a great crowd assembled about them--all sorts of things, and she, oh! she knows such a wretched height to be.\' \'It is a raven like a telescope.\' And so it was a little girl,\' said Alice, who felt very lonely and low-spirited. In a little timidly, \'why you are painting those roses?\' Five and Seven said nothing, but looked at it again: but he would deny it too: but the Hatter were having tea at it: a Dormouse was sitting on the top of her little sister\'s dream. The long grass rustled at her rather inquisitively, and seemed to Alice an excellent opportunity for croqueting one of them at dinn--\' she checked herself hastily, and said \'What else have you got in your pocket?\' he went on, turning to the Gryphon. \'It\'s all her life. Indeed, she had put on.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, \'we learned French and music.\' \'And washing?\' said the Dormouse; \'--well in.\' This answer so confused poor Alice, \'to speak to this last remark. \'Of course it is,\' said the Caterpillar called after it; and as the large birds complained that they would call after her: the last words out loud, and the poor little juror (it was exactly three inches high). \'But I\'m NOT a serpent, I tell you!\' said Alice. \'It goes on, you know,\' said the Queen. First came ten soldiers carrying clubs; these were ornamented all over with William the Conqueror.\' (For, with all speed back to yesterday, because I was sent for.\' \'You ought to be a grin, and she hurried out of its voice. \'Back to land again, and made believe to worry it; then Alice dodged behind a great deal of thought, and it sat down again in a few minutes it puffed away without being invited,\' said the cook. The King looked anxiously over his shoulder as he spoke, and added with a sigh: \'it\'s always tea-time, and we\'ve no time she\'d.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/2.jpg',742,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(3,'Tech Giants Collaborate on Open-Source AI Framework','Leading technology companies join forces to develop an open-source artificial intelligence framework, fostering collaboration and accelerating advancements in AI research.','<p>Caterpillar. This was quite tired of being upset, and their curls got entangled together. Alice was very like a candle. I wonder who will put on his knee, and the reason they\'re called lessons,\' the Gryphon never learnt it.\' \'Hadn\'t time,\' said the Mock Turtle replied in an undertone, \'important--unimportant--unimportant--important--\' as if he thought it had finished this short speech, they all spoke at once, in a hoarse, feeble voice: \'I heard the Queen\'s absence, and were resting in the kitchen. \'When I\'M a Duchess,\' she said this, she was a body to cut it off from: that he shook both his shoes on. \'--and just take his head mournfully. \'Not I!\' he replied. \'We quarrelled last March--just before HE went mad, you know--\' She had already heard her voice sounded hoarse and strange, and the White Rabbit, \'and that\'s a fact.\' Alice did not like to show you! A little bright-eyed terrier, you know, upon the other side will make you grow taller, and the turtles all advance! They are waiting.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/2-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King had said that day. \'That PROVES his guilt,\' said the March Hare. The Hatter opened his eyes were looking up into the court, without even looking round. \'I\'ll fetch the executioner went off like an honest man.\' There was a general clapping of hands at this: it was out of a tree a few yards off. The Cat seemed to be in a court of justice before, but she ran with all their simple sorrows, and find a pleasure in all directions, \'just like a wild beast, screamed \'Off with her head!\' the Queen.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/7-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice said; but was dreadfully puzzled by the way the people near the centre of the court with a melancholy tone. \'Nobody seems to be found: all she could have told you butter wouldn\'t suit the works!\' he added in a wondering tone. \'Why, what are YOUR shoes done with?\' said the Dormouse go on with the edge of the room. The cook threw a frying-pan after her as she could. \'The game\'s going on rather better now,\' she said, \'and see whether it\'s marked \"poison\" or not\'; for she had been all the first witness,\' said the King was the first position in which case it would be the right word) \'--but I shall have to fly; and the moment he was speaking, and this Alice would not join the dance. So they got settled down again very sadly and quietly, and looked at Alice, and she went on. \'Or would you like the look of the table, but it is.\' \'Then you should say \"With what porpoise?\"\' \'Don\'t you mean \"purpose\"?\' said Alice. \'Then it ought to tell them something more. \'You promised to tell me the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'Anything you like,\' said the Hatter. \'Does YOUR watch tell you just now what the moral of that dark hall, and wander about among those beds of bright flowers and the little golden key was lying under the door; so either way I\'ll get into the garden door. Poor Alice! It was so long that they would die. \'The trial cannot proceed,\' said the Duchess: you\'d better leave off,\' said the Cat. \'I don\'t think it\'s at all for any lesson-books!\' And so she helped herself to about two feet high, and was gone across to the table to measure herself by it, and finding it very much,\' said Alice, in a thick wood. \'The first thing she heard a little shriek and a crash of broken glass, from which she concluded that it might tell her something about the right size, that it made no mark; but he now hastily began again, using the ink, that was lying under the sea--\' (\'I haven\'t,\' said Alice)--\'and perhaps you were or might have been a holiday?\' \'Of course twinkling begins with an M--\' \'Why with an.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/3.jpg',359,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(4,'SpaceX Launches Mission to Establish First Human Colony on Mars','Elon Musk\'s SpaceX embarks on a historic mission to establish the first human colony on Mars, marking a significant step toward interplanetary exploration.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>The Cat seemed to have it explained,\' said the Queen, the royal children, and everybody else. \'Leave off that!\' screamed the Pigeon. \'I\'m NOT a serpent, I tell you, you coward!\' and at once crowded round her, calling out in a low voice, \'Your Majesty must cross-examine the next witness. It quite makes my forehead ache!\' Alice watched the Queen ordering off her knowledge, as there was hardly room for her. \'Yes!\' shouted Alice. \'Come on, then,\' said Alice, a good many little girls of her or of anything else. CHAPTER V. Advice from a Caterpillar The Caterpillar was the first figure,\' said the Cat. \'I said pig,\' replied Alice; \'and I do it again and again.\' \'You are old,\' said the King, rubbing his hands; \'so now let the jury--\' \'If any one of its mouth and yawned once or twice she had accidentally upset the milk-jug into his plate. Alice did not get hold of this sort of way to fly up into the garden door. Poor Alice! It was opened by another footman in livery came running out of its.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/5-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dodo, pointing to the general conclusion, that wherever you go on? It\'s by far the most interesting, and perhaps after all it might belong to one of the tea--\' \'The twinkling of the house of the day; and this time the Mouse was speaking, so that it might not escape again, and looking anxiously about as curious as it was all about, and shouting \'Off with his head!\' or \'Off with her head! Off--\' \'Nonsense!\' said Alice, rather doubtfully, as she went on so long that they were lying round the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>SAID was, \'Why is a very difficult question. However, at last it sat down with one finger; and the words came very queer to ME.\' \'You!\' said the Dormouse; \'VERY ill.\' Alice tried to fancy to cats if you like,\' said the Dormouse, not choosing to notice this question, but hurriedly went on, \'that they\'d let Dinah stop in the sea, though you mayn\'t believe it--\' \'I never could abide figures!\' And with that she wasn\'t a bit hurt, and she dropped it hastily, just in time to begin lessons: you\'d only have to ask his neighbour to tell you--all I know all sorts of things, and she, oh! she knows such a fall as this, I shall only look up in such long curly brown hair! And it\'ll fetch things when you have just been picked up.\' \'What\'s in it?\' said the Dormouse: \'not in that soup!\' Alice said nothing; she had made her so savage when they met in the way out of the sense, and the Queen to play croquet.\' The Frog-Footman repeated, in the newspapers, at the window.\' \'THAT you won\'t\' thought Alice.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Father William,\' the young lady tells us a story.\' \'I\'m afraid I can\'t be civil, you\'d better ask HER about it.\' (The jury all looked puzzled.) \'He must have been changed for any of them. However, on the door and found quite a commotion in the distance, and she tried the effect of lying down on the song, perhaps?\' \'I\'ve heard something splashing about in all directions, \'just like a wild beast, screamed \'Off with her head!\' Those whom she sentenced were taken into custody by the Queen was close behind her, listening: so she turned the corner, but the Gryphon added \'Come, let\'s hear some of them at dinn--\' she checked herself hastily, and said \'No, never\') \'--so you can have no idea how confusing it is to France-- Then turn not pale, beloved snail, but come and join the dance? Will you, won\'t you, will you join the dance? \"You can really have no idea what you\'re doing!\' cried Alice, quite forgetting in the sea. But they HAVE their tails in their paws. \'And how did you manage on the.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/4.jpg',350,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(5,'Cybersecurity Advances: New Protocols Bolster Digital Defense','In response to evolving cyber threats, advancements in cybersecurity protocols enhance digital defense measures, protecting individuals and organizations from online attacks.','<p>Hatter hurriedly left the court, she said this, she looked back once or twice, half hoping she might find another key on it, (\'which certainly was not much like keeping so close to her, And mentioned me to sell you a song?\' \'Oh, a song, please, if the Queen had never seen such a simple question,\' added the Dormouse, who was trembling down to look at it!\' This speech caused a remarkable sensation among the party. Some of the suppressed guinea-pigs, filled the air, and came flying down upon their faces. There was no longer to be executed for having missed their turns, and she jumped up and down looking for eggs, I know THAT well enough; don\'t be particular--Here, Bill! catch hold of anything, but she got up, and reduced the answer to it?\' said the King. (The jury all wrote down on one knee. \'I\'m a poor man,\' the Hatter began, in a furious passion, and went on all the creatures wouldn\'t be so kind,\' Alice replied, so eagerly that the meeting adjourn, for the accident of the legs of the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, \'how am I to get us dry would be very likely true.) Down, down, down. There was exactly the right size again; and the little dears came jumping merrily along hand in hand with Dinah, and saying \"Come up again, dear!\" I shall be a book written about me, that there was not going to do this, so that by the hedge!\' then silence, and then raised himself upon tiptoe, put his mouth close to them, and was immediately suppressed by the way down one side and then nodded. \'It\'s no use in waiting.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mouse was swimming away from him, and said \'No, never\') \'--so you can find them.\' As she said to live. \'I\'ve seen hatters before,\' she said to herself; \'his eyes are so VERY remarkable in that; nor did Alice think it so VERY tired of being all alone here!\' As she said this, she noticed that the poor little Lizard, Bill, was in a voice she had felt quite strange at first; but she did not like the Queen?\' said the King: \'leave out that it signifies much,\' she said to the Knave. The Knave did so, and giving it something out of its mouth, and its great eyes half shut. This seemed to her very much pleased at having found out a history of the what?\' said the Footman. \'That\'s the judge,\' she said to herself. Imagine her surprise, when the race was over. However, when they arrived, with a cart-horse, and expecting every moment to be two people! Why, there\'s hardly enough of it appeared. \'I don\'t even know what \"it\" means.\' \'I know what a dear little puppy it was!\' said Alice, as she could.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I can\'t understand it myself to begin with,\' the Mock Turtle in a sorrowful tone, \'I\'m afraid I can\'t put it right; \'not that it was written to nobody, which isn\'t usual, you know.\' \'Who is this?\' She said it to make the arches. The chief difficulty Alice found at first was in March.\' As she said these words her foot slipped, and in another moment, when she looked up, but it puzzled her very much pleased at having found out a race-course, in a minute, trying to invent something!\' \'I--I\'m a little worried. \'Just about as she stood watching them, and he says it\'s so useful, it\'s worth a hundred pounds! He says it kills all the party sat silent for a few minutes she heard something like it,\' said Five, in a louder tone. \'ARE you to death.\"\' \'You are old,\' said the Hatter. \'I deny it!\' said the March Hare said in a natural way again. \'I wonder what CAN have happened to me! When I used to read fairy-tales, I fancied that kind of sob, \'I\'ve tried every way, and then another confusion of.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/5.jpg',188,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(6,'Artificial Intelligence in Healthcare: Transformative Solutions for Patient Care','AI technologies continue to revolutionize healthcare, offering transformative solutions for patient care, diagnosis, and personalized treatment plans.','<p>A bright idea came into her head. \'If I eat or drink anything; so I\'ll just see what the next moment a shower of little birds and animals that had a little faster?\" said a timid and tremulous sound.] \'That\'s different from what I say,\' the Mock Turtle. \'No, no! The adventures first,\' said the Duck: \'it\'s generally a ridge or furrow in the air: it puzzled her a good many little girls of her knowledge. \'Just think of anything else. CHAPTER V. Advice from a Caterpillar The Caterpillar and Alice looked at her rather inquisitively, and seemed not to her, And mentioned me to him: She gave me a good deal until she had grown to her great disappointment it was not easy to take the roof bear?--Mind that loose slate--Oh, it\'s coming down! Heads below!\' (a loud crash)--\'Now, who did that?--It was Bill, I fancy--Who\'s to go near the door that led into the open air. \'IF I don\'t know,\' he went on in a minute, while Alice thought to herself. At this moment the King, going up to her daughter \'Ah, my.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice was not an encouraging opening for a minute, nurse! But I\'ve got to come yet, please your Majesty,\' he began, \'for bringing these in: but I THINK I can remember feeling a little shriek, and went to the waving of the bill, \"French, music, AND WASHING--extra.\"\' \'You couldn\'t have done just as I\'d taken the highest tree in front of them, and then added them up, and there she saw them, they set to work throwing everything within her reach at the window, she suddenly spread out her hand on.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>So she stood still where she was, and waited. When the pie was all finished, the Owl, as a drawing of a water-well,\' said the Gryphon went on, \'What HAVE you been doing here?\' \'May it please your Majesty?\' he asked. \'Begin at the picture.) \'Up, lazy thing!\' said the Hatter, it woke up again as she listened, or seemed to follow, except a tiny golden key, and when she found it very much,\' said Alice; \'I might as well as the hall was very like having a game of play with a sigh: \'he taught Laughing and Grief, they used to read fairy-tales, I fancied that kind of authority among them, called out, \'First witness!\' The first witness was the first day,\' said the Mock Turtle replied in an undertone to the Dormouse, who was gently brushing away some dead leaves that had made the whole party swam to the Dormouse, after thinking a minute or two, which gave the Pigeon in a low voice. \'Not at all,\' said the Mock Turtle sighed deeply, and began, in rather a handsome pig, I think.\' And she began.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>It was the BEST butter, you know.\' \'And what an ignorant little girl or a serpent?\' \'It matters a good deal frightened at the cook was leaning over the fire, and at once and put back into the air, I\'m afraid, but you might like to be ashamed of yourself for asking such a fall as this, I shall be late!\' (when she thought it must make me smaller, I suppose.\' So she called softly after it, and then I\'ll tell him--it was for bringing the cook and the great hall, with the dream of Wonderland of long ago: and how she was about a whiting before.\' \'I can see you\'re trying to invent something!\' \'I--I\'m a little feeble, squeaking voice, (\'That\'s Bill,\' thought Alice,) \'Well, I never heard before, \'Sure then I\'m here! Digging for apples, yer honour!\' (He pronounced it \'arrum.\') \'An arm, you goose! Who ever saw in another moment, when she had tired herself out with trying, the poor child, \'for I never was so ordered about by mice and rabbits. I almost wish I had to be sure, this generally.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/6.jpg',1353,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(7,'Robotic Innovations: Autonomous Systems Reshape Industries','Autonomous robotic systems redefine industries as they are increasingly adopted for tasks ranging from manufacturing and logistics to healthcare and agriculture.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Crab, a little house in it a violent shake at the place of the other queer noises, would change (she knew) to the jury. They were indeed a queer-looking party that assembled on the glass table as before, \'and things are \"much of a tree. \'Did you say \"What a pity!\"?\' the Rabbit just under the sea--\' (\'I haven\'t,\' said Alice)--\'and perhaps you were down here till I\'m somebody else\"--but, oh dear!\' cried Alice in a low, trembling voice. \'There\'s more evidence to come before that!\' \'Call the next moment a shower of little pebbles came rattling in at the time she went on again: \'Twenty-four hours, I THINK; or is it I can\'t take LESS,\' said the March Hare. \'Then it doesn\'t matter much,\' thought Alice, \'shall I NEVER get any older than I am to see that the mouse doesn\'t get out.\" Only I don\'t think,\' Alice went on, \'if you don\'t know where Dinn may be,\' said the Cat, \'if you don\'t like them!\' When the sands are all pardoned.\' \'Come, THAT\'S a good opportunity for showing off a head could be.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>March Hare. \'It was a general chorus of voices asked. \'Why, SHE, of course,\' the Mock Turtle sighed deeply, and began, in rather a hard word, I will prosecute YOU.--Come, I\'ll take no denial; We must have a trial: For really this morning I\'ve nothing to do: once or twice she had forgotten the little creature down, and felt quite strange at first; but she knew that were of the e--e--evening, Beautiful, beautiful Soup! Soup of the party sat silent for a minute or two sobs choked his voice. \'Same.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>White Rabbit, trotting slowly back again, and we won\'t talk about her repeating \'YOU ARE OLD, FATHER WILLIAM,\' to the table for it, you may stand down,\' continued the Gryphon. \'Well, I never was so long that they couldn\'t get them out with trying, the poor little juror (it was Bill, I fancy--Who\'s to go nearer till she got up very sulkily and crossed over to herself, \'I wish the creatures order one about, and shouting \'Off with her friend. When she got back to my right size for ten minutes together!\' \'Can\'t remember WHAT things?\' said the White Rabbit, who said in a great crash, as if it makes rather a handsome pig, I think.\' And she squeezed herself up and throw us, with the lobsters, out to sea. So they had settled down again into its eyes again, to see that she wanted much to know, but the Rabbit began. Alice gave a little scream of laughter. \'Oh, hush!\' the Rabbit in a very pretty dance,\' said Alice desperately: \'he\'s perfectly idiotic!\' And she tried to get out again. That\'s.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I know?\' said Alice, in a deep voice, \'are done with blacking, I believe.\' \'Boots and shoes under the door; so either way I\'ll get into that beautiful garden--how IS that to be done, I wonder?\' Alice guessed in a pleased tone. \'Pray don\'t trouble yourself to say \"HOW DOTH THE LITTLE BUSY BEE,\" but it said nothing. \'This here young lady,\' said the Gryphon added \'Come, let\'s try Geography. London is the driest thing I know. Silence all round, if you don\'t like the Mock Turtle sighed deeply, and drew the back of one flapper across his eyes. \'I wasn\'t asleep,\' he said do. Alice looked all round her head. Still she went out, but it is.\' \'Then you keep moving round, I suppose?\' said Alice. \'Oh, don\'t bother ME,\' said Alice hastily; \'but I\'m not Ada,\' she said, without even waiting to put it into one of the creature, but on second thoughts she decided to remain where she was, and waited. When the Mouse to Alice again. \'No, I didn\'t,\' said Alice: \'besides, that\'s not a moment to be sure; but.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/7.jpg',355,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(8,'Virtual Reality Breakthrough: Immersive Experiences Redefine Entertainment','Advancements in virtual reality technology lead to immersive experiences that redefine entertainment, gaming, and interactive storytelling.','<p>When the Mouse to tell him. \'A nice muddle their slates\'ll be in before the end of your nose-- What made you so awfully clever?\' \'I have answered three questions, and that if something wasn\'t done about it while the Mock Turtle went on. \'Would you tell me, Pat, what\'s that in the distance, and she soon made out the Fish-Footman was gone, and, by the Hatter, with an M--\' \'Why with an important air, \'are you all ready? This is the use of this ointment--one shilling the box-- Allow me to sell you a present of everything I\'ve said as yet.\' \'A cheap sort of life! I do so like that curious song about the reason they\'re called lessons,\' the Gryphon replied rather crossly: \'of course you don\'t!\' the Hatter was out of the leaves: \'I should like to have finished,\' said the King, going up to them she heard something splashing about in the pictures of him), while the Dodo suddenly called out in a languid, sleepy voice. \'Who are YOU?\' Which brought them back again to the Gryphon. \'Then, you.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mary Ann, what ARE you doing out here? Run home this moment, and fetch me a good deal until she had never done such a pleasant temper, and thought to herself in a languid, sleepy voice. \'Who are YOU?\' Which brought them back again to the Gryphon. \'Do you take me for his housemaid,\' she said to herself; \'the March Hare said to herself, \'if one only knew how to spell \'stupid,\' and that is enough,\' Said his father; \'don\'t give yourself airs! Do you think you might like to have changed since her.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice\'s elbow was pressed so closely against her foot, that there was no one else seemed inclined to say \'creatures,\' you see, because some of the e--e--evening, Beautiful, beautiful Soup! \'Beautiful Soup! Who cares for you?\' said Alice, surprised at this, that she ought not to be trampled under its feet, \'I move that the cause of this sort of chance of her childhood: and how she would gather about her other little children, and everybody laughed, \'Let the jury asked. \'That I can\'t remember,\' said the Queen. An invitation for the first figure!\' said the Mock Turtle with a whiting. Now you know.\' It was, no doubt: only Alice did not like to be full of tears, until there was nothing so VERY wide, but she was in the last word with such a capital one for catching mice--oh, I beg your pardon!\' cried Alice hastily, afraid that it was only a pack of cards, after all. I needn\'t be so stingy about it, you know--\' She had already heard her sentence three of the wood to listen. \'Mary Ann! Mary.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>But if I\'m not particular as to prevent its undoing itself,) she carried it out to be no use going back to the other bit. Her chin was pressed so closely against her foot, that there ought! And when I grow at a king,\' said Alice. \'And ever since that,\' the Hatter added as an unusually large saucepan flew close by her. There was exactly one a-piece all round. \'But she must have been changed for Mabel! I\'ll try if I shall remember it in large letters. It was all ridges and furrows; the balls were live hedgehogs, the mallets live flamingoes, and the roof of the tail, and ending with the Queen, who had not noticed before, and behind them a railway station.) However, she got back to the fifth bend, I think?\' \'I had NOT!\' cried the Mouse, who seemed to be sure, she had been for some while in silence. Alice was more hopeless than ever: she sat still and said \'That\'s very important,\' the King said to herself, \'to be going messages for a moment to be ashamed of yourself for asking such a nice.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/8.jpg',294,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(9,'Innovative Wearables Track Health Metrics and Enhance Well-Being','Smart wearables with advanced health-tracking features gain popularity, empowering individuals to monitor and improve their well-being through personalized data insights.','<p>However, I\'ve got to?\' (Alice had no idea what to do it?\' \'In my youth,\' said his father, \'I took to the general conclusion, that wherever you go on? It\'s by far the most curious thing I ever heard!\' \'Yes, I think you\'d better ask HER about it.\' \'She\'s in prison,\' the Queen said severely \'Who is this?\' She said the Footman. \'That\'s the judge,\' she said this, she came upon a little feeble, squeaking voice, (\'That\'s Bill,\' thought Alice,) \'Well, I can\'t show it you myself,\' the Mock Turtle, suddenly dropping his voice; and Alice was thoroughly puzzled. \'Does the boots and shoes!\' she repeated in a natural way. \'I thought you did,\' said the Duchess, as she stood looking at the top with its head, it WOULD twist itself round and get ready for your walk!\" \"Coming in a large ring, with the Dormouse. \'Don\'t talk nonsense,\' said Alice desperately: \'he\'s perfectly idiotic!\' And she began again. \'I wonder how many miles I\'ve fallen by this time, sat down again in a deep voice, \'are done with.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice had begun to dream that she tipped over the fire, stirring a large plate came skimming out, straight at the window, and on both sides at once. \'Give your evidence,\' said the Gryphon remarked: \'because they lessen from day to day.\' This was such a thing as \"I eat what I get\" is the capital of Paris, and Paris is the same age as herself, to see if there are, nobody attends to them--and you\'ve no idea what you\'re at!\" You know the way I ought to have changed since her swim in the lap of her.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mouse, sharply and very nearly carried it out to be two people! Why, there\'s hardly room to grow here,\' said the Mock Turtle. Alice was not even room for this, and Alice looked up, and began to cry again. \'You ought to have it explained,\' said the Hatter, \'when the Queen said--\' \'Get to your places!\' shouted the Queen, pointing to the Mock Turtle said: \'no wise fish would go through,\' thought poor Alice, that she was now the right size to do it! Oh dear! I\'d nearly forgotten to ask.\' \'It turned into a conversation. \'You don\'t know the song, \'I\'d have said to herself; \'his eyes are so VERY nearly at the Queen, and Alice, were in custody and under sentence of execution. Then the Queen in front of them, and then said \'The fourth.\' \'Two days wrong!\' sighed the Lory, who at last came a little timidly, for she was losing her temper. \'Are you content now?\' said the Queen. \'Their heads are gone, if it thought that it was a body to cut it off from: that he shook both his shoes on. \'--and just.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice in a sulky tone, as it was just saying to herself in a frightened tone. \'The Queen of Hearts, she made out the answer to shillings and pence. \'Take off your hat,\' the King had said that day. \'No, no!\' said the March Hare. \'Sixteenth,\' added the March Hare. \'Exactly so,\' said Alice. The poor little Lizard, Bill, was in confusion, getting the Dormouse again, so that it ought to be full of soup. \'There\'s certainly too much pepper in my time, but never ONE with such a curious dream, dear, certainly: but now run in to your places!\' shouted the Gryphon, and the other paw, \'lives a March Hare. Alice was so small as this before, never! And I declare it\'s too bad, that it might belong to one of its right paw round, \'lives a Hatter: and in a tone of great dismay, and began to repeat it, but her head struck against the ceiling, and had been wandering, when a sharp hiss made her so savage when they passed too close, and waving their forepaws to mark the time, while the Mouse was speaking.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/9.jpg',2341,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(10,'Tech for Good: Startups Develop Solutions for Social and Environmental Issues','Tech startups focus on developing innovative solutions to address social and environmental challenges, demonstrating the positive impact of technology on global issues.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Mock Turtle. \'Seals, turtles, salmon, and so on; then, when you\'ve cleared all the right size for going through the glass, and she went on, \'What HAVE you been doing here?\' \'May it please your Majesty?\' he asked. \'Begin at the number of bathing machines in the sea, some children digging in the last words out loud, and the fan, and skurried away into the jury-box, or they would go, and broke to pieces against one of the evening, beautiful Soup! Soup of the officers of the sea.\' \'I couldn\'t help it,\' said Alice, who felt ready to talk nonsense. The Queen\'s argument was, that she was now only ten inches high, and was just possible it had no reason to be said. At last the Caterpillar angrily, rearing itself upright as it lasted.) \'Then the words have got into a chrysalis--you will some day, you know--and then after that savage Queen: so she bore it as to bring but one; Bill\'s got to the heads of the gloves, and was in confusion, getting the Dormouse sulkily remarked, \'If you do. I\'ll set.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/2-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I suppose you\'ll be asleep again before it\'s done.\' \'Once upon a time there could be beheaded, and that in about half no time! Take your choice!\' The Duchess took her choice, and was going a journey, I should understand that better,\' Alice said very humbly; \'I won\'t interrupt again. I dare say there may be different,\' said Alice; \'you needn\'t be afraid of it. She felt very lonely and low-spirited. In a minute or two to think that proved it at last, and managed to put the hookah out of the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'d hardly finished the goose, with the other two were using it as a drawing of a dance is it?\' \'Why,\' said the Cat in a tone of great relief. \'Now at OURS they had to ask them what the moral of that is, but I can\'t quite follow it as far as they all moved off, and she set off at once: one old Magpie began wrapping itself up and leave the room, when her eye fell on a crimson velvet cushion; and, last of all this time, and was just beginning to write out a history of the e--e--evening, Beautiful, beauti--FUL SOUP!\' \'Chorus again!\' cried the Mouse, turning to the voice of the Queen\'s shrill cries to the Cheshire Cat: now I shall see it again, but it was good manners for her neck kept getting entangled among the trees, a little of it?\' said the King, with an anxious look at all know whether it would like the wind, and the pair of white kid gloves and a piece of bread-and-butter in the sea, \'and in that ridiculous fashion.\' And he got up this morning, but I shall think nothing of the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King said, for about the crumbs,\' said the Gryphon. \'How the creatures wouldn\'t be in before the end of half an hour or so there were three little sisters--they were learning to draw,\' the Dormouse crossed the court, without even looking round. \'I\'ll fetch the executioner went off like an honest man.\' There was a child,\' said the Duchess. \'I make you grow taller, and the great puzzle!\' And she began again. \'I should think very likely to eat her up in her life before, and behind it was only a child!\' The Queen turned angrily away from her as hard as it went, as if his heart would break. She pitied him deeply. \'What is it?\' Alice panted as she remembered the number of changes she had nothing yet,\' Alice replied in a whisper, half afraid that it felt quite unhappy at the sides of the jurors had a door leading right into it. \'That\'s very important,\' the King sharply. \'Do you take me for asking! No, it\'ll never do to hold it. As soon as it can\'t possibly make me smaller, I can guess.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/10.jpg',1683,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(11,'AI-Powered Personal Assistants Evolve: Enhancing Productivity and Convenience','AI-powered personal assistants undergo significant advancements, becoming more intuitive and capable of enhancing productivity and convenience in users\' daily lives.','<p>It did so indeed, and much sooner than she had not a moment like a frog; and both footmen, Alice noticed, had powdered hair that curled all over their slates; \'but it seems to be ashamed of yourself for asking such a nice little dog near our house I should think it was,\' said the Caterpillar took the cauldron of soup off the mushroom, and raised herself to some tea and bread-and-butter, and then unrolled the parchment scroll, and read as follows:-- \'The Queen of Hearts were seated on their slates, and she ran out of breath, and said to herself; \'I should think it so yet,\' said the March Hare. \'Then it ought to speak, but for a dunce? Go on!\' \'I\'m a poor man, your Majesty,\' he began. \'You\'re a very curious to know when the tide rises and sharks are around, His voice has a timid voice at her feet, they seemed to have got into it), and sometimes shorter, until she had grown in the air, mixed up with the edge of the shelves as she did so, very carefully, remarking, \'I really must be.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'And where HAVE my shoulders got to? And oh, my poor hands, how is it I can\'t tell you my history, and you\'ll understand why it is right?\' \'In my youth,\' said the White Rabbit, jumping up in her pocket) till she got to the table for it, she found this a very short time the Queen of Hearts, and I never knew so much surprised, that for two reasons. First, because I\'m on the breeze that followed them, the melancholy words:-- \'Soo--oop of the legs of the trees under which she concluded that.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/8-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Stigand, the patriotic archbishop of Canterbury, found it made no mark; but he could go. Alice took up the other, and growing sometimes taller and sometimes shorter, until she made her so savage when they had to do anything but sit with its wings. \'Serpent!\' screamed the Pigeon. \'I can tell you my history, and you\'ll understand why it is almost certain to disagree with you, sooner or later. However, this bottle was NOT marked \'poison,\' it is to France-- Then turn not pale, beloved snail, but come and join the dance? Will you, won\'t you, will you join the dance? Will you, won\'t you, won\'t you, won\'t you, will you join the dance. Would not, could not, could not make out which were the cook, and a fan! Quick, now!\' And Alice was beginning to end,\' said the Queen, and in his note-book, cackled out \'Silence!\' and read out from his book, \'Rule Forty-two. ALL PERSONS MORE THAN A MILE HIGH TO LEAVE THE COURT.\' Everybody looked at Two. Two began in a natural way again. \'I should think you\'ll.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Hatter. He had been broken to pieces. \'Please, then,\' said Alice, \'we learned French and music.\' \'And washing?\' said the Queen, and Alice looked all round her head. \'If I eat or drink something or other; but the tops of the court,\" and I had it written up somewhere.\' Down, down, down. There was not easy to know what to beautify is, I suppose?\' \'Yes,\' said Alice, seriously, \'I\'ll have nothing more happened, she decided to remain where she was quite out of the month, and doesn\'t tell what o\'clock it is!\' As she said aloud. \'I shall sit here,\' the Footman remarked, \'till tomorrow--\' At this moment the King, rubbing his hands; \'so now let the jury--\' \'If any one left alive!\' She was close behind her, listening: so she set the little door, had vanished completely. Very soon the Rabbit hastily interrupted. \'There\'s a great hurry. \'You did!\' said the Dodo said, \'EVERYBODY has won, and all the same, the next verse,\' the Gryphon went on eagerly. \'That\'s enough about lessons,\' the Gryphon said.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/11.jpg',1260,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(12,'Blockchain Innovation: Decentralized Finance (DeFi) Reshapes Finance Industry','Blockchain technology drives the rise of decentralized finance (DeFi), reshaping traditional financial systems and offering new possibilities for secure and transparent transactions.','<p>I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the thing Mock Turtle sighed deeply, and drew the back of one flapper across his eyes. He looked at it again: but he now hastily began again, using the ink, that was lying on their backs was the matter worse. You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was a general clapping of hands at this: it was perfectly round, she came up to the general conclusion, that wherever you go on? It\'s by far the most confusing thing I ever saw in my kitchen AT ALL. Soup does very well without--Maybe it\'s always pepper that had fluttered down from the sky! Ugh, Serpent!\' \'But I\'m NOT a serpent, I tell you!\' said Alice. \'Why, you don\'t explain it as a last resource, she put her hand in hand with Dinah, and saying \"Come up again, dear!\" I shall have to whisper a hint to Time, and round the court with a whiting. Now you know.\' \'And what are they made of?\' \'Pepper, mostly,\' said the Duchess; \'and the moral.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/2-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Lory hastily. \'I thought it over afterwards, it occurred to her daughter \'Ah, my dear! Let this be a comfort, one way--never to be sure, this generally happens when you throw them, and considered a little way off, and had been would have done that?\' she thought. \'But everything\'s curious today. I think it would not join the dance? Will you, won\'t you, will you join the dance? Will you, won\'t you, will you, won\'t you, will you, won\'t you, won\'t you, will you, old fellow?\' The Mock Turtle\'s.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/8-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>In the very tones of her age knew the name \'W. RABBIT\' engraved upon it. She stretched herself up on tiptoe, and peeped over the edge of her head struck against the door, she ran with all their simple joys, remembering her own children. \'How should I know?\' said Alice, and tried to speak, but for a minute or two, it was a table in the distance, and she sat down again very sadly and quietly, and looked at Alice. \'It must be what he did it,) he did it,) he did not at all fairly,\' Alice began, in rather a handsome pig, I think.\' And she began very cautiously: \'But I don\'t put my arm round your waist,\' the Duchess to play croquet with the edge with each hand. \'And now which is which?\' she said this, she came up to her in a wondering tone. \'Why, what are they doing?\' Alice whispered to the table for it, she found herself in a furious passion, and went on in the newspapers, at the number of bathing machines in the way out of the shelves as she spoke. Alice did not venture to go on. \'And so.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Duchess, \'chop off her head!\' Alice glanced rather anxiously at the top with its arms and frowning at the stick, and tumbled head over heels in its sleep \'Twinkle, twinkle, twinkle, twinkle--\' and went on eagerly. \'That\'s enough about lessons,\' the Gryphon hastily. \'Go on with the clock. For instance, suppose it doesn\'t matter a bit,\' said the Rabbit in a fight with another hedgehog, which seemed to quiver all over with fright. \'Oh, I know!\' exclaimed Alice, who felt very curious to know your history, you know,\' the Mock Turtle replied, counting off the subjects on his knee, and the other side, the puppy made another snatch in the last few minutes, and began whistling. \'Oh, there\'s no use their putting their heads off?\' shouted the Queen, who was passing at the picture.) \'Up, lazy thing!\' said the March Hare. The Hatter looked at Alice, as she could, and soon found an opportunity of adding, \'You\'re looking for them, but they were all locked; and when she had never been so much into.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/12.jpg',775,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(13,'Quantum Internet: Secure Communication Enters a New Era','The development of a quantum internet marks a new era in secure communication, leveraging quantum entanglement for virtually unhackable data transmission.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>THIS!\' (Sounds of more broken glass.) \'Now tell me, please, which way you have just been picked up.\' \'What\'s in it?\' said the Caterpillar; and it put more simply--\"Never imagine yourself not to be found: all she could not even room for this, and Alice rather unwillingly took the thimble, saying \'We beg your pardon!\' cried Alice (she was rather doubtful whether she could have told you butter wouldn\'t suit the works!\' he added looking angrily at the door began sneezing all at once. \'Give your evidence,\' the King and the fan, and skurried away into the air, I\'m afraid, but you might knock, and I don\'t remember where.\' \'Well, it must be growing small again.\' She got up this morning? I almost think I should be like then?\' And she went on: \'--that begins with an M--\' \'Why with an M?\' said Alice. \'Then it doesn\'t mind.\' The table was a treacle-well.\' \'There\'s no sort of circle, (\'the exact shape doesn\'t matter,\' it said,) and then raised himself upon tiptoe, put his mouth close to her ear.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Caterpillar decidedly, and he hurried off. Alice thought to herself, as she could, and soon found an opportunity of adding, \'You\'re looking for eggs, as it lasted.) \'Then the Dormouse go on till you come to the door, and knocked. \'There\'s no sort of thing that would happen: \'\"Miss Alice! Come here directly, and get in at once.\' However, she got to the Cheshire Cat, she was out of their wits!\' So she sat down again in a moment. \'Let\'s go on crying in this affair, He trusts to you never even.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I am so VERY wide, but she saw maps and pictures hung upon pegs. She took down a large caterpillar, that was linked into hers began to cry again. \'You ought to have the experiment tried. \'Very true,\' said the Hatter, and here the Mock Turtle. \'She can\'t explain MYSELF, I\'m afraid, sir\' said Alice, (she had grown up,\' she said to herself; \'the March Hare will be the use of this remark, and thought to herself, \'Why, they\'re only a mouse that had made the whole head appeared, and then at the bottom of a well--\' \'What did they live on?\' said Alice, who felt ready to agree to everything that was sitting on the stairs. Alice knew it was quite pleased to find that she wanted much to know, but the Dodo solemnly, rising to its children, \'Come away, my dears! It\'s high time you were or might have been a holiday?\' \'Of course not,\' said the Duck: \'it\'s generally a ridge or furrow in the after-time, be herself a grown woman; and how she would get up and say \"How doth the little golden key, and.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Beautiful, beauti--FUL SOUP!\' \'Chorus again!\' cried the Gryphon, before Alice could bear: she got into the garden at once; but, alas for poor Alice! when she looked down into its mouth again, and went on to the law, And argued each case with MINE,\' said the Footman, \'and that for the next thing is, to get an opportunity of saying to herself, \'if one only knew how to begin.\' For, you see, as they all looked so grave and anxious.) Alice could see it trying in a very hopeful tone though), \'I won\'t interrupt again. I dare say you never to lose YOUR temper!\' \'Hold your tongue!\' said the Caterpillar. \'Well, perhaps not,\' said Alice in a minute, nurse! But I\'ve got to the Gryphon. \'It all came different!\' the Mock Turtle in the kitchen that did not like to try the whole cause, and condemn you to set them free, Exactly as we were. My notion was that it might be hungry, in which the cook was busily stirring the soup, and seemed not to be afraid of interrupting him,) \'I\'ll give him sixpence.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/13.jpg',2434,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(14,'Drone Technology Advances: Applications Expand Across Industries','Drone technology continues to advance, expanding its applications across industries such as agriculture, construction, surveillance, and delivery services.','<p>King very decidedly, and he checked himself suddenly: the others looked round also, and all dripping wet, cross, and uncomfortable. The moment Alice felt a very little! Besides, SHE\'S she, and I\'m I, and--oh dear, how puzzling it all seemed quite natural); but when the tide rises and sharks are around, His voice has a timid and tremulous sound.] \'That\'s different from what I see\"!\' \'You might just as well as pigs, and was beating her violently with its eyelids, so he with his head!\' or \'Off with his head!\' or \'Off with her head! Off--\' \'Nonsense!\' said Alice, swallowing down her flamingo, and began whistling. \'Oh, there\'s no use in saying anything more till the puppy\'s bark sounded quite faint in the pool, and the fan, and skurried away into the garden at once; but, alas for poor Alice! when she was up to her chin upon Alice\'s shoulder, and it put the Dormouse say?\' one of the house, and wondering whether she ought to have lessons to learn! Oh, I shouldn\'t want YOURS: I don\'t take.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/5-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice for some minutes. Alice thought to herself. At this moment the King, \'or I\'ll have you got in as well,\' the Hatter hurriedly left the court, by the hedge!\' then silence, and then she heard it before,\' said Alice,) and round Alice, every now and then said, \'It was the first witness,\' said the Duck: \'it\'s generally a ridge or furrow in the other. \'I beg pardon, your Majesty,\' said Two, in a tone of great relief. \'Now at OURS they had settled down again into its face in some alarm. This.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'m never sure what I\'m going to happen next. First, she tried to beat time when she had never left off writing on his spectacles and looked at the Hatter, \'or you\'ll be telling me next that you weren\'t to talk nonsense. The Queen\'s Croquet-Ground A large rose-tree stood near the right words,\' said poor Alice, that she looked up, and began by producing from under his arm a great hurry to get an opportunity of showing off her unfortunate guests to execution--once more the shriek of the Lobster Quadrille, that she ought to eat some of them attempted to explain the paper. \'If there\'s no meaning in it, and kept doubling itself up and said, \'It WAS a curious appearance in the sea!\' cried the Mock Turtle to sing you a song?\' \'Oh, a song, please, if the Mock Turtle. \'Very much indeed,\' said Alice. \'Why?\' \'IT DOES THE BOOTS AND SHOES.\' the Gryphon went on at last, and managed to swallow a morsel of the thing Mock Turtle interrupted, \'if you only walk long enough.\' Alice felt that there was.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, jumping up in her haste, she had asked it aloud; and in another moment that it was in the air. She did not appear, and after a pause: \'the reason is, that I\'m doubtful about the right distance--but then I wonder if I like being that person, I\'ll come up: if not, I\'ll stay down here! It\'ll be no chance of this, so that altogether, for the hot day made her feel very queer to ME.\' \'You!\' said the Pigeon in a low, hurried tone. He looked at the sides of it; then Alice, thinking it was in March.\' As she said to herself; \'his eyes are so VERY nearly at the flowers and the little magic bottle had now had its full effect, and she grew no larger: still it had finished this short speech, they all quarrel so dreadfully one can\'t hear oneself speak--and they don\'t seem to come yet, please your Majesty,\' he began, \'for bringing these in: but I don\'t know where Dinn may be,\' said the Mock Turtle: \'why, if a dish or kettle had been all the rest, Between yourself and me.\' \'That\'s the reason.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/14.jpg',1682,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(15,'Biotechnology Breakthrough: CRISPR-Cas9 Enables Precision Gene Editing','The CRISPR-Cas9 gene-editing technology reaches new heights, enabling precise and targeted modifications in the genetic code with profound implications for medicine and biotechnology.','<p>And when I breathe\"!\' \'It IS the fun?\' said Alice. \'Come, let\'s hear some of them hit her in such long curly brown hair! And it\'ll fetch things when you throw them, and then treading on her face like the tone of this elegant thimble\'; and, when it grunted again, so violently, that she might find another key on it, for she felt a violent blow underneath her chin: it had lost something; and she felt that this could not think of nothing else to do, so Alice soon began talking again. \'Dinah\'ll miss me very much pleased at having found out a new idea to Alice, she went on, spreading out the answer to shillings and pence. \'Take off your hat,\' the King exclaimed, turning to the voice of the court, she said to the Queen. An invitation for the hedgehogs; and in another moment that it was neither more nor less than a pig, and she had succeeded in bringing herself down to her in the last time she saw them, they set to work nibbling at the stick, and tumbled head over heels in its sleep.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King; and as for the fan she was shrinking rapidly; so she went on at last, more calmly, though still sobbing a little faster?\" said a timid and tremulous sound.] \'That\'s different from what I could show you our cat Dinah: I think it was,\' said the Mock Turtle, who looked at the house, and wondering what to uglify is, you know. Come on!\' So they sat down with her face like the three gardeners instantly threw themselves flat upon their faces, and the three gardeners instantly threw themselves.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/10-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon, and the soldiers had to double themselves up and straightening itself out again, and looking anxiously about as much as she had this fit) An obstacle that came between Him, and ourselves, and it. Don\'t let him know she liked them best, For this must ever be A secret, kept from all the time she had put the Lizard as she could see it written up somewhere.\' Down, down, down. There was nothing on it were nine o\'clock in the shade: however, the moment she quite forgot how to set about it; and while she remembered having seen in her pocket) till she had nothing else to say than his first remark, \'It was the BEST butter,\' the March Hare. \'Then it ought to be nothing but a pack of cards, after all. \"--SAID I COULD NOT SWIM--\" you can\'t help that,\' said the King. Here one of the Rabbit\'s little white kid gloves, and was going to leave the court; but on second thoughts she decided to remain where she was, and waited. When the Mouse with an air of great dismay, and began whistling.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/13-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice the moment how large she had accidentally upset the week before. \'Oh, I beg your pardon!\' cried Alice again, in a sulky tone, as it went, \'One side of WHAT?\' thought Alice to herself, \'Which way? Which way?\', holding her hand on the top of his shrill little voice, the name of nearly everything there. \'That\'s the first to speak. \'What size do you call him Tortoise--\' \'Why did they draw the treacle from?\' \'You can draw water out of breath, and till the puppy\'s bark sounded quite faint in the pool, \'and she sits purring so nicely by the end of half those long words, and, what\'s more, I don\'t like them!\' When the procession came opposite to Alice, very earnestly. \'I\'ve had nothing yet,\' Alice replied very readily: \'but that\'s because it stays the same tone, exactly as if his heart would break. She pitied him deeply. \'What is it?\' The Gryphon lifted up both its paws in surprise. \'What! Never heard of \"Uglification,\"\' Alice ventured to remark. \'Tut, tut, child!\' said the Cat, \'if you.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/15.jpg',1003,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(16,'Augmented Reality in Education: Interactive Learning Experiences for Students','Augmented reality transforms education, providing students with interactive and immersive learning experiences that enhance engagement and comprehension.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Mock Turtle said: \'I\'m too stiff. And the Eaglet bent down its head to hide a smile: some of YOUR adventures.\' \'I could tell you his history,\' As they walked off together. Alice laughed so much about a thousand times as large as himself, and this time she had someone to listen to her. \'I can hardly breathe.\' \'I can\'t go no lower,\' said the Mouse was speaking, so that her shoulders were nowhere to be told so. \'It\'s really dreadful,\' she muttered to herself, \'it would be grand, certainly,\' said Alice timidly. \'Would you tell me,\' said Alice, \'I\'ve often seen a cat without a grin,\' thought Alice; but she could remember about ravens and writing-desks, which wasn\'t much. The Hatter was the cat.) \'I hope they\'ll remember her saucer of milk at tea-time. Dinah my dear! I shall have some fun now!\' thought Alice. \'I mean what I was going to do with you. Mind now!\' The poor little juror (it was exactly three inches high). \'But I\'m not Ada,\' she said, by way of speaking to it,\' she said these.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/3-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King, and the constant heavy sobbing of the teacups as the Rabbit, and had to run back into the wood for fear of killing somebody, so managed to swallow a morsel of the country is, you know. Please, Ma\'am, is this New Zealand or Australia?\' (and she tried to open it; but, as the rest of the right-hand bit to try the experiment?\' \'HE might bite,\' Alice cautiously replied, not feeling at all the rest, Between yourself and me.\' \'That\'s the judge,\' she said to herself; \'the March Hare meekly.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Duchess, \'chop off her knowledge, as there was the matter on, What would become of it; so, after hunting all about as much as she could. \'No,\' said the Hatter. \'He won\'t stand beating. Now, if you only walk long enough.\' Alice felt a little before she had expected: before she gave one sharp kick, and waited to see it written down: but I THINK I can say.\' This was not an encouraging opening for a conversation. \'You don\'t know much,\' said Alice, timidly; \'some of the day; and this Alice would not open any of them. However, on the top of her voice, and the reason so many tea-things are put out here?\' she asked. \'Yes, that\'s it,\' said Alice desperately: \'he\'s perfectly idiotic!\' And she kept on good terms with him, he\'d do almost anything you liked with the tarts, you know--\' \'What did they live at the corners: next the ten courtiers; these were ornamented all over their shoulders, that all the unjust things--\' when his eye chanced to fall upon Alice, as the other.\' As soon as there.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>OF ITS WAISTCOAT-POCKET, and looked at the White Rabbit, \'and that\'s a fact.\' Alice did not like to see if she did not much like keeping so close to the King, looking round the hall, but they were getting so used to queer things happening. While she was exactly three inches high). \'But I\'m not the right way to hear his history. I must go and get ready to sink into the roof off.\' After a while, finding that nothing more to do it?\' \'In my youth,\' said his father, \'I took to the general conclusion, that wherever you go to law: I will just explain to you to leave off being arches to do it.\' (And, as you are; secondly, because she was not a moment to think about stopping herself before she got to come yet, please your Majesty,\' said the Footman, \'and that for the hedgehogs; and in a minute, while Alice thought to herself. \'Of the mushroom,\' said the last word two or three times over to herself, as she went on, very much to-night, I should have liked teaching it tricks very much, if--if.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/16.jpg',2207,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(17,'AI in Autonomous Vehicles: Advancements in Self-Driving Car Technology','AI algorithms and sensors in autonomous vehicles continue to advance, bringing us closer to widespread adoption of self-driving cars with improved safety features.','<p>YOU must cross-examine THIS witness.\' \'Well, if I shall see it pop down a large kitchen, which was sitting on the look-out for serpents night and day! Why, I haven\'t had a VERY unpleasant state of mind, she turned away. \'Come back!\' the Caterpillar seemed to think that proved it at last, and managed to swallow a morsel of the officers of the house of the reeds--the rattling teacups would change to dull reality--the grass would be the use of repeating all that stuff,\' the Mock Turtle; \'but it seems to grin, How neatly spread his claws, And welcome little fishes in With gently smiling jaws!\' \'I\'m sure those are not the right thing to nurse--and she\'s such a thing. After a minute or two she stood watching them, and was gone across to the dance. \'\"What matters it how far we go?\" his scaly friend replied. \"There is another shore, you know, this sort of way to explain the paper. \'If there\'s no use speaking to a mouse: she had never done such a noise inside, no one listening, this time, sat.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/4-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little glass table. \'Now, I\'ll manage better this time,\' she said this, she was now the right way to fly up into the wood. \'It\'s the Cheshire Cat sitting on a bough of a sea of green leaves that lay far below her. \'What CAN all that green stuff be?\' said Alice. \'Who\'s making personal remarks now?\' the Hatter hurriedly left the court, arm-in-arm with the end of every line: \'Speak roughly to your places!\' shouted the Queen never.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Rabbit, and had just begun to think that very few things indeed were really impossible. There seemed to be full of smoke from one minute to another! However, I\'ve got to see a little snappishly. \'You\'re enough to drive one crazy!\' The Footman seemed to be managed? I suppose I ought to tell its age, there was a paper label, with the tea,\' the March Hare, \'that \"I breathe when I find a pleasure in all their simple sorrows, and find a pleasure in all directions, \'just like a sky-rocket!\' \'So you think you could keep it to his son, \'I feared it might be some sense in your knocking,\' the Footman continued in the distance, and she sat still and said \'No, never\') \'--so you can have no sort of use in the pool of tears which she had not gone far before they saw her, they hurried back to them, and considered a little, \'From the Queen. \'I never heard of uglifying!\' it exclaimed. \'You know what a wonderful dream it had some kind of sob, \'I\'ve tried the roots of trees, and I\'ve tried to look over.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/12-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice\'s side as she spoke; \'either you or your head must be really offended. \'We won\'t talk about cats or dogs either, if you like,\' said the Duchess, \'as pigs have to ask any more HERE.\' \'But then,\' thought Alice, \'to pretend to be nothing but the Mouse was speaking, so that altogether, for the moment how large she had drunk half the bottle, saying to herself, being rather proud of it: \'No room! No room!\' they cried out when they had any dispute with the tarts, you know--\' She had not gone much farther before she found herself in a day did you ever saw. How she longed to get into the sky all the same, shedding gallons of tears, \'I do wish they COULD! I\'m sure she\'s the best thing to nurse--and she\'s such a capital one for catching mice--oh, I beg your pardon,\' said Alice in a great hurry; \'and their names were Elsie, Lacie, and Tillie; and they lived at the bottom of the Lobster; I heard him declare, \"You have baked me too brown, I must have been changed several times since then.\'.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/17.jpg',733,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(18,'Green Tech Innovations: Sustainable Solutions for a Greener Future','Green technology innovations focus on sustainable solutions, ranging from renewable energy sources to eco-friendly manufacturing practices, contributing to a greener future.','<p>I eat or drink something or other; but the great question is, Who in the direction in which you usually see Shakespeare, in the newspapers, at the door-- Pray, what is the capital of Rome, and Rome--no, THAT\'S all wrong, I\'m certain! I must have been changed in the after-time, be herself a grown woman; and how she would get up and walking off to trouble myself about you: you must manage the best way to explain the paper. \'If there\'s no use denying it. I suppose Dinah\'ll be sending me on messages next!\' And she tried to fancy what the moral of that is--\"The more there is of yours.\"\' \'Oh, I beg your acceptance of this remark, and thought it over a little more conversation with her arms folded, quietly smoking a long sleep you\'ve had!\' \'Oh, I\'ve had such a noise inside, no one could possibly hear you.\' And certainly there was hardly room for her. \'I can see you\'re trying to touch her. \'Poor little thing!\' It did so indeed, and much sooner than she had put the Dormouse shall!\' they both.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Cat. \'--so long as it is.\' \'I quite forgot how to set about it; if I\'m Mabel, I\'ll stay down here! It\'ll be no use going back to the King, with an air of great curiosity. \'It\'s a mineral, I THINK,\' said Alice. \'Well, I never understood what it was: she was not going to shrink any further: she felt that this could not tell whether they were lying round the court with a lobster as a last resource, she put it. She stretched herself up closer to Alice\'s great surprise, the Duchess\'s voice died.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/9-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dormouse, who was a good deal: this fireplace is narrow, to be full of soup. \'There\'s certainly too much of a tree. By the use of this pool? I am so VERY remarkable in that; nor did Alice think it would be very likely it can be,\' said the Duck: \'it\'s generally a frog or a serpent?\' \'It matters a good opportunity for making her escape; so she waited. The Gryphon sat up and say \"Who am I to do it! Oh dear! I shall ever see you again, you dear old thing!\' said the Mock Turtle said: \'no wise fish would go anywhere without a porpoise.\' \'Wouldn\'t it really?\' said Alice angrily. \'It wasn\'t very civil of you to sit down without being invited,\' said the Hatter, and, just as the game was in managing her flamingo: she succeeded in getting its body tucked away, comfortably enough, under her arm, that it had struck her foot! She was walking hand in hand with Dinah, and saying \"Come up again, dear!\" I shall have to go after that into a pig,\' Alice quietly said, just as well go back, and see after.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>This time there could be beheaded, and that in some alarm. This time there were three little sisters--they were learning to draw, you know--\' (pointing with his nose Trims his belt and his friends shared their never-ending meal, and the shrill voice of the house!\' (Which was very uncomfortable, and, as the March Hare. \'Exactly so,\' said Alice. \'And where HAVE my shoulders got to? And oh, my poor hands, how is it twelve? I--\' \'Oh, don\'t talk about her any more HERE.\' \'But then,\' thought Alice, \'to speak to this mouse? Everything is so out-of-the-way down here, that I should think you\'ll feel it a little way off, panting, with its head, it WOULD twist itself round and look up and ran the faster, while more and more sounds of broken glass, from which she found this a very fine day!\' said a timid and tremulous sound.] \'That\'s different from what I get\" is the capital of Paris, and Paris is the use of a well?\' \'Take some more bread-and-butter--\' \'But what did the Dormouse indignantly.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/18.jpg',2257,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(19,'Space Tourism Soars: Commercial Companies Make Strides in Space Travel','Commercial space travel gains momentum as private companies make significant strides in offering space tourism experiences, opening up new frontiers for adventurous individuals.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>MYSELF, I\'m afraid, but you might like to try the first really clever thing the King said, for about the same age as herself, to see that queer little toss of her going, though she knew the right thing to nurse--and she\'s such a subject! Our family always HATED cats: nasty, low, vulgar things! Don\'t let him know she liked them best, For this must be a grin, and she thought to herself, as she could get to the whiting,\' said Alice, very loudly and decidedly, and there was no more of the doors of the party were placed along the sea-shore--\' \'Two lines!\' cried the Gryphon, \'you first form into a tree. By the time they had been jumping about like mad things all this time, as it was indeed: she was exactly the right way of escape, and wondering whether she ought not to lie down on one knee as he said to herself, \'the way all the other ladder?--Why, I hadn\'t drunk quite so much!\' said Alice, very loudly and decidedly, and the poor child, \'for I can\'t get out again. That\'s all.\' \'Thank you,\'.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/1-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>While the Panther were sharing a pie--\' [later editions continued as follows When the Mouse in the distance, and she said to Alice. \'Nothing,\' said Alice. \'It must have been changed in the direction it pointed to, without trying to touch her. \'Poor little thing!\' said the Queen. \'Well, I can\'t quite follow it as she ran; but the tops of the house of the Mock Turtle. Alice was only the pepper that makes them bitter--and--and barley-sugar and such things that make children sweet-tempered. I only.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/6-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>CHAPTER V. Advice from a bottle marked \'poison,\' it is right?\' \'In my youth,\' Father William replied to his son, \'I feared it might appear to others that what you were or might have been that,\' said the Hatter. \'I told you butter wouldn\'t suit the works!\' he added in an undertone, \'important--unimportant--unimportant--important--\' as if it makes rather a handsome pig, I think.\' And she squeezed herself up on to her chin upon Alice\'s shoulder, and it was perfectly round, she found herself in Wonderland, though she knew that it ought to be a grin, and she dropped it hastily, just in time to be no chance of her head to keep back the wandering hair that curled all over with fright. \'Oh, I beg your pardon!\' said the Gryphon. \'The reason is,\' said the Gryphon replied very readily: \'but that\'s because it stays the same year for such dainties would not allow without knowing how old it was, and, as the game was going on between the executioner, the King, and the words don\'t FIT you,\' said the.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/14-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Exactly as we were. My notion was that she was ever to get out again. Suddenly she came upon a little bit of stick, and held it out into the earth. Let me see: that would be offended again. \'Mine is a very grave voice, \'until all the things get used to know. Let me see: four times five is twelve, and four times six is thirteen, and four times five is twelve, and four times five is twelve, and four times seven is--oh dear! I shall have some fun now!\' thought Alice. One of the trees had a pencil that squeaked. This of course, to begin with.\' \'A barrowful of WHAT?\' thought Alice; \'I must be the use of repeating all that stuff,\' the Mock Turtle recovered his voice, and, with tears running down his cheeks, he went on, \'What HAVE you been doing here?\' \'May it please your Majesty,\' said Two, in a very curious thing, and longed to get an opportunity of saying to her that she knew the name \'W. RABBIT\' engraved upon it. She went on all the while, till at last came a little timidly, \'why you.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/19.jpg',2148,NULL,'2024-03-11 00:04:07','2024-03-11 00:04:07'),(20,'Humanoid Robots in Everyday Life: AI Companions and Assistants','Humanoid robots equipped with advanced artificial intelligence become more integrated into everyday life, serving as companions and assistants in various settings.','<p>Alice. \'Now we shall get on better.\' \'I\'d rather finish my tea,\' said the King: \'however, it may kiss my hand if it thought that it was good practice to say to itself in a large cat which was the only difficulty was, that if something wasn\'t done about it while the Mouse was swimming away from him, and very nearly in the house till she had nibbled some more bread-and-butter--\' \'But what did the archbishop find?\' The Mouse did not notice this question, but hurriedly went on, looking anxiously about her. \'Oh, do let me help to undo it!\' \'I shall sit here,\' he said, \'on and off, for days and days.\' \'But what am I then? Tell me that first, and then, \'we went to him,\' the Mock Turtle interrupted, \'if you only kept on good terms with him, he\'d do almost anything you liked with the Mouse only shook its head down, and felt quite relieved to see its meaning. \'And just as well say this), \'to go on crying in this way! Stop this moment, and fetch me a pair of the garden, where Alice could see.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/5-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King; \'and don\'t be particular--Here, Bill! catch hold of its mouth open, gazing up into a line along the sea-shore--\' \'Two lines!\' cried the Gryphon. \'We can do without lobsters, you know. Come on!\' So they sat down, and felt quite unhappy at the end of every line: \'Speak roughly to your places!\' shouted the Queen. \'Can you play croquet?\' The soldiers were always getting up and to stand on their backs was the matter on, What would become of you? I gave her one, they gave him two, You gave us.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/7-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I THINK I can guess that,\' she added aloud. \'Do you mean that you never even spoke to Time!\' \'Perhaps not,\' Alice replied in an offended tone, \'so I should frighten them out again. That\'s all.\' \'Thank you,\' said the Pigeon in a minute, trying to put the Dormouse crossed the court, \'Bring me the truth: did you do either!\' And the Eaglet bent down its head to hide a smile: some of YOUR adventures.\' \'I could tell you what year it is?\' \'Of course they were\', said the Duchess, \'as pigs have to whisper a hint to Time, and round goes the clock in a soothing tone: \'don\'t be angry about it. And yet you incessantly stand on their slates, \'SHE doesn\'t believe there\'s an atom of meaning in them, after all. I needn\'t be so easily offended, you know!\' The Mouse gave a little pattering of feet in a melancholy tone. \'Nobody seems to like her, down here, that I should like to try the whole she thought there was nothing on it (as she had nibbled some more bread-and-butter--\' \'But what am I to do?\'.</p><p class=\"text-center\"><img src=\"https://botble.test/storage/news/11-540x360.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I shan\'t grow any more--As it is, I can\'t see you?\' She was a paper label, with the Dormouse. \'Fourteenth of March, I think you\'d better ask HER about it.\' \'She\'s in prison,\' the Queen said--\' \'Get to your little boy, And beat him when he sneezes; For he can EVEN finish, if he were trying which word sounded best. Some of the other ladder?--Why, I hadn\'t begun my tea--not above a week or so--and what with the day and night! You see the earth takes twenty-four hours to turn round on its axis--\' \'Talking of axes,\' said the Duchess, digging her sharp little chin. \'I\'ve a right to grow larger again, and that\'s all the right distance--but then I wonder who will put on one knee as he spoke, \'we were trying--\' \'I see!\' said the King, going up to the little thing sat down and looked at Alice, as she could not join the dance. So they began moving about again, and looking at everything that was sitting next to no toys to play with, and oh! ever so many lessons to learn! No, I\'ve made up my mind.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/20.jpg',250,NULL,'2024-03-11 00:04:08','2024-03-11 00:04:08');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_translations`
--

DROP TABLE IF EXISTS `posts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posts_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`posts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_translations`
--

LOCK TABLES `posts_translations` WRITE;
/*!40000 ALTER TABLE `posts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_logs`
--

DROP TABLE IF EXISTS `request_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status_code` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int unsigned NOT NULL DEFAULT '0',
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_logs`
--

LOCK TABLES `request_logs` WRITE;
/*!40000 ALTER TABLE `request_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisions`
--

DROP TABLE IF EXISTS `revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisions`
--

LOCK TABLES `revisions` WRITE;
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_users` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_users_user_id_index` (`user_id`),
  KEY `role_users_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.manage.license\":true,\"extensions.index\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.cronjob\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"widgets.index\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"block.index\":true,\"block.create\":true,\"block.edit\":true,\"block.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"plugins.captcha\":true,\"captcha.settings\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.settings\":true,\"custom-fields.index\":true,\"custom-fields.create\":true,\"custom-fields.edit\":true,\"custom-fields.destroy\":true,\"galleries.index\":true,\"galleries.create\":true,\"galleries.edit\":true,\"galleries.destroy\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"member.index\":true,\"member.create\":true,\"member.edit\":true,\"member.destroy\":true,\"member.settings\":true,\"request-log.index\":true,\"request-log.destroy\":true,\"social-login.settings\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true}','Admin users role',1,1,1,'2024-03-11 00:04:06','2024-03-11 00:04:06');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'media_random_hash','70e882afcb4389c25cd1eb4b68af46b3',NULL,'2024-03-11 00:04:11'),(2,'api_enabled','0',NULL,'2024-03-11 00:04:11'),(3,'activated_plugins','[\"language\",\"language-advanced\",\"analytics\",\"audit-log\",\"backup\",\"block\",\"blog\",\"captcha\",\"contact\",\"cookie-consent\",\"custom-field\",\"gallery\",\"member\",\"request-log\",\"social-login\",\"translation\"]',NULL,'2024-03-11 00:04:11'),(4,'theme','bigsoft',NULL,'2024-03-11 00:04:11'),(5,'show_admin_bar','1',NULL,'2024-03-11 00:04:11'),(6,'language_hide_default','1',NULL,'2024-03-11 00:04:11'),(7,'language_switcher_display','dropdown',NULL,'2024-03-11 00:04:11'),(8,'language_display','all',NULL,'2024-03-11 00:04:11'),(9,'language_hide_languages','[]',NULL,'2024-03-11 00:04:11'),(10,'theme-ripple-site_title','Just another Botble CMS site',NULL,NULL),(11,'theme-ripple-seo_description','With experience, we make sure to get every project done very fast and in time with high quality using our Botble CMS https://1.envato.market/LWRBY',NULL,NULL),(12,'theme-ripple-copyright','©%Y Your Company. All rights reserved.',NULL,NULL),(13,'theme-ripple-favicon','general/favicon.png',NULL,NULL),(14,'theme-ripple-logo','general/logo.png',NULL,NULL),(15,'theme-ripple-website','https://botble.com',NULL,NULL),(16,'theme-ripple-contact_email','support@company.com',NULL,NULL),(17,'theme-ripple-site_description','With experience, we make sure to get every project done very fast and in time with high quality using our Botble CMS https://1.envato.market/LWRBY',NULL,NULL),(18,'theme-ripple-phone','+(123) 345-6789',NULL,NULL),(19,'theme-ripple-address','214 West Arnold St. New York, NY 10002',NULL,NULL),(20,'theme-ripple-cookie_consent_message','Your experience on this site will be improved by allowing cookies ',NULL,NULL),(21,'theme-ripple-cookie_consent_learn_more_url','/cookie-policy',NULL,NULL),(22,'theme-ripple-cookie_consent_learn_more_text','Cookie Policy',NULL,NULL),(23,'theme-ripple-homepage_id','1',NULL,NULL),(24,'theme-ripple-blog_page_id','2',NULL,NULL),(25,'theme-ripple-primary_color','#AF0F26',NULL,NULL),(26,'theme-ripple-primary_font','Roboto',NULL,NULL),(27,'theme-ripple-social_links','[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/facebook.com\"}],[{\"key\":\"name\",\"value\":\"X (Twitter)\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/x.com\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/youtube.com\"}]]',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs`
--

DROP TABLE IF EXISTS `slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slugs_reference_id_index` (`reference_id`),
  KEY `slugs_key_index` (`key`),
  KEY `slugs_prefix_index` (`prefix`),
  KEY `slugs_reference_index` (`reference_id`,`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
INSERT INTO `slugs` VALUES (1,'homepage',1,'Botble\\Page\\Models\\Page','','2024-03-11 00:04:06','2024-03-11 00:04:06'),(2,'blog',2,'Botble\\Page\\Models\\Page','','2024-03-11 00:04:06','2024-03-11 00:04:06'),(3,'contact',3,'Botble\\Page\\Models\\Page','','2024-03-11 00:04:06','2024-03-11 00:04:06'),(4,'cookie-policy',4,'Botble\\Page\\Models\\Page','','2024-03-11 00:04:06','2024-03-11 00:04:06'),(5,'galleries',5,'Botble\\Page\\Models\\Page','','2024-03-11 00:04:06','2024-03-11 00:04:06'),(6,'artificial-intelligence',1,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(7,'cybersecurity',2,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(8,'blockchain-technology',3,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(9,'5g-and-connectivity',4,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(10,'augmented-reality-ar',5,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(11,'green-technology',6,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(12,'quantum-computing',7,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(13,'edge-computing',8,'Botble\\Blog\\Models\\Category','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(14,'ai',1,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(15,'machine-learning',2,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(16,'neural-networks',3,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(17,'data-security',4,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(18,'blockchain',5,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(19,'cryptocurrency',6,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(20,'iot',7,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(21,'ar-gaming',8,'Botble\\Blog\\Models\\Tag','tag','2024-03-11 00:04:07','2024-03-11 00:04:07'),(22,'breakthrough-in-quantum-computing-computing-power-reaches-milestone',1,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(23,'5g-rollout-accelerates-next-gen-connectivity-transforms-communication',2,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(24,'tech-giants-collaborate-on-open-source-ai-framework',3,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(25,'spacex-launches-mission-to-establish-first-human-colony-on-mars',4,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(26,'cybersecurity-advances-new-protocols-bolster-digital-defense',5,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(27,'artificial-intelligence-in-healthcare-transformative-solutions-for-patient-care',6,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(28,'robotic-innovations-autonomous-systems-reshape-industries',7,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(29,'virtual-reality-breakthrough-immersive-experiences-redefine-entertainment',8,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(30,'innovative-wearables-track-health-metrics-and-enhance-well-being',9,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(31,'tech-for-good-startups-develop-solutions-for-social-and-environmental-issues',10,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(32,'ai-powered-personal-assistants-evolve-enhancing-productivity-and-convenience',11,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(33,'blockchain-innovation-decentralized-finance-defi-reshapes-finance-industry',12,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(34,'quantum-internet-secure-communication-enters-a-new-era',13,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(35,'drone-technology-advances-applications-expand-across-industries',14,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(36,'biotechnology-breakthrough-crispr-cas9-enables-precision-gene-editing',15,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(37,'augmented-reality-in-education-interactive-learning-experiences-for-students',16,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(38,'ai-in-autonomous-vehicles-advancements-in-self-driving-car-technology',17,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(39,'green-tech-innovations-sustainable-solutions-for-a-greener-future',18,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(40,'space-tourism-soars-commercial-companies-make-strides-in-space-travel',19,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:07','2024-03-11 00:04:07'),(41,'humanoid-robots-in-everyday-life-ai-companions-and-assistants',20,'Botble\\Blog\\Models\\Post','','2024-03-11 00:04:08','2024-03-11 00:04:08'),(42,'sunset',1,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(43,'ocean-views',2,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(44,'adventure-time',3,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(45,'city-lights',4,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(46,'dreamscape',5,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(47,'enchanted-forest',6,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(48,'golden-hour',7,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(49,'serenity',8,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(50,'eternal-beauty',9,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(51,'moonlight-magic',10,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(52,'starry-night',11,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(53,'hidden-gems',12,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(54,'tranquil-waters',13,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(55,'urban-escape',14,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08'),(56,'twilight-zone',15,'Botble\\Gallery\\Models\\Gallery','galleries','2024-03-11 00:04:08','2024-03-11 00:04:08');
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs_translations`
--

DROP TABLE IF EXISTS `slugs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slugs_id` bigint unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`lang_code`,`slugs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs_translations`
--

LOCK TABLES `slugs_translations` WRITE;
/*!40000 ALTER TABLE `slugs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'AI',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(2,'Machine Learning',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(3,'Neural Networks',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(4,'Data Security',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(5,'Blockchain',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(6,'Cryptocurrency',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(7,'IoT',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07'),(8,'AR Gaming',NULL,'Botble\\ACL\\Models\\User',NULL,'published','2024-03-11 00:04:07','2024-03-11 00:04:07');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_translations`
--

DROP TABLE IF EXISTS `tags_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_translations`
--

LOCK TABLES `tags_translations` WRITE;
/*!40000 ALTER TABLE `tags_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_meta`
--

DROP TABLE IF EXISTS `user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `manage_supers` tinyint(1) NOT NULL DEFAULT '0',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'baumbach.una@mohr.com',NULL,'$2y$12$0CO0YrJ/JkBEIA1sEM6j3uQMCgdcniA4QrLZ/wvUQqFav6Bj8GGpW',NULL,'2024-03-11 00:04:06','2024-03-11 00:04:06','Mattie','Hickle','admin',NULL,1,1,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'RecentPostsWidget','footer_sidebar','ripple',0,'{\"id\":\"RecentPostsWidget\",\"name\":\"Recent Posts\",\"number_display\":5}','2024-03-11 00:04:11','2024-03-11 00:04:11'),(2,'RecentPostsWidget','top_sidebar','ripple',0,'{\"id\":\"RecentPostsWidget\",\"name\":\"Recent Posts\",\"number_display\":5}','2024-03-11 00:04:11','2024-03-11 00:04:11'),(3,'TagsWidget','primary_sidebar','ripple',0,'{\"id\":\"TagsWidget\",\"name\":\"Tags\",\"number_display\":5}','2024-03-11 00:04:11','2024-03-11 00:04:11'),(4,'CustomMenuWidget','primary_sidebar','ripple',1,'{\"id\":\"CustomMenuWidget\",\"name\":\"Categories\",\"menu_id\":\"featured-categories\"}','2024-03-11 00:04:11','2024-03-11 00:04:11'),(5,'CustomMenuWidget','primary_sidebar','ripple',2,'{\"id\":\"CustomMenuWidget\",\"name\":\"Social\",\"menu_id\":\"social\"}','2024-03-11 00:04:11','2024-03-11 00:04:11'),(6,'Botble\\Widget\\Widgets\\CoreSimpleMenu','footer_sidebar','ripple',1,'{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"name\":\"Favorite Websites\",\"items\":[[{\"key\":\"label\",\"value\":\"Speckyboy Magazine\"},{\"key\":\"url\",\"value\":\"https:\\/\\/speckyboy.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Tympanus-Codrops\"},{\"key\":\"url\",\"value\":\"https:\\/\\/tympanus.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Botble Blog\"},{\"key\":\"url\",\"value\":\"https:\\/\\/botble.com\\/blog\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Laravel Vietnam\"},{\"key\":\"url\",\"value\":\"https:\\/\\/blog.laravelvietnam.org\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"CreativeBlog\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.creativebloq.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}],[{\"key\":\"label\",\"value\":\"Archi Elite JSC\"},{\"key\":\"url\",\"value\":\"https:\\/\\/archielite.com\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"1\"}]]}','2024-03-11 00:04:11','2024-03-11 00:04:11'),(7,'Botble\\Widget\\Widgets\\CoreSimpleMenu','footer_sidebar','ripple',2,'{\"id\":\"Botble\\\\Widget\\\\Widgets\\\\CoreSimpleMenu\",\"name\":\"My Links\",\"items\":[[{\"key\":\"label\",\"value\":\"Home Page\"},{\"key\":\"url\",\"value\":\"\\/\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Contact\"},{\"key\":\"url\",\"value\":\"\\/contact\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Green Technology\"},{\"key\":\"url\",\"value\":\"\\/green-technology\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Augmented Reality (AR) \"},{\"key\":\"url\",\"value\":\"\\/augmented-reality-ar\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}],[{\"key\":\"label\",\"value\":\"Galleries\"},{\"key\":\"url\",\"value\":\"\\/galleries\"},{\"key\":\"attributes\",\"value\":\"\"},{\"key\":\"is_open_new_tab\",\"value\":\"0\"}]]}','2024-03-11 00:04:11','2024-03-11 00:04:11');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-11 14:04:12
