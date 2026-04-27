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
                <!-- <button
                        class="btn bg-secondary-container text-on-secondary-container rounded-full fw-bold text-sm d-flex align-items-center gap-2 border hover-bg-secondary-fixed transition custom-active-scale px-4 py-2">
                        <span class="material-symbols-outlined fs-5">filter_list</span>
                        Advanced Filters
                    </button> -->
                <button
                    class="btn bg-primary text-on-primary rounded-full fw-bold text-sm d-flex align-items-center gap-2 hover-bg-primary-dim transition custom-active-scale border-0 shadow-sm px-4 py-2"
                    data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                    <span class="material-symbols-outlined fs-5">person_add</span>
                    Add New Company
                </button>
            </div>
        </div>

        <!-- Settings Bento Grid -->
        <div class="row g-4 align-items-start mt-2">

            <!-- Left Column: Recent Appointments & Sidebar widgets -->
            <div class="col-12 col-md-12 d-flex flex-column gap-8">
                <!-- Recent Appointments Table -->
                <div class="glass-card rounded-lg overflow-hidden d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center p-4 p-md-4 pb-3">
                        <h4 class="fs-5 font-headline fw-bold tracking-tight mb-0">Company List</h4>
                        <select name="status_filter" id="statusFilter"
                            class="form-select form-select-sm border-0 shadow-none bg-surface-container-low text-xs fw-bold text-primary rounded-full px-3 py-1 custom-focus-ring"
                            style="width: 130px; cursor: pointer;">
                            <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="1" {{ request('status', '1') === '1' ? 'selected' : '' }}
                                class="text-primary">Active</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }} class="text-zinc-500">
                                Inactive</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless table-divider text-start mb-0"
                            style="max-height: 50px; overflow-y: auto;">
                            <thead
                                class="bg-surface-container-low text-on-surface-variant font-label text-10px tracking-widest text-uppercase">
                                <tr>
                                    <th class="py-3 px-4 px-lg-5">Company</th>
                                    <th class="py-3 px-4 px-lg-5">Email</th>
                                    <th class="py-3 px-3 px-lg-4">Number</th>
                                    <th class="py-3 px-3 px-lg-4">Service</th>
                                    <th class="py-3 px-3 px-lg-4">Status</th>
                                    <th class="py-3 px-4 px-lg-5 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <!-- Static Samples from original design -->
                                    <tr class="hover-bg-surface-lowest group">
                                        <td class="py-3 px-4 px-lg-5 align-middle">
                                            <div class="d-flex align-items-center gap-3">
                                                <img alt="Pet Avatar" class="w-10 h-10 rounded-circle object-fit-cover"
                                                    src="{{ asset($company->brand_logo) }}" />
                                                <span class="fw-bold text-on-surface">{{ $company->company_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle text-sm">{{ $company->email }}</td>
                                        <td class="py-3 px-3 px-lg-4 align-middle text-sm">
                                            {{ $company->phone1 }}

                                            @if ($company->phone2)
                                                <br>{{ $company->phone2 }}
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle">
                                            @php
                                                $serviceIds = json_decode($company->services, true);
                                            @endphp

                                            @if ($serviceIds)
                                                @foreach ($serviceIds as $id)
                                                    <span
                                                        class="px-3 py-1 bg-tertiary-container-30 text-on-tertiary-container rounded-full text-10px fw-bold tracking-wider text-uppercase d-block mb-1">
                                                        {{ $services[$id] ?? 'N/A' }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 px-lg-4 align-middle">
                                            <div class="d-flex align-items-center gap-2 text-primary">
                                                <span
                                                    class="w-2 h-2 rounded-full bg-primary animate-pulse d-inline-block"></span>
                                                <span
                                                    class="text-xs fw-bold">{{ $company->status == 1 ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 px-lg-5 align-middle text-end">

                                            <!-- View (Eye) -->
                                            <button
                                                class="btn btn-link p-1 text-stone-400 hover-text-primary text-decoration-none shadow-none"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewCompanyModal{{ $company->id }}">
                                                <span class="material-symbols-outlined fs-5">visibility</span>
                                            </button>

                                            <!-- Edit -->
                                            <button
                                                class="btn btn-link p-1 text-stone-400 hover-text-secondary text-decoration-none shadow-none"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editCompanyModal{{ $company->id }}">
                                                <span class="material-symbols-outlined fs-5">edit</span>
                                            </button>

                                            <!-- Delete -->
                                            <button
                                                class="btn btn-link p-1 text-stone-400 hover-text-error text-decoration-none shadow-none delete-company-btn"
                                                data-id="{{ $company->id }}">
                                                <span class="material-symbols-outlined fs-5">delete</span>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-4 py-3">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>


            </div>

            <!-- Bottom Row: Popular Services & Operating Hours (Side by Side) -->
            <div class="col-12 mt-4">
                <div class="row g-4 align-items-stretch">
                    <!-- Popular Services Column -->
                    <div class="col-12 col-md-6 d-flex flex-column">
                        <div class="glass-card p-4 p-md-5 rounded-lg flex-grow-1">
                            <h4 class="fs-5 font-headline fw-bold tracking-tight mb-4">Popular Services</h4>
                            <div class="d-flex flex-column gap-4"
                                style="max-height: 250px; overflow-y: auto; overflow-x: hidden;">
                                @php
                                    $totalCompanies = \App\Models\Company::count();
                                @endphp
                                @foreach ($categories as $category)
                                    @php
                                        $count = $serviceCounts[$category->id] ?? 0;
                                        $percentage = $totalCompanies > 0 ? ($count / $totalCompanies) * 100 : 0;
                                    @endphp
                                    <div class="position-relative pt-1 pe-2">
                                        <div class="d-flex mb-2 align-items-center justify-content-between">
                                            <div><span
                                                    class="text-xs fw-bold font-label text-uppercase tracking-wider">{{ $category->name }}</span>
                                            </div>
                                            <div class="text-end"><span
                                                    class="text-xs fw-bold text-primary">{{ $count }}
                                                    {{ Str::plural('Company', $count) }}</span></div>
                                        </div>
                                        <div class="overflow-hidden mb-3 rounded-full bg-surface-container"
                                            style="height: 0.5rem;">
                                            <div class="h-100 bg-primary signature-glow"
                                                style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Operating Hours Column -->
                    <div class="col-12 col-md-6 d-flex flex-column">
                        <section class="glass-card rounded-lg p-4 p-md-5 overflow-hidden flex-grow-1">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span class="material-symbols-outlined text-primary fs-4">schedule</span>
                                <h3 class="font-headline fw-bold fs-5 mb-0">Operating Hours</h3>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <!-- Monday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                                    <span class="text-sm fw-bold text-zinc-600 font-headline">Monday</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00
                                            AM</span>
                                        <span class="text-zinc-300">—</span>
                                        <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00
                                            PM</span>
                                    </div>
                                </div>
                                <!-- Tuesday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                                    <span class="text-sm fw-bold text-zinc-600 font-headline">Tuesday</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00
                                            AM</span>
                                        <span class="text-zinc-300">—</span>
                                        <span class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00
                                            PM</span>
                                    </div>
                                </div>
                                <!-- Wednesday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                                    <span class="text-sm fw-bold text-zinc-600 font-headline">Wednesday</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00
                                            AM</span>
                                        <span class="text-zinc-300">—</span>
                                        <span
                                            class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00
                                            PM</span>
                                    </div>
                                </div>
                                <!-- Thursday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                                    <span class="text-sm fw-bold text-zinc-600 font-headline">Thursday</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00
                                            AM</span>
                                        <span class="text-zinc-300">—</span>
                                        <span
                                            class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">07:00
                                            PM</span>
                                    </div>
                                </div>
                                <!-- Friday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                                    <span class="text-sm fw-bold text-zinc-600 font-headline">Friday</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">08:00
                                            AM</span>
                                        <span class="text-zinc-300">—</span>
                                        <span
                                            class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">09:00
                                            PM</span>
                                    </div>
                                </div>
                                <!-- Saturday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl bg-orange-50-30">
                                    <span class="text-sm fw-bold text-primary font-headline">Saturday</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-xs bg-secondary-10 text-secondary px-2 py-1 rounded-2xl fw-bold">10:00
                                            AM</span>
                                        <span class="text-zinc-300">—</span>
                                        <span
                                            class="text-xs bg-primary-10 text-primary px-2 py-1 rounded-2xl fw-bold">06:00
                                            PM</span>
                                    </div>
                                </div>
                                <!-- Sunday -->
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 px-3 rounded-2xl hover-bg-surface-low transition">
                                    <span class="text-sm fw-bold text-zinc-400 font-headline fst-italic">Sunday</span>
                                    <span class="text-xs fw-bold text-error text-uppercase tracking-widest">Closed</span>
                                </div>
                            </div>
                            <button
                                class="btn btn-link w-100 mt-4 py-2 text-xs font-headline fw-bold text-secondary text-uppercase tracking-widest d-flex align-items-center justify-content-center gap-2 text-decoration-none shadow-none hover-text-secondary custom-active-scale">
                                <span class="material-symbols-outlined fs-6">edit_calendar</span>
                                Update Schedule
                            </button>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Add New Company Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card border-0 rounded-xl overflow-hidden shadow-lg">
                <div class="modal-header border-bottom border-secondary-10 px-4 py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-10 d-flex align-items-center justify-content-center text-primary">
                            <span class="material-symbols-outlined fs-5">domain_add</span>
                        </div>
                        <h5 class="modal-title font-headline fw-bold text-on-surface mb-0" id="addCompanyModalLabel">Add
                            New Company</h5>
                    </div>
                </div>
                <div class="modal-body px-4 py-4">
                    <form id="addCompanyForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Top Row: File Uploads -->
                        <div class="row g-4 mb-4">
                            <!-- Logo Upload -->
                            <div class="col-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Company
                                    Logo</label>
                                <input type="file" id="companyLogo" name="brand_logo" class="d-none"
                                    accept="image/*">
                                <div id="uploadLogoWrapper"
                                    class="w-100 rounded-2xl border border-secondary-10 d-flex flex-column align-items-center justify-content-center bg-surface-container-low hover-border-primary transition position-relative overflow-hidden"
                                    style="height: 120px; border-style: dashed !important; border-width: 2px !important; cursor: pointer;">
                                    <img id="logoPreview" src="" alt="Preview"
                                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0 d-none">
                                    <div id="logoPlaceholder"
                                        class="text-center position-relative z-1 transition bg-white bg-opacity-75 rounded px-2">
                                        <span class="material-symbols-outlined text-primary fs-1 mb-1">domain</span>
                                        <p
                                            class="text-[10px] fw-bold text-on-surface-variant mb-0 font-label text-uppercase tracking-widest">
                                            Upload Logo</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Business Card Upload -->
                            <div class="col-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Business
                                    Card</label>
                                <input type="file" id="businessCard" name="business_card" class="d-none"
                                    accept="image/*">
                                <div id="uploadCardWrapper"
                                    class="w-100 rounded-2xl border border-secondary-10 d-flex flex-column align-items-center justify-content-center bg-surface-container-low hover-border-primary transition position-relative overflow-hidden"
                                    style="height: 120px; border-style: dashed !important; border-width: 2px !important; cursor: pointer;">
                                    <img id="cardPreview" src="" alt="Preview"
                                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0 d-none">
                                    <div id="cardPlaceholder"
                                        class="text-center position-relative z-1 transition bg-white bg-opacity-75 rounded px-2">
                                        <span class="material-symbols-outlined text-secondary fs-1 mb-1">badge</span>
                                        <p
                                            class="text-[10px] fw-bold text-on-surface-variant mb-0 font-label text-uppercase tracking-widest">
                                            Upload Card</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Company Name & Email -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Company
                                    Name <span class="text-danger">*</span></label>
                                <input type="text" name="company_name"
                                    class="form-control bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring"
                                    placeholder="Radiant Habitat" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Email
                                    Address <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring"
                                    placeholder="hello@domain.com" required>
                            </div>
                        </div>

                        <!-- Phone Numbers -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Phone
                                    1 <span class="text-danger">*</span></label>
                                <input type="text" name="phone1"
                                    class="form-control bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring"
                                    placeholder="+1 (555) 000-0000" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Phone
                                    2 (Optional)</label>
                                <input type="text" name="phone2"
                                    class="form-control bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring"
                                    placeholder="+1 (555) 000-0000">
                            </div>
                        </div>

                        <!-- Address & Location -->
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Address</label>
                                <input type="text" name="address"
                                    class="form-control bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring"
                                    placeholder="Street Address">
                            </div>
                            <div class="col-12 col-md-6">
                                <label
                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Location/City</label>
                                <input type="text" name="location"
                                    class="form-control bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring"
                                    placeholder="E.g. New York">
                            </div>
                        </div>

                        <!-- Service -->
                        <div class="mb-4">
                            <label
                                class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Service</label>
                            <select name="services[]" multiple
                                class="form-select bg-surface-container-low border-0 rounded-2xl px-4 py-3 text-sm font-body custom-focus-ring text-on-surface select2"
                                style="cursor: pointer; min-height: 120px;">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-xs text-zinc-500 mt-2 ms-2">Hold Ctrl (or Cmd) to select multiple services.
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-2">
                            <label
                                class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">Status</label>
                            <div class="d-flex gap-3">
                                <div
                                    class="form-check custom-radio flex-grow-1 bg-surface-container-low rounded-2xl px-4 py-3 d-flex align-items-center gap-2 border border-transparent transition">
                                    <input class="form-check-input mt-0 shadow-none border-secondary" type="radio"
                                        name="status" id="statusActive" value="1" checked>
                                    <label
                                        class="form-check-label text-sm fw-bold mb-0 text-primary w-100 cursor-pointer font-headline"
                                        for="statusActive">
                                        Active
                                    </label>
                                </div>
                                <div
                                    class="form-check custom-radio flex-grow-1 bg-surface-container-low rounded-2xl px-4 py-3 d-flex align-items-center gap-2 border border-transparent transition">
                                    <input class="form-check-input mt-0 shadow-none border-zinc-400" type="radio"
                                        name="status" id="statusInactive" value="0">
                                    <label
                                        class="form-check-label text-sm fw-bold mb-0 text-zinc-500 w-100 cursor-pointer font-headline"
                                        for="statusInactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top border-secondary-10 px-4 py-3 bg-surface-container-lowest">
                    <button type="button"
                        class="btn border border-secondary rounded-full text-sm font-headline fw-bold text-on-surface hover-bg-surface-low transition custom-active-scale px-4 py-2"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addCompanyForm" id="saveCompanyBtn"
                        class="btn border-0 rounded-full signature-glow text-on-primary text-sm font-headline fw-bold shadow-sm custom-active-scale px-4 py-2">Create
                        Company</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Company Modals -->
    @foreach ($companies as $company)
        <div class="modal fade" id="viewCompanyModal{{ $company->id }}" tabindex="-1"
            aria-labelledby="viewCompanyModalLabel{{ $company->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content glass-card border-0 rounded-xl overflow-hidden shadow-lg">
                    <div class="modal-header border-bottom border-secondary-10 px-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-primary-10 d-flex align-items-center justify-content-center text-primary">
                                <span class="material-symbols-outlined fs-5">storefront</span>
                            </div>
                            <h5 class="modal-title font-headline fw-bold text-on-surface mb-0"
                                id="viewCompanyModalLabel{{ $company->id }}">{{ $company->company_name }} Details</h5>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 py-4">
                        <div class="row g-4">
                            <!-- Left Column: Logos & Status -->
                            <div class="col-12 col-md-5 d-flex flex-column gap-4">
                                <div class="glass-card p-3 rounded-2xl border border-secondary-10 text-center">
                                    <p
                                        class="text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                        Company Logo</p>
                                    @if ($company->brand_logo)
                                        <img src="{{ asset($company->brand_logo) }}" alt="Logo"
                                            class="img-fluid rounded-xl object-fit-cover shadow-sm mx-auto"
                                            style="max-height: 150px;">
                                    @else
                                        <div class="w-100 rounded-xl bg-surface-container-low d-flex align-items-center justify-content-center text-zinc-400"
                                            style="height: 150px;">
                                            <span class="material-symbols-outlined fs-1">image_not_supported</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="glass-card p-3 rounded-2xl border border-secondary-10 text-center">
                                    <p
                                        class="text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                        Business Card</p>
                                    @if ($company->business_card)
                                        <img src="{{ asset($company->business_card) }}" alt="Business Card"
                                            class="img-fluid rounded-xl object-fit-cover shadow-sm mx-auto"
                                            style="max-height: 150px;">
                                    @else
                                        <div class="w-100 rounded-xl bg-surface-container-low d-flex align-items-center justify-content-center text-zinc-400"
                                            style="height: 150px;">
                                            <span class="material-symbols-outlined fs-1">credit_card_off</span>
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="d-flex align-items-center justify-content-between p-3 rounded-2xl {{ $company->status == 1 ? 'bg-primary-10' : 'bg-surface-container-low border border-secondary-10' }}">
                                    <span
                                        class="text-sm font-headline fw-bold {{ $company->status == 1 ? 'text-primary' : 'text-zinc-500' }}">Status</span>
                                    <div
                                        class="d-flex align-items-center gap-2 {{ $company->status == 1 ? 'text-primary' : 'text-zinc-500' }}">
                                        @if ($company->status == 1)
                                            <span
                                                class="w-2 h-2 rounded-full bg-primary animate-pulse d-inline-block"></span>
                                        @else
                                            <span class="w-2 h-2 rounded-full bg-zinc-500 d-inline-block"></span>
                                        @endif
                                        <span
                                            class="text-xs fw-bold text-uppercase tracking-widest">{{ $company->status == 1 ? 'Active' : 'Inactive' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Details -->
                            <div class="col-12 col-md-7 d-flex flex-column gap-3">
                                <div class="glass-card p-4 rounded-2xl border border-secondary-10 h-100">
                                    <h6
                                        class="font-headline fw-bold text-on-surface mb-4 border-bottom border-secondary-10 pb-2">
                                        Contact Information</h6>

                                    <div class="row g-3 mb-4">
                                        <div class="col-12">
                                            <span
                                                class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Company
                                                Name</span>
                                            <p class="text-sm font-body text-on-surface mb-0 fw-bold">
                                                {{ $company->company_name }}</p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <span
                                                class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Email
                                                Address</span>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="material-symbols-outlined fs-6 text-zinc-400">mail</span>
                                                <p class="text-sm font-body text-on-surface mb-0"><a
                                                        href="mailto:{{ $company->email }}"
                                                        class="text-decoration-none text-primary hover-text-primary-dim">{{ $company->email }}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <span
                                                class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Phone
                                                1</span>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="material-symbols-outlined fs-6 text-zinc-400">call</span>
                                                <p class="text-sm font-body text-on-surface mb-0">
                                                    {{ $company->phone1 }}</p>
                                            </div>
                                        </div>
                                        @if ($company->phone2)
                                            <div class="col-12 col-md-6">
                                                <span
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Phone
                                                    2</span>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="material-symbols-outlined fs-6 text-zinc-400">call</span>
                                                    <p class="text-sm font-body text-on-surface mb-0">
                                                        {{ $company->phone2 }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($company->location)
                                            <div class="col-12 col-md-6">
                                                <span
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Location/City</span>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined fs-6 text-zinc-400">location_city</span>
                                                    <p class="text-sm font-body text-on-surface mb-0">
                                                        {{ $company->location }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($company->address)
                                            <div class="col-12">
                                                <span
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Address</span>
                                                <div class="d-flex align-items-start gap-2">
                                                    <span
                                                        class="material-symbols-outlined fs-6 text-zinc-400 mt-1">map</span>
                                                    <p class="text-sm font-body text-on-surface mb-0">
                                                        {{ $company->address }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <h6
                                        class="font-headline fw-bold text-on-surface mb-3 border-bottom border-secondary-10 pb-2">
                                        Offered Services</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @php
                                            $serviceIds = json_decode($company->services, true);
                                        @endphp
                                        @if ($serviceIds && count($serviceIds) > 0)
                                            @foreach ($serviceIds as $id)
                                                <span
                                                    class="px-3 py-1 bg-tertiary-container-30 text-on-tertiary-container border border-tertiary-container-50 rounded-full text-xs fw-bold tracking-wider text-uppercase">
                                                    {{ $services[$id] ?? 'N/A' }}
                                                </span>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-zinc-400 font-body fst-italic mb-0">No services
                                                assigned.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-secondary-10 px-4 py-3 bg-surface-container-lowest">
                        <button type="button"
                            class="btn border border-secondary rounded-full text-sm font-headline fw-bold text-on-surface hover-bg-surface-low transition custom-active-scale px-4 py-2"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Company Modal -->
        <div class="modal fade" id="editCompanyModal{{ $company->id }}" tabindex="-1"
            aria-labelledby="editCompanyModalLabel{{ $company->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content glass-card border-0 rounded-xl overflow-hidden shadow-lg">
                    <div class="modal-header border-bottom border-secondary-10 px-4 py-3">
                        <div class="d-flex align-items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-secondary-10 d-flex align-items-center justify-content-center text-secondary">
                                <span class="material-symbols-outlined fs-5">edit_square</span>
                            </div>
                            <h5 class="modal-title font-headline fw-bold text-on-surface mb-0"
                                id="editCompanyModalLabel{{ $company->id }}">Edit {{ $company->company_name }}</h5>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 py-4">
                        <form id="editCompanyForm{{ $company->id }}" class="edit-company-form"
                            enctype="multipart/form-data" data-id="{{ $company->id }}">
                            @csrf
                            <input type="hidden" name="company_id" value="{{ $company->id }}">

                            <div class="row g-4">
                                <!-- Left Column: Logos & Status -->
                                <div class="col-12 col-md-5 d-flex flex-column gap-4">
                                    <div
                                        class="glass-card p-3 rounded-2xl border border-secondary-10 text-center position-relative">
                                        <p
                                            class="text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                            Company Logo</p>
                                        <input type="file" id="editCompanyLogo{{ $company->id }}" name="brand_logo"
                                            class="d-none edit-logo-input" accept="image/*"
                                            data-id="{{ $company->id }}">
                                        <div id="editUploadLogoWrapper{{ $company->id }}"
                                            class="w-100 rounded-xl bg-surface-container-low d-flex align-items-center justify-content-center hover-border-primary transition overflow-hidden edit-upload-logo-wrapper"
                                            style="height: 150px; border: 2px dashed var(--secondary-10) !important; cursor: pointer;"
                                            data-id="{{ $company->id }}">
                                            <img id="editLogoPreview{{ $company->id }}"
                                                src="{{ $company->brand_logo ? asset($company->brand_logo) : '' }}"
                                                alt="Preview"
                                                class="w-100 h-100 object-fit-cover {{ $company->brand_logo ? '' : 'd-none' }}">
                                            <div id="editLogoPlaceholder{{ $company->id }}"
                                                class="text-center position-relative z-1 transition bg-white bg-opacity-75 rounded px-2 {{ $company->brand_logo ? 'd-none' : '' }}">
                                                <span class="material-symbols-outlined text-primary fs-1 mb-1">image</span>
                                                <p
                                                    class="text-[10px] fw-bold text-on-surface-variant mb-0 font-label text-uppercase tracking-widest">
                                                    Change Logo</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="glass-card p-3 rounded-2xl border border-secondary-10 text-center position-relative">
                                        <p
                                            class="text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                            Business Card</p>
                                        <input type="file" id="editBusinessCard{{ $company->id }}"
                                            name="business_card" class="d-none edit-card-input" accept="image/*"
                                            data-id="{{ $company->id }}">
                                        <div id="editUploadCardWrapper{{ $company->id }}"
                                            class="w-100 rounded-xl bg-surface-container-low d-flex align-items-center justify-content-center hover-border-primary transition overflow-hidden edit-upload-card-wrapper"
                                            style="height: 150px; border: 2px dashed var(--secondary-10) !important; cursor: pointer;"
                                            data-id="{{ $company->id }}">
                                            <img id="editCardPreview{{ $company->id }}"
                                                src="{{ $company->business_card ? asset($company->business_card) : '' }}"
                                                alt="Preview"
                                                class="w-100 h-100 object-fit-cover {{ $company->business_card ? '' : 'd-none' }}">
                                            <div id="editCardPlaceholder{{ $company->id }}"
                                                class="text-center position-relative z-1 transition bg-white bg-opacity-75 rounded px-2 {{ $company->business_card ? 'd-none' : '' }}">
                                                <span
                                                    class="material-symbols-outlined text-secondary fs-1 mb-1">credit_card</span>
                                                <p
                                                    class="text-[10px] fw-bold text-on-surface-variant mb-0 font-label text-uppercase tracking-widest">
                                                    Change Card</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-3 rounded-2xl bg-surface-container-low border border-secondary-10">
                                        <p
                                            class="text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-2">
                                            Status</p>
                                        <div class="d-flex gap-2">
                                            <div
                                                class="form-check custom-radio flex-grow-1 bg-surface-container rounded-xl px-3 py-2 d-flex align-items-center gap-2 border border-transparent transition">
                                                <input class="form-check-input mt-0 shadow-none border-secondary"
                                                    type="radio" name="status"
                                                    id="editStatusActive{{ $company->id }}" value="1"
                                                    {{ $company->status == 1 ? 'checked' : '' }}>
                                                <label
                                                    class="form-check-label text-sm fw-bold mb-0 text-primary w-100 cursor-pointer font-headline"
                                                    for="editStatusActive{{ $company->id }}">Active</label>
                                            </div>
                                            <div
                                                class="form-check custom-radio flex-grow-1 bg-surface-container rounded-xl px-3 py-2 d-flex align-items-center gap-2 border border-transparent transition">
                                                <input class="form-check-input mt-0 shadow-none border-zinc-400"
                                                    type="radio" name="status"
                                                    id="editStatusInactive{{ $company->id }}" value="0"
                                                    {{ $company->status == 0 ? 'checked' : '' }}>
                                                <label
                                                    class="form-check-label text-sm fw-bold mb-0 text-zinc-500 w-100 cursor-pointer font-headline"
                                                    for="editStatusInactive{{ $company->id }}">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Details -->
                                <div class="col-12 col-md-7 d-flex flex-column gap-3">
                                    <div class="glass-card p-4 rounded-2xl border border-secondary-10 h-100">
                                        <h6
                                            class="font-headline fw-bold text-on-surface mb-4 border-bottom border-secondary-10 pb-2">
                                            Contact Information</h6>

                                        <div class="row g-3 mb-4">
                                            <div class="col-12">
                                                <label
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Company
                                                    Name <span class="text-danger">*</span></label>
                                                <input type="text" name="company_name"
                                                    class="form-control bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring"
                                                    value="{{ $company->company_name }}" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Email
                                                    Address <span class="text-danger">*</span></label>
                                                <input type="email" name="email"
                                                    class="form-control bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring"
                                                    value="{{ $company->email }}" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Phone
                                                    1 <span class="text-danger">*</span></label>
                                                <input type="text" name="phone1"
                                                    class="form-control bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring"
                                                    value="{{ $company->phone1 }}" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Phone
                                                    2</label>
                                                <input type="text" name="phone2"
                                                    class="form-control bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring"
                                                    value="{{ $company->phone2 }}">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Location/City</label>
                                                <input type="text" name="location"
                                                    class="form-control bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring"
                                                    value="{{ $company->location }}">
                                            </div>
                                            <div class="col-12">
                                                <label
                                                    class="d-block text-xs font-headline fw-bold text-zinc-500 text-uppercase tracking-wider mb-1">Address</label>
                                                <input type="text" name="address"
                                                    class="form-control bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring"
                                                    value="{{ $company->address }}">
                                            </div>
                                        </div>

                                        <h6
                                            class="font-headline fw-bold text-on-surface mb-3 border-bottom border-secondary-10 pb-2">
                                            Offered Services</h6>
                                        <div>
                                            <select name="services[]" multiple
                                                class="form-select bg-surface-container-low border-0 rounded-xl px-3 py-2 text-sm font-body custom-focus-ring text-on-surface select2"
                                                style="cursor: pointer; min-height: 100px;">
                                                @php
                                                    $serviceIds = json_decode($company->services, true) ?? [];
                                                @endphp
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, $serviceIds) ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-xs text-zinc-500 mt-1 ms-2">Hold Ctrl (or Cmd) to select
                                                multiple.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-top border-secondary-10 px-4 py-3 bg-surface-container-lowest">
                        <button type="button"
                            class="btn border border-secondary rounded-full text-sm font-headline fw-bold text-on-surface hover-bg-surface-low transition custom-active-scale px-4 py-2"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="editCompanyForm{{ $company->id }}"
                            class="btn border-0 rounded-full bg-secondary text-on-secondary text-sm font-headline fw-bold shadow-sm custom-active-scale px-4 py-2 save-edit-company-btn">Save
                            Changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        $(document).ready(function() {

            $(document).ready(function () {

                $('.modal').on('shown.bs.modal', function () {
                    let modal = $(this);

                    modal.find('.select2').each(function () {
                        if (!$(this).hasClass('select2-hidden-accessible')) {
                            $(this).select2({
                                dropdownParent: modal,
                                placeholder: "Select services",
                                width: '100%'
                            });
                        }
                    });
                });

            });

            // Trigger Logo input
            $('#uploadLogoWrapper').click(function() {
                $('#companyLogo').click();
            });

            // Live Preview: Logo
            $('#companyLogo').change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logoPreview').attr('src', e.target.result).removeClass('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#logoPreview').attr('src', '').addClass('d-none');
                }
            });

            // Trigger Business Card input
            $('#uploadCardWrapper').click(function() {
                $('#businessCard').click();
            });

            // Live Preview: Business Card
            $('#businessCard').change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#cardPreview').attr('src', e.target.result).removeClass('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#cardPreview').attr('src', '').addClass('d-none');
                }
            });

            // Handle AJAX Form Submission
            $('#addCompanyForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var submitBtn = $('#saveCompanyBtn');

                // Set loading state
                var originalText = submitBtn.text();
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('saveCompany') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#addCompanyModal').modal('hide');
                            toastr.success(response.message);
                            $('#addCompanyForm')[0].reset();
                            $('#logoPreview').attr('src', '').addClass('d-none');
                            $('#cardPreview').attr('src', '').addClass('d-none');

                            // Optional: Reload the page to catch up the new record in table
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error('Something went wrong, please try again.');
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An error occurred during submission.');
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });
            // Edit Image Previews
            $('.edit-upload-logo-wrapper').click(function() {
                var id = $(this).data('id');
                $('#editCompanyLogo' + id).click();
            });

            $('.edit-logo-input').change(function() {
                var id = $(this).data('id');
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#editLogoPreview' + id).attr('src', e.target.result).removeClass('d-none');
                        $('#editLogoPlaceholder' + id).addClass('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#editLogoPreview' + id).attr('src', '').addClass('d-none');
                    $('#editLogoPlaceholder' + id).removeClass('d-none');
                }
            });

            $('.edit-upload-card-wrapper').click(function() {
                var id = $(this).data('id');
                $('#editBusinessCard' + id).click();
            });

            $('.edit-card-input').change(function() {
                var id = $(this).data('id');
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#editCardPreview' + id).attr('src', e.target.result).removeClass('d-none');
                        $('#editCardPlaceholder' + id).addClass('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#editCardPreview' + id).attr('src', '').addClass('d-none');
                    $('#editCardPlaceholder' + id).removeClass('d-none');
                }
            });

            // Handle AJAX Edit Form Submission
            $('.edit-company-form').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = new FormData(this);
                var submitBtn = form.closest('.modal-content').find('.save-edit-company-btn');
                var modal = form.closest('.modal');

                // Set loading state
                var originalText = submitBtn.text();
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...'
                ).prop('disabled', true);

                $.ajax({
                    url: "{{ route('updateCompany') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            modal.modal('hide');
                            toastr.success(response.message);

                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error('Something went wrong, please try again.');
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error('An error occurred during submission.');
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });
            // Global Status Filter
            $('#statusFilter').change(function() {
                var status = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('status', status);
                // Reset to page 1 on filter change
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            // Delete Company
            $('.delete-company-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var deleteUrl = "{{ route('deleteCompany', ':id') }}".replace(':id', id);
                
                if (confirm('Are you sure you want to delete this company? This action cannot be undone.')) {
                    var btn = $(this);
                    btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                toastr.error(response.message);
                                btn.prop('disabled', false).html('<span class="material-symbols-outlined fs-5">delete</span>');
                            }
                        },
                        error: function(xhr) {
                            toastr.error('An error occurred while deleting the company.');
                            btn.prop('disabled', false).html('<span class="material-symbols-outlined fs-5">delete</span>');
                        }
                    });
                }
            });
        });
    </script>
@endsection
