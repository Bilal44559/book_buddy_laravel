<!-- profile header -->
<div class="row">
    <div class="col-12">
        <div class="card profile-header mb-2">
            <!-- profile cover photo -->
            <img class="card-img-top" src="{{asset('/')}}app-assets/images/profile/user-uploads/timeline.jpg" alt="User Profile Image" />
            <!--/ profile cover photo -->

            <div class="position-relative">
                <!-- profile picture -->
                <div class="profile-img-container d-flex align-items-center">
                    <div class="profile-img">
                        <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-9.jpg" class="rounded img-fluid" alt="Card image" />
                    </div>
                    <!-- profile title -->
                    <div class="profile-title ms-3">
                        <h2 class="text-white">{{$user->name}}</h2>
                        <p class="text-white">{{ $user->is_auhor == "1" ? 'Author' : 'User'}}</p>
                    </div>
                </div>
            </div>

            <!-- tabs pill -->
            <div class="profile-header-nav">
                <!-- navbar -->
                <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                    <button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i data-feather="align-justify" class="font-medium-5"></i>
                    </button>

                    <!-- collapse  -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                            <ul class="nav nav-pills mb-0">
                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ Request::routeIs('user.social_feed.author_profile') ? 'active' : ''}}" href="{{ route('user.social_feed.author_profile', $user->id) }}">
                                        <span class="d-none d-md-block">Feed</span>
                                        <i data-feather="rss" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ Request::routeIs('user.social_feed.author_liked_books') ? 'active' : ''}}" href="{{ route('user.social_feed.author_liked_books', $user->id) }}">
                                        <span class="d-none d-md-block">Liked Books</span>
                                        <i data-feather="info" class="d-block d-md-none"></i>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ Request::routeIs('user.social_feed.show_following') ? 'active' : ''}}" href="{{ route('user.social_feed.show_following', $user->id) }}">
                                        <span class="d-none d-md-block">Following</span>
                                        <i data-feather="info" class="d-block d-md-none"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- edit button -->
                            <a href="{{ route('user.social_feed.index')}}" class="btn btn-primary">
                                <i data-feather="edit" class="d-block d-md-none"></i>
                                <span class="fw-bold d-none d-md-block">Back</span>
                            </a>
                        </div>
                    </div>
                    <!--/ collapse  -->
                </nav>
                <!--/ navbar -->
            </div>
        </div>
    </div>
</div>
<!--/ profile header -->
