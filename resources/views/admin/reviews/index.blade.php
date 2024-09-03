@extends('layouts.master')
@section('title', 'Accounts')
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }} ">
@endsection
@section('page-styles')
    <style>
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
    <div class="row">
        <div class="col-lg-12 com-d-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="table-responsive">
                                <table class="datatables-basic table table-bordered table-striped text-center"
                                    id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Book</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @if(count($ratings) > 0)
                                        @foreach($ratings as $rating)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rating->user->name }}</td>
                                            <td>{{ $rating->book->title }}</td>
                                            <td>{{ $rating->rating }}
                                                <ul class="unstyled-list list-inline">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li class="ratings-list-item">
                                                            <i data-feather="star"
                                                                class="{{ $i <= $rating->rating ? 'filled-star' : 'unfilled-star' }}"></i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </td>
                                            <td>{{ $rating->comment }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a href="#">
                                                            <li class="dropdown-item delete_model" data-id="{{$rating->id}}"
                                                                data-url="{{ route('user.reviews.delete') }}">Delete</li>
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
    {{-- @include('layouts.panels.datatable.scripts') --}}
    <script src="{{ asset('app-assets/js/scripts/forms/form-validation.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                sorting: false,
                paging: false,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
@endsection
