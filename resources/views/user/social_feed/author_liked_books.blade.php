@extends('layouts.master')
@section('title', 'Accounts')
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/css/pages/page-profile.css">
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        display: none;
        /* top: -9999px; */
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .filled-star {
        fill: #ff9f43;
        stroke: #ff9f43;
        color: #ff9f43;
    }

    .unfilled-star {
        stroke: #babfc7;
        color: #babfc7;
    }
</style>
@endsection
@section('content')
<div id="user-profile">
    @include('user.social_feed.profile_header')

    <!-- profile info section -->
    <section id="profile-info">
        <div class="row">
            @if (count($user->liked_books) > 0)
            @foreach ($user->liked_books as $liked_book)
                <div class="col-md-4">


                    <div class="card">
                        <a href="{{ route('user.books.detail', $liked_book->book->id) }}">
                            @if(!empty($liked_book->book->image))
                            <img class="card-img-top img-fluid" src="{{ asset('storage/'.$liked_book->book->image) }}"
                            alt="{{ $liked_book->book->title }}">
                            @else
                            <img class="card-img-top img-fluid" src="{{asset('/')}}app-assets/images/slider/02.jpg"
                                alt="Blog Post pic">
                            @endif
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('user.books.detail', $liked_book->book->id) }}" class="blog-title-truncate text-body-heading">
                                    {{ $liked_book->book->title }}</a>
                            </h4>
                            <div class="d-flex">
                                <div class="avatar me-50">
                                    <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar"
                                        width="24" height="24">
                                </div>
                                <div class="author-info">
                                    <small class="text-muted me-25">by</small>
                                    <small><a href="#" class="text-body">{{ $liked_book->book->author->name }}</a></small>
                                    <span class="text-muted ms-50 me-25">|</span>
                                    <small
                                        class="text-muted">{{ date('M d,Y', strtotime($liked_book->book->publish_date)) }}</small>
                                </div>
                            </div>
                            <div class="my-1 py-25">
                                @foreach (explode(',', $liked_book->book->genre) as $genre)
                                    <a href="#">
                                        <span
                                            class="badge rounded-pill badge-light-info me-50">{{ $genre }}</span>
                                    </a>
                                @endforeach

                            </div>
                            <p class="card-text blog-content-truncate">
                                {{ substr($liked_book->book->description, 0, 50) }}
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
                                        <span class="text-body fw-bold">{{ count($liked_book->book->rating) }} Comments</span>
                                    </div>
                                </a>
                                <a href="{{ route('user.books.detail', $liked_book->book->id) }}" class="fw-bold">Detail More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="text-center text-muted">No Books Found</h1>
        @endif
        </div>
    </section>
    <!--/ profile info section -->
</div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')

@endsection
