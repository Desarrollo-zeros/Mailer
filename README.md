# Mailer Zeros

_paquete de envio correo personalidados_

## Comenzando 🚀



### Pre-requisitos 📋

_requires  : php: >=5.5_<br>
_requires (dev) : phpmailer/phpmailer: ^6.0_<br>
_requires (dev) : phpunit/phpunit: ^8_

### Instalación 🔧

```
composer require devzeros/mailer @dev
```

### Configuración ⚙️


```php
$config["mailer"] = [

            'SMTP_DEBUG'  => 2,  // Habilitar salida de depuración detallada
     
            'MAIL_DRIVER' => 'smtp', //Configurar la aplicación de correo para usar SMTP, driver: smpt, mail, sendmail, qmail
            
            'HOST'        => 'smtp.mailtrap.io', //Especificar servidores SMTP principales y de respaldo
            
            'AUTH'        => true, //Habilitar autenticación SMTP
            
            'USERNAME'    => 'db99c114d445f5', //usuario mailer (gmail, hotmail, yahoo, etc..)
             
            'PASSWORD'    => '27d11210510f00',  //contraseña de usuario mailer
           
            'SECURE'      => 'tls', //Habilite el cifrado TLS, también se acepta `ssl`
            
            'PORT'        => 2525, //Puerto TCP para conectarse
            
        ];
```


## Como usarlo ⚙️


```php
<?php
use DevZeros\Mailer\Mailer;
   
class MailerTest{
    public function __construct() {
        $mail = new Mailer($config); //$config["mailer"] ...
        
        $html = $mail->builderMail()
                ->title("Saludos")
                ->greeting("Ejemplo")
                ->title("ejemplo")
                ->title("ejemplo")
                ->footerImg(/*"imgBase64"*/)
                ->footer("text", "nombre", "link")
                ->line("otro")
                ->firm("titulo","nombre","telefono", "email")
                ->logo(/*"imgBase64"*/)
                ->action("Nombre de la acción", "url") //optional
                ->build();
        
        $mail->setHtml($html);
        $mail->setArchive("file"); //dirección fisica 
        $mail->setArchive(dirname(dirname(__FILE__)) . "/Tests/6967340.pdf");
        $mail->setImg(/*"file"*/); //optional
        $mail->sendMail( //return true|false|exception(string)
            [
                "subject" => "Esto es una prueba",
                 "from"    => [
                    "mail" => "wowzeros2@gmail.com",
                    "name" => "carlos"
                 ],
                 "address" => [
                    "mail" => "Ceo@gammacorp.co",
                            "name" => "Johnnatan rodriguez"
                 ],
            ]
        );
    }
}   
     
```

## Autores ✒️


* **Carlos Andrés Castilla García** - *Dev* - [Dev-Zeros](https://github.com/Desarrollo-zeros/)

## Licencia 📄

Este proyecto está bajo la Licencia (Tu Licencia) - mira el archivo [LICENSE.md](LICENSE.md) para detalles

