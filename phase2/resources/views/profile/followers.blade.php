<!-- resources/views/user/followers.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 dark:bg-gray-800">
            <h3 class="dark:text-white">{{ Auth::user()->account_name }} のフォロワー</h3>
            <ul>
                @foreach ($followers as $follower)
                <li class="dark:text-white"><a href="{{ route('mypage', $follower->id) }}" class="text-blue-500 hover:underline">{{ $follower->account_name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>