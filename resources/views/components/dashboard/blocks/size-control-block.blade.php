<div>
    <div x-data="{
        fullScreenMode: false,
        currentFontSize: $persist(90),
        init() {
            document.documentElement.style.fontSize = this.currentFontSize + '%';
        },
        increaseFontSize() {
            this.currentFontSize += 10;
            document.documentElement.style.fontSize = this.currentFontSize + '%';
        },
        decreaseFontSize() {
            if (this.currentFontSize > 50) {
                this.currentFontSize -= 10;
                document.documentElement.style.fontSize = this.currentFontSize + '%';
            }
        },
        toggleFullScreenMode() {
            this.fullScreenMode = !this.fullScreenMode;
            if (this.fullScreenMode) {
                document.documentElement.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }
    }" class="fi-theme-switcher grid grid-flow-col gap-x-1">
        <button aria-label="Increase font size" type="button" x-on:click="increaseFontSize()"
            x-tooltip="{
                content: 'Increase font size',
                theme: $store.theme,
            }"
            class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
            <x-filament::icon icon="heroicon-m-plus-circle" class="h-5 w-5" />
        </button>

        <button x-show="!fullScreenMode" aria-label="Full screen mode" type="button" x-on:click="toggleFullScreenMode()"
            x-tooltip="{
                content: 'Full screen mode',
                theme: $store.theme,
            }"
            class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
            <x-filament::icon icon="heroicon-m-arrows-pointing-out" class="h-5 w-5" />
        </button>

        <button x-show="fullScreenMode" aria-label="Escape full screen mode" type="button"
            x-on:click="toggleFullScreenMode()"
            x-tooltip="{
                content: 'Escape full screen mode',
                theme: $store.theme,
            }"
            class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
            <x-filament::icon icon="heroicon-m-arrows-pointing-in" class="h-5 w-5" />
        </button>

        <button aria-label="Decrease font size" type="button" x-on:click="decreaseFontSize()"
            x-tooltip="{
                content: 'Decrease font size',
                theme: $store.theme,
            }"
            class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400">
            <x-filament::icon icon="heroicon-m-minus-circle" class="h-5 w-5" />
        </button>
    </div>
</div>
