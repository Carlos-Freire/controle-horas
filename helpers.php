<?php

function escape_echo($variable)
{
    echo strip_tags(htmlentities($variable));
}