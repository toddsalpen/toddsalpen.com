# 🚀 Developer Portfolio Template

A modern, responsive, and ATS-friendly portfolio website template designed for software engineers, mobile developers, and full-stack professionals. Built with pure HTML, CSS, and JavaScript — no frameworks required.

![Portfolio Preview](preview.png)

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![Font Awesome](https://img.shields.io/badge/Font%20Awesome-528DD7?logo=fontawesome&logoColor=white)](https://fontawesome.com/)

---

## ✨ Features

- **🎨 Modern Dark Theme** — Professional dark UI with vibrant accent colors
- **📱 Fully Responsive** — Optimized for desktop, tablet, and mobile devices
- **⚡ No Dependencies** — Pure HTML/CSS/JS, no build tools required
- **🎭 Smooth Animations** — Scroll-triggered fade-ins and hover effects
- **🔍 SEO Friendly** — Semantic HTML structure with meta tags
- **♿ Accessible** — WCAG-compliant color contrast and keyboard navigation
- **🖨️ Print Ready** — Clean print styles included
- **🛠️ Easy to Customize** — CSS variables for quick theming

---

## 📋 Sections Included

| Section | Description |
|---------|-------------|
| **Hero** | Eye-catching intro with stats, CTA buttons, and profile card |
| **About** | Personal story with animated code snippet and highlights |
| **Skills** | Categorized technical skills with icon cards |
| **Experience** | Timeline-based work history |
| **Projects** | Portfolio grid with app store links |
| **Contact** | Contact form and direct contact methods |
| **Footer** | Social links and trademark disclaimer |

---

## 🚀 Quick Start

### Option 1: Direct Download

1. Download or clone this repository:
   ```bash
   git clone https://github.com/YOUR_USERNAME/developer-portfolio-template.git
   ```

2. Open `index.html` in your browser

3. Customize the content (see [Customization Guide](#-customization-guide))

### Option 2: Use as GitHub Template

1. Click the **"Use this template"** button at the top of this repository
2. Create your new repository
3. Clone and customize

---

## 🎨 Customization Guide

### 1. Personal Information

Open `index.html` and update the following:

```html
<!-- Update your name -->
<h1 class="hero-title">
    Your Name<br>
    <span class="gradient">Your Title Here</span>
</h1>

<!-- Update contact info -->
<p>Your City, State | (XXX) XXX-XXXX | your.email@example.com</p>

<!-- Update stats -->
<div class="stat">
    <div class="stat-number">10+</div>
    <div class="stat-label">Years Experience</div>
</div>
```

### 2. Color Theme

Modify CSS variables in the `:root` selector:

```css
:root {
    /* Primary Colors */
    --bg-primary: #0a0a0b;           /* Main background */
    --bg-secondary: #111113;          /* Section backgrounds */
    --bg-card: #161619;               /* Card backgrounds */
    
    /* Accent Colors - Change these for different themes */
    --accent-primary: #00d4aa;        /* Main accent (teal) */
    --accent-secondary: #00b894;      /* Secondary accent */
    --accent-tertiary: #6c5ce7;       /* Tertiary accent (purple) */
    
    /* Text Colors */
    --text-primary: #f5f5f7;          /* Main text */
    --text-secondary: #a1a1a6;        /* Secondary text */
    --text-muted: #6e6e73;            /* Muted text */
}
```

#### Theme Presets

**🔵 Blue Theme:**
```css
--accent-primary: #3b82f6;
--accent-secondary: #2563eb;
--accent-tertiary: #8b5cf6;
```

**🟠 Orange Theme:**
```css
--accent-primary: #f97316;
--accent-secondary: #ea580c;
--accent-tertiary: #eab308;
```

**🔴 Red Theme:**
```css
--accent-primary: #ef4444;
--accent-secondary: #dc2626;
--accent-tertiary: #f97316;
```

**🟢 Green Theme:**
```css
--accent-primary: #22c55e;
--accent-secondary: #16a34a;
--accent-tertiary: #06b6d4;
```

### 3. Skills Section

Update skill cards with your technologies:

```html
<div class="skill-card fade-in">
    <div class="skill-card-content">
        <div class="skill-icon"><i class="fa-brands fa-react"></i></div>
        <h3>Frontend Development</h3>
        <p>Building responsive user interfaces</p>
        <div class="skill-tags">
            <span class="skill-tag">React</span>
            <span class="skill-tag">Vue.js</span>
            <span class="skill-tag">TypeScript</span>
        </div>
    </div>
</div>
```

### 4. Experience Timeline

Add or modify timeline items:

```html
<div class="timeline-item fade-in">
    <div class="timeline-dot"></div>
    <div class="timeline-content">
        <div class="timeline-header">
            <div>
                <h3 class="timeline-title">Your Job Title</h3>
                <p class="timeline-company">Company Name</p>
            </div>
            <span class="timeline-date">2020 – Present</span>
        </div>
        <p class="timeline-description">
            Description of your role and achievements...
        </p>
        <div class="timeline-tags">
            <span class="skill-tag">Skill 1</span>
            <span class="skill-tag">Skill 2</span>
        </div>
    </div>
</div>
```

### 5. Projects Section

Update project cards with your work:

```html
<div class="project-card fade-in">
    <div class="project-image" style="background: linear-gradient(135deg, #1a5fb4, #3584e4);">
        <span class="project-icon"><i class="fa-solid fa-mobile-screen"></i></span>
    </div>
    <div class="project-content">
        <h3 class="project-title">Project Name</h3>
        <p class="project-subtitle">Category / Client</p>
        <p class="project-description">
            Brief description of the project...
        </p>
        <div class="project-links">
            <a href="YOUR_LINK" class="project-link" target="_blank">
                <i class="fa-brands fa-google-play"></i> Google Play
            </a>
            <a href="YOUR_LINK" class="project-link" target="_blank">
                <i class="fa-brands fa-app-store"></i> App Store
            </a>
        </div>
    </div>
</div>
```

---

## 🎯 Font Awesome Icons Reference

This template uses [Font Awesome 6](https://fontawesome.com/icons) for icons.

### Common Icons

| Purpose | Icon Code |
|---------|-----------|
| Android | `<i class="fa-brands fa-android"></i>` |
| Apple/iOS | `<i class="fa-brands fa-apple"></i>` |
| Google Play | `<i class="fa-brands fa-google-play"></i>` |
| App Store | `<i class="fa-brands fa-app-store"></i>` |
| GitHub | `<i class="fa-brands fa-github"></i>` |
| LinkedIn | `<i class="fa-brands fa-linkedin"></i>` |
| Email | `<i class="fa-solid fa-envelope"></i>` |
| Phone | `<i class="fa-solid fa-phone"></i>` |
| Security | `<i class="fa-solid fa-shield-halved"></i>` |
| Gear/Settings | `<i class="fa-solid fa-gear"></i>` |
| Code | `<i class="fa-solid fa-code"></i>` |
| Database | `<i class="fa-solid fa-database"></i>` |
| Cloud | `<i class="fa-solid fa-cloud"></i>` |
| Rocket | `<i class="fa-solid fa-rocket"></i>` |
| Microchip | `<i class="fa-solid fa-microchip"></i>` |
| Network | `<i class="fa-solid fa-network-wired"></i>` |

Browse all icons at [fontawesome.com/icons](https://fontawesome.com/icons)

---

## 🌐 Deployment

### GitHub Pages (Free)

1. Push your code to a GitHub repository
2. Go to **Settings** → **Pages**
3. Select **Source**: Deploy from a branch
4. Select **Branch**: `main` and folder `/ (root)`
5. Your site will be live at `https://YOUR_USERNAME.github.io/REPO_NAME`

### Netlify (Free)

1. Go to [netlify.com](https://netlify.com)
2. Drag and drop your project folder
3. Your site is live instantly

### Vercel (Free)

1. Go to [vercel.com](https://vercel.com)
2. Import your GitHub repository
3. Deploy with one click

### Custom Domain

Add a `CNAME` file with your domain:
```
yourdomain.com
```

---

## 📁 Project Structure

```
developer-portfolio-template/
├── index.html          # Main HTML file (all-in-one)
├── README.md           # Documentation
├── LICENSE             # MIT License
├── preview.png         # Preview image for README
└── assets/             # Optional: separate assets
    ├── css/
    │   └── styles.css  # Extracted styles (optional)
    ├── js/
    │   └── scripts.js     # Extracted scripts (optional)
    └── images/
        └── ...         # Your images (optional)
```

---

## 🔧 Advanced Customization

### Adding a Profile Photo

Replace the avatar initials with an image:

```html
<!-- Before -->
<div class="avatar">HS</div>

<!-- After -->
<div class="avatar">
    <img src="your-photo.jpg" alt="Your Name" style="width: 100%; height: 100%; object-fit: cover; border-radius: 16px;">
</div>
```

### Adding a Resume Download Button

Add to your hero actions:

```html
<div class="hero-actions">
    <a href="#contact" class="btn btn-primary">
        <i class="fa-solid fa-envelope"></i> Get In Touch
    </a>
    <a href="your-resume.pdf" class="btn btn-secondary" download>
        <i class="fa-solid fa-download"></i> Download Resume
    </a>
</div>
```

### Making the Contact Form Functional

Option 1: Use [Formspree](https://formspree.io) (Free)
```html
<form class="contact-form" action="https://formspree.io/f/YOUR_FORM_ID" method="POST">
```

Option 2: Use [Netlify Forms](https://docs.netlify.com/forms/setup/) (Free with Netlify hosting)
```html
<form class="contact-form" name="contact" method="POST" data-netlify="true">
```

---

## 🤝 Contributing

Contributions are welcome! Feel free to:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2025 Hector Salinas

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 🙏 Acknowledgments

- [Font Awesome](https://fontawesome.com/) for the icons
- [Google Fonts](https://fonts.google.com/) for typography (DM Sans, Space Mono, Playfair Display)
- Inspired by modern developer portfolios and recruitment best practices

---

## ⚠️ Trademark Disclaimer

All trademarks, logos, and brand names mentioned in this template are the property of their respective owners. All company, product, and service names used are for identification purposes only. Use of these names, trademarks, and brands does not imply endorsement or affiliation.

---

## 📬 Contact

**Hector Salinas** - Senior Mobile & Full Stack Engineer

- 📧 Email: [hectorsalpen@gmail.com](mailto:hectorsalpen@gmail.com)
- 💼 LinkedIn: [linkedin.com/in/YOUR_PROFILE](https://linkedin.com/in/)
- 🐙 GitHub: [github.com/toddsalpen](https://github.com/toddsalpen)

---

<p align="center">
  <b>If you found this template helpful, please consider giving it a ⭐️</b>
</p>