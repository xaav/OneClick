<?php

class StaticResources
{
    public static function jQuery()
    {
        ?>
<import resource="scripts/jquery.js" />
        <?php
    }

    public static function OneClick()
    {
        ?>
<import resource="scripts/oneclick.js" />
<import resource="scripts/json.js" />
<import resource="scripts/requirements.js" />
<import resource="scripts/installer.js" />
        <?php
    }
}