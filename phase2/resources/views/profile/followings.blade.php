<!-- resources/views/user/followings.blade.php -->

<h3>{{ Auth::user()->account_name }} がフォローしているユーザー</h3>
<ul>
    @foreach ($followings as $following)
        <li>{{ $following->account_name }}</li>
    @endforeach
</ul>

