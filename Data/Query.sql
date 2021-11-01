CREATE TABLE student(
    studentId INT NOT NULL AUTO_INCREMENT,
    carrerId INT,
    firstName VARCHAR(30), 
    lastName VARCHAR(30),
    dni INT,
    fileNumber INT,
    gender VARCHAR(30),
    birthDate DATE,
    email varchar(30),
    phoneNumber INT,
    active BIT, 
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
