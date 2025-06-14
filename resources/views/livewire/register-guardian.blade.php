<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-gray-200">Daftar Akun Guardian Baru</h2>

        <form wire:submit="register">
            {{-- Ini akan merender semua field dari getFormSchema() --}}
            {{ $this->form }}

            <button type="submit"
                class="mt-6 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Daftar
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            Sudah punya akun?
            <a href="{{ route('filament.admin.auth.login') }}"
                class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">Login
                di sini</a>
        </p>
    </div>
</div>
