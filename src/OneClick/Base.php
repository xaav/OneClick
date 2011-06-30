<?php

class Base
{
    protected $requirements;
    protected $installer;

    public function __construct()
    {
        $installerClass = config('installer_class');
        $requirementsClass = config('requirements_class');

        $this->installer = new $installerClass();
        $this->requirements = new $requirementsClass();

        if(!($this->installer instanceof InstallerInterface))
        {
            throw new Exception('Invalid installer class');
        }

        if(!($this->requirements instanceof RequirementsInterface))
        {
            throw new Exception('Invalid requirements class');
        }
    }

    public static function dispatch($query)
    {
        $exploded = explode('|', $query);

        $id = $exploded[0];
        unset($exploded[0]);
        $exploded = array_values($exploded);

        if(!$id) $id = 'start';

        echo call_user_func_array(array(new OneClick(), $id), $exploded);
    }
}