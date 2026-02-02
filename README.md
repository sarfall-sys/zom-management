<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Management System API – Laravel Sanctum

A RESTful API built with **Laravel Sanctum** for secure authentication, following the **MVC architecture** enhanced with the **Repository Pattern**.  
The system includes an **admin panel**, **policies & gates**, custom **middleware**, **form requests**, **API resources**, **seeders**, **factories**, and **PHP Feature Tests**.

The project currently manages 10+ core tables such as Products, Families, Users, Roles, and more. Future expansions include an Inventory module and additional business features.

---

## 🚀 Features

### 🔐 Authentication & Security
- Token-based authentication using **Laravel Sanctum**
- Login & logout functionality
- Protected routes with role-based access

### 🛡 Authorization
- **Policies** for resource-level access
- **Gates** for global permission checks
- Role & permission structure (e.g., Admin, User)

### 🧱 Architecture
- Standard **Laravel MVC**
- **Repository Pattern** for clean data handling
- Form **Request Validation**
- **API Resource Transformers** for consistent JSON responses

### 🖥 Admin Panel
- Management of Users, Roles, Products, Families, etc.

### 🌱 Database: Seeders & Factories
- **Factories** for generating test data (Users, Products, Families, etc.)
- **Seeders** for:
  - Default admin user
  - Roles
  - Permissions (optional)
  - Product families
  - Example products
  - Additional initial data

### 🧪 Testing
- **PHPUnit Feature Tests** covering:
  - Authentication
  - CRUD operations
  - Policies & Gates
  - Database interaction via factories

---

## 📦 Current Modules

- Users  
- Roles  
- Products  
- Families  
- Categories (optional)  
- Permissions (optional)  
- Logs (optional)  
- Settings (optional)  
- Sanctum Tokens  
- Other related tables

### 📌 Planned Upcoming Modules
- Inventory
- Stock Movements
- Suppliers
- Purchase Orders
- Reports & Admin tools

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 10+ |
| Authentication | Laravel Sanctum |
| Database | MySQL / MariaDB |
| Testing | PHPUnit |
| Data Generation | Factories & Seeders |
| Architecture | MVC + Repository Pattern |
| Admin Panel | React js |

---

## 🔐 Authentication Flow

1. User submits email & password  
2. Sanctum generates a token  
3. Token is used for protected routes  
4. Policies & gates validate permissions  
5. Middleware enforces access control

---
## 📚 Example API Endpoints

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/login` | Login and get token | ❌ |
| POST | `/logout` | Logout user | ✔️ |
| GET | `/api/products` | List products | ✔️ |
| POST | `/api/products` | Create product | ✔️ Admin |
| PUT | `/api/products/{id}` | Update product | ✔️ Admin |
| DELETE | `/api/products/{id}` | Delete product | ✔️ Admin |

---
## 🧪 Running Tests

Run all tests:
## 🧪 Running Tests

Run all tests:

php artisan test

---

## ⚙️ Installation

### 1. Clone the repository

git clone https://github.com/your-repo-url.git

cd project-folder

### 2. Install dependencies

composer install

### 3. Configure environment file
cp .env.example .env
php artisan key:generate


### 4. Setup the database
php artisan migrate --seed

### 5. Start the development server


---

## 📝 License
This project is licensed under the **MIT License** (or your chosen license).

---


