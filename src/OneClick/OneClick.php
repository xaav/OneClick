<?php

sleep(1); //HACK FOR DEBUG

class OneClick
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

    public function start()
    {
        Templates::StartPage();
    }

    public function scripts()
    {
        StaticResources::jQuery();
        StaticResources::OneClick();
    }

    public function requirements_template()
    {
        Templates::RequirementsTemplate();
    }

    public function requirements()
    {
        echo json_encode($this->requirements->getRequirementNames());
    }

    public function check_requirement($requirement)
    {
        echo json_encode(array($requirement => $this->requirements->checkRequirementByName($requirement)));
    }
}