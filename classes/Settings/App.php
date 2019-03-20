<?php
namespace Esic\Settings;

use Esic\Settings\Settings;

class App implements Settings
{
    /** @var string */
    private $description;

    /** @var string */
    private $keyWords;

    /** @var string */
    private $name;

    /** @var string */
    private $url;

    public function __construct(array $config)
    {
        $this->description = (string) ($config['description'] ?? '');
        $this->keyWords = (string) ($config['keyWords'] ?? '');
        $this->name = (string) ($config['name'] ?? '');
        $this->url = (string) ($config['url'] ?? '');
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getKeyWords(): string
    {
        return $this->keyWords;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
