@if (auth()->user()->user_type == 'admin')
    @include('layouts.sidebar.admin')
@else
    @include('layouts.sidebar.user')
@endif
