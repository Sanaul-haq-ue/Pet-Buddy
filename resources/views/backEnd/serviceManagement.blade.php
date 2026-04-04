@extends('backEnd.layouts.master')

@section('adminContent')
    <div class="px-12 py-10 space-y-16">
        <!-- Header Section -->
        <section class="max-w-4xl">
            <h1 class="text-5xl font-extrabold tracking-tight text-on-surface mb-4">Service &amp; Species Registry</h1>
            <p class="text-lg text-on-surface-variant leading-relaxed max-w-2xl font-body">
                Manage the core offerings of Radiant Sanctuary and maintain accurate biological data for our diverse
                clientele. Configure pricing, duration, and specific breed variations.
            </p>
        </section>
        <!-- Services Section -->
        <section>
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-on-surface">Available Services</h2>
                    <p class="text-stone-500 text-sm">Tailored care programs for every resident.</p>
                </div>
                <button
                    class="bg-primary text-on-primary px-8 py-3 rounded-full font-bold flex items-center gap-2 hover:bg-primary-dim active:scale-95 transition-all">
                    <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                    Create New Service
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <!-- Full Grooming Card -->
                <div
                    class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-3xl" data-icon="content_cut">content_cut</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Full Grooming</h3>
                        <p class="text-sm text-stone-500 line-clamp-2">Complete spa treatment including bath, hair trim,
                            nail clipping, and ear cleaning for all small mammals.</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                        <span class="text-primary font-bold">$65.00+</span>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Manage</button>
                            <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Routine Checkup Card -->
                <div
                    class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-secondary-container/30 rounded-2xl flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined text-3xl" data-icon="stethoscope">stethoscope</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Routine Checkup</h3>
                        <p class="text-sm text-stone-500 line-clamp-2">Bi-annual health evaluation, vital checks, and
                            preventative care consultations for pets of all sizes.</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                        <span class="text-primary font-bold">$120.00</span>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Manage</button>
                            <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Behavioral Training Card -->
                <div
                    class="glass-card p-8 rounded-lg flex flex-col gap-6 group hover:translate-y-[-4px] transition-all duration-500">
                    <div
                        class="w-14 h-14 bg-tertiary-container/30 rounded-2xl flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined text-3xl" data-icon="psychology">psychology</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Behavioral Training</h3>
                        <p class="text-sm text-stone-500 line-clamp-2">Positive reinforcement-based sessions focusing on
                            social skills, anxiety reduction, and basic commands.</p>
                    </div>
                    <div class="mt-auto flex items-center justify-between border-t border-stone-200/30 pt-6">
                        <span class="text-primary font-bold">$85.00 / hr</span>
                        <div class="flex gap-2">
                            <button
                                class="px-4 py-2 rounded-full border border-outline-variant/30 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Manage</button>
                            <button class="p-2 text-error hover:bg-error-container/20 rounded-full transition-colors">
                                <span class="material-symbols-outlined" data-icon="delete">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Species & Breeds Section (Restructured Hierarchy) -->
        <section class="space-y-8 pb-20">
            <div class="flex justify-between items-end border-b border-stone-200/50 pb-6">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-on-surface">Species &amp; Breeds</h2>
                    <p class="text-stone-500 text-sm">Hierarchical management of biological categories.</p>
                </div>
                <button
                    class="bg-primary text-on-primary px-8 py-3 rounded-full font-bold flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-lg shadow-primary/10">
                    <span class="material-symbols-outlined" data-icon="add">add</span>
                    Add New Species
                </button>
            </div>
            <div class="grid grid-cols-1 gap-12">
                <!-- Species Block: Canine -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between bg-white/40 p-4 rounded-full border border-stone-200/40">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-2xl" data-icon="pets">pets</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-extrabold text-on-surface">Canine</h3>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-stone-500">Mammal • 48
                                    Varieties</span>
                            </div>
                        </div>
                        <button
                            class="flex items-center gap-2 px-6 py-2.5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-sm transition-all">
                            <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                            Add New Breed
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-4">
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-primary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">Golden Retriever</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-primary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-primary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">German Shepherd</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-primary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-primary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">French Bulldog</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-primary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <button
                            class="border-2 border-dashed border-stone-200 rounded-lg p-5 text-stone-400 font-bold hover:text-primary hover:border-primary hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                            Show +45 more
                        </button>
                    </div>
                </div>
                <!-- Species Block: Feline -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between bg-white/40 p-4 rounded-full border border-stone-200/40">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-2xl" data-icon="cat">pets</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-extrabold text-on-surface">Feline</h3>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-stone-500">Mammal •
                                    32 Varieties</span>
                            </div>
                        </div>
                        <button
                            class="flex items-center gap-2 px-6 py-2.5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-sm transition-all">
                            <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                            Add New Breed
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-4">
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-secondary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">Siamese</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-secondary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-secondary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">Maine Coon</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-secondary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-secondary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">Persian</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-secondary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <button
                            class="border-2 border-dashed border-stone-200 rounded-lg p-5 text-stone-400 font-bold hover:text-secondary hover:border-secondary hover:bg-secondary/5 transition-all flex items-center justify-center gap-2">
                            Show +29 more
                        </button>
                    </div>
                </div>
                <!-- Species Block: Avian -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between bg-white/40 p-4 rounded-full border border-stone-200/40">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-tertiary-container text-on-tertiary-container rounded-full flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-2xl" data-icon="air">air</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-extrabold text-on-surface">Avian</h3>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-stone-500">Bird • 15
                                    Varieties</span>
                            </div>
                        </div>
                        <button
                            class="flex items-center gap-2 px-6 py-2.5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-sm transition-all">
                            <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                            Add New Breed
                        </button>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-4">
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-tertiary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">Cockatiel</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-tertiary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-tertiary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">African Grey</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-tertiary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <div
                            class="glass-card p-5 rounded-lg flex items-center justify-between group hover:border-tertiary/30 transition-all cursor-default">
                            <span class="font-bold text-on-surface">Budgerigar</span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-1.5 hover:text-tertiary transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="edit">edit</span></button>
                                <button class="p-1.5 hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-sm" data-icon="close">close</span></button>
                            </div>
                        </div>
                        <button
                            class="border-2 border-dashed border-stone-200 rounded-lg p-5 text-stone-400 font-bold hover:text-tertiary hover:border-tertiary hover:bg-tertiary/5 transition-all flex items-center justify-center gap-2">
                            Show +12 more
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
