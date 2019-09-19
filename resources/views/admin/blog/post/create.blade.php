@extends('admin.dashboard')

@section('dashboardContent')

    <form action="/admin/blog/category/{{$category->id}}/post" method="POST">
        @csrf
        <label for="name">Tytuł</label>
        <input id="name" type="text" name="title">


        <label for="summernote">text</label>
        <textarea id="summernote" name="text"></textarea>
        <input type="submit" value="dodaj">
    </form>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 400
        });
    </script>
@endsection
