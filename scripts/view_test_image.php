<?php
include '../base.php';

include ABS_PATH . 'includes/imager.php';
$imager = new Imager(
	ABS_PATH . 'cache/images/',
	ABS_PATH . 'images/no_image.png'
);

$imager->display(
	ABS_PATH . 'images/close.png',
	1
);
?>