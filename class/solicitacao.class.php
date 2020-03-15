<?php

//se a classe for chamada pela area restrita do lei de acesso
if (empty($varAreaRestrita))
{
    include_once(__DIR__.'/../inc/security.php');
}

include_once(__DIR__ . '../inc/funcoes.php');
include(__DIR__ . '../solicitacao/upload.php');