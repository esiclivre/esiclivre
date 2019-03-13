<?php
namespace Esic\Settings;

use Esic\Settings\Settings;

class Database implements Settings
{
    /** @var string */
    private $charset;

    /** @var string */
    private $drive;

    /** @var string */
    private $host;

    /** @var string */
    private $name;

    /** @var string */
    private $password;

    /** @var int */
    private $port;

    /** @var string */
    private $user;

    public function __construct(array $config)
    {
        $this->charset = (string) ($config['charset'] ?? 'utf-8');
        $this->drive = (string) ($config['drive'] ?? '');
        $this->host = (string) ($config['host'] ?? '');
        $this->name = (string) ($config['name'] ?? '');
        $this->password = (string) ($config['password'] ?? '');
        $this->port = (int) ($config['port'] ?? 3306);
        $this->user = (string) ($config['user'] ?? '');
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function getDrive(): string
    {
        return $this->drive;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}
