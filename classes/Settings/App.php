<?php
namespace Esic\Settings;

use Esic\Entity;
use Esic\Settings\Settings;

class App implements Settings
{
    /** @var string */
    private $description;

    /** @var Entity|Null */
    private $entityContact;

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

        if (isset($config['entityContact'])) {
            $this->entityContact = new Entity(
                (string) $config['entityContact']['name'] ?? '',
                (string) $config['entityContact']['mail'] ?? '',
                (string) $config['entityContact']['phone'] ?? '',
                (string) $config['entityContact']['address'] ?? '',
                (string) $config['entityContact']['serviceHours'] ?? ''
            );
        }

    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getEntityContact(): ?Entity
    {
        return $this->entityContact;
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
