<?php

$file = '';

switch ($_GET['resource'])
{
    case 'script':
        $file = 'scripts';
        break;
}

require __DIR__.'includes/'.$file.'.php';