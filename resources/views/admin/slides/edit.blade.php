@extends('layouts.admin')

@section('header_title', 'Edit Slide')

@section('admin_content')

    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Modify Carousel Slide Details</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Edit slide info. If you select a new image, the existing image will be replaced.</p>
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

        <form action="{{ route('admin.slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Slide Title / स्लाइड शीर्षक</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="e.g. Bharat Innovates" required value="{{ old('title', $slide->title) }}">
            </div>

            <div class="form-group">
                <label for="subtitle">Slide Subtitle / उपशीर्षक</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="e.g. The DeepTech innovation initiative..." value="{{ old('subtitle', $slide->subtitle) }}">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="date">Event Date (Optional) / तिथि</label>
                    <input type="text" name="date" id="date" class="form-control" placeholder="e.g. 14-16th June 2026" value="{{ old('date', $slide->date) }}">
                </div>

                <div class="form-group">
                    <label for="location">Event Location (Optional) / स्थान</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="e.g. Palais des Expositions, Nice, France" value="{{ old('location', $slide->location) }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="sort_order">Sort Order / क्रम</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" required value="{{ old('sort_order', $slide->sort_order) }}">
                </div>

                <div class="form-group">
                    <label for="status">Status / स्थिति</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status', $slide->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $slide->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="locale">Language / भाषा</label>
                    <select name="locale" id="locale" class="form-control" required>
                        <option value="en" {{ old('locale', $slide->locale) == 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ old('locale', $slide->locale) == 'hi' ? 'selected' : '' }}>हिन्दी</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="link">Button Redirect Link (Optional) / लिंक</label>
                <input type="url" name="link" id="link" class="form-control" placeholder="e.g. https://example.com/details" value="{{ old('link', $slide->link) }}">
            </div>

            <div class="form-group">
                <label>Current Slide Image / वर्तमान चित्र</label>
                <div style="margin: 10px 0;">
                    @if($slide->image_path)
                        <img src="{{ $slide->image_path }}" alt="Current Image" style="max-width: 300px; max-height: 150px; border-radius: 4px; border: 1px solid var(--border-color); display: block;">
                    @else
                        <span style="font-style: italic; color: var(--text-muted);">No image uploaded</span>
                    @endif
                </div>
                <label for="image">Replace Image (Optional) / नया चित्र चुनें</label>
                <input type="file" name="image" id="image" class="form-control">
                <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Allowed types: jpeg, png, jpg, gif. Recommended aspect ratio: 16:9. Max size: 5MB.</p>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.slides.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-primary">Update Slide</button>
            </div>

        </form>
    </div>

@endsection
