<?php

class Installer implements InstallerInterface
{
    public static function getSteps()
    {
        return array(
            'firststep' => 'Downloading...',
            'secondstep' => 'Installing...',
        );
    }

    public static function processStepByName($name)
    {
        switch ($name)
        {
            case 'firststep':
                break;
            case 'secondstep':
                break;
        }
    }

    public static function getPercentComplete()
    {
        return .5;
    }
}