<?php
class IdGenerator
{
    protected static $id = 0;
    public static function getInstance()
    {
        if (!isset(self::$id)) {
            //Find out what is a difference between new self() and new static()
            self::$id = new self();
        }
        self::$id++;
        return self::$id;
    }
}