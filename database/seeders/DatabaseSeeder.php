<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Member;
use App\Models\Slide;
use App\Models\Announcement;
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

        // 2. Seed Initial Articles & Samachar (English + Hindi)
        $articles = [
            // --- ENGLISH ARTICLES ---
            [
                'title' => 'India Launches Advanced Quantum Computing Research Center',
                'slug' => 'india-launches-advanced-quantum-computing-research-center',
                'category' => 'news',
                'content' => 'In a major push for technological sovereignty, the Ministry of Information and Broadcasting along with DST has announced the establishment of a state-of-the-art National Quantum Computing Research Center. The facility will collaborate with leading IITs to research cryptography, quantum communication, and advanced scientific algorithms. High-speed processors and superconducting qubits will be developed locally under the Make in India initiative.',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'Vigyanmev Jayate National Scientific Honors 2026 Announced',
                'slug' => 'vigyanmev-jayate-national-scientific-honors-2026-announced',
                'category' => 'honours',
                'content' => 'The National Parliamentary Board of VIGYANMEV JAYATE has officially announced the list of scientists, computer engineers, and grassroots science reporters selected for the Scientific Honors of 2026. The awards recognize contributions in popularizing science in regional Indian languages, particularly Hindi. Dr. A.K. Prasad, chief developer of Indigenous AI software, will receive the Vigyan Vibhushan award.',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'Digital Social Media Training Centers Established Across 5 States',
                'slug' => 'digital-social-media-training-centers-established-across-5-states',
                'category' => 'news',
                'content' => 'Vigyanmev Jayate has launched local Print and Electronic Media Training Centers in collaboration with local press clubs. These centers aim to train regional reporters and Panchayat members in data journalism, scientific reporting, and online news editing. Special modules on digital tools, AI-powered Hindi translation, and investigative journalism have been included in the syllabus.',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'Indigenous AI Translation Tool for Scientific Research Completed',
                'slug' => 'indigenous-ai-translation-tool-for-scientific-research-completed',
                'category' => 'projects',
                'content' => 'Our Digital AI Computers Software Engineers have successfully deployed a deep-learning translator capable of translating highly technical scientific papers from English to Hindi in real-time. This project, titled "Vigyan Anuvad," is aimed at bridging the language barrier for rural students in schools and colleges.',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'en',
            ],

            // --- HINDI ARTICLES ---
            [
                'title' => 'भारत ने उन्नत क्वांटम कंप्यूटिंग अनुसंधान केंद्र शुरू किया',
                'slug' => 'india-launches-advanced-quantum-computing-research-center-hi',
                'category' => 'news',
                'content' => 'तकनीकी संप्रभुता के लिए एक बड़े प्रयास में, सूचना और प्रसारण मंत्रालय और विज्ञान एवं प्रौद्योगिकी विभाग (DST) ने एक अत्याधुनिक राष्ट्रीय क्वांटम कंप्यूटिंग अनुसंधान केंद्र की स्थापना की घोषणा की है। यह केंद्र क्रिप्टोग्राफी, क्वांटम संचार और उन्नत वैज्ञानिक एल्गोरिदम पर शोध करने के लिए प्रमुख आईआईटी के साथ सहयोग करेगा। मेक इन इंडिया पहल के तहत उच्च गति वाले प्रोसेसर और सुपरकंडक्टिंग क्वैबिट विकसित किए जाएंगे।',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => 'विज्ञानमेव जयते राष्ट्रीय वैज्ञानिक सम्मान 2026 की घोषणा',
                'slug' => 'vigyanmev-jayate-national-scientific-honors-2026-announced-hi',
                'category' => 'honours',
                'content' => 'विज्ञानमेव जयते के राष्ट्रीय संसदीय बोर्ड ने आधिकारिक तौर पर 2026 के वैज्ञानिक सम्मानों के लिए चुने गए वैज्ञानिकों, कंप्यूटर इंजीनियरों और जमीनी स्तर के विज्ञान संवाददाताओं की सूची की घोषणा की है। यह पुरस्कार क्षेत्रीय भारतीय भाषाओं, विशेष रूप से हिंदी में विज्ञान को लोकप्रिय बनाने में योगदान को मान्यता देते हैं। स्वदेशी एआई सॉफ्टवेयर के मुख्य डेवलपर डॉ. ए.के. प्रसाद को विज्ञान विभूषण पुरस्कार से सम्मानित किया जाएगा।',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => '5 राज्यों में डिजिटल सोशल मीडिया प्रशिक्षण केंद्र स्थापित',
                'slug' => 'digital-social-media-training-centers-established-across-5-states-hi',
                'category' => 'news',
                'content' => 'विज्ञानमेव जयते ने स्थानीय प्रेस क्लबों के सहयोग से स्थानीय प्रिंट और इलेक्ट्रॉनिक मीडिया प्रशिक्षण केंद्र शुरू किए हैं। इन केंद्रों का उद्देश्य क्षेत्रीय संवाददाताओं और पंचायत सदस्यों को डेटा पत्रकारिता, वैज्ञानिक रिपोर्टिंग और ऑनलाइन समाचार संपादन में प्रशिक्षित करना है। पाठ्यक्रम में डिजिटल उपकरण, एआई-संचालित हिंदी अनुवाद और खोजी पत्रकारिता पर विशेष मॉड्यूल शामिल किए गए हैं।',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => 'वैज्ञानिक अनुसंधान के लिए स्वदेशी एआई अनुवाद उपकरण पूरा हुआ',
                'slug' => 'indigenous-ai-translation-tool-for-scientific-research-completed-hi',
                'category' => 'projects',
                'content' => 'हमारे डिजिटल एआई कंप्यूटर सॉफ्टवेयर इंजीनियरों ने सफलतापूर्वक एक डीप-लर्निंग अनुवादक तैनात किया है जो अंग्रेजी से हिंदी में अत्यधिक तकनीकी वैज्ञानिक पत्रों का वास्तविक समय में अनुवाद करने में सक्षम है। "विज्ञान अनुवाद" नामक इस परियोजना का उद्देश्य स्कूलों और कॉलेजों में ग्रामीण छात्रों के लिए भाषा की बाधा को दूर करना है।',
                'image_path' => null,
                'status' => 'published',
                'locale' => 'hi',
            ]
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // 3. Seed Initial Directory Members (English + Hindi)
        $members = [
            // --- ENGLISH MEMBERS ---
            [
                'name' => 'Hon. Rajesh Kumar Sharma',
                'designation' => 'Chairman, National Parliamentary Board',
                'category' => 'national-parliamentary-board',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'contact_info' => 'Email: rajesh.board@vigyanmev.gov.in | Phone: +91-11-23091122',
                'locale' => 'en',
            ],
            [
                'name' => 'Dr. Sunita Deshmukh',
                'designation' => 'Scientific Secretary',
                'category' => 'national-parliamentary-board',
                'state' => 'Maharashtra',
                'district' => 'Mumbai',
                'contact_info' => 'Email: sunita.d@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Dr. Vinay Mohan Mishra',
                'designation' => 'Prime Editor & Chief Scientific Coordinator',
                'category' => 'prime-editor',
                'state' => 'Uttar Pradesh',
                'district' => 'Lucknow',
                'contact_info' => 'Email: editor@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Vigyanmev Publications Group',
                'designation' => 'Official Chief Publisher',
                'category' => 'publishers',
                'state' => 'Delhi',
                'district' => 'Central Delhi',
                'contact_info' => 'Email: publications@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Vigyanmev Jayate High-Tech Press',
                'designation' => 'Authorized Printing Partner',
                'category' => 'printers',
                'state' => 'Haryana',
                'district' => 'Gurugram',
                'contact_info' => 'Ph: +91-124-4001928',
                'locale' => 'en',
            ],
            [
                'name' => 'Adv. Manoj Kumar Singh',
                'designation' => 'Senior Legal Advisor (Supreme Court)',
                'category' => 'advocates',
                'state' => 'Delhi',
                'district' => 'New Delhi',
                'contact_info' => 'Email: legal@vigyanmev.gov.in | Ph: +91-9811029281',
                'locale' => 'en',
            ],
            [
                'name' => 'Aravind Swaminathan',
                'designation' => 'Lead AI & Software Architect',
                'category' => 'engineers',
                'state' => 'Karnataka',
                'district' => 'Bengaluru',
                'contact_info' => 'Email: tech.aravind@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Sneha Patil',
                'designation' => 'Senior Cloud & Systems Engineer',
                'category' => 'engineers',
                'state' => 'Telangana',
                'district' => 'Hyderabad',
                'contact_info' => 'Email: sneha.tech@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Prof. Ramesh Chandra Dwivedi',
                'designation' => 'Chief Hindi-English Technical Translator',
                'category' => 'translators',
                'state' => 'Bihar',
                'district' => 'Patna',
                'contact_info' => 'Email: rc.dwivedi@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Shri Devendra Agnihotri',
                'designation' => 'State News Editor (Uttar Pradesh)',
                'category' => 'state-news-editors',
                'state' => 'Uttar Pradesh',
                'district' => 'Kanpur',
                'contact_info' => 'Email: devendra.up@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Shri Harish Rawat',
                'designation' => 'State Press Club President',
                'category' => 'state-press-club-presidents',
                'state' => 'Uttarakhand',
                'district' => 'Dehradun',
                'contact_info' => 'Email: rawat.press@gmail.com',
                'locale' => 'en',
            ],
            [
                'name' => 'Amit Kumar Sen',
                'designation' => 'Lead Documentary Narrator / Host',
                'category' => 'documentary-films',
                'state' => 'West Bengal',
                'district' => 'Kolkata',
                'contact_info' => 'Email: amit.docu@vigyanmev.gov.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Vigyanmev Jayate Model Science College',
                'designation' => 'Associated Educational Institution',
                'category' => 'schools-colleges',
                'state' => 'Madhya Pradesh',
                'district' => 'Bhopal',
                'contact_info' => 'Email: info@vmsciencebhopal.edu.in',
                'locale' => 'en',
            ],
            [
                'name' => 'Dr. K. Sivan',
                'designation' => 'Patron & Life Member (ISRO Ex-Chairman)',
                'category' => 'life-members',
                'state' => 'Tamil Nadu',
                'district' => 'Chennai',
                'contact_info' => 'Distinguished Scientific Contributor',
                'locale' => 'en',
            ],

            // --- HINDI MEMBERS ---
            [
                'name' => 'माननीय राजेश कुमार शर्मा',
                'designation' => 'अध्यक्ष, राष्ट्रीय संसदीय बोर्ड',
                'category' => 'national-parliamentary-board',
                'state' => 'दिल्ली',
                'district' => 'नई दिल्ली',
                'contact_info' => 'ईमेल: rajesh.board@vigyanmev.gov.in | फोन: +91-11-23091122',
                'locale' => 'hi',
            ],
            [
                'name' => 'डॉ. सुनीता देशमुख',
                'designation' => 'वैज्ञानिक सचिव',
                'category' => 'national-parliamentary-board',
                'state' => 'महाराष्ट्र',
                'district' => 'मुंबई',
                'contact_info' => 'ईमेल: sunita.d@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'डॉ. विनय मोहन मिश्रा',
                'designation' => 'प्रधान संपादक और मुख्य वैज्ञानिक समन्वयक',
                'category' => 'prime-editor',
                'state' => 'उत्तर प्रदेश',
                'district' => 'लखनऊ',
                'contact_info' => 'ईमेल: editor@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'विज्ञानमेव प्रकाशन समूह',
                'designation' => 'आधिकारिक मुख्य प्रकाशक',
                'category' => 'publishers',
                'state' => 'दिल्ली',
                'district' => 'मध्य दिल्ली',
                'contact_info' => 'ईमेल: publications@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'विज्ञानमेव जयते हाई-टेक प्रेस',
                'designation' => 'अधिकृत मुद्रण भागीदार',
                'category' => 'printers',
                'state' => 'हरियाणा',
                'district' => 'गुरुग्राम',
                'contact_info' => 'फोन: +91-124-4001928',
                'locale' => 'hi',
            ],
            [
                'name' => 'अधिवक्ता मनोज कुमार सिंह',
                'designation' => 'वरिष्ठ कानूनी सलाहकार (उच्चतम न्यायालय)',
                'category' => 'advocates',
                'state' => 'दिल्ली',
                'district' => 'नई दिल्ली',
                'contact_info' => 'ईमेल: legal@vigyanmev.gov.in | फोन: +91-9811029281',
                'locale' => 'hi',
            ],
            [
                'name' => 'अरविंद स्वामीनाथन',
                'designation' => 'मुख्य एआई और सॉफ्टवेयर आर्किटेक्ट',
                'category' => 'engineers',
                'state' => 'कर्नाटक',
                'district' => 'बेंगलुरु',
                'contact_info' => 'ईमेल: tech.aravind@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'स्नेहा पाटिल',
                'designation' => 'वरिष्ठ क्लाउड और सिस्टम इंजीनियर',
                'category' => 'engineers',
                'state' => 'तेलंगाना',
                'district' => 'हैदराबाद',
                'contact_info' => 'ईमेल: sneha.tech@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'प्रो. रमेश चंद्र द्विवेदी',
                'designation' => 'मुख्य हिंदी-अंग्रेजी तकनीकी अनुवादक',
                'category' => 'translators',
                'state' => 'बिहार',
                'district' => 'पटना',
                'contact_info' => 'ईमेल: rc.dwivedi@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'श्री देवेन्द्र अग्निहोत्री',
                'designation' => 'राज्य समाचार संपादक (उत्तर प्रदेश)',
                'category' => 'state-news-editors',
                'state' => 'उत्तर प्रदेश',
                'district' => 'कानपुर',
                'contact_info' => 'ईमेल: devendra.up@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'श्री हरीश रावत',
                'designation' => 'राज्य प्रेस क्लब अध्यक्ष',
                'category' => 'state-press-club-presidents',
                'state' => 'उत्तराखंड',
                'district' => 'देहरादून',
                'contact_info' => 'ईमेल: rawat.press@gmail.com',
                'locale' => 'hi',
            ],
            [
                'name' => 'अमित कुमार सेन',
                'designation' => 'मुख्य वृत्तचित्र कथावाचक / होस्ट',
                'category' => 'documentary-films',
                'state' => 'पश्चिम बंगाल',
                'district' => 'कोलकाता',
                'contact_info' => 'ईमेल: amit.docu@vigyanmev.gov.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'विज्ञानमेव जयते मॉडल साइंस कॉलेज',
                'designation' => 'संबद्ध शैक्षणिक संस्थान',
                'category' => 'schools-colleges',
                'state' => 'मध्य प्रदेश',
                'district' => 'भोपाल',
                'contact_info' => 'ईमेल: info@vmsciencebhopal.edu.in',
                'locale' => 'hi',
            ],
            [
                'name' => 'डॉ. के. सिवन',
                'designation' => 'संरक्षक और आजीवन सदस्य (इसरो के पूर्व अध्यक्ष)',
                'category' => 'life-members',
                'state' => 'तमिलनाडु',
                'district' => 'चेन्नई',
                'contact_info' => 'प्रतिष्ठित वैज्ञानिक योगदानकर्ता',
                'locale' => 'hi',
            ]
        ];

        foreach ($members as $mem) {
            Member::updateOrCreate(
                [
                    'name' => $mem['name'],
                    'category' => $mem['category'],
                    'locale' => $mem['locale'],
                ],
                $mem
            );
        }

        // 4. Seed Slides
        $slides = [
            [
                'title' => 'Bharat Innovates Initiative',
                'subtitle' => 'The DeepTech innovation initiative of the Ministry of Education, Government of India',
                'date' => '14-16th June 2026',
                'location' => 'Palais des Expositions, Nice, France',
                'image_path' => '/images/slide1_bg.png',
                'link' => 'http://localhost',
                'sort_order' => 1,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'Space Research Summit 2026',
                'subtitle' => 'National conference on satellite communications & space exploration technologies',
                'date' => '22-25th August 2026',
                'location' => 'ISRO Headquarters, Bengaluru, India',
                'image_path' => '/images/slide2_bg.png',
                'link' => 'http://localhost',
                'sort_order' => 2,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'भारत नवाचार पहल (Bharat Innovates)',
                'subtitle' => 'शिक्षा मंत्रालय, भारत सरकार की डीपटेक नवाचार पहल',
                'date' => '14-16 जून 2026',
                'location' => 'पैलेस डेस एक्सपोजिशन, नीस, फ्रांस',
                'image_path' => '/images/slide1_bg.png',
                'link' => 'http://localhost',
                'sort_order' => 1,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => 'अंतरिक्ष अनुसंधान शिखर सम्मेलन 2026',
                'subtitle' => 'उपग्रह संचार और अंतरिक्ष अन्वेषण प्रौद्योगिकियों पर राष्ट्रीय सम्मेलन',
                'date' => '22-25 अगस्त 2026',
                'location' => 'इसरो मुख्यालय, बेंगलुरु, भारत',
                'image_path' => '/images/slide2_bg.png',
                'link' => 'http://localhost',
                'sort_order' => 2,
                'status' => 'published',
                'locale' => 'hi',
            ],
        ];

        foreach ($slides as $sl) {
            Slide::updateOrCreate(
                [
                    'title' => $sl['title'],
                    'locale' => $sl['locale'],
                ],
                $sl
            );
        }

        // 5. Seed Announcements
        $announcements = [
            [
                'title' => 'DST- JSPS call for proposal 2026 under the Indo-Japan Cooperative Science Program',
                'link' => 'http://localhost',
                'icon_type' => 'calendar',
                'is_highlighted' => true,
                'sort_order' => 1,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'Results of DST- JSPS call 2025 under the Indo-Japan Cooperative Science Programme',
                'link' => 'http://localhost',
                'icon_type' => 'file',
                'is_highlighted' => false,
                'sort_order' => 2,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'OM on Empanelment of retired officers as Inquiry Officers for conducting Departmental Inquiries',
                'link' => 'http://localhost',
                'icon_type' => 'file',
                'is_highlighted' => false,
                'sort_order' => 3,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'Partnerships to Drive Innovation & Local Development in Space Tech',
                'link' => 'http://localhost',
                'icon_type' => 'star',
                'is_highlighted' => true,
                'sort_order' => 4,
                'status' => 'published',
                'locale' => 'en',
            ],
            [
                'title' => 'भारत-जापान सहकारी विज्ञान कार्यक्रम के तहत प्रस्ताव 2026 के लिए डीएसटी- जेएसपीएस आमंत्रण',
                'link' => 'http://localhost',
                'icon_type' => 'calendar',
                'is_highlighted' => true,
                'sort_order' => 1,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => 'भारत-जापान सहकारी विज्ञान कार्यक्रम के तहत डीएसटी- जेएसपीएस आमंत्रण 2025 के परिणाम',
                'link' => 'http://localhost',
                'icon_type' => 'file',
                'is_highlighted' => false,
                'sort_order' => 2,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => 'विभागीय जांच के संचालन के लिए सेवानिवृत्त अधिकारियों को जांच अधिकारी के रूप में शामिल करने पर कार्यालय ज्ञापन',
                'link' => 'http://localhost',
                'icon_type' => 'file',
                'is_highlighted' => false,
                'sort_order' => 3,
                'status' => 'published',
                'locale' => 'hi',
            ],
            [
                'title' => 'अंतरिक्ष तकनीक में नवाचार और स्थानीय विकास को बढ़ावा देने के लिए साझेदारी',
                'link' => 'http://localhost',
                'icon_type' => 'star',
                'is_highlighted' => true,
                'sort_order' => 4,
                'status' => 'published',
                'locale' => 'hi',
            ],
        ];

        foreach ($announcements as $ann) {
            Announcement::updateOrCreate(
                [
                    'title' => $ann['title'],
                    'locale' => $ann['locale'],
                ],
                $ann
            );
        }
    }
}
