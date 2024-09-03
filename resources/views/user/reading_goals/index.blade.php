@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
            <div class="col-md-12 mb-2">
                <a href="{{ route('user.reading-goals.create') }}" class="btn btn-primary" style="float: right">Set Reading Goal</a>
            </div>
            @if ($readingGoals)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="page-blog-detail.html" class="blog-title-truncate text-body-heading">
                                    {{ $readingGoals->goal }} Books Goal - {{ $readingGoals->books_read }} Read
                                </a>
                            </h4>
                            <p class="card-text">
                                Year: {{ $readingGoals->year }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <h1 class="text-center text-muted">No Goal Set Yet.</h1>
            @endif
        </div>
    </div>
@endsection

@section('vendor-scripts')
@endsection

@section('page-scripts')
@endsection
