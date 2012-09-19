<?php
$HAANGA_VERSION  = '1.0.4';
/* Generated from /Applications/XAMPP/xamppfiles/htdocs/Base/templates/setup.html */
function haanga_a818d7224f73dd51aa7cfb155ca32aa6b4d83e9f($vars15051574e9fe08, $return=FALSE, $blocks=array())
{
    extract($vars15051574e9fe08);
    if ($return == TRUE) {
        ob_start();
    }
    $buffer1  = '
	<h1>Setup</h1>
	<form class="form-horizontal">
		<fieldset>
			<legend>General</legend>
			<div class="form-row">
				<label for="project_name">Project name:</label>
				<input type="text" name="project_name" id="project_name" class="form-text">
			</div>
		</fieldset>
		<fieldset>
			<legend>Database</legend>
			<div class="form-row">
				<label for="hostname">Hostname:</label>
				<input type="text" name="hostname" id="hostname" class="form-text">
			</div>
			<div class="form-row">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" class="form-text">
			</div>
			<div class="form-row">
				<label for="password">Password:</label>
				<input type="text" name="password" id="password" class="form-text">
			</div>
			<div class="form-row">
				<label for="database">Database:</label>
				<input type="text" name="database" id="database" class="form-text">
			</div>
			<div class="form-row buttons">
				<input type="submit" name="install" value="Install" class="button">
			</div>
		</fieldset>
	</form>
';
    $blocks['content']  = (isset($blocks['content']) ? (strpos($blocks['content'], '{{block.1b3231655cebb7a1f783eddf27d254ca}}') === FALSE ? $blocks['content'] : str_replace('{{block.1b3231655cebb7a1f783eddf27d254ca}}', $buffer1, $blocks['content'])) : $buffer1);
    echo Haanga::Load('base.html', $vars15051574e9fe08, TRUE, $blocks);
    if ($return == TRUE) {
        return ob_get_clean();
    }
}