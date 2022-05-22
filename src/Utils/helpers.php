<?php

function dd($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}

function redirect(string $path)
{
    header("Location: http://localhost/back-end-challenge/{$path}");
}
