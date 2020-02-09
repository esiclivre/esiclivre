<?php

define('ESIC_RAIZ', __DIR__.'/');
define('ESIC_VIZ', ESIC_RAIZ.'visualizacoes/');

require ESIC_RAIZ.'inc/config.php';
require ESIC_RAIZ.'funcoes/autoload.php';
require ESIC_RAIZ.'vendor/autoload.php';

ini_set('error_log', __DIR__.'/storages/error.log');