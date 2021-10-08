<?php
/*
	SHChat
	(C) 2006-2013 by Scripthosting.net
	http://www.shchat.net

	Free for non-commercial use:
	Licensed under the "Creative Commons 3.0 BY-NC-SA"
	http://creativecommons.org/licenses/by-nc-sa/3.0/
	
	Support-Forum: http://board.scripthosting.net/viewforum.php?f=18
	Don't send emails asking for support!!
*/

class Chat extends Mysql
{	
	/**
	 * Returns a string with all smileys 
	 * @return string
	 */
	public function getChatColors($usercolor = "#000000", $lang = "")
	{		
		global $config;
		
		$lang = ($lang == "") ? $config["language"] : $lang;
		$color_ini = $config["lang_path"] . "/chatcolors.ini";
		if (!file_exists($color_ini))	
			$color_ini = realpath($config["basepath"] . "/templates/global/lang/en/chatcolors.ini");		
		$colors = "";		
		$open = file($color_ini);
		
		foreach ($open as $value) {			
			$get = explode("|", $value);
			$color_name = trim($get[0]);
			$color_code = trim($get[1]);

			$colors .= "<option";
			if ($usercolor == $color_code)
				$colors .= " selected=\"selected\"";
			$cColor = substr(dechex(~hexdec($color_code)), -6);
			$colors .= " value=\"{$color_code}\" style=\"color: #{$cColor}; background-color:{$color_code};\">{$color_name}</option>" . "\r\n";
		}
		return $colors;
	}
	
	
	/**
	 * Returns a string with all smileys
	 * @param int $limit 
	 * @return string
	 */
	public function getSmileys($limit = 0)
	{		
		global $config;
		
		$smiley_ini = $config["basepath"] . "/system/smileys/smileys.ini";
		$smiley_uri = $config["scriptpath"] . "/system/smileys/";
		$output = "";
		$i = 0;
		
		$open = file($smiley_ini);
		
		foreach ($open as $value) {			
			$get = explode("|", $value);
			$filename = trim($get[0]);
			$command = trim($get[1]);

			$output .= "<a href=\"javascript:setsmiley('{$command}');\"><img src=\"{$smiley_uri}{$filename}\" alt=\"smiley\" /></a> " . "\r\n";
			$i++;
			
			if ($limit > 0 && $i >= $limit) {
				break;
			}
		}
		return $output;
	}
	
	
	/**
	 * Converts a string into smileys
	 * @param $string
	 * @return string
	 */
	public function convertSmileys($string)
	{		
		global $config;
		
		$smiley_ini = $config["basepath"] . "/system/smileys/smileys.ini";
		$smiley_uri = "system/smileys/";

		$open = file($smiley_ini);
		
		foreach ($open as $value) {			
			$get = explode("|", $value);
			$count = count($get);
			$filename = trim($get[0]);
			
			for ($i=1; $i < $count; $i++){
				$string = str_replace($get[$i], "<img src=\"{$smiley_uri}{$filename}\" alt=\"Smiley\" />", $string);				
			}
		}
		return $string;
	}
	
	
	/**
	 * Converts an uri string into an url
	 * @param $string
	 * @return string
	 */
	public function convertUrl($string)
	{
		$get = explode(" ", $string);

		for ($i = 0; $i < count($get); $i++) {			
			// HTTP
			if (mb_substr($get[$i],0,7) == "http://") {
				$url = (mb_strlen($get[$i]) > 50) ? mb_substr($get[$i],0,40) . "...". mb_substr($get[$i],-10) : $get[$i];
				$get[$i] = "<a href=\"{$get[$i]}\" target=\"_blank\">{$url}</a>";
			}
			// www/HTTP
			elseif (mb_substr($get[$i],0,4) == "www.") {
				$url = (mb_strlen($get[$i]) > 50) ? mb_substr($get[$i],0,40) . "...". mb_substr($get[$i],-10) : $get[$i];
				$get[$i] = "<a href=\"http://{$get[$i]}\" target=\"_blank\">{$url}</a>";
			}
			// HTTPS
			elseif (mb_substr($get[$i],0,8) == "https://") {
				$url = (mb_strlen($get[$i]) > 50) ? mb_substr($get[$i],0,40) . "...". mb_substr($get[$i],-10) : $get[$i];
				$get[$i] = "<a href=\"{$get[$i]}\" target=\"_blank\">{$url}</a>";
			}
			// FTP
			elseif (mb_substr($get[$i],0,6) == "ftp://") {
				$url = (mb_strlen($get[$i]) > 50) ? mb_substr($get[$i],0,40) . "...". mb_substr($get[$i],-10) : $get[$i];
				$get[$i] = "<a href=\"{$get[$i]}\" target=\"_blank\">{$url}</a>";
			}				
		}
		return implode(" ", $get);		
	}

	
	/**
	 * Returns the Online Users in the Chat
	 * @return int
	 */
	public function getAllOnlineUsers()
	{		
		global $db;
		
		$result = $this->result("SELECT count(*) as anzahl FROM {$db["online"]} LIMIT 1");
		$row = $this->fetchAssoc($result);

		return (int) $row["anzahl"];
	}
}
?>