<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing items
        NavigationMenu::truncate();

        // 1. Parent: About Us
        $about = NavigationMenu::create([
            'title_en' => 'About Us',
            'title_hi' => 'हमारे बारे में',
            'type' => 'parent',
            'sort_order' => 1,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $about->id,
            'title_en' => 'Our Profile & History',
            'title_hi' => 'हमारी रूपरेखा और इतिहास',
            'type' => 'page',
            'slug' => 'about-us',
            'content_en' => '<h1>Our Profile & History</h1><p>Welcome to <strong>Vigyanmev Jayate</strong>, the premier national scientific magazine. You can edit this page content anytime in the Admin panel under Navbar & Pages.</p>',
            'content_hi' => '<h1>हमारी रूपरेखा और इतिहास</h1><p>वैज्ञानिक पत्रिका <strong>विज्ञानमेव जयते</strong> में आपका स्वागत है। आप इस पृष्ठ की सामग्री को कभी भी नेविगेशन और पेज बिल्डर के तहत संपादित कर सकते हैं।</p>',
            'layout_type' => 'standard',
            'sort_order' => 1,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $about->id,
            'title_en' => 'National Parliamentary Board',
            'title_hi' => 'राष्ट्रीय संसदीय बोर्ड',
            'type' => 'directory',
            'directory_category' => 'national-parliamentary-board',
            'sort_order' => 2,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $about->id,
            'title_en' => 'Prime Editor',
            'title_hi' => 'प्रधान संपादक',
            'type' => 'directory',
            'directory_category' => 'prime-editor',
            'sort_order' => 3,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $about->id,
            'title_en' => 'Publishers Details',
            'title_hi' => 'प्रकाशक विवरण',
            'type' => 'directory',
            'directory_category' => 'publishers',
            'sort_order' => 4,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $about->id,
            'title_en' => 'Printers Details',
            'title_hi' => 'मुद्रक विवरण',
            'type' => 'directory',
            'directory_category' => 'printers',
            'sort_order' => 5,
            'status' => 'published',
        ]);

        // 2. Parent: Boards & Advisors
        $boards = NavigationMenu::create([
            'title_en' => 'Boards & Advisors',
            'title_hi' => 'बोर्ड और सलाहकार',
            'type' => 'parent',
            'sort_order' => 2,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $boards->id,
            'title_en' => 'Authorized Persons',
            'title_hi' => 'अधिकृत व्यक्ति',
            'type' => 'directory',
            'directory_category' => 'authorized-persons',
            'sort_order' => 1,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $boards->id,
            'title_en' => 'Advocates & Legal Advisors',
            'title_hi' => 'अधिवक्ता और कानूनी सलाहकार',
            'type' => 'directory',
            'directory_category' => 'advocates',
            'sort_order' => 2,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $boards->id,
            'title_en' => 'AI & Software Engineers',
            'title_hi' => 'एआई और सॉफ्टवेयर इंजीनियर्स',
            'type' => 'directory',
            'directory_category' => 'engineers',
            'sort_order' => 3,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $boards->id,
            'title_en' => 'Language Translators',
            'title_hi' => 'भाषा अनुवादक',
            'type' => 'directory',
            'directory_category' => 'translators',
            'sort_order' => 4,
            'status' => 'published',
        ]);

        // 3. Parent: Press Clubs
        $press = NavigationMenu::create([
            'title_en' => 'Press Clubs',
            'title_hi' => 'प्रेस क्लब',
            'type' => 'parent',
            'sort_order' => 3,
            'status' => 'published',
        ]);

        $pressClubs = [
            ['State Press Club Presidents', 'राज्य प्रेस क्लब अध्यक्ष', 'state-press-club-presidents', 1],
            ['Commissionery Presidents', 'आयुक्त मंडल अध्यक्ष', 'commissionery-presidents', 2],
            ['Women Press Club', 'महिला प्रेस क्लब अध्यक्ष और सचिव', 'women-press-club', 3],
            ['District Press Club Presidents', 'जिला प्रेस क्लब अध्यक्ष', 'district-press-club', 4],
            ['District News Bureau Secretaries', 'जिला समाचार ब्यूरो सचिव', 'district-news-bureau', 5],
            ['Subdivision Press Clubs', 'अनुमंडल प्रेस क्लब अध्यक्ष और ब्यूरो', 'subdivision-press-club', 6],
            ['Block Press Clubs', 'ब्लॉक प्रेस क्लब अध्यक्ष, सचिव और ब्यूरो', 'block-press-club', 7],
            ['Panchayat Press Clubs', 'पंचायत प्रेस क्लब अध्यक्ष और सचिव', 'panchayat-press-club', 8],
            ['Youtubers Press Club', 'यूट्यूबर्स प्रेस क्लब विवरण', 'youtubers', 9],
            ['Our Press Club Offices', 'हमारे प्रेस क्लब कार्यालय', 'offices', 10],
        ];

        foreach ($pressClubs as $pc) {
            NavigationMenu::create([
                'parent_id' => $press->id,
                'title_en' => $pc[0],
                'title_hi' => $pc[1],
                'type' => 'directory',
                'directory_category' => $pc[2],
                'sort_order' => $pc[3],
                'status' => 'published',
            ]);
        }

        // 4. Parent: Media & News
        $media = NavigationMenu::create([
            'title_en' => 'Media & News',
            'title_hi' => 'मीडिया और समाचार',
            'type' => 'parent',
            'sort_order' => 4,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $media->id,
            'title_en' => 'Latest Samachar/News',
            'title_hi' => 'नवीनतम समाचार',
            'type' => 'url',
            'url' => '/#news',
            'sort_order' => 1,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $media->id,
            'title_en' => 'State News Editors',
            'title_hi' => 'राज्य समाचार संपादक',
            'type' => 'directory',
            'directory_category' => 'state-news-editors',
            'sort_order' => 2,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $media->id,
            'title_en' => 'News Bureau Details',
            'title_hi' => 'समाचार ब्यूरो विवरण',
            'type' => 'directory',
            'directory_category' => 'news-bureau',
            'sort_order' => 3,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $media->id,
            'title_en' => 'Documentary Films & Cast',
            'title_hi' => 'हमारे वृत्तचित्र फिल्म',
            'type' => 'directory',
            'directory_category' => 'documentary-films',
            'sort_order' => 4,
            'status' => 'published',
        ]);

        // 5. Parent: Training & Education
        $training = NavigationMenu::create([
            'title_en' => 'Training & Education',
            'title_hi' => 'प्रशिक्षण और शिक्षा',
            'type' => 'parent',
            'sort_order' => 5,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $training->id,
            'title_en' => 'Print & Electronics Training',
            'title_hi' => 'प्रिंट और इलेक्ट्रॉनिक्स मीडिया केंद्र',
            'type' => 'directory',
            'directory_category' => 'media-training',
            'sort_order' => 1,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $training->id,
            'title_en' => 'Digital Media Training Centres',
            'title_hi' => 'डिजिटल सोशल मीडिया प्रशिक्षण केंद्र',
            'type' => 'directory',
            'directory_category' => 'social-media-training',
            'sort_order' => 2,
            'status' => 'published',
        ]);

        NavigationMenu::create([
            'parent_id' => $training->id,
            'title_en' => 'Our Schools & Colleges',
            'title_hi' => 'हमारे स्कूल और कॉलेज',
            'type' => 'directory',
            'directory_category' => 'schools-colleges',
            'sort_order' => 3,
            'status' => 'published',
        ]);

        // 6. Parent: Publications
        $publications = NavigationMenu::create([
            'title_en' => 'Publications',
            'title_hi' => 'प्रकाशन',
            'type' => 'parent',
            'sort_order' => 6,
            'status' => 'published',
        ]);

        $pubItems = [
            ['E-Papers & Magazines', 'ई-पेपर और पत्रिकाएं', 'e-papers-magazines', 1],
            ['Magazine Subscribers', 'पत्रिका ग्राहक और लाइफ टाइम', 'subscribers', 2],
            ['Life Members & Donors', 'आजीव सदस्य और दानदाता', 'life-members', 3],
            ['Photo Gallery', 'फोटो गैलरी', 'photos-gallery', 4],
            ['Advertisements Gallery', 'विज्ञापन गैलरी', 'advertisements-gallery', 5],
            ['Scientific Honours', 'वैज्ञानिक सम्मान', 'honours', 6],
        ];

        foreach ($pubItems as $pi) {
            NavigationMenu::create([
                'parent_id' => $publications->id,
                'title_en' => $pi[0],
                'title_hi' => $pi[1],
                'type' => 'directory',
                'directory_category' => $pi[2],
                'sort_order' => $pi[3],
                'status' => 'published',
            ]);
        }

        // 7. Non-Dropdown: Payments
        NavigationMenu::create([
            'title_en' => 'Payments',
            'title_hi' => 'भुगतान',
            'type' => 'url',
            'url' => '/online-payments',
            'sort_order' => 7,
            'status' => 'published',
        ]);

        // 8. Non-Dropdown: Contact Us
        NavigationMenu::create([
            'title_en' => 'Contact Us',
            'title_hi' => 'संपर्क करें',
            'type' => 'url',
            'url' => '/contact-us',
            'sort_order' => 8,
            'status' => 'published',
        ]);
    }
}
