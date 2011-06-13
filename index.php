<html>
    <head>
    	<title>OneClick Installer</title>
    </head>
    <body>
    	<center>
    		<h1>Welcome.</h1><br>
    		<b>Please wait...</b>
    	</center>
	</body>
</html>

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