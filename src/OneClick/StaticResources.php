<?php

class StaticResources
{
    public static function jQuery()
    {
        ?>
<import resource="js/jquery.js" />
        <?php
    }

    public static function OneClick()
    {
        ?>
<import resource="js/oneclick.js" />
<import resource="js/json.js" />
<import resource="js/requirements.js" />
        <?php

        require 'js/installer.js';
    }
}