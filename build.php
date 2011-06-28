<?php

/*
 * This file builds index.php
 */

//TODO: If someone has time to clean this code up, please do so.

//<functions>

function build_fail($reason)
{
    writeln($reason);
    writeln('Build failed.');
    die();
}

function writeln($message)
{
    echo $message."\n";
}

function from_cli()
{
    if((php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))) {

        return true;
    }
    else {

        return false;
    }
}

function replace_static($matches)
{

    $filename = __DIR__.'/web/'.$matches[1];

    return Minifier::minify($filename);
}

//</functions>


writeln('Building index.php');

if(!from_cli())
{
    build_fail('This file must be run from the cli.');
}

require_once __DIR__.'/src/Builder/Minifier.php';
require_once __DIR__.'/src/Builder/minify/html.php';
require_once __DIR__.'/src/Builder/minify/js.php';
require_once __DIR__.'/src/Builder/minify/css.php';


$contents = '<?php';

writeln('Searching for files...');

$files =    new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(__DIR__.'/src'),
                RecursiveIteratorIterator::SELF_FIRST
            );

writeln('Adding files...');

foreach($files as $name => $object){

    if(is_file($name)) {

        $file = file_get_contents($name);

        if(substr($file, 0, 5) == '<?php')
        {
            $file = substr($file, 5);
        }

        $file = preg_replace_callback(
          '#\<import resource="(.+?)" \/\>#s',
          'replace_static',
          $file
        );

        $contents .= $file;
    }
}

$contents .= ' OneClick::dispatch(@$_GET[\'id\']);';

writeln('Writing file...');

file_put_contents(__DIR__.'/index.php', $contents);

writeln('Compressing file...');

$contents = php_strip_whitespace(__DIR__.'/index.php');

file_put_contents(__DIR__.'/index.php', $contents);

echo "Successfully built index.php\n";