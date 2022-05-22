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
    header("Location: http://localhost:8000/{$path}");
}
