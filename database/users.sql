CREATE USER  IF NOT EXISTS 'web_user_socio'@'%' IDENTIFIED BY 'socio_password';

GRANT SELECT, UPDATE, INSERT ON cooperativa.SOCIO TO 'web_user_socio'@'%';
GRANT SELECT, UPDATE, INSERT, DELETE ON cooperativa.TELEFONO TO 'web_user_socio'@'%';
GRANT SELECT, INSERT ON cooperativa.COMPROBANTE TO 'web_user_socio'@'%';
GRANT SELECT ON cooperativa.PAGO TO 'web_user_socio'@'%';
GRANT SELECT ON cooperativa.UNIDAD_HABITACIONAL TO 'web_user_socio'@'%';
GRANT SELECT, INSERT, UPDATE ON cooperativa.JORNADA_LABORAL TO 'web_user_socio'@'%';    

CREATE USER IF NOT EXISTS 'web_user_admin'@'%' IDENTIFIED BY 'admin_password';

GRANT ALL PRIVILEGES ON cooperativa.* TO 'web_user_admin'@'%';

CREATE USER IF NOT EXISTS 'backup_user'@'%' IDENTIFIED BY 'backup_password';

GRANT SELECT ON cooperativa.* TO 'backup_user'@'%';

FLUSH PRIVILEGES;