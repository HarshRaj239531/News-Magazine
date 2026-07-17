@extends('layouts.admin')

@section('header_title', 'Edit Article / Page')

@section('admin_content')

    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Modify Article Details</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Updating the title will automatically update the dynamic URL slug unless the page is already established.</p>
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

        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Article Title / विषय</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter article title" required value="{{ old('title', $article->title) }}">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="category">Category / श्रेणी</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <option value="news" {{ old('category', $article->category) == 'news' ? 'selected' : '' }}>Samachar / Latest News</option>
                        <option value="projects" {{ old('category', $article->category) == 'projects' ? 'selected' : '' }}>Our Projects Details</option>
                        <option value="honours" {{ old('category', $article->category) == 'honours' ? 'selected' : '' }}>Scientific Honours</option>
                        <option value="about" {{ old('category', $article->category) == 'about' ? 'selected' : '' }}>About Us Section Page</option>
                        <option value="epaper" {{ old('category', $article->category) == 'epaper' ? 'selected' : '' }}>E-Paper / Magazine Issue</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published (Active on Site)</option>
                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="locale">Language / भाषा</label>
                    <select name="locale" id="locale" class="form-control" required>
                        <option value="en" {{ old('locale', $article->locale) == 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ old('locale', $article->locale) == 'hi' ? 'selected' : '' }}>हिन्दी</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Replace Banner Image / फोटो (Optional)</label>
                @if($article->image_path)
                    <div style="margin-bottom: 10px;">
                        <span style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 4px;">Current Image:</span>
                        <img src="{{ $article->image_path }}" alt="" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                    </div>
                @endif
                <div class="animated-file-upload">
                    <input type="file" name="image" id="image" accept="image/*">
                    <div class="file-upload-placeholder">
                        <span class="upload-icon">📁</span>
                        <span class="upload-text">Drag & drop or click to replace image</span>
                        <span class="upload-info">Allowed: jpeg, png, jpg, gif (Max: 2MB)</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="pdf">Replace PDF Document / पीडीएफ दस्तावेज (Optional)</label>
                @if($article->pdf_path)
                    <div style="margin-bottom: 12px; background-color: #f8fafc; border: 1px solid var(--border-color); padding: 10px 15px; border-radius: 6px; display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.5rem;">📄</span>
                            <div>
                                <span style="font-size: 0.8rem; font-weight: 600; color: var(--text-dark); display: block;">Attached PDF Document</span>
                                <a href="{{ $article->pdf_path }}" target="_blank" style="font-size: 0.75rem; color: var(--primary-color); text-decoration: underline;">View Current PDF</a>
                            </div>
                        </div>
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 0.8rem; color: #b91c1c; cursor: pointer; margin: 0;">
                            <input type="checkbox" name="remove_pdf" value="1" style="cursor: pointer;">
                            ❌ Remove PDF
                        </label>
                    </div>
                @endif
                <div class="animated-file-upload">
                    <input type="file" name="pdf" id="pdf" accept=".pdf">
                    <div class="file-upload-placeholder">
                        <span class="upload-icon">📄</span>
                        <span class="upload-text">Drag & drop or click to replace PDF document</span>
                        <span class="upload-info">Optional PDF document linked directly on the page (Max: 100MB)</span>
                    </div>
                </div>
            </div>

            <!-- Quill Editor CSS -->
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

            <div class="form-group">
                <label>Article Content / लेख सामग्री (Optional if PDF is uploaded)</label>
                <div id="editorContent" style="height: 350px; background: white; border-radius: 0 0 4px 4px;">{!! old('content', $article->content) !!}</div>
                <input type="hidden" name="content" id="content">
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.articles.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-primary" onclick="copyEditorContent()">Update Article Details</button>
            </div>

            <!-- Quill Editor JS -->
            <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
            <script>
                var quill = new Quill('#editorContent', {
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

                function copyEditorContent() {
                    document.getElementById('content').value = quill.root.innerHTML;
                }
            </script>

        </form>
    </div>

@endsection
