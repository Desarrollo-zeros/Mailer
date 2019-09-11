<?php

$config["mailer"] = [
    'SMTP_DEBUG'  => 2,  // Habilitar salida de depuración detallada
    'MAIL_DRIVER' => 'smtp',//Configurar la aplicación de correo para usar SMTP, driver: smpt, mail, sendmail, qmail
    'HOST'        => 'smtp.mailtrap.io', //Especificar servidores SMTP principales y de respaldo
    'AUTH'        => true,//Habilitar autenticación SMTP
    'USERNAME'    => 'db99c114d445f5',//usuario mailer (gmail, hotmail, yahoo, etc..)
    'PASSWORD'    => '27d11210510f00',//contraseña de usuario mailer
    'SECURE'      => 'tls', //Habilite el cifrado TLS, también se acepta `ssl`
    'PORT'        => 2525, //Puerto TCP para conectarse
];

$config["PAGE_TILE"] = "TEST";