<?php

/*
 * This file builds index.php
 */

if(!(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))) {

    die('This file must be run from the command line.');
}

echo "Building index.php\n";

$handle = fopen(__DIR__.'/index.php', 'w+');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/installer'), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){

    echo "Adding file $name\n";

    $contents = file_get_contents($name);

    if(substr($contents, 0, 5) == '<?php'){

        $contents = substr($contents, 5);
    }

    fwrite($handle, $contents);
}

$contents = file_get_contents(__DIR__.'/start.php');

fwrite($handle, $contents);

fclose($handle);

echo "Successfully built index.php\n";