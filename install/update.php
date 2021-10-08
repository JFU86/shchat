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

require_once("../system/config/config.inc.php");

$mysqli = new Mysql();

// Update von 1.0.0
$mysqli->query("ALTER TABLE {$db["user"]} MODIFY COLUMN `userpass` VARCHAR(64) NOT NULL, MODIFY COLUMN `charcount` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0', MODIFY COLUMN `chat_time` BIGINT(20) UNSIGNED NOT NULL", false);

// Abschluss, Weiterleiten
header("Location: ../");
exit;

?>