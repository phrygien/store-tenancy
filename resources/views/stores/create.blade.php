<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-slate-300">
            {{ __('Create a Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto space-y-4 sm:px-6 lg:px-8">
            <x-ts-button icon="arrow-left" class="mb-8" href="{{ route('stores.index') }}">Votre domaine</x-ts-button>
            <livewire:stores.create-stores />
        </div>
    </div>
</x-app-layout>