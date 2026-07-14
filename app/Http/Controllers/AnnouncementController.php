<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the announcements.
     */
    public function index()
    {
        $announcements = Announcement::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created announcement in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'link' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg|max:10240', // up to 10MB
            'icon_type' => 'required|string|in:calendar,star,file,link',
            'is_highlighted' => 'nullable|boolean',
            'sort_order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
            'locale' => 'required|string|in:en,hi',
        ]);

        $validated['is_highlighted'] = $request->has('is_highlighted');

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('announcements', 'public');
            $validated['file_path'] = '/storage/' . $path;
        }

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Show the form for editing the specified announcement.
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified announcement in storage.
     */
    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'link' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg|max:10240',
            'icon_type' => 'required|string|in:calendar,star,file,link',
            'is_highlighted' => 'nullable|boolean',
            'sort_order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
            'locale' => 'required|string|in:en,hi',
        ]);

        $validated['is_highlighted'] = $request->has('is_highlighted');

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($announcement->file_path) {
                $oldPath = str_replace('/storage/', '', $announcement->file_path);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('file')->store('announcements', 'public');
            $validated['file_path'] = '/storage/' . $path;
        }

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement from storage.
     */
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->file_path) {
            $oldPath = str_replace('/storage/', '', $announcement->file_path);
            Storage::disk('public')->delete($oldPath);
        }

        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
