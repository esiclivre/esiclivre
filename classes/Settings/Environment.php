<?php
namespace Esic\Settings;

use Esic\Settings\Settings;

class Environment implements Settings
{
    /** @var string */
    public const MODE_DEVELOPMENT = 'development';

    /** @var string */
    public const MODE_PRODUCTION = 'production';

    /** @var string */
    private $assetsUrl;

    /** @var string */
    private $encoding;

    /** @var string */
    private $locale;

    /** @var string */
    private $mediaUrl;

    /** @var string */
    private $mode;

    /** @var string */
    private $timezone;

    /** @var string */
    private $viewsCache;

    public function __construct(array $config)
    {
        $this->assetsUrl = (string) ($config['assetsUrl'] ?? '');
        $this->encoding = (string) ($config['encoding'] ?? '');
        $this->locale = (string) ($config['locale'] ?? '');
        $this->mediaUrl = (string) ($config['mediaUrl'] ?? '');
        $this->mode = (string) ($config['mode'] ?? '');
        $this->timezone = (string) ($config['timezone'] ?? '');
        $this->viewsCache = (string) ($config['viewsCache'] ?? '');
    }

    public function getAssetsUrl(): string
    {
        return $this->assetsUrl;
    }

    public function getEncoding(): string
    {
        return $this->encoding;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getMediaUrl(): string
    {
        return $this->mediaUrl;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getViewsCache(): string
    {
        return $this->viewsCache;
    }
}
