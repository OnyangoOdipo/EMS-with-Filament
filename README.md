# Employee Management System (EMS) WITH FILAMENT

## Overview

The **Employee Management System (EMS)** is a comprehensive Laravel based application designed to automate and streamline various aspects of employee management within an organization. The system is tailored to meet specific client requirements, including the automation of employee data management, attendance tracking, leave request processing, and performance evaluation. This project aims to reduce manual errors, improve data accuracy, and enhance overall efficiency in managing human resources.

## Features

### 1. **Employee Data Management**
   - **Overview:** This module allows for the efficient capture and maintenance of employee information, including personal details, job roles, and contact information.
   - **Key Functionalities:**
     - Add, edit, and delete employee records.
     - Auto-fill employee details from existing user data.
     - Integration with the users table to manage employee roles and permissions.

### 2. **Attendance Tracking**
   - **Overview:** This module records employee clock-in/out times, calculates work hours, and generates attendance reports.
   - **Key Functionalities:**
     - Real-time recording of attendance data.
     - Calculation of total work hours per day.
     - Generation of daily, weekly, and monthly attendance reports.
     - Display of attendance statistics on the dashboard.

### 3. **Leave Request Processing**
   - **Overview:** This feature allows employees to request leaves online, automates approval workflows, and keeps track of leave balances.
   - **Key Functionalities:**
     - Employee-initiated leave requests with detailed information.
     - Admin panel for approving or declining leave requests.
     - Tracking of leave balances and history for each employee.
     - Notifications for leave request status changes.

### 4. **Performance Evaluation**
   - **Overview:** This module facilitates the evaluation of employee performance, enabling managers to provide feedback and track progress.
   - **Key Functionalities:**
     - Creation of performance evaluation forms.
     - Recording and tracking of employee performance metrics.
     - Historical view of performance evaluations.
     - Integration with employee records for a comprehensive performance overview.

## Project Structure

The project is organized into several key sections, each responsible for different aspects of the EMS:

- **Models:** Represents the core entities like User, Employee, Attendance, Leave, etc.
- **Controllers:** Handles the logic for each feature, such as UserController, AttendanceController, LeaveController, etc.
- **Migrations:** Defines the database schema for all tables, ensuring consistency across environments.
- **Views:** Contains all the Blade templates for the application's front-end, including custom login, registration, and dashboard pages.
- **Routes:** Defines all the routes for web access, ensuring proper routing of requests to the appropriate controllers.

## Installation Guide

To get the EMS up and running on your local machine, follow these detailed steps:

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL or any other compatible database

### Step 1: Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/OnyangoOdipo/EMS-with-Filament.git
cd EMS-with-Filament
```

### Step 2: Install Dependencies

Install the necessary PHP dependencies using Composer:

```bash
composer install
```

### Step 3: Set Up the Environment

Copy the `.env.example` file to create your `.env` file:

```bash
copy .env.example .env
```

Open the `.env` file and configure your database settings:

```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your database name
DB_USERNAME=your username
DB_PASSWORD=your password
```

### Step 4: Generate Application Key

Generate a new application key:

```bash
php artisan key:generate
```

### Step 5: Run Migrations and Seeders

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

### Step 6: Seed the Database

```bash
php artisan db:seed
```

### Step 7: Serve the Application

Finally, start the Laravel development server:

```bash
php artisan serve
```

The application should now be accessible at `http://localhost:8000`.

### Step 8: Access the Application

- **Admin Login:** You can log in to the admin dashboard using the credentials specified during the seeding process or register a new admin user if needed.
- To access the admin dashaboard use the following url `http://localhost:8000/admin`

- **Employee Management:** Manage employees, track attendance, process leave requests, and perform evaluations through the intuitive admin interface.
- To access the employees dashboard use the following url `http://localhost:8000/login`

## Conclusion

The EMS project is designed to meet the specific needs of modern organizations in managing their workforce efficiently. With its modular design, robust features, and user-friendly interface, it provides a comprehensive solution for automating key HR processes. Whether you need to manage employee data, track attendance, process leaves, or evaluate performance, the EMS system has you covered.