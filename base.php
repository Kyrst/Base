<?php
define('ABS_PATH', dirname(__FILE__) . '/');

error_reporting(-1);

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if ( !(error_reporting() & $errno) ) {
        return;
    }
    
    die($errstr . ' in <strong>' . $errfile . '</strong> on line <strong>' . $errline . '</strong>');
});

include ABS_PATH . 'includes/settings.php';

include ABS_PATH . 'includes/db.php';

session_start();

include ABS_PATH . 'includes/functions.php';

include ABS_PATH . 'includes/handlers/include.php';

$user = $user_handler->isLoggedIn();
?>