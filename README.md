# Media House
This is your personal store house of choices of videos from Youtube. Collect the URLs from Youtube of your choice and store it here. Enjoy your loving videos according to your choice of time. There is no requirements of finding the lovable videos once again from the Youtube.

Let us know your likings and dislikings. We promise that we will update and do better in the next release.

# Technology Stack
* PHP
* Custom MVC framework
* MySQL
* .htaccess
* Bootstrap 4.3

# Functionalities
1. Register new users. 
2. Login and upload new media from Youtube URL. 
3. Entertain with your choices of media songs and videos. 
4. Remove the media link created by same user while sign in. 
5. User friendly URLs. 

# MySQL Dump
1. Create a database with the name 'mediahouse'. 
2. Import below sql. 

```sql
--
-- Database: `mediahouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
COMMIT;
```

# Instructions
1. Dump the zip file or clone the project using git to local folder. 
2. Update app\config\config.php file. 
3. Update public\.htaccess file.
4. Open the application with root URL in the browser.

# What you will learn from this project
1. How to do a project using core PHP MVC architecture. 
2. This will help you to understand MVC design pattern. 
3. Really helpful to understand other similar PHP MVC open sources such as CodeIgniter, Symfony, Laravel etc. 

# Pre-requisites for this project
This would be an advantage to have the below concepts, but can be updated from this project also. 
1. How to code in PHP. 
2. How to code in PHP OOPS (classes and objects) is a plus, but not mandatory. 

# Who is this project for
1. Anyone who want to learn and have an hands on experience with how to develop a PHP project using MVC design pattern. 
