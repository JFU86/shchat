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
$channel_list = "";

if( isset($_POST["delc"]) && $_POST["delc"] != "0" ){
	$channel_id = (int) $user->clean($_REQUEST["delc"]);
	$query = $user->query("DELETE FROM {$db["channel"]} WHERE id = {$channel_id}");
	header("Location: ?action=channel");
	exit;
}
elseif( isset($_POST["delc"]) && $_POST["delc"] == "0" ){
	header("Location: ?action=del_channel");
	exit;
}
else{
	$result = $user->result("SELECT * FROM {$db["channel"]} ORDER BY channel");
	while( $row = $user->fetchAssoc($result) ){
		$channel_list .= "<option value=\"{$row["id"]}\">{$row["channel"]}</option>";
	}
}


$vars = Array(
			"{output}" => ($output != "" ) ? $output . "<br /><br />" : "",
			"{channel_list}" => $channel_list,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__,"admin"), $vars );

?>