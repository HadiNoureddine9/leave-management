<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

# 🗓️ Laravel Leave Management System

A backend dashboard-style API application for managing employee leave requests. Built with **Laravel 8**, this system features secure authentication, CRUD operations, and role-based workflow for handling leave approvals.

---

## 🚀 Features

- Employees can submit leave requests
- Admins can approve/reject leave
- Status tracking: Pending / Approved / Rejected
- Role-based authentication with Laravel Sanctum
- Seeded data for quick testing

---

## ⚙️ Tech Stack

- Laravel 8
- Sanctum (API authentication)
- MySQL / MariaDB
- RESTful APIs
- Role management (admin / employee)

---

## 🛠️ Setup Instructions

1. **Clone the project**
    ```bash
    git clone https://github.com/your-username/leave-management.git
    cd leave-management
    ```

2. **Install dependencies**
    ```bash
    composer install
    ```

3. **Configure environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Update your `.env` file with the correct database credentials:
    ```ini
    DB_DATABASE=your_database_name
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password
    ```

4. **Run database migrations and seeders**
    ```bash
    php artisan migrate --seed
    ```

5. **Serve the application**
    ```bash
    php artisan serve
    ```

---

## 🔐 API Authentication

Laravel Sanctum is used for token-based authentication. After registering or logging in, you'll receive an API token. Use this token as a **Bearer token** in your request headers:

```makefile
Authorization: Bearer your_token_here



