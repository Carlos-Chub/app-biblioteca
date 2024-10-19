<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Readers') }}
                </h2>
                <a type="button" href="{{ route('reader.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-3" data-slot="icon" fill="currentColor" viewBox="0 0 16 16"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z">
                        </path>
                    </svg>
                    {{ __('Create reader') }}
                </a>
            </div>
        </x-slot>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <livewire:reader.reader-table />
            </div>
        </div>
    </div>
    <x-confirmation-modal wire:model="showDeleteModal">
        <x-slot name="title"> {{ __('¿Estas seguro?') }}</x-slot>
        <x-slot name="content">
            {{ __('¿Quieres eliminar al lector: ' . $DeleteName . ', esta acción es irreversible?') }}</x-slot>
        <x-slot name="footer">
            <x-button wire:loading.remove wire:target="showDeleteModal" class="mr-2"
                wire:click="$set('showDeleteModal', false)">{{ __('Cancel') }}</x-button>
            <x-loader wire:loading wire:target="showDeleteModal"></x-loader>
            <x-danger-button wire:loading.remove wire:target="showDeleteModal"
                wire:click="delete({{ $DeleteSelected }})">{{ __('Confirm') }}</x-dangerbutton>
        </x-slot>
    </x-confirmation-modal>
</div>
