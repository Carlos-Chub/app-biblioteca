<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Show reader') }}
            </h2>
            <a type="button" href="{{ route('reader.index') }}"
                class="inline-flex items-center px-4 py-2 bg-slate-100 border border-gray-400 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span class="ml-2">{{ __('Go back') }}</span>
            </a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-form-section submit="dfjksdjfkjsdkfjksdjfjsdj">
            <x-slot name="title">
                {{ __('Reader') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Show a reader') }}
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label class="font-semibold" for="names" value="{{ __('Names') }}" />
                    <p class="dark:text-gray-50">{{ $reader->names }}</p>
                </div>
                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label class="font-semibold" for="surnames" value="{{ __('Surnames') }}" />
                    <p class="dark:text-gray-50">{{ $reader->surnames }}</p>
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label class="font-semibold" for="date_birthday" value="{{ __('Date birthday') }}" />
                    <p class="dark:text-gray-50">{{ $fecha }}</p>
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label class="font-semibold" for="phone" value="{{ __('Phone') }}" />
                    <p class="dark:text-gray-50">{{ $reader->phone }}</p>
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label class="font-semibold" for="email" value="{{ __('Email') }}" />
                    <p class="dark:text-gray-50">{{ $reader->email }}</p>
                </div>

                <div class="col-span-6 sm:col-span-4 -my-1.5">
                    <x-label class="font-semibold" for="address" value="{{ __('Address') }}" />
                    <p class="dark:text-gray-50">{{ $reader->address }}</p>
                </div>
            </x-slot>
        </x-form-section>
    </div>
</div>
