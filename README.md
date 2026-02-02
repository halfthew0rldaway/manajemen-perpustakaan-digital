<div align="center">

# Sistem Manajemen Perpustakaan Digital

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

<p align="center">
  <b>A modern, responsive, and elegant library management system.</b><br>
  Built for efficiency, visual aesthetics, and ease of use.
</p>

</div>

---

## 📌 Overview

**Perpustakaan Digital** is a web-based application designed to modernize library operations. Built with **Laravel 11**, it offers a robust platform for managing books, members, loans, and returns, featuring a polished UI/UX that differentiates it from traditional administrative software.

### Key Features

-   **Modern Dashboard**: Interactive and responsive design using Tailwind CSS.
-   **Smart Stock Management**:
    -   Prevents adding single copies for new titles (min. 2).
    -   Auto-decrements stock on loan, increments on return.
-   **Automated Fines**: Calculates late fees (Rp 2,000/day) automatically upon return.
-   **Role-Based Access Control (RBAC)**:
    -   **Admin**: Full access (Manage Users, Master Data, Reports).
    -   **Petugas (Staff)**: Manage Loans and operational tasks.
-   **Reporting**: Generate daily and overdue reports with PDF export support.
-   **Member Management**: Track active loans and borrowing limits (max 4 books).

---

## 🚀 Installation

### Prerequisites

-   PHP 8.2+
-   Composer
-   Node.js & NPM
-   MySQL

### Setup Guide

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/halfthew0rldaway/manajemen-perpustakaan-digital.git
    cd manajemen-perpustakaan-digital
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Configuration**
    Copy the example environment file and configure your database settings:
    ```bash
    cp .env.example .env
    ```
    Update `.env` with your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Database Migration & Seeding**
    Seed the database with initial data (users, books, categories):
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Run the Application**
    Start the development server and asset compiler:
    ```bash
    # Terminal 1
    php artisan serve

    # Terminal 2
    npm run dev
    ```

    Access the application at `http://127.0.0.1:8000`.

---

## 🔑 Default Credentials

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@perpus.digital` | `password` |
| **Staff (Petugas)** | `staff@perpus.digital` | `password` |

---

## 🛠️ Tech Stack

-   **Backend**: Laravel 11 Framework
-   **Frontend**: Blade Templates, Tailwind CSS
-   **Interactivity**: Alpine.js
-   **Database**: MySQL
-   **PDF Generation**: dompdf

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
