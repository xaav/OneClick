<?php

interface RequirementsInterface
{
    public static function getRequirementNames();

    public static function checkRequirementByName($name);
}
