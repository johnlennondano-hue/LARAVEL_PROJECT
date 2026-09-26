# Task Manager (Laravel)

A simple full-stack task management dashboard built with **Laravel** and **MySQL**. Create, track, and update tasks from a single dashboard with live stats, search, priority filtering, and one-click status toggling.

**Project Code:** WST21-PM-2026-SF

**Student Name:** DAÑO, JOHN LENNON L.

**Course & Year:** BSIT2 — SEC-1

**Database Used:** MySQL

---

## Features

- **Add Task** — title, description, priority (Urgent / Reminder), and due date
- **View Tasks** — live Total / Pending / Completed stats, with search and priority filter
- **Edit Task** — update any task's details via the modal
- **Delete Task** — remove a task with a confirmation prompt
- **Update Status** — toggle Pending ⇄ Completed in one click

## Tech Stack

| Layer      | Technology                        |
|------------|------------------------------------|
| Local Server | XAMPP (Apache + MySQL)          |
| Backend    | Laravel (PHP)                     |
| Frontend   | Blade, Tailwind CSS, vanilla JavaScript |
| Icons/Fonts | Font Awesome, Google Fonts (Inter) |

## Setup

1. Start **Apache** and **MySQL** in XAMPP.
2. Create a database in phpMyAdmin matching your `DB_DATABASE`.
3. Install dependencies:
   ```bash
   composer install
   ```
4. Set up the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Run migrations:
   ```bash
   php artisan migrate:fresh
   ```
6. Start the server:
   ```bash
   php artisan serve
   ```
7. Open **http://127.0.0.1:8000** in your browser.

## Screenshots

<!-- project screenshots -->