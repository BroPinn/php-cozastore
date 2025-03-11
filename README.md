# E-Commerce Web Application

A full-featured e-commerce web application built with PHP following the MVC (Model-View-Controller) architecture. The application includes both customer-facing and admin interfaces for complete e-commerce functionality.

## Project Structure

```
├── auth/                   # Authentication related files
│   ├── admin/              # Admin authentication
│   └── client/             # Client authentication
├── controllers/            # Application controllers
│   ├── admin/              # Admin controllers
│   └── client/             # Client controllers
├── models/                 # Data models
├── views/                  # View templates
│   ├── admin/              # Admin interface views
│   └── client/             # Client interface views
├── public/                 # Public assets and entry points
│   ├── admin/              # Admin public files
│   ├── asset/              # Static assets (images, JS, vendor files)
│   ├── database.php        # Database configuration
│   ├── function.php        # Helper functions
│   └── index.php          # Main entry point
└── route/                  # Routing configuration
```

## Features

### Customer Features
- Product browsing and shopping cart functionality
- User account management
- Checkout process
- Blog section
- Contact form

### Admin Features
- Dashboard for business overview
- Product management
- Category management
- Slider/banner management
- Order management
- Settings configuration

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (for dependency management)

## Installation

1. Clone the repository to your web server directory:
   ```bash
   git clone [repository-url] ecom
   ```

2. Configure your web server to point to the `public` directory as the document root.

3. Create a new MySQL database for the application.

4. Configure the database connection:
   - Open `public/database.php`
   - Update the database credentials with your settings

5. Import the database schema (if provided in a SQL file).

6. Set appropriate file permissions:
   ```bash
   chmod 755 -R public/asset/images
   ```

## Usage

### Customer Interface
- Access the main website through: `http://your-domain.com`
- Browse products, add items to cart, and complete purchases
- Create an account to track orders and manage profile

### Admin Interface
- Access the admin panel through: `http://your-domain.com/admin`
- Default admin credentials (make sure to change these):
  - Username: admin
  - Password: admin123

## Directory Structure Details

### Controllers
- `controllers/admin/` - Admin panel functionality
- `controllers/client/` - Customer-facing functionality

### Models
- `AdminModel.php` - Admin user management
- `CategoryModel.php` - Product categories
- `CustomerModel.php` - Customer data management
- `OrderModel.php` - Order processing
- `ProductModel.php` - Product management
- `SliderModel.php` - Homepage slider management

### Views
- `views/admin/` - Admin interface templates
- `views/client/` - Customer interface templates

## Security

- All user inputs are sanitized
- Passwords are hashed
- Admin area is protected with authentication
- Form submissions are protected against CSRF

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please email [support@example.com] or create an issue in the repository.