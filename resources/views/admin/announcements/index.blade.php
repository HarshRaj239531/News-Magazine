@extends('layouts.admin')

@section('header_title', 'Manage Announcements')

@section('admin_content')

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="color: var(--primary-color);">What's New List Items</h3>
            <a href="{{ route('admin.announcements.create') }}" class="btn-primary">➕ Add New Item</a>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title / Ticker Text</th>
                        <th>Type / Action Link</th>
                        <th>Icon</th>
                        <th>Highlighted</th>
                        <th>Language</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $index => $announcement)
                        <tr>
                            <td style="font-weight: bold; color: var(--text-muted);">{{ $announcements->firstItem() + $index }}</td>
                            <td style="font-weight: 700; color: var(--primary-color); max-width: 350px; white-space: normal; line-height: 1.4;">
                                {{ $announcement->title }}
                            </td>
                            <td>
                                @if($announcement->file_path)
                                    <a href="{{ $announcement->file_path }}" target="_blank" style="color: var(--accent-color); font-weight: bold; display: inline-flex; align-items: center; gap: 4px;">
                                        📄 PDF Document
                                    </a>
                                @elseif($announcement->link)
                                    <a href="{{ $announcement->link }}" target="_blank" style="color: var(--primary-light); font-weight: bold; display: inline-flex; align-items: center; gap: 4px; word-break: break-all;">
                                        🔗 Web Link
                                    </a>
                                @else
                                    <span style="font-style: italic; color: var(--text-muted); font-size: 0.8rem;">Text Only</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 1.1rem;">
                                    @if($announcement->icon_type == 'calendar') 📅
                                    @elseif($announcement->icon_type == 'star') ⭐
                                    @elseif($announcement->icon_type == 'file') 📄
                                    @elseif($announcement->icon_type == 'link') 🔗
                                    @else 📢
                                    @endif
                                </span>
                                <span style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; display: block;">{{ $announcement->icon_type }}</span>
                            </td>
                            <td>
                                @if($announcement->is_highlighted)
                                    <span style="background-color: #fef08a; color: #854d0e; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">
                                        💡 Blinking Tag
                                    </span>
                                @else
                                    <span style="color: var(--text-muted); font-size: 0.8rem;">Standard</span>
                                @endif
                            </td>
                            <td><span class="badge-locale">{{ $announcement->locale }}</span></td>
                            <td style="font-weight: bold;">{{ $announcement->sort_order }}</td>
                            <td>
                                <span class="{{ $announcement->status == 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ $announcement->status }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 8px;">
                                    <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn-action btn-edit">Edit</a>
                                    <form action="{{ route('admin.announcements.delete', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 20px; color: var(--text-muted);">
                                No items found. Click "Add New Item" to start.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $announcements->links('partials.pagination') }}
        </div>
    </div>

@endsection
