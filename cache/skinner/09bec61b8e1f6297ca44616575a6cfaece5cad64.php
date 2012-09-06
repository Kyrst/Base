<?php
$HAANGA_VERSION  = '1.0.4';
/* Generated from /Applications/XAMPP/xamppfiles/htdocs/Base/templates/index.html */
function haanga_09bec61b8e1f6297ca44616575a6cfaece5cad64($vars15047f98255098, $return=FALSE, $blocks=array())
{
    extract($vars15047f98255098);
    if ($return == TRUE) {
        ob_start();
    }
    $buffer1  = '
	<h1>Base</h1>
';
    $blocks['content']  = (isset($blocks['content']) ? (strpos($blocks['content'], '{{block.1b3231655cebb7a1f783eddf27d254ca}}') === FALSE ? $blocks['content'] : str_replace('{{block.1b3231655cebb7a1f783eddf27d254ca}}', $buffer1, $blocks['content'])) : $buffer1);
    echo Haanga::Load('base.html', $vars15047f98255098, TRUE, $blocks);
    if ($return == TRUE) {
        return ob_get_clean();
    }
}