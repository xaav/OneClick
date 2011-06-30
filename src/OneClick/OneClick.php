<?php

if(config('debug')) {
    sleep(1);
}

class OneClick extends Base
{
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