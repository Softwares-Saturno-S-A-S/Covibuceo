CREATE USER  IF NOT EXISTS 'web_user'@'%' IDENTIFIED BY 'web_password';

GRANT ALL PRIVILEGES ON cooperativa.* TO 'web_user'@'%';

FLUSH PRIVILEGES;