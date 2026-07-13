@extends('layouts.admin')

@section('header_title', 'Manage Directories & Press Clubs')

@section('admin_content')

    <!-- Category Filter Selector -->
    <div class="admin-card">
        <form action="{{ route('admin.members.index') }}" method="GET" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex-grow: 1; min-width: 250px;">
                <label for="category" style="display: block; font-weight: bold; font-size: 0.8rem; margin-bottom: 6px; color: var(--primary-color);">Filter by Board/Press Club Category:</label>
                <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                    <option value="">-- All Categories (Showing All Members) --</option>
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('admin.members.index') }}" class="btn-action" style="background-color: #cbd5e1; color: #334155; padding: 10px 15px; border-radius: 4px; font-weight: bold;">Reset Filter</a>
                <a href="{{ route('admin.members.create') }}" class="btn-primary" style="padding: 10px 20px;">➕ Add Member</a>
            </div>
        </form>
    </div>

    <!-- Listings Table -->
    <div class="admin-card">
        <h3 style="margin-bottom: 15px; color: var(--primary-color);">Directory Listings</h3>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Contact Info</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $index => $member)
                    <tr>
                        <td style="font-weight: bold; color: var(--text-muted);">{{ $members->firstItem() + $index }}</td>
                        <td>
                            @if($member->photo_path)
                                <img src="{{ $member->photo_path }}" alt="" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border-color);">
                            @else
                                <div style="width: 35px; height: 35px; border-radius: 50%; background-color: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold;">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td style="font-weight: 700; color: var(--primary-color);">{{ $member->name }}</td>
                        <td><span class="member-badge">{{ $member->designation }}</span></td>
                        <td>
                            <span style="font-size: 0.7rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">
                                {{ str_replace('-', ' ', $member->category) }}
                            </span>
                        </td>
                        <td style="font-size: 0.8rem;">
                            {{ $member->district ? $member->district . ', ' : '' }}{{ $member->state ?? 'N/A' }}
                        </td>
                        <td style="font-family: monospace; font-size: 0.8rem;">
                            {{ Str::limit($member->contact_info, 30) }}
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 8px;">
                                <a href="{{ route('admin.members.edit', $member->id) }}" class="btn-action btn-edit">Edit</a>
                                <form action="{{ route('admin.members.delete', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member profile?');">
                                    @csrf
                                    <button type="submit" class="btn-action btn-delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: var(--text-muted); font-weight: 500;">
                            No registered directory members found. Click "Add Member" to register a new profile.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $members->appends(request()->input())->links() }}
        </div>
    </div>

@endsection
