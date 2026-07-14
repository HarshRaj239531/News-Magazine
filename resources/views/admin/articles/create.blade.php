@extends('layouts.admin')

@section('header_title', 'Write New News / Article')

@section('admin_content')

    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Create Dynamic Article</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Enter details below. Saving will generate an automatic URL slug and dynamic page.</p>
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

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Article Title / विषय</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter article title" required value="{{ old('title') }}">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="category">Category / श्रेणी</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <option value="news" {{ old('category') == 'news' ? 'selected' : '' }}>Samachar / Latest News</option>
                        <option value="projects" {{ old('category') == 'projects' ? 'selected' : '' }}>Our Projects Details</option>
                        <option value="honours" {{ old('category') == 'honours' ? 'selected' : '' }}>Scientific Honours</option>
                        <option value="about" {{ old('category') == 'about' ? 'selected' : '' }}>About Us Section Page</option>
                        <option value="epaper" {{ old('category') == 'epaper' ? 'selected' : '' }}>E-Paper / Magazine Issue</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Active on Site)</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
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

            <div class="form-group">
                <label for="image">Upload Banner Image / फोटो (Optional)</label>
                <input type="file" name="image" id="image" class="form-control">
                <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Allowed types: jpeg, png, jpg, gif. Max size: 2MB.</p>
            </div>

            <div class="form-group">
                <label for="content">Article Content / लेख सामग्री</label>
                <textarea name="content" id="content" rows="12" class="form-control" placeholder="Write or paste your article content here..." required style="resize: vertical;">{{ old('content') }}</textarea>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.articles.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-primary">Save and Publish Page</button>
            </div>

        </form>
    </div>

@endsection
