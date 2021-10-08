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

// Load configuration
if (!file_exists("system/config/config.inc.php") && file_exists("install.php")) {
	header("Location: install.php");
	exit;
} elseif (!file_exists("system/config/config.inc.php") && !file_exists("install.php")) {
	echo "No configuration file found. Please upload all files again.";
	exit;
} else{
	include_once("system/config/config.inc.php");
}

// Login-Check
if (isset($_POST["submitLogin"])) {
	$user = new User();
	$user->login($_POST["name"], $_POST["securepass"], $_POST["startchannel"]);
}
// Logout
elseif (isset($_REQUEST["logout"])) {
	$user = new User();
	$chatinput = new Chatinput();
	
	if ($user->getUserId() != 0) {
		$oldchannel = $chatinput->getChannelName();
		$chatinput->removeUser($user->getUserName());
		$chatinput->addSystemMsg(sprintf($language->translate("<i><b>%s</b> verlässt den Chat!</i>"), $user->getUserName()), $oldchannel);
		$user->logout();
	}
	
	// Session vernichten
	session_destroy();
	unset($_SESSION);
	
	header("Location: ./");
	exit;
}
// Show Template
else{	
	$site = mb_strtolower(trim($_REQUEST["site"]));
	$template = new Template();
	if (!$_REQUEST["noheader"]) {
		$template->getTemplate("overall_header");
	}
	switch ($site) {
		default: $template->getTemplate("index"); break;
		case "index": $template->getTemplate("index"); break;
		case "help": $template->getTemplate("help"); break;
		case "userlist": $template->getTemplate("userlist"); break;
		case "top10": $template->getTemplate("top10"); break;
		case "whois": $template->getTemplate("whois"); break;
		case "profil": $template->getTemplate("profil"); break;
		case "whoisonline": $template->getTemplate("whoisonline"); break;
		case "register": $template->getTemplate("register"); break;
		case "terms": $template->getTemplate("terms"); break;
		case "validate": $template->getTemplate("validate"); break;
		case "reminder": $template->getTemplate("reminder"); break;
	}	
	$template->getTemplate("overall_footer");
}
?>