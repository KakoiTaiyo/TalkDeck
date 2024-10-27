<!-- resources/views/user/followings.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 dark:bg-gray-800">
            <h3 class="dark:text-white">{{ Auth::user()->account_name }} がフォローしているユーザー</h3>
            <ul>
                @foreach ($followings as $followed)
                <li class="dark:text-white"><a href="{{ route('mypage', $followed->id) }}" class="text-blue-500 hover:underline">{{ $followed->account_name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>