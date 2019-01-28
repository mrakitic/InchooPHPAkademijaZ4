<?php
class IdGenerator
{
    protected static $id = 0;
    public static function getInstance()
    {
        if (!isset(self::$id)) {
            self::$id = new self();
        }
        self::$id++;
        return self::$id;
    }
}