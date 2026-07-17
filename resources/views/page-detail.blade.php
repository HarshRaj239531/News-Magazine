@extends('layouts.app')

@php
    $title = app()->getLocale() == 'hi' ? $page->title_hi : $page->title_en;
    $content = app()->getLocale() == 'hi' ? $page->content_hi : $page->content_en;
@endphp

@section('title', $title)

@section('content')

    <!-- Breadcrumbs / Page Header -->
    <section class="page-title-section" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%); padding: 40px 0; color: white; border-bottom: 3px solid var(--accent-color);">
        <div class="container">
            <h1 style="color: white; font-size: 2.2rem; font-weight: 800; margin-bottom: 10px;">{{ $title }}</h1>
            <div class="breadcrumbs" style="font-size: 0.85rem; color: #cbd5e1; font-weight: 500;">
                <a href="{{ route('home') }}" style="color: #cbd5e1;">{{ __('Home') }}</a> ➜ 
                <span>{{ $title }}</span>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="dynamic-page-section" style="padding: 50px 0;">
        <div class="container">
            
            @if($page->pdf_path)
                <div style="max-width: 900px; margin: 0 auto 35px; background: rgba(37, 99, 235, 0.04); border: 1px dashed #2563eb; padding: 25px; border-radius: 8px; text-align: center;">
                    <p style="margin-bottom: 12px; font-weight: 600; color: var(--text-dark); font-size: 1.05rem;">
                        {{ __('This page contains a linked PDF document.') }} / {{ __('इस पृष्ठ में एक पीडीएफ दस्तावेज शामिल है।') }}
                    </p>
                    <a href="{{ route('pdf.viewer', ['file' => $page->pdf_path]) }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 12px 24px; font-weight: bold; background-color: #2563eb; border-radius: 4px; color: white;">
                        📄 {{ __('View / Download PDF Document') }} / {{ __('पीडीएफ दस्तावेज देखें / डाउनलोड करें') }}
                    </a>
                </div>
            @endif

            @if(empty($content) && !$page->pdf_path)
                <div class="article-container" style="background: white; padding: 50px; border-radius: 8px; text-align: center; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <p style="font-style: italic; color: var(--text-muted);">{{ __('This page has no content yet. Add content in the Admin Panel.') }}</p>
                </div>
            @elseif(!empty($content))
                @if($page->layout_type === 'grid')
                    <!-- Grid Layout Container -->
                    <div class="dynamic-grid-layout" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
                        <div class="dynamic-rich-content grid-span-full" style="grid-column: 1 / -1;">
                            {!! $content !!}
                        </div>
                    </div>
                @elseif($page->layout_type === 'table')
                    <!-- Table Layout Container -->
                    <div class="dynamic-table-layout" style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); padding: 25px;">
                        <div class="dynamic-rich-content">
                            {!! $content !!}
                        </div>
                    </div>
                @else
                    <!-- Standard Layout (Article Column) -->
                    <div class="article-container" style="background: white; padding: 45px; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); max-width: 900px; margin: 0 auto;">
                        <div class="dynamic-rich-content" style="line-height: 1.8; font-size: 1.05rem; color: #334155;">
                            {!! $content !!}
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </section>

    <style>
        /* Styled dynamic content helpers (WYSIWYG overrides) */
        .dynamic-rich-content h1, 
        .dynamic-rich-content h2, 
        .dynamic-rich-content h3, 
        .dynamic-rich-content h4 {
            color: var(--primary-color);
            margin: 25px 0 15px;
            font-weight: 700;
        }
        .dynamic-rich-content h1 { font-size: 1.8rem; border-bottom: 2px solid var(--border-color); padding-bottom: 8px; }
        .dynamic-rich-content h2 { font-size: 1.5rem; }
        .dynamic-rich-content h3 { font-size: 1.25rem; }
        
        .dynamic-rich-content p {
            margin-bottom: 18px;
            line-height: 1.8;
        }
        
        .dynamic-rich-content ul, 
        .dynamic-rich-content ol {
            margin-left: 25px;
            margin-bottom: 20px;
        }
        
        .dynamic-rich-content li {
            margin-bottom: 8px;
        }
        
        .dynamic-rich-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        
        .dynamic-rich-content th, 
        .dynamic-rich-content td {
            border: 1px solid var(--border-color);
            padding: 12px 15px;
            text-align: left;
        }
        
        .dynamic-rich-content th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }
        
        .dynamic-rich-content tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .dynamic-rich-content blockquote {
            border-left: 4px solid var(--accent-color);
            padding-left: 20px;
            font-style: italic;
            color: var(--text-muted);
            margin: 20px 0;
        }
        
        .dynamic-rich-content img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>

@endsection
