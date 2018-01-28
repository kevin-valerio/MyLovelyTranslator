<?php

define("WEBSITE_URL", "http://projetphpg3.alwaysdata.net");

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function replace($file, $what, $toWhat)
{
    $file_contents = file_get_contents($file);
    $file_contents = str_replace($what, $toWhat, $file_contents);
    file_put_contents($file, $file_contents);
}

function redirect($url)
{
    header('Location: ' . $url);
}

function refresh()
{
    /*Source : stackoverflow.com @Dimitry */
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function getIPAdress()
{
    return $_SERVER['REMOTE_ADDR'];
}

function getTime()
{
    return time();

}

function getFullURL()
{
    /* Source : http://hayageek.com/php-get-current-url/ */
    $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    $currentURL .= $_SERVER["SERVER_NAME"];

    if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
        $currentURL .= ":" . $_SERVER["SERVER_PORT"];
    }

    $currentURL .= $_SERVER["REQUEST_URI"];
    return $currentURL;

}

function createCookie($name, $content, $time = 3600)
{
    setcookie($name, $content, time() + $time);
}

function starts_with_upper($str)
{
    $chr = mb_substr($str, 0, 1, "UTF-8");
    return mb_strtolower($chr, "UTF-8") != $chr;
}