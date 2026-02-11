@extends('layouts.layout')

@section('title', 'Edit Book - BookStock')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning">
                <h4 class="mb-0"><i class="bi bi-pencil"></i> Edit Book</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $book->title) }}" 
                               placeholder="Enter book title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">
                            ISBN <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('isbn') is-invalid @enderror" 
                               id="isbn" 
                               name="isbn" 
                               value="{{ old('isbn', $book->isbn) }}" 
                               placeholder="Enter ISBN number">
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">
                                Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" 
                                    name="category_id">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ (old('category_id', $book->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="col-md-6 mb-3">
                            <label for="author_id" class="form-label">
                                Author <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('author_id') is-invalid @enderror" 
                                    id="author_id" 
                                    name="author_id">
                                <option value="">-- Select Author --</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" 
                                            {{ (old('author_id', $book->author_id) == $author->id) ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Current Cover Image -->
                    @if($book->cover_image)
                        <div class="mb-3">
                            <label class="form-label">Current Cover Image</label>
                            <div>
                                <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                     alt="{{ $book->title }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 150px;">
                            </div>
                        </div>
                    @endif

                    <!-- Cover Image -->
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">
                            Cover Image {{ $book->cover_image ? '(Upload new to replace)' : '' }}
                        </label>
                        <input type="file" 
                               class="form-control @error('cover_image') is-invalid @enderror" 
                               id="cover_image" 
                               name="cover_image" 
                               accept="image/jpeg,image/png,image/jpg">
                        <small class="form-text text-muted">
                            Accepted formats: JPEG, PNG, JPG. Max size: 2MB
                        </small>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Enter book description">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Published Date -->
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Published Date</label>
                        <input type="date" 
                               class="form-control @error('published_at') is-invalid @enderror" 
                               id="published_at" 
                               name="published_at" 
                               value="{{ old('published_at', $book->published_at) }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
