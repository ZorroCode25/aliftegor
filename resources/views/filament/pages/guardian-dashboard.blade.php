<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
        @php
            $dummyStudents = [
                ['id' => 1, 'name' => 'John Doe', 'class' => '10A', 'photo' => null],
                ['id' => 2, 'name' => 'Jane Smith', 'class' => '10B', 'photo' => 'photos/jane.jpg'],
                ['id' => 3, 'name' => 'Alex Johnson', 'class' => '11A', 'photo' => null],
                ['id' => 4, 'name' => 'Sarah Lee', 'class' => '11B', 'photo' => null],
            ];
        @endphp
        @foreach ($dummyStudents as $student)
            <div
                class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="flex justify-center">
                    @if ($student['photo'])
                        <img src="{{ asset('storage/' . $student['photo']) }}" alt="{{ $student['name'] }}"
                            class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                    @else
                        <div
                            class="w-24 h-24 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center border-4 border-white dark:border-gray-700 shadow-lg">
                            <span class="text-3xl font-bold text-gray-800 dark:text-gray-200">
                                {{ strtoupper(substr($student['name'], 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="text-center mt-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $student['name'] }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $student['class'] }}</p>
                    <div class="mt-6">
                        <x-filament::button wire:click="pickup('{{ $student['id'] }}')" color="primary"
                            icon="heroicon-o-check-circle" size="sm">
                            Jemput
                        </x-filament::button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
