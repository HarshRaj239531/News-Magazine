<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VIGYANMEV JAYATE - विज्ञानमेव जयते') | NATIONAL HINDI ENGLISH MONTHLY SCIENTIFIC MAGAZINE UNITED STATES OF INDIA</title>
    <link rel="stylesheet" href="/css/app.css?v={{ time() }}">
    <style>
        /* Embedded styling helper for accessibility font resizing */
        body.font-lg { font-size: 1.15rem; }
        body.font-sm { font-size: 0.9rem; }
        body.contrast-mode {
            background-color: #121212 !important;
            color: #f1f5f9 !important;
        }
        body.contrast-mode .main-header,
        body.contrast-mode .news-marquee-section,
        body.contrast-mode .news-card,
        body.contrast-mode .sidebar-panel,
        body.contrast-mode .article-container,
        body.contrast-mode .payment-card,
        body.contrast-mode .data-table-wrapper {
            background-color: #1e1e1e !important;
            color: #f1f5f9 !important;
            border-color: #334155 !important;
        }
        body.contrast-mode h1,
        body.contrast-mode h2,
        body.contrast-mode h3,
        body.contrast-mode h4,
        body.contrast-mode td {
            color: #ffffff !important;
        }
        body.contrast-mode .data-table tr:nth-child(even) {
            background-color: #262626 !important;
        }
    </style>
