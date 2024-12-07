# **Changelog für Version 1.0.1**

---

## **Überblick**
- **Branch Merge:** Der BugFix-Branch wurde erfolgreich mit dem Master-Branch zusammengeführt.
- **Dokumentationsstruktur:** Eine umfassende Ordner- und Dokumentationsstruktur wurde erstellt, um das Projekt besser zu organisieren.

---

## **Änderungen**

### **07.12.2024**
#### **Fixes**
- **Weitere Blogs:** Zeichenfehler behoben.
- **Form-Resubmission:** 
  - Ansatz 2 implementiert:
    - Ressourcen schonender und benutzerfreundlicher.
    - Nur das betroffene Element wird aktualisiert (z. B. ein Kommentar).

#### **Neue Struktur**
- Ordnerstruktur für Changelogs, Probleme, Ideen und Technologien erstellt.
- README.md für die Projektübersicht und Ordnerdokumentation hinzugefügt.

#### **Ideen**
- **Live-Kommentare:**
  - Echtzeit-Updates für Kommentare, ohne die Seite neu zu laden.
- **Form-Resubmission Ansätze:**
  1. **POST-Redirect-GET Methode:**  
     ```javascript
     .then(response => {
         if (response.ok) {
             window.location.href = window.location.pathname;
         }
     })
     ```
  2. **AJAX ohne Seitenneuladen:**  
     ```javascript
     .then(response => {
         if (response.ok) {
             const commentElement = document.getElementById('comment-' + commentId);
             if (commentElement) {
                 commentElement.remove();
             }
         }
     })
     ```

---

### **27.11.2024**
#### **Fixes**
- **Login/Register-Ansicht:** Register/Login-Link korrigiert.
- **Bild-URL in der Post View:** Fehler behoben.

#### **Updates**
- **BLJ Blog Sidebar-Script entfernt:**
  - **Neu:** Nach Jahrgang filtern (`NOT NULL`).
  - **Erweiterungsidee:** 3D-Sidebars, die Jahrgänge durchblättern.

---

## **Version Informationen**
### **Version 1.0.1**
- Fokus auf Bugfixes, strukturelle Verbesserungen und erste Ideen für zukünftige Features.
- Die nächste Version (1.0.2 oder 1.1) wird nach der Implementierung weiterer Features oder Updates veröffentlicht.

---

*Aktualisiert am 07.12.2024*
