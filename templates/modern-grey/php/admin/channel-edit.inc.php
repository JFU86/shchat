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
$channel_id = (int) $user->clean($_REQUEST["ChannelID"]);

// Channel updaten
if( isset($_REQUEST["update"]) ){		
	$userlimit = (int) $user->clean($_POST["userlimit"]);
	$moderated = (int) $user->clean($_POST["moderiert"]);
	$minlevel = (int) $user->clean($_POST["minlevel"]);
	$hidden = (int) $user->clean($_POST["versteckt"]);
	$welcome = $user->clean($_POST["welcome"],false,true);
	
	$query = $user->query("UPDATE {$db["channel"]} SET userlimit = {$userlimit}, moderated = {$moderated}, minlevel = {$minlevel}, hidden = {$hidden}, welcome = '{$welcome}' WHERE id = {$channel_id}");
	header("Location: ?action=channel");
	exit;
}

$result = $user->result("SELECT * FROM {$db["channel"]} WHERE id = '{$channel_id}'");
$chan = $user->fetchAssoc($result);

$result = $user->result("SELECT * FROM {$db["groups"]} WHERE art = 'global'");
while( $row = $user->fetchAssoc($result) ){
	$groups .= "<option value=\"{$row["level"]}\"";

	if( $row["level"] == $chan["minlevel"] )
		$groups .= " selected=\"selected\"";

	if( $row["level"]!=1 )
		$groups .= " onclick=\"javascript:document.form.versteckt.disabled=false\"";
	else
		$groups .= " onclick=\"javascript:document.form.versteckt.disabled=true\"";

	$groups .= ">". $row["rang"] ."</option>";
}

$vars = Array(
					"{channel_id}" => $channel_id,
					"{output}" => ( $output != "" ) ? $output . "<br /><br />" : "",
					"{channel}" => $chan["channel"],
					"{userlimit}" => $chan["userlimit"],
					"{unmoderated}" => ( $chan["moderated"] ) ? "" : " selected=\"selected\"",
					"{moderated}" => ( $chan["moderated"] ) ? " selected=\"selected\"" : "",
					"{unhidden}" => ( $chan["hidden"] ) ? "" : " selected=\"selected\"",
					"{hidden}" => ( $chan["hidden"] ) ? " selected=\"selected\"" : "",
					"{welcome}" => $chan["welcome"],
					"{ranks}" => $groups,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__,"admin"), $vars );
?>