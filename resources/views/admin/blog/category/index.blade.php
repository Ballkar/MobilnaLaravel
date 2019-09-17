@extends('admin.dashboard')

@section('dashboardContent')


    <div class="container">
        <div class="categoriesContainer">
            <div class="title">Kategorie</div>

            <div class="categories">
                @foreach($categories as $category)
                    <a href="category/{{$category->id}}">{{$category->name}}</a>
                @endforeach
            </div>
        </div>

        <div class="addFormContainer">
            <div class="title">Dodaj nową kategorie</div>
            <form action="" method="post" id="form">
                @csrf
                <div class="inputContainer">
                    <label for="name" >Nazwa</label>
                    <input id="name" type="text" name="name">
                </div>
                <input type="submit" class="submit" value="Dodaj">
            </form>
        </div>
    </div>

@endsection
