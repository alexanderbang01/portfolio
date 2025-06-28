# Alexander Bang - Portfolio Website

Et moderne, terminal-inspireret portfolio website bygget med PHP, Tailwind CSS og MySQL.

## 🎯 Features

### Frontend Portfolio
- **Terminal-inspireret design** med JetBrains Mono font
- **Automatisk aldersberegning** (opdateres d. 7. august hvert år)
- **Responsive design** der fungerer på alle enheder
- **Smooth animationer** og hover effekter
- **Devicon teknologi ikoner** for alle programmeringssprog og værktøjer
- **Kontaktformular** med AJAX submission og custom modal popup

### Admin Panel
- **Sikker login system** med password hashing
- **Dashboard** med statistikker over beskeder
- **Besked administration** - læs, marker og slet kontaktbeskeder
- **Responsivt admin interface** matchende hovedsidedesign

### Tekniske Features
- **Database integration** til kontaktbeskeder
- **Spam beskyttelse** (max 3 beskeder per IP per time)
- **Input validering** og sanitization
- **Session management** for admin login

## 🛠️ Tech Stack

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, Tailwind CSS, JavaScript
- **Database**: MySQL/MariaDB
- **Font**: JetBrains Mono (Google Fonts)
- **Icons**: Devicons CDN

## 🎨 Customization

### Skift Farver
Portfolio bruger et sort/hvid tema. For at ændre farver, rediger CSS variablerne i `<style>` sektionen.

### Tilføj Teknologier
Teknologi ikoner bruger [Devicons](https://devicon.dev/). Tilføj nye ikoner i "Skills Section":

```html
<div class="tech-card bg-black border border-white/10 p-6 text-center">
    <i class="devicon-[teknologi]-plain text-4xl mb-3 block"></i>
    <div class="text-sm">[Teknologi Navn]</div>
</div>
```

## 📄 Licens

Dette projekt er til personlig brug. Alle teknologi ikoner tilhører deres respektive ejere.

## 👨‍💻 Udvikler

**Alexander Bang**
- Email: alexanderbang22@gmail.com
- LinkedIn: [Alexander Bang](https://www.linkedin.com/in/alexander-bang-044b8819b/)
- GitHub: [alexanderbang01](https://github.com/alexanderbang01)

---

*Udviklet med ❤️*