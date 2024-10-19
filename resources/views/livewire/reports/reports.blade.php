<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Reportes') }}
            </h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-form-section submit="download_report">
            <x-slot name="title">
                {{ __('Reporte de lectores de libros') }}
            </x-slot>
            <x-slot name="description">
                {{ __('Reporte en excel donde se filtrar por estado y fecha de devolución') }}
            </x-slot>
            <x-slot name="form">
                <div class="col-span-6 md:col-span-4 -my-1.5">
                    <x-label for="reader" value="{{ __('Estado libro') }}" />
                    <x-select id="reader" class="mt-1 block w-full" wire:model="estado_libro">
                        <option value="all">{{ __('Todos') }}</option>
                        <option value="returned">{{ __('Devueltos') }}</option>
                        <option value="in_use">{{ __('En uso') }}</option>
                    </x-select>
                    <x-input-error for="estado_libro" class="mt-2" />
                </div>
                <div class="col-span-6 -my-2.5">
                    <x-label class="font-semibold" for="return_date" value="{{ __('Fecha de devolución') }}" />
                </div>
                <div class="col-span-6 md:col-span-3 -my-1.5">
                    <x-label for="return_date" value="{{ __('Fecha inicio') }}" />
                    <x-input id="return_date" type="date" class="mt-1 block w-full"
                        wire:model="fecha_inicio" autocomplete="return_date" />
                    <x-input-error for="fecha_inicio" class="mt-2" />
                </div><div class="col-span-6 md:col-span-3 -my-1.5">
                    <x-label for="return_date" value="{{ __('Fecha final') }}" />
                    <x-input id="return_date" type="date" class="mt-1 block w-full"
                        wire:model="fecha_final" autocomplete="fecha_final" />
                    <x-input-error for="fecha_final" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-loader wire:loading wire:target="download_report"></x-loader>
                <x-button wire:loading.remove wire:target="download_report">
                    {{ __('Descargar reporte') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>
