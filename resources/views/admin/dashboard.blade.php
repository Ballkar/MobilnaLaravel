@extends('admin.master')

@section('content')

    @include('admin.menu')
    <div class="widthContainer">
        <div id="dashboardContainer">
            @yield('dashboardContent')
        </div>
    </div>
@endsection
