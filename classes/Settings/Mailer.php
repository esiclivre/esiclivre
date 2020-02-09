<?php
namespace Esic\Settings;

use Esic\Settings\Settings;

class Mailer implements Settings
{
    public const LIBRARY_PHPMAILER = 'phpmailer';

    private bool $authentication;
    private string $host;
    private string $library;
    private string $mail;
    private string $name;
    private string $password;
    private int $port;
    private string $protocol;
    private string $user;
    private bool $verifyCertificates;

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
        $this->verifyCertificates = (bool) ($config['verifyCertificates'] ?? true);
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

    public function getVerifyCertificates(): bool
    {
        return $this->verifyCertificates;
    }
}
