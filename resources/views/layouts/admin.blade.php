<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - VIGYANMEV JAYATE</title>
    <link rel="stylesheet" href="/css/admin.css">
    <script>
        // Immediate execution to prevent theme flicker
        if (localStorage.getItem('admin-theme') === 'dark') {
            document.documentElement.classList.add('dark-theme');
        } else {
            document.documentElement.classList.remove('dark-theme');
        }
    </script>
</head>
<body>

    <div class="admin-layout">
        
        <!-- Sidebar (White in light mode, Charcoal in dark mode) -->
        <aside class="admin-sidebar">
            <div class="sidebar-title">
                <span>🔬</span> VIGYANMEV
            </div>
            <ul class="admin-nav">
                <li class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="nav-label">📊 Dashboard</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.articles.index') }}">
                        <span class="nav-label">📰 News / Pages</span>
                        <span class="sidebar-badge">dynamic</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.members.index') }}">
                        <span class="nav-label">👥 Directories</span>
                        <span class="sidebar-badge">37 lists</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slides.index') }}">
                        <span class="nav-label">🖼️ Slider Manager</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcements.index') }}">
                        <span class="nav-label">📢 "What's New" Manager</span>
                    </a>
                </li>
                <li class="admin-nav-item" style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 15px;">
                    <a href="{{ route('home') }}" target="_blank">
                        <span class="nav-label">🌐 View Website</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ef4444;">
                        <span class="nav-label">🚪 Logout</span>
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
                <div style="display: flex; align-items: center; gap: 15px;">
                    <!-- Theme Toggle Switcher -->
                    <button id="theme-toggle" class="btn-cancel" style="padding: 8px 16px; border-radius: 20px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px; font-size: 0.8rem; box-shadow: var(--elevation-low); border: 1px solid var(--border-color);">
                        <span id="theme-toggle-icon">🌙</span> <span id="theme-toggle-text">Dark Mode</span>
                    </button>

                    <div class="admin-profile-badge">
                        <div class="profile-avatar">A</div>
                        <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-dark);">Admin</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div style="background-color: #dcfce7; color: #15803d; padding: 15px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; border: 1px solid #bbf7d0; margin-bottom: 25px;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @yield('admin_content')
        </main>

    </div>

    <!-- Theme Switch Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const themeToggleIcon = document.getElementById('theme-toggle-icon');
        const themeToggleText = document.getElementById('theme-toggle-text');
        const htmlElement = document.documentElement;

        // Apply visual state on toggle button based on active storage theme
        function updateToggleButtonState(isDark) {
            if (isDark) {
                themeToggleIcon.textContent = '☀️';
                themeToggleText.textContent = 'Light Mode';
            } else {
                themeToggleIcon.textContent = '🌙';
                themeToggleText.textContent = 'Dark Mode';
            }
        }

        // Initialize button text & icon
        const activeTheme = localStorage.getItem('admin-theme');
        updateToggleButtonState(activeTheme === 'dark');

        // Toggle action click handler
        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark-theme');
            const isDarkActive = htmlElement.classList.contains('dark-theme');
            
            localStorage.setItem('admin-theme', isDarkActive ? 'dark' : 'light');
            updateToggleButtonState(isDarkActive);
        });
    </script>

</body>
</html>
