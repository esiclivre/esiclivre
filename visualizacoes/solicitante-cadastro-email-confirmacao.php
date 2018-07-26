<?php
// Verificando Dependências
if (
    ! isset($_TEMPLATE['solicitante']) ||
    ! ($_TEMPLATE['solicitante'] instanceof \Esic\Solicitante)
) {
    die('É necessário de solicitante para exibição da página');
}

$Solicitante = $_TEMPLATE['solicitante'];

$Documento = $Solicitante->obterCpf() ?? $Solicitante->obterCnpj();
?>

<p>Prezado(a) <?= $Solicitante->obterNome() ?>,</p>
<p>Seu cadastro no <?= SISTEMA_NOME ?> foi confirmado com sucesso.</p>
<p>Link de acesso: <a href="<?= SITELNK ?>"><?= SITELNK ?></a></p>
<p>Usuário: <?= $Documento->valor() ?></p>
<p><i>**A senha de acesso é aquela informada no cadastro. Caso não se lembre, solicite o envio de uma nova senha pelo link "Esqueci a senha" no formulário de login do sistema.</i></p>
<p>Mensagem automatica do <?= SISTEMA_NOME ?>.</p>
