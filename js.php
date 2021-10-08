<?php
/*
	SHChat
	(C) by Scripthosting.net
	http://www.shchat.net

	Free for non-commercial use:
	Licensed under the "Creative Commons 3.0 BY-NC-SA"
	http://creativecommons.org/licenses/by-nc-sa/3.0/
	
	Support-Forum: http://board.scripthosting.net/viewforum.php?f=18
	Don't send emails asking for support!!
*/

// Einbinden der Konfigurationsdatei
if (file_exists("system/config/config.inc.php")) {	
	include_once("system/config/config.inc.php");
}
elseif (file_exists("system/config/config.min.inc.php")) {
	include_once("system/config/config.min.inc.php");
}
else exit;

// Die Ausgabe wird auf Javascript UTF-8 festgelegt
header('Content-type: text/javascript; charset=UTF-8');

// Variablen deklarieren
$f = trim($_REQUEST["f"]);
$yui = false;
$user = new User();

// Template laden
$tpl = new Template();
$file1 = realpath($config["basepath"] . "/templates/{$config["template_name"]}/js/{$f}.yui.js");
$file2 = realpath($config["basepath"] . "/templates/{$config["template_name"]}/js/{$f}.js");

// Externe-Variablen für Javascript bereitstellen
$vars = array();


// Laden der JavaScript Datei
// Falls eine YUI Komprimierte Datei vorhanden ist, dann wähle diese
if (file_exists($file1) && !$config["debug"]) {
	$yui = true;
	$output = $tpl->output($file1, $vars);
}
// Sonst versuche die Standarddatei zu laden
elseif (file_exists($file2)) {
	$yui = false;
	$output = $tpl->output($file2, $vars);
}
// Wenn die Datei nicht existiert dann gibt es eine leere Rückgabe
else exit;

// Ausgeben der JavaScript-Datei
echo trim($output);

?>