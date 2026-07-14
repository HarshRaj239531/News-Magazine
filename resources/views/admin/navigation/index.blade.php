@extends('layouts.admin')

@section('header_title', 'Navbar & Page Builder')

@section('admin_content')

    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h3 style="color: var(--primary-color);">Dynamic Navigation Links & Custom Pages</h3>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 3px;">Configure parent menus, child dropdown items, custom rich text pages, or link existing directories directly.</p>
            </div>
            <a href="{{ route('admin.navigation.create') }}" class="btn-primary">➕ Add Menu Item</a>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title (English / हिन्दी)</th>
                        <th>Type / प्रकार</th>
                        <th>Link Target / target</th>
                        <th>Language Pages</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                        <!-- Parent Row -->
                        <tr style="background-color: #f8fafc; border-left: 4px solid var(--primary-color);">
                            <td>
                                <strong style="font-size: 1rem; color: var(--primary-color);">📁 {{ $menu->title_en }}</strong>
                                <span style="display: block; font-size: 0.8rem; color: var(--text-muted); margin-left: 20px;">{{ $menu->title_hi }}</span>
                            </td>
                            <td>
                                <span style="background-color: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">
                                    {{ $menu->type }}
                                </span>
                            </td>
                            <td>
                                @if($menu->type === 'url')
                                    <code style="font-size: 0.8rem; color: var(--primary-light);">{{ $menu->url }}</code>
                                @elseif($menu->type === 'page')
                                    <code style="font-size: 0.8rem; color: var(--accent-color);">/pages/{{ $menu->slug }}</code>
                                @elseif($menu->type === 'directory')
                                    <span style="font-size: 0.8rem; font-weight: 500; color: #854d0e;">👥 Directory: {{ $menu->directory_category }}</span>
                                @else
                                    <span style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">Dropdown Folder</span>
                                @endif
                            </td>
                            <td>
                                @if($menu->type === 'page')
                                    <span style="font-size: 0.75rem; color: #16a34a; font-weight: bold;">✓ English & Hindi</span>
                                @else
                                    <span style="font-size: 0.75rem; color: var(--text-muted);">N/A</span>
                                @endif
                            </td>
                            <td style="font-weight: bold;">{{ $menu->sort_order }}</td>
                            <td>
                                <span class="{{ $menu->status == 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ $menu->status }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 8px;">
                                    <a href="{{ route('admin.navigation.edit', $menu->id) }}" class="btn-action btn-edit">Edit</a>
                                    <form action="{{ route('admin.navigation.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item? Deleting a parent will also delete all of its sub-menu items.');">
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Children Rows -->
                        @foreach($menu->children as $child)
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding-left: 40px;">
                                    <span style="color: var(--text-muted); font-weight: 500;">└─ 📄 {{ $child->title_en }}</span>
                                    <span style="display: block; font-size: 0.75rem; color: var(--text-muted); padding-left: 30px;">{{ $child->title_hi }}</span>
                                </td>
                                <td>
                                    <span style="background-color: #fef08a; color: #854d0e; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; font-weight: bold; text-transform: uppercase;">
                                        {{ $child->type }}
                                    </span>
                                </td>
                                <td>
                                    @if($child->type === 'url')
                                        <code style="font-size: 0.8rem; color: var(--primary-light);">{{ $child->url }}</code>
                                    @elseif($child->type === 'page')
                                        <a href="/pages/{{ $child->slug }}" target="_blank" style="font-size: 0.8rem; color: var(--accent-color); text-decoration: underline;">
                                            /pages/{{ $child->slug }}
                                        </a>
                                    @elseif($child->type === 'directory')
                                        <span style="font-size: 0.8rem; font-weight: 500; color: #854d0e;">👥 Directory: {{ $child->directory_category }}</span>
                                    @else
                                        <span style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">Dropdown Folder</span>
                                    @endif
                                </td>
                                <td>
                                    @if($child->type === 'page')
                                        <span style="font-size: 0.75rem; color: #16a34a; font-weight: bold;">✓ English & Hindi</span>
                                    @else
                                        <span style="font-size: 0.75rem; color: var(--text-muted);">N/A</span>
                                    @endif
                                </td>
                                <td style="font-weight: 500; color: var(--text-muted);">{{ $child->sort_order }}</td>
                                <td>
                                    <span class="{{ $child->status == 'published' ? 'badge-published' : 'badge-draft' }}" style="font-size: 0.7rem; padding: 2px 6px;">
                                        {{ $child->status }}
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: inline-flex; gap: 8px;">
                                        <a href="{{ route('admin.navigation.edit', $child->id) }}" class="btn-action btn-edit" style="font-size: 0.75rem; padding: 3px 8px;">Edit</a>
                                        <form action="{{ route('admin.navigation.delete', $child->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sub-menu item?');">
                                            @csrf
                                            <button type="submit" class="btn-action btn-delete" style="font-size: 0.75rem; padding: 3px 8px;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: var(--text-muted);">
                                No navigation menu items found. Click "Add Menu Item" to start.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
