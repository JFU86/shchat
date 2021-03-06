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

$ausgabe = "";
$i = 1;

if( $user->getUserStatus() == 1 ){

	$result = $user->result("SELECT * FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id LEFT JOIN {$db["groups"]} g ON u.level=g.level WHERE u.status = '1' ORDER BY u.level DESC, u.username");
	
	while( $row = $user->fetchAssoc($result) ){
	
		if( $row["status"] == 0 ){
			$status = "Offline";
		}
		elseif( $row["status"] == 1 ){
			$status = "Online";
		}
		elseif( $row["status"] == 2 ){
			$status = "Gesperrt";
		}
		
		$reg_date = date("d.m.Y",$row["reg_date"]);
		$mod = $i%2;
		$username = str_replace(" ","%20",$row["username"]);
		$ausgabe .= "<tr>
			<td class=\"whois-td{$mod}\"><a href=\"?site=whois&amp;user={$username}\">{$row["username"]}</a></td>
			<td class=\"whois-td{$mod}\">{$reg_date}</td>
			<td class=\"whois-td{$mod}\">{$row["charcount"]}</td>
			<td class=\"whois-td{$mod}\">{$row["rang"]}</td>
		</tr>" . "\r\n";
		$i++;
	}
}
else{
	$ausgabe .= "<tr>
			<td class=\"whois-td0\" colspan=\"4\">{@Bitte melde dich im Chat an, um die Benutzerliste zu sehen.}</td>
		</tr>" . "\r\n";
}

$vars = Array(
				"{online_list}"		=> $ausgabe,
);

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>