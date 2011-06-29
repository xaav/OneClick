<?php

class Requirements implements RequirementsInterface
{
    public function getRequirementNames()
    {
        return array(
            'fakerequirement' => 'Some Fake Requirement',
        );
    }

    public function checkRequirementByName($name)
    {
        switch ($name) {

            case 'fakerequirement':
                return true;
        }
    }
}