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
$dbCon = new Mysql();

// Chatlog löschen
if( $_REQUEST["mode"] == "chatlog" ){
	$time = strtotime("today");
	$query = $dbCon->query("DELETE FROM {$db["postings"]} WHERE time < '{$time}'");
	$msg = "Chatlog gelöscht!";
}
// Ende Chatlog löschen


// Unbestätigte Benutzer löschen
if( $_REQUEST["mode"] == "unconfirmed" ){

	$time = strtotime("-7 days");
	$result = $dbCon->result("SELECT u.id,u.username FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON (u.id=d.id) WHERE u.reg_date <= '{$time}' AND u.status = 3 AND u.level < 999");
	
	while( $row = $dbCon->fetchAssoc($result) ){	
		$query = $dbCon->query("DELETE FROM {$db["userdetails"]} WHERE id = '{$row["id"]}'");
		$query = $dbCon->query("DELETE FROM {$db["postings"]} WHERE username = '{$row["username"]}'");
		$query = $dbCon->query("DELETE FROM {$db["online"]} WHERE username = '{$row["username"]}'");
		$query = $dbCon->query("DELETE FROM {$db["user"]} WHERE id = '{$row["id"]}'");
	}	
	$msg = "Unbestätigte Benutzer gelöscht!";
}
// Ende Unbestätigte Benutzer löschen


// Inaktive Benutzer löschen
if( $_REQUEST["mode"] == "inaktiv" ){

	$time = strtotime("-60 days");
	$result = $dbCon->result("SELECT u.id,u.username FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id WHERE u.last_login < '{$time}' AND u.level < '999'");
	
	while( $row = $dbCon->fetchAssoc($result) ){		
		$query = $dbCon->query("DELETE FROM {$db["userdetails"]} WHERE id = '{$row["id"]}'");
		$query = $dbCon->query("DELETE FROM {$db["postings"]} WHERE username = '{$row["username"]}'");
		$query = $dbCon->query("DELETE FROM {$db["online"]} WHERE username = '{$row["username"]}'");
		$query = $dbCon->query("DELETE FROM {$db["user"]} WHERE id = '{$row["id"]}'");
	}	
	$msg = "Inaktive Benutzer gelöscht!";
}
// Ende Inaktive Benutzer löschen


$vars = Array(
		"{msg}"		=>	($msg != "") ? $msg . "<br /><br />" : "",
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__,"admin"), $vars );

?>