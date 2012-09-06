<?php
include 'base.php';

if ( $user ) {
	$user_handler->logout();
}

header('Location: /');
exit;
?>