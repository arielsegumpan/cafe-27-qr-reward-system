<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            state: $wire.$entangle('{{ $getStatePath() }}'),
            qrCodeUrl: '{{ $getQrCodeUrl() }}',
            qrData: @js($getQrData()),
            isLoading: true,
            hasError: false,

            init() {
                // Set the state to the QR code URL when component initializes
                if (this.qrCodeUrl && !this.state) {
                    this.state = this.qrCodeUrl;
                }
            },

            loadImage() {
                this.isLoading = true;
                this.hasError = false;

                const img = new Image();
                img.onload = () => {
                    this.isLoading = false;
                    this.hasError = false;
                };
                img.onerror = () => {
                    this.isLoading = false;
                    this.hasError = true;
                };
                img.src = this.qrCodeUrl;
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
                    // You can add a toast notification here if needed
                    console.log('QR data copied to clipboard');
                });
            },

            refreshQr() {
                this.isLoading = true;
                this.hasError = false;

                // Force reload by adding timestamp parameter
                const timestamp = new Date().getTime();
                const separator = this.qrCodeUrl.includes('?') ? '&' : '?';
                this.state = `${this.qrCodeUrl}${separator}_=${timestamp}`;

                // Update the URL for future downloads
                this.qrCodeUrl = this.state;

                // Reload the image
                this.loadImage();
            }
        }"
        class="qr-code-field"
    >
        @if($getRecord())
           <div class="flex flex-col md:flex-row md:items-start gap-4 justify-start">
                <!-- Left Column - QR Code -->
                <div class="flex flex-col items-start">
                    <!-- Hidden input to maintain state binding -->
                    <input type="hidden" x-model="state" />

                    <!-- QR Code Image -->
                    <div class="relative">
                        <div
                            x-show="isLoading"
                            class="flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700"
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
                            class="rounded-lg shadow-md border border-gray-200 dark:border-gray-700"
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
                                <p class="text-sm">{{ __('Failed to generate QR code') }}</p>
                                <button
                                    type="button"
                                    x-on:click="refreshQr()"
                                    class="mt-2 text-xs text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 underline"
                                >
                                    {{ __('Retry') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Customer Data and Actions -->
                <div class="w-full max-w-md">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 text-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-x-2">
                            <svg class="h-4 w-4 pr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            {{ __('Customer Information') }}
                        </h3>
                        <div class="space-y-2 text-gray-600 dark:text-gray-400 pt-4">
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Customer #:') }}</span>
                                <x-filament::badge color="warning" >
                                    <span class="font-mon" x-text="qrData.cust_num"></span>
                                </x-filament::badge>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Name:') }}</span>
                                <span class="text-right" x-text="(qrData.full_name).trim()"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Email:') }}</span>
                                <span class="text-right text-xs" x-text="qrData.email"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Phone:') }}</span>
                                <span class="text-right" x-text="qrData.phone_number"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">{{ __('Created:') }}</span>
                                <span class="text-right text-xs" x-text="qrData.created_at ? qrData.created_at : 'N/A'"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons with margin top -->
                    <div class="flex flex-wrap justify-start gap-3 w-full mt-4">
                        <!-- Download Button -->
                        <x-filament::button
                            type="button"
                            size="sm"
                            color="success"
                            icon="heroicon-m-arrow-down-tray"
                            x-on:click="downloadQr()"
                            x-show="!isLoading && !hasError"
                            class="mt-3"
                        >
                            {{ __('Download QR') }}
                        </x-filament::button>

                        <!-- Copy Data Button -->
                        <x-filament::button
                            type="button"
                            size="sm"
                            color="gray"
                            icon="heroicon-m-clipboard-document"
                            x-on:click="copyQrData()"
                            class="mt-3"
                        >
                            {{ __('Copy Data') }}
                        </x-filament::button>

                        <!-- Refresh Button -->
                        <x-filament::button
                            type="button"
                            size="sm"
                            color="warning"
                            icon="heroicon-m-arrow-path"
                            x-on:click="refreshQr()"
                            class="mt-3"
                        >
                            {{ __('Refresh QR') }}
                        </x-filament::button>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                <svg class="h-16 w-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('No Customer Data') }}</h3>
                <p class="text-sm">{{ __('QR code will be generated after customer is saved')}}</p>
            </div>
        @endif
    </div>
</x-dynamic-component>
