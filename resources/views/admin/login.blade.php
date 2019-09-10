@extends('admin.master')

@section('content')
    <form action="" method="POST">
        @csrf
        <div id="loginContainer">
            @if ($errors->any())
                <span class="error">
                    <strong>{{ $errors->first() }}</strong>
                </span>
            @endif
            <div class="title">Admin Login Panel</div>
            @if ($errors->has('email'))
                <span class="error">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <button class="submit">Login</button>
        </div>
    </form>

@endsection
