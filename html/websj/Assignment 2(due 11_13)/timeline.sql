CREATE TABLE tweets (
  'no' 	     	int(10)	  		NOT NULL   AUTO_INCREMENT,
  'author' 		varchar(20)		NOT NULL,
  'contents'	text	      	NOT NULL,
  'time'		datetime		NOT NULL,
  PRIMARY KEY (`no`)
);