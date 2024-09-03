@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="blog-list-wrapper">
        <div class="row">
            <div class="col-md-12 mb-2">
                <a href="{{ route('user.groups.events.create', $group->id) }}" class="btn btn-primary" style="float: right">Add
                    Event</a>
            </div>
            @if (count($events) > 0)
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="page-blog-detail.html" class="blog-title-truncate text-body-heading">
                                        {{ $event->name }}</a>
                                </h4>
                                <hr>
                                <span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $event->type)) }}</span>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- <a href="{{ route('user.groups.events', $event->id) }}" class="fw-bold">Detail More</a> --}}
                                    @if(auth()->user()->id == $event->user_id)
                                    <a href="{{ route('user.groups.events.edit', [$group->id, $event->id]) }}"
                                        class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger delete_model" data-id="{{ $event->id }}"
                                        data-url="{{ route('user.groups.events.delete', [$group->id, $event->id]) }}">Delete</a>
                                    @endif
                                    <a href="{{ route('user.groups.events.detail', [$group->id, $event->id]) }}"
                                        class="fw-bold" data-id="" data-url="">View
                                        detail</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h1 class="text-center text-muted">No Events Found</h1>
            @endif
        </div>
    </div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')

@endsection
