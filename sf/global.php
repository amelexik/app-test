<?php
/**
 * @return mixed
 * Для удобного обращения к компонентам
 */
function request()
{
    return Sf::app()->Request;
}

function router()
{
    return Sf::app()->Router;
}

function identity()
{
    return Sf::app()->Identity;
}