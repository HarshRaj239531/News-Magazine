<?php

namespace App\Http\Controllers;

use App\Models\NavigationMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavigationMenuController extends Controller
{
    /**
     * Display a listing of the menu items.
     */
    public function index()
    {
        // Load parent menus with their children sorted by sort_order
        $menus = NavigationMenu::whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        return view('admin.navigation.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        $parents = NavigationMenu::whereNull('parent_id')->orderBy('sort_order')->get();
        $categories = $this->getDirectoryCategories();
        
        return view('admin.navigation.create', compact('parents', 'categories'));
    }

    /**
     * Store a newly created menu item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hi' => 'required|string|max:255',
            'type' => 'required|string|in:parent,page,directory,url,pdf',
            'parent_id' => 'nullable|exists:navigation_menus,id',
            'url' => 'nullable|string|max:255',
            'directory_category' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'content_hi' => 'nullable|string',
            'layout_type' => 'nullable|string|in:standard,grid,table',
            'sort_order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
            'pdf' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        if (empty($validated['layout_type'])) {
            $validated['layout_type'] = 'standard';
        }

        // Auto-generate slug if type is page
        if ($validated['type'] === 'page') {
            $baseSlug = Str::slug($validated['title_en']);
            $slug = $baseSlug;
            $count = 1;
            while (NavigationMenu::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = null;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('navigation/pdfs', 'public');
            $validated['pdf_path'] = '/storage/' . $pdfPath;
        }

        NavigationMenu::create($validated);

        return redirect()->route('admin.navigation.index')->with('success', 'Navbar item created successfully.');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit($id)
    {
        $menu = NavigationMenu::findOrFail($id);
        $parents = NavigationMenu::whereNull('parent_id')
            ->where('id', '!=', $id) // Prevent selecting self as parent
            ->orderBy('sort_order')
            ->get();
        $categories = $this->getDirectoryCategories();

        return view('admin.navigation.edit', compact('menu', 'parents', 'categories'));
    }

    /**
     * Update the specified menu item in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = NavigationMenu::findOrFail($id);

        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hi' => 'required|string|max:255',
            'type' => 'required|string|in:parent,page,directory,url,pdf',
            'parent_id' => 'nullable|exists:navigation_menus,id',
            'url' => 'nullable|string|max:255',
            'directory_category' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'content_hi' => 'nullable|string',
            'layout_type' => 'nullable|string|in:standard,grid,table',
            'sort_order' => 'required|integer',
            'status' => 'required|string|in:draft,published',
            'pdf' => 'nullable|file|mimes:pdf|max:102400',
        ]);

        if (empty($validated['layout_type'])) {
            $validated['layout_type'] = 'standard';
        }

        // Auto-generate or update slug if type is page and title has changed
        if ($validated['type'] === 'page') {
            if (!$menu->slug || $menu->title_en !== $validated['title_en']) {
                $baseSlug = Str::slug($validated['title_en']);
                $slug = $baseSlug;
                $count = 1;
                while (NavigationMenu::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                    $slug = $baseSlug . '-' . $count;
                    $count++;
                }
                $validated['slug'] = $slug;
            }
        } else {
            $validated['slug'] = null;
        }

        // Prevent setting a child as its own parent or setting parent if it has children
        if ($validated['parent_id'] && $validated['parent_id'] == $id) {
            return back()->withErrors(['parent_id' => 'An item cannot be its own parent.'])->withInput();
        }

        $removePdf = $request->boolean('remove_pdf');
        if ($request->hasFile('pdf')) {
            if ($menu->pdf_path) {
                $oldPdfPath = str_replace('/storage/', '', $menu->pdf_path);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPdfPath);
            }
            $pdfPath = $request->file('pdf')->store('navigation/pdfs', 'public');
            $validated['pdf_path'] = '/storage/' . $pdfPath;
        } elseif ($removePdf) {
            if ($menu->pdf_path) {
                $oldPdfPath = str_replace('/storage/', '', $menu->pdf_path);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPdfPath);
            }
            $validated['pdf_path'] = null;
        }

        $menu->update($validated);

        return redirect()->route('admin.navigation.index')->with('success', 'Navbar item updated successfully.');
    }

    /**
     * Remove the specified menu item from storage.
     */
    public function destroy($id)
    {
        $menu = NavigationMenu::findOrFail($id);
        
        if ($menu->pdf_path) {
            $oldPdfPath = str_replace('/storage/', '', $menu->pdf_path);
            \Illuminate\Support\Facades\Storage::disk('public')->delete($oldPdfPath);
        }

        $menu->delete();

        return redirect()->route('admin.navigation.index')->with('success', 'Navbar item and all its children deleted successfully.');
    }

    /**
     * Map of directory categories to align with existing setup.
     */
    private function getDirectoryCategories(): array
    {
        return [
            'national-parliamentary-board' => 'National Parliamentary Board - राष्ट्रीय संसदीय बोर्ड',
            'publishers' => "Publisher's Details - प्रकाशक विवरण",
            'prime-editor' => 'Prime Editor - प्रधान संपादक',
            'printers' => "Vigyanmev Jayate Printer's - मुद्रक विवरण",
            'honours' => 'Vigyanmev Jayate Honours - वैज्ञानिक सम्मान',
            'authorized-persons' => "Authorized Person's - अधिकृत व्यक्ति",
            'advocates' => 'Advocates & Legal Advisors - अधिवक्ता और सलाहकार',
            'state-news-editors' => 'State News Editors - राज्य संपादक',
            'state-press-club-presidents' => 'State Press Club Presidents - राज्य प्रेस अध्यक्ष',
            'commissionery-presidents' => 'Commissionery Presidents - आयुक्त मंडल अध्यक्ष',
            'women-press-club' => "Women's Press Club - महिला प्रेस क्लब",
            'engineers' => 'Our Digital AI & Software Engineers - सॉफ्टवेयर इंजीनियर्स',
            'district-press-club' => 'District Press Club Presidents - जिला प्रेस अध्यक्ष',
            'district-news-bureau' => 'District News Bureau - जिला ब्यूरो सचिव',
            'subdivision-press-club' => 'Subdivision Press Club - अनुमंडल प्रेस क्लब',
            'block-press-club' => 'Block Press Club - ब्लॉक प्रेस क्लब',
            'panchayat-press-club' => 'Panchayat Press Club - पंचायत प्रेस क्लब',
            'news-bureau' => 'News Bureau Details - समाचार ब्यूरो विवरण',
            'translators' => 'Language Translators - भाषा अनुवादक',
            'documentary-films' => 'Our Documentary Films - वृत्तचित्र फिल्म',
            'youtubers' => 'Youtub Press Club - यूट्यूबर्स प्रेस क्लब',
            'media-training' => 'Print/Electronics Media Training - मीडिया प्रशिक्षण',
            'social-media-training' => 'Digital Social Media Training - डिजिटल मीडिया प्रशिक्षण',
            'schools-colleges' => 'Our Schools & Colleges - हमारे स्कूल और कॉलेज',
            'offices' => "Our Press Club Office's - प्रेस क्लब कार्यालय",
            'subscribers' => 'Magazine Subscribers - पत्रिका ग्राहक',
            'life-members' => "Life Members - आजीवन सदस्य",
            'e-papers-magazines' => "E-Papers & Magazines - ई-पेपर और पत्रिकाएं",
            'photos-gallery' => 'Photo Gallery - फोटो गैलरी',
            'advertisements-gallery' => 'Advertisement Gallery - विज्ञापन गैलरी',
        ];
    }
}
