Options -MultiViews

RewriteEngine On

Header always set Access-Control-Allow-Origin "*"
Header always set Access-Control-Allow-Credentials "true"
Header always set Access-Control-Allow-Methods "GET, PUT, POST, PATCH, OPTIONS, DELETE"
Header always set Access-Control-Allow-Headers "Origin, Content-Type, Cache-Control, Authorization"
Header always set Access-Control-Expose-Headers "*"
Header always set Access-Control-Max-Age "1000"

RewriteBase /

RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]

RewriteCond %{REQUEST_METHOD} OPTIONS
RewriteRule ^(.*)$ $1 [R=204,L]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]
