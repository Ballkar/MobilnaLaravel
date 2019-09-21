@extends('admin.dashboard')

@section('dashboardContent')



    <div id="singlePostContainer">
        <a class="editBtn" href="/admin/blog/post/{{$post->id}}/edit">@svg('regular/edit')</a>
        <a class="category" href="/admin/blog/category/{{$post->category->id}}">{{$post->category->name}}</a>

        <div class="title"><span class="label">Tytuł:</span> {{$post->title}}</div>

        <div class="textContainer"><span class="label">Tekst:</span> <div class="text">{!! $post->text !!}</div> </div>
    </div>


@endsection
