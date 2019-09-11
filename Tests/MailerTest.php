<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use DevZeros\Mailer\Mailer;

class MailerTest extends TestCase
{
    public function testMail()
    {
        $config["mailer"] = [
            'SMTP_DEBUG' => 2,
            // Habilitar salida de depuración detallada
            'MAIL_DRIVER' => 'smtp',
            //Configurar la aplicación de correo para usar SMTP, driver: smpt, mail, sendmail, qmail
            'HOST' => 'smtp.mailtrap.io',
            //Especificar servidores SMTP principales y de respaldo
            'AUTH' => true,
            //Habilitar autenticación SMTP
            'USERNAME' => 'db99c114d445f5',
            //usuario mailer (gmail, hotmail, yahoo, etc..)
            'PASSWORD' => '27d11210510f00',
            //contraseña de usuario mailer
            'SECURE' => 'tls',
            //Habilite el cifrado TLS, también se acepta `ssl`
            'PORT' => 2525,
            //Puerto TCP para conectarse
        ];

        $mail = new Mailer($config);

        $html = $mail->builderMail()
            ->title()
            ->logo()
            ->firm(
                "Dev",
                "Carlos Andrés Castilla García",
                "+57 3043541475",
                "wowzeros2@gmail.com"
            )
            ->line()
            ->footer()
            ->greeting()
            ->footerImg()
            ->build();

        $mail->setHtml($html);
        $mail->setArchive(dirname(dirname(__FILE__))."/Tests/estimacion_de_costo.pdf");
        $mail->setArchive(dirname(dirname(__FILE__))."/Tests/6967340.pdf");
        $mail->setImg(dirname(dirname(__FILE__))."/Tests/img.jpg");
        $bool = $mail->sendMail(
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
        $this->assertTrue($bool);
    }
}
