# Tiny Address Book Backend in Core Php and Frontend in Angular

## Core PHP Backend Application Setup Guide

This guide provides step-by-step instructions on how to setup application with routes, env, create database and insert some test data.

## Prerequisites

> Before you start, ensure you have **PHP**, **MySQL** and **Composer** installed and running on your system. This project is designed to be run in a local development environment such as **XAMPP**, **WAMP** or any native **PHP** server setup.

## Installation

### Clone or Download the Project:

Clone the project repository to your local machine or download the ZIP file and extract it

### Place the Project in Your PHP Environment:

- For **XAMPP**, place the tiny-address-book-php-angular folder in the htdocs directory.
- For **WAMP**, place it in the www directory.
- If you're using a native PHP environment or any other setup, ensure the project directory is placed in a location where your PHP server can execute it.

### Run the Backend Server:

- Ensure your **PHP** and **MySQL** services are running.
- Access the backend application through your web browser:

```bash
http://localhost/tiny-address-book-php-angular/backend/public/
```

### Configure Your Environment:

- Navigate to the project's **backend** directory.
- Copy **.env.example** to a new file named **.env**.
- Edit the **.env** file to set your database connection details, including the database name, user, and password.

### Configure Composer for Autoloading:

- Open a terminal or command prompt.
- Navigate to the root directory of the backend application.
- To generate the **vendor** directory and the **autoload.php** file.**Note**: if vendor folder does not exists then run following command else you can **Skip** this step.

```bash
composer dump-autoload
```

### Database Setup:

- Ensure **MySQL** is running.
- Open your **MySQL client** (phpMyAdmin, MySQL Workbench, or command line).
- Create a new database named as per the **.env** file configuration.
- Import the SQL file located in **backend/database/setup.sql** to create tables and insert test data.
  If you are unable to import the SQL file through a MySQL client, you can execute the database migration and seeding by accessing the following URL:

```plaintext
http://localhost/tiny-address-book-php-angular/backend/public/migrate
```

# Angular Application Setup Guide

This guide provides step-by-step instructions on how to create, serve, and manage an Angular application with additional components, services, and configuration.

## Prerequisites

> Before you start, make sure you have **Node.js** and **npm** installed on your system. Angular CLI requires **Node.js** version **18** or later.

## Setup

### Install Angular CLI

To create an Angular project, you need to install the Angular CLI globally:

```bash
npm install -g @angular/cli
```

### Create a New Angular Project

Initialize a new Angular project by running:

```bash
ng new frontend
```

Follow the prompts to set up your project preferences.

- Which stylesheet format would you like to use? - SCSS
- Do you want to enable Server-Side Rendering (SSR) and Static Site Generation (SSG/Prerendering)? No

### Serve the Project

To serve your project locally, navigate to your project directory and run:

```bash
cd frontend
ng serve
```

### Access application through your web browser:

```bash
http://localhost:4200/
```

### Generating Components

- Generate the necessary components for the address book feature:

```bash
ng generate component components/address-book
ng generate component components/address-book/grid
ng generate component components/address-book/form
```

- Create additional UI components:

```bash
ng generate component components/header
ng generate component components/footer
ng generate component components/toaster
```

### Adding Bootstrap

Install @ng-bootstrap/ng-bootstrap for Bootstrap integration:

```bash
npm install @ng-bootstrap/ng-bootstrap@next --force
npm install bootstrap bootstrap-icons
ng add @ng-bootstrap/ng-bootstrap --legacy-peer-deps
```

### Generating Services

Create services for the address book and toaster notifications:

```bash
ng generate service services/address-book
ng generate service services/toaster
```

### Generating Interceptor

Generate an interceptor for handling errors:

```bash
ng generate interceptor helpers/error
```

### Environment Configuration

Generate environment files for different deployment settings:

```bash
ng generate environments
```
