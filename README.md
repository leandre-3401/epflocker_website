# EPFLocker — Website

Website for the **EPFLocker** project, built with PHP/HTML/CSS/JavaScript, and shipped with an SQL dump to initialize the database.

---

## Repository structure

You’ll typically find:

- `public/` — public-facing pages/assets (frontend entry point, static files, etc.)
- `inc/` — PHP includes (config, helpers, templates, shared code, …)
- `epflocker_db_final.sql` — SQL dump for the database (schema + possibly sample data)
- `secret_hits.txt` — file related to detected “secrets” (see **Security**)

---

## Requirements

- **PHP** (ideally 8.x)
- A web server: **Apache** (XAMPP/MAMP/LAMP) or **Nginx**
- **MySQL / MariaDB**
- (Optional) **phpMyAdmin** to import the SQL dump

---

## Local setup

### 1) Clone the project

```bash
git clone https://github.com/leandre-3401/epflocker_website.git
cd epflocker_website
