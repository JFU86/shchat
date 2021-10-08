<?php
/*
	Guestbook Light
	by Scripthosting.net
	
	Licensed under the "GPL Version 3, 29 June 2007"
	http://www.gnu.org/licenses/gpl.html
	
	Support-Forum: http://board.scripthosting.net
	Don't send emails asking for support!!
*/

class Install {
	
	/**
	 * Erstelle eine neue Sprachdatenbank
	 */
	public function createLanguageDB()
	{	
		global $config;
	
		@unlink($config["system_path"] . "/sqlite/language.db");
	
		if( !file_exists($config["system_path"] . "/sqlite/language.db") ){
			$put = file_put_contents($config["system_path"] . "/sqlite/language.db", "");
			$chmod = chmod($config["system_path"] . "/sqlite/language.db", 0777);		
	
			$sqlite = new Sqlite($config["system_path"] . "/sqlite/language.db");
			$sql = file_get_contents($config["system_path"] . "/temp/language.sql");
			$part = explode("/* SPLIT */", trim($sql));
		
			foreach ($part as $value) {
				if ($value != "") {
					$query = $sqlite->query(trim($value));
				}
			}
			if (!$config["debug"])
				@unlink($config["system_path"]."/temp/language.sql");
		}
	}
}
?>