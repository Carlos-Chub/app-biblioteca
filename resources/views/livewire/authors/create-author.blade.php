<div>
    <div class="flex items-center justify-between mb-3">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Authors') }}
        </h2>
        <button wire:click="$set('open',true)"
            class="inline-flex items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 cursor-pointer">
            <svg class="w-4 h-4 mr-3" data-slot="icon" fill="currentColor" viewBox="0 0 16 16"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path
                    d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z">
                </path>
            </svg>
            {{ __('Create author') }}
        </button>
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ __('Create new author') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="{{ __('Names') }}"></x-label>
                <x-input type="text" class="w-full" wire:model.defer="names"></x-input>
                @error('names') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-label value="{{ __('Surnames') }}"></x-label>
                <x-input type="text" class="w-full" wire:model.defer="surnames"></x-input>
                @error('surnames') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open',false)" class="mr-2">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="save" wire:loading.remove wire:target="save">
                {{ __('Save') }}
            </x-danger-button>

            <span wire:loading.flex wire:target="save">Cargando...</span>
        </x-slot>
    </x-dialog-modal>
</div>