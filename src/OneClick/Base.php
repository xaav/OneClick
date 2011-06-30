<?php

class Base
{
    protected $requirements;
    protected $installer;

    public function __construct()
    {
        $this->installer = new Installer();
        $this->requirements = new Requirements();
    }

    public static function dispatch($query)
    {
        $exploded = explode('|', $query);

        $id = $exploded[0];
        unset($exploded[0]);
        $exploded = array_values($exploded);

        if(!$id) $id = 'start';

        echo call_user_func_array(array(new self(), $id), $exploded);
    }
}