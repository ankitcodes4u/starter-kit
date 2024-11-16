<div :class="$store.sidebar.isOpen ? 'block' : 'hidden';">
    <x-filament::section compact class="m-4 mr-8">
        <p class="text-gray-900 dark:text-gray-50 text-xs font-medium italic">
            &copy; {{ now()->format('Y') }} {{ __('All rights reserved. Design & developed by Solution Nepal.') }}
        </p>
    </x-filament::section>
</div>

<div :class="$store.sidebar.isOpen ? 'hidden' : 'block';">
    <div
        class="m-4 aspect-square w-10 mx-auto bg-gray-100 dark:bg-gray-200 p-2 rounded-lg ring-1 ring-gray-300 flex items-center justify-center font-bold text-gray-800 dark:text-gray-900">
        SN</div>
</div>
