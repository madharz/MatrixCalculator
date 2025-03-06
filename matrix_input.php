<?php

session_start();

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $_SESSION['rows'] = (int) $_POST['rows'];
    $_SESSION['cols'] = (int) $_POST['cols'];
}

header('Location: index.php');

exit;
