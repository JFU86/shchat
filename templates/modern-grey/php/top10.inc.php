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

$ausgabe1 = "";
$ausgabe2 = "";
$i = 1;

if( $user->getUserStatus() == 1 ){

	// Top10 - Chatzeit
	$result = $user->result("SELECT * FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id LEFT JOIN {$db["groups"]} g ON u.level=g.level WHERE u.`status` != '3' ORDER BY u.chat_time DESC LIMIT 10");
	
	while( $row = $user->fetchAssoc($result) ){
	
		if( $row["status"] == 0 ){
			$status = "<i>Offline</i>";
		}
		elseif( $row["status"] == 1 ){
			$status = "<b>Online</b>";
		}
		elseif( $row["status"] == 2 ){
			$status = "<span style=\"color:red;\"><i>Offline</i></span>";
		}
		
		$reg_date = date("d.m.Y",$row["reg_date"]);
		$mod = $i%2;
		$username = str_replace(" ","%20",$row["username"]);
		$ausgabe1 .= "<tr>
			<td class=\"whois-td{$mod}\"><a href=\"index.php?site=whois&amp;user={$username}\">{$row["username"]}</a></td>
			<td class=\"whois-td{$mod}\">{$reg_date}</td>
			<td class=\"whois-td{$mod}\">{$row["chat_time"]}</td>
			<td class=\"whois-td{$mod}\">{$row["rang"]}</td>
			<td class=\"whois-td{$mod}\">{$status}</td>
		</tr>" . "\r\n";
		$i++;
	}
	
	
	// Top10 - Geschriebene Zeichen
	$result = $user->result("SELECT * FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id LEFT JOIN {$db["groups"]} g ON u.level=g.level WHERE u.`status` != '3' ORDER BY u.charcount DESC LIMIT 10");
	
	while( $row = $user->fetchAssoc($result) ){
	
		if( $row["status"] == 0 ){
			$status = "<i>Offline</i>";
		}
		elseif( $row["status"] == 1 ){
			$status = "<b>Online</b>";
		}
		elseif( $row["status"] == 2 ){
			$status = "<span style=\"color:red;\"><i>Offline</i></span>";
		}
		
		$reg_date = date("d.m.Y",$row["reg_date"]);
		$mod = $i%2;
		$username = str_replace(" ","%20",$row["username"]);
		$ausgabe2 .= "<tr>
			<td class=\"whois-td{$mod}\"><a href=\"index.php?site=whois&amp;user={$username}\">{$row["username"]}</a></td>
			<td class=\"whois-td{$mod}\">{$reg_date}</td>
			<td class=\"whois-td{$mod}\">{$row["charcount"]}</td>
			<td class=\"whois-td{$mod}\">{$row["rang"]}</td>
			<td class=\"whois-td{$mod}\">{$status}</td>
		</tr>" . "\r\n";
		$i++;
	}
}
else{
	$ausgabe1 .= "<tr>
			<td class=\"whois-td0\" colspan=\"5\">{@Bitte melde dich im Chat an, um die Benutzerliste zu sehen.}</td>
		</tr>" . "\r\n";
	$ausgabe2 .= $ausgabe1;
}

$vars = Array(
				"{member_list1}"		=> $ausgabe1,
				"{member_list2}"		=> $ausgabe2,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>