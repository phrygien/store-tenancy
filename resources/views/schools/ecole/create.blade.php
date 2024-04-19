<x-store-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-slate-300">
            {{ __('Ecole') }}
        </h2>
    </x-slot>

    <div class="flex justify-center py-12">
        <div class="w-full sm:px-7 lg:px-8">
            <livewire:school.ecole-create />
        </div>
    </div>

</x-store-layout>
