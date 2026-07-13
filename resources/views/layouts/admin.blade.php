<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - VIGYANMEV JAYATE</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
        /* Embed minor overrides specifically for admin layout */
        body {
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>

    <div class="admin-layout">
        
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-title">VIGYANMEV ADMIN</div>
            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.articles.index') }}">📰 Manage News/Pages</a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.members.index') }}">👥 Manage Directories</a>
                </li>
                <li class="admin-nav-item" style="margin-top: 30px; border-top: 1px solid #334155; padding-top: 15px;">
                    <a href="{{ route('home') }}" target="_blank">🌐 View Website</a>
                </li>
                <li class="admin-nav-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #f87171;">
                        🚪 Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <div>
                    <h2>@yield('header_title', 'Admin Dashboard')</h2>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Welcome back, Administrator</p>
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: var(--primary-color);">
                    📅 Logged in: {{ now()->format('M d, Y') }}
                </div>
            </div>

            @if(session('success'))
                <div style="background-color: #dcfce7; color: #15803d; padding: 15px; border-radius: 4px; font-size: 0.9rem; font-weight: 600; border: 1px solid #bbf7d0; margin-bottom: 25px;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @yield('admin_content')
        </main>

    </div>

</body>
</html>
