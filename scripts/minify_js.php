<?php
if ( !isset($_GET['f']) ) {
	exit;
}

include '../base.php';
include ABS_PATH . 'libs/jsmin/jsmin.php';

$out = '';

foreach ( $_GET['f'] as $file ) {
	if ( !file_exists($path = ABS_PATH . $file) ) {
		continue;
	}
	
	$content = file_get_contents($path);
	
	$out .= JSMin::minify($content);
}

header('Content-Type: application/javascript');
echo trim($out);
?>