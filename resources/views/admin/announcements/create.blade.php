@extends('layouts.admin')

@section('header_title', 'Add New Announcement')

@section('admin_content')

    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Create "What's New" Announcement Item</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Enter news, calls for proposal, or general announcements. You can link them to an external URL or upload a document like a PDF.</p>
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

        <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Announcement Title / घोषणा या समाचार शीर्षक</label>
                <textarea name="title" id="title" rows="3" class="form-control" placeholder="e.g. DST- JSPS call for proposal 2026 under the Indo-Japan Cooperative Science Program..." required style="resize: vertical;">{{ old('title') }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="link">Action Link URL (Optional) / बाहरी लिंक</label>
                    <input type="url" name="link" id="link" class="form-control" placeholder="e.g. https://dst.gov.in/call-proposal" value="{{ old('link') }}">
                </div>

                <div class="form-group">
                    <label for="file">Upload Document (Optional) / पीडीएफ या दस्तावेज</label>
                    <input type="file" name="file" id="file" class="form-control">
                    <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Allowed formats: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Max: 10MB.</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="icon_type">Select Icon / आइकन</label>
                    <select name="icon_type" id="icon_type" class="form-control" required>
                        <option value="calendar" {{ old('icon_type') == 'calendar' ? 'selected' : '' }}>📅 Calendar (Recommended for dates & calls)</option>
                        <option value="file" {{ old('icon_type') == 'file' ? 'selected' : '' }}>📄 Document/PDF (Recommended for circulars & OMs)</option>
                        <option value="star" {{ old('icon_type') == 'star' ? 'selected' : '' }}>⭐ Star (Highlight/Important news)</option>
                        <option value="link" {{ old('icon_type') == 'link' ? 'selected' : '' }}>🔗 Link (External pages)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="locale">Language / भाषा</label>
                    <select name="locale" id="locale" class="form-control" required>
                        <option value="en" {{ old('locale') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ old('locale') == 'hi' ? 'selected' : '' }}>हिन्दी</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; align-items: center; margin-top: 10px;">
                <div class="form-group">
                    <label for="sort_order">Sort Order / क्रम</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" required value="{{ old('sort_order', 0) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status / स्थिति</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Active on Site)</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 600;">
                    <input type="checkbox" name="is_highlighted" value="1" {{ old('is_highlighted') ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    <span>Highlight Announcement? (Add blinking tag / attention visual)</span>
                </label>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.announcements.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-primary">Add Announcement</button>
            </div>

        </form>
    </div>

@endsection
