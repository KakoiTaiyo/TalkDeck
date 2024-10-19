<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ユーザー検索') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 dark:bg-gray-800">
            <!-- 検索フォーム -->
            <form action="{{ route('users.search') }}" method="GET" class="mb-6">
                <div class="flex items-center">
                    <input type="text" name="keyword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search for tweets..." value="{{ request('keyword') }}">
                    <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Search
                    </button>
                </div>
            </form>
            @if(session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif
            <!-- 検索結果表示 -->
            @if ($users->count())
            <!-- ページネーション -->
            <div class="mb-4">
                {{ $users->appends(request()->input())->links() }}
            </div>
            @foreach ($users as $user)
            <div class="mb-4 p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                <input type="checkbox" name="select" class="mr-2" value="選択">
                <p class="text-gray-800 dark:text-gray-300">{{ $user->account_name }}</p>
                @if (auth()->user()->following()->where('followed_id', $user->id)->exists())
                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="ml-4 px-4 py-2 bg-red-500 text-black rounded-lg hover:bg-red-700">
                            フォロー解除
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
            </div>
            @endforeach
            <button class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">決定する</button>
            @else
            <div>
                <p class="text-gray-800 dark:text-gray-300">ユーザーが見つかりませんでした</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

<script>
    function fetchUserData(userId) {
        fetch(`/user/${userId}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // ここで取得したユーザーデータを処理します
                alert(`ユーザー名: ${data.account_name}`);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
