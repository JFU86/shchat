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

include_once("system/config/config.inc.php");

$template = new Template();
$user = new User();

if( !$user->isChatAdmin($user->getUserName()) ){
	$template->getTemplate("overall_header");
	echo "<p align=\"center\">Zugriff verweigert!</p>";
	$template->getTemplate("overall_footer");
	exit;
}
else {	
	if( !$_REQUEST["noheader"] ){
		$template->getTemplate("overall_header");
		$template->getTemplate("admin/index");
	}	
	switch( $_REQUEST["action"] ){		
		default: $template->getTemplate("admin/channel-index"); break;
		case "channel": $template->getTemplate("admin/channel-index"); break;
		case "new_channel": $template->getTemplate("admin/channel-new"); break;
		case "edit_channel": $template->getTemplate("admin/channel-edit"); break;
		case "del_channel": $template->getTemplate("admin/channel-del"); break;
		case "user": $template->getTemplate("admin/user"); break;
		case "user_edit": $template->getTemplate("admin/user-edit"); break;
		case "chat": $template->getTemplate("admin/chat"); break;
		case "smileys": $template->getTemplate("admin/smileys"); break;
		case "update": $template->getTemplate("admin/update"); break;
	}	
	
	$template->getTemplate("admin/footer");
}

$template->getTemplate("overall_footer");
?>