sudo mysql -u root -p -e "CREATE USER IF NOT EXISTS 'admisn'@'localhost' IDENTIFIED BY '1234'; GRANT ALL PRIVILEGES ON sistema_web.* TO 'admisn'@'localhost'; FLUSH PRIVILEGES;"
