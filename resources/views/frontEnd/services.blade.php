@extends('frontEnd.layouts.app')

@section('content')
<main class="services-main container">
        <!-- Hero Section -->
        <header class="services-header">
            <h1 class="services-title">
                Holistic Care for <br><span class="text-primary text-glow">Radiant Companions</span>
            </h1>
            <p class="services-subtitle">
                Experience a sanctuary of wellness where professional expertise meets heartfelt compassion. From nutritional mastery to aesthetic grooming, we nurture every facet of your pet's life.
            </p>
        </header>

        <div class="services-layout">
            <!-- Sidebar Filters -->
            <aside class="sidebar" id="filterSidebar">
                <div class="sidebar-sticky">
                    <div class="categories-box">
                        <h3 class="sidebar-title">Categories</h3>
                        <nav class="category-nav">
                            <button class="cat-btn active group">
                                <span class="cat-icon-text">
                                    <span class="material-symbols-outlined filled">grid_view</span>All Services
                                </span>
                                <span class="cat-count">12</span>
                            </button>
                            <button class="cat-btn group">
                                <span class="cat-icon-text">
                                    <span class="material-symbols-outlined">content_cut</span>Grooming
                                </span>
                            </button>
                            <button class="cat-btn group">
                                <span class="cat-icon-text">
                                    <span class="material-symbols-outlined">restaurant</span>Nutrition
                                </span>
                            </button>
                            <button class="cat-btn group">
                                <span class="cat-icon-text">
                                    <span class="material-symbols-outlined">school</span>Training
                                </span>
                            </button>
                            <button class="cat-btn group">
                                <span class="cat-icon-text">
                                    <span class="material-symbols-outlined">medical_services</span>Health Check
                                </span>
                            </button>
                        </nav>
                    </div>

                    <div class="member-benefit">
                        <span class="material-symbols-outlined text-secondary">auto_awesome</span>
                        <h4 class="benefit-title">Member Benefit</h4>
                        <p class="benefit-text">Radiant Members get 15% off all grooming services and early access to workshops.</p>
                        <button class="benefit-link">Learn more</button>
                    </div>
                </div>
            </aside>

            <button class="filter-toggle" id="openFilter">
                <span class="material-symbols-outlined">tune</span>
            </button>

            <!-- Services Grid -->
            <div class="services-grid-wrapper">
                <div class="services-grid">
                    <!-- Card 1 -->
                    <div class="service-card glass-card">
                        <div class="service-img-wrap">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxxydHdSw2ByX6oXXpTao2b15VSDMTaYLYMlHU_ZgIPDcrFo6dPW3bIp5g-aRXqvrHQxq2WP7bOVsXl_U-VLTej5--1DWR3eEDDNchnJWlzQ_gaXVgexhOA22Mj5zqgOdtXqCaRD--70z7bVeMxxYCwVI9ICoZwuY6VjiVZrnl6acO4PHECMmlTd7NZblx3dqorUE7kI1AewyPGR9v1_2O99-iDeFOS-BaNNC-zKuGVVrW0FzJ5q-h33Inx9S9EcfxStKEHVJnUYIn" alt="Grooming">
                            <div class="bestseller-badge">BESTSELLER</div>
                        </div>
                        <div class="service-content">
                            <div class="service-header-row">
                                <h3 class="service-name">Signature Grooming</h3>
                                <span class="service-price">$85+</span>
                            </div>
                            <p class="service-desc">A comprehensive 7-point spa treatment including therapeutic bath, precision styling, and botanical conditioning.</p>
                            <div class="service-footer">
                                <div class="service-meta">
                                    <span class="material-symbols-outlined">schedule</span> 90-120 mins
                                </div>
                                <button class="btn-book signature-glow">Book Now</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="service-card glass-card">
                        <div class="service-img-wrap">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrj5N4qNu1UZ4SRqLOftMZs1AJi9sAUr_BhT9UFhMmdjPoXR4LrFCSWiqvIPUaFBc9bxX5HSnoMHzxkjeTTdAdJ152QXUm5B6jggw_eLZ00m_D6Sn2kIpISY6E1ybSwEnVc8Z_UMQsw-xmNVdKKOtCkN33LcMD2XYhxNBUIdM25M0XuRiiCTFbDlHO3FZQ2UpN5C8EtbDVKaebIF3OMhgGcpb6hk_GZdj947t-t_2h7Sv3SF99d9yVwc8nliTD7roVpWLRmA_WBeP6" alt="Nutrition Consult">
                        </div>
                        <div class="service-content">
                            <div class="service-header-row">
                                <h3 class="service-name">Nutrition Consult</h3>
                                <span class="service-price text-primary">$120</span>
                            </div>
                            <p class="service-desc">Expert dietary analysis and custom meal planning for optimal energy, coat health, and long-term vitality.</p>
                            <div class="service-footer">
                                <div class="service-meta">
                                    <span class="material-symbols-outlined">person</span> Expert Specialist
                                </div>
                                <button class="btn-book signature-glow">Book Now</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="service-card glass-card">
                        <div class="service-img-wrap">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHV_iTll4k-xuJ_uZy1k0IIugHDRRWHeTwz6JdtLh4z-WT0MSSrc3FNTtxSb6x3oX5fDZz3ox1Cpkxyqeu-wCn9amJ1yGjXkdgNrfGRoqusVYGShyQ5pl6E1FTK75cbkzgS36GP5hv_6-ZWBBf1P4Jru6L65nQuVGPqyBjoMlv--8xCF_x2IgWIfTe2tNTcNVtLqOtbxXBPlRT-MaXHzMmuuk2aW-FxQpSqE9TjEcsLGlbtuL73SG5SiKcxyU5f9OdMxKqSo3z_5GC" alt="Behavior Mastery">
                        </div>
                        <div class="service-content">
                            <div class="service-header-row">
                                <h3 class="service-name">Behavior Mastery</h3>
                                <span class="service-price text-primary">$95</span>
                            </div>
                            <p class="service-desc">Positive reinforcement training focused on communication, socialization, and strengthening the bond with your companion.</p>
                            <div class="service-footer">
                                <div class="service-meta">
                                    <span class="material-symbols-outlined">location_on</span> In-Park Session
                                </div>
                                <button class="btn-book signature-glow">Book Now</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="service-card glass-card">
                        <div class="service-img-wrap">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHQSv-ArMcgkFDVh4MJ84FbOHukn6UuVC589eVttS_044GCSKu4qR9YTOpId95yJCTrtAN-n1Y8hm7P5w8Oh3RIHi24L-_7hoIQFU8Ysx0lwQ5-C-Zfow1nM9wuaSbAJabKw7PVAZG17uC3YWNQkCaGDuQgu8yRzAmOSOeUrGbRtEOe6GpH2pw5cd_z22XOEvIC_D56lfsnp2jnn18y6SeNgxKJ40LFO6ENYbWug1DlwcCuPbW34IoASNVvR1PQykcI_oXOL2nmEbi" alt="Dental Wellness">
                        </div>
                        <div class="service-content">
                            <div class="service-header-row">
                                <h3 class="service-name">Dental Wellness</h3>
                                <span class="service-price text-primary">$65</span>
                            </div>
                            <p class="service-desc">Gentle non-anesthetic dental cleaning and plaque prevention using medical-grade ultrasound technology.</p>
                            <div class="service-footer">
                                <div class="service-meta">
                                    <span class="material-symbols-outlined">verified</span> Certified Hygienist
                                </div>
                                <button class="btn-book signature-glow">Book Now</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pagination-wrapper">
                    <button class="btn-load-more">
                        View All Services
                        <span class="material-symbols-outlined">expand_more</span>
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
    const openFilter = document.getElementById('openFilter');
    const filterSidebar = document.getElementById('filterSidebar');

    // Toggle sidebar
    openFilter.addEventListener('click', (e) => {
        e.stopPropagation(); // prevent immediate close
        filterSidebar.classList.toggle('active');
    });

    // Prevent clicks inside sidebar from closing it
    filterSidebar.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Click outside → close
    document.addEventListener('click', () => {
        filterSidebar.classList.remove('active');
    });
</script>
@endpush
