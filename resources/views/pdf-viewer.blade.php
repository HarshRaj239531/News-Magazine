@extends('layouts.app')

@section('title', __('PDF Document Viewer') . ' - VIGYANMEV JAYATE')

@section('content')
    <section class="pdf-viewer-section" style="padding: 40px 0; background-color: #f1f5f9; min-height: calc(100vh - 350px);">
        <div class="container">
            <!-- Top Controls -->
            <div style="background: white; border: 1px solid #cbd5e1; border-radius: 8px 8px 0 0; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border-bottom: 2px solid var(--accent-gold);">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <a href="javascript:history.back()" class="btn-cancel" style="text-decoration: none; padding: 8px 16px; border: 1px solid #cbd5e1; border-radius: 4px; font-weight: bold; font-size: 0.85rem; color: #475569; display: flex; align-items: center; gap: 6px; background-color: #f8fafc;">
                        ⬅ {{ __('Back') }} / {{ __('पीछे जाएँ') }}
                    </a>
                    <h2 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span>📄</span> {{ __('Document Viewer') }} / {{ __('दस्तावेज दर्शक') }}
                    </h2>
                </div>
            </div>

            <!-- PDF Viewer container -->
            <div style="background: white; border: 1px solid #cbd5e1; border-top: none; border-radius: 0 0 8px 8px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); height: 75vh; overflow: hidden; position: relative;">
                <iframe src="{{ $file }}#toolbar=0" style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection
