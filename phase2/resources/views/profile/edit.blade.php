<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 dark:bg-gray-800">
            <div class="max-w-xl">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('プロフィール情報') }}</h3>
                <p><a href="{{ route('profile.followings', Auth::user()->id) }}" class="text-blue-500 hover:underline">
                        {{ Auth::user()->followings()->count() }} フォロー
                    </a>
                    <a href="{{ route('profile.followers', Auth::user()->id) }}" class="text-blue-500 hover:underline">
                        {{ Auth::user()->followers()->count() }} フォロワー
                    </a>
                </p>

                <p class="mb-4 text-gray-900 dark:text-white"><strong>ユーザーID:</strong> {{ Auth::user()->user_id }}</p>
                <p class="mb-4 text-gray-900 dark:text-white"><strong>アカウント名:</strong> {{ Auth::user()->account_name }}</p>
                <p class="mb-4 text-gray-900 dark:text-white"><strong>メールアドレス:</strong> {{ Auth::user()->email }}</p>
                <p class="mb-4 text-gray-900 dark:text-white"><strong>回答内容:</strong> {{ Auth::user()->answer_content }}</p>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>