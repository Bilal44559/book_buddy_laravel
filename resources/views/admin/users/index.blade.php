@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="row">
        <div class="col-lg-12 com-d-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <a href="{{ route('user.user-creation.create') }}" class="btn btn-primary float-end">Add User</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="table-responsive">
                                <table class="datatables-basic table table-bordered table-striped text-center"
                                    id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Is Author</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @if(count($users) > 0)
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_author == 1 ? "Yes" : "No" }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a href="{{ route("user.user-creation.edit",$user->id) }}">
                                                            <li class="dropdown-item edit_modal">Edit</li>
                                                        </a>
                                                        <a href="#">
                                                            <li class="dropdown-item delete_model" data-id="{{$user->id}}"
                                                                data-url="{{ route('user.user-creation.delete') }}">Delete</li>
                                                        </a>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-2">
                                    {{-- {{ $accounts->links('pagination::bootstrap-4') }} --}}
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('vendor-scripts')

@endsection
@section('page-scripts')

@endsection
