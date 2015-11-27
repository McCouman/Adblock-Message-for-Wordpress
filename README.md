# Adblock-Message-for-Wordpress
Zeigt eine Nachricht an, wenn Adblock <u>nicht</u> installiert wurde.





#### standard = message (ohne Angaben)
Zeigt eine vordefinierte Box mit Verlinkung und Hinweisen, wenn der Besucher keinen Adblocker nutzt.

<pre>
Code:
[admessage action="message"]
</pre>

### action = message (Nachricht)

* action="message" // Zeigt eine Box mit Informationen an, wenn kein Adblock installiert wurde.
* header="Wichtiger Hinweis!" // Überschrift der Box.
* info="Infos hier" // Hinweise und Informationen.
* button_text="Jetzt einen Adblocker installieren!" // Beschriftung der Box.
* link="http://domain.tld" // Angaben der URL bei Klick auf den Button.

<pre>
Code:
[admessage action="message" link="#"]
</pre>


### action = image (Bild anzeigen)

* action="image" // Hat der Besucher kein Adblock installiert, wird ein Bild angezeigt.
* image="http://domain.tld/meine_Admassage.jpg" // Hier wird die URL zum Bild festgelegt.
* width="auto" // * optional: hier kann die Breite des Bildes festgelegt werden. Bsp.: 650px (Standard: auto)
* height="auto" // * optional: hier kann die Höhe des Bildes festgelegt werden.  Bsp.: 120px (Standard: auto)
* link="http://domain.tld/mehr-infos" // * optional: Hier kann eine URL für weitere Infos angegeben werden.

<pre>
Code:
[admessage action="image" image="http://domain.tld/meine_Admassage.jpg" width="auto" height="auto" link="#"]
</pre>


### action = redirect (Weiterleitung)

* action="redirect" // Leitet den Besucher ohne Nachricht direkt an eine vergebene URL weiter.
* link="http://google.de" // Hier muss die URL zu mehr Informationen eingetragen werden.

<pre>
Code:
[admessage action="redirect" link="http://google.de"]
</pre>


### action = alternate (Eigene Angaben)

* action="alternate" // Ermöglicht dir, eine eigene Info-Box per html und eigenen id-, class- Angaben.
* info="Dein Text hier!" // Diese Angaben werden angezeigt, wenn kein Adblocker aktiviert wurde.
Info: für die Fraktion der Gegenspieler, kann im Code auch text="" aktiviert werden. So können auch Informationen für aktivierte Adblocks angezeigt werden.

<pre>
Code:
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
Code:
[admessage ... css="#info {padding: 20px 24px 0px;background:#ffe;border: 1px solid #E2E202;}#left{float:left;width:70%;}#right{float: right;margin-top:37px;}#button{border:1px solid #aa0;background:#ff6;color:#000;padding:12px;}"]
</pre>
