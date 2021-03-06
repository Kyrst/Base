<?php
define('ABS_PATH', __DIR__ . '/');

error_reporting(-1);

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if ( !(error_reporting() & $errno) ) {
        return;
    }
    
    die($errstr . ' in <strong>' . $errfile . '</strong> on line <strong>' . $errline . '</strong>');
});

session_start();

include ABS_PATH . 'includes/settings.php';

date_default_timezone_set(TIMEZONE);

include ABS_PATH . 'includes/db.php';
include ABS_PATH . 'includes/functions.php';
include ABS_PATH . 'includes/handlers/include.php';

$user = $user_handler->isLoggedIn();
?>