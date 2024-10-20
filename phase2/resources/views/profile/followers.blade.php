<x-app-layout>
    <div class="container mx-auto p-4">
        <h2>{{ $user->account_name }} のフォロワー</h2>
        <ul>
            @foreach ($followers as $follower)
                <li><a href="{{ route('mypage', $follower->id) }}" class="text-blue-500 hover:underline">{{ $follower->account_name }}</a></li>
            @endforeach
        </ul>
    </div>
</x-app-layout>