@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <div class="alert-body">{{ Session::get('success') }}</div>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-body">{{ Session::get('error') }}</div>
    </div>
@endif
