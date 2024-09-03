@extends('layouts.master')
@section('title', 'Accounts')

@section('content')
    <div class="row">
        <div class="col-lg-12 com-d-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <a href="{{ route('user.groups.view-all','all') }}" class="btn btn-primary float-end">Back</a>
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
                                            <th>Joined Date</th>
                                            @if(auth()->user()->id == $group->user_id)
                                            <th>Status</th>
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @if(count($group->joined_users) > 0)
                                        @foreach($group->joined_users as $joined_user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $joined_user->user->name }}</td>
                                            <td>{{ $joined_user->user->email }}</td>
                                            <td>{{ date("M d,Y h:i A", strtotime($joined_user->created_at)) }}</td>
                                            @if(auth()->user()->id == $group->user_id)
                                            <td>{{ ucwords($joined_user->status) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a href="#">
                                                            <li class="dropdown-item status_model" data-id="{{ $joined_user->id }}" data-url="{{ route('user.groups.status.update') }}">
                                                                @if($joined_user->status == "accepted")
                                                                    Decline
                                                                @else
                                                                    Approve
                                                                @endif
                                                            </li>
                                                        </a>
                                                    </ul>
                                                </div>
                                            </td>
                                            @endif
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
