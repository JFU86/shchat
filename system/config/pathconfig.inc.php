<?php
/*
	SHChat
	(C) 2006-2018 by Scripthosting.net
	http://www.shchat.net
*/

// Starte eine neue Session bzw. setze eine bestehende fort
session_name("shchatsid");
if(!isset($_SESSION)) session_start();

// Language
$config["language"] = ( !isset($_SESSION["language"]) && isset($config["defaultLanguage"]) )
	? mb_substr($config["defaultLanguage"],0,2) : (( isset($_SESSION["language"]) && !isset($config["defaultLanguage"]) )
		? mb_substr($_SESSION["language"],0,2) : mb_substr($config["language"],0,2));

// Basispfad zum Script (intern)
$config["basepath"] = substr(__FILE__,0,-33);
// Scriptpfad zum Script relativ zur Domain
$config["template_path"] = realpath($config["basepath"]."/templates/{$config["template_name"]}/html");
$config["include_path"] = realpath($config["basepath"]."/templates/{$config["template_name"]}/php");
$config["system_path"] = realpath($config["basepath"]."/system");
$config["class_path"] = realpath($config["basepath"]."/system/class");
$config["lang_path"] = realpath($config["basepath"] . "/templates/global/lang/{$config["language"]}");

////////////////////////////////////////////////////////////////////////
// Teile PHP das Standardverzeichnis für alle Klassen und Interfaces mit
////////////////////////////////////////////////////////////////////////
spl_autoload_register(function ($class_name) {
	global $config;
	
    if (file_exists($config["system_path"] . "/class/class.". $class_name .".php")) {
		include_once($config["system_path"] . "/class/class.". $class_name .".php");
	}
	elseif (file_exists($config["system_path"] . "/class/interface.". $class_name .".php")) {
		include_once($config["system_path"] . "/class/interface.". $class_name .".php");
	}
	elseif (file_exists($config["system_path"] . "/class/". str_replace("\\","/",$class_name) .".class.php")) {
		include_once($config["system_path"] . "/class/". str_replace("\\","/",$class_name) .".class.php");
	}
	else {
		throw new Exception("Class or Interface {$class_name} not found!");
	}
});

// Language global zur Verfügung stellen
$language = new Language();

$db = Array(
		"channel"		=>	$config["prefix"]."channel".$config["postfix"],
		"groups"		=>	$config["prefix"]."groups".$config["postfix"],
		"online"		=>	$config["prefix"]."online".$config["postfix"],
		"postings"		=>	$config["prefix"]."postings".$config["postfix"],
		"privileges"	=>	$config["prefix"]."privileges".$config["postfix"],
		"user"			=>	$config["prefix"]."user".$config["postfix"],
		"userdetails"	=>	$config["prefix"]."userdetails".$config["postfix"]
);
?>