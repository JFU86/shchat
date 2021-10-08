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

if( isset($_POST["register"]) ){	

	$user = new User();
	$minLength = 6;
	$maxLength = 16;
	
	// Das Passwort darf nicht leer sein
	if( !isset($_POST["securepass"]) || trim($_POST["securepass"]) == "" ){
		$error = $language->translate("Dein Passwort darf nicht leer sein!");
	}
	// Die Passwörter müssen identisch sein
	elseif( $_POST["securepass"] != $_POST["resecurepass"] ){
		$error = $language->translate("Die Passwörter sind nicht identisch!");
	}
	elseif( mb_strlen($_POST["securepass"]) < $minLength ){
		$error = $language->translate("Das Passwort muss mindestens {$minLength} Zeichen haben!");
	}
	elseif( mb_strlen($_POST["securepass"]) > $maxLength ){
		$error = $language->translate("Das Passwort darf maximal {$maxLength} Zeichen haben!");
	}
	else{
		if( ($user_id = $user->register($_POST["name"], $_POST["securepass"], $_POST["email"], $_POST["code"], $_POST["gender"], $error)) > 0 ){
			$userData = $user->getUserByID($user_id);
			echo "<script>document.location.href='index.php?user={$userData["username"]}';</script>";
			exit;
		}
		else {
			$error = $language->translate("Bitte fülle alle Felder aus!");
		}
	}
}

$vars = Array(
			"{POST.name}"		=>	$_POST["name"],
			"{POST.email}"		=>	$_POST["email"],
			"{f_checked}"		=>	( $_POST["gender"] == "f" )	?	"checked=\"checked\" "	:	"",
			"{m_checked}"		=>	( $_POST["gender"] == "m" )	?	"checked=\"checked\" "	:	"",
			"{overall_title}"	=>	$config["overall_title"],
			"{error}"			=>	( $error != "" ) ? "<tr><td colspan='2' class='whois-td1' style='background-color:#FFFFFF;color:#FF0000;'><img src='templates/{templateName}/img/s_error.png' alt='error' /> {$error}</td></tr>" : "",
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>