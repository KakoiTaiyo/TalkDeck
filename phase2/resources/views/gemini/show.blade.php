
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('トークデッキ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <audio id="bgm-audio" src="{{ asset('audio/bgm.mp3') }}" autoplay loop></audio>
                <!-- 音量調整スライダー -->
                    <label for="volume-control" class="text-gray-800 dark:text-gray-200">BGM音量:</label>
                    <input type="range" id="volume-control" min="0" max="1" step="0.1" value="0.5">

                    <br>
                <!-- <h3>入力文: {{ $sentence }}</h3> -->
                    {{-- 結果表示 --}}
                    @if (isset($response_text))
                        <p>{!! nl2br(e($response_text)) !!}</p>
                    @endif
                </div>
            </div>
        </div>        
    </div>
    <!-- 音量調整用JavaScript -->
    <script>
        const audio = document.getElementById('bgm-audio');
        const volumeControl = document.getElementById('volume-control');

        // 最初の音量を50%に設定
        audio.volume = 0.2;

        // 音量調整スライダーが変わったときに音量を更新
        volumeControl.addEventListener('input', function() {
            audio.volume = this.value;
        });
    </script>
</x-app-layout>

