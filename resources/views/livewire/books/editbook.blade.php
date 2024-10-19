<div>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            {{ __('Book Data Editing') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="{{ __('Title') }}" />
                <x-input type="text" class="w-full" wire:model.defer="title" />
                @error('title') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-label value="{{ __('Author') }}" />
                <select wire:model.defer="author_id" class="w-full mt-1 block rounded-md border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 text-gray-900 dark:text-gray-200 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:focus:ring-indigo-600 dark:focus:border-indigo-500">
                    <option value="">{{ __('Select an author') }}</option>
                    @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $author->id == $author_id ? 'selected' : '' }}>
                        {{ $author->names }} {{ $author->surnames }}
                    </option>
                    @endforeach
                </select>
                @error('author_id') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-label value="{{ __('Number of pages') }}" />
                <x-input type="number" class="w-full" wire:model.defer="pages" min="1" />
                @error('pages') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-label value="{{ __('Bookshelf') }}" />
                <x-input type="text" class="w-full" wire:model.defer="book_case" />
                @error('book_case') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-label value="{{ __('Row') }}" />
                <x-input type="text" class="w-full" wire:model.defer="row" />
                @error('row') <span class="error text-red-500">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)" class="mr-2">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button wire:click="save" wire:loading.remove wire:target="save">
                {{ __('Save') }}
            </x-danger-button>

            <span wire:loading.flex wire:target="save">Cargando...</span>
        </x-slot>
    </x-dialog-modal>
</div>