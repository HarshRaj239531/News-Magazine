@extends('layouts.app')

@section('title', $article->title)

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>विज्ञानमेव जयते समाचार</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> &raquo; 
                <span style="color: var(--accent-gold); text-transform: uppercase;">{{ $article->category }}</span> &raquo; 
                {{ Str::limit($article->title, 40) }}
            </div>
        </div>
    </div>

    <section class="article-detail-section">
        <div class="container">
            <article class="article-container">
                
                <div class="article-header">
                    <span style="background-color: var(--accent-color); color: white; padding: 4px 10px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border-radius: 3px; display: inline-block; margin-bottom: 10px;">
                        Category: {{ $article->category }}
                    </span>
                    <h1>{{ $article->title }}</h1>
                    <div class="article-meta">
                        <span>📅 Published: <strong>{{ $article->created_at->format('F d, Y') }}</strong></span>
                        <span>🏷️ Status: <strong>Official Release</strong></span>
                    </div>
                </div>

                @if($article->image_path)
                    <div style="margin-bottom: 35px; border-radius: 6px; overflow: hidden; box-shadow: var(--shadow-sm);">
                        <img src="{{ $article->image_path }}" alt="{{ $article->title }}" style="width: 100%; height: auto; max-height: 450px; object-fit: cover; display: block;">
                    </div>
                @endif

                <div class="article-body">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <div style="margin-top: 50px; border-top: 1px solid var(--border-color); padding-top: 20px; text-align: center;">
                    <a href="{{ route('home') }}" class="btn-primary">⬅ Back to Homepage</a>
                </div>

            </article>
        </div>
    </section>

@endsection
