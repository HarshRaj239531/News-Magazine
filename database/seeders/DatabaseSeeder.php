<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@vigyanmev.gov.in'],
            [
                'name' => 'Vigyanmev Jayate Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Initial Articles & Samachar
        $articles = [
            [
                'title' => 'India Launches Advanced Quantum Computing Research Center',
                'slug' => 'india-launches-advanced-quantum-computing-research-center',
                'category' => 'news',
                'content' => 'In a major push for technological sovereignty, the Ministry of Information and Broadcasting along with DST has announced the establishment of a state-of-the-art National Quantum Computing Research Center. The facility will collaborate with leading IITs to research cryptography, quantum communication, and advanced scientific algorithms. High-speed processors and superconducting qubits will be developed locally under the Make in India initiative.',
                'image_path' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Vigyanmev Jayate National Scientific Honors 2026 Announced',
                'slug' => 'vigyanmev-jayate-national-scientific-honors-2026-announced',
                'category' => 'honours',
                'content' => 'The National Parliamentary Board of VIGYANMEV JAYATE has officially announced the list of scientists, computer engineers, and grassroots science reporters selected for the Scientific Honors of 2026. The awards recognize contributions in popularizing science in regional Indian languages, particularly Hindi. Dr. A.K. Prasad, chief developer of Indigenous AI software, will receive the Vigyan Vibhushan award.',
                'image_path' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Digital Social Media Training Centers Established Across 5 States',
                'slug' => 'digital-social-media-training-centers-established-across-5-states',
                'category' => 'news',
                'content' => 'Vigyanmev Jayate has launched local Print and Electronic Media Training Centers in collaboration with local press clubs. These centers aim to train regional reporters and Panchayat members in data journalism, scientific reporting, and online news editing. Special modules on digital tools, AI-powered Hindi translation, and investigative journalism have been included in the syllabus.',
                'image_path' => null,
                'status' => 'published',
            ],
            [
                'title' => 'Indigenous AI Translation Tool for Scientific Research Completed',
                'slug' => 'indigenous-ai-translation-tool-for-scientific-research-completed',
                'category' => 'projects',
                'content' => 'Our Digital AI Computers Software Engineers have successfully deployed a deep-learning translator capable of translating highly technical scientific papers from English to Hindi in real-time. This project, titled "Vigyan Anuvad," is aimed at bridging the language barrier for rural students in schools and colleges.',
                'image_path' => null,
                'status' => 'published',
            ]
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // 3. Seed Initial Directory Members (for all key categories)
        $members = [
            // National Parliamentary Board
            [
                'name' => 'Hon. Rajesh Kumar Sharma',
                'designation' => 'Chairman, National Parliamentary Board',
                'category' => 'national-parliamentary-board',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'contact_info' => 'Email: rajesh.board@vigyanmev.gov.in | Phone: +91-11-23091122',
            ],
            [
                'name' => 'Dr. Sunita Deshmukh',
                'designation' => 'Scientific Secretary',
                'category' => 'national-parliamentary-board',
                'state' => 'Maharashtra',
                'district' => 'Mumbai',
                'contact_info' => 'Email: sunita.d@vigyanmev.gov.in',
            ],

            // Prime Editor
            [
                'name' => 'Dr. Vinay Mohan Mishra',
                'designation' => 'Prime Editor & Chief Scientific Coordinator',
                'category' => 'prime-editor',
                'state' => 'Uttar Pradesh',
                'district' => 'Lucknow',
                'contact_info' => 'Email: editor@vigyanmev.gov.in',
            ],

            // Publisher
            [
                'name' => 'Vigyanmev Publications Group',
                'designation' => 'Official Chief Publisher',
                'category' => 'publishers',
                'state' => 'Delhi',
                'district' => 'Central Delhi',
                'contact_info' => 'Email: publications@vigyanmev.gov.in',
            ],

            // Printers
            [
                'name' => 'Vigyanmev Jayate High-Tech Press',
                'designation' => 'Authorized Printing Partner',
                'category' => 'printers',
                'state' => 'Haryana',
                'district' => 'Gurugram',
                'contact_info' => 'Ph: +91-124-4001928',
            ],

            // Advocates
            [
                'name' => 'Adv. Manoj Kumar Singh',
                'designation' => 'Senior Legal Advisor (Supreme Court)',
                'category' => 'advocates',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'contact_info' => 'Email: legal@vigyanmev.gov.in | Ph: +91-9811029281',
            ],

            // Engineers
            [
                'name' => 'Aravind Swaminathan',
                'designation' => 'Lead AI & Software Architect',
                'category' => 'engineers',
                'state' => 'Karnataka',
                'district' => 'Bengaluru',
                'contact_info' => 'Email: tech.aravind@vigyanmev.gov.in',
            ],
            [
                'name' => 'Sneha Patil',
                'designation' => 'Senior Cloud & Systems Engineer',
                'category' => 'engineers',
                'state' => 'Telangana',
                'district' => 'Hyderabad',
                'contact_info' => 'Email: sneha.tech@vigyanmev.gov.in',
            ],

            // Translators
            [
                'name' => 'Prof. Ramesh Chandra Dwivedi',
                'designation' => 'Chief Hindi-English Technical Translator',
                'category' => 'translators',
                'state' => 'Bihar',
                'district' => 'Patna',
                'contact_info' => 'Email: rc.dwivedi@vigyanmev.gov.in',
            ],

            // State News Editors
            [
                'name' => 'Shri Devendra Agnihotri',
                'designation' => 'State News Editor (Uttar Pradesh)',
                'category' => 'state-news-editors',
                'state' => 'Uttar Pradesh',
                'district' => 'Kanpur',
                'contact_info' => 'Email: devendra.up@vigyanmev.gov.in',
            ],

            // State Press Club Presidents
            [
                'name' => 'Shri Harish Rawat',
                'designation' => 'State Press Club President',
                'category' => 'state-press-club-presidents',
                'state' => 'Uttarakhand',
                'district' => 'Dehradun',
                'contact_info' => 'Email: rawat.press@gmail.com',
            ],

            // Documentary Films / Actors
            [
                'name' => 'Amit Kumar Sen',
                'designation' => 'Lead Documentary Narrator / Host',
                'category' => 'documentary-films',
                'state' => 'West Bengal',
                'district' => 'Kolkata',
                'contact_info' => 'Email: amit.docu@vigyanmev.gov.in',
            ],

            // Schools / Colleges
            [
                'name' => 'Vigyanmev Jayate Model Science College',
                'designation' => 'Associated Educational Institution',
                'category' => 'schools-colleges',
                'state' => 'Madhya Pradesh',
                'district' => 'Bhopal',
                'contact_info' => 'Email: info@vmsciencebhopal.edu.in',
            ],

            // Life Members
            [
                'name' => 'Dr. K. Sivan',
                'designation' => 'Patron & Life Member (ISRO Ex-Chairman)',
                'category' => 'life-members',
                'state' => 'Tamil Nadu',
                'district' => 'Chennai',
                'contact_info' => 'Distinguished Scientific Contributor',
            ]
        ];

        foreach ($members as $mem) {
            Member::updateOrCreate(
                [
                    'name' => $mem['name'],
                    'category' => $mem['category']
                ],
                $mem
            );
        }
    }
}
