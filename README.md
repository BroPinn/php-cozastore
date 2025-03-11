# 🛒 E-Commerce Web Application

## 📌 Project Overview

This is a full-featured e-commerce web application built with PHP following the MVC (Model-View-Controller) architecture. The application provides both customer-facing and admin interfaces for complete e-commerce functionality, allowing businesses to manage products, categories, orders, and customers while providing shoppers with a seamless shopping experience.

## 🏗 Folder Structure Breakdown

```
├── auth/                   # Authentication related files
│   ├── admin/              # Admin authentication
│   └── client/             # Client authentication
├── controllers/            # Application controllers
│   ├── admin/              # Admin controllers
│   └── client/             # Client controllers
│   └── *.php               # Main controller files (index, shop, blog, etc.)
├── models/                 # Data models
│   ├── AdminModel.php      # Admin user management
│   ├── CategoryModel.php   # Product categories
│   ├── CustomerModel.php   # Customer data management
│   ├── OrderModel.php      # Order processing
│   ├── ProductModel.php    # Product management
│   └── SliderModel.php     # Homepage slider management
├── views/                  # View templates
│   ├── admin/              # Admin interface views
│   └── client/             # Client interface views
├── public/                 # Public assets and entry points
│   ├── admin/              # Admin public files
│   ├── asset/              # Static assets (images, JS, vendor files)
│   ├── database.php        # Database configuration
│   ├── function.php        # Helper functions
│   └── index.php           # Main entry point
├── route/                  # Routing configuration
│   ├── AdminRouter.php     # Admin routing
│   └── ClientRouter.php    # Client routing
├── uploads/                # File upload directory
│   ├── images/             # Product images
│   └── slider/             # Slider images
├── config.php              # Application configuration
├── data.sql                # Database schema and stored procedures
└── README.md               # Project documentation
```

### Key Components:

- **MVC Architecture**: The application follows the Model-View-Controller pattern for clean separation of concerns.
- **Routing System**: Custom routing for both admin and client interfaces.
- **Database Layer**: Uses PDO with stored procedures for secure database operations.
- **Authentication**: Separate authentication systems for admin and client users.
- **File Management**: Organized upload system for product and slider images.

## 🚀 Installation & Setup Guide

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (optional, for dependency management)

### Step-by-Step Installation

1. **Clone the repository** to your web server directory:
   ```bash
   git clone [repository-url] ecom
   ```

2. **Configure your web server**:
   - For Apache: Point document root to the `public` directory
   - For Nginx: Configure to route all requests through `public/index.php`

3. **Create a database**:
   ```sql
   CREATE DATABASE onestore_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```

4. **Import the database schema**:
   ```bash
   mysql -u username -p onestore_db < data.sql
   ```

5. **Configure database connection**:
   - Open `public/database.php`
   - Update the database credentials:
     ```php
     private $host = 'localhost';
     private $dbname = 'onestore_db';
     private $username = 'your_username';
     private $password = 'your_password';
     ```

6. **Set file permissions**:
   ```bash
   chmod 755 -R public/asset/images
   chmod 755 -R uploads
   ```

7. **Test the installation**:
   - Access the customer interface: `http://your-domain.com/`
   - Access the admin interface: `http://your-domain.com/admin/`

## 🛠 Usage Instructions

### Customer Interface

- **Browse Products**: Navigate through categories and view product details
- **Shopping Cart**: Add products to cart, update quantities, and proceed to checkout
- **User Account**: Register, login, and manage your profile and order history
- **Search**: Find products using the search functionality
- **Blog**: Read blog posts and articles

### Admin Interface

- **Access**: Navigate to `http://your-domain.com/admin/`
- **Default Login**: 
  - Username: `admin`
  - Password: `admin123` (change this immediately after first login)

- **Dashboard**: View sales statistics and business overview
- **Products**: Add, edit, delete, and manage product inventory
- **Categories**: Create and manage product categories
- **Orders**: Process and manage customer orders
- **Customers**: View and manage customer accounts
- **Sliders**: Manage homepage banner sliders
- **Settings**: Configure store settings

## 📂 Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+ with stored procedures
- **Frontend**: HTML5, CSS3, JavaScript
- **CSS Framework**: Bootstrap 5
- **JavaScript Libraries**: jQuery
- **Architecture**: MVC (Model-View-Controller)
- **Security**: PDO prepared statements, password hashing
- **File Storage**: Local file system

## 🎯 Features

### Customer Features

- **Product Catalog**: Browse products by category with filtering options
- **User Accounts**: Registration, login, profile management
- **Shopping Cart**: Add, update, remove items
- **Checkout Process**: Secure checkout with multiple payment options
- **Order Tracking**: Track order status and history
- **Wishlist**: Save products for later
- **Blog**: Read articles and news
- **Contact Form**: Get in touch with the store

### Admin Features

- **Dashboard**: Sales analytics and business overview
- **Product Management**: CRUD operations for products
- **Category Management**: Organize products into categories
- **Order Management**: Process and track orders
- **Customer Management**: View and manage customer accounts
- **Content Management**: Blog posts and sliders
- **Settings**: Store configuration and preferences

## 🔧 Troubleshooting & Common Errors

### Database Connection Issues

- **Error**: "Database Connection Failed"
  - **Solution**: Verify database credentials in `public/database.php`
  - **Solution**: Ensure MySQL service is running

### File Upload Problems

- **Error**: "Permission Denied"
  - **Solution**: Check directory permissions for `uploads/` folder
  - **Solution**: Set proper ownership: `chown www-data:www-data -R uploads/`

### Blank Page or 500 Error

- **Solution**: Check PHP error logs (usually in `/var/log/apache2/error.log` or similar)
- **Solution**: Enable error reporting in development:
  ```php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  ```

### Missing Features

- **Issue**: OrderModel.php and CustomerModel.php are empty
  - **Solution**: Implement these models following the pattern of existing models like ProductModel.php

## 👥 Contribution Guidelines

1. **Fork the repository**
2. **Create a feature branch**:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Commit your changes**:
   ```bash
   git commit -m "Add some feature"
   ```
4. **Push to the branch**:
   ```bash
   git push origin feature/your-feature-name
   ```
5. **Create a Pull Request**

### Coding Standards

- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Add comments for complex logic
- Write unit tests for new features

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Support

For support, please email [support@example.com] or create an issue in the repository.