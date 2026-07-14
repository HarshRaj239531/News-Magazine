<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the tabbed settings management page.
     */
    public function index()
    {
        $general = Setting::allGrouped('general');
        $footer  = Setting::allGrouped('footer');
        $social  = Setting::allGrouped('social');

        // Decode JSON arrays for footer links
        $usefulLinks    = json_decode($footer['footer_useful_links']    ?? '[]', true) ?: [];
        $directoryLinks = json_decode($footer['footer_directory_links'] ?? '[]', true) ?: [];

        return view('admin.settings.index', compact(
            'general', 'footer', 'social', 'usefulLinks', 'directoryLinks'
        ));
    }

    /**
     * Bulk-save all settings from the submitted form.
     */
    public function update(Request $request)
    {
        // --- GENERAL ---
        Setting::set('site_name',      $request->input('site_name', ''),      'general');
        Setting::set('site_tagline',   $request->input('site_tagline', ''),   'general');
        Setting::set('copyright_text', $request->input('copyright_text', ''), 'general');

        // --- FOOTER TEXT & CONTACT ---
        Setting::set('footer_about_text',    $request->input('footer_about_text', ''),    'footer');
        Setting::set('footer_contact_name',  $request->input('footer_contact_name', ''),  'footer');
        Setting::set('footer_contact_city',  $request->input('footer_contact_city', ''),  'footer');
        Setting::set('footer_contact_email', $request->input('footer_contact_email', ''), 'footer');
        Setting::set('footer_contact_phone', $request->input('footer_contact_phone', ''), 'footer');

        // --- FOOTER USEFUL LINKS (dynamic rows) ---
        $usefulLabels = $request->input('useful_label', []);
        $usefulUrls   = $request->input('useful_url', []);
        $usefulLinks  = [];
        foreach ($usefulLabels as $i => $label) {
            $label = trim($label);
            $url   = trim($usefulUrls[$i] ?? '');
            if ($label !== '' && $url !== '') {
                $usefulLinks[] = ['label' => $label, 'url' => $url];
            }
        }
        Setting::set('footer_useful_links', json_encode($usefulLinks), 'footer');

        // --- FOOTER DIRECTORY LINKS (dynamic rows) ---
        $dirLabels = $request->input('dir_label', []);
        $dirSlugs  = $request->input('dir_slug', []);
        $dirLinks  = [];
        foreach ($dirLabels as $i => $label) {
            $label = trim($label);
            $slug  = trim($dirSlugs[$i] ?? '');
            if ($label !== '' && $slug !== '') {
                $dirLinks[] = ['label' => $label, 'slug' => $slug];
            }
        }
        Setting::set('footer_directory_links', json_encode($dirLinks), 'footer');

        // --- SOCIAL LINKS ---
        Setting::set('social_facebook',  $request->input('social_facebook', ''),  'social');
        Setting::set('social_twitter',   $request->input('social_twitter', ''),   'social');
        Setting::set('social_youtube',   $request->input('social_youtube', ''),   'social');
        Setting::set('social_instagram', $request->input('social_instagram', ''), 'social');

        return redirect()->route('admin.settings.index')
            ->with('success', '✅ Settings saved successfully!');
    }
}
