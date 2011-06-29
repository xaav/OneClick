<?php

class Installer implements InstallerInterface
{
    public function getSteps()
    {
        return array(
            'firststep' => 'Downloading...',
            'secondstep' => 'Installing...',
        );
    }

    public function processStepByName($name)
    {
        switch ($name)
        {
            case 'firststep':
                break;
            case 'secondstep':
                break;
        }
    }

    public function getPercentComplete()
    {
        return .5;
    }
}