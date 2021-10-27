CREATE TABLE rol(
    idRol INT NOT NULL,
    descripcion VARCHAR(15), 
    CONSTRAINT pk_idRol PRIMARY KEY (idRol),
    CONSTRAINT unq_rol_descripcion UNIQUE (descripcion)
);


CREATE TABLE usuario(
    idUsuario INT NOT NULL AUTO_INCREMENT,
    idRol INT NOT NULL,
    mail varchar(30), 
    password VARCHAR(15),
    CONSTRAINT pk_idUsuario PRIMARY KEY (idUsuario),
    CONSTRAINT fk_idRol FOREIGN KEY (idRol) REFERENCES rol(idRol),
    CONSTRAINT unq_usuario_mail UNIQUE (mail)
);

CREATE TABLE perfiUsuario(
    idPerfilUsuario INT NOT NULL AUTO_INCREMENT,
    idUsuario INT,
    nombre VARCHAR(30), 
    apellido VARCHAR(30),
    dni INT,
    CONSTRAINT pk_idPerfilUsuario PRIMARY KEY (idPerfilUsuario),  
    CONSTRAINT FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
    CONSTRAINT unq_perfilUsuario_dni UNIQUE (dni)
);

INSERT INTO `rol` (`idRol`, `descripcion`) 
VALUES ('1', 'admin'), 
       ('0', 'usuario');
      
      
INSERT INTO `usuario` (`idRol`, `mail`, `password`) 
VALUES ('1', 'admin@admin.com', 'admin123'), 
       ('0', 'user@user.com.ar', 'user123');
       
      