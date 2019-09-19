@extends('admin.dashboard')

@section('dashboardContent')

    <form action="/admin/blog/category/{{$category->id}}/post" method="POST" id="addPostForm">
        @csrf
        <div class="inputContainer">
            <label for="title" >Tytuł</label>
            <input id="title" type="text" name="Title" placeholder="Tytuł bloga">
        </div>
        <div class="inputContainer">
            <label for="summernote">Text</label>
            <textarea id="summernote" name="text"></textarea>
        </div>
        <input type="submit" value="dodaj" class="submit">
    </form>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 400
        });
    </script>
@endsection
