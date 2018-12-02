CREATE DATABASE IF NOT EXISTS hack_and_slash
CHARACTER SET utf8 COLLATE utf8_general_ci; #UTF 8 database

CREATE TABLE users (
  /*UserName is max 20 chars*/
  userid int(20) NOT NULL UNIQUE AUTO_INCREMENT,
  username varchar(20) NOT NULL UNIQUE,
  email varchar(128) NOT NULL UNIQUE,
  hashed_password text NOT NULL,
  salt text NOT NULL,
  /*Max score is 2147483647*/
  score int(10) NOT NULL DEFAULT 0,
  /*bit string to represent which tutorials they did
    Max number is 65,535 challenges/tuts
  */
  tut_bitstring text NOT NULL,
  chall_bitstring text NOT NULL,
  /*PRIMARY KEY(userid, username, email)*/
  PRIMARY KEY (userid)
) ENGINE = INNODB;

CREATE TABLE admins (
  rand int(20) NOT NULL AUTO_INCREMENT,
  userid int(20) NOT NULL UNIQUE,
  img varchar(255) NOT NULL,
  PRIMARY KEY (rand),
  FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;
/*CREATE TABLE admins AS SELECT * FROM `users`;
ALTER TABLE admins ADD PRIMARY KEY (userid);
ALTER TABLE admins MODIFY COLUMN userid AUTO_INCREMENT = 0;
*/
CREATE TABLE tutorials (
  num int(20) NOT NULL UNIQUE AUTO_INCREMENT,
  creater_id int(20) NOT NULL,
  name varchar(20) NOT NULL,
  file_path varchar(255) UNIQUE NOT NULL,
  PRIMARY KEY (num),
  FOREIGN KEY (creater_id) REFERENCES admins (userid) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE challenges AS SELECT * FROM `tutorials`;
ALTER TABLE challenges MODIFY COLUMN num int(20) NOT NULL UNIQUE AUTO_INCREMENT;
/*ALTER TABLE challenges MODIFY COLUMN file_path varchar(255) NOT NULL UNIQUE;*/
/*composite key of name and file_path*/
ALTER TABLE challenges ADD PRIMARY KEY (name, file_path);
ALTER TABLE challenges ADD FOREIGN KEY (creater_id) REFERENCES admins (userid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE challenges ADD COLUMN flags varchar(255) NOT NULL;
/*ALTER TABLE challenges ADD COLUMN flags varchar(255) NOT NULL, ADD COLUMN points int(3) NOT NULL DEFAULT 100;*/

/* TEST STUFF */
/* Guinea Pigs */
INSERT INTO `users` (username, email, hashed_password, salt, tut_bitstring, chall_bitstring)
VALUES ("pyke", "pikef@rpi.edu", "a47d7a319fa679794692b8074c6dd19e2d31584f52efb9c7c3fb3e529ea70164", "dfd341292bf8ba1fded9600a7721f48b7a6ac3802754bb7ac12f2d02bfe39148", "0", "0"),
("wong", "wongw3@rpi.edu", "5a5a1067c4f486b7f045919436effd5aced1cd34ab4de332ff001558a8fa33e2", "949511c3554fdef385ec3b0e780c2d6b5ae0fb1fe063a0a88bf04faa765d9cf1", "0", "0"),
       ("nick", "chann2@rpi.edu", "f0f39129221d4c5913a63b0b887908522da3bdbcf056b710dd5cc47340b8a1a6", "d663aa75abbbe9717171c948c597bca60d5106de6b5c5524839fa0a24445815e", "0", "0");
/*pyke and wong are 123456789*/
/*NICK: sebastiancastillo*/

/* Test values for the admin set thing */
INSERT INTO `admins` (userid, img) VALUES (3, "../../resources/challenge_home/new_johnny.gif");

/*When there is a new challenge, alter the table to include one more 0 for each*/

INSERT INTO `tutorials` (creater_id, name, file_path) VALUES (3, "first tut", "some file"), (3, "second tut", "other file");
INSERT INTO `challenges` (creater_id, name, file_path, flags) VALUES (3, "first chall", "./challenge_2/text.txt", "123"), (3, "second chall", "./challenge_1/text.txt", "321");

/*
Add a user
INSERT INTO table_name (username, email, hashed_password, tut_bitstring, chall_bitstring) VALUES(INSERTUSERNAME, INSERTEMAIL, INSERT HASED_PASSWORD, Calc Tut_bitstring, Calc chall_bitstring);


Update a user's score
UPDATE table_name SET colname = value, col2name = value WHERE SPECIFYUSERHERE;

Delete tutorial or challenge
DELETE FROM table_name WHERE SPECIFYTHINGHERE;

Scoreboard thing
SELECT column_name(s) FROM table_name WHERE condition LIMIT number;
*/