<!-- resources/views/user/followers.blade.php -->

<h3>{{ Auth::user()->account_name }} のフォロワー</h3>
<ul>
    @foreach ($followers as $follower)
        <li>{{ $follower->account_name }}</li>
    @endforeach
</ul>

