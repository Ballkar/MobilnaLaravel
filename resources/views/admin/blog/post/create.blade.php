@extends('admin.dashboard')

@section('dashboardContent')

    <form action="/admin/blog/post" method="POST" id="addPostForm">
        @csrf
        <div class="inputContainer">
            <label for="title" >Tytuł</label>
            <input id="title" type="text" name="title" placeholder="Tytuł bloga">
        </div>
        <div class="inputContainer">
            <label for="category">Kategoria</label>
            <select id="category" type="text" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
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
