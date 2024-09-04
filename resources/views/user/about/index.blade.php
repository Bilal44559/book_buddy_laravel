@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
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
        <div class="row">
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
    </div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')

@endsection
