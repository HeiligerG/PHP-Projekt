# **WorkingDir Changelog** 🛠️

Ein Entwicklungsbereich für experimentelle Änderungen und kleinere Updates. Dieser Changelog bietet eine Übersicht über alle durchgeführten Änderungen, die später in das Hauptverzeichnis integriert werden können.

---

## **Inhaltsverzeichnis**
1. [Überblick](#überblick)
2. [Features und Änderungen](#features-und-änderungen)
   - [Aktuelle Änderungen](#aktuelle-änderungen)
   - [Vergangene Änderungen](#vergangene-änderungen)
3. [Ideensammlung](#ideensammlung)
4. [Technologien](#technologien)
5. [Sicherheit](#sicherheit)
6. [Kontakt](#kontakt)

---

## **Überblick**
Das `WorkingDir` dient als Entwicklungsumgebung für das Projekt. Hier werden neue Funktionen getestet und kleinere Anpassungen vorgenommen. Nur wesentliche und geprüfte Änderungen werden später in das Hauptverzeichnis übernommen.

---

## **Features und Änderungen**

### **Aktuelle Änderungen**
> Änderungen der letzten Tage – fortlaufend aktualisiert.

---

### **Vergangene Änderungen**
> Abgeschlossene Änderungen, die dokumentiert bleiben sollen.

- **[27.11.2024]**
  - **Fix:** Register/Login-Link in der `login/Register`-Ansicht korrigiert.
  - **Update:** BLJ Blog Sidebar-Script entfernt.
    - **Neu:** Nach Jahrgang filtern (`NOT NULL`).
    - Erweiterungsidee: 3D-Sidebars, die Jahrgänge durchblättern.
  - **Fix:** Bild-URL in der `Post View` korrigiert.
    
---

## **Ideensammlung**
> Ein Platz für kreative Ideen und neue Feature-Vorschläge, die für zukünftige Updates getestet oder implementiert werden können.

### **Design-Verbesserungen**
- **3D-Sidebars mit Animationen:**
  - Flipping zwischen Jahrgängen, um visuell ansprechender zu sein.
- **Dynamische Themes:**
  - Möglichkeit, zwischen verschiedenen Farb-Themes (Light/Dark/Custom) zu wechseln.
- **Benutzer-Dashboard:**
  - Ein personalisierter Bereich, der die aktivsten Blogs, Kommentare und Benutzer anzeigt.

### **Neue Funktionen**
- **Jahrgangsübergreifender Blog-Filter:**
  - Benutzer können nach mehreren Jahrgängen gleichzeitig filtern.
- **Drag-and-Drop-Upload:**
  - Für Bilder oder Videos, um die Benutzerfreundlichkeit zu erhöhen.
- **Statistiken im Blog:**
  - Anzeigen von Blog-Ansichten, Bewertungen und Kommentaren in Echtzeit.
- **Suchfunktion nach Tags und Jahrgängen:**
  - Erweiterte Suchoptionen basierend auf spezifischen Kriterien.
- **Erweiterte Post Möglichkeiten:**
  - Youtube Links direkt eifügen und abspielen


### **Datenbank-Ideen**
- **Erweiterung der BLJ-Datenbank:**
  - Speichere Benutzerpräferenzen für Jahrgänge, Kategorien und Designs.
- **Backup-Feature:**
  - Automatische Speicherung von Blog-Versionen, um Änderungen rückgängig machen zu können.

### **Interaktion und Social Features**
- **Follower-System:**
  - Benutzer können anderen Autoren folgen und über neue Posts benachrichtigt werden.
- **Live-Kommentare:**
  - Echtzeit-Updates für Kommentare, ohne die Seite neu zu laden.
- **Beliebteste Beiträge:**
  - Ein Bereich, der trending oder häufig kommentierte Beiträge anzeigt.

### **Sicherheit und Performance**
- **Benachrichtigungen bei verdächtigem Login:**
  - Warnungen, wenn sich ein Benutzer von einer neuen IP anmeldet.
- **Caching-System:**
  - Schnellere Ladezeiten durch das Zwischenspeichern häufiger Datenbankabfragen.

---

## **Technologien**
Die gleichen Technologien wie im Hauptverzeichnis werden verwendet:
- **Frontend:** Tailwind CSS, JavaScript, HTML.  
- **Backend:** PHP, Apache.  
- **Datenbank:** MySQL.

---

## **Sicherheit**
Alle experimentellen Änderungen im `WorkingDir` folgen den gleichen Sicherheitsstandards:
- **SQL-Injektion:** Verhindert durch vorbereitete Anweisungen.  
- **Passwortsicherheit:** Bcrypt-Hashing für Passwörter.  
- **Eingabevalidierung:**  
  - Trimmen (`trim`).
  - Entfernen von Backslashes (`stripslashes`).
  - HTML-Sonderzeichenmaskierung (`htmlspecialchars`).
    
## **Kontakt**

**Twitter** - [@The_Real_HolyG](https://twitter.com/the_real_holyg)

**E-Mail:** devholyg@gmail.com 

**Projekt Link:** [WorkingDir](https://github.com/HeiligerG/PHP-Projekt/WorkingDir)

---

<div align="center">
  Mit 💜 erstellt von [HolyG]
</div>
