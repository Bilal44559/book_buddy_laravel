@extends('layouts.master')
@section('title', 'Accounts')
@section('page-styles')
    <style>
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
    <div class="blog-list-wrapper">
        <div class="row mb-2">
            <div class="col-md-12">
                <h2>Badges</h2>
            </div>
            @if (count($allAssignedBadges) > 0)
                @foreach ($allAssignedBadges as $allAssignedBadge)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="badge-icon">
                                    <img src="{{ asset('storage/' . $allAssignedBadge->icon) }}"
                                        alt="{{ $allAssignedBadge->title }}" class="img-thumbnail" width="100">
                                </div>
                                <hr>
                                <h4 class="card-title">
                                    <a href="page-blog-detail.html" class="blog-title-truncate text-body-heading">
                                        {{ $allAssignedBadge->title }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-muted">No Badge Yet</h1>
            @endif
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <h2>Groups</h2>
            </div>
            @if (count($groups) > 0)
                @foreach ($groups as $group)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="page-blog-detail.html" class="blog-title-truncate text-body-heading">
                                        {{ $group->name }}</a>
                                </h4>
                                <hr>
                                <p class="card-text"><span><b>Group ID: </b>{{ $group->id }}</b></span></p>
                                <p class="card-text"><span><b>Active Members:
                                        </b>{{ $group->joined_users->where('status', 'accepted')->count() }}</b></span></p>
                                <p class="card-text"><span><b>Pending Members:
                                        </b>{{ $group->joined_users->where('status', 'pending')->count() }}</b></span></p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('user.groups.events', $group->id) }}" class="fw-bold">Detail More</a>
                                    @php
                                        $check_group_joined = checkGroupJoined($group->id, auth()->user()->id);
                                    @endphp
                                    @if ($check_group_joined['status'] == 0)
                                        <a href="{{ route('user.groups.joined-request', $group->id) }}"
                                            class="btn btn-success">Join Group</a>
                                    @else
                                        <span class="fw-bold">{{ ucwords($check_group_joined['data']['status']) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('user.groups.members', $group->id) }}"
                                    class="btn btn-primary col-md-12 mt-1">View Members</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-muted">No Groups Found</h1>
            @endif
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <h2>Reviews</h2>
            </div>
            <div class="col-lg-12 com-d-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="table-responsive">
                                    <table class="datatables-basic table table-bordered table-striped text-center"
                                        id="myTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Book</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            @if(count($ratings) > 0)
                                            @foreach($ratings as $rating)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rating->book->title }}</td>
                                                <td>{{ $rating->rating }}
                                                    <ul class="unstyled-list list-inline">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li class="ratings-list-item">
                                                                <i data-feather="star"
                                                                    class="{{ $i <= $rating->rating ? 'filled-star' : 'unfilled-star' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </td>
                                                <td>{{ $rating->comment }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <h2>Read Books</h2>
            </div>
            @if (count($read_books) > 0)
                @foreach ($read_books as $read_book)
                    <div class="col-md-4">


                        <div class="card">
                            <a href="{{ route('user.books.detail', $read_book->book->id) }}">
                                @if(!empty($read_book->book->image))
                                <img class="card-img-top img-fluid" src="{{ asset('storage/'.$read_book->book->image) }}"
                                alt="{{ $read_book->book->title }}">
                                @else
                                <img class="card-img-top img-fluid" src="{{asset('/')}}app-assets/images/slider/02.jpg"
                                    alt="Blog Post pic">
                                @endif
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('user.books.detail', $read_book->book->id) }}" class="blog-title-truncate text-body-heading">
                                        {{ $read_book->book->title }}</a>
                                </h4>
                                <div class="d-flex">
                                    <div class="avatar me-50">
                                        <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar"
                                            width="24" height="24">
                                    </div>
                                    <div class="author-info">
                                        <small class="text-muted me-25">by</small>
                                        <small><a href="#" class="text-body">{{ $read_book->book->author->name }}</a></small>
                                        <span class="text-muted ms-50 me-25">|</span>
                                        <small
                                            class="text-muted">{{ date('M d,Y', strtotime($read_book->book->publish_date)) }}</small>
                                    </div>
                                </div>
                                <div class="my-1 py-25">
                                    @foreach (explode(',', $read_book->book->genre) as $genre)
                                        <a href="#">
                                            <span
                                                class="badge rounded-pill badge-light-info me-50">{{ $genre }}</span>
                                        </a>
                                    @endforeach

                                </div>
                                <p class="card-text blog-content-truncate">
                                    {{ substr($read_book->book->description, 0, 50) }}
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
                                            <span class="text-body fw-bold">{{ count($read_book->book->rating) }} Comments</span>
                                        </div>
                                    </a>
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
