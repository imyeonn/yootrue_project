CREATE DATABASE college;
CREATE TABLE student(
	student_id integer not null primary key,
	name varchar(10) not null,
	year tinyint default 1 not null,
	dept_no integer not null,
	major varchar(20)
);
CREATE TABLE department(
	dept_no integer not null primary key auto_increment,
	dept_name varchar(20) not null,
	office varchar(20) not null,
	office_tel varchar(13),
	unique key(dept_name)
);

ALTER TABLE student CHANGE COLUMN major major varchar(40);
ALTER TABLE student ADD COLUMN gender varchar(1);

ALTER TABLE department CHANGE COLUMN dept_name dept_name varchar(40);
ALTER TABLE department CHANGE COLUMN office office varchar(30);

ALTER TABLE student DROP COLUMN gender;
INSERT INTO student VALUES(20070002, 'James Bond', 3, 4, 'Business Administration');
INSERT INTO student VALUES(20060001, 'Queenie', 4, 4, 'Business Administration');
INSERT INTO student VALUES(20030001, 'Reonardo', 4, 2, 'Electronic Engineering');
INSERT INTO student VALUES(20040003, 'Julia', 3, 2, 'Electronic Engineering');
INSERT INTO student VALUES(20060002, 'Roosevelt', 3, 1, 'Computer Science');
INSERT INTO student VALUES(20100002, 'Fearne', 3, 4, 'Business Administration');
INSERT INTO student VALUES(20110001, 'Chloe', 2, 1, 'Computer Science');
INSERT INTO student VALUES(20080003, 'Amy', 4, 3, 'Law');
INSERT INTO student VALUES(20040002, 'Selina', 4, 5, 'English Literature');
INSERT INTO student VALUES(20070001, 'Ellen', 4, 4, 'Business Administration');
INSERT INTO student VALUES(20100001, 'Kathy', 3, 4, 'Business Administration');
INSERT INTO student VALUES(20110002, 'Lucy', 2, 2, 'Electronic Engineering');
INSERT INTO student VALUES(20030002, 'Michelle', 5, 1, 'Computer Science');
INSERT INTO student VALUES(20070003, 'April', 4, 3, 'Law'); 
INSERT INTO student VALUES(20070005, 'Alicia', 2, 5, 'English Literature');
INSERT INTO student VALUES(20100003, 'Yullia', 3, 1, 'Computer Science'); 
INSERT INTO student VALUES(20070007, 'Ashlee', 2, 4, 'Business Administration');

INSERT INTO department(dept_name, office, office_tel) values('Computer Science', 'Engineering building', '02-3290-0123');
INSERT INTO department(dept_name, office, office_tel) values('Electronic Engineering', 'Engineering building', '02-3290-2345');
INSERT INTO department(dept_name, office, office_tel) values('Law', 'Law building', '02-3290-7896');
INSERT INTO department(dept_name, office, office_tel) values( 'Business Administration', 'Administration building', '02-3290-1112');
INSERT INTO department(dept_name, office, office_tel) values ('English Literature', 'Literature building', '02-3290-4412');

UPDATE department set dept_name="Electronic and Electrical Engineering" where dept_name="Electronic engineering";
INSERT INTO department(dept_name, office, office_tel) values('Education','Education','02-3290-2347');
UPDATE student set dept_no=6 where name='Chloe';
DELETE FROM student where name='Michelle';
DELETE FROM student WHERE name='Fearne';

SELECT name FROM student WHERE major='Computer Science';
SELECT student_id,year,major FROM student;
SELECT name FROM student WHERE year=3;
SELECT name FROM student WHERE year=1 OR year=2;
SELECT name FROM student s JOIN department d ON s.dept_no=d.dept_no WHERE major='Business Administration';

SELECT name FROM student WHERE student_id LIKE '%2007%';
SELECT name FROM student order by student_id;
SELECT name FROM student group by major HAVING avg(year)>3;
SELECT name FROm student WHERE major='Business Administration' AND student_id LIKE '%2007%' LIMIT 2;

SELECT c.name,l.language from countries c JOIN languages l ON c.code=l.country_code WHERE c.independence_year=1948;
SELECT c.name FROM countries c JOIN languages l1 ON c.code=l1.country_code JOIN countries c2 ON l1.country_code=c2.code JOIN languages l2 ON c2.code=l2.country_code WHERE (l1.language='English' AND l1.official='T')AND (l2.language='French' AND l2.official='T');
SELECT language,count(language) from countries c JOIN languages l ON c.code=l.country_code WHERE c.life_expectancy>75 group by language order by count(language) desc limit 5;
SELECT c.name FROM cities c JOIN countries c1 ON c.id=c1.capital JOIN languages l1 ON l1.country_code=c1.code JOIN countries c2 ON c2.code=l1.country_code JOIN languages l2 ON c2.code=l2.country_code WHERE (l1.language='English')AND (l2.language='Korean');
SELECT c.name FROM cities c JOIN countries c1 ON c.id=c1.capital JOIN languages l1 ON l1.country_code=c1.code WHERE l1.official='T' AND (l1.percentage>20 AND l1.percentage<50);
select sum(surface_area) from countries c JOIN cities c1 ON c.capital=c1.id where c1.population>(select avg(population) from cities) order by c.population desc limit 5;

select role from roles r JOIN movies m ON r.movie_id=m.id where m.name='Pi';
select count(first_name),count(last_name) from actors a JOIN roles r ON a.id=r.actor_id where ;
