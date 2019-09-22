@extends('admin.dashboard')

@section('dashboardContent')



    <div id="singlePostContainer">
        @if($post->active)
            <div class="state active">aktywny</div>
        @else
            <div class="state inActive">nie-aktywny</div>
        @endif

        <a class="editBtn" href="/admin/blog/post/{{$post->id}}/edit">@svg('regular/edit')</a>
        <a class="deleteBtn" href="/admin/blog/post/{{$post->id}}">@svg('regular/trash-alt')</a>
        <a class="category" href="/admin/blog/category/{{$post->category->id}}">{{$post->category->name}}</a>

        <div class="title"><span class="label">Tytuł:</span> {{$post->title}}</div>

        <div class="textContainer"><span class="label">Tekst:</span> <div class="text">{!! $post->text !!}</div> </div>
    </div>


@endsection
