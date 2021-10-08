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

class Template
{
	/**
	 * Läd ein Template in die aktuelle Seite
	 * @param string $tpl
	 * @return boolean
	 */
	public function getTemplate($tpl)
	{		
		global $config, $db, $language;
		
		$tpl = trim($tpl);
		
		if (file_exists($config["include_path"] . "/" . $tpl . ".inc.php")) {
			include_once($config["include_path"] . "/" . $tpl . ".inc.php");
			return true;
		} elseif (file_exists($config["template_path"] . "/" . $tpl . ".html")) {
			echo file_get_contents($config["template_path"] . "/" . $tpl . ".html");
		}
		return false;		
	}
	
	
	/**
	 * Gibt eine Datei aus
	 * @param string $filename
	 * @param array $vars
	 * @return string
	 */
	public function output($filename, $vars = array())
	{		
		global $config, $language;
		
		$open = file_get_contents(realpath($filename));
		$vars["{templateName}"] = $config["template_name"];
      
		// Ersetzen aller Textmarken durch die in $vars zugewiesenen Werte
		foreach($vars as $key => $value) {
   			$open = str_replace($key, $value, $open);
		}
		
		// Sprach-Textmarken erkennen und behandeln
		$anzahl = (int) preg_match_all("/\{@(.*)\}/sU", $open, $array);
		// Übersetzen der Textmarke
		foreach($array[1] as $key => $value) {
			$open = str_replace("{@".$value."}", $language->translate($value), $open);
		}
		
		// Sprach-Textmarken zur sicheren Verwendung in JavaScript erkennen und behandeln (%@)
		$anzahl = (int) preg_match_all("/\{%@(.*)\}/sU", $open, $array);
		// Übersetzen der Textmarke
		foreach($array[1] as $key => $value) {
			$open = str_replace("{%@".$value."}",addslashes($language->translate($value)), $open);
		}
		
		// Infobox-Textmarken erkennen und behandeln
		$anzahl = (int) preg_match_all("/\{!(.*)\}/sU", $open, $array);
		// Übersetzen der Textmarke
		foreach($array[1] as $key => $value) {
			$open = str_replace("{!".$value."}", $this->infobox($language->translate($value),false,""), $open);
		}
		
		// Errorbox-Textmarken erkennen und behandeln
		$anzahl = (int) preg_match_all("/\{#(.*)\}/sU", $open, $array);
		// Übersetzen der Textmarke
		foreach($array[1] as $key => $value) {
			$open = str_replace("{#".$value."}", $this->errorbox($language->translate($value),false,""), $open);
		}
	
		return $open;
	}
	
	
	/**
	 * Gibt den Pfad einer Templatedatei aus
	 * @param string $file
	 * @param string $subdir Optional: falls die Dateien in einem Unterordner von '/templates' liegen
	 * @return string
	 */
	public function getFilePath($file, $subdir = "")
	{		
		global $config;
		
		$file = explode("/",str_replace("\\","/", $file));
		$file = str_replace(".inc.php",".html", $file[count($file)-1]);
		if ($subdir != "") {
			return realpath($config["template_path"]."/{$subdir}/{$file}");
		}
		return realpath($config["template_path"]."/{$file}");
	}
	
	
	/**
	 * Zeigt eine Infobox mit dem angegebenen Text an
	 * @param string $text
	 * @param boolean $break (Default = false) Führe einen Zeilenumbruch durch
	 * @return string
	 */
	public function infobox($text, $break = false, $basepath = "../")
	{
		global $config;
		
		$output = "";
		
		if ($break) {
			$output .= "<br />";
		}
		
		$output .= "<div class=\"info\">\r\n";
		$output .= "\t<img src=\"{$basepath}templates/{$config["defaultTemplate"]}/img/b_tipp.png\" alt=\"item\" /> {$text}\r\n".
				  "\t</div>\r\n\r\n";
		
		if ($break) {
			$output .= "<br />";
		}
				
		return $output;		
	}
	
	
	/**
	 * Zeigt eine Errorbox mit dem angegebenen Text an
	 * @param string $text
	 * @param boolean $break (Default = false) Führe einen Zeilenumbruch durch
	 * @return string
	 */
	public function errorbox($text, $break = false, $basepath = "../")
	{		
		global $config;
		
		$output = "";
		
		if ($break) {
			$output .= "<br />";
		}
		
		$output .= "<div class=\"errorbox\">\r\n";
		$output .= "\t<img src=\"{$basepath}templates/{$config["defaultTemplate"]}/img/s_error.png\" alt=\"error\" width=\"16\" height=\"16\" /> {$text}\r\n".
		  		  "\t</div>\r\n\r\n";
		
		if ($break) {
			$output .= "<br />";
		}
		
		return $output;
	}
	
	
	/**
	 * Überprüfen, ob es sich beim aufrufenden Computer um ein mobiles Gerät handelt
	 * @return boolean
	 */
	public function isMobileDevice()
	{
		$agents = array(
		'Windows CE', 'Pocket', 'Mobile',
		'Portable', 'Smartphone', 'SDA',
		'PDA', 'Handheld', 'Symbian',
		'WAP', 'Palm', 'Avantgo',
		'cHTML', 'BlackBerry', 'Opera Mini',
		'Nokia', 'Fennec'
		);

		// Prüfen der Browserkennung
		for ($i = 0; $i < count($agents); $i++) {
			if(isset($_SERVER["HTTP_USER_AGENT"]) && strpos($_SERVER["HTTP_USER_AGENT"], $agents[$i]) !== false)
			return true;
  		}
		return false;
	}	
}
?>