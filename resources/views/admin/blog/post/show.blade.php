@extends('admin.dashboard')

@section('dashboardContent')



    <div class="title">{{$post->title}}</div>

    <div class="text">{!! $post->text !!}</div>


@endsection
