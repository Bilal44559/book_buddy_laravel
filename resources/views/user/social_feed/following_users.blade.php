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
            @if(count($followers) > 0)
            @foreach ($followers as $follower)
            <a href="{{ route('user.social_feed.author_profile', $follower->followers->id)}}">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar">
                                <img src="{{asset('/')}}app-assets/images/portrait/small/avatar-s-9.jpg" class="img-fluid" alt="avatar" height="100" width="100" />
                            </div>
                            <h3 class="text-center mt-2">{{$follower->followers->name}}</h3>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @else
            <h4>No Followers yet</h4>
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
