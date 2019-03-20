<?php
namespace Esic\Settings;

use Esic\Settings\Settings;

class Mailer implements Settings
{
    public const LIBRARY_PHPMAILER = 'phpmailer';

    /** @var bool */
    private $authentication;

    /** @var string */
    private $host;

    /** @var string */
    private $library;

    /** @var int */
    private $port;

    /** @var string */
    private $protocol;

    /** @var string */
    private $mail;

    /** @var string */
    private $name;

    /** @var string */
    private $password;

    /** @var string */
    private $user;

    public function __construct(array $config)
    {
        $this->authentication = (bool) ($config['authentication'] ?? false);
        $this->host = (string) ($config['host'] ?? '');
        $this->library = (string) ($config['library'] ?? '');
        $this->port = (int) ($config['port'] ?? 0);
        $this->protocol = (string) ($config['protocol'] ?? 'ssl');
        $this->mail = (string) ($config['mail'] ?? '');
        $this->name = (string) ($config['name'] ?? '');
        $this->password = (string) ($config['password'] ?? '');
        $this->user = (string) ($config['user'] ?? '');
    }

    public function getAuthentication(): bool
    {
        return $this->authentication;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getLibrary(): string
    {
        return $this->library;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}
