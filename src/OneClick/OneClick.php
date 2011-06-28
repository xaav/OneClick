<?php

sleep(1); //HACK FOR DEBUG

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
            case 'requirements_template':
                Templates::RequirementsTemplate();
                break;
            case 'requirements':
                echo json_encode(Requirements::getRequirementNames());
                break;
            case 'check_requirement':
                echo json_encode(array($exploded[1] => Requirements::checkRequirementByName($exploded[1])));

        }
    }
}