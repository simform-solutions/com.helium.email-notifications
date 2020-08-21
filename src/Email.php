<?php

namespace Helium\EmailNotifications;

use Helium\EmailNotifications\Contracts\EmailEngineContract;
use Helium\ServiceManager\EngineContract;
use Helium\ServiceManager\ServiceManager;
use Illuminate\Support\Traits\ForwardsCalls;

/**
 * @mixin EmailEngineContract
 */
class Email extends ServiceManager
{
    protected static function getDefaultEngineName(): string
    {
        return config('email.defaults.engine');
    }

    protected static function getEngineContract(): string
    {
        return EmailEngineContract::class;
    }

    protected static function lazyLoadEngine(string $key)
    {
        if (!array_key_exists($key, self::$engines) &&
            array_key_exists($key, config('email.engines')) &&
            array_key_exists('class', config("email.engines.{$key}"))
        ) {
            $class = config("email.engines.{$key}.class");
            self::extend($key, new $class());
        }
    }

    public static function engine(string $key = null): EngineContract
    {
        $key = $key ?? static::getDefaultEngineName();
        self::lazyLoadEngine($key);

        return parent::engine($key);
    }

    public static function __callStatic($name, $arguments)
    {
        return self::engine()->{$name}(...$arguments);
    }
}