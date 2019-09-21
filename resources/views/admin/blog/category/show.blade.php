@extends('admin.dashboard')

@section('dashboardContent')


    <div class="container column">
        <div class="titleContainer">
            <div class="title" >Tytuł kategorii: <span class="highlight">{{$category->name}}</span></div>
            <a class="addPostBtn" href="/admin/blog/post/create">Add new post</a>
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
    </div>




@endsection
