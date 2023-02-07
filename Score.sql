CREATE DATABASE isp;
USE isp;

DROP TABLE IF EXISTS Score;

CREATE TABLE Score (
  Score_id INT(11) NOT NULL AUTO_INCREMENT,
  Title CHAR(12),
  Points INT,
  PRIMARY KEY (Score_id)
);

insert into Score values
(1, 'score', 0),
(2, 'HighestScore', 0);
