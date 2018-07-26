<?php
require '../../config.php';

use Esic\Mensagem;

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

        // Criando objeto para envio de e-mail
        $Carteiro = new \Esic\Carteiro;

        // Definindo e enviando
        $sit_cadastro = $Carteiro
        ->defDestino($Solicitante->obterEmail(), $Solicitante->obterNome())
        ->defAssunto('Confirmação de Cadastro no '. SISTEMA_NOME)
        ->defMensagem($email_msg)
        ->enviar()
        ;

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
