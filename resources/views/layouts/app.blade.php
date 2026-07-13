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
                <a href="#main-content">Skip to main content</a>
                <span>भारत सरकार | GOVERNMENT OF INDIA</span>
            </div>
            <div class="accessibility-tools">
                <button class="btn-acc" onclick="changeFontSize('sm')">A-</button>
                <button class="btn-acc" onclick="changeFontSize('md')">A</button>
                <button class="btn-acc" onclick="changeFontSize('lg')">A+</button>
                <button class="btn-acc" onclick="toggleContrast()">High Contrast ◐</button>
                <a href="/admin/login" style="margin-left: 15px; color: var(--accent-gold); font-weight: bold;">Admin Login 🔑</a>
            </div>
        </div>
    </div>

    <!-- 3. Government Branding Header -->
    <header class="main-header">
        <div class="container header-grid">
            <div class="header-left">
                <!-- Ashoka Emblem SVG -->
                <svg class="emblem-img" viewBox="0 0 100 150" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 10 C35 10, 35 30, 50 30 C65 30, 65 10, 50 10 Z" fill="#b91c1c"/>
                    <path d="M50 30 L50 90 M40 50 L60 50 M42 70 L58 70" stroke="#b91c1c" stroke-width="4"/>
                    <circle cx="50" cy="98" r="8" fill="none" stroke="#1e3a8a" stroke-width="3"/>
                    <path d="M50 90 L50 106 M42 98 L58 98" stroke="#1e3a8a" stroke-width="2"/>
                    <rect x="25" y="106" width="50" height="8" rx="2" fill="#15803d"/>
                    <text x="50" y="128" font-size="10" font-weight="900" text-anchor="middle" fill="#0f172a" font-family="sans-serif">सत्यमेव जयते</text>
                </svg>
                <div class="logo-text-block">
                    <h1>विज्ञानमेव जयते</h1>
                    <div class="sub-heading">VIGYANMEV JAYATE • NATIONAL SCIENTIFIC MAGAZINE OF INDIA</div>
                    <div class="ministry-text">National Hindi-English Science & Technology Publication</div>
                </div>
            </div>
            <div class="header-right">
                <div class="prgi-seal">
                    Under PRGI Ministry of<br>Information & Broadcasting<br>Govt. of India
                </div>
            </div>
        </div>
    </header>

    <!-- 4. Navigation Menu -->
    <nav class="main-navbar">
        <div class="container">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                
                <!-- About us Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">About Us ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('news.detail', 'about-us') }}">Our Profile & History</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'national-parliamentary-board') }}">National Parliamentary Board</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'prime-editor') }}">Prime Editor</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'publishers') }}">Publishers Details</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'printers') }}">Printers Details</a></li>
                    </ul>
                </li>

                <!-- Board & Advisors Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">Boards & Advisors ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'authorized-persons') }}">Authorized Persons</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'advocates') }}">Advocates & Legal Advisors</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'engineers') }}">AI & Software Engineers</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'translators') }}">Language Translators</a></li>
                    </ul>
                </li>

                <!-- Press Clubs Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">Press Clubs ▾</a>
                    <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto;">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'state-press-club-presidents') }}">State Press Club Presidents</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'commissionery-presidents') }}">Commissionery Presidents</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'women-press-club') }}">Women Press Club</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'district-press-club') }}">District Press Club Presidents</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'district-news-bureau') }}">District News Bureau Secretaries</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'subdivision-press-club') }}">Subdivision Press Clubs</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'block-press-club') }}">Block Press Clubs</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'panchayat-press-club') }}">Panchayat Press Clubs</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'youtubers') }}">Youtubers Press Club</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'offices') }}">Our Press Club Offices</a></li>
                    </ul>
                </li>

                <!-- News & Media Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">Media & News ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('home') }}#news">Latest Samachar/News</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'state-news-editors') }}">State News Editors</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'news-bureau') }}">News Bureau Details</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'documentary-films') }}">Documentary Films & Cast</a></li>
                    </ul>
                </li>

                <!-- Training & Education Dropdown -->
                <li class="nav-item">
                    <a href="#" class="nav-link">Training & Education ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'media-training') }}">Print & Electronics Training</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'social-media-training') }}">Digital Media Training Centres</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'schools-colleges') }}">Our Schools & Colleges</a></li>
                    </ul>
                </li>

                <!-- Publications & Members -->
                <li class="nav-item">
                    <a href="#" class="nav-link">Publications ▾</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'e-papers-magazines') }}">E-Papers & Magazines</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'subscribers') }}">Magazine Subscribers</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'life-members') }}">Life Members & Donors</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'photos-gallery') }}">Photo Gallery</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'advertisements-gallery') }}">Advertisements Gallery</a></li>
                        <li class="dropdown-item"><a href="{{ route('directory.show', 'honours') }}">Scientific Honours</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('payments') }}" class="nav-link">Payments</a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
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
            <p>Under PRGI Ministry of Information and Broadcasting, Government of India.</p>
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
