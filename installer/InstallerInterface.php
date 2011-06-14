<?php

interface InstallerInterface
{
    public static function getSteps();

    public static function processStepByName($name);

    public static function getPercentComplete();
}