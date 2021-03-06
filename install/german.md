# LegionBoard Heart installieren

*Das ist die deutsche Version des Installations-Leitfaden. Übersetzungen
sind für folgende Sprachen verfügbar: [English](english.md)*

**Achtung: Im März 2019 wurde die Entwicklung von LegionBoard offiziell
eingestellt. Es wird ausdrücklich empfohlen,
keine neuen Instanzen von LegionBoard aufzusetzen.**

Dieses Dokument wird Sie durch die Installation von LegionBoard Heart führen.
Sie können die Online-Version auf
[GitLab](https://gitlab.com/legionboard/heart/blob/master/install/german.md) und
[GitHub](https://github.com/legionboard/heart/blob/master/install/german.md) finden.
Wenn Sie einen Fehler entdecken oder eine Frage haben, zögern Sie nicht,
einen Issue auf [GitLab](https://gitlab.com/legionboard/heart/issues) zu öffnen
oder mir eine [E-Mail zu schicken](mailto:nicoalt@posteo.org).

## Herunterladen

Sie können LegionBoard Heart entweder von
[GitLab](https://gitlab.com/legionboard/heart/tags) oder von
[GitHub](https://github.com/legionboard/heart/releases) herunterladen.
Stellen Sie sicher, dass Sie nicht aus Versehen eine Beta-Version
herunterladen. Entpacken Sie das Archiv, nachdem Sie es heruntergeladen
haben.

## Konfigurieren

Gehen Sie anschließend in den Order "src/LegionBoard" des entpackten Archivs und
benennen die Datei "configuration-template.ini" in "configuration.ini" um.
Danach müssen Sie "configuration.ini" mit einem Text-Editor öffnen und die
Daten für Ihren MySQL-Server eintragen.

## Benutzer-Erstellungs-Werkzeug vorbereiten

Um Nutzer zu erstelllen, müssen Sie das dazu benötigte Werkzeug vorbereiten,
bevor Sie Heart auf Ihren Server hochladen. Um dies zu tun, müssen Sie den
Ordner "src/LegionBoard/tools" nach "src" verschieben, sodass man das Benutzer-Erstellungs-Werkzeug
in "src/tools" finden kann. Für erhöhte Sicherheit sollten Sie den Ordner
"tools" in etwas zufälliges umbenennen.

## Auf Server hochladen

Öffnen Sie dazu das Programm, das Sie normalerweise benutzen, um Dateien
auf Ihren Server hochzuladen, wie zum Beispiel
[FileZilla](https://filezilla-project.org/), und laden Sie den kompletten
"src" Order hoch. Ich empfehle, ihn in "heart" umzubenennen und in
den Order "legionboard" zu verschieben.

## Benutzer erstellen

Öffnen Sie das Benutzer-Erstellungs-Werkzeug in Ihrem Browser. Geben Sie
anschließend den Benutzernamen und das dazugehörige Passwort ein. Wenn Sie
einen Admin erstellen wollen, geben Sie "%" in das Gruppen-Feld ein. Wenn
Sie einen Schüler erstellen wollen, geben Sie "0,4,10,16" in das Gruppen-Feld
ein.

Vergessen Sie nicht, das Benutzer-Erstellungs-Werkzeug nach dem Erstellen
aller Benutzer zu löschen!
