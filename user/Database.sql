CREATE DATABASE IF NOT EXISTS hack_and_slash
CHARACTER SET utf8 COLLATE utf8_general_ci; #UTF 8 database

CREATE TABLE users (
  /*UserName is max 20 chars*/
  userid int(20) NOT NULL UNIQUE AUTO_INCREMENT,
  username varchar(20) NOT NULL UNIQUE,
  email varchar(128) NOT NULL UNIQUE,
  hashed_password text NOT NULL,
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
  file_path text NOT NULL,
  PRIMARY KEY (num),
  FOREIGN KEY (creater_id) REFERENCES admins (userid) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = INNODB;

CREATE TABLE challenges AS SELECT * FROM `tutorials`;
ALTER TABLE challenges MODIFY COLUMN num int(20) NOT NULL UNIQUE AUTO_INCREMENT;
ALTER TABLE challenges ADD FOREIGN KEY (creater_id) REFERENCES admins (userid) ON DELETE CASCADE ON UPDATE CASCADE;

/* TEST STUFF */
/* Guinea Pigs */
INSERT INTO `users` (username, email, hashed_password, tut_bitstring, chall_bitstring)
VALUES ("pyke", "pikef@rpi.edu", "123456789", "0", "0"), ("wong", "wongw3@rpi.edu", "123456789", "0", "0"),
       ("nick", "chann2@rpi.edu", "asldkjfa;klsjdf", "0", "0");

/* Test values for the admin set thing */
INSERT INTO `admins` (userid) VALUES (3);

/*When there is a new challenge, alter the table to include one more 0 for each*/

INSERT INTO `tutorials` (creater_id, name, file_path) VALUES (3, "first tut", "some file");
INSERT INTO `challenges` (creater_id, name, file_path) VALUES (3, "first chall", "some file");

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