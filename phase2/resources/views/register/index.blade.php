@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    
    <!-- 成功メッセージがある場合表示 -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- バリデーションエラーメッセージの表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" name="user_id" id="user_id" class="form-control" value="{{ old('user_id') }}" required>
        </div>

        <div class="form-group">
            <label for="account_name">Account Name</label>
            <input type="text" name="account_name" id="account_name" class="form-control" value="{{ old('account_name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="answer_content">Answer Content</label>
            <textarea name="answer_content" id="answer_content" class="form-control">{{ old('answer_content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
