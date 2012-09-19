<?php
include '../init.php';

if ( !$user_handler->isAdmin() ) {
	header('Location: /');
	exit;
}

//$skinner->addBreadcrumb('Administrator', '/admin');
?>