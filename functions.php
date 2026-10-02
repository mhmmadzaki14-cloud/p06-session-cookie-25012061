<?php

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function setFlash($message)
{
    $_SESSION['flash'] = $message;
}

function pullFlash()
{
    $message = isset($_SESSION['flash']) ? $_SESSION['flash'] : null;

    unset($_SESSION['flash']);

    return is_string($message) ? $message : null;
}

function cartCount($cart)
{
    return array_sum(array_map('intval', $cart));
}