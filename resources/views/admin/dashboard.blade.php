@extends('layouts.admin')

@section('header_title', 'Control Dashboard')

@section('admin_content')

    <!-- Stats Grid -->
    <div class="dashboard-stats">
        <div class="stat-widget">
            <h5>Total News / Articles</h5>
            <div class="stat-value">{{ $articlesCount }}</div>
            <p style="font-size: 0.75rem; margin-top: 5px; color: #93c5fd;">Articles published on landing portal</p>
        </div>
        <div class="stat-widget">
            <h5>Directory Listings</h5>
            <div class="stat-value">{{ $membersCount }}</div>
            <p style="font-size: 0.75rem; margin-top: 5px; color: #93c5fd;">Active members in 37 press & board lists</p>
        </div>
        <div class="stat-widget" style="background: linear-gradient(135deg, var(--accent-color) 0%, #c2410c 100%);">
            <h5>Security Status</h5>
            <div class="stat-value">Active</div>
            <p style="font-size: 0.75rem; margin-top: 5px; color: #ffedd5;">Admin session encrypted</p>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="admin-card">
        <h3 style="margin-bottom: 15px; color: var(--primary-color);">⚡ Quick Database Actions</h3>
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <a href="{{ route('admin.articles.create') }}" class="btn-primary" style="padding: 12px 20px;">✍ Write New News/Article</a>
            <a href="{{ route('admin.members.create') }}" class="btn-primary" style="padding: 12px 20px; background-color: var(--primary-color);">➕ Add Board/Club Member</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        
        <!-- Recent Articles -->
        <div class="admin-card">
            <h3 style="margin-bottom: 15px; border-bottom: 2px solid var(--border-color); padding-bottom: 8px;">Recent News Releases</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentArticles as $art)
                        <tr>
                            <td style="font-weight: 600;">{{ Str::limit($art->title, 35) }}</td>
                            <td><span style="font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">{{ $art->category }}</span></td>
                            <td>
                                <span class="{{ $art->status == 'published' ? 'badge-published' : 'badge-draft' }}">
                                    {{ $art->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--text-muted);">No news found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Members -->
        <div class="admin-card">
            <h3 style="margin-bottom: 15px; border-bottom: 2px solid var(--border-color); padding-bottom: 8px;">Recent Directory Additions</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMembers as $mem)
                        <tr>
                            <td style="font-weight: 600; color: var(--primary-color);">{{ $mem->name }}</td>
                            <td><span class="member-badge" style="font-size: 0.7rem;">{{ $mem->designation }}</span></td>
                            <td><span style="font-size: 0.7rem; color: var(--text-muted); font-weight: bold;">{{ Str::limit($mem->category, 15) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--text-muted);">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
