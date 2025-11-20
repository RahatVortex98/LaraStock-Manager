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

ADMIN SIDE:
Admin Front Page:

<img width="1366" height="651" alt="admin_front -Page" src="https://github.com/user-attachments/assets/cd63a0b0-7a63-4d33-9acd-39e7021947b3" />

Admin Create Product:

<img width="1366" height="651" alt="admin_create_product" src="https://github.com/user-attachments/assets/c612d245-b936-4288-9a75-c92f295e139a" />

After Adding Product:

<img width="1366" height="651" alt="after adding product" src="https://github.com/user-attachments/assets/9c63b08e-4588-42cc-8336-138e2e2d7152" />

Admin Edited Product:

<img width="931" height="30" alt="admin_edited" src="https://github.com/user-attachments/assets/be0be5ac-221a-4d5e-ac0c-8f11bbe0aa22" />

After Deleted: 

<img width="1366" height="651" alt="admin after_delete" src="https://github.com/user-attachments/assets/92a08b8f-0d61-4a2e-a1e6-a41ade716833" />

Admin track order:

<img width="1366" height="651" alt="admin_Seeing_who_ordered" src="https://github.com/user-attachments/assets/3f998aa8-fdba-4939-9d4a-f35b383a3325" />


Order details:

<img width="1366" height="674" alt="Details about Order" src="https://github.com/user-attachments/assets/f4214a86-2d78-4d93-8f2d-76a4fe4c068c" />

USER SIDE:

<img width="1366" height="651" alt="user Interface" src="https://github.com/user-attachments/assets/3b8fb078-78e5-4cdd-b721-e042fdf3a553" />

Viewing Single product details:

<img width="1366" height="651" alt="view_single_product" src="https://github.com/user-attachments/assets/36d685a3-bc28-463f-bb92-a0627bba08d6" />

Ordered Product Successfully:

<img width="1366" height="651" alt="user_order_successfully" src="https://github.com/user-attachments/assets/e60ffd26-76f5-4007-9ad9-76e846ed4b48" />

Order Details:
<img width="1366" height="651" alt="order_details" src="https://github.com/user-attachments/assets/c7604de1-23a8-4767-a074-d97a6d089943" />
