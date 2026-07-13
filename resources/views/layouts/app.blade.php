<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VIGYANMEV JAYATE - विज्ञानमेव जयते') | National Hindi-English Scientific Magazine of India</title>
    <link rel="stylesheet" href="/css/app.css">
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
            <div>
                <a href="#main-content">{{ __('Skip to main content') }}</a>
                <span>{{ app()->getLocale() == 'hi' ? 'भारत सरकार' : 'GOVERNMENT OF INDIA' }}</span>
            </div>
            <div class="accessibility-tools">
                <a href="{{ route('lang.switch', 'hi') }}" style="color: {{ app()->getLocale() == 'hi' ? 'var(--accent-gold)' : '#cbd5e1' }}; font-weight: bold; margin-right: 8px;">हिन्दी</a>
                <span style="color: #475569;">|</span>
                <a href="{{ route('lang.switch', 'en') }}" style="color: {{ app()->getLocale() == 'en' ? 'var(--accent-gold)' : '#cbd5e1' }}; font-weight: bold; margin-left: 8px; margin-right: 15px;">English</a>
                <button class="btn-acc" onclick="changeFontSize('sm')">A-</button>
                <button class="btn-acc" onclick="changeFontSize('md')">A</button>
                <button class="btn-acc" onclick="changeFontSize('lg')">A+</button>
                <button class="btn-acc" onclick="toggleContrast()">High Contrast ◐</button>
                <a href="/admin/login" style="margin-left: 15px; color: var(--accent-gold); font-weight: bold;">{{ __('Admin Login') }} 🔑</a>
            </div>
        </div>
    </div>

    <!-- 3. Government Branding Header -->
    <header class="main-header">
        <div class="container header-grid">
            <div class="header-left" style="display: flex; align-items: center; gap: 20px;">
                <!-- Circular Blue Website Logo -->
                <img src="/images/logo.png" alt="Vigyanmev Logo" style="height: 85px; width: 85px; border-radius: 50%; object-fit: cover; border: 2px solid #ffffff; box-shadow: var(--shadow-sm);">
                <div class="logo-text-block" style="padding-left: 0;">
                    <h1>{{ __('Vigyanmev Jayate') }}</h1>
                    <div class="sub-heading">{{ __('Vigyanmev Jayate') }} • {{ __('NATIONAL SCIENTIFIC MAGAZINE OF INDIA') }}</div>
                    <div class="ministry-text">{{ __('National Hindi-English Science & Technology Publication') }}</div>
                </div>
            </div>
            <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
                <!-- Circular Blue Ashoka Emblem Logo -->
                <img src="/images/ashoka.png" alt="Ashoka Emblem" style="height: 85px; width: 85px; border-radius: 50%; object-fit: cover; display: block; border: 2px solid #ffffff; box-shadow: var(--shadow-sm);">
            </div>
        </div>
    </header>

    <!-- 4. Navigation Menu -->
    <nav class="main-navbar">
        <div class="container">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">{{ __('Home') }}</a>
                </li>
                
                <!-- About us Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('About Us') }} ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('news.detail', 'about-us') }}">{{ __('Our Profile & History') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'national-parliamentary-board') }}">{{ __('National Parliamentary Board') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'prime-editor') }}">{{ __('Prime Editor') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'publishers') }}">{{ __('Publishers Details') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'printers') }}">{{ __('Printers Details') }}</a></li>
                    </ul>
                </li>

                <!-- Board & Advisors Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Boards & Advisors') }} ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'authorized-persons') }}">{{ __('Authorized Persons') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'advocates') }}">{{ __('Advocates & Legal Advisors') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'engineers') }}">{{ __('AI & Software Engineers') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'translators') }}">{{ __('Language Translators') }}</a></li>
                    </ul>
                </li>

                <!-- Press Clubs Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Press Clubs') }} ▾</a>
                    <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto;">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'state-press-club-presidents') }}">{{ __('State Press Club Presidents') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'commissionery-presidents') }}">{{ __('Commissionery Presidents') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'women-press-club') }}">{{ __('Women Press Club') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'district-press-club') }}">{{ __('District Press Club Presidents') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'district-news-bureau') }}">{{ __('District News Bureau Secretaries') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'subdivision-press-club') }}">{{ __('Subdivision Press Clubs') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'block-press-club') }}">{{ __('Block Press Clubs') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'panchayat-press-club') }}">{{ __('Panchayat Press Clubs') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'youtubers') }}">{{ __('Youtubers Press Club') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'offices') }}">{{ __('Our Press Club Offices') }}</a></li>
                    </ul>
                </li>

                <!-- News & Media Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Media & News') }} ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('home') }}#news">{{ __('Latest Samachar/News') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'state-news-editors') }}">{{ __('State News Editors') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'news-bureau') }}">{{ __('News Bureau Details') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'documentary-films') }}">{{ __('Documentary Films & Cast') }}</a></li>
                    </ul>
                </li>

                <!-- Training & Education Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Training & Education') }} ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'media-training') }}">{{ __('Print & Electronics Training') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'social-media-training') }}">{{ __('Digital Media Training Centres') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'schools-colleges') }}">{{ __('Our Schools & Colleges') }}</a></li>
                    </ul>
                </li>

                <!-- Publications & Members -->
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ __('Publications') }} ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'e-papers-magazines') }}">{{ __('E-Papers & Magazines') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'subscribers') }}">{{ __('Magazine Subscribers') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'life-members') }}">{{ __('Life Members & Donors') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'photos-gallery') }}">{{ __('Photo Gallery') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'advertisements-gallery') }}">{{ __('Advertisements Gallery') }}</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'honours') }}">{{ __('Scientific Honours') }}</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('payments') }}" class="nav-link">{{ __('Payments') }}</a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">{{ __('Contact Us') }}</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- 5. Main Content Wrapper -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- 6. Footer Section -->
    <footer class="main-footer">
        <div class="container footer-grid">
            <div class="footer-widget">
                <h4>Vigyanmev Jayate</h4>
                <p>National Hindi-English Scientific Magazine of India, bringing the latest discoveries, technological innovations, and scientific reports in regional Indian languages.</p>
            </div>
            <div class="footer-widget">
                <h4>Useful Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('news.detail', 'about-us') }}">About Us</a></li>
                    <li><a href="{{ route('payments') }}">Online Payments</a></li>
                    <li><a href="{{ route('contact') }}">Contact us</a></li>
                </ul>
            </div>
            <div class="footer-widget">
                <h4>Directories</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('directory.show', 'national-parliamentary-board') }}">Parliamentary Board</a></li>
                    <li><a href="{{ route('directory.show', 'advocates') }}">Legal Advisors</a></li>
                    <li><a href="{{ route('directory.show', 'state-press-club-presidents') }}">State Press Presidents</a></li>
                    <li><a href="{{ route('directory.show', 'engineers') }}">Software Engineers</a></li>
                </ul>
            </div>
            <div class="footer-widget">
                <h4>Contact Office</h4>
                <p><strong>Vigyanmev Jayate Press Club Head Office</strong></p>
                <p>New Delhi, India</p>
                <p>Email: contact@vigyanmev.gov.in</p>
                <p>Phone: +91-11-23091122</p>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>© {{ date('Y') }} VIGYANMEV JAYATE - विज्ञानमेव जयते. All Rights Reserved. National Hindi-English Scientific Magazine of India.</p>
        </div>
    </footer>

    <!-- Accessibility JS Scripts -->
    <script>
        function changeFontSize(size) {
            document.body.classList.remove('font-sm', 'font-lg');
            if (size === 'sm') {
                document.body.classList.add('font-sm');
            } else if (size === 'lg') {
                document.body.classList.add('font-lg');
            }
        }

        function toggleContrast() {
            document.body.classList.toggle('contrast-mode');
        }
    </script>
</body>
</html>
