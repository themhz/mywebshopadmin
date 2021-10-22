<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace mywebshop\components\handlers;

class Session
{    
    public function __construct(?string $cacheExpire = null, ?string $cacheLimiter = null)
    {

        if (session_status() === PHP_SESSION_NONE) {

            if ($cacheLimiter !== null) {
                session_cache_limiter($cacheLimiter);
            }

            if ($cacheExpire !== null) {
                session_cache_expire($cacheExpire);
            }

            session_start();            
        }
    }


    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }


    public function get(string $key)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    public function remove(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function clear(): void
    {
        session_unset();
        session_destroy();

        //session_reset();
        //session_regenerate_id();

    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function getAll()  {
        return $_SESSION;
    }

    public function getId(): string{

        //session_regenerate_id();
        return session_id();
    }
}
