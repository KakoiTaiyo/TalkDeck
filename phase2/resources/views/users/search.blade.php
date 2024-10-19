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
        <div class="flex items-center">
            <!-- POSTリクエストを送信するフォーム -->
            <form action="{{ route('gemini.show') }}" method="POST">
                @csrf
                <!-- ユーザIDを送信するための隠しフィールド -->
                <input type="hidden" name="id" value="{{ $user->id }}" />
                <button type="submit">選択</button>
            </form>

            <p>{{ $user->account_name }}</p>
        </div>
        @endforeach
        @else
        <div>
            <p class="text-gray-800 dark:text-gray-300">ユーザーが見つかりませんでした</p>
        </div>
        @endif
    </div>
</div>

<!-- <script>
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
</script> -->