</head>
<body>

    <!-- 1. Government Top Accent -->
    <div class="gov-top-bar"></div>

    <!-- 2. Accessibility & Top Utility Bar -->
    <div class="top-bar-links">
        <div class="container">
            <div class="gov-text-section">
                <a href="#main-content" class="skip-link">{{ __('Skip to main content') }}</a>
                <span>{{ app()->getLocale() == 'hi' ? 'भारत सरकार' : 'GOVERNMENT OF INDIA' }}</span>
            </div>
            <div class="top-bar-right-wrapper" style="display: flex; align-items: center; gap: 15px;">
                <div class="language-switcher">
                    <a href="{{ route('lang.switch', 'hi') }}" style="color: {{ app()->getLocale() == 'hi' ? 'var(--accent-gold)' : '#cbd5e1' }}; font-weight: bold; margin-right: 8px;">हिन्दी</a>
                    <span style="color: #475569;">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() == 'en' ? 'var(--accent-gold)' : '#cbd5e1' }}; font-weight: bold; margin-left: 8px; margin-right: 15px;">English</a>
                </div>
                <div class="accessibility-tools">
                    <button class="btn-acc" onclick="changeFontSize('sm')">A-</button>
                    <button class="btn-acc" onclick="changeFontSize('md')">A</button>
                    <button class="btn-acc" onclick="changeFontSize('lg')">A+</button>
                    <button class="btn-acc" onclick="toggleContrast()">High Contrast ◐</button>
                    <a href="/admin/login" style="margin-left: 15px; color: var(--accent-gold); font-weight: bold;">{{ __('Admin Login') }} 🔑</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Government Branding Header -->
    <header class="main-header">
        <div class="container header-grid">
            <div class="header-left" style="display: flex; align-items: center; gap: 22px;">
                <!-- Circular Blue Website Logo -->
                <img src="/images/logo.png" alt="Vigyanmev Logo" class="header-logo-img">
                <div class="logo-text-block" style="padding-left: 0;">
                    <h1>{{ app()->getLocale() == 'en' ? 'VIGYANMEV JAYATE' : '' }}@if(app()->getLocale() == 'en')<span style="font-size: 1.7rem; color: #122b5b; font-weight: 800; background: none; -webkit-text-fill-color: #122b5b; text-transform: none; margin-left: 10px; display: inline-block; vertical-align: middle;">- विज्ञानमेव जयते</span>@else{{ __('VIGYANMEV JAYATE') }}@endif</h1>
                    <div class="sub-heading">{{ __('NATIONAL HINDI ENGLISH MONTHLY SCIENTIFIC MAGAZINE UNITED STATES OF INDIA') }}</div>
                    <div class="ministry-text">{{ __('[ THE PRESS REGISTRAR GENERAL OF NEWSPAPERS FOR INDIA 
INFORMATION AND BROADCASTING GOVERNMENT OF INDIA ]') }}</div>
                </div>
            </div>
            <div class="header-right" style="display: flex; align-items: center; gap: 22px;">
                <!-- Swachh Bharat Logo -->
                <img src="/images/swachh-bharat.png" alt="Swachh Bharat" style="height: 60px; width: auto; object-fit: contain;">
                <!-- Circular Blue Ashoka Emblem Logo -->
                <img src="/images/ashoka.png" alt="Ashoka Emblem" class="header-emblem-img">
            </div>
        </div>
    </header>

    <!-- 4. Navigation Menu -->
    <nav class="main-navbar" id="main-navbar">
        <div class="container nav-container">
            <!-- Hamburger for mobile -->
            <button class="hamburger-btn" id="hamburger-btn" aria-label="Toggle menu" onclick="toggleMobileMenu()">
                <span></span><span></span><span></span>
            </button>

            <ul class="nav-list" id="nav-list">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('Home') }}</a>
                </li>

                @if(isset($navigationMenus))
                    @foreach($navigationMenus as $menu)
                        @php
                            $title = app()->getLocale() == 'hi' ? $menu->title_hi : $menu->title_en;
                        @endphp

                        @if($menu->type === 'parent')
                            @php
                                $isParentActive = false;
                                if ($menu->publishedChildren) {
                                    foreach ($menu->publishedChildren as $child) {
                                        $childUrl = '#';
                                        if ($child->type === 'page') {
                                            $childUrl = route('pages.show', $child->slug);
                                        } elseif ($child->type === 'directory') {
                                            $childUrl = route('directory.show', $child->directory_category);
                                        } else {
                                            $childUrl = $child->url;
                                        }
                                        if (request()->url() == url($childUrl)) {
                                            $isParentActive = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <li class="nav-item has-dropdown">
                                <a href="#" class="nav-link {{ $isParentActive ? 'active' : '' }}" onclick="toggleDropdown(event, this)">{{ $title }} <span class="dropdown-caret">▾</span></a>
                                @if($menu->publishedChildren && count($menu->publishedChildren) > 0)
                                    <ul class="dropdown-menu">
                                        @foreach($menu->publishedChildren as $child)
                                            @php
                                                $childTitle = app()->getLocale() == 'hi' ? $child->title_hi : $child->title_en;
                                                if ($child->type === 'page') {
                                                    $childUrl = route('pages.show', $child->slug);
                                                } elseif ($child->type === 'directory') {
                                                    $childUrl = route('directory.show', $child->directory_category);
                                                } elseif ($child->type === 'pdf') {
                                                    $childUrl = route('pdf.viewer', ['file' => $child->pdf_path]);
                                                } else {
                                                    $childUrl = $child->url;
                                                }
                                                $isChildActive = request()->url() == url($childUrl);
                                            @endphp
                                            <li class="dropdown-item">
                                                <a href="{{ $childUrl }}" style="{{ $isChildActive ? 'color: var(--accent-color); border-left: 4px solid var(--accent-gold); padding-left: 28px;' : '' }}">{{ $childTitle }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @else
                            @php
                                if ($menu->type === 'page') {
                                    $menuUrl = route('pages.show', $menu->slug);
                                } elseif ($menu->type === 'directory') {
                                    $menuUrl = route('directory.show', $menu->directory_category);
                                } elseif ($menu->type === 'pdf') {
                                    $menuUrl = route('pdf.viewer', ['file' => $menu->pdf_path]);
                                } else {
                                    $menuUrl = $menu->url;
                                }
                                $isLinkActive = request()->url() == url($menuUrl);
                            @endphp
                            <li class="nav-item">
                                <a href="{{ $menuUrl }}" class="nav-link {{ $isLinkActive ? 'active' : '' }}">{{ $title }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
                
                <!-- Mobile Only Language Switcher -->
                <li class="nav-item mobile-only-lang">
                    <div style="display: flex; gap: 15px; align-items: center; padding: 14px 20px; border-top: 1px dashed rgba(255,255,255,0.15);">
                        <span style="color: rgba(255,255,255,0.6); font-size: 0.85rem; font-weight: 600;">{{ __('Language') }}:</span>
                        <a href="{{ route('lang.switch', 'hi') }}" style="color: {{ app()->getLocale() == 'hi' ? 'var(--accent-gold)' : '#cbd5e1' }}; font-weight: bold; font-size: 0.95rem;">हिन्दी</a>
                        <span style="color: rgba(255,255,255,0.3);">|</span>
                        <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() == 'en' ? 'var(--accent-gold)' : '#cbd5e1' }}; font-weight: bold; font-size: 0.95rem;">English</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- 5. Main Content Wrapper -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- 6. Footer Section -->
    @php
        use App\Models\Setting;
        $footerAbout    = Setting::get('footer_about_text', 'NATIONAL HINDI ENGLISH MONTHLY SCIENTIFIC MAGAZINE UNITED STATES OF INDIA.');
        $footerUseful   = json_decode(Setting::get('footer_useful_links', '[]'), true) ?: [];
        $footerDirs     = json_decode(Setting::get('footer_directory_links', '[]'), true) ?: [];
        $footerConName  = Setting::get('footer_contact_name', 'Vigyanmev Jayate Press Club Head Office');
        $footerConCity  = Setting::get('footer_contact_city', 'New Delhi, India');
        $footerConEmail = Setting::get('footer_contact_email', 'contact@vigyanmev.gov.in');
        $footerConPhone = Setting::get('footer_contact_phone', '+91-11-23091122');
        $footerCopy     = Setting::get('copyright_text', '© ' . date('Y') . ' VIGYANMEV JAYATE. All Rights Reserved.');
        $siteName       = Setting::get('site_name', 'Vigyanmev Jayate');
        $socialFB       = Setting::get('social_facebook', '');
        $socialTW       = Setting::get('social_twitter', '');
        $socialYT       = Setting::get('social_youtube', '');
        $socialIG       = Setting::get('social_instagram', '');

        $officeNameFormatted = str_replace('\n', "\n", $footerConName);
        $officeNameFormatted = str_replace('|', "\n", $officeNameFormatted);
        $officeNameFormatted = preg_replace('/\s*\n\s*/', "\n", $officeNameFormatted);
    @endphp
    <footer class="main-footer">
        <div class="container footer-grid">
            <div class="footer-widget">
                <h4>{{ $siteName }}</h4>
                <p>{{ $footerAbout }}</p>
                @if($socialFB || $socialTW || $socialYT || $socialIG)
                    <div style="display: flex; gap: 12px; margin-top: 16px; flex-wrap: wrap;">
                        @if($socialFB)<a href="{{ $socialFB }}" target="_blank" rel="noopener" style="color: #cbd5e1; font-size: 1.4rem;">🔵</a>@endif
                        @if($socialTW)<a href="{{ $socialTW }}" target="_blank" rel="noopener" style="color: #cbd5e1; font-size: 1.4rem;">🐦</a>@endif
                        @if($socialYT)<a href="{{ $socialYT }}" target="_blank" rel="noopener" style="color: #cbd5e1; font-size: 1.4rem;">▶️</a>@endif
                        @if($socialIG)<a href="{{ $socialIG }}" target="_blank" rel="noopener" style="color: #cbd5e1; font-size: 1.4rem;">📸</a>@endif
                    </div>
                @endif
            </div>
            <div class="footer-widget">
                <h4>Useful Links</h4>
                <ul class="footer-links">
                    @forelse($footerUseful as $link)
                        <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                    @empty
                        <li><a href="{{ route('home') }}">Home</a></li>
                    @endforelse
                </ul>
            </div>
            <div class="footer-widget">
                <h4>Directories</h4>
                <ul class="footer-links">
                    @forelse($footerDirs as $dir)
                        <li><a href="{{ route('directory.show', $dir['slug']) }}">{{ $dir['label'] }}</a></li>
                    @empty
                        <li><a href="{{ route('home') }}">Home</a></li>
                    @endforelse
                </ul>
            </div>
            <div class="footer-widget">
                <h4>Contact Office</h4>
                <p><strong>{!! nl2br(e($officeNameFormatted)) !!}</strong></p>
                <p>{{ $footerConCity }}</p>
                @if($footerConEmail)<p>Email: {{ $footerConEmail }}</p>@endif
                @if($footerConPhone)<p>Phone: {{ $footerConPhone }}</p>@endif
            </div>
        </div>
        <div class="container footer-bottom">
            <p>{{ $footerCopy }}</p>
        </div>
    </footer>

    <!-- Accessibility + Mobile Menu JS -->
    <script>
        function changeFontSize(size) {
            document.body.classList.remove('font-sm', 'font-lg');
            if (size === 'sm') document.body.classList.add('font-sm');
            else if (size === 'lg') document.body.classList.add('font-lg');
        }

        function toggleContrast() {
            document.body.classList.toggle('contrast-mode');
        }

        // Mobile hamburger menu
        function toggleMobileMenu() {
            const navList = document.getElementById('nav-list');
            const btn = document.getElementById('hamburger-btn');
            navList.classList.toggle('nav-open');
            btn.classList.toggle('is-open');
        }

        // Mobile: toggle dropdowns on tap instead of hover
        function toggleDropdown(e, el) {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                const li = el.closest('.has-dropdown');
                li.classList.toggle('dropdown-open');
            }
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const nav = document.getElementById('nav-list');
            const btn = document.getElementById('hamburger-btn');
            if (nav && btn && !nav.contains(e.target) && !btn.contains(e.target)) {
                nav.classList.remove('nav-open');
                btn.classList.remove('is-open');
            }
        });
    </script>
</body>
</html>
