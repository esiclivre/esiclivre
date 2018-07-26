<?php
// Verificando Dependências
if (
    ! isset($_TEMPLATE['mensagem']) ||
    ! ($_TEMPLATE['mensagem'] instanceof \Esic\Mensagem)
) {
    die('É necessário uma mensagem para exibição da página');
}
$Mensagem = $_TEMPLATE['mensagem'];

?>
<div>
    <h1>Mensagem</h1>
    <p class="msg-<?= $Mensagem->obterTipo() ?>"><?= $Mensagem->obterMensagem() ?></p>
</div>
