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

// Channel-Liste holen
$output = "";
$i=1;
$result = $user->result("SELECT * FROM {$db["channel"]} c LEFT JOIN {$db["groups"]} g ON c.minlevel=g.level ORDER BY c.channel");

while( $row = $user->fetchAssoc($result) )
{
	$row["moderated"] = ( $row["moderated"] ) ? "ja" : "nein";
	$row["hidden"] = ( $row["hidden"] ) ? "ja" : "nein";
	$mod = $i%2;

	$output .= "<tr>";
	$output .= "<td class=\"admin_td{$mod}\"><a href=\"?action=edit_channel&amp;ChannelID=". $row["id"] ."\">". $row["channel"] ."</a></td>";
	$output .= "<td class=\"admin_td{$mod}\">". $row["userlimit"] ."</td>";
	$output .= "<td class=\"admin_td{$mod}\">". $row["rang"] ."</td>";
	$output .= "<td class=\"admin_td{$mod}\">". $row["moderated"] ."</td>";
	$output .= "<td class=\"admin_td{$mod}\">". $row["hidden"] ."</td>";
	$output .= "</tr>";
	$i++;			
}

$vars = Array(
				"{channel_list}" => $output,

);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__,"admin"), $vars );

?>