CREATE DATABASE Cooperativa; 

USE Cooperativa;

CREATE TABLE SOCIO (
	ID_Socio INT NOT NULL AUTO_INCREMENT,
    CI INT UNIQUE NOT NULL,
    Password_hash INT NOT NULL,
    CONSTRAINT pk_ID_Socio PRIMARY KEY (ID_Socio),
    CONSTRAINT fk_CI_Socio FOREIGN KEY (CI) references PERSONA(CI)
);

ALTER TABLE SOCIO
DROP Password_hash;

CREATE TABLE SOLICITUD (
    ID_Solicitud INT AUTO_INCREMENT PRIMARY KEY,
    CI INT NOT NULL UNIQUE,
    Password_hash BINARY NOT NULL,
    Nombre VARCHAR(30) NOT NULL,
    Apellido VARCHAR(30) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Nro_Telefono INT NOT NULL,
    Fecha_Solicitud DATETIME NOT NULL,
    Estado ENUM('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente'
);
ALTER TABLE SOLICITUD
MODIFY Fecha_Solicitud DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE PERSONA (
	CI INT NOT NULL,
    Nombre VARCHAR(30) NOT NULL,
    Apellido VARCHAR(30) NOT NULL,
    Email VARCHAR(50) UNIQUE NOT NULL,
    Fecha_Registro DATE NOT NULL,
    ID_Unidad_Habitacional INT NOT NULL,
    CONSTRAINT pk_CI PRIMARY KEY (CI),
	CONSTRAINT fk_ID_Unidad_Habitacional_Persona FOREIGN KEY (ID_Unidad_Habitacional) references UNIDAD_HABITACIONAL (ID_Unidad_Habitacional)
);    

ALTER TABLE PERSONA
ADD Password_hash INT NOT NULL;


ALTER TABLE PERSONA
MODIFY Fecha_Registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE TELEFONO (
	ID_Telefono INT NOT NULL AUTO_INCREMENT,
    Nro_Telefono INT NOT NULL,
    ID_Socio INT NOT NULL,
    CONSTRAINT pk_ID_Telefono PRIMARY KEY (ID_Telefono),
    CONSTRAINT fk_ID_Socio_Telefono FOREIGN KEY (ID_Socio) references SOCIO (ID_Socio)
);

CREATE TABLE COMPROBANTE (
	ID_Comprobante INT NOT NULL,
    ID_Socio INT NOT NULL,
    Monto FLOAT NOT NULL,
    Fecha_Comprobante DATETIME NOT NULL,
	Origen INT NOT NULL,
    Destino INT NOT NULL,
    Tipo_Comprobante ENUM ('Aporte Inicial', 'Cuota Mensual', 'Pago Compensatorio'),
    Estado_Comprobante ENUM ('Pendiente', 'Aceptado', 'Rechazado') DEFAULT 'Pendiente',
    CONSTRAINT pk_ID_Comprobante PRIMARY KEY (ID_Comprobante),
    CONSTRAINT fk_ID_Socio_Comprobante FOREIGN KEY (ID_Socio) references SOCIO (ID_Socio)
);

CREATE TABLE JORNADA_LABORAL (
	ID_Jornada INT NOT NULL AUTO_INCREMENT,
    ID_Socio INT NOT NULL,
    Horas_Cumplidas INT NOT NULL,
    Motivo VARCHAR(20) NULL,
    Tipo_Compensacion ENUM ('Exoneración', 'Pago', 'Ninguna'),
    Fecha_Jornada DATE NOT NULL,
    CONSTRAINT pk_ID_Jornada PRIMARY KEY (ID_Jornada),
    CONSTRAINT fk_ID_Socio_Jornada FOREIGN KEY (ID_Socio) references SOCIO (ID_Socio)
);

CREATE TABLE UNIDAD_HABITACIONAL (
	ID_Unidad_Habitacional INT NOT NULL,
    Bloque VARCHAR (1) NOT NULL,
    Calle VARCHAR (20) NOT NULL,
    Nro_Puerta INT NOT NULL,
    Avance_Construccion FLOAT NOT NULL,
    Estado_Unidad_Habitacional ENUM ('Sin Comenzar', 'En Proceso', 'Finalizada') DEFAULT 'Sin Comenzar',
    CONSTRAINT pk_ID_Unidad_Habitacional PRIMARY KEY (ID_Unidad_Habitacional)
);