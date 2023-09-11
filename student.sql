CREATE TABLE IF NOT EXISTS student 
(
stu_id int(11) NOT NULL AUTO_INCREMENT,
stu_name varchar(30) NOT NULL,
age int(11) NOT NULL,
PRIMARY KEY (stu_id)
);

INSERT INTO student (stu_id, stu_name, age) VALUES
(1, 'Leo', 20),
(2, 'Ben', 24),
(3, 'Wendy', 30),
(4, 'Fion', 24),
(5, 'Lily', 19);


