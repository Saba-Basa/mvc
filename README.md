# PHP Coding Challenge - Simple CRUD Application

## 📌 Project Overview

This project is a simple PHP-based CRUD application (Create, Read, Update, Delete) that allows managing products in a MySQL database. The application is entirely written in pure PHP without any framework and uses PDO for secure and flexible database access.

## 🚀 Features

* Displaying products (Read)
* Adding products (Create)
* Editing products (Update)
* Deleting products (Delete)
* Security features to prevent SQL Injection and XSS

## 📁 Project Structure

```
.
├── composer.json
├── composer.lock
├── config
│   ├── database.example.php (Database configuration example)
│   └── database.php (Database configuration)
├── src
│   ├── Model.php (Base Model class)
│   └── Models
│       └── Products.php (Product model)
└── tests
    ├── ModelTest.php
    └── ProductTest.php
```

## ⚡ Installation

1. **Clone the repository**:

   ```bash
   git clone <repository-url>
   cd <repository-name>
   ```

2. **Database configuration**:

   * Copy `config/database.example.php` to `config/database.php`.
   * Enter your MySQL database credentials in `config/database.php`.

3. **Run Tests**:

   * PHPUnit is used for testing.
   * Run the tests with:

     ```bash
     ./vendor/bin/phpunit tests/ProductTest.php
     ```

## 🚨 Security

* All database operations use prepared statements (PDO) to prevent SQL Injection.
* User inputs are securely escaped in the output to prevent XSS.

## 📌 License

This project is Open Source and licensed under the MIT License.
