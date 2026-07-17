@extends('layouts.admin')

@section('header_title', '⚙️ Site Settings')

@section('admin_content')

{{-- Success Message --}}
@if(session('success'))
    <div style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); border: 1px solid #86efac; border-left: 4px solid #16a34a; padding: 14px 20px; border-radius: 8px; margin-bottom: 24px; color: #15803d; font-weight: 600; display: flex; align-items: center; gap: 10px;">
        {{ session('success') }}
    </div>
@endif

{{-- Tab Navigation --}}
<div style="display: flex; gap: 4px; margin-bottom: 24px; background: var(--body-bg); border: 1px solid var(--border-color); border-radius: 10px; padding: 6px;">
    <button class="settings-tab active" data-tab="general" onclick="switchTab('general', this)">
        🌐 General
    </button>
    <button class="settings-tab" data-tab="footer" onclick="switchTab('footer', this)">
        📄 Footer Content
    </button>
    <button class="settings-tab" data-tab="social" onclick="switchTab('social', this)">
        📱 Social Links
    </button>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" id="settings-form">
    @csrf

    {{-- ========== TAB: GENERAL ========== --}}
    <div id="tab-general" class="settings-tab-panel">
        <div class="admin-card">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 4px;">🌐 General Settings</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted);">Core site identity and branding details.</p>
            </div>

            <div class="form-group">
                <label for="site_name">Site Name / साइट का नाम</label>
                <input type="text" id="site_name" name="site_name" class="form-control"
                    value="{{ $general['site_name'] ?? 'VIGYANMEV JAYATE' }}">
            </div>

            <div class="form-group">
                <label for="site_tagline">Tagline / टैगलाइन</label>
                <input type="text" id="site_tagline" name="site_tagline" class="form-control"
                    value="{{ $general['site_tagline'] ?? '' }}">
            </div>

            <div class="form-group">
                <label for="copyright_text">Copyright Text / कॉपीराइट टेक्स्ट</label>
                <input type="text" id="copyright_text" name="copyright_text" class="form-control"
                    value="{{ $general['copyright_text'] ?? '' }}">
                <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Shown in the footer bottom bar.</p>
            </div>
        </div>
    </div>

    {{-- ========== TAB: FOOTER ========== --}}
    <div id="tab-footer" class="settings-tab-panel" style="display:none;">

        {{-- About Text --}}
        <div class="admin-card">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 4px;">📝 Magazine Description</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted);">Shown in the first footer column.</p>
            </div>
            <div class="form-group">
                <label for="footer_about_text">About Text / परिचय</label>
                <textarea id="footer_about_text" name="footer_about_text" rows="4" class="form-control" style="resize: vertical;">{{ $footer['footer_about_text'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- Useful Links --}}
        <div class="admin-card">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 4px;">🔗 Useful Links</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted);">Links shown in the "Useful Links" footer column.</p>
            </div>
            <div id="useful-links-container">
                @foreach($usefulLinks as $i => $link)
                    @include('admin.settings.partials.link-row', ['index' => $i, 'label' => $link['label'], 'url' => $link['url'], 'type' => 'useful'])
                @endforeach
            </div>
            <button type="button" class="btn-action" style="margin-top: 12px; background: var(--primary-color); color: white;" onclick="addLinkRow('useful')">
                ➕ Add Link
            </button>
        </div>

        {{-- Directory Links --}}
        <div class="admin-card">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 4px;">📂 Directory Links</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted);">Links shown in the "Directories" footer column. Enter the directory slug (e.g. <code>advocates</code>).</p>
            </div>
            <div id="dir-links-container">
                @foreach($directoryLinks as $i => $link)
                    @include('admin.settings.partials.dir-row', ['index' => $i, 'label' => $link['label'], 'slug' => $link['slug']])
                @endforeach
            </div>
            <button type="button" class="btn-action" style="margin-top: 12px; background: var(--primary-color); color: white;" onclick="addDirRow()">
                ➕ Add Directory Link
            </button>
        </div>

        {{-- Contact Info --}}
        <div class="admin-card">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 4px;">📞 Contact Office Info</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted);">Shown in the "Contact Office" footer column.</p>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="footer_contact_name">Office Name</label>
                    <input type="text" id="footer_contact_name" name="footer_contact_name" class="form-control"
                        value="{{ $footer['footer_contact_name'] ?? '' }}">
                    <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 5px;">Use <code>\n</code> or <code>|</code> to start a new line on the webpage.</p>
                </div>
                <div class="form-group">
                    <label for="footer_contact_city">City / Location</label>
                    <input type="text" id="footer_contact_city" name="footer_contact_city" class="form-control"
                        value="{{ $footer['footer_contact_city'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="footer_contact_email">Email Address</label>
                    <input type="email" id="footer_contact_email" name="footer_contact_email" class="form-control"
                        value="{{ $footer['footer_contact_email'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="footer_contact_phone">Phone Number</label>
                    <input type="text" id="footer_contact_phone" name="footer_contact_phone" class="form-control"
                        value="{{ $footer['footer_contact_phone'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ========== TAB: SOCIAL ========== --}}
    <div id="tab-social" class="settings-tab-panel" style="display:none;">
        <div class="admin-card">
            <div style="margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <h3 style="color: var(--primary-color); margin-bottom: 4px;">📱 Social Media Links</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted);">Full URLs to your social media profiles. Leave blank to hide the icon in the footer.</p>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="social_facebook">🔵 Facebook URL</label>
                    <input type="url" id="social_facebook" name="social_facebook" class="form-control"
                        placeholder="https://facebook.com/yourpage"
                        value="{{ $social['social_facebook'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="social_twitter">🐦 Twitter / X URL</label>
                    <input type="url" id="social_twitter" name="social_twitter" class="form-control"
                        placeholder="https://twitter.com/yourhandle"
                        value="{{ $social['social_twitter'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="social_youtube">▶️ YouTube URL</label>
                    <input type="url" id="social_youtube" name="social_youtube" class="form-control"
                        placeholder="https://youtube.com/yourchannel"
                        value="{{ $social['social_youtube'] ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="social_instagram">📸 Instagram URL</label>
                    <input type="url" id="social_instagram" name="social_instagram" class="form-control"
                        placeholder="https://instagram.com/yourprofile"
                        value="{{ $social['social_instagram'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- Save Button --}}
    <div style="display: flex; justify-content: flex-end; margin-top: 8px;">
        <button type="submit" class="btn-primary" style="padding: 14px 40px; font-size: 1rem;">
            💾 Save All Settings
        </button>
    </div>

</form>

{{-- Hidden templates for JS row cloning --}}
<template id="tmpl-useful-row">
    @include('admin.settings.partials.link-row', ['index' => '__IDX__', 'label' => '', 'url' => '', 'type' => 'useful'])
</template>
<template id="tmpl-dir-row">
    @include('admin.settings.partials.dir-row', ['index' => '__IDX__', 'label' => '', 'slug' => ''])
</template>

<style>
.settings-tab {
    padding: 10px 22px;
    border: none;
    background: transparent;
    border-radius: 7px;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    transition: var(--transition-smooth);
    font-family: 'Inter', sans-serif;
}
.settings-tab:hover {
    background: var(--sidebar-hover);
    color: var(--text-dark);
}
.settings-tab.active {
    background: var(--primary-color);
    color: white;
    box-shadow: 0 2px 8px rgba(30, 58, 138, 0.25);
}
.link-row {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 12px;
    align-items: center;
    margin-bottom: 10px;
    padding: 12px;
    background: var(--body-bg);
    border: 1px solid var(--border-color);
    border-radius: 8px;
}
.link-row input { margin: 0; }
.btn-remove-row {
    background: #fee2e2;
    color: #dc2626;
    border: none;
    border-radius: 6px;
    padding: 8px 14px;
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 700;
    transition: var(--transition-smooth);
}
.btn-remove-row:hover { background: #dc2626; color: white; }
@media (max-width: 768px) {
    .link-row {
        grid-template-columns: 1fr !important;
        gap: 8px !important;
    }
}
</style>

<script>
let usefulCount = {{ count($usefulLinks) }};
let dirCount    = {{ count($directoryLinks) }};

function switchTab(tabName, btn) {
    document.querySelectorAll('.settings-tab-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.settings-tab').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tabName).style.display = 'block';
    btn.classList.add('active');
}

function addLinkRow(type) {
    const tmpl = document.getElementById('tmpl-useful-row');
    const clone = tmpl.content.cloneNode(true);
    const html  = clone.querySelector('.link-row').outerHTML.replaceAll('__IDX__', usefulCount++);
    document.getElementById('useful-links-container').insertAdjacentHTML('beforeend', html);
}

function addDirRow() {
    const tmpl = document.getElementById('tmpl-dir-row');
    const clone = tmpl.content.cloneNode(true);
    const html  = clone.querySelector('.link-row').outerHTML.replaceAll('__IDX__', dirCount++);
    document.getElementById('dir-links-container').insertAdjacentHTML('beforeend', html);
}

function removeRow(btn) {
    btn.closest('.link-row').remove();
}
</script>

@endsection
