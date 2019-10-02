@extends('admin.dashboard')

@section('dashboardContent')
<form-post-component :text="'elo'" :categories="{{$categories}}"></form-post-component>
@endsection
