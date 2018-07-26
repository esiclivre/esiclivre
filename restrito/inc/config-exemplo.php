<?php
/**********************************************************************************
 Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

 Copyright (C) 2014 Prefeitura Municipal do Natal

 Este programa é software livre; você pode redistribuí-lo e/ou
 modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

ini_set('display_errors', true);
error_reporting(E_ALL);

// Diz para o PHP que estamos usando strings UTF-8 até o final do script
mb_internal_encoding('UTF-8');

// Diz para o PHP que nós vamos enviar uma saída UTF-8 para o navegador
mb_http_output('UTF-8');

define("SISTEMA_NOME", "e-SIC Livre"); //nome do sistema para exibi��o em lugares diversos
define("SISTEMA_CODIGO", "esiclivre"); //codigo para defini��o da lista de sess�o do sistema

// Configurações de banco de dados
define("DBHOST", "localhost");
define("DBUSER", "usuariodobanco");
define("DBPASS", "senhadousuariodobanco");
define("DBNAME", "nomedobanco");

// Definições de e-mail
define("USE_PHPMAILER", false);
define("MAIL_HOST", "mail.gov.br");
define("SMTP_AUTH", false);
define("SMTP_USER", "");
define("SMTP_PWD", "");

// Endereços do site

//endereço principal do site
define("SITELNK", "http://www.seusite/esiclivre/");

//endereço principal do site administração
define("URL_BASE_SISTEMA", "http://www.seusite/esiclivre/restrito/");

// Caminho para arquivos das classes do projeto Lei de Acesso
define("DIR_CLASSES_LEIACESSO","../class/");

define("SIS_TOKEN", date("H") . (date("d")+1) . "");
?>
