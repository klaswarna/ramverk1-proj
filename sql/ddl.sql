DROP DATABASE IF EXISTS grammatikgruvan;
CREATE DATABASE grammatikgruvan;
GRANT ALL ON grammatikgruvan.* TO user@localhost IDENTIFIED BY 'pass';
USE grammatikgruvan;

--
-- Create table for users
--

DROP TABLE IF EXISTS anvandare;
CREATE TABLE anvandare (
    `anvandarid` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `anvandarnamn` VARCHAR(40),
    `losenord` VARCHAR(40),
    `email` VARCHAR(40),
    `datum` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `fraga` INT,
    `svar` INT,
    `kommentar` INT,
    `rfraga` INT,
    `rsvar` INT,
    `rkommentar` INT
);


--
-- Create table for inläggen: frågor, svar,kommentarer
--
DROP TABLE IF EXISTS `inlagg`;
CREATE TABLE `inlagg`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` VARCHAR(120),
  `data` TEXT,
  `type` CHAR(20),
  `slug` CHAR(120) UNIQUE,

  -- MySQL version 5.6 and higher
  `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

  -- MySQL version 5.5 and lower
  -- `published` DATETIME DEFAULT NULL,
  -- `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  -- `updated` DATETIME DEFAULT NULL, --  ON UPDATE CURRENT_TIMESTAMP,

  `deleted` DATETIME DEFAULT NULL,
  `rankning` INT,
  `userid` INT,
  `tillhor` INT,
  `godkant` BOOLEAN,
 FOREIGN KEY (userid) REFERENCES anvandare(anvandarid)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DROP TABLE IF EXISTS taggar;
CREATE TABLE taggar (
    `taggid` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `tagg` VARCHAR(40)
);




DROP TABLE IF EXISTS inlaggtagg;
CREATE TABLE inlaggtagg (
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `inlagg` INT,
    `tagg` INT,
    FOREIGN KEY (inlagg) REFERENCES inlagg(id),
    FOREIGN KEY (tagg) REFERENCES taggar(taggid)
);
