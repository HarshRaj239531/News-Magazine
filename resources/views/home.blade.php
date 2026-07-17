@extends('layouts.app')

@section('title', 'HOME - VIGYANMEV JAYATE')

@section('content')

    <!-- 1. Marquee Ticker -->
    @if(count($ticker) > 0)
    <section class="news-marquee-section">
        <div class="container marquee-container">
            <span class="marquee-label">{{ __('Samachar Flash') }}</span>
            <div class="marquee-content">
                <span class="marquee-text">
                    @foreach($ticker as $t)
                        <span style="margin-right: 35px;">📢 {{ $t }}</span>
                    @endforeach
                </span>
            </div>
        </div>
    </section>
    @endif

    <!-- 2. Slide Banner Section -->
    @include('partials.hero-slider-section')

    <!-- Dignitaries & About Us Section -->
    @include('partials.dignitaries-about')

    <!-- 3. Main Dashboard Grid -->
    <section class="dashboard-grid-section">
        <div class="container">
            
            <div class="dashboard-title">
                <h2>{{ __('Featured Scientific Highlights & News') }}</h2>
                <p>{{ __('Latest announcements, project developments, and honours list') }}</p>
            </div>

            <div class="dashboard-grid">
                
                <!-- Left: News Cards & Projects -->
                <div class="left-content-area">
                    
                    <h3 id="news" style="margin-bottom: 20px; border-left: 4px solid var(--accent-color); padding-left: 10px;">{{ __('Latest News / समाचार') }}</h3>
                    <div class="news-cards-grid">
                        @forelse($news as $n)
                            <div class="news-card">
                                <div class="news-card-img" style="background: linear-gradient(45deg, var(--primary-color) 0%, var(--accent-color) 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.2rem;">
                                    🔬 VIGYAN NEWS
                                </div>
                                <div class="news-card-body">
                                    <span class="news-date">📅 {{ $n->created_at->format('M d, Y') }}</span>
                                    <h3>{{ $n->title }}</h3>
                                    <p>{{ Str::limit(strip_tags($n->content), 120) }}</p>
                                    <a href="{{ route('news.detail', $n->slug) }}" class="read-more-link">{{ __('Read Full Page') }} ➜</a>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('No news articles found. Add some from the Admin Panel!') }}</p>
                        @endforelse
                    </div>

                    <!-- Projects Section -->
                    <h3 style="margin: 40px 0 20px; border-left: 4px solid var(--accent-color); padding-left: 10px;">{{ __('Our Projects Details / हमारे प्रोजेक्ट्स') }}</h3>
                    <div class="news-cards-grid">
                        @forelse($projects as $p)
                            <div class="news-card">
                                <div class="news-card-img" style="background: linear-gradient(135deg, #334155 0%, #1e293b 100%); display: flex; align-items: center; justify-content: center; color: var(--accent-gold); font-weight: bold;">
                                    ⚙️ PROJECT WORK
                                </div>
                                <div class="news-card-body">
                                    <span class="news-date">📅 Updated {{ $p->updated_at->format('M d, Y') }}</span>
                                    <h3>{{ $p->title }}</h3>
                                    <p>{{ Str::limit(strip_tags($p->content), 120) }}</p>
                                    <a href="{{ route('news.detail', $p->slug) }}" class="read-more-link">{{ __('Project Details') }} ➜</a>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('No projects found. Add projects from the Admin Panel!') }}</p>
                        @endforelse
                    </div>

                </div>

                <!-- Right: Notice Board Sidebar -->
                <div class="sidebar-area">
                    
                    <div class="sidebar-panel">
                        <div class="panel-header">
                            <h3>{{ __('Notice Board') }}</h3>
                            <span style="font-size: 0.75rem; background-color: var(--accent-color); color: white; padding: 2px 6px; border-radius: 3px; font-weight: bold;">{{ __('Active') }}</span>
                        </div>
                        <ul class="notice-list">
                            @forelse($honours as $h)
                                <li class="notice-item">
                                    <a href="{{ route('news.detail', $h->slug) }}">{{ $h->title }}</a>
                                    <div class="notice-date">🏆 {{ __('Honors Recognition') }}</div>
                                </li>
                            @empty
                                <li class="notice-item">{{ __('No active notices at this time.') }}</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="sidebar-panel" style="margin-top: 30px; background-color: var(--primary-color); color: white;">
                        <h3 style="color: var(--accent-gold); margin-bottom: 15px; text-transform: uppercase; font-size: 1.1rem; border-bottom: 1px solid #1e3a8a; padding-bottom: 8px;">{{ __('Quick Shortcuts') }}</h3>
                        <ul class="footer-links" style="list-style: none;">
                            <li style="margin-bottom: 12px;"><a href="{{ route('directory.show', 'national-parliamentary-board') }}" style="color: white; font-weight: 500;">{{ __('✓ National Parliamentary Board') }}</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('directory.show', 'prime-editor') }}" style="color: white; font-weight: 500;">{{ __('✓ Prime Editor Details') }}</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('directory.show', 'advocates') }}" style="color: white; font-weight: 500;">{{ __('✓ Legal Advisors List') }}</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('directory.show', 'engineers') }}" style="color: white; font-weight: 500;">{{ __('✓ Software Engineers Group') }}</a></li>
                            <li style="margin-bottom: 12px;"><a href="{{ route('payments') }}" style="color: var(--accent-gold); font-weight: 700;">{{ __('💳 Online Subscription Payment') }}</a></li>
                        </ul>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
