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
$channel = new Channel();


//////////////////////
// Chat Online List //
//////////////////////
if( $user->getUserStatus() == 1 && $user->getUserLevel() >= $channel->getMinLevel() ){
	$user->updateOnlineStatus();
	$online = $channel->getOnlineUserList($channel->getChannelName());
}
else{
	$online = "";
}


//////////////////
// Channel List //
//////////////////
$channel_list = "";
$user_level = $user->getUserLevel();

if( $user->getUserStatus() == 1 && $channel->getMinLevel() <= $user_level ){

	$liste = $channel->getChannelList( $user_level );

	foreach($liste as $key => $value){
		$channel_list .= " | <b><a href=\"javascript:join('". $value ."');\">". $value . "</a></b>" . "\r\n";
	}
}


//////////////////
// Welcome Text //
//////////////////
if( date("H")<="11" ){
	$welcome = "{@Guten Morgen}";
}
elseif( date("H")<="16" ){
	$welcome = "{@Guten Tag}";
}
else {
	$welcome = "{@Guten Abend}";
}


///////////////
// Chat Post //
///////////////
$admin_panel = "";
$autoscroll_checked = "";

// Admin-Panel visible?
if( $user->getUserLevel() == 999 ){
	$admin_panel = '<span style="margin-right:20px;"><a href="javascript:admin();">{@Administration}</a></span>';
}
// Autoscroll enabled?
if( $user->getUserAutoScroll() ){
	$autoscroll_checked = 'checked="checked" ';
}


$vars = Array(
			"{online}"				=>	$online,
			"{channel_list}"		=>	$channel_list,
			"{welcome}"				=>	$welcome,
			"{channel_welcome}"		=>	$channel->getWelcome(),
			"{username}"			=>	$user->getUserName(),
			"{curtime}"				=>	date("H:i"),
			"{smileys}"				=>	$channel->getSmileys(),
			"{admin_panel}"			=>	$admin_panel,
			"{autoscroll_checked}"	=>	$autoscroll_checked,
			"{colors}"				=>	$channel->getChatColors($user->getUserColor()),
			"{smileys25}"			=>	$channel->getSmileys(25),
			"{username}"			=>	$user->getUserName(),
			"{channel}"				=>	$user->getUserChannelOnline($user->getUserName()),
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>