@extends('admin.dashboard')

@section('dashboardContent')



    <ul>
        @foreach($categories as $category)
            <li>{{$category->name}}</li>
        @endforeach
    </ul>



@endsection
