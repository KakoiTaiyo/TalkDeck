<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('履歴') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="history-list">
                        @forelse ($savedHistories as $history)
                            <div class="history-item">
                                <p><strong>内容:</strong> {{ $history->content }}</p>
                                <span class="timestamp">{{ $history->created_at->format('Y年m月d日 H:i') }}</span>
                            </div>
                        @empty
                            <p>履歴はありません。</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
.history-list {
    margin-top: 20px; /* 上部に余白を追加 */
}

.history-item {
    background-color: #f8f9fa; /* 背景 */
    border-radius: 5px; 
    padding: 10px;
    margin: 20px 0; /* アイテム間のマージン */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.timestamp {
    display: block;
    font-size: 0.9em;
    color: #6c757d; 
    margin-top: 5px; 
}
</style>
