<?php

class OneClick
{
    public static function dispatch($query)
    {
        $exploded = explode('|', $query);

        $id = $exploded[0];

        switch($id) {
            case '':
                Templates::StartPage();
                break;
            case 'scripts':
                StaticResources::jQuery();
                StaticResources::OneClick();
                break;
            case 'requirements':
                echo json_encode(Requirements::getRequirementNames());
                break;
            case 'check_requirement':
                echo json_encode(Requirements::checkRequirementByName($exploded[1]));

        }
    }
}