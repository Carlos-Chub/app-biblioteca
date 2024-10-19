<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create book reader') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-form-section submit="save">
            <x-slot name="title">
                {{ __('Create book reader') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Form to register a book reader') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="reader" value="{{ __('Reader') }}" />
                    <x-select id="reader" class="mt-1 block w-full" wire:model="reader">
                        <option value="">{{ __('Select an reader') }}</option>
                        @foreach ($readers_all as $reader)
                            <option value="{{ $reader->id }}">
                                {{ $reader->names . ($reader->surnames ? ' ' . $reader->surnames : '') }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="reader" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="book" value="{{ __('Book') }}" />
                    <x-select id="book" class="mt-1 block w-full" wire:model="book">
                        <option value="">{{ __('Select an book') }}</option>
                        @foreach ($books_all as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->title }}
                            </option>
                        @endforeach
                    </x-select>
                    <x-input-error for="book" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="status" value="{{ __('Status') }}" />
                    <x-select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" id="status" class="mt-1 block w-full" wire:model="status">
                        <option value="pending_assignment">{{ __('Pending assignment') }}</option>
                        <option value="assigned_book">{{ __('Book assigned') }}</option>
                        <option value="book_returned">{{ __('Book returned') }}</option>
                    </x-select>
                    <x-input-error for="status" class="mt-2" />
                </div>
                
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="return_date" value="{{ __('Return date') }}" />
                    <x-input id="return_date" type="date" class="mt-1 block w-full"
                        wire:model="return_date" autocomplete="return_date" />
                    <x-input-error for="return_date" class="mt-2" />
                </div>
                
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="n" value="{{ __('Notifications') }}" />
                    <div class="flex flex-col">
                        <div>
                            <x-checkbox id="sms" value="sms" wire:model="notifications" />
                            <span class="ms-1 text-sm font-medium text-gray-700 dark:text-gray-50">{{ __('SMS') }}</span>
                        </div>
                        <div>
                            <x-checkbox id="whatsapp" value="whatsapp" wire:model="notifications" />
                            <span class="ms-1 text-sm font-medium text-gray-700 dark:text-gray-50">{{ __('WhatsApp') }}</span>
                        </div>
                        <div>
                            <x-checkbox id="email" value="email" wire:model="notifications" />
                            <span class="ms-1 text-sm font-medium text-gray-700 dark:text-gray-50">{{ __('Email') }}</span>
                        </div>
                    </div>
                    <x-input-error for="notifications" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="actions">
                <x-loader wire:loading wire:target="save"></x-loader>
                <x-button wire:loading.remove wire:target="save">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>
