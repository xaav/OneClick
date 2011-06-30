<?php

if(config('debug')) {
    sleep(1);
}

class OneClick extends Base
{
    public function start()
    {
        require 'html/start.html';
    }

    public function scripts()
    {
        require 'js/jquery.js';
        require 'js/oneclick.js';
        require 'js/json.js';
        require 'js/requirements.js';
        require 'js/installer.js';
        require 'js/junk.js';
    }

    public function requirements_template()
    {
        require 'html/requirements.html';
    }

    public function requirements()
    {
        echo json_encode($this->requirements->getRequirementNames());
    }

    public function check_requirement($requirement)
    {
        echo json_encode(array($requirement => $this->requirements->checkRequirementByName($requirement)));
    }

    public function getInstallerSteps()
    {
        $steps = $this->installer->getSteps();

        return json_encode($steps);
    }

    public function processInstallerStepByName($name)
    {
        $this->installer->processStepByName($name);
        return $this->installer->getPercentComplete();
    }
}