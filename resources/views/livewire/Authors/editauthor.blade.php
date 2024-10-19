<div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ __('Author Data Editing') }}
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