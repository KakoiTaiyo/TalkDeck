<!-- resources/views/user/followers.blade.php -->
<x-app-layout>
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h3 class="dark:text-white">{{ Auth::user()->account_name }} のフォロワー</h3>
        <ul>
            @foreach ($followers as $follower)
            <li class="dark:text-white"><a href="{{ route('mypage', $follower->id) }}" class="text-blue-500 hover:underline">{{ $follower->account_name }}</a></li>
            @endforeach
        </ul>
    </div>
</x-app-layout>