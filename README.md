# Laravel Filament Shield Tutorial

## Introduction
[Filament Shield](https://github.com/bezhanSalleh/filament-shield) is a package that provides role-based access control for Laravel Filament applications. This guide walks you through the installation and configuration of Filament Shield in a Laravel project.

## Prerequisites
- Laravel 10+
- Filament Admin Panel
- Composer

## Installation

### 1. Create a new Laravel project
```sh
composer create-project laravel/laravel my-project
cd my-project
```

### 2. Install Filament and Panel
```sh
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels
```

### 3. Install Filament Shield
```sh
composer require bezhansalleh/filament-shield
```

### 4. Publish Filament Shield Configuration
```sh
php artisan vendor:publish --tag="filament-shield-config"
```

### 5. Add HasRoles Trait to User Model
Edit `app/Models/User.php` and add the `HasRoles` trait:
```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasRoles;
}
```

### 6. Setup Filament Shield Migration and Config Files
```sh
php artisan shield:setup
```

### 7. Install Shield for Your Panel
Replace `admin` with your actual panel ID:
```sh
php artisan shield:install admin
```

### 8. Register Filament Shield Plugin
In your Filament Panel Provider, add the following:
```php
->plugins([
    \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
])
```

## Role Management

### Assigning Roles to New Users
For default or newly registered users, assign the `panel_user` role.
Modify the `User` model:
```php
class User extends Authenticatable implements FilamentUser {
    use HasFactory, Notifiable, HasRoles, HasPanelShield;
}
```

### Seeding Users with Default Role
In your database seeder, assign the `panel_user` role to new users:
```php
$panelUserRole = Role::where('name', 'panel_user')->first();

if (!$panelUserRole) {
    $panelUserRole = Role::create(['name' => 'panel_user']);
}

$user1 = User::factory()->create([
    'name' => 'User 1',
    'email' => 'user1@gmail.com',
    'password' => bcrypt('@user123'),
]);

$user1->assignRole($panelUserRole);
```

## Additional Commands

### Install Shield for a Specific Panel
```sh
php artisan shield:install admin
```

### Generate a Super Admin User
```sh
php artisan shield:super-admin
```

### Generate Policies for All Models
```sh
php artisan shield:generate --all
```

## Conclusion
Filament Shield simplifies role and permission management in Laravel Filament applications. By following this guide, you can easily integrate role-based access control into your Filament-powered project. For more details, refer to the [official documentation](https://github.com/bezhanSalleh/filament-shield).

