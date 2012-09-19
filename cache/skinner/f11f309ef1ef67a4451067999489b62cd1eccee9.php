<?php
$HAANGA_VERSION  = '1.0.4';
/* Generated from /Applications/XAMPP/xamppfiles/htdocs/Base/templates/test.html */
function haanga_f11f309ef1ef67a4451067999489b62cd1eccee9($vars1505a20f3d045a, $return=FALSE, $blocks=array())
{
    extract($vars1505a20f3d045a);
    if ($return == TRUE) {
        ob_start();
    }
    $buffer1  = '
	<h1>Test</h1>
	<img src="/scripts/view_test_image.php" alt="">
';
    $blocks['content']  = (isset($blocks['content']) ? (strpos($blocks['content'], '{{block.1b3231655cebb7a1f783eddf27d254ca}}') === FALSE ? $blocks['content'] : str_replace('{{block.1b3231655cebb7a1f783eddf27d254ca}}', $buffer1, $blocks['content'])) : $buffer1);
    echo Haanga::Load('base.html', $vars1505a20f3d045a, TRUE, $blocks);
    if ($return == TRUE) {
        return ob_get_clean();
    }
}