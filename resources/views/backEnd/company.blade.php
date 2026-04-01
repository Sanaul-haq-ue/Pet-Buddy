@extends('backEnd.layouts.master')

@section('adminContent')
    <!-- Content Canvas -->
    <div class="  pb-32">
        <div class="flex justify-between items-end pb-10">
            <div>
                <h3 class="text-4xl font-extrabold text-on-surface tracking-tighter">Company Profile</h3>
                <p class="text-on-surface-variant font-body mt-2">Refine your brand identity, contact details, and
                    operational flow at Radiant Habitat.</p>
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
                    Add New Company
                </button>
            </div>
        </div>
        <!-- Settings Bento Grid -->
        <div x-data="{ selectedCompany: null }" class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            <!-- Left Column: General & Branding -->
            {{-- <div class="md:col-span-7 flex flex-col gap-8">
                <!-- General Information Card -->
                <section class="glass-card rounded-lg p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <h3 class="font-headline font-bold text-xl">General Information</h3>
                    </div>
                    <div class="grid gap-6">
                        <div class="relative group">
                            <label
                                class="block text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-2">Company
                                Name</label>
                            <input
                                class="w-full bg-transparent border-b border-outline-variant/30 focus:border-secondary transition-all py-2 text-lg font-medium text-on-surface focus:ring-0 font-body outline-none"
                                type="text" value="Radiant Habitat" />
                        </div>
                        <div class="relative group">
                            <label
                                class="block text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-2">Tagline</label>
                            <input
                                class="w-full bg-transparent border-b border-outline-variant/30 focus:border-secondary transition-all py-2 text-lg font-medium text-on-surface focus:ring-0 font-body outline-none"
                                placeholder="e.g. A sanctuary for your furry companions" type="text" />
                        </div>
                        <div class="mt-4">
                            <label
                                class="block text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-4">Official
                                Logo</label>
                            <div class="flex items-center gap-6">
                                <div
                                    class="w-24 h-24 rounded-xl border-2 border-dashed border-outline-variant/30 flex items-center justify-center bg-surface-container-low group hover:border-primary transition-colors cursor-pointer relative overflow-hidden">
                                    <div class="text-center p-4">
                                        <span
                                            class="material-symbols-outlined text-zinc-400 group-hover:text-primary">upload</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-on-surface font-semibold mb-1">Upload brand mark</p>
                                    <p class="text-xs text-on-surface-variant">Recommended size: 512x512px. SVG, PNG or
                                        WEBP.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Branding Assets Card -->
                <section class="glass-card rounded-lg p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">palette</span>
                        <h3 class="font-headline font-bold text-xl">Branding Assets</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="flex items-center gap-4 p-4 bg-surface-container-low rounded-xl">
                            <div class="w-12 h-12 rounded-full bg-primary shadow-lg border-4 border-white"></div>
                            <div>
                                <p class="text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-1">
                                    Primary Color</p>
                                <p class="font-mono text-sm font-bold text-on-surface">#944C00</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-surface-container-low rounded-xl">
                            <div class="w-12 h-12 rounded-full bg-surface-dim shadow-lg border-4 border-white"></div>
                            <div>
                                <p class="text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-1">
                                    Secondary Color</p>
                                <p class="font-mono text-sm font-bold text-on-surface">#D9DBD6</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <button
                            class="w-full py-3 rounded-full border border-outline-variant/30 text-sm font-headline font-bold text-zinc-700 hover:bg-surface-container-highest transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">colorize</span>
                            Open Theme Builder
                        </button>
                    </div>
                </section>
                <!-- Social Media Card -->
                <section class="glass-card rounded-lg p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">share</span>
                        <h3 class="font-headline font-bold text-xl">Social Media Links</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-600">camera</span>
                            </div>
                            <input
                                class="flex-1 bg-transparent border-b border-outline-variant/30 focus:border-secondary transition-all py-2 text-sm font-body outline-none"
                                placeholder="Instagram URL" type="text" />
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-600">public</span>
                            </div>
                            <input
                                class="flex-1 bg-transparent border-b border-outline-variant/30 focus:border-secondary transition-all py-2 text-sm font-body outline-none"
                                placeholder="Facebook URL" type="text" />
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center">
                                <span class="material-symbols-outlined text-zinc-600">alternate_email</span>
                            </div>
                            <input
                                class="flex-1 bg-transparent border-b border-outline-variant/30 focus:border-secondary transition-all py-2 text-sm font-body outline-none"
                                placeholder="X (formerly Twitter) URL" type="text" />
                        </div>
                    </div>
                </section>
            </div> --}}
            <div class="md:col-span-7 flex flex-col gap-8">
                <!-- Recent Appointments Table -->
                <div class="lg:col-span-2 glass-card rounded-lg overflow-hidden flex flex-col">
                    <div class="p-8 pb-4 flex justify-between items-center">
                        <h4 class="text-xl font-headline font-bold tracking-tight">Recent Appointments</h4>
                        <button class="text-sm font-label text-primary hover:underline">VIEW ALL</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left p-4 max-h-[50px] overflow-y-auto">
                            <thead
                                class="bg-surface-container-low text-on-surface-variant font-label text-[10px] tracking-widest uppercase">
                                <tr>
                                    <th class="px-8 py-4">Logo</th>
                                    <th class="px-6 py-4">Company Name</th>
                                    <th class="px-6 py-4">Service</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-8 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10">
                                @foreach ($companies as $company)
                                    @php
                                        $companyData = [
                                            'id' => $company->id,
                                            'company_name' => $company->company_name,
                                            'phone1' => $company->phone1,
                                            'address' => $company->address,
                                            'email' => $company->email,
                                        ];
                                    @endphp
                                    <tr @click='selectedCompany = @json($companyData)'
                                        class="hover:bg-surface-container-lowest/50 transition-colors group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-3">
                                                <img alt="Pet Avatar" class="w-10 h-10 rounded-full object-cover"
                                                    data-alt="close-up of a happy golden retriever puppy with big ears and friendly eyes in a bright sunny room"
                                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYiIC7LDdcF93qhg7Wii6umfMnGA0Cm-lxBuCHohQ8LmfPb3ObrS-ZIhqY5ARfoJ8ddI5c1iYaZKZmJIBoDh41ixvtMS8tbH2eJ2Fo1HCnUwxw0jk-1ZSCQN-CFVeyDq5QpL25Pz832Rm0-RKeTtFWGFGC8KkDuiplNwWAzJuDNtT_2BNIYEVWqP1MtAFSbS-DILPj-dSofhT3kFeZpT-ofjWZW2iS81NfC8nH8RmyMK37syxuCe8bAl5_E0kVnmJyDIVMFEQIwPXD" />
                                                <span class="font-bold text-on-surface">Luna</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm">{{ $company->company_name }}</td>
                                        <td class="px-6 py-5">
                                            <span
                                                class="px-3 py-1 bg-secondary-container/30 text-on-secondary-container rounded-full text-[10px] font-bold tracking-wider uppercase">Grooming</span>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-1.5 text-secondary">
                                                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                                <span
                                                    class="text-xs font-bold">{{ $company->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <button class="p-2 text-stone-400 hover:text-secondary transition-colors"><span
                                                    class="material-symbols-outlined">edit</span></button>
                                            <button class="p-2 text-stone-400 hover:text-error transition-colors"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                        </td>
                                    </tr>
                                @endforeach
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
                        <div class="mt-4">
                            {{ $companies->links() }}
                        </div>
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
                    {{-- <div class="glass-card p-8 rounded-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-lg font-headline font-bold tracking-tight">Inventory Status</h4>
                            <span class="material-symbols-outlined text-outline">shopping_cart</span>
                        </div>
                        <div class="space-y-4">
                            <div
                                class="flex items-center gap-4 p-4 rounded-xl bg-error-container/10 border border-error/10">
                                <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-error"
                                        style="font-variation-settings: 'FILL' 1;">warning</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Premium Kibble (5kg)</p>
                                    <p class="text-[10px] text-error font-bold uppercase tracking-widest">Only 2 left</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-4 p-4 rounded-xl bg-tertiary-container/10 border border-tertiary/10">
                                <div class="w-10 h-10 rounded-full bg-tertiary/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-tertiary">inventory</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Calming Spray</p>
                                    <p class="text-[10px] text-tertiary font-bold uppercase tracking-widest">Low Stock: 5
                                        items
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 py-3 border border-outline-variant/30 rounded-full text-xs font-bold font-label hover:bg-surface-container transition-colors uppercase tracking-widest">Restock
                            All</button>
                    </div> --}}
                </div>
            </div>
            <!-- Right Column: Contact & Hours -->
            <div class="md:col-span-5 flex flex-col gap-8">
                <!-- Contact & Location Card -->
                <section class="glass-card rounded-lg p-8">
                    {{-- <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <h3 class="font-headline font-bold text-xl">Contact &amp; Location</h3>
                    </div> --}}
                    <div class="flex items-center justify-between mb-8">
                        <h5 class="text-xl font-black text-on-surface tracking-tight">Company Summary</h5>
                        <button class="text-sm font-bold text-primary hover:underline"
                        x-text="selectedCompany ? selectedCompany.company_name : 'Company Name'">
                            Profile Name</button>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label
                                class="block text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-2">Business
                                Address</label>
                            {{-- <textarea x-text="selectedCompany ? selectedCompany.address : 'Address Here'"
                                class="w-full bg-surface-container-low border-none rounded-2xl p-4 text-sm font-body focus:ring-2 focus:ring-secondary/20 outline-none resize-none"
                                rows="3"></textarea> --}}
                            <div class="w-full bg-surface-container-low border-none rounded-2xl p-4 text-sm font-body focus:ring-2 focus:ring-secondary/20 outline-none resize-none min-h-[72px]"
                                x-text="selectedCompany ? selectedCompany.address : 'Address Here'"></div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-2">Primary
                                    Phone</label>
                                <div class="w-full bg-surface-container-low border-none rounded-full px-4 py-3 text-sm font-body"
                                    x-text="selectedCompany ? selectedCompany.phone1 : '+1 (555) 892-4401'">
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-headline font-bold text-zinc-500 uppercase tracking-wider mb-2">Support
                                    Email</label>
                                {{-- <input
                                    class="w-full bg-surface-container-low border-none rounded-full px-4 py-3 text-sm font-body focus:ring-2 focus:ring-secondary/20 outline-none"
                                    type="email" value="hello@radianthabitat.com" /> --}}
                                <div class="w-full bg-surface-container-low border-none rounded-full px-4 py-3 text-sm font-body"
                                    x-text="selectedCompany ? selectedCompany.email : 'hello@radianthabitat.com'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 h-32 w-full rounded-2xl overflow-hidden relative">
                        <img class="w-full h-full object-cover"
                            data-alt="Abstract stylized map visualization with warm orange and teal accents and clean white labels"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpf563bg8wuV5xX0It4rETe2swXVAuD-hq9YJVSv5e49t1B-3Dy7eDwGaVdymDBBMHjgFirgglCnBVxiX8M9HEEVk3-SuZ8j0OrMJNvnqp5WprGpXIpCnNROclLUzd7YqyP9YWTvZAAm4jLeZlvEHnaQL8d6T3dWSL9G6smjhLJLCImMuSjzYWHZnbpBCZj8ja5s7LUgDh4w1pa5uTcxgzzhk0nokybcA4clB9HjABIazrmzDvc1b00G_ervb43lBKTPjVutkhCG66" />
                        <div class="absolute inset-0 bg-primary/10 flex items-center justify-center">
                            <span
                                class="bg-white/90 px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest text-primary shadow-lg border border-primary/10">Location
                                Verified</span>
                        </div>
                    </div>
                </section>
                <!-- Operating Hours Card -->
                <section class="glass-card rounded-lg p-8 overflow-hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                        <h3 class="font-headline font-bold text-xl">Operating Hours</h3>
                    </div>
                    <div class="space-y-1">
                        <div
                            class="flex justify-between items-center py-2 px-3 rounded-xl hover:bg-surface-container-low transition-colors">
                            <span class="text-sm font-bold text-zinc-600 font-headline">Monday</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded-lg font-bold">08:00
                                    AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-bold">07:00
                                    PM</span>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center py-2 px-3 rounded-xl hover:bg-surface-container-low transition-colors">
                            <span class="text-sm font-bold text-zinc-600 font-headline">Tuesday</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded-lg font-bold">08:00
                                    AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-bold">07:00
                                    PM</span>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center py-2 px-3 rounded-xl hover:bg-surface-container-low transition-colors">
                            <span class="text-sm font-bold text-zinc-600 font-headline">Wednesday</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded-lg font-bold">08:00
                                    AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-bold">07:00
                                    PM</span>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center py-2 px-3 rounded-xl hover:bg-surface-container-low transition-colors">
                            <span class="text-sm font-bold text-zinc-600 font-headline">Thursday</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded-lg font-bold">08:00
                                    AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-bold">07:00
                                    PM</span>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center py-2 px-3 rounded-xl hover:bg-surface-container-low transition-colors">
                            <span class="text-sm font-bold text-zinc-600 font-headline">Friday</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded-lg font-bold">08:00
                                    AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-bold">09:00
                                    PM</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center py-2 px-3 rounded-xl bg-orange-50/30">
                            <span class="text-sm font-bold text-primary font-headline">Saturday</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-secondary/10 text-secondary px-2 py-1 rounded-lg font-bold">10:00
                                    AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded-lg font-bold">06:00
                                    PM</span>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center py-2 px-3 rounded-xl hover:bg-surface-container-low transition-colors">
                            <span class="text-sm font-bold text-zinc-400 font-headline italic">Sunday</span>
                            <span class="text-xs font-bold text-error uppercase tracking-widest">Closed</span>
                        </div>
                    </div>
                    <button
                        class="w-full mt-6 py-2 text-xs font-headline font-bold text-secondary uppercase tracking-widest flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">edit_calendar</span>
                        Update Schedule
                    </button>
                </section>
            </div>
        </div>
    </div>
    <!-- Sticky Bottom Bar -->
    <div
        class="fixed bottom-0 right-0 left-0 md:left-64 p-6 bg-[#faf9f6]/95 backdrop-blur-md border-t border-outline-variant/10 z-30 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-zinc-400 animate-pulse">sync</span>
            <p class="text-xs text-on-surface-variant font-medium">All changes are saved locally until published</p>
        </div>
        <div class="flex gap-4">
            <button
                class="px-8 py-3 rounded-full border border-outline text-sm font-headline font-bold text-on-surface hover:bg-surface-container-low transition-colors active:scale-95 duration-200">
                Discard
            </button>
            <button
                class="px-10 py-3 rounded-full signature-glow text-on-primary text-sm font-headline font-bold shadow-xl shadow-primary/20 hover:primary-dim transition-all active:scale-95 duration-200">
                Save Changes
            </button>
        </div>
    </div>
@endsection
