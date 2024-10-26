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
                    {{-- 結果表示 --}}
                    @if (isset($response_text))
                        <p style="margin-bottom: 20px;">{!! nl2br(e($response_text)) !!}</p>

                        <form id="saveForm" action="{{ route('history.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="content" value="{{ $response_text }}">
                            <button type="submit" id="saveButton" style="background-color: #007bff; color: #fff; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                              保存
                            </button>
 
                        </form>
                    @endif
                </div>
            </div>
        </div>        
    </div>
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
        .then(response => response.json())
        .then(data => {
            successMessage.style.display = 'block';
            saveButton.disabled = false;
            
        })
        .catch(error => {
            alert('保存に成功しました');
            saveButton.disabled = false;
        });
    });
</script>
