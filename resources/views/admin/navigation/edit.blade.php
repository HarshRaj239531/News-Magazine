@extends('layouts.admin')

@section('header_title', 'Edit Navbar Link / Page')

@section('admin_content')

    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="admin-card" style="max-width: 900px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Edit Menu Link or Page Content</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Modify page properties, layout selection, text styles, or redirect targets below.</p>
        </div>

        @if($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 4px; font-size: 0.85rem; margin-bottom: 25px; font-weight: 600;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.navigation.update', $menu->id) }}" method="POST" id="navForm">
            @csrf

            <!-- Bilingual Titles -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="title_en">Menu Title (English) / नाम (अंग्रेज़ी) *</label>
                    <input type="text" name="title_en" id="title_en" class="form-control" placeholder="e.g. Scientific Board" required value="{{ old('title_en', $menu->title_en) }}">
                </div>

                <div class="form-group">
                    <label for="title_hi">Menu Title (Hindi) / नाम (हिन्दी) *</label>
                    <input type="text" name="title_hi" id="title_hi" class="form-control" placeholder="e.g. वैज्ञानिक बोर्ड" required value="{{ old('title_hi', $menu->title_hi) }}">
                </div>
            </div>

            <!-- Parent selector & Type selector -->
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="type">Link Type / लिंक प्रकार *</label>
                    <select name="type" id="type" class="form-control" required onchange="toggleFormFields()">
                        <option value="parent" {{ old('type', $menu->type) == 'parent' ? 'selected' : '' }}>📁 Dropdown Folder (Parent Menu)</option>
                        <option value="page" {{ old('type', $menu->type) == 'page' ? 'selected' : '' }}>📄 Custom Page (Page Builder)</option>
                        <option value="directory" {{ old('type', $menu->type) == 'directory' ? 'selected' : '' }}>👥 Linked Directory Member List</option>
                        <option value="url" {{ old('type', $menu->type) == 'url' ? 'selected' : '' }}>🔗 External/Custom URL Redirect</option>
                    </select>
                </div>

                <div class="form-group" id="parentGroup">
                    <label for="parent_id">Parent Dropdown / मूल मेनू</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">-- Set as Top Level Link --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>📁 {{ $parent->title_en }} ({{ $parent->title_hi }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sort_order">Sort Order / क्रम *</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" required value="{{ old('sort_order', $menu->sort_order) }}">
                </div>
            </div>

            <!-- Redirect URL field -->
            <div class="form-group" id="urlGroup" style="display: none;">
                <label for="url">Custom Redirect URL / अन्य वेब पता *</label>
                <input type="text" name="url" id="url" class="form-control" placeholder="e.g. /contact-us or https://google.com" value="{{ old('url', $menu->url) }}">
            </div>

            <!-- Directory Category field -->
            <div class="form-group" id="directoryGroup" style="display: none;">
                <label for="directory_category">Linked Directory / कौन सा समिति सूची लिंक करना है? *</label>
                <select name="directory_category" id="directory_category" class="form-control">
                    <option value="">-- Select Committee/Press Category --</option>
                    @foreach($categories as $key => $name)
                        <option value="{{ $key }}" {{ old('directory_category', $menu->directory_category) == $key ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Layout selector & Status selector -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;" id="layoutGroup">
                <div class="form-group">
                    <label for="layout_type">Dynamic Page Layout / पृष्ठ लेआउट *</label>
                    <select name="layout_type" id="layout_type" class="form-control" required>
                        <option value="standard" {{ old('layout_type', $menu->layout_type) == 'standard' ? 'selected' : '' }}>Standard Article (Single Column Container)</option>
                        <option value="grid" {{ old('layout_type', $menu->layout_type) == 'grid' ? 'selected' : '' }}>Grid Style (Split cards container)</option>
                        <option value="table" {{ old('layout_type', $menu->layout_type) == 'table' ? 'selected' : '' }}>Table Grid (Responsive lists rows)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Publish Status / स्थिति *</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status', $menu->status) == 'published' ? 'selected' : '' }}>Published (Active on Site)</option>
                        <option value="draft" {{ old('status', $menu->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                </div>
            </div>

            <!-- Page Rich Content: English & Hindi Editors -->
            <div id="contentGroup">
                <!-- English Content -->
                <div class="form-group" style="margin-top: 20px;">
                    <label>Page Content (English) / लेख सामग्री (अंग्रेज़ी)</label>
                    <div id="editorEn" style="height: 300px; background: white; border-radius: 0 0 4px 4px;">{!! old('content_en', $menu->content_en) !!}</div>
                    <input type="hidden" name="content_en" id="content_en">
                </div>

                <!-- Hindi Content -->
                <div class="form-group" style="margin-top: 25px;">
                    <label>Page Content (Hindi) / लेख सामग्री (हिन्दी)</label>
                    <div id="editorHi" style="height: 300px; background: white; border-radius: 0 0 4px 4px;">{!! old('content_hi', $menu->content_hi) !!}</div>
                    <input type="hidden" name="content_hi" id="content_hi">
                </div>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.navigation.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-primary" onclick="copyEditorContent()">Update Navbar Link & Page</button>
            </div>

        </form>
    </div>

    <!-- Quill Editor JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        // Initialize Quill editors
        var quillEn = new Quill('#editorEn', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['link', 'image', 'clean']
                ]
            }
        });

        var quillHi = new Quill('#editorHi', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    ['link', 'image', 'clean']
                ]
            }
        });

        // Copy editor content to hidden fields before submit
        function copyEditorContent() {
            document.getElementById('content_en').value = quillEn.root.innerHTML;
            document.getElementById('content_hi').value = quillHi.root.innerHTML;
        }

        // Toggle Form fields based on selected Menu Type
        function toggleFormFields() {
            var type = document.getElementById('type').value;
            var parentGroup = document.getElementById('parentGroup');
            var urlGroup = document.getElementById('urlGroup');
            var directoryGroup = document.getElementById('directoryGroup');
            var layoutGroup = document.getElementById('layoutGroup');
            var contentGroup = document.getElementById('contentGroup');

            // Reset visibilities
            parentGroup.style.display = 'block';
            urlGroup.style.display = 'none';
            directoryGroup.style.display = 'none';
            layoutGroup.style.display = 'grid';
            contentGroup.style.display = 'block';

            if (type === 'parent') {
                parentGroup.style.display = 'none';
                layoutGroup.style.display = 'grid';
                document.getElementById('layout_type').required = false;
                document.querySelector('#layoutGroup .form-group:first-child').style.display = 'none';
                contentGroup.style.display = 'none';
            } else if (type === 'url') {
                urlGroup.style.display = 'block';
                document.getElementById('url').required = true;
                document.getElementById('layout_type').required = false;
                document.querySelector('#layoutGroup .form-group:first-child').style.display = 'none';
                contentGroup.style.display = 'none';
            } else if (type === 'directory') {
                directoryGroup.style.display = 'block';
                document.getElementById('directory_category').required = true;
                document.getElementById('layout_type').required = false;
                document.querySelector('#layoutGroup .form-group:first-child').style.display = 'none';
                contentGroup.style.display = 'none';
            } else {
                // Page type
                document.getElementById('layout_type').required = true;
                document.querySelector('#layoutGroup .form-group:first-child').style.display = 'block';
                document.getElementById('url').required = false;
                document.getElementById('directory_category').required = false;
            }
        }

        // Run on first load
        document.addEventListener('DOMContentLoaded', function() {
            toggleFormFields();
        });
    </script>

@endsection
