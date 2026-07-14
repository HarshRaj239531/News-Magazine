@extends('layouts.admin')

@section('header_title', 'Edit Announcement')

@section('admin_content')

    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Modify Announcement Details</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Update content, redirect URLs, uploaded documents, or display status.</p>
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

        <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Announcement Title / घोषणा या समाचार शीर्षक</label>
                <textarea name="title" id="title" rows="3" class="form-control" placeholder="e.g. DST- JSPS call for proposal..." required style="resize: vertical;">{{ old('title', $announcement->title) }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="link">Action Link URL (Optional) / बाहरी लिंक</label>
                    <input type="url" name="link" id="link" class="form-control" placeholder="e.g. https://dst.gov.in/call-proposal" value="{{ old('link', $announcement->link) }}">
                </div>

                <div class="form-group">
                    <label>Current Attachment / वर्तमान दस्तावेज</label>
                    <div style="margin: 8px 0;">
                        @if($announcement->file_path)
                            <a href="{{ $announcement->file_path }}" target="_blank" style="color: var(--accent-color); font-weight: bold; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">
                                📄 View Uploaded Document
                            </a>
                        @else
                            <span style="font-style: italic; color: var(--text-muted); font-size: 0.85rem;">No attachment uploaded</span>
                        @endif
                    </div>
                    <label for="file">Replace Attachment (Optional)</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="icon_type">Select Icon / आइकन</label>
                    <select name="icon_type" id="icon_type" class="form-control" required>
                        <option value="calendar" {{ old('icon_type', $announcement->icon_type) == 'calendar' ? 'selected' : '' }}>📅 Calendar</option>
                        <option value="file" {{ old('icon_type', $announcement->icon_type) == 'file' ? 'selected' : '' }}>📄 Document/PDF</option>
                        <option value="star" {{ old('icon_type', $announcement->icon_type) == 'star' ? 'selected' : '' }}>⭐ Star</option>
                        <option value="link" {{ old('icon_type', $announcement->icon_type) == 'link' ? 'selected' : '' }}>🔗 Link</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="locale">Language / भाषा</label>
                    <select name="locale" id="locale" class="form-control" required>
                        <option value="en" {{ old('locale', $announcement->locale) == 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ old('locale', $announcement->locale) == 'hi' ? 'selected' : '' }}>हिन्दी</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; align-items: center; margin-top: 10px;">
                <div class="form-group">
                    <label for="sort_order">Sort Order / क्रम</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" required value="{{ old('sort_order', $announcement->sort_order) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status / स्थिति</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 600;">
                    <input type="checkbox" name="is_highlighted" value="1" {{ old('is_highlighted', $announcement->is_highlighted) ? 'checked' : '' }} style="width: 18px; height: 18px;">
                    <span>Highlight Announcement? (Add blinking tag / attention visual)</span>
                </label>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.announcements.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-primary">Update Announcement</button>
            </div>

        </form>
    </div>

@endsection
