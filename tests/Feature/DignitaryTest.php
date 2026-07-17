<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DignitaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dignitaries_settings_page(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dignitaries.index'));
        $response->assertStatus(200);
        $response->assertSee('Manage Dignitaries');
    }

    public function test_admin_can_update_dignitaries_settings(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        Storage::fake('public');

        $leftImage = UploadedFile::fake()->image('modi.jpg');
        $rightImage = UploadedFile::fake()->image('jitendra.jpg');
        $aboutBanner = UploadedFile::fake()->image('about_banner.jpg');

        $response = $this->actingAs($admin)
            ->post(route('admin.dignitaries.update'), [
                'dignitary_left_name_en'         => 'Narendra Modi Updated',
                'dignitary_left_name_hi'         => 'नरेन्द्र मोदी अपडेटेड',
                'dignitary_left_designation_en'  => 'Prime Minister of India',
                'dignitary_left_designation_hi'  => 'भारत के प्रधानमंत्री',
                'dignitary_left_image'           => $leftImage,

                'dignitary_right_name_en'        => 'Jitendra Singh Updated',
                'dignitary_right_name_hi'        => 'जितेंद्र सिंह अपडेटेड',
                'dignitary_right_designation_en' => 'Minister of State',
                'dignitary_right_designation_hi' => 'राज्य मंत्री',
                'dignitary_right_image'          => $rightImage,

                'about_section_title_en'         => 'About Vigyanmev',
                'about_section_title_hi'         => 'विज्ञानमेव के बारे में',
                'about_section_text_en'          => 'This is the English about us content paragraph.',
                'about_section_text_hi'          => 'यह हिन्दी का परिचय पैराग्राफ है।',
                'about_section_image'            => $aboutBanner,
            ]);

        $response->assertRedirect(route('admin.dignitaries.index'));

        // Verify settings are saved in DB
        $this->assertEquals('Narendra Modi Updated', Setting::get('dignitary_left_name_en'));
        $this->assertEquals('Jitendra Singh Updated', Setting::get('dignitary_right_name_en'));
        $this->assertEquals('About Vigyanmev', Setting::get('about_section_title_en'));

        // Verify files are uploaded
        $leftPath = str_replace('/storage/', '', Setting::get('dignitary_left_image'));
        Storage::disk('public')->assertExists($leftPath);

        $rightPath = str_replace('/storage/', '', Setting::get('dignitary_right_image'));
        Storage::disk('public')->assertExists($rightPath);

        $aboutPath = str_replace('/storage/', '', Setting::get('about_section_image'));
        Storage::disk('public')->assertExists($aboutPath);

        // Verify rendering on homepage
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Narendra Modi Updated');
        $homeResponse->assertSee('Jitendra Singh Updated');
        $homeResponse->assertSee('About Vigyanmev');
    }
}
