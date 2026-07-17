<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Member;
use App\Models\Slide;
use App\Models\Announcement;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display the DST-style homepage.
     */
    public function home()
    {
        $news = Article::where('category', 'news')
            ->where('status', 'published')
            ->where('locale', app()->getLocale())
            ->latest()
            ->take(6)
            ->get();

        $projects = Article::where('category', 'projects')
            ->where('status', 'published')
            ->where('locale', app()->getLocale())
            ->latest()
            ->take(4)
            ->get();

        $honours = Article::where('category', 'honours')
            ->where('status', 'published')
            ->where('locale', app()->getLocale())
            ->latest()
            ->take(3)
            ->get();

        // Get a ticker list of recent titles for the active locale
        $ticker = Article::where('status', 'published')
            ->where('locale', app()->getLocale())
            ->latest()
            ->take(5)
            ->pluck('title');

        // Get slides for the active locale
        $slides = Slide::where('status', 'published')
            ->where('locale', app()->getLocale())
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get announcements for the active locale
        $announcements = Announcement::where('status', 'published')
            ->where('locale', app()->getLocale())
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        $dignitaries = \App\Models\Setting::allGrouped('dignitaries');

        return view('home', compact('news', 'projects', 'honours', 'ticker', 'slides', 'announcements', 'dignitaries'));
    }

    /**
     * Show a dynamic article or custom topic.
     */
    public function newsDetail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('news-detail', compact('article'));
    }

    /**
     * Unified method to handle all 37+ directory boards and lists dynamically.
     */
    public function directory($category)
    {
        $categoryMap = $this->getCategoryMap();

        if (!array_key_exists($category, $categoryMap)) {
            abort(404, 'Page not found');
        }

        $title = $categoryMap[$category];
        $members = Member::where('category', $category)
            ->where('locale', app()->getLocale())
            ->latest()
            ->get();

        // Check if category is specialized (like epapers, gallery, etc.)
        if ($category === 'e-papers-magazines') {
            $epapers = Article::where('category', 'epaper')
                ->where('status', 'published')
                ->where('locale', app()->getLocale())
                ->latest()
                ->get();
            return view('frontend.epapers', compact('epapers', 'title'));
        }

        return view('directory', compact('members', 'category', 'title'));
    }

    /**
     * Render the payments page.
     */
    public function payments()
    {
        return view('payments');
    }

    /**
     * Render the contact page.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Help map of all requested pages to Hindi/English titles.
     */
    private function getCategoryMap(): array
    {
        return [
            'national-parliamentary-board' => 'National Parliamentary Board - राष्ट्रीय संसदीय बोर्ड',
            'publishers' => "Publisher's Details - प्रकाशक विवरण",
            'prime-editor' => 'Prime Editor - प्रधान संपादक',
            'printers' => "Vigyanmev Jayate Printer's - मुद्रक विवरण",
            'honours' => 'Vigyanmev Jayate Honours - वैज्ञानिक सम्मान',
            'authorized-persons' => "Authorized Person's - अधिकृत व्यक्ति",
            'advocates' => 'Advocates & Legal Advisors - अधिवक्ता और कानूनी सलाहकार',
            'state-news-editors' => 'State News Editors - राज्य समाचार संपादक',
            'state-press-club-presidents' => 'State Press Club Presidents - राज्य प्रेस क्लब अध्यक्ष',
            'commissionery-presidents' => 'Commissionery Presidents - आयुक्त मंडल अध्यक्ष',
            'women-press-club' => "Women's Press Club Presidents & Secretaries - महिला प्रेस क्लब अध्यक्ष और सचिव",
            'engineers' => 'Our Digital AI Computers & Software Engineers - डिजिटल एआई कंप्यूटर और सॉफ्टवेयर इंजीनियर्स',
            'district-press-club' => 'District Press Club Presidents - जिला प्रेस क्लब अध्यक्ष',
            'district-news-bureau' => 'District News Bureau Secretaries - जिला समाचार ब्यूरो सचिव',
            'subdivision-press-club' => 'Subdivision Press Club Presidents & Bureau - अनुमंडल प्रेस क्लब अध्यक्ष और ब्यूरो',
            'block-press-club' => 'Block Press Club Presidents, Secretaries & Bureau - ब्लॉक प्रेस क्लब अध्यक्ष, सचिव और ब्यूरो',
            'panchayat-press-club' => 'Panchayat Press Club Presidents & Secretaries - पंचायत प्रेस क्लब अध्यक्ष और सचिव',
            'news-bureau' => 'News Bureau Details - समाचार ब्यूरो विवरण',
            'translators' => 'Language Translators - भाषा अनुवादक',
            'documentary-films' => 'Our Documentary Films, Actors & Actresses - हमारे वृत्तचित्र फिल्म, अभिनेता और अभिनेत्री',
            'youtubers' => 'Youtubs Press Club Details - यूट्यूबर्स प्रेस क्लब विवरण',
            'media-training' => 'Print and Electronics Media Training Centres - प्रिंट और इलेक्ट्रॉनिक्स मीडिया प्रशिक्षण केंद्र',
            'social-media-training' => 'Digital Social Media Training Centres - डिजिटल सोशल मीडिया प्रशिक्षण केंद्र',
            'schools-colleges' => 'Our Schools & Colleges - हमारे स्कूल और कॉलेज',
            'offices' => "Our Press Club Office's - हमारे प्रेस क्लब कार्यालय",
            'subscribers' => 'Magazine Subscribers & Life Times - पत्रिका ग्राहक और लाइफ टाइम',
            'life-members' => "Life Members & Donors' Details - आजीवन सदस्य और दानदाता विवरण",
            'e-papers-magazines' => "E-Papers & Magazines - ई-पेपर और पत्रिकाएं",
            'photos-gallery' => 'Photo Gallery - फोटो गैलरी',
            'advertisements-gallery' => 'Advertisement Gallery - विज्ञापन गैलरी',
        ];
    }

    /**
     * Show a dynamic page built by the administrator.
     */
    public function showPage($slug)
    {
        $page = \App\Models\NavigationMenu::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        if ($page->type !== 'page') {
            abort(404, 'Page not found');
        }

        return view('page-detail', compact('page'));
    }

    /**
     * Show the embedded PDF document inside the website layout.
     */
    public function viewPdf(Request $request)
    {
        $file = $request->query('file');

        if (empty($file)) {
            abort(404, 'PDF file not specified');
        }

        return view('pdf-viewer', compact('file'));
    }
}
