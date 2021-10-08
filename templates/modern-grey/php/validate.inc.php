<?php
/*
	SHChat
	(C) 2006-2014 by Scripthosting.net
	http://www.shchat.net

	Free for non-commercial use:
	Licensed under the "Creative Commons 3.0 BY-NC-SA"
	http://creativecommons.org/licenses/by-nc-sa/3.0/
	
	Support-Forum: http://board.scripthosting.net/viewforum.php?f=18
	Don't send emails asking for support!!
*/

$template = new Template();
$user = new User();

$status = "";
$fehler = true;
$username = $user->clean($_REQUEST["name"]);
$key = $user->clean($_REQUEST["key"]);

$result = $user->result("SELECT `key` FROM {$db["user"]} WHERE username = '{$username}' AND `key` = '{$key}' AND status = 3");
while( $row = $user->fetchAssoc($result) ){	
	$query = $user->query("UPDATE {$db["user"]} SET status = 0 WHERE username = '{$username}' AND status = 3");
	$status = "Aktivierung erfolgreich abgeschlossen!";
	$fehler = false;
	break;
}

if( $fehler ){
	$status = "Das Benutzerkonto wurde bereits aktiviert oder ist nicht vorhanden.";
}


$vars = Array(
					"{status}" => $status,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>