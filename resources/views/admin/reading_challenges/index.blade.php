@extends('layouts.master')
@section('title', 'Reading Challenges')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{ route('reading-challenges.create') }}" class="btn btn-primary" style="float: right">Create New Challenge</a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="datatables-basic table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Time Frame</th>
                                    <th>Books</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($challenges as $challenge)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if(!empty($challenge->icon))
                                            <img src="{{ asset('storage/' . $challenge->icon) }}" alt="{{ $challenge->title }}" class="img-thumbnail" width="100">
                                            @else
                                            No Icon
                                            @endif
                                        </td>
                                        <td>{{ $challenge->title }}</td>
                                        <td>{{ $challenge->description }}</td>
                                        <td>{{ $challenge->time_frame }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($challenge->books as $book)
                                                    <li>{{ $book->title }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('reading-challenges.edit', $challenge->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#">
                                                <li class="dropdown-item delete_model" data-id="{{$challenge->id}}"
                                                    data-url="{{ route('user.user-creation.delete') }}">Delete</li>
                                            </a>
                                        </td> --}}
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <a href="{{ route('reading-challenges.edit', $challenge->id) }}">
                                                        <li class="dropdown-item edit_modal">Edit</li>
                                                    </a>
                                                    <a href="#">
                                                        <li class="dropdown-item delete_model" data-id="{{$challenge->id}}"
                                                            data-url="{{ route('reading-challenges.delete') }}">Delete</li>
                                                    </a>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
