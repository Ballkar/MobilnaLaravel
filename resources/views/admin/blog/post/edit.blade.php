@extends('admin.dashboard')

@section('dashboardContent')

    <form action="/admin/blog/post/{{$post->id}}" method="POST" id="addPostForm">
        @csrf
        @method('PATCH')
        <div class="inputContainer">
            <label for="title" >Tytuł</label>
            <input id="title" type="text" name="title" placeholder="Tytuł bloga" value="{{$post->title}}">
        </div>
        <div class="inputContainer">
            <label for="category">Kategoria</label>
            <select id="category" type="text" name="category_id">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                        @if ($category->id === $post->category->id))
                            selected="selected"
                        @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="inputContainer">
            <label for="summernote">Text</label>
            <textarea id="summernote" name="text">{{$post->text}}</textarea>
        </div>
        <input type="submit" value="zapisz" class="submit">
    </form>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 350
        });
    </script>
@endsection
