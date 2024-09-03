@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
            @if (count($books) > 0)
                @foreach ($books as $book)
                    <div class="col-md-4">
                        <div class="card">
                            <a href="page-blog-detail.html">
                                <img class="card-img-top img-fluid" src="../../../app-assets/images/slider/02.jpg"
                                    alt="Blog Post pic">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="page-blog-detail.html" class="blog-title-truncate text-body-heading">
                                        {{ $book->title }}</a>
                                </h4>
                                <div class="d-flex">
                                    <div class="avatar me-50">
                                        <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar"
                                            width="24" height="24">
                                    </div>
                                    <div class="author-info">
                                        <small class="text-muted me-25">by</small>
                                        <small><a href="#" class="text-body">{{ $book->author->name }}</a></small>
                                        <span class="text-muted ms-50 me-25">|</span>
                                        <small
                                            class="text-muted">{{ date('M d,Y', strtotime($book->publish_date)) }}</small>
                                    </div>
                                </div>
                                <div class="my-1 py-25">
                                    @foreach (explode(',', $book->genre) as $genre)
                                        <a href="#">
                                            <span
                                                class="badge rounded-pill badge-light-info me-50">{{ $genre }}</span>
                                        </a>
                                    @endforeach

                                </div>
                                <p class="card-text blog-content-truncate">
                                    {{ substr($book->description, 0, 50) }}
                                </p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="page-blog-detail.html#blogComment">
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-message-square font-medium-1 text-body me-50">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                </path>
                                            </svg>
                                            <span class="text-body fw-bold">{{ count($book->rating) }} Comments</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('user.books.detail', $book->id) }}" class="fw-bold">Detail More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-muted">No Books Found</h1>
            @endif
        </div>
    </div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')

@endsection
