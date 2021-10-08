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
$format = new Format();

if( $user->getUserStatus() == 1 ){

	$row = $user->getUserDetails($_REQUEST["user"]);
		
	if( $row["status"] == 0 ){
		$status = "<i>Offline</i>";
	}
	elseif( $row["status"] == 1 ){
		$status = "<b>Online</b>";
	}
	elseif( $row["status"] == 2 ){
		$status = "<span style=\"color:red;\"><i>Offline</i></span>";
	}
	
	$away = ( $row["away"] != "" )	?	"<tr>
			<td class=\"whois-td0\" width=\50%\"><b>AWAY Nachricht:</b></td>
			<td class=\"whois-td0\" width=\"50%\">{$row["away"]}</td>
		</tr>" :	"";

	// Alter und Schaltjahre seit der Geburt berechnen
	(int) $schalttage = 0;
	(int) $geburtsjahr =  date("Y",strtotime($row["birthdate"]));
	(int) $jetztJahr = date("Y");
	
	for( $i=$geburtsjahr; $i<=$jetztJahr; $i++ ){
		if( date("L",strtotime($i."-01-01")) == 1 ) $schalttage++;
	}
	(int) $alter = floor( ((time() - strtotime($row["birthdate"])) - ($schalttage*24*60*60)) / (365*24*60*60) );
	
	if( $row["gender"] == "f" ){
		$gender_icon = " <img src='templates/{$config["template_name"]}/img/female.gif' alt='Frau' /> ";
	}
	elseif( $row["gender"] == "m" ){
		$gender_icon = " <img src='templates/{$config["template_name"]}/img/male.gif' alt='Mann' /> ";
	}
	
	$vars = Array(
						"{username}"	=> $_REQUEST["user"],
						"{reg_date}"	=> date("d.m.Y",$row["reg_date"]),
						"{myName}"		=> $row["name"],
						"{myCity}"		=> $row["city"],
						"{myAge}"		=> ( $row["birthdate"] != "" ) ? $alter : "",
						"{aboutMe}"		=> nl2br($row["description"]),
						"{charcount}"	=> $row["charcount"],
						"{chat_time}"	=> $format->getTime($row["chat_time"]),
						"{rang}"		=> $row["rang"],
						"{status}"		=> $status,
						"{away_msg}"	=> $away,
						"{gender_icon}"	=> $gender_icon,
	);

}
else{
	exit;
}

################################################################
#### AB HIER NICHTS ÄNDERN !!! 
#### Teamplate einbinden und definierte Variablen ersetzen
################################################################

echo $template->output( $template->getFilePath(__FILE__), $vars );

?>