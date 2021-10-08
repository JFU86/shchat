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
$mail = new Mail();
$user = new User();
$captcha = new Captcha();
(String) $error = "";

// Neues Passwort generieren
if( $_REQUEST["mode"] == "check" && $_REQUEST["username"] != "" && $_REQUEST["email"] != "" && $_REQUEST["code"] == $_SESSION["captcha_spam"] ){

	$email = $user->clean($_REQUEST["email"]);
	$username = $user->clean($_REQUEST["username"]);
	
	$result = $user->result("SELECT u.username,u.id FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id WHERE u.username = '{$username}' AND d.email = '{$email}'");
	if( $user->numRows($result) == 1 ){
		
		$randomString = $captcha->randomString(8);
		$row = $user->fetchAssoc($result);
		$query = $user->query("UPDATE `{$db["user"]}` SET userpass = '". MD5($randomString) ."' WHERE id = {$row["id"]}");
		
		// Text einbinden
		$text = file_get_contents($config["lang_path"] . "/reminder.txt");

		// Text-Variablen
		$reg_vars = array();
		$reg_vars["{username}"] = $row["username"];
		$reg_vars["{password}"] = $randomString;
		$reg_vars["{url}"] = $config["scriptpath"];
		
		foreach($reg_vars as $key => $value){
			$text = str_replace($key,$value,$text);
		}		
		
		// E-Mail versenden
		$mail->sendMail($config["admin_email"],$email,"Benutzerdaten",$text);
		$output = $language->translate("Es wurde eine E-Mail mit dem neuen Passwort gesendet!");
	}	
	elseif( $_REQUEST["code"] == $_SESSION["captcha_spam"] ){
		$error = $language->translate("Die Kombination aus Benutzername und E-Mail wurde nicht gefunden!");
	}
}
elseif( $_REQUEST["mode"] == "check" && $_REQUEST["username"] != "" && $_REQUEST["email"] != "" && $_REQUEST["code"] != $_SESSION["captcha_spam"] ){
	$error = $language->translate("Der Sicherheitscode ist falsch!");
}
elseif( $_REQUEST["mode"] == "check" && ($_REQUEST["username"] == "" || $_REQUEST["email"] == "") ){
	$error = $language->translate("Bitte fülle alle Felder aus!");
}
// Ende Neues Passwort generieren

$vars = Array(
			"{error}"	=>	( $error != "" ) ? "<tr><td colspan='2' class='whois-td1' style='background-color:#FFFFFF;color:#FF0000;'><img src='templates/{templateName}/img/s_error.png' alt='error' /> {$error}</td></tr>" : "",
			"{output}"	=>	( $output != "" ) ? "<tr><td colspan='2' class='whois-td1' style='background-color:#FFFFFF;color:#008000;'><img src='templates/{templateName}/img/b_tipp.png' alt='error' /> {$output}</td></tr>" : "",
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>