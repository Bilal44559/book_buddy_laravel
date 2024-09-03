@extends('layouts.master')
@section('title', 'Add Account')
@section('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }} ">
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
                            <a href="{{ route('books.index') }}" class="btn btn-primary float-end">Back</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <form action="{{ route('books.update', $book->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="country-floating"><b>Title <span
                                                        class="text-danger">*</span></b></label>
                                            <input type="text" id="city-column"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter Title here" name="title"
                                                value="{{ old('title', $book->title) }}" />

                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="city-column"><b>Author <span
                                                        class="text-danger">*</span></b></label>
                                                    <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id">
                                                        @if(count($users) > 0)
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}" @if($book->author_id == $user->id) selected @endif>{{$user->name}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                            @error('author_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="city-column"><b>Genre <span
                                                        class="text-danger">*</span></b></label>
                                            <input type="text" id="city-column"
                                                class="form-control @error('genre') is-invalid @enderror"
                                                placeholder="Genre" name="genre"
                                                value="{{ old('genre', $book->genre) }}" />
                                            @error('genre')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="city-column"><b>Publication Date <span
                                                        class="text-danger">*</span></b></label>
                                            <input type="date" min="0" id="city-column"
                                                class="form-control @error('publish_date') is-invalid @enderror"
                                                placeholder="Initial Balance" name="publish_date"
                                                value="{{ old('publish_date', $book->publish_date) }}" />
                                            @error('publish_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 mb-1">
                                        <label class="form-label" for="city-column"><b>Description <span
                                                    class="text-danger">*</span></b></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" class="form-control"
                                            id="" cols="30" rows="3">  {{ $book->description }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="mb-1">
                                            <button type="submit" class="btn btn-primary float-end">Update</button>
                                        </div>
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

@endsection
@section('page-scripts')
    {{-- @include('layouts.panels.datatable.scripts') --}}
    <script src="{{ asset('app-assets/js/scripts/forms/form-validation.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/app-assets/js/scripts/forms/form-select2.js') }}"></script>

@endsection
