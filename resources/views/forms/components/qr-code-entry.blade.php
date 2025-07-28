{{-- <x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->
    </div>
</x-dynamic-component> --}}

<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div
        x-data="{
            state: null,
            qrCodeUrl: '{{ $getQrCodeUrl() }}',
            qrData: @js($getQrData()),
            isLoading: true,
            hasError: false,

            init() {
                this.state = this.qrCodeUrl;
            },

            downloadQr() {
                if (this.qrCodeUrl) {
                    const link = document.createElement('a');
                    link.href = this.qrCodeUrl;
                    link.download = `qr-code-${this.qrData.cust_num || 'customer'}.{{ $getFormat() }}`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            },

            copyQrData() {
                navigator.clipboard.writeText(JSON.stringify(this.qrData, null, 2)).then(() => {
                    // Optional: Add notification
                    console.log('QR data copied to clipboard');
                });
            },

            copyQrUrl() {
                navigator.clipboard.writeText(this.qrCodeUrl).then(() => {
                    console.log('QR URL copied to clipboard');
                });
            },

            refreshQr() {
                this.isLoading = true;
                this.hasError = false;
                this.$nextTick(() => {
                    this.state = this.qrCodeUrl + '&t=' + Date.now(); // Add timestamp to force refresh
                });
            }
        }"
        class="qr-code-entry"
    >
        @if($getRecord())
            <div class="flex flex-col items-start justify-start space-y-4">
                <!-- QR Code Image -->
                <div class="relative">
                    <div
                        x-show="isLoading"
                        class="flex items-center justify-center align-middle bg-gray-100 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700"
                        style="width: {{ $getSize() }}px; height: {{ $getSize() }}px;"
                    >
                        <svg class="animate-spin h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                    <img
                        x-show="!isLoading && !hasError"
                        x-on:load="isLoading = false"
                        x-on:error="isLoading = false; hasError = true"
                        :src="qrCodeUrl"
                        alt="Customer QR Code"
                        class="rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-shadow duration-200"
                        style="width: {{ $getSize() }}px; height: {{ $getSize() }}px;"
                    />

                    <div
                        x-show="!isLoading && hasError"
                        class="flex items-center justify-center bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg border border-red-200 dark:border-red-800"
                        style="width: {{ $getSize() }}px; height: {{ $getSize() }}px;"
                    >
                        <div class="text-center">
                            <svg class="h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            <p class="text-sm">Failed to load QR code</p>
                            <x-filament::button
                                type="button"
                                size="xs"
                                color="danger"
                                x-on:click="refreshQr()"
                                class="mt-2"
                            >
                                Retry
                            </x-filament::button>
                        </div>
                    </div>
                </div>



                <!-- Action Buttons -->
                <div class="flex flex-wrap justify-start align-middle items-center gap-2">
                    <!-- Download Button -->
                    <x-filament::button
                        type="button"
                        size="sm"
                        color="success"
                        icon="heroicon-m-arrow-down-tray"
                        x-on:click="downloadQr()"
                        x-show="!isLoading && !hasError"
                    >
                        Download
                    </x-filament::button>

                    <!-- Copy URL Button -->
                    {{-- <x-filament::button
                        type="button"
                        size="sm"
                        color="info"
                        icon="heroicon-m-link"
                        x-on:click="copyQrUrl()"
                        x-show="!isLoading && !hasError"
                    >
                        Copy URL
                    </x-filament::button> --}}

                    <!-- Copy Data Button -->
                    {{-- <x-filament::button
                        type="button"
                        size="sm"
                        color="gray"
                        icon="heroicon-m-clipboard-document"
                        x-on:click="copyQrData()"
                    >
                        Copy Data
                    </x-filament::button> --}}

                    <!-- Refresh Button -->
                    <x-filament::button
                        type="button"
                        size="sm"
                        color="warning"
                        icon="heroicon-m-arrow-path"
                        x-on:click="refreshQr()"
                    >
                        Refresh
                    </x-filament::button>
                </div>
            </div>
        @else
            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                <svg class="h-16 w-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Customer Data</h3>
                <p class="text-sm">Unable to generate QR code without customer information</p>
            </div>
        @endif
    </div>
</x-dynamic-component>
