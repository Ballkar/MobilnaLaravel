@extends('admin.dashboard')

@section('dashboardContent')

    <label for="name">Tytuł</label>
    <input id="name" type="text" name="title">


    <label for="text">text</label>
    <textarea id="text" type="text" name="text"></textarea>

@endsection
