Hier ist das **README.md**-File für deine Web-App in Version 1.0:

---

# **Web App** 📝 | Version 1.0  

Ein kompakter, sauber designter Blog mit umfassender Funktionalität, Sicherheit und einer klaren Roadmap für zukünftige Features.

---

## **Inhaltsverzeichnis**
1. [Überblick](#überblick)
2. [Features in Version 1.0](#features-in-version-10)
3. [Technologien](#technologien)
4. [Sicherheit](#sicherheit)
5. [Datenbankstruktur](#datenbankstruktur)
6. [Bekannte Bugs und Verbesserungen](#bekannte-bugs-und-verbesserungen)
7. [Roadmap für zukünftige Versionen](#roadmap-für-zukünftige-versionen)
8. [Lizenz](#lizenz)

---

## **Überblick**
Diese Web-App ist eine Blogging-Plattform, die benutzerfreundlich, sicher und funktional gestaltet wurde. Sie kombiniert ein minimalistisches Design mit einem Fokus auf Benutzerinteraktion und Sicherheit. Das aktuelle Release (Version 1.0) legt die Basis für eine wachsende Blogging-Community mit vielen geplanten Erweiterungen.

---

## **Features in Version 1.0**

### **Design**
- 🌑 **Dunkel, kompakt, sauber:** Modernes Design mit einfacher Bedienbarkeit.

### **Funktionen**
- 🖋️ **Blog-Interaktion:**
  - Beiträge erstellen, bearbeiten und löschen.
  - Kommentare hinzufügen, bearbeiten und löschen.
  - Blog- und Benutzer-Timestamps.
  - Blog-Bewertungssystem (Sternebewertung).
  - **Kein Selbstbewerten:** Benutzer können ihre eigenen Beiträge nicht bewerten.
  - **Beitragsvorschau:** Textkürzung (`truncateText`) für Blog-Posts.
  - Benutzerprofil: Passwort, Profilname und E-Mail ändern.
  - **Login/Register/Logout:** Sichere Anmeldung und Kontoverwaltung.
- 🛡️ **Sicherheit:** Passwörter werden sicher gehasht, und Benutzereingaben sind geschützt.

### **Datenbank**
- Zwei Datenbankverbindungen:
  - Haupt-Blog-Datenbank.
  - Separate Datenbank für Benutzerdefinierte Blogs (BLJ).

### **Bug Hunt**
- 🚨 Fehlerbehandlungslogik implementiert.

---

## **Technologien**
- **Frontend:** Tailwind CSS, JavaScript, HTML.  
- **Backend:** PHP, Apache.  
- **Datenbank:** MySQL.

---

## **Sicherheit**
Die App verwendet Best Practices für die Sicherheit:
- **SQL-Injektion:** Verhindert durch vorbereitete Anweisungen.  
- **Passwortsicherheit:** Bcrypt-Hashing für Passwörter.  
- **CSRF-Schutz:** Tokens zur Validierung jeder Anfrage.  
- **Eingabevalidierung:**  
  - Trimmen (`trim`).
  - Entfernen von Backslashes (`stripslashes`).
  - HTML-Sonderzeichenmaskierung (`htmlspecialchars`).

---

## **Datenbankstruktur**
- **Haupt-Blog-Datenbank:** Speicherung der Beiträge, Benutzerinformationen und Bewertungen.
- **BLJ-Datenbank:** Verwaltung benutzerdefinierter Inhalte.

---

## **Bekannte Bugs und Verbesserungen**
- Einige Fehlernachrichten sind überflüssig und werden in zukünftigen Updates entfernt.

---

## **Roadmap für zukünftige Versionen**
### Geplante Features:
1. **E-Mail-Verifizierung:** Vorbereitete Funktionalität.  
2. **Collections:** Sammlungen von Beiträgen erstellen und verwalten.  
3. **Hashtags:** Inhalte nach Tags filtern und suchen.  
4. **Suchfunktion:** Verbesserte Nutzererfahrung durch schnelle Suche.  
5. **Schönere Alerts:** Benutzerfreundlichere Meldungen (vorbereitet).  
6. **Header-Upgrade:**  
   - Sticky-Header oder Sticky-Burger-Menü.  
   - Verbesserungen der Sidebar auf größeren Bildschirmen.  
7. **API:** JSON-basierte Schnittstellen (vorbereitet).  
8. **Dokumentation:** Optionale Erstellung einer vollständigen Dokumentation.  
9. **Video-Stream:** Unterstützt Video-Uploads und Wiedergabe.  
10. **Follower-System:** Benutzer können sich gegenseitig folgen.  
11. **Administrator-Konto:** Root-Benutzer für Verwaltung und Moderation.  
12. **Neuer Footer:** Verbesserte Benutzererfahrung.  
13. **404-Seite:** Benutzerfreundlicher und informativer.

---

## **Lizenz**
Diese Anwendung steht unter der [MIT-Lizenz](LICENSE).

---

## **Kontakt**
- **Autor:** HolyG.  
- **GitHub:** [HolyG](https://github.com/heiligerg).
