# IDW-practica-1
Practica uno de la materia de Ingenieria y Desarrollo en la Web
# Instalación:
Ejecutar instalación con composer update | composer install
# Ejecutar servidor (opcional)
`$ php -S 0.0.0.0:8080 -t public/`
# vHost:
<VirtualHost *:80>
  ServerName  {name}
  DocumentRoot {dir_project}
  <Directory {dir_project}>
    DirectoryIndex  index.php
    AllowOverride All
    Required all granted
  </Directory>
</VirtualHost>
