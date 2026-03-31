@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Page Content -->
    <div class="space-y-10">
        <!-- Page Header -->
        <div class="flex justify-between items-end">
            <div>
                <h3 class="text-4xl font-extrabold text-on-surface tracking-tighter">Customer CRM</h3>
                <p class="text-on-surface-variant font-body mt-2">Managing 1,284 pet parent relationships</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="px-6 py-2.5 bg-secondary-container text-on-secondary-container rounded-full font-bold text-sm flex items-center gap-2 border border-secondary/10 hover:bg-secondary-fixed-dim transition-all">
                    <span class="material-symbols-outlined text-lg">filter_list</span>
                    Advanced Filters
                </button>
                <button
                    class="px-6 py-2.5 bg-primary text-on-primary rounded-full font-bold text-sm flex items-center gap-2 hover:bg-primary-dim transition-all shadow-md">
                    <span class="material-symbols-outlined text-lg">person_add</span>
                    Add New Parent
                </button>
            </div>
        </div>
        <!-- Bento Grid Stats Section -->
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-4 glass-card p-6 rounded-lg relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <span class="material-symbols-outlined text-8xl text-primary">pets</span>
                </div>
                <p class="text-label-md text-stone-500 font-bold tracking-widest uppercase text-xs">Total Pets</p>
                <h4 class="text-4xl font-black text-on-surface mt-2">2,412</h4>
                <div class="mt-4 flex items-center gap-2 text-secondary font-bold text-sm">
                    <span class="material-symbols-outlined">trending_up</span>
                    <span>+12% from last month</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 glass-card p-6 rounded-lg border-l-4 border-secondary">
                <p class="text-label-md text-stone-500 font-bold tracking-widest uppercase text-xs">Active
                    Subscriptions</p>
                <h4 class="text-4xl font-black text-on-surface mt-2">842</h4>
                <div class="mt-4 flex items-center gap-2 text-stone-400 font-bold text-sm">
                    <span class="material-symbols-outlined">info</span>
                    <span>Tier: Premium Care</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 glass-card p-6 rounded-lg">
                <p class="text-label-md text-stone-500 font-bold tracking-widest uppercase text-xs">Avg. Visit
                    Frequency</p>
                <h4 class="text-4xl font-black text-on-surface mt-2">14 Days</h4>
                <div class="mt-4 flex items-center gap-2 text-primary font-bold text-sm">
                    <span class="material-symbols-outlined">event_repeat</span>
                    <span>Next cycle begins Monday</span>
                </div>
            </div>
        </div>
        <!-- Main CRM Area: Two-Column Layout -->
        <div x-data="{ selectedUser: null, filter: 'all' }" class="grid grid-cols-12 gap-10 items-start">
            <!-- Left Column: Searchable List -->
            <div class="col-span-12 lg:col-span-7 space-y-4">
                <div class="flex items-center justify-between mb-2 px-2">
                    <h5 class="font-bold text-on-surface-variant">Active Pet Parents</h5>
                    <div class="flex gap-4 text-xs font-bold text-stone-400">
                        <span @click="filter = 'all'"
                            :class="filter === 'all' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            All
                        </span>

                        <span @click="filter = 'new'"
                            :class="filter === 'new' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            New
                        </span>

                        <span @click="filter = 'vip'"
                            :class="filter === 'vip' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            VIP
                        </span>

                        <span @click="filter = 'standard'"
                            :class="filter === 'standard' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            Standard
                        </span>

                        <span @click="filter = 'inactive'"
                            :class="filter === 'inactive' ? 'text-primary border-b-2 border-primary' : ''"
                            class="cursor-pointer pb-1">
                            Inactive
                        </span>
                    </div>
                </div>
                <!-- Customer Entries -->
                <div class="space-y-4 p-4 max-h-[600px] overflow-y-auto">

                    <!-- Card 2 -->
                    @foreach ($users as $user)
                        @php
                            $userData = [
                                'id' => $user->id,
                                'first_name' => $user->first_name,
                                'last_name' => $user->last_name,
                                'location' => $user->location,
                                'status' => $user->status,
                                'email' => $user->email,
                            ];
                        @endphp
                        <div x-show=" (filter === 'all' && {{ $user->status }} === 1) ||
                            (filter === 'vip' && {{ $user->user_type }} === 0) ||
                            (filter === 'standard' && {{ $user->user_type }} === 1) ||
                            (filter === 'new' && {{ $user->user_type }} === 2) ||
                            (filter === 'inactive' && {{ $user->status }} === 0)"

                            @click='selectedUser = @json($userData)'
                            :class="selectedUser && selectedUser.id === {{ $user->id }} ? 'ring-2 ring-primary shadow-xl' :
                                ''"
                            class="glass-card p-6 rounded-lg hover:bg-surface-container-lowest/80 cursor-pointer transition-all border border-transparent hover:border-stone-200">
                            <div class="flex items-start justify-between">
                                <div class="flex gap-4">
                                    <img alt="Marcus Chen"
                                        class="w-14 h-14 rounded-full object-cover border-2 border-transparent"
                                        data-alt="professional headshot of a smiling middle-aged man with short dark hair in high-key lighting"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC-FmqPxJrYJLe7W7pLWC-NgwnpNxNnKvQoZg215w0Hj1YdejbyLcTf4uW4q24Rs0109p9hVsJoKC-yONvEjaSQEsIT1k__hmVH25wbQHWGVNAwYmfEbS22W9QRZ5m2AMMqg5Tb6d63EhJFLuga_3xy2zQpMGXnKglOC-kYOnPkaBolE0gpegJkEBGHY4C0LA58W-dN4by90JSvKrdjhCkh701otOMmZXEJ5_yEoiTOGOaHoc8o-FASAKBeViB4VxM2YlC2cCFxXPWA" />
                                    <div>
                                        <h6 class="text-lg font-bold text-on-surface">
                                            {{ $user->first_name . ' ' . $user->last_name }}</h6>
                                        <div class="flex items-center gap-2 mt-1">
                                            @php
                                                $userTypes = [
                                                    0 => [
                                                        'label' => 'VIP Parent',
                                                        'classes' => 'bg-secondary-container/30 text-secondary',
                                                    ],
                                                    1 => [
                                                        'label' => 'Standard',
                                                        'classes' => 'bg-stone-100 text-stone-500',
                                                    ],
                                                    2 => [
                                                        'label' => 'New Member',
                                                        'classes' => 'bg-primary-container/30 text-primary',
                                                    ],
                                                ];
                                                $type = $userTypes[$user->user_type] ?? [
                                                    'label' => 'Unknown',
                                                    'classes' => 'bg-gray-200 text-gray-800',
                                                ];
                                            @endphp
                                            <span
                                                class="px-2 py-0.5 {{ $type['classes'] }} text-[10px] font-black rounded-full tracking-wider uppercase">
                                                {{ $type['label'] }}
                                            </span>
                                            <span class="text-xs text-stone-500 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">location_on</span>
                                                {{ $user->location }}
                                            </span>
                                            <div class="flex items-center gap-1.5 text-secondary">
                                                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                                <span
                                                    class="text-xs font-bold">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-stone-400 font-bold uppercase tracking-wider">Last Visit</p>
                                    <p class="text-sm font-bold text-on-surface mt-0.5">
                                        {{ $user->last_visit ? $user->last_visit->format('M d, Y') : 'Never' }}</p>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between pt-4 border-t border-stone-100">
                                <div class="flex -space-x-3 overflow-hidden">
                                    <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white object-cover"
                                        data-alt="close-up of a energetic border collie dog with head tilted in a sunlit field"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDw8viQJNRKlwuP98JacNwmM6VTy1Y0h2I4qPIzs1QxVtcHIWDOcVod3Dtwmn9VImvhLiLpc5KtE5SwK9tpoUDUsIx_muF7r76tZECMFKUhqdsMt51VQo-HYk-mPoi_7HFEscC34D18Khv-0zaTlEMEAWl7ZrUllL_-d2hsTf00L6EeowcEtQo-OLxZ1-Bb3d45rPBk_9Wd3MiPTSSRoUSxhRiCQFWpTDaXerzqOyXn8pMlrRynWI3d7oNyj1DABJgnb9WqDYe0EkXJ" />
                                </div>
                                <div class="flex items-center gap-3">
                                    <a :href="'mailto:' + (selectedUser?.email || '')"
                                        class="p-2 text-stone-400 hover:text-secondary transition-colors">
                                        <span class="material-symbols-outlined">mail</span>
                                    </a>
                                    <button class="p-2 text-stone-400 hover:text-secondary transition-colors"><span
                                            class="material-symbols-outlined">call</span></button>
                                    <button class="p-2 text-stone-400 hover:text-secondary transition-colors"><span
                                            class="material-symbols-outlined">edit</span></button>
                                    <button class="p-2 text-stone-400 hover:text-error transition-colors"><span
                                            class="material-symbols-outlined">delete</span></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
            <!-- Right Column: Summary Detail Panel -->
            <div class="col-span-12 lg:col-span-5 sticky top-24">
                <div class="glass-card p-8 rounded-lg shadow-2xl overflow-hidden relative border-t-8 border-primary">
                    <div class="flex items-center justify-between mb-8">
                        <h5 class="text-xl font-black text-on-surface tracking-tight">Parent Summary</h5>
                        <button class="text-sm font-bold text-primary hover:underline"
                            x-text="selectedUser 
                                ? [selectedUser.first_name, selectedUser.last_name].filter(Boolean).join(' ') 
                                : 'Profile Name'">
                            Profile Name</button>
                    </div>
                    <!-- Pet Health Notes Section -->
                    <div class="space-y-6">
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-400 mb-4"
                                x-text="selectedUser.location">
                                Pets &amp; Health Status</h6>
                            <div class="space-y-4">
                                <!-- Pet 1 -->
                                <div
                                    class="p-4 bg-surface-container rounded-xl flex items-center gap-4 border-l-4 border-secondary">
                                    <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                                        <img class="w-full h-full object-cover"
                                            data-alt="close up of a happy golden retriever puppy outdoors"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7M0SKKCdI5h2T_nVVVFXuejxwlsbMjjdbOwLxOHXZ4T5zzf1NuNljlwRAyK5JuI_PG_wib-1tiniBy3IKcvsClmeRijPxAHOiH2jtcaK1y4KJZEHu-7fesuO4OZw8fLBig9L-YF9CduIq-Yz_L5V8Ey4AjKBv1VSnSxNalbmwDV2Dlj_uBsSzlIBfd7Z40llPIDwpo_DZyUimBykvoWk5y5E8fXA1e0-hmdc5871jpUTu0ISv5Nf8crOOb_0pv7Hjw6dru1FzlR1M" />
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <p class="font-bold text-on-surface">Buddy</p>
                                            <span
                                                class="text-[10px] bg-secondary text-on-secondary px-2 rounded-full font-black">STABLE</span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-1">Weight monitoring (74lbs).
                                            Allergic to chicken-based treats.</p>
                                    </div>
                                </div>
                                <!-- Pet 2 -->
                                <div
                                    class="p-4 bg-surface-container rounded-xl flex items-center gap-4 border-l-4 border-primary-fixed">
                                    <div class="w-12 h-12 rounded-full overflow-hidden shrink-0">
                                        <img class="w-full h-full object-cover" data-alt="beautiful ginger cat portrait"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDufkK06e0ypwE-AM0o_QPKFBzwbHXM6Jlw_BjE4VYZ7iFaoxR9-UP6Xl_F0pEt_NZvcfp_-G_2KlWko2jluFI_KO_bPfsCWyzYvkrtFWhbg5zGHeFHyFFvV4z1kvYBSJvtkjZe63IYUT12LANEzIpCxI6c21Huuuh0_ObVVPmP7hkqUh_Aisx0DuF3qRlJCHCEiuGgJEV2Q_2DZKnwIRk8VOCTK-cY60V1Ks-2UMwXM9E18aCj-xPIljUy7HqMQBLSoLGbVJnGY2m" />
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <p class="font-bold text-on-surface">Miso</p>
                                            <span
                                                class="text-[10px] bg-primary-fixed text-on-primary-fixed px-2 rounded-full font-black">FOLLOW
                                                UP</span>
                                        </div>
                                        <p class="text-xs text-on-surface-variant mt-1">Dental cleaning scheduled
                                            for Oct 24th. Prefers high-moisture diet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Purchase History Section -->
                        <div>
                            <h6 class="text-[10px] font-black uppercase tracking-[0.2em] text-stone-400 mb-4">
                                Recent Purchase History</h6>
                            <div class="glass-card rounded-xl overflow-hidden border border-stone-100">
                                <table class="w-full text-left text-sm">
                                    <thead class="bg-stone-50 border-b border-stone-100">
                                        <tr>
                                            <th class="px-4 py-2 font-black text-stone-500 text-[10px] uppercase">
                                                Date</th>
                                            <th class="px-4 py-2 font-black text-stone-500 text-[10px] uppercase">
                                                Item</th>
                                            <th
                                                class="px-4 py-2 font-black text-stone-500 text-[10px] uppercase text-right">
                                                Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-stone-50">
                                        <tr>
                                            <td class="px-4 py-3 text-stone-500 font-medium">Oct 12</td>
                                            <td class="px-4 py-3 font-bold text-on-surface">Royal Canine Dry (15kg)
                                            </td>
                                            <td class="px-4 py-3 text-right font-black">$84.50</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-stone-500 font-medium">Sep 28</td>
                                            <td class="px-4 py-3 font-bold text-on-surface">CBD Calming Chews</td>
                                            <td class="px-4 py-3 text-right font-black">$42.00</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-stone-500 font-medium">Sep 14</td>
                                            <td class="px-4 py-3 font-bold text-on-surface">Grooming &amp; Spa
                                                (Buddy)</td>
                                            <td class="px-4 py-3 text-right font-black">$120.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Quick Actions -->
                        <div class="pt-4 grid grid-cols-2 gap-4">
                            <button
                                class="flex items-center justify-center gap-2 py-3 bg-surface-container-high rounded-full font-bold text-xs hover:bg-stone-200 transition-colors">
                                <span class="material-symbols-outlined text-sm">edit_note</span>
                                Add Health Note
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 py-3 bg-surface-container-high rounded-full font-bold text-xs hover:bg-stone-200 transition-colors">
                                <span class="material-symbols-outlined text-sm">receipt_long</span>
                                Create Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination (Implicit for "Data-Heavy" feeling) -->
    {{-- <div class="px-10 pb-12 mt-4 flex justify-between items-center text-stone-400">
        <span class="text-xs font-bold uppercase tracking-widest">Showing 1-10 of 1,284 parents</span>
        <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all"><span
                    class="material-symbols-outlined">chevron_left</span></button>
            <span class="px-4 text-sm font-black text-on-surface">1</span>
            <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all text-stone-800"><span
                    class="material-symbols-outlined">chevron_right</span></button>
        <div class="flex items-center gap-2">
            <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all"><span
                    class="material-symbols-outlined">chevron_left</span></button>
            <span class="px-4 text-sm font-black text-on-surface">1</span>
            <button
                class="w-10 h-10 rounded-full border border-stone-200 flex items-center justify-center hover:bg-stone-100 transition-all text-stone-800"><span
                    class="material-symbols-outlined">chevron_right</span></button>
        </div>
    </div> --}}
@endsection
