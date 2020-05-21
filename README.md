# Ingeniería y Desarrollo en la Web
## Instalación:
`composer update | composer install`
## Ejecutar servidor (opcional)
`$ php -S 0.0.0.0:8080 -t public/`
## vHost:
`<VirtualHost *:80>
ServerName IDW-practica-1
DocumentRoot /var/www/html/IDW-practica-1
  <Directory /var/www/html/IDW-practica-1>
    DirectoryIndex  index.php
    AllowOverride All
    Required all granted
  </Directory>
</VirtualHost>`
## Conexion a base de datos
El archivo de configuración para conectar a la base de datos se encuenta en:
### config > autoload > local.php