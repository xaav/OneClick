<?php
function fatal()
{
 $last_error = error_get_last();
    if($last_error['type'] === E_ERROR || $last_error['type'] === E_USER_ERROR || $last_error['type'] === E_WARNING)
    {
        build_fail('A fatal error occurred while building');
    }
}

function get_path($path)
{
	$path = realpath($path);
	$path = str_replace('\\','/', $path);

    return $path;
}

function build_fail($reason)
{
    writeln($reason);
    writeln('Build failed.');
    die();
}

function writeln($message)
{
    echo "> ".$message."\n";
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

    $filename = __DIR__.'/../../web/'.$matches[1];

    return Minifier::minify($filename);
}

function replace_require($matches)
{

    $filename = __DIR__.'/../../web/'.$matches[1];

    return " ?>".Minifier::minify($filename)."<?php ";
}

function replace_config($matches)
{
    return "\"".get_config($matches[1])."\"";
}

function get_config($value)
{
    $config = parse_ini_file(__DIR__.'/../../config/config.ini');
    return $config[$value];
}