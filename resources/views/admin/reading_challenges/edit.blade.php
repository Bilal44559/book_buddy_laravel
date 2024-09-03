@extends('layouts.master')
@section('title', 'Edit Reading Challenge')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Edit Reading Challenge</h1>

                    <form action="{{ route('reading-challenges.update', $challenge->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="title">Challenge Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $challenge->title }}" required>
                        </div>

                        <div class="form-group mb-1">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $challenge->description }}</textarea>
                        </div>

                        <div class="form-group mb-1">
                            <label for="time_frame">Time Frame</label>
                            <select class="form-control" id="time_frame" name="time_frame" required>
                                <option value="1 week" {{ $challenge->time_frame == '1 week' ? 'selected' : '' }}>1 Week</option>
                                <option value="1 month" {{ $challenge->time_frame == '1 month' ? 'selected' : '' }}>1 Month</option>
                                <option value="3 months" {{ $challenge->time_frame == '3 months' ? 'selected' : '' }}>3 Months</option>
                            </select>
                        </div>

                        <div class="form-group mb-1">
                            <label for="icon">Challenge Icon</label>
                            <input type="file" class="form-control-file" id="icon" name="icon">
                            @if ($challenge->icon)
                                <img src="{{ asset('storage/' . $challenge->icon) }}" alt="{{ $challenge->title }}" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>

                        <div class="form-group mb-1">
                            <label for="books">Select Books</label>
                            <select class="form-control select2" id="books" name="books[]" multiple required>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" {{ in_array($book->id, $challenge->books->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Update Challenge</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
