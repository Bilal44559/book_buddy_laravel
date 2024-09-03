@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
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
                                    @php
                                        $check_group_joined = checkGroupJoined($group->id, auth()->user()->id);
                                    @endphp
                                    @if ($check_group_joined['status'] == 0)
                                        <a href="{{ route('user.groups.joined-request', $group->id) }}"
                                            class="btn btn-success">Join Group</a>
                                    @else
                                        @if($check_group_joined['data']['status'] == "accepted")
                                        <a href="{{ route('user.groups.events', $group->id) }}" class="fw-bold">Detail More</a>
                                        @endif
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
