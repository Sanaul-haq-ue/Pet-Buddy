@extends('frontEnd.layouts.app')

@section('content')
<main class="shop-main container pt-24 pb-20">
        <!-- Hero Section -->
        <header class="shop-header">
            <h1 class="shop-title">
                Luminous <span class="text-primary italic">Nutrition</span> for Every Pet
            </h1>
            <p class="shop-subtitle">
                Premium organic blends designed to elevate your companion's vitality. From crunchy dry feasts to succulent wet pâtés.
            </p>
        </header>

        <div class="shop-layout">
            <!-- Sidebar Filters -->
            <aside class="shop-sidebar">
                <div class="filter-group">
                    <h3 class="filter-title">PET TYPE</h3>
                    <div class="filter-options">
                        <label class="checkbox-label group">
                            <input type="checkbox" checked>
                            <span class="checkbox-text group-hover:text-primary">Dogs</span>
                        </label>
                        <label class="checkbox-label group">
                            <input type="checkbox">
                            <span class="checkbox-text group-hover:text-primary">Cats</span>
                        </label>
                        <label class="checkbox-label group">
                            <input type="checkbox">
                            <span class="checkbox-text group-hover:text-primary">Birds</span>
                        </label>
                    </div>
                </div>

                <div class="filter-group">
                    <h3 class="filter-title">FOOD TYPE</h3>
                    <div class="filter-list">
                        <button class="filter-btn active">All Varieties</button>
                        <button class="filter-btn">Dry Kibble</button>
                        <button class="filter-btn">Wet Food</button>
                        <button class="filter-btn">Organic Treats</button>
                    </div>
                </div>

                <div class="rewards-promo-small">
                    <p class="promo-title">Radiant Rewards</p>
                    <p class="promo-text">Join our subscription and save 15% on every auto-ship order.</p>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="product-area">
                <div class="product-grid">
                    <!-- Product 1 -->
                    <div class="product-card glass-card sunlight-shadow group">
                        <div class="product-img-wrapper">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDmQIPpZuWRYxyIWE9HbtGBqTY2Z4E-mK2W0t7p50hUOAS9LPHfckSt9Eiebk_iaKqrLXQKWR73kg7GJMxFOALeAtfxwUJqAZtqMl9brRxo95oLv0425SW7TLnwixzlS4R2u-8MOKpFodbHRbxMX2IUyusZ79mf6irYlVioYFpKJcPV0VYRsjDNAQ0d9heVArsL4KZ9fyjkRnHBujvPK60cqMiAJmkHi9ut0TrXf01e4p39W7ckYOybIbXMvZL_BQKbS5oMgx3pvdar" alt="Golden Harvest Kibble">
                            <div class="badge badge-primary">BEST SELLER</div>
                        </div>
                        <div class="product-header">
                            <h4 class="product-name">Golden Harvest Kibble</h4>
                            <div class="product-rating text-tertiary">
                                <span class="material-symbols-outlined filled">star</span>
                                <span>4.9</span>
                            </div>
                        </div>
                        <p class="product-desc flex-grow">A vibrant blend of pasture-raised lamb and ancient grains for optimal energy.</p>
                        <div class="product-footer">
                            <span class="product-price text-primary">$34.99</span>
                            <button class="btn-add-cart signature-glow">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="product-card glass-card sunlight-shadow group">
                        <div class="product-img-wrapper">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBS4ITPKs0EdkP8khYL-u3RUeFpV5oa3YiDsV4olNq6QtpOOsMQG6Yxg0anXq3jTLvLklLze45MCP7WKhrBM88-IAH-1mp7eDyX9_jUkG-mj4wAaP-Cm_mAIUJ2xYCUuAqrdGfbNbwapRFFbwobZIhmCNRKVI7oYnww-hlLf6vx7V7zDeIqFATa30rWOAfMwZRMBsaNmt4rZQr1bt7I1BMh033VQBZgbPuBiEaxQr9-ik48Ef_AZT7Z04_scUzwR1OYjJRwxX9bsDYq" alt="Ocean Mist Pâté">
                        </div>
                        <div class="product-header">
                            <h4 class="product-name">Ocean Mist Pâté</h4>
                            <div class="product-rating text-tertiary">
                                <span class="material-symbols-outlined filled">star</span>
                                <span>4.8</span>
                            </div>
                        </div>
                        <p class="product-desc flex-grow">Fresh-caught salmon and wild tuna prepared in a savory, hydrating bone broth.</p>
                        <div class="product-footer">
                            <span class="product-price text-primary">$18.50</span>
                            <button class="btn-add-cart signature-glow">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="product-card glass-card sunlight-shadow group">
                        <div class="product-img-wrapper">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDeHzG5O7NYiFGEP5WqqqY7mhF6YIL51kwQwx-0kVnWlpBoWy-eq-jU2ikUmBqBhzlH9NDeHf3b2pz_VF8XRfx-JnGrFwBlRz-zwZXHtJlMoYT0MSHNxf5nqthw1UnpQiQn3aony_z_I72KByNnvlkHYwM1TcVwwFmbOXbtn2ZHGu8ORzQTrjivVHQyGFCKKCHXRTqZKTVQZwN65xbVbnQ6s5Tq_PrxNRzgvkP3w_0s2BIKaUKFvwui-mCUpQ8NcwnNl7YvyQ5JszRT" alt="Meadow Song Seeds">
                        </div>
                        <div class="product-header">
                            <h4 class="product-name">Meadow Song Seeds</h4>
                            <div class="product-rating text-tertiary">
                                <span class="material-symbols-outlined filled">star</span>
                                <span>4.7</span>
                            </div>
                        </div>
                        <p class="product-desc flex-grow">Diverse wild seeds and sun-dried berries for radiant feathers and clear songs.</p>
                        <div class="product-footer">
                            <span class="product-price text-primary">$12.99</span>
                            <button class="btn-add-cart signature-glow">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="product-card glass-card sunlight-shadow group">
                        <div class="product-img-wrapper">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnTNp7uh3oHfTzOJULQPpzn_6vUz9mNeFBDJB9H4_cxIOYYgtvUfzvAVwudMYueVejMCqwmCqvWY2w1a3jCINcoGaFROIwgCqLVrXaMEsY-Zh6I-GY97542DqFQe-Cx4t-ZF49qZSS0CuRZ8LLgD009cTpH9xGpocxYsKhDW6x3aS_b5ET32llaG251KNPgn2JbrvxCJFapYluCU6OlxnKjJKnVTAybPx1-XU4NRk5HJaywiEv7MWYvdGTj81VWKIQsbhSJNgXosu7" alt="Sunlight Snap Treats">
                        </div>
                        <div class="product-header">
                            <h4 class="product-name">Sunlight Snap Treats</h4>
                            <div class="product-rating text-tertiary">
                                <span class="material-symbols-outlined filled">star</span>
                                <span>5.0</span>
                            </div>
                        </div>
                        <p class="product-desc flex-grow">Air-dried chicken liver and honey biscuits. Perfect for training and joyful moments.</p>
                        <div class="product-footer">
                            <span class="product-price text-primary">$15.25</span>
                            <button class="btn-add-cart signature-glow">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>

                    <!-- Product 5 -->
                    <div class="product-card glass-card sunlight-shadow group">
                        <div class="product-img-wrapper">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfUFfvN-gzM5T9kxMeUvBs1ONYntraReeOpSmOEoHWgX6NaNKPdStDeCo5o3GG7UM6pl62Rymt03bRQtGkSYVOEM6xUfQwqrYke6CExaPfHd15WF8XjKMtZxp2It9UX4xq-bolIu7IJOi1aFoOAVyZxUAFapB-Gre6ZCGszjBhVv0u1wBdAuTw7XpWvapUA2V9Ks_BeFCh7tZB64zYN4rul1sTb1L27HUvVpHEF1DvGCXqWDQZ_ud9CXWkcOelsgwKYEe9NDFCt6VG" alt="Nursery Nurture">
                            <div class="badge badge-secondary">NEW ARRIVAL</div>
                        </div>
                        <div class="product-header">
                            <h4 class="product-name">Nursery Nurture</h4>
                            <div class="product-rating text-tertiary">
                                <span class="material-symbols-outlined filled">star</span>
                                <span>4.9</span>
                            </div>
                        </div>
                        <p class="product-desc flex-grow">Ultra-soft mouse-like texture designed specifically for the developing palate of kittens.</p>
                        <div class="product-footer">
                            <span class="product-price text-primary">$22.00</span>
                            <button class="btn-add-cart signature-glow">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>

                    <!-- Product 6 -->
                    <div class="product-card glass-card sunlight-shadow group">
                        <div class="product-img-wrapper">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGZrOTkM_hehgZ2kVWQBBfr8X8uy58xZMCHe-Ha_WgKfvi9x5NCrd50zuLW9sXlQtYm7GJ6RAmiXWYbStYfeWbGm3XAU0ZZuKUzVac1_xK16WCha3KWdeerRYx9VU2vZnKqRVJljLIpjn8dPmgwm-f4EhL5OHgNgD_ewZ_HyIYXet7NhdbBcV-1BJ4wzNRBRpB2kpQAdAb3tbZhV1TtCcBNEDniGyVk7jmmfHV_tbWeTtMudupgDhwxA5PG62NNdxsrdVJhoZkbOIl" alt="Twilight Vitality">
                        </div>
                        <div class="product-header">
                            <h4 class="product-name">Twilight Vitality</h4>
                            <div class="product-rating text-tertiary">
                                <span class="material-symbols-outlined filled">star</span>
                                <span>4.6</span>
                            </div>
                        </div>
                        <p class="product-desc flex-grow">Low-calorie, high-fiber recipe with added glucosamine for the graceful golden years.</p>
                        <div class="product-footer">
                            <span class="product-price text-primary">$42.99</span>
                            <button class="btn-add-cart signature-glow">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pagination-center">
                    <button class="btn-load-more sunlight-shadow">View All Products</button>
                </div>
            </div>
        </div>
    </main>
@endsection
