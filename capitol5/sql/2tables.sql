# Code to create a simple joke table that stores an author ID
CREATE TABLE joke (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
joketext TEXT,
jokedate DATE NOT NULL,
authorid INT
) DEFAULT CHARACTER SET utf8;

CREATE TABLE author (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
email VARCHAR(255)
) DEFAULT CHARACTER SET utf8;# Code to create a simple author table

joke SET
joketext = 'Why did the chicken cross the road? To get to the othe
?r side!',
jokedate = '2009-04-01',
authorid = 1;
INSERT INTO joke (joketext, jokedate, authorid)
VALUES (
'Knock-knock! Who\'s there? Boo! "Boo" who? Don\'t cry; it\'s only
? a joke!',
'2009-04-01',
1
);
