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
$mail = new Mail();
$email_error = false;
$password_error = false;

if( $user->getUserStatus() == 1 ){
	
	// Änderungen speichern
	if( isset($_REQUEST["action"]) && $mail->validate($_REQUEST["email"]) ){		
		// Daten ändern
		$user->editUserDetail("email", $_REQUEST["email"]);
		$user->editUserDetail("gender", $_REQUEST["gender"]);
		$user->editUserDetail("name", $_REQUEST["myName"]);
		$user->editUserDetail("city", $_REQUEST["myCity"]);
		if( trim($_REQUEST["myBirthdate"]) != "" ) $user->editUserDetail("birthdate", date("Y-m-d", strtotime($_REQUEST["myBirthdate"])));
		if( $_REQUEST["myBirthdate"] == "" || substr(trim($_REQUEST["myBirthdate"]),0,1) == "-" ) $user->editUserDetail("birthdate", "@NULL");
		$user->editUserDetail("description", $_REQUEST["aboutMe"]);
			
		// Passwort ändern
		if( $user->clean($_REQUEST["pass0"]) != "" && $user->clean($_REQUEST["pass0"]) == $user->clean($_REQUEST["pass1"]) ){
			$query = $user->query("UPDATE {$db["user"]} SET userpass = '".  MD5($user->clean($_REQUEST["pass0"])) ."' WHERE id = '{$_SESSION["user_id"]}'");
		}
		elseif( $user->clean($_REQUEST["pass0"]) != "" && $user->clean($_REQUEST["pass0"]) != $user->clean($_REQUEST["pass1"]) ){
			$password_error = true;
		} 
	}
	elseif( isset($_REQUEST["action"]) && !$mail->validate($_REQUEST["email"]) ){
		$email_error = true;
	}
	$row = $user->getUserDetails($user->getUserName());
}
else {
	exit;
}


$vars = Array(
					"{username}"		=>	$_SESSION["username"],
					"{email}"			=>	$row["email"],
					"{email_color}"		=>	( !$email_error ) ? "" : "color:#FF0000;",
					"{pw_color}"		=>	( !$password_error ) ? "" : "color:#FF0000;",
					"{myName}"			=>	$row["name"],
					"{myCity}"			=>	$row["city"],
					"{myBirthdate}"		=>	( $row["birthdate"] != "") ? date("d.m.Y", strtotime($row["birthdate"])) : "",
					"{aboutMe}"			=>	$row["description"],
					"{m_checked}"		=>	( $row["gender"] == "m" ) ? "checked=\"checked\" " : "",
					"{f_checked}"		=>	( $row["gender"] == "f" ) ? "checked=\"checked\" " : "",

);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>