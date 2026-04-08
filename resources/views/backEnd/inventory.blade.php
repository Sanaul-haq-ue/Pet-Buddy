@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- TopNavBar -->
    {{-- <header
        class="sticky top-0 z-40 flex justify-between items-center w-full h-16 px-8 bg-white/70 dark:bg-stone-950/70 backdrop-blur-md">
        <div class="flex items-center flex-1 max-w-xl">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-stone-400"
                    data-icon="search">search</span>
                <input
                    class="w-full bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-secondary/20 transition-all font-body"
                    placeholder="Search inventory..." type="text" />
            </div>
        </div>
        <div class="flex items-center gap-6 ml-auto">
            <div class="flex items-center gap-4 text-stone-500">
                <button class="hover:text-orange-600 transition-colors opacity-80 hover:opacity-100">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                </button>
                <button class="hover:text-orange-600 transition-colors opacity-80 hover:opacity-100">
                    <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
                </button>
            </div>
            <div class="h-8 w-px bg-stone-200/50"></div>
            <button class="flex items-center gap-3 group">
                <span
                    class="font-plus-jakarta-sans text-sm tracking-wide text-stone-700 font-semibold group-hover:text-orange-600 transition-colors">Admin
                    Profile</span>
                <img alt="Admin Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-primary-fixed"
                    data-alt="professional portrait of a confident woman in business casual attire with a soft, warm office background"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnv6lwO3P422KBc8gBJe7ISzaddmU368NJeh2lj6lO-cnl_Om7OoaNeNWHVEBsz2VJTgA2x26BwqUhjuO-xvczg-qF1oij6xHfCGuSDJ7PgvWtxyjRU0AH9dWEVUgDf6pV5wiYLWB6hYOrQIM8gyqRb9xOBJWRisPG9_2DUwibIxi0xQsCLl5mCiUqSCz5WRIFs9X4zGPDH5_jEW9atkWO72f9ZjXGZO9pYSvRhircJl5r-xB3uZj4JrjSnmvHwZ4h5JffyqOjoOGj" />
            </button>
        </div>
    </header> --}}
    <section>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-extrabold text-on-surface tracking-tight mb-2">Inventory Management</h2>
                <p class="text-on-surface-variant font-body max-w-lg">Monitor your stock levels, manage pricing, and
                    ensure your sanctuary is always fully equipped for every pet's needs.</p>
            </div>
            <button class="btn-add-new">
                <span class="material-symbols-outlined" data-icon="add_box">add_box</span>
                Add New Product
            </button>
        </div>
        <!-- Stats Overview - Subtle Tonal Shift -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-surface-container-low p-6 rounded-lg">
                <p class="text-xs font-label font-bold text-on-surface-variant tracking-widest uppercase mb-1">Total
                    Items</p>
                <p class="text-3xl font-headline font-extrabold text-on-surface">1,284</p>
            </div>
            <div class="bg-tertiary-container/30 p-6 rounded-lg border-l-4 border-tertiary">
                <p class="text-xs font-label font-bold text-tertiary-dim tracking-widest uppercase mb-1">Low Stock
                    Alerts</p>
                <p class="text-3xl font-headline font-extrabold text-tertiary-dim">12</p>
            </div>
            <div class="bg-surface-container-low p-6 rounded-lg">
                <p class="text-xs font-label font-bold text-on-surface-variant tracking-widest uppercase mb-1">Out
                    of Stock</p>
                <p class="text-3xl font-headline font-extrabold text-error">3</p>
            </div>
            <div class="bg-surface-container-low p-6 rounded-lg">
                <p class="text-xs font-label font-bold text-on-surface-variant tracking-widest uppercase mb-1">Total
                    Value</p>
                <p class="text-3xl font-headline font-extrabold text-on-surface">$24,850</p>
            </div>
        </div>
        <!-- Inventory Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Product Card 1 (Warning State) -->
            <div
                class="glass-card rounded-lg flex flex-col group overflow-hidden transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-64 overflow-hidden">
                    <img alt="Organic Puppy Food"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="studio shot of premium organic dry dog food in a modern minimalist bag with clean typography on a warm stone surface"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyaC2upFzsk_43i886UkDUySsuCaMnlVGJiIy-4LFogqNDCIrPuixTVb3SmmP9WvuEv29rf36BAm7tXW1kDHHOfB8hiGynRAnTRJEcwKj5elyOiQrm2-EviRQJZi92QNBd1dxykQY_GFGWGDgSmonMUY-QqTyUqhu2MnA8AW8s2KgKLyaDvJ8BcCDQ-QygjESYjUJK_-i5fj7HVun0StgS7U4GEjSFDiobD0j9tsSzWelen1QjMHifxsEavt3C5HJ9ZySPK1ZL7usW" />
                    <div
                        class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 shadow-md">
                        <span class="material-symbols-outlined text-sm" data-icon="warning">warning</span>
                        LOW STOCK
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-on-surface leading-tight mb-1">Heritage Grain Free Puppy
                        </h3>
                        <p class="text-sm text-on-surface-variant">Nutrition • 12kg Bag</p>
                    </div>
                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Inventory</p>
                                <p class="text-xl font-headline font-extrabold text-tertiary">8 Units</p>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Price</p>
                                <p class="text-xl font-headline font-extrabold">$84.99</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-grow bg-surface-container-highest hover:bg-primary-container/20 text-on-surface py-3 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Edit
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-highest hover:bg-secondary-container transition-all">
                                <span class="material-symbols-outlined text-stone-500"
                                    data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 2 -->
            <div
                class="glass-card rounded-lg flex flex-col group overflow-hidden transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-64 overflow-hidden">
                    <img alt="Gourmet Cat Salmon"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="high-end canned cat food with fresh salmon garnish in a brightly lit kitchen setting, vibrant and appetizing"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAajncPHXziJ5atq_hObKOkVW5-r5oq5z1ze8WG8JWJYWrd0n1NTpuektTwnOL-BBo7cQEFMrOjTydQh_MuNgc3wiWWKAhlDqLAW8MJWbkZywWZmMSUcFaJmfERyOLlAv1wSsNYwV5-6zDJUe-0A_EPjLIwf5jq1jSaRrisNHBPp2dTOcPSnxd6gjF3z_-NvjWph4d-kJZW2FtOSjrwyxfPv5ZwnFrUTP_tY2VnZUBzkPpzyFZs0olI-bfM8-USTT0id3QMa29dUXO4" />
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-on-surface leading-tight mb-1">Arctic Salmon &amp; Dill
                            Pate</h3>
                        <p class="text-sm text-on-surface-variant">Gourmet • 85g Can</p>
                    </div>
                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Inventory</p>
                                <p class="text-xl font-headline font-extrabold text-on-surface">142 Units</p>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Price</p>
                                <p class="text-xl font-headline font-extrabold">$3.25</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-grow bg-surface-container-highest hover:bg-primary-container/20 text-on-surface py-3 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Edit
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-highest hover:bg-secondary-container transition-all">
                                <span class="material-symbols-outlined text-stone-500"
                                    data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 3 (Warning State) -->
            <div
                class="glass-card rounded-lg flex flex-col group overflow-hidden transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-64 overflow-hidden">
                    <img alt="Calming Hemp Chews"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="macro shot of heart-shaped soft dog treats in a modern glass jar with soft diffused morning sunlight"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFkQ2bUBT9pQes4aIqXxfhPnDh1_IzL09iVmJNqvB0fXcRTm4JRepNYutALamqCkS776a40yYwkeabgIUOFHKLnM5jJi7fPRUSwHQFsGrFsz7QmLr985EJSY07Sm8aJGbtBMEuoayvaSzcDgv7p8N6MEY0TLJAHKN4huxC-zxtq2G4flEBzmZGJI70uK3GIGXyU2ZFtsbjnzQEqHDv_1n_hcfZQBBIBdphcZVsOEPy6Q6BGvr31MFYIwtKi0UibW3vfWZ25l0ZbeIJ" />
                    <div
                        class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 shadow-md">
                        <span class="material-symbols-outlined text-sm" data-icon="warning">warning</span>
                        LOW STOCK
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-on-surface leading-tight mb-1">ZenGarden Calming Bites
                        </h3>
                        <p class="text-sm text-on-surface-variant">Wellness • 60 Count</p>
                    </div>
                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Inventory</p>
                                <p class="text-xl font-headline font-extrabold text-tertiary">4 Units</p>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Price</p>
                                <p class="text-xl font-headline font-extrabold">$24.00</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-grow bg-surface-container-highest hover:bg-primary-container/20 text-on-surface py-3 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Edit
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-highest hover:bg-secondary-container transition-all">
                                <span class="material-symbols-outlined text-stone-500"
                                    data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 4 -->
            <div
                class="glass-card rounded-lg flex flex-col group overflow-hidden transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-64 overflow-hidden">
                    <img alt="Luxury Leather Collar"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="close-up of a premium tan leather dog collar with brushed gold hardware on a dark velvet cushion"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFkROoJg4vFM9yvTRVrgZdxQf5Euag2xQF35kxHJr7E8Dim1eggnD6qi1mQ0YGiriJtz5wY39r-D52xPihFtgXfdPXu3aUwYqAL4NvgRIK_4IJapHvgUrR7irtkJF7NRR-HG4XQQPIdTyEP9ba9u5Z9uwG1sOskmu575zZhBfQWyP8Bxp-Bq0F_kfJuUP5lzdZTXKUdbev_8yQ09iRS07lqp6-SaHYPeFFUCAE93O5gSYcKqsVW9dMqyUZUBejTOxilP2A-ag2IAAI" />
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-on-surface leading-tight mb-1">Tuscan Leather Collar</h3>
                        <p class="text-sm text-on-surface-variant">Accessories • Medium</p>
                    </div>
                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Inventory</p>
                                <p class="text-xl font-headline font-extrabold text-on-surface">24 Units</p>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Price</p>
                                <p class="text-xl font-headline font-extrabold">$115.00</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-grow bg-surface-container-highest hover:bg-primary-container/20 text-on-surface py-3 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Edit
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-highest hover:bg-secondary-container transition-all">
                                <span class="material-symbols-outlined text-stone-500"
                                    data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 5 -->
            <div
                class="glass-card rounded-lg flex flex-col group overflow-hidden transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-64 overflow-hidden">
                    <img alt="Biodegradable Cat Litter"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="eco-friendly tofu cat litter in a designer paper bag with pastel colors and organic leaf patterns"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNQlJupwsGPll2V458T_0t8-a50bA761w4UfwmVuGoKiD_KgU4IH9J_jOFBRknuEjgfTOhjh3FiXPZ4wzV24FeQweNQHsNPfGFvH2Wz4qdxp0icoI9mVsDX25Li-2CUmuk6rhfh0hH3xjbZRs4AEJOsLzY1sCoAY-03vzypJBqVjSbRmg-VWbU1i77BHpI3vBmu_ssiOYbhdHdZhO3awkXOFXbiVCCj9jF6G3FoSuaGOPx0j5tmK_Uh3h-kMyY3QCPsQqThpl06Te2" />
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-on-surface leading-tight mb-1">EcoSoft Tofu Litter</h3>
                        <p class="text-sm text-on-surface-variant">Essentials • 6kg</p>
                    </div>
                    <div class="mt-auto space-y-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Inventory</p>
                                <p class="text-xl font-headline font-extrabold text-on-surface">56 Units</p>
                            </div>
                            <div class="text-right">
                                <p
                                    class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider">
                                    Price</p>
                                <p class="text-xl font-headline font-extrabold">$18.50</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-grow bg-surface-container-highest hover:bg-primary-container/20 text-on-surface py-3 rounded-full text-xs font-bold transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Edit
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-highest hover:bg-secondary-container transition-all">
                                <span class="material-symbols-outlined text-stone-500"
                                    data-icon="more_vert">more_vert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Empty State / Add Suggestion Card -->
            <div
                class="border-2 border-dashed border-outline-variant/30 rounded-lg flex flex-col items-center justify-center p-8 text-center group cursor-pointer hover:border-primary-fixed hover:bg-primary-container/5 transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-full bg-surface-container-high flex items-center justify-center mb-4 group-hover:bg-primary-fixed-dim transition-colors">
                    <span
                        class="material-symbols-outlined text-3xl text-on-surface-variant group-hover:text-on-primary-fixed"
                        data-icon="inventory">inventory</span>
                </div>
                <p class="font-bold text-on-surface">Add New SKU</p>
                <p class="text-xs text-on-surface-variant mt-1 font-body">Expand your inventory with new high-end
                    pet care products.</p>
            </div>
        </div>
    </section>
    <!-- Asymmetric Detail Section -->
    <section class="px-10 py-16 grid grid-cols-1 lg:grid-cols-12 gap-12 bg-surface-container-low mt-10">
        <div class="lg:col-span-5 relative">
            <div class="sticky top-24">
                <h3 class="text-3xl font-extrabold text-on-surface mb-6 leading-tight">Stock Insight:<br />Seasonal
                    Shifts</h3>
                <p class="text-on-surface-variant mb-8 font-body leading-relaxed">We've noticed a 40% increase in
                    grooming supplies inventory turnover this month. Consider increasing the safety stock levels for
                    premium shampoos and detanglers.</p>
                <div class="space-y-4">
                    <div class="glass-card p-6 rounded-lg flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary"
                                data-icon="trending_up">trending_up</span>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Grooming Growth</p>
                            <p class="text-xs text-on-surface-variant">+12% vs last month</p>
                        </div>
                    </div>
                    <div class="glass-card p-6 rounded-lg flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-container/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary" data-icon="schedule">schedule</span>
                        </div>
                        <div>
                            <p class="font-bold text-sm">Next Delivery</p>
                            <p class="text-xs text-on-surface-variant">Scheduled for Oct 14th</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-7 space-y-8">
            <div class="glass-card p-8 rounded-lg overflow-hidden relative">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h4 class="font-extrabold text-xl">Inventory Value Forecast</h4>
                        <p class="text-sm text-on-surface-variant">Estimated quarterly growth based on current
                            stock</p>
                    </div>
                    <span class="material-symbols-outlined text-3xl text-stone-200" data-icon="bar_chart">bar_chart</span>
                </div>
                <div class="flex items-end gap-3 h-48 mb-6">
                    <div class="flex-1 bg-surface-container-highest rounded-t-full transition-all duration-1000 h-[30%]">
                    </div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-full transition-all duration-1000 h-[45%]">
                    </div>
                    <div class="flex-1 bg-primary-fixed rounded-t-full transition-all duration-1000 h-[80%]"></div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-full transition-all duration-1000 h-[60%]">
                    </div>
                    <div class="flex-1 bg-secondary-fixed rounded-t-full transition-all duration-1000 h-[95%]">
                    </div>
                    <div class="flex-1 bg-surface-container-highest rounded-t-full transition-all duration-1000 h-[50%]">
                    </div>
                    <div class="flex-1 bg-primary rounded-t-full transition-all duration-1000 h-[70%]"></div>
                </div>
                <div
                    class="grid grid-cols-7 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-wider text-center">
                    <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="glass-card p-6 rounded-lg flex flex-col justify-between h-40">
                    <span class="material-symbols-outlined text-orange-400" data-icon="package_2">package_2</span>
                    <div>
                        <p class="text-2xl font-extrabold">24</p>
                        <p class="text-xs font-label text-on-surface-variant uppercase tracking-widest">Pending
                            Orders</p>
                    </div>
                </div>
                <div class="glass-card p-6 rounded-lg flex flex-col justify-between h-40">
                    <span class="material-symbols-outlined text-teal-500" data-icon="local_shipping">local_shipping</span>
                    <div>
                        <p class="text-2xl font-extrabold">6</p>
                        <p class="text-xs font-label text-on-surface-variant uppercase tracking-widest">Inbound
                            Shipments</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection