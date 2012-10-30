<?php
if ( !isset($_GET['f']) ) {
	exit;
}

include '../base.php';

$out = '';

foreach ( $_GET['f'] as $file ) {
	if ( !file_exists($path = ABS_PATH . $file) ) {
		continue;
	}
	
	$content = file_get_contents($path);
	
	$out .= minify_css($content);
}

header('Content-Type: text/css');
echo $out;
?>