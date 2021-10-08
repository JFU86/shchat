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

class User extends Chat
{	
	public $user_name;
	public $hasPrivilege = false;	
	
	/**
	 * Returns Users user_id
	 * @return int user_id
	 */
	public function getUserId()
	{
		return isset($_SESSION["user_id"]) ? (int) $_SESSION["user_id"] : 0;
	}
	
	
	/**
	 * Sets Users user_id
	 * @param int $user_id
	 * @return void
	 */
	public function setUserId($user_id)
	{
		$_SESSION["user_id"] = (int) $user_id;
	}
	
	
	/**
	 * Returns Users Username
	 * @param boolean request
	 * @return string user_name
	 */
	public function getUserName($request = false)
	{		
		if ($_SESSION["username"] != "" && $request == false) {
			return $_SESSION["username"];
		} else {
			global $db;
			$resultRow = $this->resultRow("SELECT username FROM {$db["user"]} WHERE id = {$this->getUserId()}");
			return  $resultRow["username"];
		}	
	}

	
	/**
	 * Sets Users username
	 * @param string $username
	 * @return void
	 */
	public function setUserName($username)
	{
		$_SESSION["username"] = $username;
	}
	

	/**
	 * Get user details by user id
	 * @param int $user_id
	 * @return array
	 */
	public function getUserByID($user_id)
	{	
		global $db;
			
		$user_id = (int) $this->clean($user_id);
		$resultRow = $this->resultRow("SELECT * FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON (u.id=d.id) WHERE u.id = {$user_id}");
		return $resultRow;
	}
	
	
	/**
	 * Gets Users detailed data set
	 * @param array $username
	 */
	public function getUserDetails($username)
	{
		global $db;
		
		$username = $this->clean($username);
		return $this->resultRow("SELECT * FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id LEFT JOIN {$db["groups"]} g ON u.level=g.level WHERE u.username = '{$username}'");
	}
	
	
	/**
	 * Returns Users Status
	 * @return int
	 */
	public function getUserStatus()
	{		
		global $db;
		
		$result = $this->result("SELECT status FROM {$db["user"]} WHERE id = {$this->getUserId()}");
	
		while ($row = $this->fetchAssoc($result)) {
			return $row["status"];
		}
		return 0;
	}
	
	
	/**
	 * Sets users status
	 * @param string $username
	 * @param int $status
	 * @return void
	 */
	public function setUserStatus($username, $status)
	{		
		global $db;
		$query = $this->query("UPDATE {$db["user"]} SET status = '{$status}' WHERE username = '{$username}'");
	}
	
	
	/**
	 * Returns a boolean about the privilege access 
	 * @param string $p
	 * @return boolean
	 */
	public function hasPrivilege($p)
	{		
		global $db;
		
		if ($p != null && $p != "") {
			$result = $this->result("SELECT p.{$p} FROM {$db["online"]} o LEFT JOIN {$db["groups"]} g ON o.level=g.level LEFT JOIN {$db["privileges"]} p ON g.group_id=p.group_id WHERE o.username = '{$this->getUserName()}'");
			
			while ($row = $this->fetchAssoc($result)) {				
				if ($row[$p] == "0" || $row[$p] == 0)
					return false;
				return true;
			}
		}
		
		return false;	
	}
	
	
	/**
	 * Returns a boolean, if the user is in channel
	 * @param string $username
	 * @return boolean
	 */
	public function isInChannel($username)
	{		
		global $db;
		
		$channel = new Channel();
		$result = $this->result("SELECT id FROM {$db["online"]} WHERE username = '{$username}' AND channel = '{$channel->getChannelName()}'");
		
		while ($row = $this->fetchAssoc($result)) {
			return true;
		}
		return false;
	}
	
	
	/**
	 * Checks if a user exists
	 * @param string $username
	 * @return boolean
	 */
	public function exists($username)
	{		
		global $db;
		
		$result = $this->result("SELECT username FROM {$db["user"]} WHERE LOWER(username) = LOWER('{$username}')");
		
		if ($this->numRows($result) == 1) {
			return true;
		}
		return false;		
	}
	
	
	/**
	 * Returns a boolean, if the user is online
	 * @param string $username
	 * @return boolean
	 */
	public function isOnline($username)
	{		
		global $db;
		
		$result = $this->result("SELECT id FROM {$db["online"]} WHERE username = '{$username}'");
		
		while ($row = $this->fetchAssoc($result)) {
			return true;
		}
		return false;
	}
	
	
	/**
	 * Returns a boolean, if the user is away, if no username is given, the current will be used
	 * @param string $username
	 * @return boolean
	 */	
	public function isAway($username = "")
	{		
		global $db;
		
		if ($username == "") {
			$result = $this->result("SELECT away FROM {$db["user"]} WHERE username = '{$this->getUserName()}'");
		} else {
			$result = $this->result("SELECT away FROM {$db["user"]} WHERE username = '{$username}'");
		}
		
		while ($row = $this->fetchAssoc($result)) {
			if ($row["away"] != "") {
				return true;
			}
		}
		return false;
	}
	
	
	/**
	 * Sets Users away message/status
	 * @param string $msg
	 * @return void
	 */	
	public function setAway($msg)
	{		
		global $db;
		$query = $this->query("UPDATE {$db["user"]} SET away = '{$msg}' WHERE id = {$this->getUserId()}");
	}
	
	
	/**
	 * Sets users level
	 * @param string $username
	 * @param int $level
	 * @return void
	 */
	public function setUserLevel($username, $level)
	{		
		global $db;
		$query = $this->query("UPDATE {$db["user"]} SET level = '{$level}' WHERE username = '{$username}'");
	}
	
	
	/**
	 * Sets users online level
	 * @param string $username
	 * @param int $level
	 * @return void
	 */
	public function setOnlineLevel($username, $level)
	{		
		global $db;
		$query = $this->query("UPDATE {$db["online"]} SET level = '{$level}' WHERE username = '{$username}'");
	}
	
	
	/**
	 * Returns a boolean, if the user is chatadmin
	 * @param string $username
	 * @return boolean
	 */
	public function isChatAdmin($username)
	{		
		global $db;
		
		$result = $this->result("SELECT level FROM {$db["user"]} WHERE username = '{$username}'");

		while ($row = $this->fetchAssoc($result)) {
			if ($row["level"] == 999 || $row["level"] == "999")
				return true;
			return false;			
		}
		
		return false;
	}
	
	
	/**
	 * Sets the last login of a user to NOW
	 * @return void
	 */
	public function setLastLogin()
	{		
		global $db;
		
		$_SESSION["last_login"] = time();
		$ip = $_SERVER["REMOTE_ADDR"];
		$hostname = gethostbyaddr($ip);
		$client = $_SERVER["HTTP_USER_AGENT"];
		$this->query("UPDATE {$db["user"]} SET status = '1', last_login = UNIX_TIMESTAMP(), last_reload = UNIX_TIMESTAMP(), ipadress = '{$ip}', hostname = '{$hostname}', client = '{$client}', away = '' WHERE username = '{$this->getUserName()}'");
	}
	
	
	/**
	 * User Logout
	 * @param string [$username=""]
	 * @return void
	 */
	public function logout($username = "")
	{		
		global $db;
				
		if ($username == "") {
			$this->query("UPDATE {$db["user"]} SET status = '0', away = '' WHERE id = {$this->getUserId()}");	
		} else {
			$this->query("UPDATE {$db["user"]} SET status = '0', away = '' WHERE username = '{$username}'");
		}
	}
	
	
	/**
	 * Bans a user from the chat
	 * @param string [$username=""]
	 * @return void
	 */
	public function setBanned($username = "")
	{		
		global $db;
				
		if ($username == "") {
			$this->query("UPDATE {$db["user"]} SET status = '2', away = '' WHERE id = {$this->getUserId()}");			
		} else{
			$this->query("UPDATE {$db["user"]} SET status = '2', away = '' WHERE username = '{$username}'");
		}
	}
	
	
	/**
	 * Checks the User data
	 * @param string $name
	 * @param string $pass
	 * @return integer
	 */
	public function checkUserLogin($name, $pass)
	{		
		global $db;
		
		$result = $this->result("SELECT id,status FROM {$db["user"]} WHERE LOWER(username) = LOWER('$name') AND userpass = MD5('$pass')");
		
		while ($row = $this->fetchAssoc($result)) {			
			if ($row["status"] == "2") {
				return 2;	// User is banned
			}
			elseif ($row["status"] == "3") {
				return 3;	// User is inactive
			} else {
				$this->setUserId($row["id"]);
				$this->setUserName($this->getUserName(true));
				return 1;	// user is logged in
			}
		}		
		return 0;	// Benutzer existiert nicht
	}
	
	
	/**
	 * Returns the User Level
	 * @return int
	 */
	public function getUserLevel()
	{		
		global $db;
		
		$result = $this->result("SELECT level FROM {$db["user"]} WHERE id = {$this->getUserId()}");
	
		while ($row = $this->fetchAssoc($result)) {
			return (int)$row["level"];	
		}
		return 0;		
	}
	
	
	/**
	 * Returns the User Level
	 * @return void
	 */
	public function getUserChannelLevel()
	{		
		global $db;
		
		$result = $this->result("SELECT level FROM {$db["online"]} WHERE username = '{$this->getUserName()}'");
	
		while ($row = $this->fetchAssoc($result)) {
			return (int)$row["level"];	
		}
		return 0;		
	}	
	
	
	/**
	 * Returns the User Color
	 * @return void
	 */
	public function getUserColor()
	{		
		global $db;
		
		$result = $this->result("SELECT color FROM {$db["userdetails"]} WHERE id = {$this->getUserId()}");
	
		while ($row = $this->fetchAssoc($result)) {
			$user_color = $row["color"];
			break;
		}
		
		return $user_color;	
	}
	
		
	/**
	 * Sets the Users color 
	 * @param string $color
	 * @return void
	 */
	public function setUserColor($color)
	{		
		global $db;
		$query = $this->query("UPDATE {$db["userdetails"]} SET color = '{$color}' WHERE id = {$this->getUserId()}");
	}
	
	
	/**
	 * Returns the User AutoScroll value
	 * @return void
	 */
	public function getUserAutoScroll()
	{		
		global $db;
		
		$result = $this->result("SELECT autoscroll FROM {$db["userdetails"]} WHERE id = {$this->getUserId()}");
	
		while ($row = $this->fetchAssoc($result)) {
			$user_autoscroll = $row["autoscroll"];
			break;
		}
		
		return (int) $user_autoscroll;	
	}
	
	
	/**
	 * sets users autoscroll value
	 * @param int $user_id
	 * @param int $autoscroll
	 * @return void
	 */
	public function setUserAutoScroll($user_id, $autoscroll)
	{		
		global $db;
		
		$user_id = (int) $user_id;
		$autoscroll = (int) $autoscroll;
		$query = $this->query("UPDATE {$db["userdetails"]} SET autoscroll = '{$autoscroll}' WHERE id = '{$user_id}'");
	}
	
	
	/**
	 * Returns the Users E-Mail
	 * @return void
	 */
	public function getUserEmail()
	{		
		global $db;
		
		$result = $this->result("SELECT email FROM {$db["userdetails"]} WHERE id = {$this->getUserId()}");
	
		while ($row = $this->fetchAssoc($result)) {
			$user_email = $row["email"];
			break;
		}
		
		return $user_email;
	}

	
	/**
	 * Returns the Users Last Login
	 * @return void
	 */
	public function getLastLogin()
	{		
		if ($_SESSION["last_login"] != "") {
			return $_SESSION["last_login"];
		} else {
			global $db;
			$result = $this->result("SELECT last_login FROM {$db["user"]} WHERE id = {$this->getUserId()}");
		
			while ($row = $this->fetchAssoc($result)) {
				$last_login = $row["last_login"];
				break;
			}
			
			return $last_login;			
		}
	}
	
	
	/**
	 * Returns the channel name in which a user is online if he is online
	 * @param string $username
	 * @return string
	 */
	public function getUserChannelOnline($username)
	{		
		global $db;
		
		$result = $this->result("SELECT channel FROM {$db["online"]} WHERE username = '{$username}'");
		
		while ($row = $this->fetchAssoc($result)) {
			return $row["channel"];
		}
		return "";		
	}
	
	
	/**
	 * Returns users group name
	 * @param string $username
	 * @return string
	 */
	public function getGroupName($username)
	{		
		global $db;
		
		$result = $this->result("SELECT g.rang FROM {$db["groups"]} g LEFT JOIN {$db["user"]} u ON g.level=u.level WHERE u.username = '{$username}'");
		
		while ($row = $this->fetchAssoc($result)) {
			return $row["rang"];
		}
		return "";
	}
	
	
	/**
	 * Returns users group symbol
	 * @param int $level
	 * @return string
	 */
	public function getGroupSymbol($level)
	{		
		global $db;
		
		$result = $this->result("SELECT icon FROM {$db["groups"]} WHERE level = '{$level}'");
		
		while ($row = $this->fetchAssoc($result)) {
			if ($row["icon"] == "") {
				$row["icon"] = "&#160;";
			}
			return $row["icon"];
		}
		return "";
	}
	
	
	/**
	 * Returns the users gender
	 * @param int $user_id
	 * @return string
	 */
	public function getUserGender($user_id)
	{		
		return $this->getCustomField("gender", $user_id);
	}

	
	/**
	 * Returns the Users Custom Field
	 * @param string $field
	 * @param int $user_id
	 * @return string
	 */
	public function getCustomField($field, $user_id = 0)
	{		
		global $db;
		
		if ($user == 0) {
			$result = $this->result("SELECT `{$field}` FROM {$db["userdetails"]} WHERE id = {$this->getUserId()}");
		} else {
			$user_id = (int) $this->clean($user_id);
			$result = $this->result("SELECT `{$field}` FROM {$db["userdetails"]} WHERE id = {$user_id}");
		}
	
		while ($row = $this->fetchAssoc($result)) {
			return $row[$field];	
		}
		return "";		
	}
	
	
	/**
	 * Returns an Object with user data
	 * @param int $user_id
	 * @return array
	 */
	public function getData($user_id = 0)
	{		
		global $db;
		
		$user_id = (int)(($user_id == 0) ? $this->clean($_REQUEST["id"]) : $this->clean($user_id));
		
		return $this->resultRow(
			"SELECT * FROM {$db["user"]} u LEFT JOIN {$db["userdetails"]} d ON u.id=d.id LEFT JOIN {$db["groups"]} g ON u.level=g.level WHERE u.id = '{$user_id}'"
		);		
	}
	
	
	/**
	 * Returns the users silence state
	 * @return int
	 */
	public function getUserSilence()
	{		
		global $db;
		
		$result = $this->result("SELECT silent FROM {$db["user"]} WHERE id = {$this->getUserId()}");
	
		while ($row = $this->fetchAssoc($result)) {
			return (int)$row["silent"];
		}
		return 0;		
	}
	
	
	/**
	 * Checks if the user is silent
	 * @return boolean
	 */
	public function isSilent()
	{	
		if ($this->getUserSilence() >= time()) {
			return true;
		}
		return false;
	}
	
	
	/**
	 * Makes a user silent
	 * @param string $username
	 * @param int $duration
	 * @return void
	 */
	public function setSilence($username, $duration)
	{		
		global $db;
		$this->query("UPDATE {$db["user"]} SET silent = '{$duration}' WHERE username = '{$username}'");
	}
	
	
	/**
	 * Updates the users online status
	 * @return void
	 */
	public function updateOnlineStatus()
	{		
		global $db;
		
		$time = time();
		$query = $this->query("UPDATE {$db["user"]} SET chat_time = chat_time+({$time}-last_reload), last_reload = '{$time}' WHERE id = {$this->getUserId()}");
	}
	
	
	/**
	 * Adds $count to the users char count
	 * @param int $count
	 * @return void
	 */
	public function updateCharCount($count)
	{		
		global $db;
		$query = $this->query("UPDATE {$db["user"]} SET charcount = (charcount+{$count}) WHERE id = {$this->getUserId()}");		
	}
	
	
	/**
	 * Edit userdetails to the current or selected user
	 * @param string $param
	 * @param string $value
	 * @param int $user_id
	 * @return int
	 */
	public function editUserDetail($param, $value, $user_id = 0)
	{		
		global $db;
		
		$param = $this->clean($param);
		$value = $this->clean($value,false,true);
		$user_id = (int) (($user_id != 0) ? $this->clean($user_id) : $_SESSION["user_id"]);
	
		if ($value == "@NULL")
			$query = $this->query("UPDATE {$db["userdetails"]} SET {$param} = NULL WHERE id = '{$user_id}'");
		else
			$query = $this->query("UPDATE {$db["userdetails"]} SET {$param} = '{$value}' WHERE id = '{$user_id}'");
		
		return $this->affectedRows($query);
	}
	
	
	/**
	 * 
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param string $code
	 * @param string $gender
	 * @param string &$error
	 */
	public function register($username, $password, $email, $code, $gender, &$error)
	{		
		global $config, $language, $db;
		
		$mail = new Mail();
		
		// Ungültige Chatnamen
		$badnames = Array("chatbot", "admin", "operator", "self");		
		// Input-Filter
		$username 	=	$this->clean(mb_ucfirst(mb_strtolower($username)),false,true);
		$password 	=	$this->clean($password);
		$email 		=	$this->clean(mb_strtolower($email));
		$code 		=	$this->clean($code);
		$gender 	=	$this->clean($gender,false,true);
		// Name-Filter-Pattern
		$name_pattern = "^[a-zA-Z0-9_]{3,16}$^";
		$name_valid = (preg_match($name_pattern,mb_strtolower($username)) && !in_array(mb_strtolower($username), $badnames));	
		// Benutzernamen prüfen
		$user_exists = $this->exists($username);		
		
		if ($user_exists) {
			$error = $language->translate("Der gewünschte Benutzername ist bereits belegt!");
		}
		elseif (!$name_valid) {
			$error = $language->translate("Der gewünschte Benutzername ist nicht verfügbar!");
		}
		elseif (!$mail->validate($email)) {
			$error = $language->translate("Die E-Mail-Adresse ist ungültig!");
		}
		elseif ($password == "") {
			$error = $language->translate("Dein Passwort darf nicht leer sein!");
		}
		elseif ($gender != "m" && $gender != "f") {
			$error = $language->translate("Bitte wähle dein Geschlecht!");
		}
		elseif ($code != $_SESSION["captcha_spam"]) {
			$error = $language->translate("Der Sicherheitscode ist falsch!");
		} else {
			// Neuen Benutzer anlegen
			$captcha = new Captcha();
			$zeit = time();
			$key = $captcha->randomString(32); // Freischaltcode erzeugen
			$query = $this->query("INSERT INTO {$db["user"]} (username,userpass,reg_date,level,`key`,status) VALUES ('{$username}','". MD5($password) ."','{$zeit}',1,'{$key}',3)");
			$user_id = $this->insertID($query);
			if ($user_id > 0)
				$query = $this->query("INSERT INTO {$db["userdetails"]} (id,email,color,autoscroll,gender) VALUES ({$user_id}, '{$email}', '#000000', 1, '{$gender}')");
			else {
				$error = $language->translate("Fehler beim Anlegen des Benutzers! (UserID={$user_id})");
				return 0;
			}
		
			// Text einbinden
			$text = file_get_contents($config["lang_path"] . "/register.txt");
			// Text-Variablen
			$reg_vars = array();
			$reg_vars["{username}"] = $username;
			$reg_vars["{password}"] = $password;
			$reg_vars["{url}"] = $config["scriptpath"];
			$reg_vars["{activate_url}"] = $config["scriptpath"]. "/?site=validate&name={$username}&key=".$key;
		
			foreach($reg_vars as $key => $value){
				$text = str_replace($key, $value, $text);
			}
		
			// E-Mail versenden
			if (!isset($config["email_aktivierung"]) || $config["email_aktivierung"] == 1) {
				$mail->sendMail($config["admin_email"], $email, $config["overall_title"], $text);
			}
			
			// return user_id
			return (int) $user_id;
		}
		return 0;
	}
	
	
	/**
	 * User login
	 * @param string $username
	 * @param string $password
	 * @param string $startchannel
	 */
	public function login($username, $password, $startchannel)
	{		
		global $config, $language;
		
		$channel = new Channel();
		$chatinput = new Chatinput();
		
		// Formular-Daten auslesen und säubern
		$username		=	$this->clean(mb_ucfirst(strtolower($username)));
		$password		=	$this->clean($password);
		$startchannel	=	$this->clean($startchannel);
		$isChatAdmin	=	$this->isChatAdmin($username);
		
		// Statusabfragen
		$status = $this->checkUserLogin($username, $password);	// Login-Status abfragen
		$channel_exists = $channel->channelExists($startchannel);	// Prüfen, ob der gewählte Channel existiert
		$isJoinable = $channel->isJoinable($startchannel, $this->getUserLevel());	// Prüfen, ob der gewählte Channel "joinable" ist
		$isFull = ($channel->isFull($startchannel) && !$isChatAdmin);
		$limit_reached = ($config["userlimit"] > 0 && $channel->getAllOnlineUsers() >= $config["userlimit"] && !$isChatAdmin ) ? true : false;
		
		// Benutzer existiert nicht
		if ($status == 0) {
			session_destroy();
			sleep(3); // 3 Sekunden warten
			header("Location: ./?error=invalid");
			exit;
		}
		elseif ($status == 1 && $channel_exists && $isJoinable && !$isFull && !$limit_reached) {
			$channel->setChannelId($startchannel);	// Aktuellen Channel auf ID setzen
			$channel->addUser($this->getUserName(true), $this->getUserLevel());	// User dem Startchannel hinzufügen
			$this->setLastLogin();	// Letzten Login des Users auf NOW() setzen
			$channel->updateOnlineUsers();
			$chatinput->addSystemMsg(sprintf($language->translate("<i><b>%s</b> betritt den Chat!</i>"), $this->getUserName()));
		
			// In den Chat weiterleiten
			header("Location: chat.php");
			exit;
		}
		elseif ($status == 2) {
			session_destroy();
			sleep(3); // 3 Sekunden warten
			header("Location: ./?error=banned");
			exit;
		}
		elseif ($status == 3) {
			session_destroy();
			sleep(3); // 3 Sekunden warten
			header("Location: ./?error=inactive");
			exit;
		}
		elseif (!$channel_exists || !$isJoinable) {
			session_destroy();
			sleep(3); // 3 Sekunden warten
			header("Location: ./?error=channel_does_not_exist");
			exit;
		}
		elseif ($isFull) {
			session_destroy();
			sleep(3); // 3 Sekunden warten
			header("Location: ./?error=channel_is_full");
			exit;
		}
		elseif ($limit_reached) {
			session_destroy();
			sleep(3); // 3 Sekunden warten
			header("Location: ./?error=chat_is_full");
			exit;
		}
	}
	
	
	/**
	 * Deletes a user
	 * @param int $user_id
	 * @return boolean
	 */
	public function delete($user_id)
	{		
		global $db;
		
		$user_id = (int) $this->clean($user_id);
		$result = $this->result("SELECT id,username FROM {$db["user"]} WHERE id = {$user_id} AND level != '999'");
		
		if ($this->numRows($result) == 1) {
			$row = $this->fetchAssoc($result);
			$query = $this->query("DELETE FROM {$db["online"]} WHERE username = '{$row["username"]}'");
			$query = $this->query("DELETE FROM {$db["postings"]} WHERE username = '{$row["username"]}'");
			$query = $this->query("DELETE FROM {$db["userdetails"]} WHERE id = '{$row["id"]}'");
			$query = $this->query("DELETE FROM {$db["user"]} WHERE id = '{$row["id"]}'");
			return true;			
		}
		
		return false;
	}
}
?>