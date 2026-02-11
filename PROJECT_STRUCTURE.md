# BookStock Project Structure

```
assignment-3/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── BookController.php          # All CRUD operations using Query Builder
│   │
│   └── ... (other Laravel app files)
│
├── bootstrap/
│   └── ... (Laravel bootstrap files)
│
├── config/
│   └── ... (Laravel configuration files)
│
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_categories_table.php
│   │   ├── 2024_01_01_000002_create_authors_table.php
│   │   └── 2024_01_01_000003_create_books_table.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php              # Main seeder
│       ├── CategorySeeder.php              # Sample categories
│       └── AuthorSeeder.php                # Sample authors
│
├── public/
│   ├── index.php                           # Entry point
│   └── storage/                            # Symlink (created by storage:link)
│       └── covers/                         # Book cover images (public access)
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── layout.blade.php            # Master layout with Bootstrap 5
│       │
│       └── books/
│           ├── index.blade.php             # List all books
│           ├── create.blade.php            # Create book form
│           └── edit.blade.php              # Edit book form
│
├── routes/
│   ├── web.php                             # Web routes (resourceful routing)
│   └── ... (other route files)
│
├── storage/
│   ├── app/
│   │   └── public/
│   │       └── covers/                     # Actual storage location for covers
│   │
│   ├── framework/
│   └── logs/
│
├── tests/
│   └── ... (test files)
│
├── vendor/
│   └── ... (Composer dependencies)
│
├── .env                                    # Environment configuration (create from .env.example)
├── .env.example                            # Environment template
├── .gitignore
├── artisan                                 # Laravel CLI
├── composer.json                           # PHP dependencies
├── composer.lock
├── package.json                            # Node dependencies (optional)
├── phpunit.xml                             # PHPUnit configuration
└── README.md                               # Project documentation

```

## Key Files Explained

### Controllers
- **BookController.php**: Contains all 7 resourceful methods (index, create, store, show, edit, update, destroy) using `DB::table()` Query Builder

### Migrations
- **2024_01_01_000001_create_categories_table.php**: Creates categories table
- **2024_01_01_000002_create_authors_table.php**: Creates authors table with bio field
- **2024_01_01_000003_create_books_table.php**: Creates books table with foreign keys

### Seeders (Optional)
- **CategorySeeder.php**: Seeds sample categories
- **AuthorSeeder.php**: Seeds sample authors

### Views
- **layout.blade.php**: Master layout with Bootstrap 5, navigation, and alerts
- **index.blade.php**: Displays books in table with joins showing category/author names
- **create.blade.php**: Form to create new book with dropdowns and file upload
- **edit.blade.php**: Form to edit existing book with pre-filled values

### Routes
- **web.php**: Contains `Route::resource('books', BookController::class)`

### Storage
- **storage/app/public/covers/**: Where uploaded book covers are stored
- **public/storage/**: Symlink to storage/app/public (created via `php artisan storage:link`)

## Important Notes

1. **No Eloquent Models**: This project does NOT use any Eloquent models. All database operations use `DB::table()`.

2. **Foreign Keys**: Properly defined in migrations with cascade delete.

3. **Validation**: Implemented in controller methods with error display in views.

4. **File Upload**: Cover images stored in `storage/app/public/covers` and accessed via `asset('storage/...')`.

5. **Bootstrap 5**: Used for responsive UI design.

6. **CSRF Protection**: All forms include `@csrf` token.

7. **Joins**: Index page uses `leftJoin` to display category and author names instead of IDs.
