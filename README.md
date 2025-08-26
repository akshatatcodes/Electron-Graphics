# Electron-Graphics
Electron Graphics – Portfolio & Admin (Sem 5 Project)

A modern, responsive portfolio named Electron Graphics with public pages (Home, Experience, Projects, Research) and a protected Admin to manage user data and media uploads. Built with PHP, HTML/CSS/JS, and MySQL.

✨ Overview

This project demonstrates practical full‑stack skills: clean UI, secure session authentication, CRUD operations, media upload/validation, and a simple content workflow. The admin can add/edit/remove Projects, Experience entries, Research posts, and images.

✅ Features

Responsive layout and accessible navigation

Pages: Home · Experience · Projects · Research · Admin

Admin: CRUD for content + image/file uploads

Session‑based auth, password hashing

Contact/user submissions (stored in DB)

Basic SEO (meta tags) and favicon

Optional light/dark theme toggle

🧱 Tech Stack

Frontend: HTML5, CSS3, JavaScript (ES6)

Backend: PHP 7/8

Database: MySQL / MariaDB

Auth: PHP sessions, hashed passwords (password_hash)

Storage: Local /uploads with file type/size checks

Dev: XAMPP/LAMP/WAMP, phpMyAdmin

🚀 Getting Started
Prerequisites

PHP 7.4+ and MySQL (XAMPP/LAMP/WAMP)

Clone
git clone https://github.com/akshatatcodes/electron-graphics.git
cd electron-graphics
Database Setup

Create a MySQL database (e.g., registration).

Import database.sql from the repo into this DB.

Create an admin user (SQL included in database.sql).

Configuration

Edit db.php with your DB credentials:

<?php
const DB_HOST = 'localhost';
const DB_NAME = 'registration';
const DB_USER = 'root';
const DB_PASS = '';
?>
Run Locally

Move the project to your web root (e.g., htdocs/ for XAMPP).

Start Apache and MySQL.

Visit: http://localhost/electron-graphics/

Default admin route: /admin/login.php (update path as per your structure)
