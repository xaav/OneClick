<?php

interface InstallerInterface
{
    public function getSteps();

    public function processStepByName($name);

    public function getPercentComplete();
}