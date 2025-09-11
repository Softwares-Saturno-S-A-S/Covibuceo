USE cooperativa;

CREATE TABLE SOCIO (
	ID_Socio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    CI INT NOT NULL,
    Nombre VARCHAR(30) NOT NULL,
    Apellido VARCHAR(30) NOT NULL,
    Password_hash BINARY NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Fecha_Registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Estado_Socio ENUM('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente',
    ID_Unidad_Habitacional INT NOT NULL
);
	
CREATE TABLE TELEFONO (
	ID_Telefono INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nro_Telefono TEXT NOT NULL,
    ID_Socio INT NOT NULL
);

CREATE TABLE ADMINISTRADOR (
	ID_Admin INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Nombre_Usuario VARCHAR(20) NOT NULL,
    Password_hash BINARY NOT NULL
);

CREATE TABLE COMPROBANTE (
	ID_Comprobante INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_Socio INT NOT NULL,
    ID_Pago INT NOT NULL,
    Monto_Comprobante FLOAT NOT NULL,
    Fecha_Comprobante DATETIME NOT NULL,
    Origen TEXT NOT NULL,
    Destino TEXT NOT NULL,
    Tipo_Comprobante ENUM ('Aporte Inicial', 'Cuota Mensual', 'Pago Compensatorio'),
    Estado_Comprobante ENUM ('Pendiente', 'Aceptado', 'Rechazado') DEFAULT 'Pendiente'
);

CREATE TABLE PAGO (
	ID_Pago INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Monto_Pago FLOAT NOT NULL,
    Asunto TEXT NOT NULL,
    Fecha_Vencimiento DATE NOT NULL
);

CREATE TABLE UNIDAD_HABITACIONAL (
	ID_Unidad_Habitacional INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Bloque VARCHAR(1) NOT NULL,
	Calle VARCHAR (20) NOT NULL,
    Nro_Puerta INT NOT NULL,
    Avance_Construccion FLOAT NOT NULL,
    Estado_Unidad_Habitacional ENUM ('Sin Comenzar', 'En Proceso', 'Finalizada') DEFAULT 'Sin Comenzar',
	Ruta_Imagen TEXT NOT NULL
);

CREATE TABLE JORNADA_LABORAL (
	ID_Jornada INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_Socio INT NOT NULL,
    Descripcion TEXT NULL, 
    Horas_Cumplidas INT NOT NULL,
    Motivo TEXT NULL,
    Tipo_Compensacion ENUM ('Exoneración', 'Pago', 'Ninguna'),
    Estado_Jornada ENUM ('Pendiente', 'Aceptado', 'Rechazado') DEFAULT 'Pendiente',
    Fecha_Jornada DATE NOT NULL
);

ALTER TABLE SOCIO
ADD CONSTRAINT fk_ID_Unidad_Habitacional_Socio FOREIGN KEY (ID_Unidad_Habitacional) references UNIDAD_HABITACIONAL (ID_Unidad_Habitacional);

ALTER TABLE TELEFONO
ADD CONSTRAINT fk_ID_Socio_Telefono FOREIGN KEY (ID_Socio) references SOCIO (ID_Socio);

ALTER TABLE COMPROBANTE
ADD CONSTRAINT fk_ID_Socio_Comprobante FOREIGN KEY (ID_Socio) references SOCIO (ID_Socio);

ALTER TABLE COMPROBANTE
ADD CONSTRAINT fk_ID_Pago_Comprobante FOREIGN KEY (ID_Pago) references PAGO (ID_Pago);

ALTER TABLE JORNADA_LABORAL
ADD CONSTRAINT fk_ID_Socio_Jornada FOREIGN KEY (ID_Socio) references SOCIO (ID_Socio);