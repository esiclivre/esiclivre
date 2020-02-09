<?php
require '../../config.php';

use Esic\Container;
use Esic\Mensagem;
use Esic\Senders\Mail;

// Definindo templates padrões
$pag_corpo = ESIC_VIZ.'solicitante-cadastro-form.php';
$pag_corpo_param = array();
$pag_menu = ESIC_VIZ.'menu-inicial.php';

// Criando variáveis padrões
$sit_cadastro = false;
$Mensagem = new \Esic\Mensagem('msg-vazia');

// Obtendo a lista de faixas etárias
$FaixaEtariaBd = new \Esic\FaixaEtariaBd;
$FaixaEtariaLista = $FaixaEtariaBd->obterLista();

// Obtendo a lista de estados
$EstadoBd = new \Esic\EstadoBd;
$EstadosLista = $EstadoBd->obterLista();

// Criando objeto de validação
$Validador = new \Esic\SolicitanteValidadorCadastro;

// Verificando solicitação de cadastro
$acao = filter_input(INPUT_POST, 'acao');
if ($acao != 'cadastrar') {
    $Solicitante = new \Esic\Solicitante;
} else {
    // Convertendo dados
    $Solicitante = \Esic\SolicitanteConversor::deArray($_POST);

    // Capturando valore extra
    $extra = array(
        'email' => filter_input(INPUT_POST, 'email_confirmacao'),
        'senha' => filter_input(INPUT_POST, 'senha_confirmacao')
    );

    // Checando validade dos dados
    $sit_avisos = $Validador::checar($Solicitante, $extra);

    // Se não houver nenhum aviso solicitar o cadastro
    if ($sit_avisos) {
        $Bd = new \Esic\SolicitanteBd;

        $sit_cadastro = $Bd->cadastrar($Solicitante);

        if (! $sit_cadastro) {
            $Mensagem = $Bd->obterMensagens()->obterUltima();
        } else {
            // Gerando mensagem
            $email_msg = \Esic\Template::gerar(
                ESIC_VIZ.'solicitante-cadastro-email.php',
                array('solicitante' => $Solicitante)
            );

            $settingsMail = Container::get('settingsMailer');
            $senderMail = new Mail($settingsMail);

            // Definindo e enviando
            $sit_cadastro = $senderMail
            ->setFrom($settingsMail->getUser(), $settingsMail->getName())
            ->addTo($Solicitante->obterEmail(), $Solicitante->obterNome())
            ->setSubject('Cadastro no '. SISTEMA_NOME)
            ->setBody($email_msg, true)
            ->send()
            ;

            if (! $sit_cadastro) {
                error_log($senderMail->getError());
                $Mensagem = new Mensagem('carteiro-envio-erro', $senderMail->getError());
            }
        }
    }
}

// Verificando se o cadastro foi bem sucedido
if ($sit_cadastro) {
    $pag_corpo = ESIC_VIZ.'solicitante-cadastro-ok.php';
} else {
    $pag_corpo_param = array(
        'solicitante' => $Solicitante,
        'solicitante-validador' => $Validador,
        'email-confirmacao' => filter_input(INPUT_POST, 'email_confirmacao'),
        'escolaridade-lista' => \Esic\Escolaridade::obterLista(),
        'estados' => $EstadosLista,
        'faixa-etaria-lista' => $FaixaEtariaLista,
        'mensagem' => $Mensagem,
        'telefones-tipo-lista' => \Esic\TelefonesTipo::obterLista()
    );
}

// Gerando subpáginas
$subpag = array(
    'menu' => \Esic\Template::gerar($pag_menu),
    'corpo' => \Esic\Template::gerar( $pag_corpo, $pag_corpo_param )
);

// Gerando página principal
echo \Esic\Template::gerar(ESIC_VIZ.'geral.php', $subpag);
