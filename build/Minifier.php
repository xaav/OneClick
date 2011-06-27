<?php

class Minifier
{
    public static function minify($filename)
    {
        list($ext, $contents) = self::getMetadata($filename);
        return $contents;//self::compress($contents, $ext);
    }

    protected static function getMetadata($filename)
    {
        $ext = substr(strrchr($filename, '.'), 1);

        echo "Loading resource $filename\n";

        $contents = file_get_contents($filename) or die('Build failed');

        return array($ext, $contents);
    }

    protected static function compress($contents, $ext)
    {
        switch ($ext) {

            case 'html':
                require_once __DIR__.'/minify/html.php';
                require_once __DIR__.'/minify/js.php';
                require_once __DIR__.'/minify/css.php';
                $contents = Minify_HTML::minify($contents, array('jsMinifier' => 'JSMin::minify', 'Minify_CSS_Compressor::process'));
                break;
            case 'js':
                require_once __DIR__.'/minify/js.php';
                $contents = JSMin::minify($contents);
                break;
            case 'css':
                require_once __DIR__.'/minify/css.php';
                $contents = Minify_CSS_Compressor::process($contents);
                break;
        }

        return $contents;
    }
}