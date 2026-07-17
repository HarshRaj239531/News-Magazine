<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - VIGYANMEV JAYATE</title>
    <link rel="stylesheet" href="/css/admin.css">
    <script>
        // Immediate execution to prevent theme + sidebar flicker
        if (localStorage.getItem('admin-theme') === 'dark') {
            document.documentElement.classList.add('dark-theme');
        }
        if (localStorage.getItem('admin-sidebar') === 'collapsed') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>
</head>
<body>

    <div class="admin-layout" id="admin-layout">

        <!-- Sidebar -->
        <aside class="admin-sidebar" id="admin-sidebar">

            <!-- Sidebar Header: Logo + Collapse Toggle -->
            <div class="sidebar-header">
                <div class="sidebar-title">
                    <span class="sidebar-logo">🔬</span>
                    <span class="sidebar-title-text">VIGYANMEV</span>
                </div>
                <button id="sidebar-toggle" class="sidebar-toggle-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
                    <span id="sidebar-toggle-icon">◀</span>
                </button>
            </div>

            <ul class="admin-nav">
                <li class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" title="Dashboard">
                        <span class="nav-icon">📊</span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.articles.index') }}" title="News / Pages">
                        <span class="nav-icon">📰</span>
                        <span class="nav-label">News / Pages</span>
                        <span class="sidebar-badge">dynamic</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.members.index') }}" title="Directories">
                        <span class="nav-icon">👥</span>
                        <span class="nav-label">Directories</span>
                        <span class="sidebar-badge">37 lists</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slides.index') }}" title="Slider Manager">
                        <span class="nav-icon">🖼️</span>
                        <span class="nav-label">Slider Manager</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcements.index') }}" title="What's New Manager">
                        <span class="nav-icon">📢</span>
                        <span class="nav-label">"What's New" Manager</span>
                    </a>
                </li>
                <li class="admin-nav-item {{ request()->routeIs('admin.navigation.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.navigation.index') }}" title="Navbar & Pages">
                        <span class="nav-icon">🗺️</span>
                        <span class="nav-label">Navbar & Pages</span>
                        <span class="sidebar-badge" style="background-color: var(--accent-color); color: white;">builder</span>
                    </a>
                </li>

                <!-- Settings (divider) -->
                <li class="nav-divider"></li>

                <li class="admin-nav-item {{ request()->routeIs('admin.dignitaries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dignitaries.index') }}" title="Dignitaries">
                        <span class="nav-icon">👤</span>
                        <span class="nav-label">Dignitaries / पदाधिकारी</span>
                    </a>
                </li>

                <li class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}" title="Site Settings">
                        <span class="nav-icon">⚙️</span>
                        <span class="nav-label">Site Settings</span>
                        <span class="sidebar-badge" style="background-color: #7c3aed; color: white;">new</span>
                    </a>
                </li>

                <!-- Bottom actions -->
                <li class="nav-divider" style="margin-top: auto;"></li>

                <li class="admin-nav-item">
                    <a href="{{ route('home') }}" target="_blank" title="View Website">
                        <span class="nav-icon">🌐</span>
                        <span class="nav-label">View Website</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ef4444;" title="Logout">
                        <span class="nav-icon">🚪</span>
                        <span class="nav-label">Logout</span>
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
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="mobile-nav-toggle" onclick="toggleMobileSidebar()" aria-label="Toggle Sidebar" style="background: var(--sidebar-bg); border: 1px solid var(--sidebar-border); border-radius: 6px; padding: 6px 10px; font-size: 1.2rem; cursor: pointer; color: var(--text-dark); display: none;">
                        ☰
                    </button>
                    <div>
                        <h2 style="margin: 0;">@yield('header_title', 'Admin Dashboard')</h2>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Welcome back, Administrator</p>
                    </div>
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

    <script>
        /* ---- THEME TOGGLE ---- */
        const themeToggle     = document.getElementById('theme-toggle');
        const themeToggleIcon = document.getElementById('theme-toggle-icon');
        const themeToggleText = document.getElementById('theme-toggle-text');
        const htmlElement     = document.documentElement;

        function updateToggleButtonState(isDark) {
            themeToggleIcon.textContent = isDark ? '☀️' : '🌙';
            themeToggleText.textContent = isDark ? 'Light Mode' : 'Dark Mode';
        }
        updateToggleButtonState(localStorage.getItem('admin-theme') === 'dark');

        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark-theme');
            const isDarkActive = htmlElement.classList.contains('dark-theme');
            localStorage.setItem('admin-theme', isDarkActive ? 'dark' : 'light');
            updateToggleButtonState(isDarkActive);
        });

        /* ---- SIDEBAR COLLAPSE & MOBILE DRAWER ---- */
        function toggleSidebar() {
            if (window.innerWidth <= 1024) {
                toggleMobileSidebar();
            } else {
                const isCollapsed = htmlElement.classList.toggle('sidebar-collapsed');
                localStorage.setItem('admin-sidebar', isCollapsed ? 'collapsed' : 'expanded');
                document.getElementById('sidebar-toggle-icon').textContent = isCollapsed ? '▶' : '◀';
            }
        }

        function toggleMobileSidebar() {
            const isOpen = htmlElement.classList.toggle('mobile-sidebar-open');
            let overlay = document.getElementById('sidebar-overlay');
            if (isOpen) {
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.id = 'sidebar-overlay';
                    overlay.style.position = 'fixed';
                    overlay.style.top = '0';
                    overlay.style.left = '0';
                    overlay.style.right = '0';
                    overlay.style.bottom = '0';
                    overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
                    overlay.style.zIndex = '999';
                    overlay.addEventListener('click', toggleMobileSidebar);
                    document.body.appendChild(overlay);
                }
                overlay.style.display = 'block';
            } else if (overlay) {
                overlay.style.display = 'none';
            }
        }

        // Restore toggle icon on load
        if (localStorage.getItem('admin-sidebar') === 'collapsed') {
            document.getElementById('sidebar-toggle-icon').textContent = '▶';
        }

        /* ---- FILE UPLOAD UI ---- */
        document.addEventListener('change', function(e) {
            if (e.target && e.target.type === 'file' && e.target.closest('.animated-file-upload')) {
                let dropzone    = e.target.closest('.animated-file-upload');
                let placeholder = dropzone.querySelector('.file-upload-placeholder');
                if (e.target.files && e.target.files.length > 0) {
                    let fileName = e.target.files[0].name;
                    placeholder.querySelector('.upload-icon').textContent = '📄';
                    placeholder.querySelector('.upload-text').textContent = 'File Selected';
                    placeholder.querySelector('.upload-info').textContent = fileName;
                    placeholder.querySelector('.upload-info').style.color = 'var(--primary-color)';
                    placeholder.querySelector('.upload-info').style.fontWeight = '700';
                }
            }
        });
    </script>

</body>
</html>
