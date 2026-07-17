<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DignitaryController extends Controller
{
    /**
     * Display the Dignitaries management page.
     */
    public function index()
    {
        $dignitaries = Setting::allGrouped('dignitaries');

        return view('admin.dignitaries.index', compact('dignitaries'));
    }

    /**
     * Update the Dignitaries and About Us section settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'dignitary_left_name_en'         => 'required|string|max:255',
            'dignitary_left_name_hi'         => 'required|string|max:255',
            'dignitary_left_designation_en'  => 'required|string|max:255',
            'dignitary_left_designation_hi'  => 'required|string|max:255',
            'dignitary_left_image'           => 'nullable|image|max:10240', // 10MB limit

            'dignitary_right_name_en'        => 'required|string|max:255',
            'dignitary_right_name_hi'        => 'required|string|max:255',
            'dignitary_right_designation_en' => 'required|string|max:255',
            'dignitary_right_designation_hi' => 'required|string|max:255',
            'dignitary_right_image'          => 'nullable|image|max:10240',

            'about_section_title_en'         => 'required|string|max:255',
            'about_section_title_hi'         => 'required|string|max:255',
            'about_section_text_en'          => 'required|string',
            'about_section_text_hi'          => 'required|string',
            'about_section_image'            => 'nullable|image|max:10240',
        ]);

        // Save Text Fields
        $fields = [
            'dignitary_left_name_en',
            'dignitary_left_name_hi',
            'dignitary_left_designation_en',
            'dignitary_left_designation_hi',
            'dignitary_right_name_en',
            'dignitary_right_name_hi',
            'dignitary_right_designation_en',
            'dignitary_right_designation_hi',
            'about_section_title_en',
            'about_section_title_hi',
            'about_section_text_en',
            'about_section_text_hi',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field), 'dignitaries');
        }

        // Handle Image Uploads
        if ($request->hasFile('dignitary_left_image')) {
            $path = $request->file('dignitary_left_image')->store('dignitaries', 'public');
            Setting::set('dignitary_left_image', '/storage/' . $path, 'dignitaries');
        }

        if ($request->hasFile('dignitary_right_image')) {
            $path = $request->file('dignitary_right_image')->store('dignitaries', 'public');
            Setting::set('dignitary_right_image', '/storage/' . $path, 'dignitaries');
        }

        if ($request->hasFile('about_section_image')) {
            $path = $request->file('about_section_image')->store('dignitaries', 'public');
            Setting::set('about_section_image', '/storage/' . $path, 'dignitaries');
        }

        return redirect()->route('admin.dignitaries.index')
            ->with('success', 'Dignitaries and About section updated successfully.');
    }
}
