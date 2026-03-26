@extends('frontEnd.layouts.app')

@section('content')
<main class="contact-main container pt-32 pb-20">
        <!-- Hero Section -->
        <section class="contact-hero grid-layout align-center mb-20">
            <div class="hero-text-content">
                <span class="section-badge text-primary">GET IN TOUCH</span>
                <h1 class="hero-title">
                    We'd Love to Hear From <span class="highlight-chip bg-primary text-on-primary">You and Your Pet</span>
                </h1>
                <p class="hero-subtitle">
                    Whether it's a question about our grooming services or just a friendly bark, our doors are always open to the Radiant Habitat community.
                </p>
                <div class="team-avatars-row">
                    <div class="avatar-group">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjJSwXqc4pNI36zBcjunHZ2-GkMAlpWSrs-2oGZ7kW3moTOH5aH6Ys5oAgwxULB7yP_XfLkK-IZDIYZ_4JAnKZxs547QAvnABC13DA2I2_nt7Mw1ne2hq_Q5k7EMA_ZWrMj70w2EKp5L1Zsd9LITrLxY5u669B4YAb7Pt46n7WPNlcc_nzKJQ2g1kFtyaXieo2Wu90Re46TASvvpQufOyXPKrOT4Y0GI1FNxIP_SIIz4GSrXax03ymdxBejxKbQeuiSLEaetjPAc9g" alt="Team member" class="avatar-img">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBF9YPjBntdAFBYX2Eu989bvVTEFGfG4NStPBRsYKZMOe9N2RJuOtXGi0VLIwJksOqkCEfIztnVKcjyJv7SU9rfnFu4tqsClBy3LoBtKso1CKoibonfXpyll7Yi84eMcfrQEkeKSQXaEJC5vTcX7yYvU3NPbwfYhybePugimxNWs-EAy6YqnTwr9WZXY26fH_6cfEhXyWnm1oLiu-zDgiRzQDMY984kAXAQauJDE4fIcHdd9nANgq8NK7MMeE1sLDlsOJ8mlMXWFHlK" alt="Team member" class="avatar-img">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGEiyCmobOsJzRepuQ_aSC3Uaa_K5J3LIhoQU0n21jueulkYYxcdLVJTFcVCn03r3UG2_Po17GRLFKpoajWJy4nKYK1S-8zxXq17u-JyQmSmkqhNDfHnXVQqCyzf_bVQkt0bOTZvdRTxkLaecpXJEtTK63Y5fDbjdi5AC1KjzJLk-a9eAj-rwvG0ashZ7oOs8yCL9Ayjx3roveA9Zd_LTyjHh7PEbUMre-cjhTQWAWZ2A02M8oYgg-m5eCz_8C5sTbW_YSYZ31x5gT" alt="Team member" class="avatar-img">
                    </div>
                    <p class="team-note">Our team is ready to assist you!</p>
                </div>
            </div>
            
            <div class="hero-image-wrapper">
                <div class="glow-circle top-right"></div>
                <div class="glow-circle bottom-left"></div>
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEa-BTiTs52M37pOoMg6VBqAyOsCeOpcfn7CkElGU530WEj3gmnK3J4vKdxagjtSIOdkd_O7pDHT4l1gGu99rny05xmiwX8Zn93QEMdbXLHhEmKxKKXzJ-yg6cGcWMSPsyvEGHXmJhEbCHLbuwF5pF_1IxCpWynDfwPKOwRtkFxhPZzs-aeK59z9DmLVcvtC0EDvVeqiQXRH_1hxhl-6S3bAfKFVSXBbQL_STiSSDFBaxbnUAvjplPBbJ1Luuj9tnYuFQBqA1loHiK" alt="Dog in living room" class="hero-img-main">
                
                <div class="glass-card floating-card">
                    <div class="card-header">
                        <span class="material-symbols-outlined text-primary filled">verified</span>
                        <span class="card-title">Trusted Experts</span>
                    </div>
                    <p class="card-text">Certified pet care professionals dedicated to your pet's happiness and health.</p>
                </div>
            </div>
        </section>

        <!-- Contact Content Grid -->
        <section class="contact-grid">
            <!-- Left Side: Contact Form -->
            <div class="glass-card form-container">
                <h2 class="form-title">Send a Message</h2>
                <form class="contact-form">
                    <div class="input-row">
                        <div class="input-group">
                            <label>Full Name</label>
                            <input type="text" placeholder="John Doe">
                        </div>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="email" placeholder="john@example.com">
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Service of Interest</label>
                        <select>
                            <option>Grooming & Spa</option>
                            <option>Nutritional Counseling</option>
                            <option>Pet Boarding</option>
                            <option>Other Inquiries</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Message</label>
                        <textarea placeholder="How can we help your furry friend?" rows="4"></textarea>
                    </div>
                    <button type="submit" class="submit-btn signature-glow">
                        Send Message
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>
            </div>

            <!-- Right Side: Contact Info & Map -->
            <div class="contact-info-container">
                <div class="contact-details">
                    <!-- Item 1 -->
                    <div class="contact-item group">
                        <div class="icon-bubble primary-tint">
                            <span class="material-symbols-outlined filled">location_on</span>
                        </div>
                        <div class="contact-text">
                            <h3>Our Sanctuary</h3>
                            <p>123 Sun-Drenched Way<br>Pet Valley, CA 90210</p>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="contact-item group">
                        <div class="icon-bubble secondary-tint">
                            <span class="material-symbols-outlined filled">call</span>
                        </div>
                        <div class="contact-text">
                            <h3>Give Us a Bark</h3>
                            <p>+1 (555) RADIANT<br>Mon-Sat: 8am - 7pm</p>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="contact-item group">
                        <div class="icon-bubble tertiary-tint">
                            <span class="material-symbols-outlined filled">mail</span>
                        </div>
                        <div class="contact-text">
                            <h3>Digital Correspondence</h3>
                            <p>hello@radianthabitat.com<br>support@radianthabitat.com</p>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="map-bento">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGzyfABbsMrhd6mSPbjkIYf0DzMBkid3PW6qWHbSLZSrKEgumjjQZP4mMk87Resbc3S8xU9xRxEUw3wBPIotZWtyA98EX2O4P197WXebAqZHrcCot-6ghiFznS1lrpTicJIgcfEIqakj04e-9uRP9_r_qhaitaGBFw04K8iPy2EX2Ynu5mKKUc4kTUntW4LT-8IEaaNtG5xhXaxNbo5zTAK6pKBBH2m-IEDB2cd9Tz3ebWygBJ6zbT3P5amtiTWyhMwAdSLzzr_b0D" alt="Map">
                    <div class="map-overlay">
                        <a href="#" class="map-link">
                            <span class="material-symbols-outlined">directions</span> Open in Google Maps
                        </a>
                    </div>
                </div>

                <!-- Socials -->
                <div class="glass-card socials-card">
                    <span class="socials-title">Follow the Pack</span>
                    <div class="socials-links">
                        <a href="#"><span class="material-symbols-outlined">share</span></a>
                        <a href="#"><span class="material-symbols-outlined">photo_camera</span></a>
                        <a href="#"><span class="material-symbols-outlined">play_circle</span></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
