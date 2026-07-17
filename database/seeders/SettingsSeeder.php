<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // --- GENERAL SETTINGS ---
        $general = [
            'site_name'         => 'VIGYANMEV JAYATE',
            'site_tagline'      => 'विज्ञानमेव जयते – NATIONAL HINDI ENGLISH MONTHLY SCIENTIFIC MAGAZINE UNITED STATES OF INDIA',
            'copyright_text'    => '© ' . date('Y') . ' VIGYANMEV JAYATE - विज्ञानमेव जयते. All Rights Reserved.',
        ];
        foreach ($general as $key => $value) {
            Setting::set($key, $value, 'general');
        }

        // --- FOOTER SETTINGS ---
        $footer = [
            'footer_about_text' => 'NATIONAL HINDI ENGLISH MONTHLY SCIENTIFIC MAGAZINE UNITED STATES OF INDIA, bringing the latest discoveries, technological innovations, and scientific reports in regional Indian languages.',

            // Useful Links: JSON array of {label, url}
            'footer_useful_links' => json_encode([
                ['label' => 'Home',            'url' => '/'],
                ['label' => 'About Us',        'url' => '/pages/about-us'],
                ['label' => 'Online Payments', 'url' => '/online-payments'],
                ['label' => 'Contact Us',      'url' => '/contact-us'],
            ]),

            // Directory Links: JSON array of {label, slug}
            'footer_directory_links' => json_encode([
                ['label' => 'Parliamentary Board',   'slug' => 'national-parliamentary-board'],
                ['label' => 'Legal Advisors',        'slug' => 'advocates'],
                ['label' => 'State Press Presidents', 'slug' => 'state-press-club-presidents'],
                ['label' => 'Software Engineers',    'slug' => 'engineers'],
            ]),

            // Contact Info
            'footer_contact_name'    => "Vigyanmev Jayate\nPress Club Head Office",
            'footer_contact_city'    => 'New Delhi, India',
            'footer_contact_email'   => 'contact@vigyanmev.gov.in',
            'footer_contact_phone'   => '+91-11-23091122',
        ];
        foreach ($footer as $key => $value) {
            Setting::set($key, $value, 'footer');
        }

        // --- SOCIAL LINKS ---
        $social = [
            'social_facebook'  => '',
            'social_twitter'   => '',
            'social_youtube'   => '',
            'social_instagram' => '',
        ];
        foreach ($social as $key => $value) {
            Setting::set($key, $value, 'social');
        }

        // --- DIGNITARIES & ABOUT US ---
        $dignitaries = [
            'dignitary_left_name_en'         => 'Shri Narendra Modi',
            'dignitary_left_name_hi'         => 'श्री नरेन्द्र मोदी',
            'dignitary_left_designation_en'  => "Hon'ble Prime Minister",
            'dignitary_left_designation_hi'  => 'माननीय प्रधानमंत्री',
            'dignitary_left_image'           => '/images/dignitary_left.png',

            'dignitary_right_name_en'        => 'Dr. Jitendra Singh',
            'dignitary_right_name_hi'        => 'डॉ जितेंद्र सिंह',
            'dignitary_right_designation_en' => "Hon'ble Minister of State (Independent Charge) of the Ministry of Science and Technology",
            'dignitary_right_designation_hi' => 'माननीय राज्य मंत्री (स्वतंत्र प्रभार) विज्ञान और प्रौद्योगिकी मंत्रालय',
            'dignitary_right_image'          => '/images/dignitary_right.png',

            'about_section_title_en'         => 'About Us',
            'about_section_title_hi'         => 'हमारे बारे में',
            'about_section_text_en'          => 'India is one of the top-ranking countries in the field of basic research. Indian Science has come to be regarded as one of the most powerful instruments of growth and development, especially in the emerging scenario and competitive economy. In the wake of the recent developments and the new demands that are being placed on the S&T system, it is necessary for us to embark on some major science projects which have relevance to national needs and which will also be relevant for tomorrow\'s technology. The Department of Science & Technology plays a pivotal role in promotion of science & technology in the country.',
            'about_section_text_hi'          => 'भारत बुनियादी अनुसंधान के क्षेत्र में शीर्ष रैंकिंग वाले देशों में से एक है। भारतीय विज्ञान को विकास और प्रगति के सबसे शक्तिशाली उपकरणों में से एक माना जाने लगा है, विशेष रूप से उभरते परिदृश्य और प्रतिस्पर्धी अर्थव्यवस्था में। हाल के घटनाक्रमों और विज्ञान एवं प्रौद्योगिकी प्रणाली पर की जा रही नई मांगों के मद्देनजर, हमारे लिए कुछ ऐसे प्रमुख विज्ञान प्रोजेक्ट्स शुरू करना आवश्यक है जो राष्ट्रीय आवश्यकताओं के लिए प्रासंगिक हों और जो कल की तकनीक के लिए भी प्रासंगिक हों। विज्ञान और प्रौद्योगिकी विभाग देश में विज्ञान और प्रौद्योगिकी को बढ़ावा देने में महत्वपूर्ण भूमिका निभाता है।',
            'about_section_image'            => '/images/about_banner.png',
        ];
        foreach ($dignitaries as $key => $value) {
            Setting::set($key, $value, 'dignitaries');
        }
    }
}
