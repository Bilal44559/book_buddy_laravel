@extends('layouts.master')

@section('title', 'Add Event')

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
                            <a href="{{ route('user.groups.index') }}" class="btn btn-primary float-end">Back</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <form action="{{ route('user.groups.events.store', $group->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Event Name -->
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name"><b>Name <span class="text-danger">*</span></b></label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Event Name" name="name" value="{{ old('name') }}" required />
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Event Type -->
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="type"><b>Type <span class="text-danger">*</span></b></label>
                                            <select id="type" name="type" class="form-control select2 @error('type') is-invalid @enderror" required>
                                                <option value="reading_session" {{ old('type') == 'reading_session' ? 'selected' : '' }}>Reading session</option>
                                                <option value="discussion" {{ old('type') == 'discussion' ? 'selected' : '' }}>Discussion</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Event Description -->
                                    <div class="col-md-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="description"><b>Description </b></label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="3" placeholder="Enter Event Description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
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
