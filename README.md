# Inventory & Stock Management API

Inventory & Stock Management API adalah RESTful API yang dibangun menggunakan Laravel dan Laravel Sanctum untuk mengelola data inventory, produk, supplier, warehouse, serta transaksi stok. API ini menerapkan autentikasi berbasis token dan role (Admin & User) dengan business logic untuk menjaga konsistensi data stok.

---

## Features

### Authentication
- Register
- Login
- Logout
- User Profile
- Laravel Sanctum Authentication

### Role Management
- Admin
- User

### Category
- Create Category
- Read Category
- Update Category
- Delete Category
- Lihat semua Category

### Supplier
- Create Supplier
- Read Supplier
- Update Supplier
- Delete Supplier
- Lihat Semua Supplier

### Warehouse
- Create Warehouse
- Read Warehouse
- Update Warehouse
- Delete Warehouse
- Lihat Semua Warehouse

### Product
- Create Product
- Read Product
- Update Product
- Delete Product

### Stock Management
- Stock In
- Stock Out
- Stock Adjustment
- Stock History

### Dashboard
- Total Products
- Total Categories
- Total Suppliers
- Total Warehouses
- Total Stock
- Stock In Today
- Stock Out Today
- Stock Adjustment Today

---

## Business Logic

- Stock tidak boleh bernilai minus.
- Setiap perubahan stok otomatis disimpan ke Stock History.
- Product baru memiliki stock awal = 0.
- Hanya Admin yang dapat mengelola data master dan transaksi stok.
- User hanya dapat melihat Dashboard, Profile, dan Stock History.

---

## Tech Stack

- Laravel 12
- PHP 8.3
- MySQL
- Laravel Sanctum

---

## Installation

Clone repository

```bash
git clone https://github.com/AlbarFahrezi/inventory-stock-management-api.git
```

Masuk ke folder project

```bash
cd inventory-stock-management-api
```

Install dependency

```bash
composer install
```

Copy file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Atur database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_stock_management_api_new
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration

```bash
php artisan migrate
```

Jalankan seeder

```bash
php artisan db:seed
```

Jalankan server

```bash
php artisan serve
```

---

## Default Account

### Admin

Email

```
admin@gmail.com
```

Password

```
password
```

### User

Email

```
user@gmail.com
```

Password

```
password
```

---

## API Endpoints

### Authentication

| Method | Endpoint |
|---------|----------|
| POST | /api/register |
| POST | /api/login |
| GET | /api/profile |
| POST | /api/logout |

---

### Dashboard

| Method | Endpoint |
|---------|----------|
| GET | /api/dashboard |

---

### Category

| Method | Endpoint |
|---------|----------|
| GET | /api/categories |
| POST | /api/categories |
| GET | /api/categories/{id} |
| PUT | /api/categories/{id} |
| DELETE | /api/categories/{id} |

---

### Supplier

| Method | Endpoint |
|---------|----------|
| GET | /api/suppliers |
| POST | /api/suppliers |
| GET | /api/suppliers/{id} |
| PUT | /api/suppliers/{id} |
| DELETE | /api/suppliers/{id} |

---

### Warehouse

| Method | Endpoint |
|---------|----------|
| GET | /api/warehouses |
| POST | /api/warehouses |
| GET | /api/warehouses/{id} |
| PUT | /api/warehouses/{id} |
| DELETE | /api/warehouses/{id} |

---

### Product

| Method | Endpoint |
|---------|----------|
| GET | /api/products |
| POST | /api/products |
| GET | /api/products/{id} |
| PUT | /api/products/{id} |
| DELETE | /api/products/{id} |

---

### Stock

| Method | Endpoint |
|---------|----------|
| POST | /api/stock-in |
| POST | /api/stock-out |
| POST | /api/stock-adjustment |
| GET | /api/stock-history |

---

## Authentication

Semua endpoint (kecuali Register dan Login) menggunakan Bearer Token.

Contoh:

```
Authorization: Bearer YOUR_TOKEN
```

---

## API Testing

API telah diuji menggunakan Postman.

---