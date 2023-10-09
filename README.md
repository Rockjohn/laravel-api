# Laravel REST API Development

## The Product API is developed using Laravel, version 10.26.2.

Here are the main steps followed to create the endpoints:

- Create a new Laravel project
- Configure `.env` with the database details

- Create Product Model & Migration: `php artisan make:model Product -m` 
    - Edit Product Migration to add `id`, `name`, `description` and `price`
    - Edit Product Model to allow mass-assignment for these fields
    * No timestamps added to follow exact directions but timestamp fields will be in place most of the times.

- Create **Api** directory under **Controllers** to keep it more organised
    - Create AuthController: `php artisan make:controller AuthController`
        - Edit to add **email** & **pass** Validation and Token Creation if login is successfull
    - Create ProductController: `php artisan make:controller ProductController`
        - Edit to add required methods for CRUD operations

- Check laravel/sanctum (already installed)
    - **Sanctum** is suitable for this API implementation, as we don't require additional options or integration with third-party services.

- Create default & custom migrations/tables: php artisan migrate

- Configure routes in `api.php`:
    - **Unsecured:** `login`, `show`
    - **Secured:** `store`, `update`, `destroy`

- Create `UsersSeeder.php` & `ProductsSeeder.php` to facilitate testing
    - Call them in `DatabaseSeeder.php` to create 4 test users & 4 test products
    - `php artisan db:seed`

- Create some feature tests in `ProductApiTest.php`
    - `php artisan make:factory ProductFactory --model=Product`
    - Edit to add the definitions
    - `php artisan test`