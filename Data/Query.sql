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
