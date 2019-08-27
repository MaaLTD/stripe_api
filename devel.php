<?php declare(strict_types=1);

error_reporting(E_ALL);
ini_set('short_open_tag', 'On');
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

function dd($item)
{
    exit('<pre>'.var_dump($item).'</pre>');
}
