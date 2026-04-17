@extends('backEnd.layouts.master')

@section('adminContent')

    <link rel="stylesheet" href="{{ asset('backAssets/css/company.css') }}">

    
    <!-- Content Canvas -->
    <div class="company-canvas">
        <div class="d-flex justify-content-between align-items-end pb-4 mb-3">
            <div>
                <h3 class="fs-1 fw-bold text-on-surface tracking-tighter mb-1">Company Profile</h3>
                <p class="text-on-surface-variant font-body mb-0">Refine your brand identity, contact details, and
                    operational flow at Radiant Habitat.</p>
            </div>
            <div class="d-flex gap-3">
                <button class="btn bg-secondary-container text-on-secondary-container rounded-full fw-bold text-sm d-flex align-items-center gap-2 border hover-bg-secondary-fixed transition custom-active-scale px-4 py-2">
                    <span class="material-symbols-outlined fs-5">filter_list</span>
                    Advanced Filters
                </button>
                <button class="btn bg-primary text-on-primary rounded-full fw-bold text-sm d-flex align-items-center gap-2 hover-bg-primary-dim transition custom-active-scale border-0 shadow-sm px-4 py-2">
                    <span class="material-symbols-outlined fs-5">person_add</span>
                    Add New Company
                </button>
            </div>
        </div>

        <!-- Settings Bento Grid -->
        <div x-data="{ selectedCompany: null }" class="row g-4 align-items-start mt-2">
            
            <!-- Left Column: Recent Appointments & Sidebar widgets -->
            <div class="col-12 col-md-7 d-flex flex-column gap-8">
                <!-- Recent Appointments Table -->
                <div class="glass-card rounded-lg overflow-hidden d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center p-4 p-md-5 pb-3">
                        <h4 class="fs-5 font-headline fw-bold tracking-tight mb-0">Recent Appointments</h4>
                        <button class="btn btn-link p-0 text-sm font-label text-primary text-decoration-none shadow-none">VIEW ALL</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-divider text-start mb-0" style="max-height: 50px; overflow-y: auto;">
                            <thead class="bg-surface-container-low text-on-surface-variant font-label text-10px tracking-widest text-uppercase">
                                <tr>
                                    <th class="py-3 px-4 px-lg-5">Logo</th>
                                    <th class="py-3 px-3 px-lg-4">Company Name</th>
                                    <th class="py-3 px-3 px-lg-4">Service</th>
                                    <th class="py-3 px-3 px-lg-4">Status</th>
                                    <th class="py-3 px-4 px-lg-5 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <tr @click='selectedCompany = @json($companyData)' class="hover-bg-surface-lowest group" style="cursor: pointer;">
                                        <td class="py-3 px-4 px-lg-5 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <img alt="Pet Avatar" class="w-10 h-10 rounded-circle object-fit-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYiIC7LDdcF93qhg7Wii6umfMnGA0Cm-lxBuCHohQ8LmfPb3ObrS-ZIhqY5ARfoJ8ddI5c1iYaZKZmJIBoDh41ixvtMS8tbH2eJ2Fo1HCnUwxw0jk-1ZSCQN-CFVeyDq5QpL25Pz832Rm0-RKeTtFWGFGC8KkDuiplNwWAzJuDNtT_2BNIYEVWqP1MtAFSbS-DILPj-dSofhT3kFeZpT-ofjWZW2iS81NfC8nH8RmyMK37syxuCe8bAl5_E0kVnmJyDIVMFEQIwPXD" />
                                                <span class="fw-bold text-on-surface">Luna</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle text-sm">{{ $company->company_name }}</td>
                                        <td class="py-3 px-3 px-lg-4 align-middle">
                                            <span class="px-3 py-1 bg-secondary-container-30 text-on-secondary-container rounded-full text-10px fw-bold tracking-wider text-uppercase d-inline-block">Grooming</span>
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle">
                                            <div class="d-flex align-items-center gap-2 text-secondary">
                                                <span class="w-2 h-2 rounded-full bg-secondary d-inline-block"></span>
                                                <span class="text-xs fw-bold">{{ $company->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 px-lg-5 align-middle text-end">
                                            <button class="btn btn-link p-1 text-stone-400 hover-text-secondary text-decoration-none shadow-none"><span class="material-symbols-outlined fs-5">edit</span></button>
                                            <button class="btn btn-link p-1 text-stone-400 hover-text-error text-decoration-none shadow-none"><span class="material-symbols-outlined fs-5">delete</span></button>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Static Samples from original design -->
                                <tr class="hover-bg-surface-lowest group">
                                    <td class="py-3 px-4 px-lg-5 align-middle">
                                        <div class="d-flex align-items-center gap-3">
                                            <img alt="Pet Avatar" class="w-10 h-10 rounded-circle object-fit-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAFKMg7nypPua2IR_BxvN3luj-AEF1Ruj2mU_hc7Rqav09rLEUjUXfEnl-tBYA06Dr56EE3YOzBxtgcFOzwys53OUkvUM2twT0qBDjJ5k2Esg7W_2vy_HgI6RXeG-zicv53AlKlhsDrUwg0j7aLfhqEB8pbq-dqLabJtu7JV7f1eohnwcKBN-uprf3hkAux38-ojqGhf2yuUxAtg56HQf0W7g2hgc0k5b4slDQMgE6Ro8YPZZkzBHthQVLG-QWTiE9Q4CAFcxPHH5-0" />
                                            <span class="fw-bold text-on-surface">Milo</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 px-lg-4 align-middle text-sm">Robert Chen</td>
                                    <td class="py-3 px-3 px-lg-4 align-middle">
                                        <span class="px-3 py-1 bg-tertiary-container-30 text-on-tertiary-container rounded-full text-10px fw-bold tracking-wider text-uppercase d-inline-block">Checkup</span>
                                    </td>
                                    <td class="py-3 px-3 px-lg-4 align-middle">
                                        <div class="d-flex align-items-center gap-2 text-primary">
                                            <span class="w-2 h-2 rounded-full bg-primary animate-pulse d-inline-block"></span>
                                            <span class="text-xs fw-bold">Pending</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 px-lg-5 align-middle text-end">
                                        <button class="btn btn-link p-1 text-secondary group-hover-text-primary text-decoration-none shadow-none"><span class="material-symbols-outlined fs-5">more_vert</span></button>
                                    </td>
                                </tr>
                                <tr class="hover-bg-surface-lowest group">
                                    <td class="py-3 px-4 px-lg-5 align-middle">
                                        <div class="d-flex align-items-center gap-3">
                                            <img alt="Pet Avatar" class="w-10 h-10 rounded-circle object-fit-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4NKSRoN3ngzXtIt0wwMkamCSeGlhc_7ac88w33m2IHG2wnKU6xwRlk4Li4exDBR8TtjLiKdcZZ4xft5WnysFJi9mJbPgiK8Y1p8_1P56b1D7QDY-r63G50pnRo_3-obqreezdCgBs6Dpra-_jQzztqejfPQgGKRqxIgnrmUa7gNpDVc-EXVBjh-vfLrM0LvUkCnSytMx33Y2DAT11NXQSIJ6RjuVmUpdEh6IKgrtc2jIhLZRXiCIxWanIXB_iKfV6mfW4F-4raQVn" />
                                            <span class="fw-bold text-on-surface">Oliver</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 px-lg-4 align-middle text-sm">Emma Watson</td>
                                    <td class="py-3 px-3 px-lg-4 align-middle">
                                        <span class="px-3 py-1 bg-secondary-container-30 text-on-secondary-container rounded-full text-10px fw-bold tracking-wider text-uppercase d-inline-block">Vaccination</span>
                                    </td>
                                    <td class="py-3 px-3 px-lg-4 align-middle">
                                        <div class="d-flex align-items-center gap-2 text-stone-400">
                                            <span class="w-2 h-2 rounded-full bg-stone-400 d-inline-block"></span>
                                            <span class="text-xs fw-bold">Completed</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 px-lg-5 align-middle text-end">
                                        <button class="btn btn-link p-1 text-secondary group-hover-text-primary text-decoration-none shadow-none"><span class="material-symbols-outlined fs-5">more_vert</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="px-4 py-3">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>

                <!-- Side Widgets -->
                <div class="d-flex flex-column gap-8">
                    <!-- Popular Services Bar Chart -->
                    <div class="glass-card p-4 p-md-5 rounded-lg flex-grow-1">
                        <h4 class="fs-5 font-headline fw-bold tracking-tight mb-4">Popular Services</h4>
                        <div class="d-flex flex-column gap-4">
                            <!-- Progress Bar 1 -->
                            <div class="position-relative pt-1">
                                <div class="d-flex mb-2 align-items-center justify-content-between">
                                    <div><span class="text-xs fw-bold font-label text-uppercase tracking-wider">Grooming</span></div>
                                    <div class="text-end"><span class="text-xs fw-bold text-primary">85%</span></div>
                                </div>
                                <div class="overflow-hidden mb-3 rounded-full bg-surface-container" style="height: 0.5rem;">
                                    <div class="h-100 bg-primary signature-glow" style="width:85%"></div>
                                </div>
                            </div>
                            <!-- Progress Bar 2 -->
                            <div class="position-relative pt-1">
                                <div class="d-flex mb-2 align-items-center justify-content-between">
                                    <div><span class="text-xs fw-bold font-label text-uppercase tracking-wider">Checkups</span></div>
                                    <div class="text-end"><span class="text-xs fw-bold text-primary">62%</span></div>
                                </div>
                                <div class="overflow-hidden mb-3 rounded-full bg-surface-container" style="height: 0.5rem;">
                                    <div class="h-100 bg-primary signature-glow opacity-75" style="width:62%"></div>
                                </div>
                            </div>
                            <!-- Progress Bar 3 -->
                            <div class="position-relative pt-1">
                                <div class="d-flex mb-2 align-items-center justify-content-between">
                                    <div><span class="text-xs fw-bold font-label text-uppercase tracking-wider">Daycare</span></div>
                                    <div class="text-end"><span class="text-xs fw-bold text-primary">45%</span></div>
                                </div>
                                <div class="overflow-hidden mb-3 rounded-full bg-surface-container" style="height: 0.5rem;">
                                    <div class="h-100 bg-primary signature-glow opacity-50" style="width:45%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Contact & Hours -->
            <div class="col-12 col-md-5 d-flex flex-column gap-8">
                <!-- Contact & Location Card -->
                <section class="glass-card rounded-lg p-4 p-md-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="fs-4 fw-bolder text-on-surface tracking-tight mb-0">Company Summary</h5>
                        <button class="btn btn-link p-0 text-sm fw-bold text-primary text-decoration-none shadow-none hover-text-primary"
                                x-text="selectedCompany ? selectedCompany.company_name : 'Company Name'">
                            Profile Name
                        </button>
                    </div>
                    <div class="d-flex flex-column gap-4">
                        <div>
                            <label class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                Business Address
                            </label>
                            <div class="w-100 bg-surface-container-low border-0 rounded-2xl p-3 text-sm font-body custom-focus-ring"
                                 style="min-height: 72px;"
                                 x-text="selectedCompany ? selectedCompany.address : 'Address Here'"></div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                    Primary Phone
                                </label>
                                <div class="w-100 bg-surface-container-low border-0 rounded-full px-4 py-2 mt-1 text-sm font-body custom-focus-ring"
                                     x-text="selectedCompany ? selectedCompany.phone1 : '+1 (555) 892-4401'">
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                    Support Email
                                </label>
                                <div class="w-100 bg-surface-container-low border-0 rounded-full px-4 py-2 mt-1 text-sm font-body custom-focus-ring"
                                     x-text="selectedCompany ? selectedCompany.email : 'hello@radianthabitat.com'">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 w-100 rounded-2xl overflow-hidden position-relative" style="height: 8rem;">
                        <img class="w-100 h-100 object-fit-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpf563bg8wuV5xX0It4rETe2swXVAuD-hq9YJVSv5e49t1B-3Dy7eDwGaVdymDBBMHjgFirgglCnBVxiX8M9HEEVk3-SuZ8j0OrMJNvnqp5WprGpXIpCnNROclLUzd7YqyP9YWTvZAAm4jLeZlvEHnaQL8d6T3dWSL9G6smjhLJLCImMuSjzYWHZnbpBCZj8ja5s7LUgDh4w1pa5uTcxgzzhk0nokybcA4clB9HjABIazrmzDvc1b00G_ervb43lBKTPjVutkhCG66" />
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary-10 d-flex align-items-center justify-content-center">
                            <span class="bg-white px-3 py-2 rounded-full text-10px fw-bold text-uppercase tracking-widest text-primary shadow-sm border border-secondary" style="opacity: 0.95;">
                                Location Verified
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Operating Hours Card -->
                <section class="glass-card rounded-lg p-4 p-md-5 overflow-hidden">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-primary fs-4">schedule</span>
                        <h3 class="font-headline fw-bold fs-5 mb-0">Operating Hours</h3>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <!-- Monday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                            <span class="text-sm fw-bold text-zinc-600 font-headline">Monday</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00 AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00 PM</span>
                            </div>
                        </div>
                        <!-- Tuesday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                            <span class="text-sm fw-bold text-zinc-600 font-headline">Tuesday</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00 AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00 PM</span>
                            </div>
                        </div>
                        <!-- Wednesday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                            <span class="text-sm fw-bold text-zinc-600 font-headline">Wednesday</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00 AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00 PM</span>
                            </div>
                        </div>
                        <!-- Thursday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                            <span class="text-sm fw-bold text-zinc-600 font-headline">Thursday</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00 AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00 PM</span>
                            </div>
                        </div>
                        <!-- Friday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                            <span class="text-sm fw-bold text-zinc-600 font-headline">Friday</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00 AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">09:00 PM</span>
                            </div>
                        </div>
                        <!-- Saturday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl bg-orange-50-30">
                            <span class="text-sm fw-bold text-primary font-headline">Saturday</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">10:00 AM</span>
                                <span class="text-zinc-300">—</span>
                                <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">06:00 PM</span>
                            </div>
                        </div>
                        <!-- Sunday -->
                        <div class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                            <span class="text-sm fw-bold text-zinc-400 font-headline fst-italic">Sunday</span>
                            <span class="text-xs fw-bold text-error text-uppercase tracking-widest">Closed</span>
                        </div>
                    </div>
                    <button class="btn btn-link w-100 mt-4 py-2 text-xs font-headline fw-bold text-secondary text-uppercase tracking-widest d-flex align-items-center justify-content-center gap-2 text-decoration-none shadow-none hover-text-secondary custom-active-scale">
                        <span class="material-symbols-outlined fs-6">edit_calendar</span>
                        Update Schedule
                    </button>
                </section>
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Bar -->
    <!-- <div id="bottomBar" class="position-fixed bottom-0 end-0 p-4 p-md-5 z-3 d-flex align-items-center justify-content-between w-100" style="left: auto; max-width: calc(100% - 256px);">
        <div class="d-flex align-items-center gap-3">
            <span class="material-symbols-outlined text-zinc-400 animate-pulse">sync</span>
            <p class="text-xs text-on-surface-variant fw-medium mb-0">All changes are saved locally until published</p>
        </div>
        <div class="d-flex gap-3">
            <button class="btn border border-secondary rounded-full text-sm font-headline fw-bold text-on-surface hover-bg-surface-low transition custom-active-scale" style="padding: 0.75rem 2rem;">
                Discard
            </button>
            <button class="btn border-0 rounded-full signature-glow text-on-primary text-sm font-headline fw-bold shadow-sm custom-active-scale" style="padding: 0.75rem 2.5rem;">
                Save Changes
            </button>
        </div>
    </div> -->
@endsection
