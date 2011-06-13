<?php

class OneClick
{
    public static function dispatch($id)
    {
        switch($id) {
            case 'scripts':
                StaticResources::jQuery();
                StaticResources::OneClick();
        }
    }
}