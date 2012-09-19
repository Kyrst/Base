<?php
$start_time = microtime(true);

include 'base.php';

include ABS_PATH . 'includes/skinner.php';

// Autoload
$basename = substr(implode('.', explode('.', $_SERVER['PHP_SELF'], -1)), 1);

// Javascript
$js_autoloaded_files = array();

$js_filename = $basename . '.js';

if ( file_exists(ABS_PATH . JS_DIR . $js_filename) ) {
    $js_autoloaded_files[] = '/' . JS_DIR . $js_filename;
}

// Stylesheet
$css_autoloaded_files = array();

$css_filename = $basename . '.css';

if ( file_exists(ABS_PATH . CSS_DIR . $css_filename) ) {
    $css_autoloaded_files[] = '/' . CSS_DIR . $css_filename;
}

$skinner = new Skinner($js_autoloaded_files, $css_autoloaded_files);

if ( filter_input(INPUT_POST, 'log_in') ) {
	if ( $user_handler->login($_POST['username'], $_POST['password']) ) {
		header('Location: /');
	} else {
		/*'$skinner->showOverlay(
			'LOGIN_FAILED_TITLE',
			'LOGIN_FAILED_DESCRIPTION'
		);*/
		
		header('Location: /');
	}
	
	exit;
}

if ( !ob_start('ob_gzhandler') ) {
    ob_start();
}

$skinner->assign('user', $user);

//$skinner->addBreadcrumb('PROJECT_NAME', '/');

/*register_shutdown_function(function() {
    global $start_time;
    
    echo '<hr>Executed in ', number_format(microtime(true) - $start_time, 6), ' sec';
});*/
?>