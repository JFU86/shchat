<?php
/*
	SHChat
	(C) 2006-2018 by Scripthosting.net
	http://www.shchat.net
*/

$template = new Template();
$channel = new Channel();
$ausgabe = "";

$channel_list = $channel->getChannelList(1);
foreach( $channel_list as $key ){
	$ausgabe .= "<b>".$key."</b> - <span style='font-size:11px;'>{$channel->getOnlineUsers( $channel->getChannelId($key) )} Chatter Online</span><br />";
}
$user = ( $_GET["user"] != null ) ? $_GET["user"] : "";

$vars = Array(
					"{date}" => date("D, d M Y H:i:s O"),
					"{overall_title}" => $config["overall_title"],
					"{channel_list}" => $channel->getChannelListOutput(1),
					"{Channel}"			=> $ausgabe,
					"{GET.user}"		=> $user,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>