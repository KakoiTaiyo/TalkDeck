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
            <form id="searchForm" action="{{ route('users.search') }}" method="GET" class="mb-6">
                <div class="flex items-center">
                    <input type="text" name="keyword" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Search for tweets..." value="{{ request('keyword') }}">

                    <!-- 選択されたユーザーIDを保持 -->
                    @if(request()->has('user_ids'))
                        @foreach(request('user_ids') as $selectedId)
                            <input type="hidden" name="user_ids[]" value="{{ $selectedId }}">
                        @endforeach
                    @endif

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
            <form id="sendForm" action="{{ route('gemini.show') }}" method="POST" onsubmit="return validateSelection()">
                @csrf
                @foreach ($users as $user)
                    <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-between">
                        <div class="flex space-x-4">
                            <!-- ユーザー選択用チェックボックス -->
                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" 
                                {{ in_array($user->id, request('user_ids', [])) ? 'checked' : '' }}
                                onchange="updateSelectedUsers()">
                            <!-- アカウント名をクリックするとそのユーザーのマイページへ -->
                            <a href="{{ route('mypage', $user->id) }}" class="text-blue-500 hover:underline">
                                {{ $user->account_name }}
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- エラーメッセージ表示 -->
                <p id="error-message" class="text-red-500 mb-4" style="display: none;">少なくとも2人を選択してください。</p>
                <!-- 一括送信ボタン -->
                <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    選択したユーザーを送信
                </button>
            </form>

            @else
            <div>
                <p class="text-gray-800 dark:text-gray-300">ユーザーが見つかりませんでした</p>
            </div>
            @endif
        </div>
    </div>

    <!-- JavaScriptでhidden inputを更新 -->
    <script>
        function updateSelectedUsers() {
            const searchForm = document.getElementById('searchForm');
            
            // 既存のhidden inputを削除
            searchForm.querySelectorAll('input[name="user_ids[]"]').forEach(input => input.remove());
            
            // チェックされているチェックボックスを取得し、hidden inputを追加
            document.querySelectorAll('input[type="checkbox"][name="user_ids[]"]:checked').forEach(checkbox => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'user_ids[]';
                hiddenInput.value = checkbox.value;
                searchForm.appendChild(hiddenInput);
            });
        }

        function validateSelection() {
            // 選択されたチェックボックスをカウント
            const selectedUsers = document.querySelectorAll('input[type="checkbox"][name="user_ids[]"]:checked');
            
            // エラーメッセージの要素
            const errorMessage = document.getElementById('error-message');

            if (selectedUsers.length < 2) {
                errorMessage.style.display = 'block';  // エラーメッセージを表示
                return false;  // フォーム送信をブロック
            }

            errorMessage.style.display = 'none';  // エラーメッセージを非表示
            return true;  // フォーム送信を許可
        }
    </script>
</x-app-layout>
