CREATE USER  IF NOT EXISTS 'web_user_socio'@'172.18.0.4' IDENTIFIED BY 'socio_password';

GRANT SELECT, UPDATE, INSERT ON cooperativa.SOCIO TO 'web_user_socio'@'172.18.0.4';
GRANT SELECT, UPDATE, INSERT, DELETE ON cooperativa.TELEFONO TO 'web_user_socio'@'172.18.0.4';
GRANT SELECT, INSERT ON cooperativa.COMPROBANTE TO 'web_user_socio'@'172.18.0.4';
GRANT SELECT ON cooperativa.PAGO TO 'web_user_socio'@'172.18.0.4';
GRANT SELECT ON cooperativa.UNIDAD_HABITACIONAL TO 'web_user_socio'@'172.18.0.4';
GRANT SELECT, INSERT, UPDATE ON cooperativa.JORNADA_LABORAL TO 'web_user_socio'@'172.18.0.4';    

CREATE USER IF NOT EXISTS 'web_user_admin'@'172.18.0.4' IDENTIFIED BY 'admin_password';

GRANT ALL PRIVILEGES ON cooperativa.* TO 'web_user_admin'@'172.18.0.4';

CREATE USER IF NOT EXISTS 'backup_user'@'172.18.0.3' IDENTIFIED BY 'backup_password';

GRANT SELECT ON cooperativa.* TO 'backup_user'@'172.18.0.3';

FLUSH PRIVILEGES;