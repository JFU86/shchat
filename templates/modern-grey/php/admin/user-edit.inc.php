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
$format = new Format();
$mail = new Mail();

// Änderungen speichern
if( $_REQUEST["mode"] == "save" &&  $_REQUEST["id"] != "" && $mail->validate($_REQUEST["email"]) == true ){
	$query = $user->query("UPDATE `{$db["userdetails"]}` SET email = '{$user->clean($_REQUEST["email"])}' WHERE id = '{$_REQUEST["id"]}'");
	
	if( $user->clean($_REQUEST["pass"]) != "" ){
		$query = $user->query("UPDATE `{$db["user"]}` SET `userpass` = MD5('{$_REQUEST["pass"]}') WHERE `id` = '{$_REQUEST["id"]}'");
	}
	header("Location: ?action=user");
	exit;
}
elseif( $_REQUEST["mode"] == "save" &&  $_REQUEST["id"] != "" && $_REQUEST["email"] != "" && $mail->validate($_REQUEST["email"]) == false ){
	$output = "{@E-Mail Adresse ungültig!}";
}
elseif( $_REQUEST["mode"] == "save" && $_REQUEST["id"] != "" && $_REQUEST["email"] == "" ){
	$output = "{@Bitte alle * Felder ausfüllen!}";
}
// Ende Änderungen speichern


// Benutzer löschen
if( $_REQUEST["mode"] == "delete" && $_REQUEST["id"] != "" ){
	if( $user->delete($_REQUEST["id"]) ){
		echo "<script type=\"text/javascript\"> setTimeout(\"window.open('?action=user','_self');\",0); </script>";
		exit;
	}
}
// Ende Benutzer löschen


// Benutzerdaten holen
$row = $user->getData($_REQUEST["id"]);
$user_id = $row["id"];
$reg_date = date("d.m.Y H:i:s",$row["reg_date"]);
$username = $row["username"];
$email = $row["email"];
$rang = $row["rang"];
$client = $row["client"];
$ipaddress = $row["ipadress"];
$hostname = $row["hostname"];
$charcount = $row["charcount"];
$chat_time = $format->getTime($row["chat_time"]);
$last_login = ( $row["last_login"] != 0 ) ? date("d.m.Y H:i:s",$row["last_login"]) : "nie";
$gender = ( $row["gender"] != "f" ) ? "male.gif" : "female.gif" ;

if( $row["status"] == 0 ){
	$status = "<i>Offline</i>";
}
elseif( $row["status"] == 1 ){
	$status = "<b>Online</b>";
}
elseif( $row["status"] == 2 ){
	$status = "<span style=\"color:#FF0000;\"><i>Offline</i></span>";
}
elseif( $row["status"] == 3 ){
		$status = "<span style=\"color:#FF0000; font-size:11px;\">{@Dieses Konto wurde vom Benutzer nicht aktiviert!}</span>";
}
// Ende Benutzerdaten holen


$vars = Array(
					"{user_id}" => $user_id,
					"{username}" => $username,
					"{rang}" => $rang,
					"{email}" => $email,
					"{reg_date}" => $reg_date,
					"{client}" => $client,
					"{ipaddress}" => $ipaddress,
					"{hostname}" => $hostname,
					"{status}" => $status,
					"{charcount}" => $charcount,
					"{chat_time}" => $chat_time,
					"{last_login}" => $last_login,
					"{gender}" => $gender,
					"{output}" => $output,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__,"admin"), $vars );

?>