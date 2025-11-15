# LaraStock Manager: Inventory Management System (Laravel 12) 📦

## Overview

**LaraStock Manager** is a complete, full-stack **Inventory Management System (IMS)** application built using the latest version of the **Laravel 12** framework. This project serves as a comprehensive guide and foundation for developers looking to implement real-world business logic, database management, and authenticated workflows in a modern PHP environment.

## Features

This system, when complete, will provide the following core functionalities:

* **Stock Tracking:** Real-time visibility into current product quantities and stock levels.
* **Product Management:** CRUD operations for adding, editing, and categorizing inventory items.
* **Transaction Logging:** Recording all incoming (purchases) and outgoing (sales) movements.
* **Supplier & Customer Data:** Centralized management of third-party contacts.
* **User Authentication:** Secure login and registration (to be implemented in subsequent steps).
* **Reporting:** Generation of essential inventory reports (e.g., low stock, sales history).

## Technologies Used

* **Framework:** PHP (Laravel 12)
* **Database:** MySQL
* **Environment:** XAMPP (or WAMP/MAMP)
* **Dependency Management:** Composer
* **Frontend Tools:** NodeJS & npm

## Prerequisites

Before starting, ensure you have the following installed on your system:

1.  **XAMPP/WAMP/MAMP** (For PHP and MySQL)
2.  **Composer** (PHP dependency manager)
3.  **NodeJS** (For running npm scripts and compiling assets)

## Installation Guide

Follow these steps to set up the **LaraStock Manager** project locally:

### 1. Clone the Repository

bash
git clone <repository-url> lara-stock-manager
cd lara-stock-manager

### 2. Install Laravel and PHP Dependencies
Use Composer to install all necessary backend packages:
>composer install

3. Configure the Environment
    i)Create a copy of the .env.example file and rename it to .env:
       >cp .env.example .env

    ii)Set your database credentials in the .env file (e.g., DB_DATABASE,DB_USERNAME, DB_PASSWORD).

    iii)Generate the application encryption key:
       >php artisan key:generate
   
4. Database Setup
Run the migrations to create the necessary tables in your MySQL database:
       >php artisan migrate
(Note: Ensure your MySQL server is running via XAMPP/MAMP before running this command)

5. Frontend Setup
Install the required NodeJS modules and build the frontend assets:
        >npm install
        >npm run dev  # or npm run build for production
   
6. Run the Application
Start the local Laravel development server:
        >php artisan serve
   
The application will now be accessible in your web browser at: http://127.0.0.1:8000

Screenshots of this project:

