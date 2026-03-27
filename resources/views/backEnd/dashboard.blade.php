@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Header Section -->
    <header class="mb-12">
        <h2 class="text-4xl font-headline font-extrabold text-on-surface tracking-tight">Dashboard Overview</h2>
        <p class="text-on-surface-variant mt-2 font-body italic">"The greatness of a nation can be judged by the way its
            animals are treated."</p>
    </header>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div class="glass-card p-8 rounded-lg shadow-[0_20px_40px_rgba(148,76,0,0.06)] border-l-4 border-primary">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-primary text-3xl">payments</span>
                <span class="text-secondary font-headline text-xs font-bold">+12%</span>
            </div>
            <p class="text-sm font-label text-outline tracking-widest uppercase">Total Revenue</p>
            <h3 class="text-3xl font-headline font-black mt-1">$42,850</h3>
        </div>
        <div class="glass-card p-8 rounded-lg shadow-[0_20px_40px_rgba(148,76,0,0.06)] border-l-4 border-secondary">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-secondary text-3xl">event_available</span>
                <span class="text-secondary font-headline text-xs font-bold">+5</span>
            </div>
            <p class="text-sm font-label text-outline tracking-widest uppercase">New Appointments</p>
            <h3 class="text-3xl font-headline font-black mt-1">24</h3>
        </div>
        <div class="glass-card p-8 rounded-lg shadow-[0_20px_40px_rgba(148,76,0,0.06)] border-l-4 border-error">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-error text-3xl">inventory_2</span>
                <span class="text-error font-headline text-xs font-bold">Alert</span>
            </div>
            <p class="text-sm font-label text-outline tracking-widest uppercase">Low Stock Items</p>
            <h3 class="text-3xl font-headline font-black mt-1">18</h3>
        </div>
        <div class="glass-card p-8 rounded-lg shadow-[0_20px_40px_rgba(148,76,0,0.06)] border-l-4 border-tertiary">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-tertiary text-3xl">pets</span>
                <span class="text-secondary font-headline text-xs font-bold">89%</span>
            </div>
            <p class="text-sm font-label text-outline tracking-widest uppercase">Active Customers</p>
            <h3 class="text-3xl font-headline font-black mt-1">1,240</h3>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Appointments Table -->
        <div class="lg:col-span-2 glass-card rounded-lg overflow-hidden flex flex-col">
            <div class="p-8 pb-4 flex justify-between items-center">
                <h4 class="text-xl font-headline font-bold tracking-tight">Recent Appointments</h4>
                <button class="text-sm font-label text-primary hover:underline">VIEW ALL</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead
                        class="bg-surface-container-low text-on-surface-variant font-label text-[10px] tracking-widest uppercase">
                        <tr>
                            <th class="px-8 py-4">Pet Name</th>
                            <th class="px-6 py-4">Owner</th>
                            <th class="px-6 py-4">Service</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        <tr class="hover:bg-surface-container-lowest/50 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <img alt="Pet Avatar" class="w-10 h-10 rounded-full object-cover"
                                        data-alt="close-up of a happy golden retriever puppy with big ears and friendly eyes in a bright sunny room"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYiIC7LDdcF93qhg7Wii6umfMnGA0Cm-lxBuCHohQ8LmfPb3ObrS-ZIhqY5ARfoJ8ddI5c1iYaZKZmJIBoDh41ixvtMS8tbH2eJ2Fo1HCnUwxw0jk-1ZSCQN-CFVeyDq5QpL25Pz832Rm0-RKeTtFWGFGC8KkDuiplNwWAzJuDNtT_2BNIYEVWqP1MtAFSbS-DILPj-dSofhT3kFeZpT-ofjWZW2iS81NfC8nH8RmyMK37syxuCe8bAl5_E0kVnmJyDIVMFEQIwPXD" />
                                    <span class="font-bold text-on-surface">Luna</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm">Sarah Jenkins</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-3 py-1 bg-secondary-container/30 text-on-secondary-container rounded-full text-[10px] font-bold tracking-wider uppercase">Grooming</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    <span class="text-xs font-bold">Confirmed</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button
                                    class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-lowest/50 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <img alt="Pet Avatar" class="w-10 h-10 rounded-full object-cover"
                                        data-alt="charming calico cat with curious eyes sitting on a velvet cushion with soft daylight through a window"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFKMg7nypPua2IR_BxvN3luj-AEF1Ruj2mU_hc7Rqav09rLEUjUXfEnl-tBYA06Dr56EE3YOzBxtgcFOzwys53OUkvUM2twT0qBDjJ5k2Esg7W_2vy_HgI6RXeG-zicv53AlKlhsDrUwg0j7aLfhqEB8pbq-dqLabJtu7JV7f1eohnwcKBN-uprf3hkAux38-ojqGhf2yuUxAtg56HQf0W7g2hgc0k5b4slDQMgE6Ro8YPZZkzBHthQVLG-QWTiE9Q4CAFcxPHH5-0" />
                                    <span class="font-bold text-on-surface">Milo</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm">Robert Chen</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-3 py-1 bg-tertiary-container/30 text-on-tertiary-container rounded-full text-[10px] font-bold tracking-wider uppercase">Checkup</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-1.5 text-primary">
                                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                    <span class="text-xs font-bold">Pending</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button
                                    class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-surface-container-lowest/50 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <img alt="Pet Avatar" class="w-10 h-10 rounded-full object-cover"
                                        data-alt="portrait of a small brown beagle puppy looking up with large soulful eyes on a clean wooden floor"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4NKSRoN3ngzXtIt0wwMkamCSeGlhc_7ac88w33m2IHG2wnKU6xwRlk4Li4exDBR8TtjLiKdcZZ4xft5WnysFJi9mJbPgiK8Y1p8_1P56b1D7QDY-r63G50pnRo_3-obqreezdCgBs6Dpra-_jQzztqejfPQgGKRqxIgnrmUa7gNpDVc-EXVBjh-vfLrM0LvUkCnSytMx33Y2DAT11NXQSIJ6RjuVmUpdEh6IKgrtc2jIhLZRXiCIxWanIXB_iKfV6mfW4F-4raQVn" />
                                    <span class="font-bold text-on-surface">Oliver</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm">Emma Watson</td>
                            <td class="px-6 py-5">
                                <span
                                    class="px-3 py-1 bg-secondary-container/30 text-on-secondary-container rounded-full text-[10px] font-bold tracking-wider uppercase">Vaccination</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-1.5 text-stone-400">
                                    <span class="w-2 h-2 rounded-full bg-stone-400"></span>
                                    <span class="text-xs font-bold">Completed</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button
                                    class="material-symbols-outlined text-outline group-hover:text-primary transition-colors">more_vert</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Side Widgets -->
        <div class="space-y-8 flex flex-col">
            <!-- Popular Services Bar Chart -->
            <div class="glass-card p-8 rounded-lg flex-1">
                <h4 class="text-lg font-headline font-bold tracking-tight mb-8">Popular Services</h4>
                <div class="space-y-6">
                    <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                            <div><span class="text-xs font-bold font-label uppercase tracking-wider">Grooming</span>
                            </div>
                            <div class="text-right"><span class="text-xs font-bold text-primary">85%</span></div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-surface-container">
                            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center signature-glow"
                                style="width:85%"></div>
                        </div>
                    </div>
                    <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                            <div><span class="text-xs font-bold font-label uppercase tracking-wider">Checkups</span>
                            </div>
                            <div class="text-right"><span class="text-xs font-bold text-primary">62%</span></div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-surface-container">
                            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center signature-glow opacity-80"
                                style="width:62%"></div>
                        </div>
                    </div>
                    <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                            <div><span class="text-xs font-bold font-label uppercase tracking-wider">Daycare</span>
                            </div>
                            <div class="text-right"><span class="text-xs font-bold text-primary">45%</span></div>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-surface-container">
                            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center signature-glow opacity-60"
                                style="width:45%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Inventory Status Widget -->
            <div class="glass-card p-8 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="text-lg font-headline font-bold tracking-tight">Inventory Status</h4>
                    <span class="material-symbols-outlined text-outline">shopping_cart</span>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-error-container/10 border border-error/10">
                        <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-error"
                                style="font-variation-settings: 'FILL' 1;">warning</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold">Premium Kibble (5kg)</p>
                            <p class="text-[10px] text-error font-bold uppercase tracking-widest">Only 2 left</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-tertiary-container/10 border border-tertiary/10">
                        <div class="w-10 h-10 rounded-full bg-tertiary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-tertiary">inventory</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold">Calming Spray</p>
                            <p class="text-[10px] text-tertiary font-bold uppercase tracking-widest">Low Stock: 5 items
                            </p>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-6 py-3 border border-outline-variant/30 rounded-full text-xs font-bold font-label hover:bg-surface-container transition-colors uppercase tracking-widest">Restock
                    All</button>
            </div>
        </div>
    </div>
    <!-- Asymmetric Featured Card -->
    <div class="mt-12 relative overflow-hidden glass-card rounded-lg p-10 flex flex-col md:flex-row items-center gap-10">
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-primary/5 blur-3xl"></div>
        <div class="flex-1 relative z-10">
            <span
                class="bg-primary/10 text-primary px-4 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase mb-4 inline-block">Pro
                Tip</span>
            <h3 class="text-3xl font-headline font-extrabold text-on-surface mb-4">Optimize your schedule</h3>
            <p class="text-on-surface-variant max-w-lg mb-8 leading-relaxed">Based on last week's traffic, Tuesday
                afternoons are your peak time for grooming. Consider assigning an extra staff member to maintain the
                sanctuary's calm atmosphere.</p>
            <button
                class="bg-on-surface text-surface px-8 py-3 rounded-full font-bold text-sm hover:bg-on-surface-variant transition-all">View
                Staffing Analytics</button>
        </div>
        <div class="w-full md:w-1/3 relative">
            <div class="relative z-10 rounded-lg overflow-hidden transform rotate-2 shadow-2xl">
                <img alt="Staff Member with Pet" class="w-full h-48 object-cover"
                    data-alt="professional pet groomer in a modern minimalist pet spa gently brushing a calm cat with warm evening light"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXwlfmLCAlmE7j2JgDEJ6G6EwJwdHbZqJRMo16upYneD3issg8hQ9HrrGguPi3BuUPAp-mkXuns-OO9JL2-fgmfjzwTeWsS0QeuGh4OvdNLQyplvm92eNcFmtqgS3VpDGFl58aplkHMFpoxpA-vYouf-sBdUJC6q2aYM3T1vhaVK1nmiAMHeqSDtBQDww9NX38kppOTvOqugFeGdPrM2viGUVbVn7O8m596aodqtgZ_rmR9SL-FVGTeQAgvruNuCQn1Ym2Kcmi5lnb" />
            </div>
            <div
                class="absolute -bottom-6 -left-6 z-20 w-32 h-32 rounded-lg overflow-hidden transform -rotate-6 shadow-xl border-4 border-white">
                <img alt="Staff Interaction" class="w-full h-full object-cover"
                    data-alt="close-up of a smiling staff member wearing a natural linen uniform holding a small dog's paw"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3V20kDc-bTzNczC_bKCsFXwtUTXa9Tq1N0hMsAsi18sxT4Dk9qWBRshtqPaZMxaYysGthLp1jdEyHxwESNcTH0ZOVThQ44xxeH4G8PtxT8eNgBl0JeYtiD6MAMZUoFzjRjdmU_3Yrj1hsycHvYPPHrrLyV127btOEvTyyCyTrcFNXHEr_v4-__Cq5WbPjVXI2Kt4QPQ_n61jDPuGcaryLlT278W_FHAHS-46sIebhiybySQpJ4L2PI_nkW24J1x26RsISBV6QSoel" />
            </div>
        </div>
    </div>
@endsection
