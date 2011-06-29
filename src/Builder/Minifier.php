<?php

class Minifier
{
    public static function minify($filename)
    {
        list($ext, $contents) = self::getMetadata($filename);
        return self::compress($contents, $ext);
    }

    protected static function getMetadata($filename)
    {
        $ext = substr(strrchr($filename, '.'), 1);

        $contents = file_get_contents($filename) or die();

        return array($ext, $contents);
    }

    protected static function compress($contents, $ext)
    {
        switch ($ext) {

            case 'html':
                $contents = Minify_HTML::minify($contents, array('jsMinifier' => 'JSMin::minify', 'Minify_CSS_Compressor::process'));
                break;
            case 'js':
                $contents = JSMin::minify($contents);
                break;
            case 'css':
                $contents = Minify_CSS_Compressor::process($contents);
                break;
        }

        return $contents;
    }
}