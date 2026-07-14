<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the slides.
     */
    public function index()
    {
        $slides = Slide::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new slide.
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created slide in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Up to 5MB
            'date' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'sort_order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
            'locale' => 'required|string|in:en,hi',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('slides', 'public');
            $validated['image_path'] = '/storage/' . $path;
        }

        Slide::create($validated);

        return redirect()->route('admin.slides.index')->with('success', 'Slide created successfully.');
    }

    /**
     * Show the form for editing the specified slide.
     */
    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * Update the specified slide in storage.
     */
    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'date' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'sort_order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
            'locale' => 'required|string|in:en,hi',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($slide->image_path) {
                $oldPath = str_replace('/storage/', '', $slide->image_path);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('slides', 'public');
            $validated['image_path'] = '/storage/' . $path;
        }

        $slide->update($validated);

        return redirect()->route('admin.slides.index')->with('success', 'Slide updated successfully.');
    }

    /**
     * Remove the specified slide from storage.
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        if ($slide->image_path) {
            $oldPath = str_replace('/storage/', '', $slide->image_path);
            Storage::disk('public')->delete($oldPath);
        }

        $slide->delete();

        return redirect()->route('admin.slides.index')->with('success', 'Slide deleted successfully.');
    }
}
