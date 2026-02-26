<?php

namespace App\Services;

class SeasonService
{

    public static function init()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    /**
     * @param string $key
     * @param mixed $values
     * @return void
     */
    public static function store(string $key, mixed $values): void
    {
        self::init();
        $_SESSION[$key] = $values;
    }

    /**
     * Retorna os valores da session
     * @param string $key
     * @return mixed
     */
    public static function load(string $key): mixed
    {
        self::init();
        if(!isset($_SESSION[$key])) return null;
        return $_SESSION[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function remove(string $key): bool
    {
        self::init();
        if(!isset($_SESSION[$key])) return false;
        unset($_SESSION[$key]);
        return true;
    }
}