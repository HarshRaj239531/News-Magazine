@extends('layouts.admin')

@section('header_title', 'Add New Directory / Press Club Member')

@section('admin_content')

    <div class="admin-card" style="max-width: 750px; margin: 0 auto;">
        <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h3 style="color: var(--primary-color);">Add Committee / Board Member</h3>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Assign the profile to any of the 37 categories, representing National Boards, state editors, subdivision press clubs, advocates, or local bureaus.</p>
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

        <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="name">Member Name / नाम</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="designation">Designation / पद</label>
                    <input type="text" name="designation" id="designation" class="form-control" placeholder="e.g. Chief Editor, President, Secretary" required value="{{ old('designation') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="category">Directory Category / श्रेणी</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="">-- Select Board / Press Club Directory --</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
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

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="state">State / राज्य (Optional)</label>
                    <input type="text" name="state" id="state" class="form-control" placeholder="e.g. Uttar Pradesh, Delhi" value="{{ old('state') }}">
                </div>

                <div class="form-group">
                    <label for="district">District / जिला (Optional)</label>
                    <input type="text" name="district" id="district" class="form-control" placeholder="e.g. Lucknow, Kanpur" value="{{ old('district') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="photo">Member Photo / फोटो (Optional)</label>
                <input type="file" name="photo" id="photo" class="form-control">
                <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Allowed formats: jpeg, png, jpg. Max file size: 1MB.</p>
            </div>

            <div class="form-group">
                <label for="contact_info">Contact & Address Details / संपर्क विवरण</label>
                <textarea name="contact_info" id="contact_info" rows="5" class="form-control" placeholder="Email: example@gmail.com&#10;Phone: +91-9876543210&#10;Office Address details..." style="resize: vertical;">{{ old('contact_info') }}</textarea>
            </div>

            <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                <a href="{{ route('admin.members.index') }}" class="btn-action" style="background-color: #cbd5e1; color: #334155; padding: 10px 20px; border-radius: 4px; font-weight: bold; font-size: 0.85rem;">Cancel</a>
                <button type="submit" class="btn-primary">Save Member Profile</button>
            </div>

        </form>
    </div>

@endsection
