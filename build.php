<?php

/*
 * This file builds index.php
 */

//TODO: If someone has time to clean this code up, please do so.

if(!(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))) {

    die('This file must be run from the command line.');
}

echo "Building index.php\n";

$handle = fopen(__DIR__.'/index.php', 'w+');

fwrite($handle, '<?php');

echo "Adding files\n";

foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/src'), RecursiveIteratorIterator::SELF_FIRST) as $name => $object){

    echo "Adding file $name\n";

    if(!is_dir($name)) {

        $contents = file_get_contents($name);

        if(substr($contents, 0, 5) == '<?php') $contents = substr($contents, 5);

        $contents = preg_replace("'\s+'", ' ', $contents);

        $contents = preg_replace_callback(
          '#\<import resource="(.+?)" \/\>#s',
          function ($matches) {
            echo "Adding resource $matches[1]\n";

            $filename = __DIR__.'/web/'.$matches[1];

             require_once __DIR__.'/build/Minifier.php';

            return Minifier::minify($filename);
          },
          $contents
        );

        fwrite($handle, $contents);

    }
}

echo "Completing build\n";

fwrite($handle, ' OneClick::dispatch(@$_GET[\'id\']);');

fclose($handle);

echo "Successfully built index.php\n";