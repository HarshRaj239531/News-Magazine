@php
    $locale = app()->getLocale();
    $leftName = $locale === 'hi' ? ($dignitaries['dignitary_left_name_hi'] ?? '') : ($dignitaries['dignitary_left_name_en'] ?? '');
    $leftDesignation = $locale === 'hi' ? ($dignitaries['dignitary_left_designation_hi'] ?? '') : ($dignitaries['dignitary_left_designation_en'] ?? '');
    $leftImage = $dignitaries['dignitary_left_image'] ?? '/images/dignitary_left.png';

    $rightName = $locale === 'hi' ? ($dignitaries['dignitary_right_name_hi'] ?? '') : ($dignitaries['dignitary_right_name_en'] ?? '');
    $rightDesignation = $locale === 'hi' ? ($dignitaries['dignitary_right_designation_hi'] ?? '') : ($dignitaries['dignitary_right_designation_en'] ?? '');
    $rightImage = $dignitaries['dignitary_right_image'] ?? '/images/dignitary_right.png';

    $aboutTitle = $locale === 'hi' ? ($dignitaries['about_section_title_hi'] ?? 'हमारे बारे में') : ($dignitaries['about_section_title_en'] ?? 'About Us');
    $aboutText = $locale === 'hi' ? ($dignitaries['about_section_text_hi'] ?? '') : ($dignitaries['about_section_text_en'] ?? '');
    $aboutImage = $dignitaries['about_section_image'] ?? '/images/about_banner.png';
@endphp

<style>
    .dignitaries-section {
        padding: 40px 0;
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .dignitaries-container {
        display: grid;
        grid-template-columns: 240px 1fr 240px;
        gap: 30px;
        align-items: stretch;
    }
    .dignitary-card {
        background: white;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .dignitary-image {
        width: 160px;
        height: 190px;
        object-fit: cover;
        border-radius: 4px;
        margin-bottom: 15px;
        border: 1px solid #cbd5e1;
        background-color: #f8fafc;
    }
    .dignitary-name {
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
        line-height: 1.3;
    }
    .dignitary-designation {
        font-size: 0.8rem;
        color: #475569;
        line-height: 1.4;
        font-weight: 600;
    }
    .about-section-center {
        background: white;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .about-section-header {
        font-size: 1.3rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
        border-bottom: 2px solid var(--accent-gold);
        padding-bottom: 6px;
        display: inline-block;
    }
    .about-section-body-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: center;
    }
    .about-section-banner {
        width: 100%;
        height: auto;
        max-height: 160px;
        object-fit: contain;
        border-radius: 4px;
        border: 1px solid #e2e8f0;
    }
    .about-section-text {
        font-size: 0.88rem;
        color: #334155;
        line-height: 1.6;
        text-align: justify;
    }
    .about-read-more-wrapper {
        text-align: right;
        margin-top: 15px;
    }
    .about-read-more-link {
        color: #1e3a8a;
        font-weight: 700;
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.2s ease;
    }
    .about-read-more-link:hover {
        color: var(--accent-gold);
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .dignitaries-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .about-section-body-grid {
            grid-template-columns: 1fr;
        }
        .dignitary-image {
            width: 140px;
            height: 165px;
        }
    }
</style>

<section class="dignitaries-section">
    <div class="container">
        <div class="dignitaries-container">
            
            <!-- Left Dignitary (Hon'ble PM) -->
            <div class="dignitary-card">
                <img src="{{ $leftImage }}" alt="{{ $leftName }}" class="dignitary-image">
                <h4 class="dignitary-name">{{ $leftName }}</h4>
                <p class="dignitary-designation">{{ $leftDesignation }}</p>
            </div>

            <!-- Center About Us Content -->
            <div class="about-section-center">
                <div>
                    <h3 class="about-section-header">{{ $aboutTitle }}</h3>
                    <div class="about-section-body-grid">
                        <div>
                            <img src="{{ $aboutImage }}" alt="About Banner" class="about-section-banner">
                        </div>
                        <div>
                            <p class="about-section-text">
                                {{ Str::limit($aboutText, 350) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="about-read-more-wrapper">
                    <a href="/pages/about-us" class="about-read-more-link">{{ $locale === 'hi' ? 'अधिक पढ़ें' : 'Read More' }} ➜</a>
                </div>
            </div>

            <!-- Right Dignitary (Hon'ble Minister) -->
            <div class="dignitary-card">
                <img src="{{ $rightImage }}" alt="{{ $rightName }}" class="dignitary-image">
                <h4 class="dignitary-name">{{ $rightName }}</h4>
                <p class="dignitary-designation">{{ $rightDesignation }}</p>
            </div>

        </div>
    </div>
</section>
