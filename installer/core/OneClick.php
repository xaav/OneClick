<?php

class OneClick
{
    public static function dispatch($id)
    {
        switch($id) {
            case '':
                Templates::StartPage();
                break;
            case 'scripts':
                StaticResources::jQuery();
                StaticResources::OneClick();
                break;
        }
    }
}