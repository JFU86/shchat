/*
	SHChat
	(C) by Scripthosting.net
	http://www.shchat.net

	Free for non-commercial use:
	Licensed under the "Creative Commons 3.0 BY-NC-SA"
	http://creativecommons.org/licenses/by-nc-sa/3.0/
	
	Support-Forum: http://board.scripthosting.net/viewforum.php?f=18
	Don't send emails asking for support!!
*/

Welcome to this release of SHChat! Thank you for using this software.
Willkommen zu diesem Release des SHChat! Vielen Dank, dass Sie diese Software einsetzen.


====================
SYSTEM REQUIREMENTS:
====================

PHP 5.3.3+, MySQL 5.0+


=============
INSTALLATION:
=============

Der Ordner /system benötigt volle Schreibrechte (chmod 777).
Die Installation startet beim ersten Aufruf des Chats (index.php oder install.php) im Browser.
Löschen Sie nach Abschluss der Installation den Ordner /install und die install.php im Hauptverzeichnis.


Bei Fragen und Anregungen besuchen Sie bitte unser Support-Forum unter:
http://board.scripthosting.net/viewforum.php?f=18


=================
Versionshinweise:
=================

1.1.0
- Neues und modernes Standard-Template "modern-grey" mit überarbeiteter Optik und vielen Verbesserungen im Chat und Adminbereich (HTML5)
- Das ehemalige Standard-Template "default-grey" wird nicht mehr weiterentwickelt, kann aber durch das Update (Updatepaket) weiterhin verwendet werden
- Die Systemanforderung (minimum) steigt auf PHP 5.3.3 und MySQL 5.0 (oder höher)
- Ein neuer Spamschutz verhindert zu viele Einträge in kürzester Zeit (modern-grey)
- Benutzer werden nach einer gewissen Abwesenheitszeit automatisch in den AWAY-Modus versetzt (modern-grey)
- Neue Nutzungsbedingungen hinzugefügt, die bei der Registrierung akzeptiert werden müssen (modern-grey)
- MooTools-Core auf Version 1.5.1 aktualisiert (modern-grey)
- Der neue Templateübergreifende Ordner /templates/global ist für alle Dateien, die von mehreren Templates verwendet werden können
- Lokalisierung auf Template-Ebene: Templates können direkt lokalisiert werden, was die Mehrsprachigkeit erheblich vereinfacht
- Viele interne Detailverbesserungen in der Codebasis


1.0.0
- Dies ist die letzte Version mit den alten Systemanforderungen! Für mehr Informationen lesen Sie bitte diese Ankündigung
- Aufgrund der verbesserten Technik ist nun mindestens PHP 5.2.9 erforderlich!
- Der Chat ist nun komplett in Unicode und unterstützt somit viele internationale Schriftzeichen! Bei einem Update von älteren Versionen ist ein Datenbankupdate durch Aufruf des Installers notwendig und auch die config-Datei muss ebenfalls neu erstellt werden!
- Integration des MooTools Frameworks in den Chat
- Neue Felder für userdetails, die im Profil verändert werden können: Name, Wohnort, Geburtsdatum, Beschreibung
- Der Updater sucht nun erst nach Bestätigung nach Updates
- Diverse kleine Programm- und Codeoptimierungen
- Verbesserungen in der Stabilität und Geschwindigkeit
- Neues Crypto-Modul ermöglicht hochgradige Datenverschlüsselung mit AES
- Das Smiley-Menü hat eine Scrollbar bekommen, wenn sehr viele Smileys zur Verfügung stehen
- Eine Verbesserung in der Mail-Funktion soll mögliche Probleme mit älteren Versionen beheben
- https und ftp links werden im Chat nun auch umgewandelt
- Das Standardesign "default-grey" wurde überarbeitet und hat einige Verbesserungen erfahren
- Die Dateistruktur hat sich grundlegend geändert:
- /include ist nun unter /templates/*/php zu finden
- * Die HTML-Templates befinden sich nun unter /templates/*/html
- * Die config.inc.php befindet sich unter /system/config/
- * Der Ordner /system benötigt volle Schreibrechte
- Kleine Optimierungen im Installer Template
- Die Datei system/version.php ist nun veraltet und wird durch system/version.inc.php ersetzt


