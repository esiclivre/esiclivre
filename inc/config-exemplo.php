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

//codigo para definição da lista de sessão do sistema
define("SISTEMA_CODIGO", "esiclivre");

//nome do sistema para exibição em lugares diversos
define("SISTEMA_NOME", "e-SIC Livre");
define(
  "SISTEMA_DESCRICAO",
  "Sistema Eletrônico do Serviço de Informação ao Cidadão"
);
define(
  "SISTEMA_PALAVRAS_CHAVE",
  "SIC, sistema, informação, acesso, governo, solicitacao"
);

// Configurações de banco de dados
define("DB_TIPO", "mysql");
define("DBHOST", "localhost");
define("DBUSER", "usuariodobanco");
define("DBPASS", "senhadousuariodobanco");
define("DBNAME", "nomedobanco");

// Definições de e-mail
define("USE_PHPMAILER", false);
define("MAIL_HOST", "mail.gov.br");
define("MAIL_PORTA", 465);
define("SMTP_AUTH", false);
define("SMTP_USER", "usuario");
define("SMTP_PWD", "senha");
define("SMTP_EMAIL", "email@mail.gov.br");
define("SMTP_NOME", "Nome de Identificação");

// Endereços do site
define("SITELNK", "http://www.seusite/esiclivre/");	//endere�o principal do site
define("URL_BASE_SISTEMA", "http://www.seusite/esiclivre/");	//endere�o principal do site

?>
