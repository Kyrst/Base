<?php
include '../init.php';

if ( !$user ) {
	header('Location: /');
	exit;
}

//$skinner->addBreadcrumb($user['first_name'] . ' ' . $user['last_name'], '/user');
?>