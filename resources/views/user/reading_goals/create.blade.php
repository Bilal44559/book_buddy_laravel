@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 mb-2">
                    <h1>Your Reading Goals for {{ date('Y') }}</h1>
                </div>
                <div class="col-md-6">
                    @if ($readingGoals)
                    <p>Goal: Read {{ $readingGoals->goal }} books</p>
                    <p>Books Read: {{ $readingGoals->books_read }}</p>

                    <form action="{{ route('user.reading-goals.update', $readingGoals->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="goal">Set Your Reading Goal for {{ date('Y') }}:</label>
                            <input type="number" min="1" class="form-control" id="goal" name="goal" value="{{ $readingGoals->goal }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Update Goal</button>
                    </form>
                @else
                    <form action="{{ route('user.reading-goals.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="goal">Set Your Reading Goal for {{ date('Y') }}:</label>
                            <input type="number" min="1" class="form-control" id="goal" name="goal">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Set Goal</button>
                    </form>
                @endif
                </div>
            </div>
        </div>

    </div>


</div>
@endsection
