@extends('admin.master')

@section('content')

    @include('admin.menu')
    <div id="dashboardContainer">
        <div class="widthContainer">
        @yield('dashboardContent')
        </div>
    </div>
@endsection
