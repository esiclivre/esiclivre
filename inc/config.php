<?php
require_once __DIR__.'/../vendor/autoload.php';

use Esic\Container;
use Esic\Settings\App;
use Esic\Settings\Database;
use Esic\Settings\Environment;
use Esic\Settings\Mailer;
use Esic\Settings\Session;

(function(array $fileSettings){
    $app = new App($fileSettings['app'] ?? []);
    $database = new Database($fileSettings['database'] ?? []);
    $environment = new Environment($fileSettings['environment'] ?? []);
    $mailer = new Mailer($fileSettings['mailSender'] ?? []);
    $session = new Session($fileSettings['session'] ?? []);

    Container::add('settingsApp', $app)
    ::add('settingsDatabase', $database)
    ::add('settingsEnvironment', $environment)
    ::add('settingsMailer', $mailer)
    ::add('settingsSession', $session);

    /**
     * Environment
    */
    if ($environment->getMode() == Environment::MODE_DEVELOPMENT) {
        ini_set('display_errors', true);
        error_reporting(E_ALL);
    }
    mb_internal_encoding($environment->getEncoding());
    mb_http_output($environment->getEncoding());

    /**
     * Sesion
    */
    define("SISTEMA_CODIGO", $session->getName());

    /**
     * App
    */
    define("SISTEMA_NOME", $app->getName());
    define("SISTEMA_DESCRICAO", $app->getDescription());
    define("SISTEMA_PALAVRAS_CHAVE", $app->getKeyWords());
    define("SITELNK", $app->getUrl());
    define("URL_BASE_SISTEMA", $app->getUrl());

    /**
     * Database
    */
    define("DB_TIPO", $database->getDrive());
    define("DBHOST", $database->getHost());
    define("DBUSER", $database->getUser());
    define("DBPASS", $database->getPassword());
    define("DBNAME", $database->getName());

    /**
     * E-mail
    */
    define("USE_PHPMAILER", $mailer->getLibrary() == Mailer::LIBRARY_PHPMAILER);
    define("MAIL_HOST", $mailer->getHost());
    define("MAIL_PORTA", $mailer->getPort());
    define("SMTP_AUTH", $mailer->getAuthentication());
    define("SMTP_USER", $mailer->getUser());
    define("SMTP_PWD", $mailer->getPassword());
    define("SMTP_EMAIL", $mailer->getMail());
    define("SMTP_NOME", $mailer->getName());
    define("SMTP_PROTOCOL", $mailer->getProtocol());
})(include __DIR__.'/../settings.php');
