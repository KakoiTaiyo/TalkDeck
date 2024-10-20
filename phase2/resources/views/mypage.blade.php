<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 dark:bg-gray-800">
            <h2 class="font-semibold text-xl dark:text-white">{{ $user->account_name }} のプロフィール</h2>

            <p class="dark:text-white"><strong>ユーザーID:</strong> {{ $user->user_id }}</p>
            <p class="dark:text-white"><strong>アカウント名:</strong> {{ $user->account_name }}</p>
            <p class="dark:text-white"><strong>回答内容:</strong> {{ $user->answer_content }}</p>

            <!-- フォロワー数とフォロー数 -->
            <div>
                <a href="{{ route('profile.followers', $user->id) }}" class="text-blue-500 dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                    フォロワー数: {{ $followers->count() }}
                </a>
            </div>
            <div>
                <a href="{{ route('profile.followings', $user->id) }}" class="text-blue-500 dark:text-blue-400 hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                    フォロー数: {{ $followings->count() }}
                </a>
            </div>
            <!-- 自分自身でない場合のみフォローボタンを表示 -->
            @if (Auth::id() !== $user->id)
            @if (auth()->user()->following()->where('followed_id', $user->id)->exists())
            <form action="{{ route('unfollow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                    フォロー解除
                </button>
            </form>
            @else
            <form action="{{ route('follow', $user->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    フォロー
                </button>
            </form>
            @endif
            @endif
        </div>
    </div>
</x-app-layout>