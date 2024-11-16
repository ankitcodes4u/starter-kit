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
    }" class="flex items-center justify-between gap-2 p-2">
        <div class="w-full flex items-center justify-center">
            <x-filament::icon-button size="xl" @click="increaseFontSize()" icon="heroicon-m-plus-circle"
                color="gray" />
        </div>

        <div x-show="!fullScreenMode" class="w-full flex items-center justify-center">
            <x-filament::icon-button size="xl" @click="toggleFullScreenMode()" icon="heroicon-m-arrows-pointing-out"
                color="gray" />
        </div>

        <div x-show="fullScreenMode" class="w-full flex items-center justify-center">
            <x-filament::icon-button size="xl" @click="toggleFullScreenMode()" icon="heroicon-m-arrows-pointing-in"
                color="gray" />
        </div>

        <div class="w-full flex items-center justify-center">
            <x-filament::icon-button size="xl" @click="decreaseFontSize()" icon="heroicon-m-minus-circle"
                color="gray" />
        </div>
    </div>
</div>
