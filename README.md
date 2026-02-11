# Assignment : Assignment-03

### Name : Md Abul Bashar

### Email : hmbashar@gmail.com

---

## Project Overview

**BookStock** is a Laravel-based book management system that demonstrates CRUD operations using Laravel's Query Builder (DB facade) without Eloquent models. This project fulfills academic assignment requirements for database-driven web application development.

## Features

- ✅ Complete CRUD operations for books
- ✅ Category and Author management
- ✅ Image upload for book covers
- ✅ Form validation with error messages
- ✅ Query Builder only (No Eloquent)
- ✅ Responsive Bootstrap UI
- ✅ Foreign key relationships

## Technology Stack

- **Framework**: Laravel 10.x
- **Database**: MySQL/SQLite
- **Frontend**: Blade Templates + Bootstrap 5
- **File Storage**: Laravel Storage (public disk)

## Database Schema

### Tables

1. **categories**
   - id (Primary Key)
   - name

2. **authors**
   - id (Primary Key)
   - name
   - bio (text)

3. **books**
   - id (Primary Key)
   - title
   - isbn (unique)
   - category_id (Foreign Key → categories.id)
   - author_id (Foreign Key → authors.id)
   - cover_image
   - description (text)
   - published_at (date)

## Installation & Setup

### Prerequisites

- PHP >= 8.5
- Composer
- MySQL
- Node.js & NPM (optional, for asset compilation)

### Step 1: Clone or Extract Project

```bash
cd assignment-3
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Edit `.env` and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstock
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Create Database

Create a MySQL database named `bookstock`:

```sql
CREATE DATABASE bookstock;
```

### Step 6: Run Migrations

```bash
php artisan migrate
```

This will create all required tables with proper foreign key constraints.

### Step 7: (Optional) Seed Sample Data

```bash
php artisan db:seed
```

This will populate:
- 10 categories (Fiction, Non-Fiction, Science Fiction, etc.)
- 8 authors (J.K. Rowling, George Orwell, etc.)

### Step 8: Create Storage Symlink

**IMPORTANT**: This command must be executed to enable public access to uploaded cover images:

```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public`.

### Step 9: Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000/books`

## Usage

### Adding a Book

1. Click "Add New Book" button
2. Fill in all required fields:
   - Title (required)
   - ISBN (required, unique)
   - Category (required, select from dropdown)
   - Author (required, select from dropdown)
   - Cover Image (optional, max 2MB, jpeg/png/jpg)
   - Description (optional)
   - Published Date (optional)
3. Click "Create Book"

### Editing a Book

1. Click "Edit" button next to any book
2. Modify fields as needed
3. Click "Update Book"

### Deleting a Book

1. Click "Delete" button next to any book
2. Confirm deletion

## Project Structure

```
assignment-3/
├── app/
│   └── Http/
│       └── Controllers/
│           └── BookController.php    # All CRUD logic using Query Builder
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_categories_table.php
│   │   ├── 2024_01_01_000002_create_authors_table.php
│   │   └── 2024_01_01_000003_create_books_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php        # Main seeder
│       ├── CategorySeeder.php        # Sample categories
│       └── AuthorSeeder.php          # Sample authors
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── layout.blade.php      # Master layout with Bootstrap
│       └── books/
│           ├── index.blade.php       # List all books
│           ├── create.blade.php      # Create new book form
│           └── edit.blade.php        # Edit book form
├── routes/
│   └── web.php                       # Resourceful routes
├── storage/
│   └── app/
│       └── public/
│           └── covers/               # Book cover images stored here
├── .env.example                      # Environment configuration template
└── README.md                         # This file
```

## Key Implementation Details

### Query Builder Usage

This project **does not use Eloquent models**. All database operations use Laravel's Query Builder via the `DB` facade:

```php
// Example: Fetching books with joins
$books = DB::table('books')
    ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
    ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
    ->select('books.*', 'categories.name as category_name', 'authors.name as author_name')
    ->get();
```

### Validation Rules

- **title**: required
- **author_id**: required
- **category_id**: required
- **isbn**: required, unique (ignores current record on update)
- **cover_image**: nullable, image, mimes:jpeg,png,jpg, max:2048 KB

### File Upload

Cover images are stored in `storage/app/public/covers/` and accessed via:

```blade
<img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover">
```

## Troubleshooting

### Images Not Displaying

Make sure you've run:
```bash
php artisan storage:link
```

### Migration Errors

If you encounter foreign key errors, ensure migrations run in order:
1. categories
2. authors
3. books

### Permission Issues

Ensure storage directory is writable:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Academic Notes

This project demonstrates:
- ✅ MVC architecture pattern
- ✅ Database migrations with foreign keys
- ✅ Query Builder (DB facade) instead of Eloquent
- ✅ Resourceful routing
- ✅ Form validation with error display
- ✅ File upload handling
- ✅ Blade templating with layouts
- ✅ Bootstrap integration

---

**Submitted by**: Md Abul Bashar  
**Email**: hmbashar@gmail.com  
**Assignment**: Assignment-03  
**Date**: February 2026
