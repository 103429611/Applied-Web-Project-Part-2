# Project Overview
 
* **Unit:** COS10026 Web Technology
* **Institution:** Swinburne University of Technology, 2026
---
 
- the main language used for the individual pages - PHP (converted from HTML5)
- the language used to design each page - CSS3
- the database - MySQL
---
 
# InfraWatch
> Cities are complex, but we make them readable.
 
# About the project
InfraWatch is a dynamic recruitment website built for a simulated Smart City Infrastructure Consultancy (Group G02). Originally a static HTML site, it has been converted into a database-driven PHP application. The site advertises open roles across smart transport, energy monitoring, and urban services management, and gives prospective applicants a clear, accessible way to learn about the company and apply online. InfraWatch partners with councils and industries to build digital platforms that turn the noise of urban infrastructure into clear, actionable data.
 
---
 
# Live site
- **Jira Link:** [Click here to access our Jira Board](https://student-team-y0h6dox9.atlassian.net/jira/software/projects/SCRUM/boards/1?jql=assignee%20IN%20%28empty%2C%20712020%3Aea708ca8-c2e4-4f0b-8b3a-59c70d71625c%29)
- **GitHub repository:** [Click here to access Github](https://github.com/103429611/103429611.github.io)
> Both links are also included in the footer of `index.php`.
 
---
 
# Tech stack
- **PHP** — server-side scripting, modular includes, form processing, and DB queries
- **MySQL** — relational database for EOIs, jobs, members, and users
- **HTML5** — semantic markup, validated via W3C Markup Validator
- **CSS3** — external `styles.css`, with embedded and inline examples on every page, validated via W3C CSS Validation Service
- **Responsive layout** using Flexbox and CSS Grid
- **Accessibility** — WCAG 2.1 AA standards, sufficient colour contrast
- **Deployment** — GitHub Pages, Jira
---
 
# Project Team & Contributions
 
| Name | Student ID | Professional Title | Part 1 Responsibility | Part 2 Responsibility |
| :--- | :--- | :--- | :--- | :--- |
| **Ashley** | 103429611 | Founder & Creative Director | Brand Strategy & `jobs.html` | `jobs.php`, jobs table & search bar |
| **Noor** | 106216609 | Visual Identity Lead | Logo Architecture & `index.html` | `index.php`, PHP includes & settings |
| **Alex** | 106340883 | Organizational Strategist | Workforce Design & `apply.html` | `apply.php`, `process_eoi.php` & EOI table |
| **William**| 105913190 | Content Lead | Media Documentation & `about.html` | `about.php`, about table & `manage.php` |
 
> **Note:** Each member was responsible for the full structure, content, and styling of their assigned pages across both parts of the project.
 
---
 
# Pages
 
| Page | Description |
| :--- | :--- |
| `index.php` | Landing page introducing InfraWatch, its mission, and navigation to other sections. Features a background graphic applied via CSS. |
| `jobs.php` | Dynamically renders job listings from the MySQL `jobs` table. Includes a search bar that queries the database. Retains the floated `<aside>` layout from Part 1. |
| `apply.php` | Online application form for prospective candidates. POSTs to `process_eoi.php`. All client-side HTML validation disabled; validation handled server-side. |
| `process_eoi.php` | Processes form submissions from `apply.php`. Validates and sanitises all input server-side, inserts records into the `eoi` table, and displays a confirmation with the auto-generated EOI number. Cannot be accessed directly via URL. |
| `about.php` | Company background, team, and values. Member contributions loaded dynamically from the `about` table in the database. |
| `manage.php` | HR manager dashboard (login protected). Supports listing, filtering, sorting, deleting EOIs, and updating EOI status. |
| `login.php` | Login page protecting `manage.php`. Credentials stored in a `users` table. Marker access: username `admin`, password `admin`. |
 
---
 
# PHP Includes
Shared UI elements have been extracted into `.inc` files and included across all pages:
 
| File | Contents |
| :--- | :--- |
| `header.inc` | Site `<header>` with logo and tagline |
| `nav.inc` | Main navigation bar |
| `footer.inc` | Footer with GitHub and Jira links |
 
---
 
# Database
All database connection settings are stored in `settings.php` (no password set, as per requirements). This file is included wherever a DB connection is needed.
 
### Tables
 
| Table | Description |
| :--- | :--- |
| `eoi` | Stores Expression of Interest submissions. Includes all fields from the Part 1 apply form plus a `status` field (`New` / `Current` / `Final`, default: `New`) and an auto-generated `EOInumber`. |
| `jobs` | Stores job listings. Fields and data types match the job descriptions from the Part 1 jobs page. |
| `about` | Stores team member details and contributions for both Part 1 and Part 2. |
| `users` | Stores HR manager login credentials (username and hashed password). |
 
---
 
# CSS architecture
All shared styles live in `styles.css`. Every page additionally includes:
- At least one **embedded** `<style>` block for page-specific rules
- At least one **inline** `style=""` attribute where contextually appropriate
---
 
# Page-specific CSS highlights
- **`index.php`** — background graphic applied via CSS
- **`jobs.php`** — `<aside>` floated right at 25% width with margin, padding, and border
- **`apply.php`** — form layout using Flexbox / CSS Grid
- **`about.php`** — bordered `<figure>`, hex-coloured table with hover row effects
- **`manage.php`** — table-based results display with sort and filter controls
---
 
# Security & Validation
- `process_eoi.php` blocks direct URL access (checks for required POST fields, redirects otherwise)
- All form input is trimmed, stripped of slashes, and HTML-escaped before DB insertion
- Server-side validation enforces required formats (e.g. email, phone, postcode)
- All HTML5 client-side form validation is disabled (`novalidate`)
- `manage.php` is protected by session-based authentication via `login.php`
- User passwords are stored securely in the `users` table
---
 
# Accessibility
- Semantic HTML5 elements throughout (`<header>`, `<nav>`, `<main>`, `<section>`, `<aside>`, `<footer>`)
- All images have meaningful `alt` attributes
- All form inputs have associated `<label>` elements
- Colour contrast meets WCAG 2.1 AA minimum ratios
---
 
# Acknowledgement of Country
- InfraWatch acknowledges the **Wurundjeri People of the Kulin Nation** as the Traditional Custodians of the land on which we study and work. We pay our respects to their Elders past, present, and emerging.
- Detailed acknowledgement included at the bottom of `index.php`.
---
 
# Project management
- Managed in **Jira** with epics, user stories, tasks, and sprints across both parts
- Jira board link is included in the footer of `index.php`
- A Group Agreement was submitted prior to commencing the project
---
 
# Validation
All pages have been validated using the W3C services and return no errors or warnings.
- **HTML Validation:** Verified via [W3C Markup Validation Service](https://validator.w3.org/)
- **CSS Validation:** Verified via [W3C CSS Validation Service](https://jigsaw.w3.org/css-validator/)
---
 
# Academic integrity
This project was developed for COS10026 at Swinburne University of Technology. Any use of generative AI tools or third-party resources have been acknowledged in accordance with unit policy.
* **Generative AI:** Canva AI was used to generate an initial logo concept. This concept was then manually redesigned and adapted for use in the final site. All other written content, HTML, CSS, PHP, and SQL was authored by the project team. Gemini was used to understand how to write a ReadMe file and for general tips.