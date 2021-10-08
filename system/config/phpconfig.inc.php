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


// PHP Reporting auf Default einstellen
error_reporting(E_ALL & ~E_NOTICE);

// Die folgende Zeile konvertiert alles einheitlich in UTF-8
header('Content-type: text/html; charset=UTF-8');
mb_internal_encoding("UTF-8");
// Frames und iFrames von Fremden Seiten blockieren
//header('X-Frame-Options: SAMEORIGIN');

// Lege die Standard-Zeitzone fest
if( function_exists('date_default_timezone_set') ) 
date_default_timezone_set("Europe/Berlin");

// Starte eine neue Session bzw. setze eine bestehende fort
// Zusätzliche Session-Einstellungen werden gesetzt
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
ini_set('session.gc_maxlifetime', 900);

// GZIP-Komprimierung aktivieren
//ini_set('zlib.output_compression', '1');
//ini_set('zlib.output_compression_level', '-1');

// Simuliere eine Unicodefähige ucfirst Funktion
if (!function_exists('mb_ucfirst') && function_exists('mb_substr') && function_exists('mb_strtoupper')){
	function mb_ucfirst($string){
		return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	}
}
?>