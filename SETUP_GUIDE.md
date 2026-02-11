# BookStock - Quick Setup Guide

## Prerequisites
- PHP >= 8.1
- Composer
- MySQL
- Laravel 10.x

## Quick Start Commands

### 1. Install Dependencies
```bash
composer install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure Database
Edit `.env` file:
```env
DB_DATABASE=bookstock
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Create Database
```sql
CREATE DATABASE bookstock;
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. (Optional) Seed Sample Data
```bash
php artisan db:seed
```

This will populate:
- 10 categories (Fiction, Non-Fiction, Science Fiction, etc.)
- 8 authors (J.K. Rowling, George Orwell, etc.)

### 7. Create Storage Symlink
**IMPORTANT - Required for image uploads:**
```bash
php artisan storage:link
```

### 8. Start Development Server
```bash
php artisan serve
```

Visit: http://localhost:8000/books

## Testing the Application

### Add Sample Book
1. Click "Add New Book"
2. Fill in:
   - Title: "1984"
   - ISBN: "978-0451524935"
   - Category: Fiction
   - Author: George Orwell
   - Upload a cover image (optional)
   - Description: "Dystopian social science fiction novel"
   - Published Date: 1949-06-08
3. Click "Create Book"

### Verify Features
- ✅ Book appears in list with category and author names
- ✅ Cover image displays correctly
- ✅ Edit button works and pre-fills form
- ✅ Delete button removes book
- ✅ Validation errors show in red

## Common Issues

### Images not showing?
Run: `php artisan storage:link`

### Migration errors?
Drop and recreate database:
```bash
php artisan migrate:fresh
```

### Permission errors?
```bash
chmod -R 775 storage bootstrap/cache
```

## Routes Available

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | /books | index | List all books |
| GET | /books/create | create | Show create form |
| POST | /books | store | Save new book |
| GET | /books/{id} | show | Show single book |
| GET | /books/{id}/edit | edit | Show edit form |
| PUT/PATCH | /books/{id} | update | Update book |
| DELETE | /books/{id} | destroy | Delete book |

## Query Builder Examples Used

### Fetch with Joins
```php
DB::table('books')
    ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
    ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
    ->select('books.*', 'categories.name as category_name', 'authors.name as author_name')
    ->get();
```

### Insert
```php
DB::table('books')->insert([
    'title' => $title,
    'isbn' => $isbn,
    // ...
]);
```

### Update
```php
DB::table('books')->where('id', $id)->update([
    'title' => $title,
    // ...
]);
```

### Delete
```php
DB::table('books')->where('id', $id)->delete();
```

---

**Ready to submit!** 🎉
