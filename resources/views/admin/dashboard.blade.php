@extends('admin.master')

@section('content')

    @include('admin.menu')
    <div class="widthContainer">
        @yield('dashboardContainer')
    </div>
@endsection
