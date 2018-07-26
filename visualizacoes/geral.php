<?php
$corpo = isset($_TEMPLATE['corpo']) ? $_TEMPLATE['corpo'] : '';
$menu = isset($_TEMPLATE['menu']) ? $_TEMPLATE['menu'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="utf-8">

    <title><?= SISTEMA_NOME ?></title>

    <meta http-equiv="cache-control" content="no-cache">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?= SISTEMA_DESCRICAO ?>">
    <meta name="keywords" content="<?= SISTEMA_PALAVRAS_CHAVE ?>">

    <meta name="author" content="SEMPLA, Prefeitura do Natal">
    <meta name="rating" content="general">
    <meta name="revisit-after" content="30 days">
    <meta name="robots" content="all">

    <link rel="stylesheet" type="text/css" href="<?= SITELNK ?>css/estilo.css">

    <script src="<?= SITELNK ?>js/functions.js"></script>

    <!-- HTML5 shim e Respond.js para IE8 proporcionam suporte para os elementos HTML5 e media queries -->
    <!-- ATENÇÃO: Respond.js não funcionára se você estiver acessando a página via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="principal">
        <div id="out">
            <div id="conteudo">
                <header class="page-header">
                    <div id="cabecalho">
                        <div id="logo">
                            <a href="<?= SITELNK ?>index"><img src="<?= SITELNK ?>img/modelos/geral-logo.jpg" alt="Sistema Eletrônico do Serviço de Informação ao Cidadão"></a>
                        </div>

                        <div id="esic">
                            <a href="/"><img src="<?= SITELNK ?>css/img/eSIC.png" alt="e-SIC"></a>
                        </div>

                        <div id="menu">
                            <ul>
                                <?= $menu; ?>
                            </ul>
                        </div>
                    </div>
                </header>
                <div id="corpo">
                    <?= $corpo; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
