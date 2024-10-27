<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('履歴') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                    <div class="alert alert-success dark:bg-green-700 dark:text-green-100">{{ session('success') }}</div>
                    @endif

                    <div class="">
                        @forelse ($savedHistories as $history)
                        <div class="history-item bg-gray-100 dark:bg-gray-800 p-4 rounded mb-4">
                            <p class="text-gray-900 dark:text-gray-100"><strong>内容:</strong> {{ $history->content }}</p>
                            <span class="timestamp text-gray-600 dark:text-gray-400">{{ $history->created_at->format('Y年m月d日 H:i') }}</span>
                        </div>
                        @empty
                        <p class="text-gray-900 dark:text-gray-100">履歴はありません。</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>