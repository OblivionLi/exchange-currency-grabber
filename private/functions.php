<?php

function url_for($string_path)
{
    if ($string_path[0] != '/') {
        $string_path = "/" . $string_path;
    }

    return WWW_ROOT . $string_path;
}

function redirect_to($location)
{
    header("Location: " . $location);
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] === "POST";
}

function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] === "GET";
}
