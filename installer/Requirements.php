<?php

class Requirements implements RequirementsInterface
{
    public static function getRequirementNames()
    {
        return array(
            'fakerequirement' => 'Some Fake Requirement',
        );
    }

    public static function checkRequirementByName($name)
    {
        switch ($name) {

            case 'fakerequirement':
                return true;
        }
    }
}