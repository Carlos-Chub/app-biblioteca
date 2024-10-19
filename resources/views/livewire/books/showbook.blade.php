<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="mt-3">
                        <livewire:books.create-book />
                    </div>
                    <div class="mt-3">
                        <livewire:books.book-table />
                    </div>
                    <livewire:books.edit-book />
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal wire:model="showDeleteModal">
        <x-slot name="title"> {{ __('¿Estas seguro?') }}</x-slot>
        <x-slot name="content">
            {{ __('¿Quieres eliminar al libro: ' . $DeleteName . ', esta acción es irreversible?') }}</x-slot>
        <x-slot name="footer">
            <x-button wire:loading.remove wire:target="showDeleteModal" class="mr-2"
                wire:click="$set('showDeleteModal', false)">{{ __('Cancel') }}</x-button>
            <x-loader wire:loading wire:target="showDeleteModal"></x-loader>
            <x-danger-button wire:loading.remove wire:target="showDeleteModal"
                wire:click="delete({{ $DeleteSelected }})">{{ __('Confirm') }}</x-dangerbutton>
        </x-slot>
    </x-confirmation-modal>
</div>