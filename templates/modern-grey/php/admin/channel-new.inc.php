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

$output = "";
$groups = "";

// Gruppen holen
$result = $user->result("SELECT * FROM {$db["groups"]} WHERE `art` = 'global'");

while( $row = $user->fetchAssoc($result) ){
	
	$groups .= "<option value=\"". $row["level"] ."\"";

	if( $row["level"] !=1 )
		$groups .= " onclick=\"javascript:document.form.versteckt.disabled=false\"";
	else
		$groups .= " onclick=\"javascript:document.form.versteckt.disabled=true\"";

	$groups .= ">". $row["rang"] ."</option>";
}

if( isset($_POST["name"]) ) {
	$new_channel = $user->clean($_POST["name"],false,true);
	$userlimit = (int) $_POST["userlimit"];
	$moderiert = (int) $_POST["moderiert"];
	$minlevel = (int) $_POST["minlevel"];
	$versteckt = (int) $_POST["versteckt"];
	$welcome = $user->clean($_POST["welcome"],false,true);

	$query = $user->query("INSERT INTO {$db["channel"]} (channel,userlimit,moderated,minlevel,hidden,welcome) VALUES ('{$new_channel}',{$userlimit},{$moderiert},{$minlevel},{$versteckt},'{$welcome}')");
	header("Location: ?action=channel");
	exit;
}

$vars = Array(
					"{ranks}" => $groups,
					"{output}" => $output,

);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__,"admin"), $vars );

?>