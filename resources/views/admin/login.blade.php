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
            <label for="email" class="label">Email</label>
            <input type="text" id="email" name="email" class="input">
            @if ($errors->has('password'))
                <span class="error">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label for="password" class="label">Password</label>
            <input type="password" id="password" name="password" class="input">
            <button class="submitBtn">Login</button>
        </div>
    </form>

@endsection
