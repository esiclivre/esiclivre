<?php
require '../../config.php';

use Esic\Container;
use Esic\Mensagem;
use Esic\Senders\Mail;

// Definindo templates padrões
$pag_corpo = ESIC_VIZ.'mensagem.php';
$pag_menu = ESIC_VIZ.'menu-inicial.php';

$chave = filter_input(INPUT_GET, 'chave');

$Confirmacao = new \Esic\SolicitanteValidadorConfirmacao;
$sit = $Confirmacao::checar($chave);
$Mensagem = $Confirmacao::obterMensagens()->obterUltima();

if ($sit) {
    $Bd = new \Esic\SolicitanteBd;
    $Solicitante = $Confirmacao::obterSolicitante();
    $Solicitante->defSituacao(1);
    $Solicitante->defDataConfirmacao(new DateTime);

    if (! $Bd->editar($Solicitante)) {
        $Mensagem = new Mensagem('solicitante-confirmacao-erro');
    } else {
        // Gerando mensagem
        $email_msg = \Esic\Template::gerar(
            ESIC_VIZ.'solicitante-cadastro-email-confirmacao.php',
            array('solicitante' => $Solicitante)
        );

        $settingsMail = Container::get('settingsMailer');
        $senderMail = new Mail($settingsMail);

        // Definindo e enviando
        $sit_cadastro = $senderMail
            ->setFrom($settingsMail->getUser(), $settingsMail->getName())
            ->addTo($Solicitante->obterEmail(), $Solicitante->obterNome())
            ->setSubject('Confirmação de Cadastro no ' . SISTEMA_NOME)
            ->setBody($email_msg, true)
            ->send();

        // Criando mensagem de sucesso
        $Mensagem = new Mensagem('solicitante-confirmacao-sucesso');
    }
}

// Gerando subpáginas
$subpag = array(
    'menu' => \Esic\Template::gerar($pag_menu),
    'corpo' => \Esic\Template::gerar($pag_corpo, array('mensagem' => $Mensagem))
);

// Gerando página principal
echo \Esic\Template::gerar(ESIC_VIZ.'geral.php', $subpag);
