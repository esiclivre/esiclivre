<?php
namespace Esic;

use PHPMailer\PHPMailer\PHPMailer;

class Carteiro
{
    private $assunto;
    private $destino_email;
    private $destino_nome;
    private $mensagem;
    private $Mensagens;

    public function __construct()
    {
        $this->Mensagens = new MensagensLista;
    }

    public function defAssunto($assunto)
    {
        $this->assunto = (string) $assunto;
        return $this;
    }

    public function defDestino($email, $nome = null)
    {
        $this->destino_email = (string) $email;
        $this->destino_nome = (string) $nome;
        return $this;
    }

    public function defMensagem($mensagem)
    {
        $this->mensagem = (string) $mensagem;
        return $this;
    }

    public function enviar()
    {
        $PHPMailer = new PHPMailer;
        $PHPMailer->setLanguage('pt_br');
        $PHPMailer->CharSet = 'UTF-8';

        // Autênticação e segurança
        if (SMTP_AUTH) {
            $PHPMailer->SMTPAuth = true;
            $PHPMailer->SMTPSecure = SMTP_PROTOCOL;
        }

        // Configuração da conta de envio
        $PHPMailer->isSMTP();
        $PHPMailer->Host = MAIL_HOST;
        $PHPMailer->Port = MAIL_PORTA;
        $PHPMailer->Username = SMTP_USER;
        $PHPMailer->Password = SMTP_PWD;

        // Configurando remente e destinatário
        $PHPMailer->setFrom(SMTP_EMAIL, SMTP_NOME);
        $PHPMailer->addAddress($this->destino_email, $this->destino_nome);

        // Configurando mensagem
        $PHPMailer->isHTML(true);
        $PHPMailer->Subject = $this->assunto;
        $PHPMailer->Body = $this->mensagem;

        if (!$PHPMailer->send()) {
            echo $PHPMailer->ErrorInfo;
            $this->Mensagens->adicionar(
                new Mensagem('carteiro-envio-erro')
            );
            return false;
        }

        $this->Mensagens->adicionar(
            new Mensagem('carteiro-envio-sucesso')
        );

        return true;
    }

    public function obterMensagens()
    {
        return $this->Mensagens;
    }
}
