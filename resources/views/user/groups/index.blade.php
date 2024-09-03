@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
            <div class="col-md-12 mb-2">
                <a href="{{ route('user.groups.create') }}" class="btn btn-primary" style="float: right">Add Group</a>
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
                                <p class="card-text"><span><b>Active Members: </b>0</b></span></p>
                                <p class="card-text"><span><b>Pending Members: </b>0</b></span></p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('user.groups.events', $group->id) }}" class="fw-bold">Detail More</a>
                                    <a href="{{ route('user.groups.edit', $group->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger delete_model" data-id="{{ $group->id }}"
                                        data-url="{{ route('user.groups.delete') }}">Delete</a>
                                </div>
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
