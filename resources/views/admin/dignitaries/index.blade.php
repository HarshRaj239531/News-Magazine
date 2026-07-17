@extends('layouts.admin')

@section('header_title', '👤 Hon\'ble Dignitaries & About Us')

@section('admin_content')

<div class="admin-card" style="max-width: 1000px; margin: 0 auto;">
    <div style="margin-bottom: 25px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
        <h3 style="color: var(--primary-color);">Manage Dignitaries & Home About Section</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted);">
            Update the Hon'ble Prime Minister, Minister, and center About Us banner details rendered on the home page.
        </p>
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

    <form action="{{ route('admin.dignitaries.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 30px;">
            
            <!-- LEFT DIGNITARY -->
            <div style="background: var(--body-bg); padding: 20px; border: 1px solid var(--border-color); border-radius: 8px;">
                <h4 style="color: var(--primary-color); margin-bottom: 15px; border-bottom: 2px solid var(--primary-color); padding-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                    <span>👈</span> Left Dignitary / बायाँ पदाधिकारी
                </h4>
                
                <div class="form-group">
                    <label>Name (English) / नाम (अंग्रेज़ी) *</label>
                    <input type="text" name="dignitary_left_name_en" class="form-control" required value="{{ old('dignitary_left_name_en', $dignitaries['dignitary_left_name_en'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Name (Hindi) / नाम (हिन्दी) *</label>
                    <input type="text" name="dignitary_left_name_hi" class="form-control" required value="{{ old('dignitary_left_name_hi', $dignitaries['dignitary_left_name_hi'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Designation (English) / पद (अंग्रेज़ी) *</label>
                    <input type="text" name="dignitary_left_designation_en" class="form-control" required value="{{ old('dignitary_left_designation_en', $dignitaries['dignitary_left_designation_en'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Designation (Hindi) / पद (हिन्दी) *</label>
                    <input type="text" name="dignitary_left_designation_hi" class="form-control" required value="{{ old('dignitary_left_designation_hi', $dignitaries['dignitary_left_designation_hi'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Profile Image / प्रोफाइल फोटो</label>
                    @if($dignitaries['dignitary_left_image'] ?? null)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ $dignitaries['dignitary_left_image'] }}" alt="Left Dignitary" style="height: 80px; border-radius: 4px; border: 1px solid var(--border-color); object-fit: cover;">
                        </div>
                    @endif
                    <div class="animated-file-upload">
                        <input type="file" name="dignitary_left_image" id="dignitary_left_image" accept="image/*">
                        <div class="file-upload-placeholder">
                            <span class="upload-icon">📷</span>
                            <span class="upload-text">Upload new profile photo</span>
                            <span class="upload-info">JPEG, PNG, WebP (Max: 10MB)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT DIGNITARY -->
            <div style="background: var(--body-bg); padding: 20px; border: 1px solid var(--border-color); border-radius: 8px;">
                <h4 style="color: var(--primary-color); margin-bottom: 15px; border-bottom: 2px solid var(--primary-color); padding-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                    <span>👉</span> Right Dignitary / दायाँ पदाधिकारी
                </h4>
                
                <div class="form-group">
                    <label>Name (English) / नाम (अंग्रेज़ी) *</label>
                    <input type="text" name="dignitary_right_name_en" class="form-control" required value="{{ old('dignitary_right_name_en', $dignitaries['dignitary_right_name_en'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Name (Hindi) / नाम (हिन्दी) *</label>
                    <input type="text" name="dignitary_right_name_hi" class="form-control" required value="{{ old('dignitary_right_name_hi', $dignitaries['dignitary_right_name_hi'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Designation (English) / पद (अंग्रेज़ी) *</label>
                    <input type="text" name="dignitary_right_designation_en" class="form-control" required value="{{ old('dignitary_right_designation_en', $dignitaries['dignitary_right_designation_en'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Designation (Hindi) / पद (हिन्दी) *</label>
                    <input type="text" name="dignitary_right_designation_hi" class="form-control" required value="{{ old('dignitary_right_designation_hi', $dignitaries['dignitary_right_designation_hi'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Profile Image / प्रोफाइल फोटो</label>
                    @if($dignitaries['dignitary_right_image'] ?? null)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ $dignitaries['dignitary_right_image'] }}" alt="Right Dignitary" style="height: 80px; border-radius: 4px; border: 1px solid var(--border-color); object-fit: cover;">
                        </div>
                    @endif
                    <div class="animated-file-upload">
                        <input type="file" name="dignitary_right_image" id="dignitary_right_image" accept="image/*">
                        <div class="file-upload-placeholder">
                            <span class="upload-icon">📷</span>
                            <span class="upload-text">Upload new profile photo</span>
                            <span class="upload-info">JPEG, PNG, WebP (Max: 10MB)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- CENTER ABOUT US CONTENT -->
        <div style="background: var(--body-bg); padding: 25px; border: 1px solid var(--border-color); border-radius: 8px; margin-bottom: 30px;">
            <h4 style="color: var(--primary-color); margin-bottom: 15px; border-bottom: 2px solid var(--primary-color); padding-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                <span>🏢</span> Center About Us / परिचय अनुभाग
            </h4>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>About Us Heading (English) / शीर्षक (अंग्रेज़ी) *</label>
                    <input type="text" name="about_section_title_en" class="form-control" required value="{{ old('about_section_title_en', $dignitaries['about_section_title_en'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>About Us Heading (Hindi) / शीर्षक (हिन्दी) *</label>
                    <input type="text" name="about_section_title_hi" class="form-control" required value="{{ old('about_section_title_hi', $dignitaries['about_section_title_hi'] ?? '') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Introductory Paragraph (English) / संक्षिप्त परिचय (अंग्रेज़ी) *</label>
                <textarea name="about_section_text_en" rows="5" class="form-control" required style="resize: vertical;">{{ old('about_section_text_en', $dignitaries['about_section_text_en'] ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Introductory Paragraph (Hindi) / संक्षिप्त परिचय (हिन्दी) *</label>
                <textarea name="about_section_text_hi" rows="5" class="form-control" required style="resize: vertical;">{{ old('about_section_text_hi', $dignitaries['about_section_text_hi'] ?? '') }}</textarea>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label>About Section Banner Image / परिचय बैनर फोटो</label>
                @if($dignitaries['about_section_image'] ?? null)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $dignitaries['about_section_image'] }}" alt="About Us Banner" style="height: 120px; border-radius: 4px; border: 1px solid var(--border-color); object-fit: contain;">
                    </div>
                @endif
                <div class="animated-file-upload">
                    <input type="file" name="about_section_image" id="about_section_image" accept="image/*">
                    <div class="file-upload-placeholder">
                        <span class="upload-icon">🖼️</span>
                        <span class="upload-text">Upload new banner graphic (e.g. Mann Ki Baat)</span>
                        <span class="upload-info">JPEG, PNG, WebP (Max: 10MB)</span>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; border-top: 1px solid var(--border-color); padding-top: 20px;">
            <button type="submit" class="btn-primary" style="padding: 14px 45px; font-size: 1rem;">
                💾 Save Changes & Update Website
            </button>
        </div>

    </form>
</div>

@endsection
