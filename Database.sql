drop database EmployeeDataWeb;

create database EmployeeDataWeb;
use EmployeeDataWeb;

create table AdminInfo (
	username varchar(50),
    password varchar(50)
);

insert into AdminInfo values("admin01","123");
select * from AdminInfo;

create table EmployeeDetails(
	name varchar(50),
    EmployeeId varchar(20),
    age varchar(10),
    fatherName varchar(50),
    department varchar(20),
    position varchar(20),
    Dateofbarth varchar(20),
    salary varchar (20),
    address varchar(70),
    PhoneNum varchar(15),
    email varchar(30),
    education varchar(10),
    gender varchar(15)
);
drop table EmployeeDetails;
insert into EmployeeDetails values("Sanny","EMP-74604","23","Rahman Akand","Marketing","Junior Dev","july 10, 2000","35000","Dhaka,Bangladesh","0170000000","sanny@gmail.com","B.Sc","Male");

select * From EmployeeDetails;


CREATE TABLE EmployeeApplications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    EmployeeId VARCHAR(50),
    subject VARCHAR(255),
    applicationText TEXT,
    submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from EmployeeApplications;
drop table EmployeeApplications;

CREATE TABLE AdminNotice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    AdminName VARCHAR(255),
    Subject VARCHAR(255),
    NoticeText TEXT,
    submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
drop table AdminNotice;
select * from AdminNotice;



INSERT INTO EmployeeDetails(Name, EmployeeID, age,fatherName, department, position, Dateofbarth, salary, address, PhoneNum, email, education, gender)
VALUES
("Jane Smith", "EMP-002", "28", "David Smith", "HR", "HR Manager", "1996-09-20", "70000", "456 Elm St, Springfield, USA", "987-654-3210", "jane.smith@example.com", "MBA", "Female"),
("Chris Johnson", "EMP-003", "35", "Steven Johnson", "Finance", "Financial", "1989-04-10", "80000", "789 Oak St, Cityville, USA", "234-567-8901", "chris.johnson@example.com", "B.Com", "Male"),
("Emily Williams", "EMP-004", "33", "Daniel Williams", "Marketing", "Marketing", "1991-12-05", "75000", "567 Pine St, Townsville, USA", "345-678-9012", "emily.williams@example.com", "BBA", "Female"),
("Mike Brown", "EMP-005", "29", "Andrew Brown", "Sales", "Sales Representative", "1995-08-25", "55000", "890 Cedar St, Villagetown, USA", "456-789-0123", "mike.brown@example.com", "B.Sc", "Male"),
("Rachel Taylor", "EMP-006", "31", "Matthew Taylor", "Operations", "Operations", "1993-10-30", "85000", "123 Maple St, Countryside, USA", "567-890-1234", "rachel.taylor@example.com", "M.Sc", "Female"),
("David Lee", "EMP-007", "34", "Richard Lee", "IT", "Database", "1988-07-18", "70000", "456 Walnut St, Metrocity, USA", "678-901-2345", "david.lee@example.com", "B.Tech", "Male"),
("Sophia Garcia", "EMP-008", "27", "Jose Garcia", "Finance", "Financial", "1997-03-08", "78000", "789 Birch St, Suburbia, USA", "789-012-3456", "sophia.garcia@example.com", "BBA", "Female")
;

ALTER TABLE EmployeeDetails MODIFY COLUMN education VARCHAR(100);
ALTER TABLE EmployeeDetails MODIFY COLUMN email VARCHAR(100);


