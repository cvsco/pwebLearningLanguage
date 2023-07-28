-- Progettazione Web 
DROP DATABASE if exists learning_language; 
CREATE DATABASE learning_language; 
USE learning_language; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: learning_language
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `progress` (
  `progressID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(45) NOT NULL,
  `topicID` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `language` varchar(45) NOT NULL,
  PRIMARY KEY (`progressID`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` VALUES (1,'1','1','2013-09-07','eng'),(2,'1','1','2013-10-01','eng'),(3,'1','2','2013-10-02','eng'),(4,'1','3','2013-11-12','eng'),(5,'1','2','2013-11-13','eng'),(6,'1','4','2013-11-14','eng'),(7,'1','5','2013-11-15','eng'),(8,'10','1','2013-11-16','eng'),(9,'1','1','2013-11-17','eng'),(10,'1','1','2020-06-08','eng'),(11,'1','1','2020-06-08','eng'),(12,'1','1','2020-06-08','eng'),(13,'1','1','2020-06-09','eng'),(14,'1','1','2020-06-09','eng'),(15,'1','1','2020-06-22','eng'),(16,'1','2','2020-06-22','eng'),(17,'1','2','2020-06-23','eng'),(18,'1','2','2020-06-23','eng'),(19,'2','1','2020-06-23','eng'),(20,'2','2','2020-06-23','eng'),(21,'2','3','2020-06-23','eng'),(22,'2','3','2020-06-23','eng'),(39,'2','2','2020-06-23','eng'),(40,'2','1','2020-06-23','eng'),(41,'2','1','2020-06-23','eng'),(42,'2','1','2020-06-23','eng'),(43,'3','1','2020-06-23','eng'),(44,'1','6','2020-06-23','eng'),(45,'1','7','2020-06-24','eng'),(46,'2','5','2020-06-24','eng'),(47,'1','9','2020-06-27','eng'),(48,'11','1','2020-06-27','eng'),(49,'1','8','2020-06-28','eng'),(50,'2','4','2020-06-28','eng'),(51,'2','4','2020-06-28','eng'),(52,'11','6','2020-06-28','eng'),(53,'1','11','2020-06-29','eng'),(54,'11','11','2020-06-29','eng'),(55,'3','12','2020-06-29','eng'),(56,'11','7','2020-07-01','eng'),(57,'1','10','2020-07-01','eng'),(58,'6','1','2020-07-01','eng'),(59,'8','3','2020-07-01','eng'),(60,'8','3','2020-07-01','eng'),(61,'8','1','2020-07-01','eng'),(66,'9','1','2020-07-01','eng'),(67,'9','1','2020-07-01','eng'),(68,'9','3','2020-07-01','eng'),(69,'9','3','2020-07-01','eng'),(70,'1','7','2020-07-01','eng'),(71,'1','12','2020-07-01','eng'),(72,'1','13','2020-07-02','eng'),(73,'3','3','2020-07-02','eng'),(74,'3','19','2020-07-02','eng'),(75,'3','20','2020-07-02','eng'),(76,'3','17','2020-07-02','eng'),(77,'6','21','2020-07-03','eng'),(78,'6','16','2020-07-03','eng'),(79,'4','22','2020-07-03','eng'),(80,'11','18','2020-07-03','eng'),(81,'1','19','2020-07-03','eng'),(82,'1','14','2020-07-04','eng'),(83,'10','23','2020-07-04','eng'),(84,'11','24','2020-07-04','eng'),(85,'4','1','2020-07-05','eng'),(86,'4','1','2020-07-05','eng'),(87,'4','2','2020-07-05','eng'),(88,'4','2','2020-07-05','eng'),(89,'8','1','2020-07-05','eng'),(90,'1','18','2020-07-05','eng'),(91,'8','10','2020-07-06','eng');
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `topicID` int(11) NOT NULL,
  `type` varchar(45) CHARACTER SET latin1 NOT NULL,
  `text` varchar(255) CHARACTER SET latin1 NOT NULL,
  `rightAnswer` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `options` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `language` varchar(45) CHARACTER SET latin1 DEFAULT 'eng',
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,1,'audio','I drink and eat',NULL,NULL,'eng'),(2,1,'multiple','Io bevo acqua','I drink water','I drinks water-I drink water-I eat water','eng'),(3,1,'audio','He eats bread',NULL,NULL,'eng'),(4,1,'translate','I eat an apple and she eats bread','Io mangio una mela e lei mangia il pane',NULL,'eng'),(5,1,'audio','Bread and water',NULL,NULL,'eng'),(6,1,'reverso','Io sono una donna','I am a woman','I\'m a woman','eng'),(7,1,'reverso','Un ragazzo','A boy','A guy','eng'),(8,1,'reverso','Una ragazza','A girl',NULL,'eng'),(9,1,'translate','A girl, a woman','Una ragazza una donna',NULL,'eng'),(10,1,'audio','I speak english',NULL,NULL,'eng'),(11,1,'translate','He is sorry','Si scusa','Egli si scusa-Lui si scusa','eng'),(12,1,'audio','She is sorry',NULL,NULL,'eng'),(13,1,'translate','I am fine, thank you','Sto bene grazie','Sto bene grazie-Io sto bene grazie','eng'),(14,1,'audio','Yes thank you',NULL,NULL,'eng'),(15,1,'audio','Good morning, how are you',NULL,NULL,'eng'),(16,1,'audio','I want a coffee',NULL,NULL,'eng'),(17,1,'audio','No thanks',NULL,NULL,'eng'),(18,1,'reverso','Grazie','thanks','thank you','eng'),(19,1,'multiple','E\' un menu','It is a menu','It is a menu-He is a menu-It is menu','eng'),(20,1,'reverso','Io sto bene','I am fine','I am well-I\'m fine-I\'m well','eng'),(21,1,'translate','I am fine','Io sto bene','Sto bene','eng'),(22,1,'multiple','Leggiamo un giornale','We read a newspaper','We read a sandwich-We read a menu-We read a newspaper','eng'),(23,1,'audio','I drink milk',NULL,NULL,'eng'),(24,2,'multiple','Noi beviamo il t&egrave;','We drink tea','We have tea-We drinks tea-We drink tea','eng'),(25,2,'audio','The breakfast',NULL,NULL,'eng'),(26,2,'multiple','Lui beve il succo','He drinks the juice','She drinks the juice-He eats the juice-He drinks the juice','eng'),(27,2,'audio','She drinks beer',NULL,NULL,'eng'),(28,2,'multiple','L\'uomo mangia un limone','The man eats a lemon','The man eat a lemon-The men eats a lemon-The man eats a lemon','eng'),(29,2,'audio','The salt',NULL,NULL,'eng'),(30,2,'translate','She eats a strawberry','Lei mangia una fragola',NULL,'eng'),(31,2,'translate','I drink apple juice','Io bevo succo di mele','Io bevo succo di mela-Bevo succo di mela-Bevo succo di mele','eng'),(32,2,'translate','The man eats a lemon','L\'uomo mangia un limone',NULL,'eng'),(33,2,'translate','The men drink beer','Gli uomini bevono birra','Gli uomini bevono la birra','eng'),(34,2,'reverso','Noi beviamo il t&egrave;','We drink tea','we drink the tea','eng'),(35,2,'translate','The man eats an egg','L\'uomo mangia un uovo',NULL,'eng'),(36,2,'reverso','La ragazza mangia un limone','The girl eats a lemon',NULL,'eng'),(37,2,'translate','I have salt and water','Ho sale e acqua','Io ho sale e acqua','eng'),(38,2,'reverso','Il ragazzo mangia una fragola','The boy eats a strawberry','The guy eats a strawberry','eng'),(39,2,'translate','You drink tea','Tu bevi il t&egrave;','Bevi il t&egrave;','eng'),(40,2,'translate','I eat the strawberry','Io mangio la fragola','Mangio la fragola','eng'),(41,3,'audio','The bird drinks water',NULL,NULL,'eng'),(42,3,'translate','I eat the crab','Mangio il granchio','Io mangio il granchio','eng'),(43,3,'audio','The spider eats bread',NULL,NULL,'eng'),(44,3,'translate','You have a duck','Tu hai un\'anatra','Hai un\'anatra','eng'),(45,3,'audio','The dog drinks',NULL,NULL,'eng'),(46,3,'translate','A bear is an animal','Un orso &egrave; un animale',NULL,'eng'),(47,3,'audio','She has an elephant',NULL,NULL,'eng'),(48,3,'audio','The bear eats an apple',NULL,NULL,'eng'),(49,3,'audio','I am a spider',NULL,NULL,'eng'),(50,3,'audio','The dog drinks water',NULL,NULL,'eng'),(51,3,'audio','The elephant drinks milk',NULL,NULL,'eng'),(52,3,'reverso','Il granchio beve l\'acqua','The crab drinks water',NULL,'eng'),(53,3,'reverso','E\' un topo','It is a mouse','It\'s a mouse','eng'),(54,3,'reverso','Tu hai un\'anatra','You have a duck',NULL,'eng'),(55,3,'reverso','Un cane','A dog',NULL,'eng'),(56,3,'reverso','L\'anatra beve l\'acqua','The duck drinks water','Duck drinks water','eng'),(57,1,'multiple','I cavalli sono animali','The horses are animals','The horses is animals-The horses are animal-The horses are animals','eng'),(58,1,'audio','They read the newspapers',NULL,NULL,'eng'),(59,1,'multiple','Lei ha i piatti','She has the plates','She is the plates-She has the plate-She has the plates','eng'),(60,4,'translate','My cat eats your fish','Il mio gatto mangia il tuo pesce','La mia gatta mangia il tuo pesce','eng'),(61,4,'reverso','I nostri gatti bevono acqua','Our cats drink water',NULL,'eng'),(62,4,'translate','Their children drink milk','I loro figli bevono latte','I loro figli bevono il latte-I loro bambini bevono il latte-I loro figli bevono latte','eng'),(63,4,'audio','It is her cat ?',NULL,NULL,'eng'),(64,4,'translate','The fish is his dinner','Il pesce &egrave; la sua cena',NULL,'eng'),(65,4,'translate','I eat my sandwich','Io mangio il mio panino',NULL,'eng'),(66,4,'audio','Your duck is my dinner',NULL,NULL,'eng'),(67,4,'translate','Your duck is my dinner','La tua anatra &egrave; la mia cena',NULL,'eng'),(68,4,'multiple','Gli elefanti sono i tuoi','The elephants are yours','The elephant are yours-The elephants are your-The elephants are yours','eng'),(69,4,'audio','The soup is not mine',NULL,NULL,'eng'),(70,4,'multiple','Le gatte sono le nostre','The cats are ours','The cats ours-The cats are our-The cats are ours','eng'),(71,4,'audio','Our cat',NULL,NULL,'eng'),(72,4,'translate','The dog drinks its water','Il cane beve la sua acqua',NULL,'eng'),(73,4,'audio','The cats food',NULL,NULL,'eng'),(74,4,'audio','My girl has a dog',NULL,NULL,'eng'),(75,4,'audio','The rice is mine',NULL,NULL,'eng'),(76,4,'translate','The lunch is ours','Il pranzo &egrave; nostro',NULL,'eng'),(77,6,'translate','The birds are yellow','Gli uccelli sono gialli',NULL,'eng'),(78,6,'reverso','Le nostre tartarughe sono verdi','Our turtles are green',NULL,'eng'),(79,6,'audio','The cat is white',NULL,NULL,'eng'),(80,5,'multiple','Lei mi legge un giornale','She reads me a newspaper','She reads a newspaper-She reads my a newspaper-She reads me a newspaper','eng'),(81,5,'audio','We have her',NULL,NULL,'eng'),(82,5,'translate','She reads him a book','Lei gli legge un libro',NULL,'eng'),(83,5,'audio','No, not her',NULL,NULL,'eng'),(84,5,'translate','We read them a book','Noi leggiamo loro un libro','Noi gli leggiamo un libro','eng'),(85,5,'audio','No, not him',NULL,NULL,'eng'),(86,5,'translate','She reads us a book','Lei ci legge un libro','Lei legge a noi un libro','eng'),(87,5,'audio','We have him',NULL,NULL,'eng'),(88,5,'translate','They have her','Ce l\'hanno loro','Loro hanno lei','eng'),(89,5,'audio','She reads me a book',NULL,NULL,'eng'),(90,5,'translate','We eat it','Noi lo mangiamo','Lo mangiamo','eng'),(91,5,'audio','She reads us a book',NULL,NULL,'eng'),(92,5,'audio','I eat them',NULL,NULL,'eng'),(93,5,'translate','I am fine, thank you. And you ?','Io sto bene, grazie. E tu ?','Io sto bene grazie e te','eng'),(94,5,'audio','They have you',NULL,NULL,'eng'),(95,6,'reverso','Le mie camicie non sono nere','My shirts are not black','My shirts aren\'t black','eng'),(96,6,'audio','A blue skirt',NULL,NULL,'eng'),(97,6,'translate','The lemon is yellow','Il limone &egrave; giallo',NULL,'eng'),(98,6,'translate','It is red and black','&egrave; rosso e nero',NULL,'eng'),(99,6,'audio','A white pasta',NULL,NULL,'eng'),(100,6,'reverso','Rosso e azzurro sono colori','Red and blue are colors','Red and blue are color-Red end blue are colors','eng'),(101,6,'audio','The brown hat is mine',NULL,NULL,'eng'),(102,6,'translate','She wears a pink shirt','Lei indossa una maglia rosa','Indossa una maglia rosa','eng'),(103,6,'audio','The dresses are not black',NULL,NULL,'eng'),(104,7,'reverso','Loro scrivono il libro','They write the book',NULL,'eng'),(105,7,'translate','They swim','Loro nuotano',NULL,'eng'),(106,7,'translate','The horse walks','Il cavallo cammina',NULL,'eng'),(107,7,'translate','She writes a book','Lei scrive un libro',NULL,'eng'),(108,7,'translate','We walk','Noi camminiamo',NULL,'eng'),(109,7,'multiple','Noi parliamo, lui ascolta','We speak, he listens','We say, he listens-We speak, he listen-We speak, he listens','eng'),(110,7,'audio','He appears at night',NULL,NULL,'eng'),(111,7,'translate','The father counts the sandwiches','Il padre conta i panini',NULL,'eng'),(112,7,'audio','My sister demands an answer',NULL,NULL,'eng'),(113,7,'translate','My sister demands an answer','Mia sorella richiede una risposta',NULL,'eng'),(114,7,'audio','You deliver the food',NULL,NULL,'eng'),(115,7,'audio','He explains the profession',NULL,NULL,'eng'),(116,7,'audio','The book begins with a question',NULL,NULL,'eng'),(117,8,'multiple','Perch&eacute; le ragazze sono stanche ?','Why are the girls tired ?','Why are the girl tired ?-Why are girls tired ?-Why are the girls tired ?','eng'),(118,8,'audio','He is the main actor',NULL,NULL,'eng'),(119,8,'translate','My parents are bilingual but I am not','I miei genitori sono bilingui ma io no','I miei genitori sono bilingue ma io no','eng'),(120,8,'audio','In general we eat fish on friday',NULL,NULL,'eng'),(121,8,'audio','Is the newspaper recent ?',NULL,NULL,'eng'),(122,8,'audio','My brother is not bilingual',NULL,NULL,'eng'),(123,8,'audio','The marriage is not legal',NULL,NULL,'eng'),(124,8,'audio','The girls are tired',NULL,NULL,'eng'),(125,8,'audio','They are not human',NULL,NULL,'eng'),(126,8,'audio','He and I are tired',NULL,NULL,'eng'),(127,8,'audio','Yes they are real',NULL,NULL,'eng'),(128,8,'audio','I am human',NULL,NULL,'eng'),(129,8,'audio','The date is recent',NULL,NULL,'eng'),(130,8,'audio','In general is white',NULL,NULL,'eng'),(131,9,'audio','She goes once a month',NULL,NULL,'eng'),(132,9,'translate','The food is pretty expensive','Il cibo &egrave; piuttosto caro',NULL,'eng'),(133,9,'audio','We cook the fish again',NULL,NULL,'eng'),(134,9,'translate','She goes once a month','Lei va una volta al mese',NULL,'eng'),(135,9,'audio','Is it Friday already ?',NULL,NULL,'eng'),(136,9,'translate','They are pretty tired today','Loro sono abbastanza stanchi oggi','Sono piuttosto stanchi oggi','eng'),(137,9,'audio','We are still alive',NULL,NULL,'eng'),(138,9,'audio','I am as tired as you',NULL,NULL,'eng'),(139,9,'translate','He is already here','Lui &egrave; gi&agrave; qui',NULL,'eng'),(140,9,'audio','She is as beautiful as her mother',NULL,NULL,'eng'),(141,10,'audio','The teachers drink wine',NULL,NULL,'eng'),(142,10,'translate','He studied after dinner','Lui studia dopo cena','Studia dopo cena','eng'),(143,10,'translate','My sister studies many books','Mia sorella studia molti libri',NULL,'eng'),(144,10,'translate','He has children in four different schools','Lui ha figli in quattro diverse scuole','Lui ha figli in 4 diverse scuole','eng'),(145,10,'audio','My mother and my father are teachers',NULL,NULL,'eng'),(146,10,'audio','The teacher drinks milk',NULL,NULL,'eng'),(147,10,'translate','He studies ten hours a day','Lui studia 10 ore al giorno','Lui studia dieci ore al giorno','eng'),(148,10,'audio','I hope my program is still open',NULL,NULL,'eng'),(149,10,'translate','These programs are for international students','Questi programmi sono per studenti internazionali','Questi programmi sono per gli studenti internazionali','eng'),(150,10,'audio','My parents pay for my education',NULL,NULL,'eng'),(151,11,'translate','My grandmother \'s visits are always special','Le visite di mia nonna sono sempre speciali',NULL,'eng'),(152,11,'audio','The motorcycle is green',NULL,NULL,'eng'),(153,11,'translate','The students have sandwiches in their backpacks','Gli studenti hanno i panini nei loro zaini','Gli studenti hanno dei panini nei loro zaini','eng'),(154,11,'audio','He is my guide',NULL,NULL,'eng'),(155,11,'audio','The airplane is not here yet',NULL,NULL,'eng'),(156,11,'audio','Your backpack is open',NULL,NULL,'eng'),(157,11,'translate','He is my guide','&egrave; la mia guida','Lui &egrave; la mia guida','eng'),(158,11,'audio','When is your visit to the doctor',NULL,NULL,'eng'),(159,11,'audio','I drive for an hour',NULL,NULL,'eng'),(160,11,'audio','The boat is in the port',NULL,NULL,'eng'),(161,12,'audio','I would like to go somewhere this summer',NULL,NULL,'eng'),(162,12,'audio','Someone gave me this book',NULL,NULL,'eng'),(163,12,'audio','I bought everything at the mall',NULL,NULL,'eng'),(164,12,'translate','Someone is sleeping in my bed','Qualcuno sta dormendo nel mio letto',NULL,'eng'),(165,12,'translate','No one is sleeping in my bed','Nessuno sta dormendo nel mio letto',NULL,'eng'),(166,12,'audio','There is nowhere as beautiful as Rome',NULL,NULL,'eng'),(167,12,'audio','They can choose anything from the menu',NULL,NULL,'eng'),(168,12,'translate','I don\'t have anything to eat','Non ho nulla da mangiare','Io non ho nulla da mangiare-Io non ho niente da mangiare-Non ho niente da mangiare','eng'),(169,12,'translate','Is anybody there ?','C\'&egrave; nessuno ?',NULL,'eng'),(170,12,'audio','Everyone is here',NULL,NULL,'eng'),(171,13,'translate','We listened to the teacher','Noi ascoltavamo l\'insegnante','Ascoltavamo l\'insegnante','eng'),(172,13,'audio','I played with my dog',NULL,NULL,'eng'),(173,13,'translate','And more recently ?','E pi&ugrave; recentemente ?',NULL,'eng'),(174,13,'audio','He had three children',NULL,NULL,'eng'),(175,13,'translate','The man said something','L\'uomo ha detto qualcosa','L\'uomo diceva qualcosa','eng'),(176,13,'audio','She had a cat',NULL,NULL,'eng'),(177,13,'audio','I had a car',NULL,NULL,'eng'),(178,13,'reverso','Ieri sera , ho ascoltato la radio','Last night, I listened to the radio',NULL,'eng'),(179,13,'translate','I heard a person in my house','Ho sentito una persona in casa mia','Io ho sentito una persona nella mia casa','eng'),(180,13,'audio','The girl heard a bird',NULL,NULL,'eng'),(181,13,'reverso','E pi&ugrave; recentemente ?','And more recently ?',NULL,'eng'),(182,13,'reverso','Hanno giocato con gli animali','They played with the animals',NULL,'eng'),(183,14,'translate','She does not write','Lei non scrive',NULL,'eng'),(184,14,'translate','How do you write the average ?','Come scrivi la media ?',NULL,'eng'),(185,14,'audio','He does not walk',NULL,NULL,'eng'),(186,14,'audio','My parents want to walk',NULL,NULL,'eng'),(187,14,'audio','I want to be a father',NULL,NULL,'eng'),(188,14,'translate','My brother does not swim','Mio fratello non nuota',NULL,'eng'),(189,14,'audio','She does not write',NULL,NULL,'eng'),(190,14,'reverso','Non vedo lo schermo','I do not see the screen','I don\'t see the screen','eng'),(191,14,'audio','Do not be afraid',NULL,NULL,'eng'),(192,14,'audio','I like to write',NULL,NULL,'eng'),(193,14,'audio','I want to see it',NULL,NULL,'eng'),(194,15,'audio','I have seen that film',NULL,NULL,'eng'),(195,15,'translate','My boyfriend has never drunk beer','Il mio ragazzo non ha mai bevuto birra','Il mio fidanzato non ha mai bevuto birra-Il mio fidanzato non ha mai bevuto la birra-Il mio ragazzo non ha mai bevuto la birra-Il mio ragazzo non ha mai bevuto birra','eng'),(196,15,'reverso','Sono passati dieci anni da quando &egrave; morto','Have passed 10 years since he died',NULL,'eng'),(197,15,'translate','They have missed the train','Hanno perso il treno','Loro hanno perso il treno','eng'),(198,15,'audio','I have never drunk beer',NULL,NULL,'eng'),(199,15,'audio','They have missed the train',NULL,NULL,'eng'),(200,15,'translate','The winter has passed','L\'inverno &egrave; passato',NULL,'eng'),(201,15,'audio','I have just met him',NULL,NULL,'eng'),(202,15,'audio','I have never met him',NULL,NULL,'eng'),(203,15,'audio','We have finished the coffee',NULL,NULL,'eng'),(204,16,'audio','He is doing something there',NULL,NULL,'eng'),(205,16,'reverso','Dove stanno nuotando','Where are they swimming ?',NULL,'eng'),(206,16,'translate','The elephant is drinking water','L\'elefante sta bevendo l\'acqua',NULL,'eng'),(207,16,'reverso','Luis sta bevendo caff&egrave;','Luis is drinking coffee',NULL,'eng'),(208,16,'audio','What are you doing ?',NULL,NULL,'eng'),(209,16,'reverso','La settimana prossima andremo a nuotare','Next week we are going swimming','The next week we are going swimming','eng'),(210,16,'translate','I am reading a letter','Sto leggendo una lettera',NULL,'eng'),(211,16,'audio','I am reading a letter',NULL,NULL,'eng'),(212,16,'reverso','Stai scrivendo una lettera ?','Are you writing a letter ?',NULL,'eng'),(213,16,'reverso','My family is going to Brazil','La mia famiglia sta andando in brasile','La mia famiglia va in Brasile','eng'),(214,16,'audio','She is looking at you',NULL,NULL,'eng'),(215,17,'audio','She has a daughter whose name is mary',NULL,NULL,'eng'),(216,17,'audio','I have a friend whose father is a teacher',NULL,NULL,'eng'),(217,17,'audio','For whom is the chicken ?',NULL,NULL,'eng'),(218,17,'translate','Read what you want','Leggi quello che vuoi',NULL,'eng'),(219,17,'audio','Here is where she lives',NULL,NULL,'eng'),(220,17,'audio','Tell me which dog you want !',NULL,NULL,'eng'),(221,17,'audio','Where and with whom',NULL,NULL,'eng'),(222,17,'audio','Take what you like',NULL,NULL,'eng'),(223,17,'translate','I like the dog that play with the cat','Mi piace il cane che gioca con il gatto','Mi piace il cane che gioca col gatto','eng'),(224,17,'audio','Tell me which piece you want',NULL,NULL,'eng'),(225,18,'audio','I have the spoon',NULL,NULL,'eng'),(226,18,'audio','Is there a spider on the sofa',NULL,NULL,'eng'),(227,18,'translate','A lamp','Una lampada',NULL,'eng'),(228,18,'audio','Do you have a cellphone ?',NULL,NULL,'eng'),(229,18,'translate','Do they have a computer ?','Hanno un computer ?',NULL,'eng'),(230,18,'audio','I have a computer',NULL,NULL,'eng'),(231,18,'translate','Our sofa is yellow','Il nostro divano &egrave; giallo',NULL,'eng'),(232,18,'audio','We do not have oil for the lamp',NULL,NULL,'eng'),(233,18,'translate','Is there a spider on the sofa ?','C\'&egrave; un ragno sul divano ?',NULL,'eng'),(234,18,'audio','A lamp',NULL,NULL,'eng'),(235,18,'audio','I have your television',NULL,NULL,'eng'),(236,19,'audio','He loves himself',NULL,NULL,'eng'),(237,19,'translate','He is not himself today','Non &egrave; se stesso oggi',NULL,'eng'),(238,19,'audio','She saw herself in the mirror',NULL,NULL,'eng'),(239,19,'translate','We do not see ourselves','Noi non vediamo noi stessi','Non vediamo noi stessi','eng'),(240,19,'audio','The farmers eat by themselves',NULL,NULL,'eng'),(241,19,'audio','She saw herself',NULL,NULL,'eng'),(242,19,'audio','It speaks by itself',NULL,NULL,'eng'),(243,19,'translate','Many people live by themselves','Molte persone vivono da sole',NULL,'eng'),(244,19,'audio','You always eat by yourself',NULL,NULL,'eng'),(245,19,'audio','We do not see ourselves',NULL,NULL,'eng'),(246,20,'reverso','Verremo di notte','We will come at night',NULL,'eng'),(247,20,'translate','I will be here','Sar&ograve; qui','Io sar&ograve; qui','eng'),(248,20,'reverso','Aggiunger&ograve; che non ho visto Bruno','I will add that I did not see Bruno',NULL,'eng'),(249,20,'translate','Will you choose me ?','Sceglierai me ?','Tu sceglierai me ?-Mi sceglierai ?','eng'),(250,20,'translate','She will break the plate','Lei romper&agrave; il piatto','Romper&agrave; il piatto.','eng'),(251,20,'reverso','Romperai la finestra','You will break the window',NULL,'eng'),(252,20,'audio','She will not be able to come here tomorrow',NULL,NULL,'eng'),(253,20,'audio','We will choose the direction of this country',NULL,NULL,'eng'),(254,20,'translate','That will change nothing','Quello non cambier&agrave; niente',NULL,'eng'),(255,20,'audio','I will add that I did not see Mark',NULL,NULL,'eng'),(256,21,'multiple','Non ho potuto','I could not','I could yes-I was yes able-I could not','eng'),(257,21,'audio','I can not suffer',NULL,NULL,'eng'),(258,21,'multiple','Oggi non abbiamo potuto','Tonight we could not','Today we could not-Tomorrow we have not been able to-Tonight we could not','eng'),(259,21,'audio','I could not',NULL,NULL,'eng'),(260,21,'audio','You should wait for me',NULL,NULL,'eng'),(261,21,'audio','I must go out',NULL,NULL,'eng'),(262,21,'translate','He can come with us','Lui pu&ograve; venire con noi','Pu&ograve; venire con noi','eng'),(263,21,'audio','I would like to eat something',NULL,NULL,'eng'),(264,21,'audio','I cannot sleep in this bed',NULL,NULL,'eng'),(265,21,'audio','May i ask you a favor',NULL,NULL,'eng'),(266,22,'audio','I would have had money',NULL,NULL,'eng'),(267,22,'translate','That would have changed the match','Quello avrebbe cambiato la partita.',NULL,'eng'),(268,22,'audio','I would have had information',NULL,NULL,'eng'),(269,22,'audio','They would have written that letter',NULL,NULL,'eng'),(270,22,'reverso','Avrei considerato quel vestito','I would have considered that dress',NULL,'eng'),(271,22,'reverso','Sarebbero stati capaci di camminare','They would have been able to walk.',NULL,'eng'),(272,22,'audio','That would have changed the match',NULL,NULL,'eng'),(273,22,'reverso','Avremmo scritto il libro l\' anno scorso','We would have written the book last year',NULL,'eng'),(274,22,'translate','They would have written that letter','Avrebbero scritto quella lettera','Loro avrebbero scritto quella lettera','eng'),(275,22,'reverso','Avrei avuto soldi','I would have had money',NULL,'eng'),(276,23,'audio','What is the best technique?',NULL,NULL,'eng'),(277,23,'translate','Sometimes a mass will change to energy','A volte una massa si cambia in energia','A volte una massa cambia in energia','eng'),(278,23,'translate','What is the best technique ?','Qual &egrave; la tecnica migliore ?','Qual &egrave; la migliore tecnica ?','eng'),(279,23,'audio','Try playing this scale',NULL,NULL,'eng'),(280,23,'audio','What is the number on the scale ?',NULL,NULL,'eng'),(281,23,'audio','This task takes three hours',NULL,NULL,'eng'),(282,23,'translate','All the teachers have different techniques','Tutti gli insegnanti hanno delle tecniche diverse','Tutti gli insegnanti hanno tecniche diverse','eng'),(283,23,'audio','The definition of family has changed',NULL,NULL,'eng'),(284,23,'audio','These points of the Earth',NULL,NULL,'eng'),(285,23,'audio','The chemistry',NULL,NULL,'eng'),(286,24,'audio','What are the advantages ?',NULL,NULL,'eng'),(287,24,'audio','I wish you good luck',NULL,NULL,'eng'),(288,24,'translate','Really , it has no importance','Davvero non ha importanza','Veramente non ha importanza','eng'),(289,24,'audio','She has a sad expression',NULL,NULL,'eng'),(290,24,'audio','I believe in luck',NULL,NULL,'eng'),(291,24,'translate','I believe in luck','Io credo nella fortuna','Credo nella fortuna','eng'),(292,24,'audio','the advantage',NULL,NULL,'eng'),(293,24,'audio','I do not have any luck',NULL,NULL,'eng'),(294,24,'audio','The sea is fascinating',NULL,NULL,'eng'),(295,24,'audio','Cloe is a kind girl',NULL,NULL,'eng');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `section` int(11) NOT NULL,
  PRIMARY KEY (`topicID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'Basi',1),(2,'Cibo',1),(3,'Animali',1),(4,'Possessivi',1),(5,'Pronomi oggetto',1),(6,'Colori',1),(7,'Presente',2),(8,'Aggettivi',2),(9,'Avverbi',2),(10,'Scuola',2),(11,'Viaggi',2),(12,'Pronomi indefiniti',2),(13,'Passato',3),(14,'Infinito',3),(15,'Presente perfetto',3),(16,'Participio',3),(17,'Pronomi relativi',3),(18,'Oggetti',3),(19,'Pronomi riflessivi',4),(20,'Futuro',4),(21,'Verbi modali',4),(22,'Condizionale perfetto',4),(23,'Scienza',4),(24,'Attributi',4);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `light` int(11) NOT NULL DEFAULT '0',
  `streak` int(11) NOT NULL DEFAULT '0',
  `coin` int(11) NOT NULL DEFAULT '0',
  `XP` int(11) NOT NULL DEFAULT '0',
  `level` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `admin` varchar(45) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '0',
  `streakFreeze` date DEFAULT NULL,
  `coinsBet` date DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'pippo','pippo','pippo@gmail.com',5,5,50,230,'normale',NULL,'0',NULL,NULL),(2,'arturo','12345678','arturo@gmail.com',5,0,0,110,'normale',NULL,'0',NULL,NULL),(3,'pluto','pluto','pluto@hotmail.it',0,0,0,60,'rilassato',NULL,'0',NULL,NULL),(4,'mario91','12345678','mario@libero.it',2,1,1,50,'intenso',NULL,'0',NULL,NULL),(5,'alice6','passwordalice','alice.S@gmail.com',0,0,0,0,'serio',NULL,'0',NULL,NULL),(6,'marco','passwdmarco','marco@gmail.com',0,0,0,70,'serio',NULL,'0',NULL,NULL),(7,'digitD','12345678','digi@hotmail.it',0,0,0,0,'rilassato',NULL,'0',NULL,NULL),(8,'mark','abcd1234','mark@libero.it',2,2,1,50,'normale',NULL,'0',NULL,NULL),(9,'gio','12345678','gio@gmail.come',2,0,1,40,'intenso',NULL,'0',NULL,NULL),(10,'MeatMark','markmark','mark@gmail.com',0,0,0,20,'rilassato',NULL,'0',NULL,NULL),(11,'paperino','paperino','paperino@hotmail.it',0,0,11,80,'normale',NULL,'0',NULL,NULL),(12,'admin','admin','admin@gmail.com',0,0,0,0,NULL,NULL,'1',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'learning_language'
--
/*!50003 DROP FUNCTION IF EXISTS `alphanum` */;
ALTER DATABASE `learning_language` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `alphanum`( str CHAR(255) ) RETURNS char(255) CHARSET latin1
    DETERMINISTIC
BEGIN 
  DECLARE i, len SMALLINT DEFAULT 1; 
  DECLARE ret CHAR(255) DEFAULT ''; 
  DECLARE c CHAR(1);
  IF str IS NOT NULL THEN 
    SET len = CHAR_LENGTH( str ); 
    REPEAT 
      BEGIN 
        SET c = MID( str, i, 1 ); 
        IF c REGEXP '[[:alnum:]]' THEN 
          SET ret=CONCAT(ret,c); 
        END IF; 
        SET i = i + 1; 
      END; 
    UNTIL i > len END REPEAT; 
  ELSE
    SET ret='';
  END IF;
  RETURN ret; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `learning_language` CHARACTER SET latin1 COLLATE latin1_bin ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-06 18:50:21
