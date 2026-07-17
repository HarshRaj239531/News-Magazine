@extends('layouts.app')

@section('title', $article->title)

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>{{ __('Vigyanmev Jayate') }} {{ __('Latest Samachar/News') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('Home') }}</a> &raquo; 
                <span style="color: var(--accent-gold); text-transform: uppercase;">{{ __($article->category) }}</span> &raquo; 
                {{ Str::limit($article->title, 40) }}
            </div>
        </div>
    </div>

    <section class="article-detail-section">
        <div class="container">
            <article class="article-container">
                
                <div class="article-header">
                    <span style="background-color: var(--accent-color); color: white; padding: 4px 10px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border-radius: 3px; display: inline-block; margin-bottom: 10px;">
                        {{ __('Category') }}: {{ __($article->category) }}
                    </span>
                    <h1>{{ $article->title }}</h1>
                    <div class="article-meta">
                        <span>📅 {{ __('Published') }}: <strong>{{ $article->created_at->format('F d, Y') }}</strong></span>
                        <span>🏷️ {{ __('Status') }}: <strong>{{ __('Official Release') }}</strong></span>
                    </div>
                </div>

                @if($article->image_path)
                    <div style="margin-bottom: 35px; border-radius: 6px; overflow: hidden; box-shadow: var(--shadow-sm);">
                        <img src="{{ $article->image_path }}" alt="{{ $article->title }}" style="width: 100%; height: auto; max-height: 450px; object-fit: cover; display: block;">
                    </div>
                @endif

                @if($article->pdf_path)
                    <div style="margin: 25px 0; background: rgba(37, 99, 235, 0.04); border: 1px dashed #2563eb; padding: 20px; border-radius: 8px; text-align: center;">
                        <p style="margin-bottom: 12px; font-weight: 600; color: var(--text-dark);">
                            {{ __('This publication contains a linked PDF document.') }} / {{ __('इस प्रकाशन में एक पीडीएफ दस्तावेज शामिल है।') }}
                        </p>
                        <a href="{{ route('pdf.viewer', ['file' => $article->pdf_path]) }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 12px 24px; font-weight: bold; background-color: #2563eb; border-radius: 4px; color: white;">
                            📄 {{ __('View / Download PDF Document') }} / {{ __('पीडीएफ दस्तावेज देखें / डाउनलोड करें') }}
                        </a>
                    </div>
                @endif

                <div class="article-body">
                    @if(strip_tags($article->content) !== $article->content)
                        {!! $article->content !!}
                    @else
                        {!! nl2br(e($article->content)) !!}
                    @endif
                </div>

                <div style="margin-top: 50px; border-top: 1px solid var(--border-color); padding-top: 20px; text-align: center;">
                    <a href="{{ route('home') }}" class="btn-primary">⬅ {{ __('Back to Homepage') }}</a>
                </div>

            </article>
        </div>
    </section>

@endsection
