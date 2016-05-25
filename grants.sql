--Fill in password

CREATE USER 'read-only'@'%' IDENTIFIED BY '_____';
GRANT SELECT ON sensor_data.* to 'read-only'@'%';
ALTER USER 'read-only'@'%' WITH MAX_QUERIES_PER_HOUR 60;

CREATE USER 'write-only'@'%' IDENTIFIED BY '_____';
GRANT INSERT ON sensor_data.* to 'write-only'@'%';
ALTER USER 'write-only'@'%' WITH MAX_QUERIES_PER_HOUR 60;

FLUSH PRIVILEGES;