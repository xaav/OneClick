<?php

/*
 * This file builds index.php
 */

if(!(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))) {

    die('This file must be run from the command line.');
}

echo "Building index.php\n";

$handle = fopen(__DIR__.'/index.php', 'w+');

fwrite($handle, '<?php');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/installer'), RecursiveIteratorIterator::SELF_FIRST);
foreach($objects as $name => $object){

    echo "Adding file $name\n";

    $contents = file_get_contents($name);

    if(substr($contents, 0, 5) == '<?php'){

        $contents = substr($contents, 5);
    }

    $contents = preg_replace_callback(
      '#\<import resource="(.+?)" \/\>#s',
      function ($matches) {
        echo "Adding resource $matches[1]\n";
        return file_get_contents(__DIR__.'/static/'.$matches[1]);
      },
      $contents
    );

    fwrite($handle, $contents);
}

$contents = file_get_contents(__DIR__.'/start.php');

if(substr($contents, 0, 5) == '<?php'){

    $contents = substr($contents, 5);
}

fwrite($handle, $contents);

fclose($handle);

echo "Successfully built index.php\n";