#Code to create a simple joke table

CREATE TABLE joke (
	id INT NOT NULL AUTO_INCREMENR PRIMARY KEY,
	joketext TEXT,
	jokedate DATE NOT NULL
) DEFAULT CHARACTER SET utf8;

#Adding jokes to the table

INSERT INTO joke SET
joketext = 'Why did the chicken cross the road? To get to the other side !';
jokedate = '2019-11-20';

INSERT INTO joke
(joketext, jokedate) VALUES (
'Knock-knock! Who\'s there? Boo!', "2019-11-21"
);

