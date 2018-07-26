<?php
    if (empty($_SESSION[SISTEMA_CODIGO])) {
        exit;
    }
?>
<ul>
    <li class="opcao"><a href="<?= SITELNK ?>index.php">Início</a></li>
    <img src="<?= SITELNK ?>css/img/pipe.png" alt="Imagem E-sic Livre" />
    <li class="opcao"><a href="<?= SITELNK ?>solicitante">Alterar Cadastro</a></li>
    <img src="<?= SITELNK ?>css/img/pipe.png" alt="Imagem E-sic Livre"/>
    <li class="opcao"><a href="<?= SITELNK ?>alterasenha">Alterar Senha</a></li>
    <img src="<?= SITELNK ?>css/img/pipe.png" alt="Imagem E-sic Livre"/>
    <li class="opcao"><a href="<?= SITELNK ?>solicitacao">Fazer Solicitação</a></li>
    <img src="<?= SITELNK ?>css/img/pipe.png" alt="Imagem E-sic Livre"/>
    <li class="opcao"><a href="<?= SITELNK ?>acompanhamento">Solicitações Realizadas</a></li>
    <img src="<?= SITELNK ?>css/img/pipe.png" alt="Imagem E-sic Livre"/>
    <li class="opcao"><a href="<?= SITELNK ?>index/logout.php">Sair</a></li>
</ul>
