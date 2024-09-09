@extends('layouts.master')
@section('title', 'Accounts')
@section('page-styles')
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
    <div class="blog-list-wrapper">
        <div class="row">
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                <!-- post 1 -->
                @if(count($books) > 0)
                @foreach ($books as $book)
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <!-- avatar -->
                            <div class="avatar me-1">
                                <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-18.jpg" alt="avatar img" height="50" width="50" />
                            </div>
                            <!--/ avatar -->
                            <div class="profile-user-info">
                                <h6 class="mb-0"><a href="{{ route('user.social_feed.author_profile', $book->author->id) }}">{{ $book->author->name }}</a></h6>
                                <small class="text-muted">{{ date('M d,Y H:i A', strtotime($book->created_at)) }}</small>
                            </div>
                        </div>
                        <p class="card-text">{{ $book->description }}
                        </p>
                        <!-- post img -->
                        @if(!empty($book->image))
                        <img class="img-fluid rounded mb-75" src="{{ asset('storage/'.$book->image) }}" alt="avatar img" />
                        @endif
                        <!--/ post img -->

                        <!-- like share -->
                        <div class="row d-flex justify-content-start align-items-center flex-wrap pb-50">
                            <div class="col-sm-6 d-flex justify-content-between justify-content-sm-start mb-2">
                                <a href="{{ route('user.books.liked_books', $book->id) }}" class="d-flex align-items-center text-muted text-nowrap">
                                    <i data-feather="heart" class="profile-likes font-medium-3 me-50"></i>
                                    <span>{{ count($book->likedBooks) }}</span>
                                </a>
                            </div>

                            <!-- share and like count and icons -->
                            <div class="col-sm-6 d-flex justify-content-between justify-content-sm-end align-items-center mb-2">
                                <a href="#" class="text-nowrap">
                                    <i data-feather="message-square" class="text-body font-medium-3 me-50"></i>
                                    <span class="text-muted me-1">{{ count($book->rating) }}</span>
                                </a>
                            </div>
                            <!-- share and like count and icons -->
                        </div>
                        <!-- like share -->

                        <!-- comments -->
                        @if (count($book->rating) > 0)
                        @foreach ($book->rating as $rating)
                        <div class="d-flex align-items-start mb-1">
                            <div class="avatar mt-25 me-75">
                                <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" height="34" width="34" />
                            </div>
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">{{ $rating->user->name }}</h6>
                                </div>
                                <ul class="unstyled-list list-inline">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li class="ratings-list-item">
                                            <i data-feather="star"
                                                class="{{ $i <= $rating->rating ? 'filled-star' : 'unfilled-star' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <small>{{ $rating->comment }}</small>
                            </div>
                        </div><hr>
                        @endforeach
                        @endif
                        <!--/ comments -->

                        <!-- comment box -->
                        <!-- comment box -->
                        <form action="{{ route('user.books.rating-store', $book->id) }}" class="form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="rate mb-2">
                                        <input type="radio" id="star5_{{ $book->id }}" name="rate" value="5" />
                                        <label for="star5_{{ $book->id }}" title="text">5 stars</label>

                                        <input type="radio" id="star4_{{ $book->id }}" name="rate" value="4" />
                                        <label for="star4_{{ $book->id }}" title="text">4 stars</label>

                                        <input type="radio" id="star3_{{ $book->id }}" name="rate" value="3" />
                                        <label for="star3_{{ $book->id }}" title="text">3 stars</label>

                                        <input type="radio" id="star2_{{ $book->id }}" name="rate" value="2" />
                                        <label for="star2_{{ $book->id }}" title="text">2 stars</label>

                                        <input type="radio" id="star1_{{ $book->id }}" name="rate" value="1" />
                                        <label for="star1_{{ $book->id }}" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <fieldset class="mb-75">
                                <label class="form-label" for="label-textarea-{{ $book->id }}">Add Comment</label>
                                <textarea class="form-control" id="label-textarea-{{ $book->id }}" rows="3" name="comment" required placeholder="Add Comment"></textarea>
                            </fieldset>
                            <button type="submit" class="btn btn-sm btn-primary">Post Comment</button>
                        </form>
                        <!--/ comment box -->

                    </div>
                </div>
                @endforeach
                @endif
                <!--/ post 1 -->
            </div>
            <div class="col-lg-3 col-12 order-3">

                <!-- suggestion -->
                <div class="card">
                    <div class="card-body">
                        <h5>Suggestions</h5>
                        @if(count($users) > 0)
                        @foreach($users as $user)
                        <div class="d-flex justify-content-start align-items-center mt-2">
                            <div class="avatar me-75">
                                <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-9.jpg" alt="avatar" height="40" width="40" />
                            </div>
                            <div class="profile-user-info">
                                <a href="{{ route('user.social_feed.author_profile', $user->id) }}">
                                <h6 class="mb-0">{{ $user->name }}</h6>
                                </a>
                                <small class="text-muted"></small>
                            </div>
                            @if(!checkUserFollowing($user->id))
                            <a href="{{ route('user.social_feed.store_following_user', $user->id) }}" class="btn btn-primary btn-icon btn-sm ms-auto">
                                <i data-feather="user-plus"></i>
                            </a>
                            @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!--/ suggestion -->
            </div>
        </div>
    </div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')

@endsection
