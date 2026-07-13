@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>विज्ञानमेव जयते निर्देशिका / Directories</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> &raquo; 
                <span style="color: var(--accent-gold);">{{ $title }}</span>
            </div>
        </div>
    </div>

    <section class="directory-section">
        <div class="container">
            
            <div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <h2 style="font-size: 1.5rem; border-left: 4px solid var(--accent-color); padding-left: 10px;">{{ $title }}</h2>
                <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 500;">
                    Total Listings: <span style="background-color: var(--primary-color); color: white; padding: 2px 8px; border-radius: 10px; font-weight: bold;">{{ count($members) }}</span>
                </div>
            </div>

            @if($category === 'photos-gallery' || $category === 'advertisements-gallery')
                <!-- Image Grid View for Galleries -->
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
                    @forelse($members as $member)
                        <div class="news-card">
                            <div style="height: 220px; overflow: hidden; position: relative; background-color: #e2e8f0; border-bottom: 1px solid var(--border-color);">
                                @if($member->photo_path)
                                    <img src="{{ $member->photo_path }}" alt="{{ $member->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #94a3b8;">🖼️</div>
                                @endif
                            </div>
                            <div class="news-card-body" style="padding: 15px; flex-grow: 0;">
                                <h3 style="font-size: 1.1rem; margin-bottom: 5px; color: var(--primary-color);">{{ $member->name }}</h3>
                                <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0;">{{ $member->designation }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background-color: white; border-radius: 6px; border: 1px solid var(--border-color); color: var(--text-muted); font-weight: 500;">
                            📭 No media items uploaded in this gallery yet. You can add images from the Admin Panel.
                        </div>
                    @endforelse
                </div>
            @else
                <!-- Table View for Directories -->
                <div class="data-table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name / नाम</th>
                                <th>Designation / पद</th>
                                <th>State / राज्य</th>
                                <th>District / जिला</th>
                                <th>Details & Contact / संपर्क विवरण</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $index => $member)
                                <tr>
                                    <td style="font-weight: bold; color: var(--text-muted);">{{ $index + 1 }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            @if($member->photo_path)
                                                <img src="{{ $member->photo_path }}" alt="{{ $member->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border-color);">
                                            @else
                                                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem;">
                                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <span style="font-weight: 700; color: var(--primary-color);">{{ $member->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="member-badge">{{ $member->designation }}</span>
                                    </td>
                                    <td>{{ $member->state ?? 'N/A' }}</td>
                                    <td>{{ $member->district ?? 'N/A' }}</td>
                                    <td style="font-family: monospace; color: #475569;">
                                        {!! nl2br(e($member->contact_info ?? 'No details provided')) !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 30px; color: var(--text-muted); font-weight: 500;">
                                        📭 No registered members found in this category. You can add profiles from the Admin Panel.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </section>

@endsection
