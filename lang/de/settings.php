<?php

/**
 * @license    GPL 3 (http://www.gnu.org/licenses/gpl.html)
 * 
 * @author cziehr <info@einsatzleiterwiki.de>
 */
$lang['seconds']     = 'Standard-Zeit (in Sekunden), bis zur verwiesenen Seite weitergeleitet wird';
$lang['minSeconds']  = 'Minimale Zeit (in Sekunden), nach der auf die verwiesene Seite weitergeleitet wird (zur Beschränkung bei manueller Festlegung der Weiterleitungs-Zeit)';
$lang['auto_login'] = 'Nach dem Login automatisch zu einer vordefinierten Seite wechseln, wie in der Einstellung <code>auto_options</code> und/oder <code>group options</code> festgelegt.';
$lang['auto_options'] = 'Ziel für die auto_login-Seite. In jedem Fall entspricht die Variable <b>user</b> dem Benutzernamen.' .
         'Falls der Benutzername "foo" lautet, dann ist ":user_page" die Seite ":foo"; '  .
		 ' "user_ns:user_page" ist ":foo:foo"; ":user_ns:start_page" ist ":foo:start". Der <b>common_ns</b> ' .
		 'wird bei der Option <code>common_ns</code> eingestellt.';
$lang['common_ns'] = 'Ein frei definierbarer Namensraum mit beliebiger Tiefe, in de alle auto login-Seiten abgelegt werden. Er kann den Platzhalter <code>user_ns<code> enthalten.';		 
$lang['group'] = 'Eine kommaseparierte Liste von Namensräumen für Benutzergruppen, zu denen der Benutzer weitergeleitet werden kann. Verschiedene Benutzer können in unterschiedlichen Gruppen sein. Wenn ein Benutzer Mitglied in mehreren Gruppen der Liste ist, wird er auf die Seite der ersten Gruppe weitergeleitet.';
$lang['group_options'] = "Der Benutzer kann entweder zur Startseite der Gruppe oder zu seiner persönlichen Seite weitergeleitet werden.";
$lang['only_option'] = '<b><code>group</code></b> leitet nur auf Namensräume und Seiten von Benutzergruppen weiter; ' .
          '<b><code>user</code></b> zu Namensräumen und Seiten von Benutzern; ' .
		  ' und <b><code>default</code></b> zu beiden, wobei Benutzergruppen Vorrang haben.';
