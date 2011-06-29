<?php

interface RequirementsInterface
{
    public function getRequirementNames();

    public function checkRequirementByName($name);
}
