<?php

/*
 * This file builds index.php
 */

if(!(php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))) {

    die('This file must be run from the command line.');
}

echo "Building index.php\n";

function minify_by_filename($contents, $filename)
{
    $ext = substr(strrchr($filename, '.'), 1);

    switch ($ext) {

        case 'html':
            require_once __DIR__.'/build/minify/html.php';
            $contents = Minify_HTML::minify($contents);
    }

    return $contents;
}

$handle = fopen(__DIR__.'/index.php', 'w+');

fwrite($handle, '<?php');

echo "Adding files\n";

foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__.'/installer'), RecursiveIteratorIterator::SELF_FIRST) as $name => $object){

    echo "Adding file $name\n";

    $contents = file_get_contents($name);

    if(substr($contents, 0, 5) == '<?php') $contents = substr($contents, 5);

    $contents = preg_replace("'\s+'", ' ', $contents);

    $contents = preg_replace_callback(
      '#\<import resource="(.+?)" \/\>#s',
      function ($matches) {
        echo "Adding resource $matches[1]\n";

        $filename = __DIR__.'/static/'.$matches[1];

        if($contents = file_get_contents($filename)) {

            return minify_by_filename($contents, $filename);
        }
        else{

            die("Build failed\n");

        }
      },
      $contents
    );

    fwrite($handle, $contents);
}

echo "Completing build\n";

fwrite($handle, ' OneClick::dispatch(@$_GET[\'id\']);');

fclose($handle);

echo "Successfully built index.php\n";