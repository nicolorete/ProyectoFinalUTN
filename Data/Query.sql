CREATE TABLE student(
    studentId INT NOT NULL AUTO_INCREMENT,
    carrerId INT,
    firstName VARCHAR(30), 
    lastName VARCHAR(30),
    dni VARCHAR(30),
    fileNumber VARCHAR(30),
    gender VARCHAR(30),
    birthDate DATE,
    email varchar(30),
    phoneNumber VARCHAR(30),
    active BOOLEAN, 
    password VARCHAR(15),
    CONSTRAINT pk_studentId PRIMARY KEY (studentId),
    CONSTRAINT unq_student_email UNIQUE (email),
    CONSTRAINT unq_student_dni UNIQUE (dni),
    CONSTRAINT unq_student_fileNumber UNIQUE (fileNumber)
);

CREATE TABLE admin (
    adminId INT NOT NULL AUTO_INCREMENT,
    email varchar(30),
    password VARCHAR(30),
    CONSTRAINT pk_adminId PRIMARY KEY (adminId),
    CONSTRAINT unq_admin_email UNIQUE (email)
);

CREATE TABLE company (
    companyId INT NOT NULL AUTO_INCREMENT,
    cuit INT,
    nombre VARCHAR(30),
    address VARCHAR(30),
    link VARCHAR(30),
    isActive BIT,
    CONSTRAINT pk_companyId PRIMARY KEY (companyId),
    CONSTRAINT unq_company_cuit UNIQUE (cuit),
);


CREATE TABLE postulation (
  jobOfferId INT NOT NULL AUTO_INCREMENT,
  studentID INT,
  datePostulation DATE,
  presentation VARCHAR(200),
  cv FILE,
);


INSERT INTO company (cuit, nombre, address, link, isActive) VALUES (40138543,'Fravega', 'Garay 1800', 'fravega.com', 1); 
INSERT INTO company (cuit, nombre, address, link, isActive) VALUES (39123321,'CocaCola', 'av.Constitucion 1800', 'cocacola.com', 1); 



INSERT INTO student (carrerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, phoneNumber, active, password) 
VALUES (5,'Wyatan', 'Lorant', 63-025-8112, 01-777-6891, 'Non-binary', '2021-02-23', 'wlorant1@sbwire.com', 171-448-9062, 1, 'user');

insert into admin (adminId, email, password) values (1, 'admin@admin', 'admin');


-- HAY QUE MODIFICAR EL CUIT POR UN VARCHAR o un tipo de dato que acepte un tamaño de numero mas gande (int acepta hasta 8 numeros)
-- MODIFICAR DATE por DATETIME TABLA DE STUDENTS

CREATE TABLE career(
	careerId INT NOT NULL,
	description VARCHAR(20),
	active BOOLEAN,
	CONSTRAINT pk_careerId PRIMARY KEY (careerId),
    CONSTRAINT unq_career_description UNIQUE (description)
);

CREATE TABLE jobPosition(
	jobPositionId INT NOT NULL,
	description VARCHAR(30),
	CONSTRAINT pk_jobPositionId PRIMARY KEY (jobPositionId)
);

CREATE TABLE jobOffer(
	jobOfferId INT NOT NULL AUTO_INCREMENT, 
	title VARCHAR(30),
    date DATE, 
    description VARCHAR(200), 
    jobPositionId INT NOT NULL,
    companyId INT NOT NULL,
    active boolean,
	CONSTRAINT pk_jobOfferId PRIMARY KEY (jobOfferId),
	CONSTRAINT fk_companyId FOREIGN KEY (companyId) REFERENCES company(companyId),
	CONSTRAINT fk_jobPositionId FOREIGN KEY (jobPositionId) REFERENCES jobPosition(jobPositionId)
);

CREATE TABLE postulation(
    postulationId INT NOT NULL AUTO_INCREMENT,
	jobOfferId INT , 
	studentId INT,
    date DATE, 
    presentation VARCHAR(200), 
    cv varchar(100) NOT NULL,
    active boolean,
	CONSTRAINT pk_postulationId PRIMARY KEY (postulationId),
	CONSTRAINT fk_jobOfferId FOREIGN KEY (jobOfferId) REFERENCES jobOffer(jobOfferId),
	CONSTRAINT fk_studentId FOREIGN KEY (studentId) REFERENCES student(studentId)
);
CREATE TABLE files
(
	fileId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name NVARCHAR(100) NOT NULL
)

DELIMITER $$

CREATE PROCEDURE file_add(IN Name VARCHAR(100))
BEGIN
    INSERT INTO files
    	(name)
	VALUES
		(name);

END$$
