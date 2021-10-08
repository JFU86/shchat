pragma foreign_keys = off;
/* SPLIT */
BEGIN transaction;
/* SPLIT */
pragma auto_vacuum=0;
/* SPLIT */
pragma encoding='UTF-8';
/* SPLIT */
pragma page_size=1024;
/* SPLIT */
DROP TABLE if EXISTS [main].[language];
/* SPLIT */
CREATE TABLE [main].[language] (
  [id] INTEGER NOT NULL PRIMARY KEY, 
  [de] TEXT NOT NULL UNIQUE, 
  [en] TEXT);
/* SPLIT */
INSERT INTO [main].[language] VALUES(1, 'Nickname', 'Nickname');
/* SPLIT */
INSERT INTO [main].[language] VALUES(2, 'Passwort', 'Password');
/* SPLIT */
INSERT INTO [main].[language] VALUES(3, 'Channel', 'Channel');
/* SPLIT */
INSERT INTO [main].[language] VALUES(4, 'Passwort vergessen', 'Lost password');
/* SPLIT */
INSERT INTO [main].[language] VALUES(5, 'anmelden', 'login');
/* SPLIT */
INSERT INTO [main].[language] VALUES(6, 'Neues Benutzerkonto anlegen', 'Create new account');
/* SPLIT */
INSERT INTO [main].[language] VALUES(7, 'Channelübersicht', 'Channel overview');
/* SPLIT */
INSERT INTO [main].[language] VALUES(8, 'Du wurdest wegen Inaktivität in den AWAY-Modus versetzt.', 'You were set to AWAY mode due to inactivity.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(9, 'Registrierung', 'Registration');
/* SPLIT */
INSERT INTO [main].[language] VALUES(10, 'Passwort wiederholen', 'Retype password');
/* SPLIT */
INSERT INTO [main].[language] VALUES(11, 'E-Mail Adresse', 'Email address');
/* SPLIT */
INSERT INTO [main].[language] VALUES(12, 'versteckt', 'hidden');
/* SPLIT */
INSERT INTO [main].[language] VALUES(13, 'Geschlecht', 'Gender');
/* SPLIT */
INSERT INTO [main].[language] VALUES(14, 'männlich', 'male');
/* SPLIT */
INSERT INTO [main].[language] VALUES(15, 'weiblich', 'female');
/* SPLIT */
INSERT INTO [main].[language] VALUES(16, 'Sicherheitscode', 'Security code');
/* SPLIT */
INSERT INTO [main].[language] VALUES(17, 'Mit der Registrierung akzeptierst du die gültigen Nutzungsbedingungen', 'By registration you accept the current terms of use');
/* SPLIT */
INSERT INTO [main].[language] VALUES(18, 'Nach Abschluss der Registrierung erhälst du eine E-Mail, über die das neue Benutzerkonto zunächst aktiviert werden muss, bevor du den Chat betreten kannst.', 'After registration you will receive an email in which you will be asked to activate your new account, before you can start using the chat.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(19, 'zurück', 'back');
/* SPLIT */
INSERT INTO [main].[language] VALUES(20, 'Registrierung abschließen', 'Complete registration');
/* SPLIT */
INSERT INTO [main].[language] VALUES(21, 'schließen', 'close');
/* SPLIT */
INSERT INTO [main].[language] VALUES(22, 'Wenn du dein Passwort vergessen hast, kannst du hier unter Angabe deiner E-Mail Adresse und dem Benutzernamen ein neues Passwort anfordern.', 'If you have lost your password, you can ask for a new one entering your email address and user name.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(23, 'Neues Passwort zusenden', 'Send new password');
/* SPLIT */
INSERT INTO [main].[language] VALUES(24, 'Chatinfo', 'Chat info');
/* SPLIT */
INSERT INTO [main].[language] VALUES(25, 'Wer ist online?', 'Who is online?');
/* SPLIT */
INSERT INTO [main].[language] VALUES(26, 'Benutzerliste', 'Userlist');
/* SPLIT */
INSERT INTO [main].[language] VALUES(27, 'Top 10', 'Top 10');
/* SPLIT */
INSERT INTO [main].[language] VALUES(28, 'willkommen im Chat!', 'welcome to the chat!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(29, 'CHAT WIRD GELADEN', 'CHAT IS LOADING');
/* SPLIT */
INSERT INTO [main].[language] VALUES(30, 'Smileys', 'Smileys');
/* SPLIT */
INSERT INTO [main].[language] VALUES(31, 'Autoscroll', 'Autoscroll');
/* SPLIT */
INSERT INTO [main].[language] VALUES(32, 'Profil', 'Profile');
/* SPLIT */
INSERT INTO [main].[language] VALUES(33, 'Administration', 'Administration');
/* SPLIT */
INSERT INTO [main].[language] VALUES(34, 'Hilfe', 'Help');
/* SPLIT */
INSERT INTO [main].[language] VALUES(35, 'verlassen', 'Logout');
/* SPLIT */
INSERT INTO [main].[language] VALUES(36, 'Registriert seit', 'Registered since');
/* SPLIT */
INSERT INTO [main].[language] VALUES(37, 'Geschriebene Zeichen', 'Written characters');
/* SPLIT */
INSERT INTO [main].[language] VALUES(38, 'Rang', 'Rank');
/* SPLIT */
INSERT INTO [main].[language] VALUES(39, 'Gesamt', 'total');
/* SPLIT */
INSERT INTO [main].[language] VALUES(40, 'Status', 'Status');
/* SPLIT */
INSERT INTO [main].[language] VALUES(41, 'Chatzeit', 'Chat time');
/* SPLIT */
INSERT INTO [main].[language] VALUES(42, 'Zeichen', 'Characters');
/* SPLIT */
INSERT INTO [main].[language] VALUES(43, 'Dein Profil', 'Your profile');
/* SPLIT */
INSERT INTO [main].[language] VALUES(44, 'Passwort ändern', 'Change password');
/* SPLIT */
INSERT INTO [main].[language] VALUES(45, 'Freiwillige Angaben', 'Optional information');
/* SPLIT */
INSERT INTO [main].[language] VALUES(46, 'Echter Name', 'Real name');
/* SPLIT */
INSERT INTO [main].[language] VALUES(47, 'Wohnort', 'Location');
/* SPLIT */
INSERT INTO [main].[language] VALUES(48, 'Geburtsdatum', 'Date of birth');
/* SPLIT */
INSERT INTO [main].[language] VALUES(49, 'Über mich', 'About me');
/* SPLIT */
INSERT INTO [main].[language] VALUES(50, 'speichern', 'save');
/* SPLIT */
INSERT INTO [main].[language] VALUES(51, 'Chat Administration', 'Chat Administration');
/* SPLIT */
INSERT INTO [main].[language] VALUES(52, 'Benutzer', 'Users');
/* SPLIT */
INSERT INTO [main].[language] VALUES(53, 'Chat', 'Chat');
/* SPLIT */
INSERT INTO [main].[language] VALUES(54, 'Update', 'Update');
/* SPLIT */
INSERT INTO [main].[language] VALUES(55, 'Benutzerlimit', 'User limit');
/* SPLIT */
INSERT INTO [main].[language] VALUES(56, 'Mindestrang', 'Minimum rank');
/* SPLIT */
INSERT INTO [main].[language] VALUES(57, 'moderiert', 'moderated');
/* SPLIT */
INSERT INTO [main].[language] VALUES(58, 'Channel erstellen', 'Create channel');
/* SPLIT */
INSERT INTO [main].[language] VALUES(59, 'Channel löschen', 'Delete channel');
/* SPLIT */
INSERT INTO [main].[language] VALUES(60, 'Administration schließen', 'Close Administration');
/* SPLIT */
INSERT INTO [main].[language] VALUES(61, 'Whois Abfrage für', 'Whois request for');
/* SPLIT */
INSERT INTO [main].[language] VALUES(62, 'Alter', 'Age');
/* SPLIT */
INSERT INTO [main].[language] VALUES(63, 'Channel editieren', 'Edit channel');
/* SPLIT */
INSERT INTO [main].[language] VALUES(64, 'Channel Name', 'Channel name');
/* SPLIT */
INSERT INTO [main].[language] VALUES(66, 'Schreibrechte', 'Write permission');
/* SPLIT */
INSERT INTO [main].[language] VALUES(67, 'Nicht moderiert', 'not moderated');
/* SPLIT */
INSERT INTO [main].[language] VALUES(68, 'Nicht versteckt', 'not hidden');
/* SPLIT */
INSERT INTO [main].[language] VALUES(69, 'Willkommensnachricht', 'Welcome message');
/* SPLIT */
INSERT INTO [main].[language] VALUES(70, 'abbrechen', 'abort');
/* SPLIT */
INSERT INTO [main].[language] VALUES(71, 'Benutzerprofil von', 'User profile of');
/* SPLIT */
INSERT INTO [main].[language] VALUES(72, 'Benutzername', 'Username');
/* SPLIT */
INSERT INTO [main].[language] VALUES(73, 'E-Mail', 'Email');
/* SPLIT */
INSERT INTO [main].[language] VALUES(74, 'zum Ändern ausfüllen', 'fill out to change');
/* SPLIT */
INSERT INTO [main].[language] VALUES(75, 'Registriert am', 'Registered since');
/* SPLIT */
INSERT INTO [main].[language] VALUES(76, 'Letzte Anmeldung', 'Last login');
/* SPLIT */
INSERT INTO [main].[language] VALUES(77, 'Client Info', 'Client info');
/* SPLIT */
INSERT INTO [main].[language] VALUES(78, 'Benutzer löschen', 'Delete user');
/* SPLIT */
INSERT INTO [main].[language] VALUES(79, 'ausführen', 'execute');
/* SPLIT */
INSERT INTO [main].[language] VALUES(80, 'Hat keine Wirkung bei Administratoren!', 'Does not work for administrators!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(81, 'Benutzer wirklich unwiderruflich löschen? Es werden alle Beiträge und Benutzerdaten entfernt.', 'Do you really want to permanently delete this user? All entries and user data will be deleted.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(82, 'Administrative Aktionen', 'Administrative actions');
/* SPLIT */
INSERT INTO [main].[language] VALUES(83, 'Chatlog löschen', 'Delete chat log');
/* SPLIT */
INSERT INTO [main].[language] VALUES(84, 'Alle Einträge im Chat, die älter als heute sind werden unwiderruflich aus dem Log gelöscht.', 'All entries in the chat, older then today will be removed from the log.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(85, 'Unbestätigte Benutzer löschen', 'Delete unconfirmed users');
/* SPLIT */
INSERT INTO [main].[language] VALUES(86, 'Es werden alle Benutzer gelöscht, die Ihre Benutzer-Registrierung nicht innerhalb von 7 Tagen per E-Mail bestätigt haben.', 'All unconfirmed users that did not complete the registration within 7 days will be deleted.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(87, 'Inaktive Benutzer löschen', 'Delete inactive users');
/* SPLIT */
INSERT INTO [main].[language] VALUES(88, 'Es werden alle Benutzer gelöscht, die länger als 60 Tage nicht aktiv waren.', 'All users that are inactive for more than 60 days will be deleted.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(89, 'Chatlog wirklich löschen?', 'Do you really want to delete the chat log?');
/* SPLIT */
INSERT INTO [main].[language] VALUES(90, 'Unbestätigte Benutzer wirklich löschen?', 'Do you really want to delete unconfirmed users?');
/* SPLIT */
INSERT INTO [main].[language] VALUES(91, 'Inaktive Benutzer löschen?', 'Do you really want to delete inactive users?');
/* SPLIT */
INSERT INTO [main].[language] VALUES(92, 'Wenn Sie nach Updates suchen, wird eine Verbindung zum Updateserver hergestellt. Dies dient lediglich der Versionsprüfung und es werden dabei keine Benutzer-Informationen übermittelt oder gespeichert.', 'When you are looking for updates, a connection to our update server is established. This is only for the version check and there will be no user information transmitted or stored.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(93, 'Updates suchen', 'Update check');
/* SPLIT */
INSERT INTO [main].[language] VALUES(94, 'Sie besitzen bereits die aktuellste Version! Es ist kein Update notwendig.', 'You already have the latest version! There is no update needed.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(95, 'Es ist online eine neuere Version verfügbar!', 'There is a newer version available online!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(97, 'Guten Morgen', 'Good morning');
/* SPLIT */
INSERT INTO [main].[language] VALUES(98, 'Guten Tag', 'Good day');
/* SPLIT */
INSERT INTO [main].[language] VALUES(96, 'Guten Abend', 'Good evening');
/* SPLIT */
INSERT INTO [main].[language] VALUES(99, 'Dein Passwort darf nicht leer sein!', 'The password may not be empty!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(100, 'Das Passwort muss mindestens 6 Zeichen haben!', 'You password must have at least 6 characters!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(101, 'Der gewünschte Benutzername ist nicht verfügbar!', 'The requested username is not available!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(102, 'Die E-Mail-Adresse ist ungültig!', 'This email address is not valid!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(103, 'Der Sicherheitscode ist falsch!', 'The security code is wrong!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(104, 'Bitte wähle dein Geschlecht!', 'Please choose your gender!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(105, 'Die Passwörter sind nicht identisch!', 'The passwords are not equal!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(106, 'Bitte melde dich im Chat an, um die Benutzerliste zu sehen.', 'Please log in to the chat to view the user list.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(107, 'Stunden', 'Hours');
/* SPLIT */
INSERT INTO [main].[language] VALUES(108, 'Minuten', 'Minutes');
/* SPLIT */
INSERT INTO [main].[language] VALUES(109, 'Sekunden', 'Seconds');
/* SPLIT */
INSERT INTO [main].[language] VALUES(110, 'unbestätigt', 'unconfirmed');
/* SPLIT */
INSERT INTO [main].[language] VALUES(112, 'Dieses Konto wurde vom Benutzer nicht aktiviert!', 'This account has not been activated by the user!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(113, 'Administratoren können nicht gelöscht werden!', 'Administrators cannot be deleted!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(115, 'Der Benutzer <b>%s</b> wurde nicht gefunden!', 'The user <b>%s</b> was not found!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(116, 'Der Channel <b>%s</b> wurde nicht gefunden!', 'The channel <b>%s</b> was not found!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(117, '<i><b>%s</b> verlässt den Channel!</i>', '<i><b>%s</b> left the channel!</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(118, '<i><b>%s</b> betritt den Channel!</i>', '<i><b>%s</b> joined the channel!</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(119, '<i><b>%s</b> ist nun abwesend! Grund: %s</i>', '<i><b>%s</b> is now away! Reason given: %s</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(120, 'Der Benutzer <b>%s</b> ist Administrator und kann nicht entmachtet werden!', 'The user <b>%s</b> is administrator and cannot be demoted!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(121, 'Der Benutzer <b>%s</b> hat bereits einen höheren Level!', 'The user <b>%s</b> already has a higher level!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(122, 'Der Benutzer <b>%s</b> ist Administrator und kann nicht gekickt werden!', 'The user <b>%s</b> is administrator and cannot be kicked!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(123, 'Der Benutzer <b>%s</b> ist Administrator und kann nicht verbannt werden!', 'The user <b>%s</b> is administrator and cannot be banned!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(125, 'Dieser Benutzer lässt sich das Reden nicht verbieten!', 'This user cannot be silenced!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(126, 'Hast du lange Weile oder warum lädst du dich selber ein?', 'Are you bored or why are you inviting yourself?');
/* SPLIT */
INSERT INTO [main].[language] VALUES(128, 'Ungültige Farbe: <b>%s</b> (Bsp: #000000)', 'Invalid color: <b>%s</b> (i.e. #000000)');
/* SPLIT */
INSERT INTO [main].[language] VALUES(129, 'Dieser Channel ist nun moderiert!', 'This channel is now moderated!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(130, 'Dieser Channel ist nun nicht mehr moderiert!', 'This channel is not moderated anymore!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(131, 'Dieser Channel ist nun versteckt!', 'This channel is now hidden!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(132, 'Dieser Channel ist nun nicht mehr versteckt!', 'This channel is no longer hidden!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(133, 'Dieser Channel ist nun auf %s Benutzer limitiert!', 'This channel is now limited to %s users!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(134, 'Dieser Channel hat nun kein Benutzerlimit mehr!', 'This channel no longer has a user limit!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(135, '<b>%s</b> wurde von %s für %s Minuten die Redeerlaubnis entzogen!', '<b>%s</b> revoked %s''s privilege to talk for %s minutes!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(136, '<b>%s</b> darf nun wieder sprechen!', '<b>%s</b> may now talk again!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(137, 'Der Benutzer hat keine Nachricht hinterlassen.', 'This user left no away message.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(138, '<i><b>%s</b> ist nun abwesend!</i>', '<i><b>%s</b> is now away!</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(139, '<i><b>%s</b> ist wieder da!</i>', '<i><b>%s</b> is back again!</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(141, '<b>%s</b> flüstert', '<b>%s</b> whispers');
/* SPLIT */
INSERT INTO [main].[language] VALUES(142, 'Führst du Selbstgespräche?', 'Why are you talking to yourself?');
/* SPLIT */
INSERT INTO [main].[language] VALUES(143, '<i><b>%s</b> betritt den Chat!</i>', '<i><b>%s</b> joined the chat!</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(144, '<i><b>%s</b> verlässt den Chat!</i>', '<i><b>%s</b> left the chat!</i>');
/* SPLIT */
INSERT INTO [main].[language] VALUES(145, 'Ihr flüstert', 'You whisper');
/* SPLIT */
INSERT INTO [main].[language] VALUES(146, 'Broadcast von', 'Broadcast from');
/* SPLIT */
INSERT INTO [main].[language] VALUES(147, 'SESSION ABGELAUFEN!', 'SESSION EXPIRED!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(148, 'Mögliche Ursachen: Du wurdest aus dem Chat gekickt oder warst zu lange inaktiv.', 'Possible reasons: You were kicked out of the chat or you were inactive for too long.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(149, 'Zur Startseite wechseln', 'Go to main page');
/* SPLIT */
INSERT INTO [main].[language] VALUES(150, 'Dir wurde bis %s Redeverbot erteilt!', 'You are banned on speaking until %s!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(151, 'Du hast in diesem Channel keine Schreibrechte!', 'You don''t have writing permissions in this channel!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(152, 'Bitte fülle alle Felder aus!', 'Please fill all fields!');
/* SPLIT */
INSERT INTO [main].[language] VALUES(153, 'In deinem Browser ist JavaScript deaktiviert und der Chat ist somit nicht funktionsfähig. Bitte aktiviere JavaScript und versuche es erneut.', 'JavaScript is not activated in your web browser. Please activate it to use the chat.');
/* SPLIT */
INSERT INTO [main].[language] VALUES(154, 'Fehler', 'Error');
/* SPLIT */
COMMIT transaction;
/* SPLIT */
pragma foreign_keys = on;