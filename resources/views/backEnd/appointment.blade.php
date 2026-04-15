@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Dashboard Header -->
    <div class="mb-12 flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-headline font-extrabold text-on-surface tracking-tight">Appointments</h2>
            <p class="text-on-surface-variant font-body mt-2 text-lg">Managing the heart of Radiant Habitat today.
            </p>
        </div>
        <div class="flex gap-4">
            <div
                class="flex items-center bg-surface-container-low px-4 py-2 rounded-full gap-2 border border-outline-variant/10">
                <span class="material-symbols-outlined text-stone-400 text-sm">calendar_month</span>
                <span class="text-sm font-label font-bold text-on-surface">Oct 12 - Oct 18, 2023</span>
            </div>
            <button
                class="flex items-center bg-secondary-container/40 backdrop-blur text-on-secondary-container px-6 py-2 rounded-full font-headline font-bold gap-2 hover:bg-secondary-container transition-colors">
                <span class="material-symbols-outlined">tune</span>
                <span>Filters</span>
            </button>
        </div>
    </div>
    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        <!-- Left Column: Calendar View -->
        <div class="lg:col-span-5 space-y-8">
            <section class="glass-card p-8 rounded-lg shadow-[0_20px_40px_rgba(148,76,0,0.06)]">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-headline font-bold">October 2023</h3>
                    <div class="flex gap-2">
                        <button class="p-2 hover:bg-stone-100 rounded-full transition-colors"><span
                                class="material-symbols-outlined">chevron_left</span></button>
                        <button class="p-2 hover:bg-stone-100 rounded-full transition-colors"><span
                                class="material-symbols-outlined">chevron_right</span></button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-2 mb-4">
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Mon
                    </div>
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Tue
                    </div>
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Wed
                    </div>
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Thu
                    </div>
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Fri
                    </div>
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Sat
                    </div>
                    <div class="text-center text-[10px] font-bold text-stone-400 uppercase tracking-widest">Sun
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-y-4 text-center">
                    <div class="py-2 text-stone-300 font-body">27</div>
                    <div class="py-2 text-stone-300 font-body">28</div>
                    <div class="py-2 text-stone-300 font-body">29</div>
                    <div class="py-2 text-stone-300 font-body">30</div>
                    <div class="py-2 font-body text-stone-700">1</div>
                    <div class="py-2 font-body text-stone-700">2</div>
                    <div class="py-2 font-body text-stone-700">3</div>
                    <div class="py-2 font-body text-stone-700">4</div>
                    <div class="py-2 font-body text-stone-700">5</div>
                    <div class="py-2 font-body text-stone-700">6</div>
                    <div class="py-2 font-body text-stone-700">7</div>
                    <div class="py-2 font-body text-stone-700">8</div>
                    <div class="py-2 font-body text-stone-700">9</div>
                    <div class="py-2 font-body text-stone-700">10</div>
                    <div class="py-2 font-body text-stone-700">11</div>
                    <div class="py-2 relative flex items-center justify-center">
                        <span class="z-10 text-white font-bold">12</span>
                        <div class="absolute inset-0 bg-primary rounded-full scale-75"></div>
                    </div>
                    <div class="py-2 font-body text-stone-700 relative">
                        13
                        <div class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-secondary rounded-full">
                        </div>
                    </div>
                    <div class="py-2 font-body text-stone-700 relative">
                        14
                        <div class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-primary rounded-full">
                        </div>
                    </div>
                    <div class="py-2 font-body text-stone-700">15</div>
                    <div class="py-2 font-body text-stone-700">16</div>
                    <div class="py-2 font-body text-stone-700">17</div>
                </div>
            </section>
            <section class="glass-card p-8 rounded-lg">
                <h3 class="text-lg font-headline font-bold mb-6">Service Statistics</h3>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600">
                            <span class="material-symbols-outlined">content_cut</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-bold">Grooming</span>
                                <span class="text-xs text-stone-500">45%</span>
                            </div>
                            <div class="w-full bg-stone-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-orange-500 h-full w-[45%] rounded-full"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center text-teal-600">
                            <span class="material-symbols-outlined">psychology</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-bold">Training</span>
                                <span class="text-xs text-stone-500">30%</span>
                            </div>
                            <div class="w-full bg-stone-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-teal-500 h-full w-[30%] rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Right Column: Appointment List -->
        <div class="lg:col-span-7 space-y-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-headline font-bold">Today's Schedule</h3>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-secondary-fixed rounded-full"></span>
                    <span class="text-xs font-label font-semibold text-stone-500">3 ACTIVE NOW</span>
                </div>
            </div>
            <!-- Appointment Card 1 -->
            <div class="glass-card p-6 rounded-lg transition-all hover:scale-[1.01] flex items-center gap-6">
                <div class="relative group">
                    <img class="w-24 h-24 rounded-2xl object-cover shadow-md"
                        data-alt="close up of a golden retriever puppy looking curious with soft morning sunlight hitting its fur"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCl1MQNHLu2frwU5TYM9XqZipXZ54h84PwrPsiA6G_gqFgSy_824auDc3r-XK1A-zMjTTchH8JYVFgWtN7gAlzVEsyNNkyzN0F0Uhsn68WiTpBJgLUTSa_cUDWlk_agngjaPdg8CvKVu4vvxedpvWoWXTw15DivtMq0G2OYu2-ln4H9Dc_EVcFwdyu5Eh5SI2DeAFur-hVzKZ3oDs-Tn9JoIaLuOlkaRHLhajFwHlcTFqETJUV4tZ14TmWtztARpZuJvgPknxRz-bRT" />
                    <div class="absolute -top-2 -right-2 bg-white p-1 rounded-full shadow-sm">
                        <span class="material-symbols-outlined text-teal-600 text-sm"
                            style="font-variation-settings: 'FILL' 1;">stars</span>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-xl font-headline font-bold text-on-surface">Cooper</h4>
                            <p class="text-stone-500 text-sm font-body">Owner: Sarah Jenkins</p>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-headline font-extrabold text-primary">09:30 AM</div>
                            <span
                                class="px-3 py-1 bg-stone-100 rounded-full text-[10px] font-bold uppercase tracking-wider text-stone-600">60
                                mins</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex gap-4">
                            <div class="flex items-center gap-2 bg-surface-container px-3 py-1.5 rounded-full">
                                <span class="material-symbols-outlined text-sm text-stone-500">content_cut</span>
                                <span class="text-xs font-semibold text-stone-600">Full Grooming</span>
                            </div>
                            <div
                                class="flex items-center gap-2 bg-orange-50 px-3 py-1.5 rounded-full border border-orange-100">
                                <span class="material-symbols-outlined text-sm text-orange-600">medication</span>
                                <span class="text-xs font-semibold text-orange-700">Allergy Alert</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="p-2 bg-surface hover:bg-stone-100 rounded-full transition-colors border border-stone-100 shadow-sm">
                                <span class="material-symbols-outlined text-stone-600">edit</span>
                            </button>
                            <button
                                class="px-6 py-2 bg-primary text-on-primary rounded-full font-headline font-bold text-sm shadow-md hover:bg-primary-dim transition-all">
                                Manage
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Appointment Card 2 -->
            <div
                class="glass-card p-6 rounded-lg transition-all hover:scale-[1.01] flex items-center gap-6 border-l-4 border-l-secondary">
                <div class="relative">
                    <img class="w-24 h-24 rounded-2xl object-cover shadow-md"
                        data-alt="a small white french bulldog sitting calmly on a wooden floor with a neutral artistic background"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7ZZ_s6_VVbkzXT5hVT4poEV9C8-3BpwLy9w9ERnmDG4sS0JwDvKjiE9nhenC99ZxPCe4aJtEzVBIoQXF9dC_l9RBc64GqetQN3zcYFUEwVCZva9CE_vYFBVVIUWLt0pcHXFsU8mCZ8P6I3MAjqZS2mhnhGuTjpJ5sBln-JEwq8HKoVpmo1f92YQ0CWlcn3foSMn2wMpbhMKwzALdJInfduXSOW3PXUBigpRc0V4EChqjUIL_cjqFBXT5tjcH-R_tGRSvMOYOWxzA-" />
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-xl font-headline font-bold text-on-surface">Luna</h4>
                            <p class="text-stone-500 text-sm font-body">Owner: Michael Chen</p>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-headline font-extrabold text-primary">11:15 AM</div>
                            <span
                                class="px-3 py-1 bg-stone-100 rounded-full text-[10px] font-bold uppercase tracking-wider text-stone-600">45
                                mins</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex gap-4">
                            <div class="flex items-center gap-2 bg-secondary-container/30 px-3 py-1.5 rounded-full">
                                <span class="material-symbols-outlined text-sm text-secondary">psychology</span>
                                <span class="text-xs font-semibold text-secondary-dim">Puppy Socialization</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="p-2 bg-surface hover:bg-stone-100 rounded-full transition-colors border border-stone-100 shadow-sm">
                                <span class="material-symbols-outlined text-stone-600">edit</span>
                            </button>
                            <button
                                class="px-6 py-2 bg-primary text-on-primary rounded-full font-headline font-bold text-sm shadow-md hover:bg-primary-dim transition-all">
                                Manage
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Appointment Card 3 -->
            <div
                class="glass-card p-6 rounded-lg transition-all hover:scale-[1.01] flex items-center gap-6 opacity-80 grayscale-[0.3]">
                <div class="relative">
                    <img class="w-24 h-24 rounded-2xl object-cover shadow-md"
                        data-alt="charming black and white cat looking directly into the lens with bright green eyes and a soft blurred background"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpM0L4ew1aLpXBvy7ZYJoUF9Vdi-5fRNJ2k6_UbnZnX1YoEK4TTZ6ga-puC2i1GFpfX_VF5BlaHTceLj6TRGav9d4pwXBbH4zMO-k9xdsbzrs0yzqEcfB-m0_DG3BmIWiJLP3dL4KNMbU-O3apo0O2DLuhUkz2umLqhWzHuq9dR8g1OTaU5o5RbIYgE41kZ8dBN0JX9Aqy_oPbnO13YSUF-S20B3WbTXD-0POTlChpd4_gNRG-V6ZNu7OSTMutQncYGxh-g2VXJxur" />
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-xl font-headline font-bold text-on-surface">Midnight</h4>
                            <p class="text-stone-500 text-sm font-body">Owner: Elena Rodriguez</p>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-headline font-extrabold text-stone-400 line-through">08:00 AM
                            </div>
                            <span
                                class="px-3 py-1 bg-green-100 rounded-full text-[10px] font-bold uppercase tracking-wider text-green-700">Completed</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex gap-4">
                            <div class="flex items-center gap-2 bg-surface-container px-3 py-1.5 rounded-full">
                                <span class="material-symbols-outlined text-sm text-stone-500">sanitizer</span>
                                <span class="text-xs font-semibold text-stone-600">Nail Trimming</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="px-6 py-2 bg-stone-200 text-stone-500 rounded-full font-headline font-bold text-sm cursor-default">
                                Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Appointment Card 4 -->
            <div class="glass-card p-6 rounded-lg transition-all hover:scale-[1.01] flex items-center gap-6">
                <div class="relative">
                    <img class="w-24 h-24 rounded-2xl object-cover shadow-md"
                        data-alt="adorable fluffy small dog wearing a bright yellow bandana in a sunlit garden"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJOgnmDUvtkGN2SD1t__nwtw0Bqd6WuwUmOTRileg_U74mSFnZP0L6T446dny1_W6cce7e-1uEzjwBoIJLntsaff3K-hycXMAC3wO-EJ80zo8JOt0Qt_03ql6BAqjgIfKADH_-SogJejL2iT_21WHW6vVcrPu_ywdLXeDsrgWNE-T7H0_SLlEjMb8CdmkeAO3KCTWzaIjBCJoFAJkeAjo-Dg8jml7-XF8kPDMjWcbLUMGAl3KCI7dnsIf_2bdTSDU4-S5lujnDx7gV" />
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-xl font-headline font-bold text-on-surface">Mochi</h4>
                            <p class="text-stone-500 text-sm font-body">Owner: David Wilson</p>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-headline font-extrabold text-primary">02:30 PM</div>
                            <span
                                class="px-3 py-1 bg-stone-100 rounded-full text-[10px] font-bold uppercase tracking-wider text-stone-600">30
                                mins</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex gap-4">
                            <div class="flex items-center gap-2 bg-surface-container px-3 py-1.5 rounded-full">
                                <span class="material-symbols-outlined text-sm text-stone-500">bathtub</span>
                                <span class="text-xs font-semibold text-stone-600">Quick Bath</span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="p-2 bg-surface hover:bg-stone-100 rounded-full transition-colors border border-stone-100 shadow-sm">
                                <span class="material-symbols-outlined text-stone-600">edit</span>
                            </button>
                            <button
                                class="px-6 py-2 bg-primary text-on-primary rounded-full font-headline font-bold text-sm shadow-md hover:bg-primary-dim transition-all">
                                Manage
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
