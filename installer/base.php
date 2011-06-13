<?php

class Status
{
    /**
     * Status displayed to the user
     */
    public $message;

    /**
     * Percentage (Expressed as a decimal) of completion
     */
    public $complete;
}

interface ProcessStepInterface
{
    /**
     * @return Status
     */
    public function configure();
}
?>