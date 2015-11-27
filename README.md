# Adblock-Message-for-Wordpress

## Fragen & Antworten
#### Was ist Adblock-Message?

Adblock-Message ist ein Shortcode Plugin für Wordpress. Es zeigt eine Nachricht an, wenn ein Besucher <u>keinen</u> Adblock installiert hat.

Dies ist ein Gegenbeispiel der Anti-Adblock Bewegung und ermöglicht es, Menschen die deinen Blog lesen, aufmerksam zu machen, über die Funktionen und positiven Seiten eines Adblockers. Es soll animieren mehr Adblocker zu nutzen und über die Rechte wie auch nutzen von nicht erwünschter Werbung und Spam nachzudenken.

Selbst Firefox wird bald einen fest eingebauten Adblocker einschalten (zur Zeit schon automatisch im Inkoknito Modus möglich), damit der Schritt, ein zusätzliches Plugin für den Browser zu installieren, automatisch entfällt.

#### Wer hat das gemacht?

Ich, der Bastler dieses kleinen Plugins :P

#### Warum hast Du das gemacht?

Da ich der Meinung bin, wenn ich im Internet unterwegs bin, selber das Recht zu haben, mich zu schützen, was ich als Seriös empfinde, was ich mir anschauen will, wen ich unterstütze und was meine Bedingen als Konsument, wie auch als Entwickler und Hoster freier und komerzieller Software zulasse.

Ich finde es eben so wichtig, zu informieren. Adblocks schützen meine privatsfähre und da hat jeder Nutzer ein Recht darauf.
Informieren heist auch für mich seriösität. Wenn meiner Oma erzählt wird, das weil sie einen Adblocker nutzt, sich "angeblich" strafbar macht, oder ein Anbieter ihr mit unseriösen Nachrichten erklären will, das ein Adblocker ein Virus sei, das sie schnell aus Ihrem Browser entfernen sollte? Davon halte ich nichts!

Ich sehe es als ein Grundverständnis an, das eigene System zu schützen und habe das Recht dazu!



# Funktionsweise

### standard = message (ohne Angaben)
Zeigt eine vordefinierte Box mit Verlinkung und Hinweisen, wenn der Besucher keinen Adblocker nutzt.

<pre>
Code:
[admessage action="message"]
</pre>
Vorschau:
<img src="https://raw.githubusercontent.com/McCouman/Adblock-Message-for-Wordpress/master/doc/img/standard.png" />


#### action = message (Nachricht)

* action="message" // Zeigt eine Box mit Informationen an, wenn kein Adblock installiert wurde.
* header="Wichtiger Hinweis!" // Überschrift der Box.
* info="Infos hier" // Hinweise und Informationen.
* button_text="Jetzt einen Adblocker installieren!" // Beschriftung der Box.
* link="http://domain.tld" // Angaben der URL bei Klick auf den Button.

<pre>
Beispiel Code:
[admessage action="message" header="Wichtiger Hinweis!" info="Infos hier" button_text="Jetzt einen Adblocker installieren!" link="http://domain.tld"]
</pre>


#### action = image (Bild anzeigen)

* action="image" // Hat der Besucher kein Adblock installiert, wird ein Bild angezeigt.
* image="http://domain.tld/meine_Admassage.jpg" // Hier wird die URL zum Bild festgelegt.
* width="auto" // * optional: hier kann die Breite des Bildes festgelegt werden. Bsp.: 650px (Standard: auto)
* height="auto" // * optional: hier kann die Höhe des Bildes festgelegt werden.  Bsp.: 120px (Standard: auto)
* link="http://domain.tld/mehr-infos" // * optional: Hier kann eine URL für weitere Infos angegeben werden.

<pre>
Beispiel Code:
[admessage action="image" image="http://domain.tld/meine_Admassage.jpg" width="auto" height="auto" link="#"]
</pre>
Vorschau:
<img src="https://raw.githubusercontent.com/McCouman/Adblock-Message-for-Wordpress/master/doc/img/image.png" />



#### action = redirect (Weiterleitung)

* action="redirect" // Leitet den Besucher ohne Nachricht direkt an eine vergebene URL weiter.
* link="http://google.de" // Hier muss die URL zu mehr Informationen eingetragen werden.

<pre>
Beispiel Code:
[admessage action="redirect" link="http://google.de"]
</pre>


#### action = alternate (Eigene Angaben)

* action="alternate" // Ermöglicht dir, eine eigene Info-Box per html und eigenen id-, class- Angaben.
* info="Dein Text hier!" // Diese Angaben werden angezeigt, wenn kein Adblocker aktiviert wurde.
Info: für die Fraktion der Gegenspieler, kann im Code auch text="" aktiviert werden. So können auch Informationen für aktivierte Adblocks angezeigt werden.

<pre>
Beispiel Code:
[admessage action="alternate" info="Dein Text hier! Er wird angezeigt wenn kein Adblock aktiviert wurde."]
</pre>


#### CSS Ändern

Hier kannst Du das CSS der Box anpassen, wenn Du keine anderen Möglichkeit hast oder kennst.

CSS ID's:
* #info
* #left
* #right
* #button

<pre>
Beispiel Code:
[admessage  ...  css="#info {padding: 20px 24px 0px;background:#ffe;border: 1px solid #E2E202;}#left{float:left;width:70%;}#right{float: right;margin-top:37px;}#button{border:1px solid #aa0;background:#ff6;color:#000;padding:12px;}"]
</pre>

Vorschau:
<img src="https://raw.githubusercontent.com/McCouman/Adblock-Message-for-Wordpress/master/doc/img/css.png">
