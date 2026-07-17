@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>ई-पेपर और पत्रिकाएं / E-Papers & Magazines</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> &raquo; 
                <span style="color: var(--accent-gold);">{{ $title }}</span>
            </div>
        </div>
    </div>

    <section class="directory-section">
        <div class="container">
            
            <h2 style="font-size: 1.5rem; border-left: 4px solid var(--accent-color); padding-left: 10px; margin-bottom: 30px;">
                {{ $title }}
            </h2>

            <div class="news-cards-grid" style="grid-template-columns: repeat(3, 1fr);">
                @forelse($epapers as $epaper)
                    <div class="news-card">
                        <div class="news-card-img" style="background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; padding: 20px; text-align: center;">
                            <span style="font-size: 2.5rem; margin-bottom: 5px;">📰</span>
                            <span style="font-size: 1.1rem; font-weight: 800; text-transform: uppercase;">Scientific Issue</span>
                        </div>
                        <div class="news-card-body">
                            <span class="news-date">📅 Released: {{ $epaper->created_at->format('M d, Y') }}</span>
                            <h3 style="font-size: 1.1rem; margin-bottom: 10px;">{{ $epaper->title }}</h3>
                            <p style="font-size: 0.8rem; color: #4a5568;">{{ Str::limit(strip_tags($epaper->content), 100) }}</p>
                            @if($epaper->pdf_path)
                                <a href="{{ route('pdf.viewer', ['file' => $epaper->pdf_path]) }}" class="btn-primary" style="padding: 6px 12px; font-size: 0.75rem; text-align: center; width: 100%;">
                                    Open E-Paper / ई-पेपर खोलें
                                </a>
                            @else
                                <a href="{{ route('news.detail', $epaper->slug) }}" class="btn-primary" style="padding: 6px 12px; font-size: 0.75rem; text-align: center; width: 100%;">
                                    Open E-Paper Page
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background-color: white; border-radius: 6px; border: 1px solid var(--border-color); color: var(--text-muted); font-weight: 500;">
                        📭 No E-Papers or Magazines have been published yet. Check back soon or add some from the Admin Panel!
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
