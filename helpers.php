<?php

function escape_echo($variable)
{
    echo strip_tags(htmlentities($variable));
}

function check_logged_user()
{
    if (session_status() == PHP_SESSION_NONE)
        session_start();

    if (count($_SESSION) == 0)
        return false;

    if (isset($_SESSION["usu_id"]) && is_numeric($_SESSION["usu_id"]) && isset($_SESSION["usu_nome"]) && isset($_SESSION["usu_login"]))
        return true;
    else
        return false;
}

function get_base_url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        ''
    );
}