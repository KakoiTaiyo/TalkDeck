<!-- resources/views/user/followings.blade.php -->
<x-app-layout>
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h3 class="dark:text-white">{{ Auth::user()->account_name }} がフォローしているユーザー</h3>
        <ul>
            @foreach ($followings as $followed)
            <li class="dark:text-white"><a href="{{ route('mypage', $followed->id) }}" class="text-blue-500 hover:underline">{{ $followed->account_name }}</a></li>
            @endforeach
        </ul>
    </div>
</x-app-layout>