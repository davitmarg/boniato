# 🍠 Boniato (Twitter-Like App)

**Boniato** is a Twitter-like micro-blogging application built with **Laravel**.

## 🚀 Features

* **Advanced Caching:** Implements Full Page caching and manual Database query caching for high performance.
* **N+1 Optimization:** Strict eager loading strategies used throughout to ensure O(1) query performance.
* **Authorization:** Robust ownership checks on all destructive actions (Update/Delete) to prevent security issues.
* **Interactive UI:** HTMX-driven infinite scroll and dynamic state toggles without page reloads.
* **Rich Text:** Integrated Quill.js editor for creating and editing posts.
* **In-Place Editing:** JavaScript toggles for inline profile and comment editing.
* **Best Practices:** Consistent use of Named Routes and clean architecture.

## 🛠️ Tech Stack

* **Backend:** Laravel 11 / PHP 8.2+
* **Database:** SQLite
* **Frontend:** Blade, HTMX, Quill.js
* **Styling:** Custom Minimalist CSS

## 💾 Database Schema

* **Users**
* **Posts**
* **Comments**
* **Likes** (Pivot)

## ⚙️ Installation (Windows/Herd)

### Prerequisites
* Laravel Herd
* Git

### Setup Steps

1.  **Clone Repository**
    ```bash
    cd C:\Users\%USERNAME%\Herd
    git clone <repository-url> boniato
    cd boniato
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    ```
    *Ensure `DB_CONNECTION=sqlite` is set in your `.env`.*

4.  **Generate Key**
    ```bash
    php artisan key:generate
    ```

5.  **Database Setup**
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Run**
    Visit: http://boniato.test