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
    <div class="row">
        <div class="col-md-9">
            <div class="blog-detail-wrapper">
                <div class="row">
                    <!-- Blog -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="">
                                    <h1>{{ $event->name }}</h1><hr>
                                    <div class="author-info">
                                        <span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $event->type)) }}</span>
                                    </div>
                                </div>
                                <div class="my-1 py-25">
                                    <a href="#">
                                        <span class="badge rounded-pill badge-light-info me-50"></span>
                                    </a>
                                </div>
                                <p class="card-text mb-2">
                                    <span><b>Description:</b></span><br>{{ $event->description }}</p>
                                </p>
                                <hr class="my-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center me-1">
                                            <a href="#" class="me-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-message-square font-medium-5 text-body align-middle">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#">
                                                <div class="text-body align-middle">{{ count($event->all_comments) }}</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Blog -->

                    <!-- Blog Comment -->

                    <div class="col-12 mt-1" id="blogComment">
                        <h6 class="section-label mt-25">Comment</h6>
                        @foreach ($event->comments as $comment)
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-75">
                                            <img src="{{ asset('app-assets/images/portrait/small/avatar-s-9.jpg') }}"
                                                width="38" height="38" alt="Avatar">
                                        </div>

                                    </div>
                                    <div class="author-info">
                                        <h6 class="fw-bolder mb-25">{{ $comment->user->name }}</h6>
                                        <p class="card-text">{{ $comment->created_at->diffForHumans() }}</p>
                                        <p class="card-text">
                                            {{ $comment->comment }}
                                        </p>
                                        <!-- Reply Link -->
                                        <a href="javascript:void(0);">
                                            <div class="d-inline-flex align-items-center"
                                                onclick="openReplyModal({{ $comment->id }})">
                                                <i data-feather="corner-up-left" class="font-medium-3 me-50"></i>
                                                <span>Reply</span>
                                            </div>
                                        </a>

                                    </div>
                                    @if(count($comment->sub_comments) > 0)
                                    @foreach($comment->sub_comments as $sub_comment)
                                    <div style="margin-left: 50px;" class="mt-1">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar me-75">
                                                <img src="{{ asset('app-assets/images/portrait/small/avatar-s-9.jpg') }}"
                                                    width="38" height="38" alt="Avatar">
                                            </div>

                                        </div>
                                        <div class="author-info">
                                            <h6 class="fw-bolder mb-25">{{ $sub_comment->user->name }}</h6>
                                            <p class="card-text">{{ $sub_comment->created_at->diffForHumans() }}</p>
                                            <p class="card-text">
                                                {{ $sub_comment->comment }}
                                            </p>
                                            <!-- Reply Link -->
                                            <a href="javascript:void(0);">
                                                <div class="d-inline-flex align-items-center"
                                                    onclick="openReplyModal({{ $sub_comment->id }})">
                                                    <i data-feather="corner-up-left" class="font-medium-3 me-50"></i>
                                                    <span>Reply</span>
                                                </div>
                                            </a>
                                            @if(count($sub_comment->sub_comments) > 0)
                                            @foreach($sub_comment->sub_comments as $last_sub_comment)
                                            <div style="margin-left: 50px;" class="mt-1">
                                                <div class="d-flex align-items-start">
                                                    <div class="avatar me-75">
                                                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-9.jpg') }}"
                                                            width="38" height="38" alt="Avatar">
                                                    </div>

                                                </div>
                                                <div class="author-info">
                                                    <h6 class="fw-bolder mb-25">{{ $last_sub_comment->user->name }}</h6>
                                                    <p class="card-text">{{ $last_sub_comment->created_at->diffForHumans() }}</p>
                                                    <p class="card-text">
                                                        {{ $last_sub_comment->comment }}
                                                    </p>

                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Bootstrap Modal -->
                    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('user.groups.events.eventcomment_reply_store') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="replyModalLabel">Reply to Comment
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="comment_id" id="commentId">
                                        <textarea class="form-control" rows="3" name="reply_comment" id="replyText" placeholder="Write a reply..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit
                                            Reply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/ Blog Comment -->

                    <!-- Leave a Blog Comment -->
                    <form action="{{ route('user.groups.events.eventcomment_store', $event->id) }}" method="POST">
                        @csrf
                        <div class="col-12 mt-1">
                            <h6 class="section-label mt-25">Leave a Comment</h6>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" value="{{ $event->id }}" name="event_id">
                                        <div class="col-12">
                                            <textarea class="form-control mb-2" rows="4" placeholder="Comment" name="comment"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-float waves-light">Post
                                                Comment</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ Leave a Blog Comment -->
                </div>
            </div>
        </div>

    </div>
@endsection
@section('vendor-scripts')
@endsection
@push('page-scripts')
    {{-- <script src="{{ asset('/') }}app-assets/js/scripts/pages/app-ecommerce-details.js"></script> --}}

    <script>
        function openReplyModal(commentId) {
            // Set the comment ID in the hidden input field
            document.getElementById('commentId').value = commentId;

            // Open the modal
            var replyModal = new bootstrap.Modal(document.getElementById('replyModal'));
            replyModal.show();
        }
    </script>
@endpush
