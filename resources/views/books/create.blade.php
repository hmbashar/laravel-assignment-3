@extends('layouts.layout')

@section('title', 'Add New Book - BookStock')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Book</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" placeholder="Enter book title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ISBN -->
                        <div class="mb-3">
                            <label for="isbn" class="form-label">
                                ISBN <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn"
                                name="isbn" value="{{ old('isbn') }}" placeholder="Enter ISBN number">
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
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                    name="category_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <select class="form-select @error('author_id') is-invalid @enderror" id="author_id"
                                    name="author_id">
                                    <option value="">-- Select Author --</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Cover Image -->
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">
                                Cover Image
                            </label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                                id="cover_image" name="cover_image" accept="image/jpeg,image/png,image/jpg">
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
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="4"
                                placeholder="Enter book description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Published Date -->
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Published Date</label>
                            <input type="date" class="form-control @error('published_at') is-invalid @enderror"
                                id="published_at" name="published_at" value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Create Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection