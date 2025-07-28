<div>
     <!-- Main Content -->
    <div class="flex flex-1 p-6 gap-6 h-[calc(100vh-70px)]">
        <!-- Categories Panel -->
        <div class="w-72 bg-amber-100/40 rounded-2xl p-6 shadow-md flex flex-col overflow-hidden dark:bg-neutral-800 dark:border-neutral-700 ">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 text-gray-500 dark:text-amber-50">
                <svg class="text-primary size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                {{ __('Categories') }}
            </h2>
            <div class="flex flex-col gap-2 overflow-y-auto">

                <a href="#" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-amber-800 text-white hover:bg-amber-700 focus:outline-hidden focus:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none">

                   <svg  class="w-auto h-6" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2"><path style="fill:none" d="M0 0h64v64H0z"/><path d="M48.594 18H15.259l2.07 17.946a14.693 14.693 0 0 0 14.596 13.008h.003c7.462 0 13.739-5.595 14.595-13.008L48.594 18zM23 14s.269-2.471-1-5M41 14s-.269-2.471 1-5M28.488 12s.269-2.471-1-5M35.512 12s-.269-2.471 1-5M50.064 51.301a3.118 3.118 0 0 1-1.423.344h-3.967c-.887 0-1.732.379-2.322 1.04l-.246.275A3.114 3.114 0 0 1 39.783 54H24.069a3.114 3.114 0 0 1-2.323-1.04l-.245-.275a3.117 3.117 0 0 0-2.323-1.04h-3.966c-.495 0-.983-.118-1.423-.344l-4.571-2.347h45.416l-4.57 2.347z" style="fill:none;stroke:#fff;stroke-width:2px"/><path d="m47.491 27.612 2.489-1.494a2.644 2.644 0 0 1 4.003 2.282c-.082 3.567-1.442 8.282-7.735 9.927" style="fill:none;stroke:#fff;stroke-width:2px"/></svg>

                    {{ __('Hot Drinks') }}
                </a>


                <a href="#" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-amber-800 text-white hover:bg-amber-700 focus:outline-hidden focus:bg-amber-700 disabled:opacity-50 disabled:pointer-events-none">


                   <svg class="w-auto h-6" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2"><path style="fill:none" d="M0 0h64v64H0z"/><path d="m46.205 12.56-15.283 4.095 5.319 19.434a7.512 7.512 0 0 0 9.19 5.273h.002a8.3 8.3 0 0 0 5.053-3.889 8.301 8.301 0 0 0 .807-6.325L46.205 12.56zM45.883 41.349l3.806 14.205M45.114 56.78l9.15-2.452M30.264 16.095l-12.756-3.418-5.11 19.49a7.512 7.512 0 0 0 5.322 9.162h.002a8.303 8.303 0 0 0 10.181-5.915l2.264-8.634M18.117 41.543l-3.806 14.205M9.736 54.522l9.15 2.452" style="fill:none;stroke:#fff;stroke-width:2px"/><path d="M12.886 16.109a5.561 5.561 0 0 1-1.059-4.954 5.572 5.572 0 0 1 6.821-3.938 5.572 5.572 0 0 1 3.938 6.821M50.203 16.109a5.561 5.561 0 0 0 1.059-4.954 5.572 5.572 0 0 0-6.821-3.938 5.572 5.572 0 0 0-3.938 6.821M33.5 11.5 35 9M30.5 12l-1-1.5" style="fill:none;stroke:#fff;stroke-width:2px"/></svg>

                    {{ __('Cold Drinks') }}
                </a>

            </div>
        </div>

        <!-- Menu Items -->
        <!-- Grid container with custom scrollbar -->
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 overflow-y-scroll custom-scrollbar flex-1 pr-2">
                <!-- Menu Item 1 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Espresso</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Strong black coffee brewed under pressure</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱3.50</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 2 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Americano</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Espresso with hot water, smooth and bold</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱4.00</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 3 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Latte</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Espresso with steamed milk and foam</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱4.50</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 4 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Cappuccino</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Equal parts espresso, steamed milk, and foam</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱4.25</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 5 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl  shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Macchiato</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Espresso "marked" with a dollop of foam</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱3.75</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 6 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Mocha</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Espresso with chocolate and steamed milk</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱5.00</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 7 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Green Tea</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Fresh brewed green tea with antioxidants</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱3.00</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 8 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Hot Chocolate</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Rich chocolate drink with whipped cream</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱4.75</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Item 9 -->
                <div class="bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 rounded-xl shadow-xs border border-gray-200 hover:shadow-md cursor-pointer">
                    <div class="h-28 bg-gradient-item flex items-center justify-center text-4xl text-amber-700">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <div class="p-4">
                        <div class="font-semibold mb-1 text-gray-800 dark:text-white">Chai Latte</div>
                        <div class="text-gray-500 dark:text-neutral-400 text-sm mb-2 h-9 overflow-hidden">Spiced tea blend with steamed milk</div>
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-800 dark:text-white">₱4.50</div>
                            <div class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center cursor-pointer transition-all hover:bg-primary-dark hover:scale-110">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Order Panel -->
        <div class="w-96 bg-amber-100/40 dark:bg-neutral-800 dark:border-neutral-700 rounded-2xl shadow-md flex flex-col overflow-hidden">
            <div class="p-6 bg-gray-800 text-white">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Current Order</h3>
                    <div class="text-sm text-gray-400">#ORD-8251</div>
                </div>
                <div>
                    <div>Table 5 - Sarah Johnson</div>
                    <div class="text-sm text-gray-400">Loyalty: Gold Member</div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6">
                <!-- Order Item 1 -->
                <div class="flex py-4 border-b border-gray-200">
                    <div class="w-7 h-7 bg-primary text-white rounded-md flex items-center justify-center mr-4">
                        2
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between mb-1">
                            <div class="font-semibold text-gray-800 dark:text-white">Cappuccino</div>
                            <div class="text-gray-800 dark:text-white">₱9.50</div>
                        </div>
                        <div class="text-sm text-gray-500 mb-2">Size: Large, Milk: Oat</div>
                        <div class="flex gap-2">
                            <button class="w-7 h-7 rounded-md flex items-center justify-center cursor-pointer transition-all bg-gray-100 dark:bg-gray-300 hover:bg-gray-200 shadow-md">
                                <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>
                            <button class="w-7 h-7 rounded-md flex items-center justify-center cursor-pointer transition-all bg-gray-100 dark:bg-gray-300 hover:bg-gray-200 shadow-md">
                                <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- More order items... -->
            </div>

            <div class="p-6 bg-amber-100/40 dark:bg-neutral-800 dark:border-neutral-700 border-t border-gray-200">
                <div class="flex justify-between mb-2">
                    <div class="text-gray-800 dark:text-white">Subtotal</div>
                    <div class="text-gray-800 dark:text-white">₱18.75</div>
                </div>
                <div class="flex justify-between mb-2">
                    <div class="text-gray-800 dark:text-white">Tax (12%)</div>
                    <div class="text-gray-800 dark:text-white">₱1.59</div>
                </div>
                <div class="flex justify-between font-bold text-lg pt-2 mt-2 border-t border-dashed border-gray-300">
                    <div class="text-gray-800 dark:text-white">Total</div>
                    <div class="text-gray-800 dark:text-white">₱20.34</div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">
                    <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-semibold bg-amber-100 text-amber-800 hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all">
                        <i class="fas fa-receipt"></i> Hold
                    </button>
                    <button type="button" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-semibold bg-amber-100 text-amber-800 hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all">
                        <i class="fas fa-user"></i> Customer
                    </button>
                    <button type="button" class="py-3 px-4 col-span-2 inline-flex justify-center items-center gap-2 rounded-xl border border-transparent font-semibold bg-primary text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all">
                        <i class="fas fa-credit-card"></i> Process Payment
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Buttons -->
    <div class="fixed bottom-8 right-8 flex gap-4">
        <button type="button" class="w-14 h-14 rounded-full bg-secondary text-white flex items-center justify-center text-xl shadow-lg cursor-pointer transition-all hover:-translate-y-1 hover:shadow-xl">
            <i class="fas fa-percent"></i>
        </button>
        <button type="button" class="w-14 h-14 rounded-full bg-primary text-white flex items-center justify-center text-xl shadow-lg cursor-pointer transition-all hover:-translate-y-1 hover:shadow-xl">
            <i class="fas fa-qrcode"></i>
        </button>
    </div>
</div>

@push('scripts')
   <script>
        // Add interactivity to menu items
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                const addBtn = this.querySelector('.add-btn');
                addBtn.style.transform = 'scale(1.3)';
                addBtn.style.background = '#b45309';

                setTimeout(() => {
                    addBtn.style.transform = 'scale(1)';
                    addBtn.style.background = '#b45309';
                }, 300);
            });
        });

        // Update time display
        function updateTime() {
            const now = new Date();
            document.querySelector('.current-time').textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            document.querySelector('.current-date').textContent = now.toLocaleDateString([], { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
        }

        setInterval(updateTime, 60000);
        updateTime();

        // Category switching
        document.querySelectorAll('.category-item').forEach(cat => {
            cat.addEventListener('click', function() {
                document.querySelector('.category-item.active').classList.remove('bg-primary', 'text-white');
                document.querySelector('.category-item.active').classList.add('hover:bg-gray-50');
                this.classList.add('bg-primary', 'text-white');
                this.classList.remove('hover:bg-gray-50');
            });
        });
    </script>
@endpush
