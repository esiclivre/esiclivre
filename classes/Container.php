<?php
namespace Esic;

class Container
{
    /** @var Container */
    private static $myself;

    /** @var array */
    private static $items = [];

    public static function add(string $key, $value): self
    {
        self::$items[$key] = $value;

        if (self::$myself == null) {
            self::$myself = new self;
        }

        return self::$myself;
    }

    public static function get(string $key)
    {
        return self::$items[$key] ?? null;
    }
}
