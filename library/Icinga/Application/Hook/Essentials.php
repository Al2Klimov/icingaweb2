<?php
/* Icinga Web 2 | (c) 2026 Icinga GmbH | GPLv2+ */

namespace Icinga\Application\Hook;

use Icinga\Application\Hook;

/**
 * All hooks are provided and consumed - this trait provides the mechanism
 */
trait Essentials
{
    /**
     * Legacy hooks must override this with the name they used to pass to {@link Hook::all},
     * new ones should keep this name as-is, but not rely on its current default
     */
    protected static $name = self::class;

    /**
     * Return all instances of the hook
     *
     * @return static[]
     */
    public static function all(): array
    {
        return Hook::all(static::$name);
    }

    /**
     * Register a hook provider
     *
     * @param bool $alwaysRun Whether to always run the hook, without permission check
     */
    public static function register(bool $alwaysRun = false): void
    {
        Hook::register(static::$name, static::class, static::class, $alwaysRun);
    }
}
