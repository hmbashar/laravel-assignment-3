@extends('layouts.layout')

@section('title', 'All Books - BookStock')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2><i class="bi bi-book-fill"></i> All Books</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Book
        </a>
    </div>
</div>

@if(count($books) > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Published Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                             alt="{{ $book->title }}" 
                                             class="book-cover">
                                    @else
                                        <div class="book-cover bg-secondary d-flex align-items-center justify-content-center text-white">
                                            <i class="bi bi-book fs-3"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <strong>{{ $book->title }}</strong>
                                    @if($book->description)
                                        <br>
                                        <small class="text-muted">
                                            {{ Str::limit($book->description, 60) }}
                                        </small>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <code>{{ $book->isbn }}</code>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-info">{{ $book->category_name ?? 'N/A' }}</span>
                                </td>
                                <td class="align-middle">
                                    {{ $book->author_name ?? 'N/A' }}
                                </td>
                                <td class="align-middle">
                                    {{ $book->published_at ? date('M d, Y', strtotime($book->published_at)) : 'N/A' }}
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('books.edit', $book->id) }}" 
                                           class="btn btn-sm btn-warning" 
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this book?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3 text-muted">
        <i class="bi bi-info-circle"></i> Total Books: <strong>{{ count($books) }}</strong>
    </div>
@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> No books found. 
        <a href="{{ route('books.create') }}" class="alert-link">Add your first book</a>
    </div>
@endif
@endsection
