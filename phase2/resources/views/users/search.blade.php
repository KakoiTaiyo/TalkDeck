<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ユーザー検索') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 dark:bg-gray-800">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">ユーザー検索</h2>
            <!-- 検索フォーム -->
            <form action="{{ route('users.search') }}" method="GET" class="mb-6">
                <div class="flex items-center">
                    <input type="text" name="keyword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search for tweets..." value="{{ request('keyword') }}">
                    <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Search
                    </button>
                </div>
            </form>

            <!-- 検索結果表示 -->
            @if ($users->count())
            <!-- ページネーション -->
            <div class="mb-4">
                {{ $users->appends(request()->input())->links() }}
            </div>
            @foreach ($users as $user)
            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-between">
                <div class="flex space-x-4">
                    <!-- POSTリクエストを送信するフォーム -->
                    <form action="{{ route('gemini.show', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            選択
                        </button>
                    </form>
                    <!-- アカウント名をクリックするとそのユーザーのマイページへ -->
                    <form action="{{ route('mypage', $user->id) }}" method="GET">
                        <button type="submit" class="text-blue-500 hover:underline">{{ $user->account_name }}</button>
                    </form>
                    <!-- 認証ユーザーが自分自身でない場合のみフォローボタンを表示 -->
                    @if (Auth::id() !== $user->id)
                        @if (auth()->user()->following()->where('followed_id', $user->id)->exists())
                        <form action="{{ route('unfollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-500 text-black rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                フォローをやめる
                            </button>
                        </form>
                        @else
                            <form action="{{ route('follow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-700">
                                    フォロー
                                </button>
                            </form>
                        @endif
                    @endif
                </div>  
            </div>
            @endforeach
            @else
            <div>
                <p class="text-gray-800 dark:text-gray-300">ユーザーが見つかりませんでした</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>