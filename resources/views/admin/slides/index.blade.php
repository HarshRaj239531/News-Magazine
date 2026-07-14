@extends('layouts.admin')

@section('header_title', 'Manage Slider items')

@section('admin_content')

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color);">Homepage Carousel Slides</h3>
            <a href="{{ route('admin.slides.create') }}" class="btn-primary">➕ Add New Slide</a>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Date & Location</th>
                        <th>Language</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $index => $slide)
                        <tr>
                            <td style="font-weight: bold; color: var(--text-muted);">{{ $slides->firstItem() + $index }}</td>
                            <td>
                                @if($slide->image_path)
                                    <img src="{{ $slide->image_path }}" alt="" style="width: 60px; height: 35px; object-fit: cover; border-radius: 3px; border: 1px solid var(--border-color);">
                                @else
                                    <span style="font-size: 0.75rem; color: var(--text-muted); font-style: italic;">No Image</span>
                                @endif
                            </td>
                            <td style="font-weight: 700; color: var(--primary-color);">{{ $slide->title }}</td>
                            <td style="font-size: 0.85rem; color: var(--text-muted);">{{ Str::limit($slide->subtitle, 40) }}</td>
                            <td style="font-size: 0.8rem;">
                                📅 {{ $slide->date ?? 'N/A' }}<br>
                                📍 {{ $slide->location ?? 'N/A' }}
                            </td>
                            <td><span class="badge-locale">{{ $slide->locale }}</span></td>
                            <td style="font-weight: bold;">{{ $slide->sort_order }}</td>
                            <td>
                                <span class="{{ $slide->status == 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ $slide->status }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 8px;">
                                    <a href="{{ route('admin.slides.edit', $slide->id) }}" class="btn-action btn-edit">Edit</a>
                                    <form action="{{ route('admin.slides.delete', $slide->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 20px; color: var(--text-muted);">
                                No slides found. Click "Add New Slide" to start.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $slides->links() }}
        </div>
    </div>

@endsection
