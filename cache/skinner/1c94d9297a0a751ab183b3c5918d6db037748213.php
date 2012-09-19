<?php
$HAANGA_VERSION  = '1.0.4';
/* Generated from /Applications/XAMPP/xamppfiles/htdocs/Base/templates/base.html */
function haanga_1c94d9297a0a751ab183b3c5918d6db037748213($vars1505155d19d166, $return=FALSE, $blocks=array())
{
    extract($vars1505155d19d166);
    if ($return == TRUE) {
        ob_start();
    }
    echo '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>'.htmlspecialchars($page_title).'</title>
        <link href="/styles/normalize.css" rel="stylesheet">
        <link href="/styles/reset.css" rel="stylesheet">
        <link href="/styles/base.css" rel="stylesheet">
        ';
    foreach ($css_files as  $css_file) {
        echo '
            <link href="'.htmlspecialchars($css_file).'" rel="stylesheet">
        ';
    }
    echo '
    </head>
    <body>
        <div id="container">
            ';
    $buffer1  = '';
    echo (isset($blocks['content']) ? (strpos($blocks['content'], '{{block.1b3231655cebb7a1f783eddf27d254ca}}') === FALSE ? $blocks['content'] : str_replace('{{block.1b3231655cebb7a1f783eddf27d254ca}}', $buffer1, $blocks['content'])) : $buffer1).'
        </div>
        <div id="overlay" class="overlay">
            <span class="overlay-title"></span>
            <div class="overlay-message"></div>
            <div class="clear"></div>
            <a href="javascript:" class="close"><img src="/images/close.png" width="29" height="29" alt=""></a>
            <div class="clear"></div>
        </div>
        <script src="/scripts/js/jquery.js"></script>
        <script src="/scripts/js/jquery.tools.js"></script>
        <script src="/scripts/js/base.js"></script>
        ';
    if (empty($overlay) === FALSE) {
        echo '
            <script>
                $(document).ready(function() {
                    showOverlay(\''.htmlspecialchars($overlay['title']).'\', \''.htmlspecialchars($overlay['message']).'\');
                });
            </script>
        ';
    }
    echo '
        ';
    foreach ($js_files as  $js_file) {
        echo '
            <script src="'.htmlspecialchars($js_file).'"></script>
        ';
    }
    echo '
        ';
    $buffer1  = '';
    echo (isset($blocks['bottom']) ? (strpos($blocks['bottom'], '{{block.1b3231655cebb7a1f783eddf27d254ca}}') === FALSE ? $blocks['bottom'] : str_replace('{{block.1b3231655cebb7a1f783eddf27d254ca}}', $buffer1, $blocks['bottom'])) : $buffer1).'
    </body>
</html>';
    if ($return == TRUE) {
        return ob_get_clean();
    }
}