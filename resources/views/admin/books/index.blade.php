@extends('layouts.master')
@section('title', 'Accounts')
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }} ">
@endsection
@section('page-styles')
    {{-- @include('layouts.panels.datatable.styles') --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }} ">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 com-d-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <a href="{{ route('books.create') }}" class="btn btn-primary float-end">Add Book</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="table-responsive">
                                <table class="datatables-basic table table-bordered table-striped text-center"
                                    id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Genre</th>
                                            <th>Publication Date </th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if(!empty($book->image))
                                                        <img src="{{ asset('storage/'.$book->image) }}" width="100" height="100">
                                                    @else
                                                    No Image
                                                    @endif
                                                </td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->author->name }}</td>
                                                <td>{{ $book->genre }}</td>
                                                <td>{{ $book->publish_date }}</td>
                                                <td>{{ $book->description }}</td>
                                                {{-- <td class="d-flex justify-content-center">
                                                    <div class="form-check form-switch form-check-success mx-auto d-block">
                                                        <input type="checkbox" class="form-check-input status_box"
                                                            data-id="{{ $book->id }}" data-url=""
                                                            value="{{ $book->id }}" id="status_{{ $book->id }}"
                                                            {{ $book->is_default == '1' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="status_{{ $book->id }}">
                                                        </label>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-primary dropdown-toggle"
                                                            type="button" id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <a href="{{ route('books.edit', $book->id) }}">
                                                                <li class="dropdown-item edit_modal">Edit</li>
                                                            </a>
                                                            <a href="#">
                                                                <li class="dropdown-item delete_model"
                                                                    data-id="{{ $book->id }}"
                                                                    data-url="{{ route('books.delete') }}">Delete</li>
                                                            </a>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
