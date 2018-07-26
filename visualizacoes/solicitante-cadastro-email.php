<?php
// Verificando Dependências
if (
    ! isset($_TEMPLATE['solicitante']) ||
    ! ($_TEMPLATE['solicitante'] instanceof \Esic\Solicitante)
) {
    die('É necessário de solicitante para exibição da página');
}

$Solicitante = $_TEMPLATE['solicitante'];
?>
<p>Prezado(a) <?= $Solicitante->obterNome() ?>,</p>
<p>Você se cadastrou no sistema <?= SISTEMA_NOME ?>. Para confirmar seu cadastro, favor acesse o endereço abaixo:</p>
<p>
    <a href="<?= SITELNK ?>solicitante/cadastro/confirmacao/?chave=<?= $Solicitante->obterChaveConfirmacao() ?>">
        <?= SITELNK ?>solicitante/cadastro/confirmacao/?chave=<?= $Solicitante->obterChaveConfirmacao() ?>
    </a>
</p>
<p>Mensagem automatica do <?= SISTEMA_NOME ?>.</p>
