<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of books with category and author names.
     */
    public function index()
    {
        // Fetch all books with category and author names using Query Builder joins
        $books = DB::table('books')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->select(
                'books.*',
                'categories.name as category_name',
                'authors.name as author_name'
            )
            ->orderBy('books.created_at', 'desc')
            ->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        // Fetch categories and authors using Query Builder
        $categories = DB::table('categories')->orderBy('name')->get();
        $authors = DB::table('authors')->orderBy('name')->get();

        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created book in database.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
            'status' => 'required|in:available,borrowed,reserved',
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('covers', $filename, 'public');
            $validated['cover_image'] = $path;
        }

        // Insert book using Query Builder
        DB::table('books')->insert([
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'cover_image' => $validated['cover_image'] ?? null,
            'description' => $validated['description'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified book.
     */
    public function show(string $id)
    {
        // Fetch single book with category and author names
        $book = DB::table('books')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->select(
                'books.*',
                'categories.name as category_name',
                'authors.name as author_name'
            )
            ->where('books.id', $id)
            ->first();

        if (!$book) {
            abort(404);
        }

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(string $id)
    {
        // Fetch the book
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        // Fetch categories and authors using Query Builder
        $categories = DB::table('categories')->orderBy('name')->get();
        $authors = DB::table('authors')->orderBy('name')->get();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    /**
     * Update the specified book in database.
     */
    public function update(Request $request, string $id)
    {
        // Validation rules (ignore current book's ISBN for uniqueness check)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        // Fetch existing book
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('covers', $filename, 'public');
            $validated['cover_image'] = $path;
        } else {
            // Keep existing image
            $validated['cover_image'] = $book->cover_image;
        }

        // Update book using Query Builder
        DB::table('books')
            ->where('id', $id)
            ->update([
                'title' => $validated['title'],
                'isbn' => $validated['isbn'],
                'category_id' => $validated['category_id'],
                'author_id' => $validated['author_id'],
                'cover_image' => $validated['cover_image'],
                'description' => $validated['description'] ?? null,
                'published_at' => $validated['published_at'] ?? null,
                'status' => $validated['status'],
                'updated_at' => now(),
            ]);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified book from database.
     */
    public function destroy(string $id)
    {
        // Fetch the book
        $book = DB::table('books')->where('id', $id)->first();

        if (!$book) {
            abort(404);
        }

        // Delete cover image if exists
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        // Delete book using Query Builder
        DB::table('books')->where('id', $id)->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully!');
    }
}
