@extends('layouts.master')

@section('title', 'Add Account')

@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('page-styles')
    {{-- @include('layouts.panels.datatable.styles') --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <a href="{{ route('user.user-creation.index') }}" class="btn btn-primary float-end">Back</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <form action="{{ route('user.user-creation.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name"><b>Name <span class="text-danger">*</span></b></label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Name here" name="name" value="{{ old('name') }}" />
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="email"><b>Email <span class="text-danger">*</span></b></label>
                                            <input type="text" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter Email here" name="email" value="{{ old('email') }}" />
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="is_author"><b>Is Author? <span class="text-danger">*</span></b></label>
                                            <select class="form-select @error('is_author') is-invalid @enderror" id="is_author" name="is_author">
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            </select>
                                            @error('is_author')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-scripts')
    {{-- Include your vendor scripts here --}}
@endsection

@section('page-scripts')
    {{-- @include('layouts.panels.datatable.scripts') --}}
    <script src="{{ asset('app-assets/js/scripts/forms/form-validation.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
@endsection
