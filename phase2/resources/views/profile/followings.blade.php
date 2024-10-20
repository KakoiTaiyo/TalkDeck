<x-app-layout>
    <div class="container mx-auto p-4">
        <h2>{{ $user->account_name }} がフォローしているユーザー</h2>
        <ul>
            @foreach ($followings as $followed)
                <li><a href="{{ route('mypage', $followed->id) }}" class="text-blue-500 hover:underline">{{ $followed->account_name }}</a></li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
