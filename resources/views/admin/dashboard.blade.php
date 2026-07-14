@extends('layouts.admin')

@section('header_title', 'Control Dashboard')

@section('admin_content')

    <!-- Stats Grid -->
    <div class="dashboard-stats">
        <div class="stat-widget">
            <div class="stat-widget-top">
                <div class="stat-info">
                    <h5>Total Articles</h5>
                    <div class="stat-value">{{ $articlesCount }}</div>
                </div>
                <div class="stat-icon blue">📰</div>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 70%"></div>
            </div>
            <div class="stat-trend trend-up">
                ▲ +12% this month
            </div>
        </div>
        <div class="stat-widget">
            <div class="stat-widget-top">
                <div class="stat-info">
                    <h5>Directory Entries</h5>
                    <div class="stat-value">{{ $membersCount }}</div>
                </div>
                <div class="stat-icon saffron">👥</div>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill saffron" style="width: 45%"></div>
            </div>
            <div class="stat-trend trend-up">
                ▲ +4 added today
            </div>
        </div>
        <div class="stat-widget">
            <div class="stat-widget-top">
                <div class="stat-info">
                    <h5>Server Latency</h5>
                    <div class="stat-value" style="font-size: 1.8rem; font-weight: 800;">45ms</div>
                </div>
                <div class="stat-icon gold">⚡</div>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill gold" style="width: 95%"></div>
            </div>
            <div class="stat-trend trend-up" style="color: #10b981;">
                ● System healthy & active
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="admin-card">
        <h3 style="margin-bottom: 15px; color: var(--primary-color);">⚡ Quick Database Actions</h3>
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <a href="{{ route('admin.articles.create') }}" class="btn-primary">✍ Write New News/Article</a>
            <a href="{{ route('admin.members.create') }}" class="btn-primary" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%); box-shadow: 0 4px 15px rgba(18, 43, 91, 0.15);">➕ Add Board/Club Member</a>
            <a href="{{ route('admin.slides.create') }}" class="btn-primary" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); box-shadow: 0 4px 15px rgba(5, 150, 105, 0.15);">🖼️ Add Banner Slide</a>
            <a href="{{ route('admin.announcements.create') }}" class="btn-primary" style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%); box-shadow: 0 4px 15px rgba(217, 119, 6, 0.15);">📢 Add What's New Notice</a>
            <a href="{{ route('admin.navigation.create') }}" class="btn-primary" style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); box-shadow: 0 4px 15px rgba(79, 70, 229, 0.15);">🗺️ Add Navbar Link & Page</a>
        </div>
    </div>

    <!-- Visual Activity Grid (Lottery Board style) -->
    <div class="admin-card">
        <h3 style="margin-bottom: 5px; color: var(--primary-color);">📊 Dynamic Activity Board</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 20px;">Live statistics counters across key publication committees and news bureaus.</p>
        
        <div class="category-visual-grid">
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>Parliamentary Board</h6>
                    <p>National Committee</p>
                </div>
                <div class="category-visual-count">2</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>Prime Editors</h6>
                    <p>Chief Coordinators</p>
                </div>
                <div class="category-visual-count">1</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>Translators</h6>
                    <p>Bilingual Experts</p>
                </div>
                <div class="category-visual-count">1</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>AI/Software Engineers</h6>
                    <p>Tech Developers</p>
                </div>
                <div class="category-visual-count">2</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>State News Editors</h6>
                    <p>State Coordinators</p>
                </div>
                <div class="category-visual-count">1</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>Press Club Presidents</h6>
                    <p>State Presidents</p>
                </div>
                <div class="category-visual-count">1</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>Legal Advisors</h6>
                    <p>Supreme Court</p>
                </div>
                <div class="category-visual-count">1</div>
            </div>
            <div class="category-visual-card">
                <div class="category-visual-info">
                    <h6>Life Members</h6>
                    <p>ISRO Ex-Chairman</p>
                </div>
                <div class="category-visual-count">1</div>
            </div>
        </div>
    </div>

    <!-- Lottery Draw Countdown & Subscriptions Ledger Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 40px;">
        <!-- Draw Board Card -->
        <div class="draw-board">
            <div>
                <h4 class="draw-board-title">🎰 Active Publication Draw Pool</h4>
                <p style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.7); margin-bottom: 15px;">Next scheduled Science Quiz contest & editorial issue launch jackpot pool</p>
                <div class="draw-board-pool">
                    💎 250,000 INR
                </div>
            </div>
            <div>
                <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: bold; color: rgba(255,255,255,0.85); display: block; margin-bottom: 5px;">Draw Countdown:</span>
                <div class="draw-countdown-container">
                    <div class="countdown-box">02</div>
                    <div class="countdown-sep">d</div>
                    <div class="countdown-box">14</div>
                    <div class="countdown-sep">h</div>
                    <div class="countdown-box">45</div>
                    <div class="countdown-sep">m</div>
                </div>
            </div>
        </div>

        <!-- Live Subscriptions/Winners Ledger -->
        <div class="admin-card" style="margin-bottom: 0;">
            <h3 style="margin-bottom: 15px; color: var(--primary-color);">🎟️ Live Subscription Ledger</h3>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-family: monospace; font-weight: bold; color: var(--accent-color);">#VM-991823</td>
                            <td style="font-weight: 600;">Prof. Ramesh Chandra</td>
                            <td>500 INR</td>
                            <td><span class="badge-published" style="background-color: #dcfce7; color: #15803d;">PAID</span></td>
                        </tr>
                        <tr>
                            <td style="font-family: monospace; font-weight: bold; color: var(--accent-color);">#VM-102983</td>
                            <td style="font-weight: 600;">Dr. Sunita Deshmukh</td>
                            <td>1,000 INR</td>
                            <td><span class="badge-published" style="background-color: #dcfce7; color: #15803d;">PAID</span></td>
                        </tr>
                        <tr>
                            <td style="font-family: monospace; font-weight: bold; color: var(--accent-color);">#VM-883109</td>
                            <td style="font-weight: 600;">Manoj Kumar Singh</td>
                            <td>250 INR</td>
                            <td><span class="badge-published" style="background-color: #fef3c7; color: #d97706;">PENDING</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        
        <!-- Recent Articles -->
        <div class="admin-card">
            <h3 style="margin-bottom: 15px; border-bottom: 2px solid var(--border-color); padding-bottom: 8px;">Recent News Releases</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentArticles as $art)
                        <tr>
                            <td style="font-weight: 600;">{{ Str::limit($art->title, 35) }}</td>
                            <td><span style="font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">{{ $art->category }}</span></td>
                            <td>
                                <span class="{{ $art->status == 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ $art->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--text-muted);">No news found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Members -->
        <div class="admin-card">
            <h3 style="margin-bottom: 15px; border-bottom: 2px solid var(--border-color); padding-bottom: 8px;">Recent Directory Additions</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMembers as $mem)
                        <tr>
                            <td style="font-weight: 600; color: var(--primary-color);">{{ $mem->name }}</td>
                            <td><span class="member-badge" style="font-size: 0.7rem;">{{ $mem->designation }}</span></td>
                            <td><span style="font-size: 0.7rem; color: var(--text-muted); font-weight: bold;">{{ Str::limit($mem->category, 15) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--text-muted);">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
