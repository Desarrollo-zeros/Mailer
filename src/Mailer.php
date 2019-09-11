<?php

namespace DevZeros\Mailer;

use DevZeros\Mailer\Builders\BuilderMail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define( 'ABSPATH', dirname(dirname(__FILE__)) . '/src/' );

class Mailer
{
    /**
     * @var PHPMailer
     */
    private $mail;
    /**
     * @var array
     */
    private $config = [];

    private $html;

    private $archive = [];
    private $img = "";
    private $isImg = false;
    private $isArchive = false;
    private $isHtml = false;

    /**
     * Mailer constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->mail = new PHPMailer(true);
        $this->config = $config;
        $this->loaderMailer();
    }

    /**
     * @param $config
     */
    private function loaderMailer()
    {
        $this->mail->SMTPDebug = $this->config["mailer"]["SMTP_DEBUG"];       // Enable verbose debug output
        $this->setDriver($this->config["mailer"]["MAIL_DRIVER"]);       // Set mailer to use SMTP
        $this->mail->Host = $this->config["mailer"]["HOST"];            // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = $this->config["mailer"]["AUTH"];        // Enable SMTP authentication
        $this->mail->Username = $this->config["mailer"]["USERNAME"];    // SMTP username
        $this->mail->Password = $this->config["mailer"]["PASSWORD"];    // SMTP password
        $this->mail->SMTPSecure = $this->config["mailer"]["SECURE"];    // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = $this->config["mailer"]["PORT"];            // TCP port to connect to
    }

    private function setDriver($driver)
    {
        switch (strtolower($driver))
        {
            case "smtp" :
                $this->mail->isSMTP();
                break;
            case "mail" :
                $this->mail->isMail();
                break;
            case "sendmail":
                $this->mail->isSendmail();
                break;
            case "qmail" :
                $this->mail->isQmail();
                break;
        }
    }

    /**
     * @return PHPMailer
     */
    public function Mail()
    {
        return $this->mail;
    }

    public function builderMail($template = ABSPATH."View/template.php")
    {
        return new BuilderMail($template);
    }

    public function sendMail($data = [])
    {
        try
        {
            $this->mail->Subject = isset($data["subject"]) ? $data["subject"] : "test";
            $this->mail->setFrom(
                $data["from"]["mail"],
                isset($data["from"]["name"]) ? $data["from"]["name"] : '',
                );
            $this->mail->addAddress(
                $data["address"]["mail"],
                isset($data["address"]["name"]) ? $data["address"]["name"] : '',
                );     // Add a recipient

            if (!empty($data["reply"]["mail"]))
            {
                $this->mail->addReplyTo(
                    $data["reply"]["mail"],
                    isset($data["reply"]["name"]) ? $data["reply"]["name"] : '',
                    );
            }

            if (!empty($data["cc"]["mail"]))
            {
                $this->mail->addReplyTo(
                    $data["cc"]["mail"],
                    isset($data["cc"]["name"]) ? $data["cc"]["name"] : '',
                    );
            }

            if (!empty($data["bcc"]["mail"]))
            {
                $this->mail->addReplyTo(
                    $data["bcc"]["mail"],
                    isset($data["bcc"]["name"]) ? $data["bcc"]["name"] : '',
                    );
            }

            if(!empty($this->isHtml)){
                $this->mail->isHTML(true);
                $this->mail->msgHTML($this->getHtml());
            }

            if($this->isArchive){
                foreach ($this->getArchive() as $row){
                    $this->mail->addAttachment($row);
                }
            }
            if($this->isImg){
                $this->mail->addAttachment($this->getImg());
            }
            $this->mail->CharSet = 'UTF-8';
            return $this->mail->send();
        } catch (Exception $e)
        {
            return $e->getMessage();
        }
    }


    public function setHtml($html){
        $this->isHtml  =true;
        $this->html = $html;
    }

    public function getHtml(){
        return $this->html;
    }


    public function getArchive() {
        return $this->archive;
    }

    public function setArchive($archive){
        $this->isArchive = true;
        $this->archive[] = $archive;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img){
        $this->isImg = true;
        $this->img = $img;
    }


    public function __destruct()
    {

    }
}