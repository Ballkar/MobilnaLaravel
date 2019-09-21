@extends('admin.dashboard')

@section('dashboardContent')

    <div id="addPostSection">
        <a href="/admin/blog/post/create" class="addPostBtn">Dodaj nowy wpis</a>
    </div>

    <div class="postsContainer">
        @foreach($posts as $post)
            <a class="post" href="/admin/blog/post/{{$post->id}}">
                <div class="imageContainer">
                    <img src="https://s3-media1.fl.yelpcdn.com/bphoto/S3x33p4FRnQuBjBb89OwQA/o.jpg" alt="paznokcie">
                </div>
                <div class="postDetails">

                    <div class="title">Tytuł posta: <span class="highlight">{{$post->title}}</span></div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
