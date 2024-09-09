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

        #pdf-canvas {
            width: 100%;
            max-width: 600px;
            /* Set a maximum width */
            height: auto;
            margin: 0 auto;
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
                            @if(!empty($book->image))
                            <img src="{{ asset('storage/'.$book->image) }}" class="img-fluid card-img-top"
                            alt="{{ $book->title }}">
                            @else
                            <img src="{{asset('/')}}app-assets/images/banner/banner-12.jpg" class="img-fluid card-img-top"
                                alt="Blog Detail Pic">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">{{ $book->title }}</h4>
                                <div class="d-flex">
                                    <div class="avatar me-50">
                                        <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar"
                                            width="24" height="24">
                                    </div>
                                    <div class="author-info">
                                        <small class="text-muted me-25">by</small>
                                        <small>{{ $book->author->name }}</small>
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
                                <p class="card-text mb-2">{{ $book->description }}</p>
                                </p>
                                <hr class="my-2">
                                @if (!empty($book->file))
                                    <div style="text-align: center;">
                                        <canvas id="pdf-canvas"
                                            style="border: 1px solid #000; margin-bottom: 10px;"></canvas>
                                        <div>
                                            <button id="prev-page" class="btn btn-primary">Previous Page</button>
                                            <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
                                            <button id="next-page" class="btn btn-primary">Next Page</button>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
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
                                                <div class="text-body align-middle">{{ count($book->rating) }}</div>
                                            </a>
                                        </div>

                                        <div class="d-flex align-items-center me-1">
                                            <a href="{{ route('user.books.liked_books', $book->id) }}" class="me-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24"
                                                    fill="{{ checkUserLikedBook($book->id) ? '#7367f0' : 'none' }}"
                                                    stroke="{{ checkUserLikedBook($book->id) ? '#7367f0' : 'currentColor' }}"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-bookmark font-medium-5 text-body align-middle">
                                                    <path
                                                        d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#">
                                                <div class="text-body align-middle">{{ count($book->likedBooks) }}</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Blog -->

                    <!-- Blog Comment -->
                    @if (count($ratings) > 0)
                        <div class="col-12 mt-1" id="blogComment">
                            <h6 class="section-label mt-25">Comment</h6>
                            @foreach ($ratings as $rating)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar me-75">
                                                <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg"
                                                    width="38" height="38" alt="Avatar">
                                            </div>
                                            <div class="author-info">
                                                <h6 class="fw-bolder mb-25">{{ $rating->user->name }}</h6>
                                                <ul class="unstyled-list list-inline">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li class="ratings-list-item">
                                                            <i data-feather="star"
                                                                class="{{ $i <= $rating->rating ? 'filled-star' : 'unfilled-star' }}"></i>
                                                        </li>
                                                    @endfor
                                                </ul>

                                                <p class="card-text">
                                                    {{ $rating->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!--/ Blog Comment -->

                    <!-- Leave a Blog Comment -->
                    <div class="col-12 mt-1">
                        <h6 class="section-label mt-25">Leave a Comment</h6>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.books.rating-store', $book->id) }}" class="form"
                                    method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-6 col-12">
                                            <div class="rate mb-2">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control mb-2" rows="4" placeholder="Comment" name="comment" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-float waves-light">Post
                                                Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ Leave a Blog Comment -->
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="blog-recent-posts">
                <h6 class="section-label">Recommded Posts</h6>
                <div class="mt-75">
                    @if (count($recommended_books) > 0)
                        @foreach ($recommended_books as $recommended_book)
                            <div class="d-flex mb-2">
                                <a href="page-blog-detail.html" class="me-2">
                                    <img class="rounded" src="../../../app-assets/images/banner/banner-22.jpg"
                                        width="100" height="70" alt="Recent Post Pic">
                                </a>
                                <div class="blog-info">
                                    <h6 class="blog-recent-post-title">
                                        <a href="page-blog-detail.html"
                                            class="text-body-heading">{{ $recommended_book->title }}</a>
                                    </h6>
                                    <div class="text-muted mb-0">
                                        {{ date('M d,Y', strtotime($recommended_book->publish_date)) }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.3.122/pdf.min.js"></script>
    <script>
        var url = '{{ asset('storage/' . $book->file) }}';
        var pdfjsLib = window['pdfjsLib'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.3.122/pdf.worker.min.js';

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 0.75, // Adjust this value for smaller size
            canvas = document.getElementById('pdf-canvas'),
            ctx = canvas.getContext('2d');

        /**
         * Render the given page number.
         */
        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }

                    // Check if it's the last page
                    if (num === pdfDoc.numPages) {
                        // alert("You have reached the last page!");
                        $.ajax({
                            url: '{{ route('user.books.read_books', $book->id) }}',
                            type: 'GET',
                            success: function(response) {
                                console.log('Data posted successfully:', response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error posting data:', error);
                            }
                        });

                    }
                });
            });

            document.getElementById('page-num').textContent = num;
        }

        /**
         * If another page rendering is in progress, wait until the rendering is
         * finished. Otherwise, execute rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Display the previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev-page').addEventListener('click', onPrevPage);

        /**
         * Display the next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById('next-page').addEventListener('click', onNextPage);

        /**
         * Asynchronously download the PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page-count').textContent = pdfDoc.numPages;

            // Initial page rendering
            renderPage(pageNum);
        });
    </script>
@endsection
