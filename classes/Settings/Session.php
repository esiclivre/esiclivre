<?php
namespace Esic\Settings;

use Esic\Settings\Settings;

class Session implements Settings
{
    /** @var string */
    private $domain;

    /** @var int */
    private $lifetime;

    /** @var bool */
    private $httponly;

    /** @var string */
    private $name;

    /** @var string */
    private $path;

    /** @var bool */
    private $regenerateId;

    /** @var bool */
    private $secure;


    public function __construct(array $config)
    {
        $this->domain = (string) ($config['domain'] ?? '');
        $this->lifetime = (int) ($config['lifetime'] ?? 1200);
        $this->httponly = (bool) ($config['httponly'] ?? true);
        $this->name = (string) ($config['name'] ?? '');
        $this->path = (string) ($config['path'] ?? '/');
        $this->regenerateId = (bool) ($config['regenerateId'] ?? true);
        $this->secure = (bool) ($config['secure'] ?? false);
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    public function getHttponly(): bool
    {
        return $this->httponly;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getRegenerateId(): bool
    {
        return $this->regenerateId;
    }

    public function getSecure(): bool
    {
        return $this->secure;
    }
}
