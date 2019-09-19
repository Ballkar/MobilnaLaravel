@extends('admin.dashboard')

@section('dashboardContent')

    <form action="/admin/blog/category/{{$category->id}}/post" method="POST">
        @csrf
        <label for="name">Tytuł</label>
        <input id="name" type="text" name="title">


        <label for="text">text</label>
        <textarea id="text" type="text" name="text"></textarea>
        <input type="submit" value="dodaj">
    </form>

@endsection
