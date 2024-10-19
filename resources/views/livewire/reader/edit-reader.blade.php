<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit reader') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-form-section submit="save">
            <x-slot name="title">
                {{ __('Edit reader') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Form to edit a reader') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="names" value="{{ __('Names') }}" />
                    <x-input id="names" type="text" class="mt-1 block w-full"
                        wire:model="names" autocomplete="names" />
                    <x-input-error for="names" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="surnames" value="{{ __('Surnames') }}" />
                    <x-input id="surnames" type="text" class="mt-1 block w-full"
                        wire:model="surnames" autocomplete="surnames" />
                    <x-input-error for="surnames" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="date_birthday" value="{{ __('Date birthday') }}" />
                    <x-input id="date_birthday" type="date" class="mt-1 block w-full"
                        wire:model="date_birthday" autocomplete="date_birthday" />
                    <x-input-error for="date_birthday" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" type="text" class="mt-1 block w-full"
                        wire:model="phone" autocomplete="phone" />
                    <x-input-error for="phone" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" type="text" class="mt-1 block w-full"
                        wire:model="email" autocomplete="email" />
                    <x-input-error for="email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label for="address" value="{{ __('Address') }}" />
                    <x-input id="address" type="text" class="mt-1 block w-full"
                        wire:model="address" autocomplete="email" />
                    <x-input-error for="address" class="mt-2" />
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
