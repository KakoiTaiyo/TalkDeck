@section('content')
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
                    <label for="volume-control" class="text-gray-800 dark:text-gray-200">BGM音量:</label>
                    <input type="range" id="volume-control" min="0" max="1" step="0.1" value="0.5">
                    <br>

                    @if (isset($response_text))
                        <p style="margin-bottom: 20px;">{!! nl2br(e($response_text)) !!}</p>

                        <form id="saveForm" action="{{ route('history.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="content" value="{{ $response_text }}">
                            <button type="submit" id="saveButton" style="background-color: #007bff; color: #fff; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                              保存
                            </button>
                        </form>
                        
                        <div id="successMessage" style="display: none; margin-top: 20px; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
                            保存に成功しました！
                        </div>
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

<script>
    document.getElementById('saveForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let form = this;
        let formData = new FormData(form);
        let saveButton = document.getElementById('saveButton');
        let successMessage = document.getElementById('successMessage');

        saveButton.disabled = true;

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // 保存確認
            successMessage.style.display = 'block';
            saveButton.disabled = false;
        })
        .catch(error => {
            console.error('保存エラー:', error);
            alert('保存に失敗しました');
            saveButton.disabled = false;
        });
    });
</script>