0.9.0 Final
- Codeoptimierung hinsichtlich PHP 5.3
- Es wurden ein paar kleinere Fehler behoben
- Es wurde ein Fehler behoben, durch den das Benutzerlimit nicht korrekt berücksichtigt wurde
- Es ist _kein_ Datenbankupdate von RC3 auf Final notwendig!
- Chat: Operatoren können nach einem Update (Installer->"Update") nun wie vorgesehen die Befehle /chanop und /dechanop ausführen
- Chat: Benutzer können nun ihr Profil bearbeiten
- Install: Beim Administrator wird nach einer neuen Installation nun das korrekte Registrierungsdatum angezeigt
- Chat: Es wurde ein Fehler behoben, der auf WebKit basierenden Browsern einen fehlerhaften Style auslöste
- Admin: Benutzerverwaltung erweitert
- Chatframe: Rechtes Menü überarbeitet
- Chat: Toplisten (Top10) für Chatzeit und Zeichen
- Chat: Passwort vergessen? Funktion ermöglicht das Zusenden eines neuen Passworts

0.8.1 beta
- Reaktionszeit beim Schreiben reduziert (Firefox 3.5 fix)

0.8.0 beta
- Die Benutzer-Registrierung muss nun per E-Mail aktiviert werden (Datenbank Update notwendig!)
- Die Benutzerliste kann nur noch eingeloggt ausgelesen werden
- Fehlerkorrektur im Adminbereich
- Userlimit für den gesamten Chat einstellbar
- Admin: Benutzer- und Chat-Menü hinzugefügt

0.7.4 beta
- Adminbereich überarbeitet (noch nicht vollständig)
- Update-Tool integriert
- Wenn "old_lines" aktiviert wurde, werden maximal 24 Stunden alte Beiträge angezeigt
- Zu lange URLs werden im Chat nun in der Ausgabe gekürzt

0.7.3 beta
- Die Smileyleiste im Chat zeigt nun nur noch eine limitierte Anzahl an Smileys (Standard: 25)
- Eine Smileybox öffnet beim Klick auf den Button "Smileys"

0.7.2 beta
- "Join" ist nun leicht zeitverzögert
- "serialnumber" in der config hinzugefügt
- Channel-Operatoren können nun nichtmehr /ban oder /s ausführen
- Operatoren können nun /chanop und /dechanop ausführen

0.7.1 beta
- {servername} in der config hinzugefügt
- Neue Datei: /include/{templateName}/chat.inc.php bestimmt den Aufbau der Chatframe im Template
- Das + Zeichen kann im Chat nun verwendet werden

0.7.0 beta
- "old_lines" optional in der config einstellbar
- Registrierung versendet eine E-Mail
- index.php enthält nun register,whois,whoisonline,userlist und help
- Installer um einen Config Updater erweitert
- Update der Lokalisierungsstruktur

0.6.1 beta
- Verbesserung für den Chat-Filter

0.6.0 beta
- Installations-Tool integriert
- Channel-Namen mit Leerzeichen funktionieren nun korrekt

0.5.5 beta
- Bugfix release

0.5.4 beta
- Vorbereitungen für die Lokalisierung
- Bugfixes

0.5.3 beta
- URLs im Chat sind nun anklickbar

0.5.2 beta
- Login-Verbesserung

0.5.1 beta
- AJAX Verbesserungen

0.5.0 beta
- Chatframe komplett überarbeitet
- Neue Smiley Verwaltung
- Template-Erweiterungen
- Bugfixes

0.4.3 alpha
- Wichtiges Sicherheitsupdate für Filter!

0.4.2 alpha
- Template-Erweiterungen
- Bugfixes aus Version 0.4.1
- Registrierung mit Captcha Code erweitert

0.4.1 alpha
- Template-Erweiterungen
- Bugfixes aus Version 0.4.0

0.4.0 alpha
- Templates, Komplettüberarbeitung des Designmusters
- Bugfixes aus Version 0.3.0
- Der Internet Explorer wird nun vollständig unterstützt

0.3.0 alpha
- erste Releaseversion, keine Vorversion vorhanden