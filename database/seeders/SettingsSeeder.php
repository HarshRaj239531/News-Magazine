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
            'site_tagline'      => 'विज्ञानमेव जयते – National Hindi-English Scientific Magazine of India',
            'copyright_text'    => '© ' . date('Y') . ' VIGYANMEV JAYATE - विज्ञानमेव जयते. All Rights Reserved.',
        ];
        foreach ($general as $key => $value) {
            Setting::set($key, $value, 'general');
        }

        // --- FOOTER SETTINGS ---
        $footer = [
            'footer_about_text' => 'National Hindi-English Scientific Magazine of India, bringing the latest discoveries, technological innovations, and scientific reports in regional Indian languages.',

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
            'footer_contact_name'    => 'Vigyanmev Jayate Press Club Head Office',
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
    }
}
