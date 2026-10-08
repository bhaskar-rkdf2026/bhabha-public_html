<?php
/**
 * Bhabha University - Homepage Sections Auto-Migration & Schema Synchronizer
 * Automatically creates the table and seeds 14 default sections if missing on Live/Local.
 */

if (!function_exists('bu_get_default_homepage_sections')) {
    function bu_get_default_homepage_sections() {
        return [
            [
                'id' => 1,
                'section_key' => 'hero_video',
                'section_name' => 'Hero Video & Stats Bar',
                'title' => 'AERIAL · BHOPAL CAMPUS',
                'heading' => '32 acres of<br><em>living, learning</em> landscape.',
                'subheading' => 'From the medical quadrangle to the engineering labs — a bird\'s-eye view of the community our students call home.',
                'content' => '',
                'media_url' => 'new-media/image/hero/bhabha_2.mp4',
                'quote' => '',
                'author' => '',
                'extra_data' => '{"poster":"new-media/image/campus-aerial.png","stats":[{"number":"8500","suffix":"+","commas":true,"label":"STUDENTS"},{"number":"750","suffix":"+","commas":false,"label":"FACULTY"},{"number":"85","suffix":"+","commas":false,"label":"PROGRAMS"},{"number":"25","suffix":"","commas":false,"label":"INSTITUTES"},{"number":"300","suffix":"+","commas":false,"label":"RECRUITERS"},{"number":"20000","suffix":"+","commas":true,"label":"ALUMNI"},{"number":"2500","suffix":"+","commas":true,"label":"PUBLICATIONS"},{"number":"32","suffix":" ac","commas":false,"label":"CAMPUS"}]}',
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'id' => 2,
                'section_key' => 'chancellor_welcome',
                'section_name' => 'Chancellor\'s Welcome',
                'title' => 'CHANCELLOR\'S MESSAGE',
                'heading' => 'A legacy of <em>excellence</em>.<br>A vision for tomorrow.',
                'subheading' => '',
                'content' => '<p><strong>Dr. Sadhna Kapoor</strong> is the Chancellor of BHABHA University. A visionary and a selfless leader with exceptional entrepreneurial, interpersonal, social and administrative skills; Dr. Sadhna Kapoor is passionate about technology and innovation, community development, social service, and interdisciplinary teaching and research.</p><p>She has been awarded the title of “Honorary Professor” by the Academic Union Oxford, UK, reflecting her global dedication to educational innovation and excellence.</p>',
                'media_url' => 'new-media/image/hero/sadhna-mam.mp4',
                'quote' => '“We bridge academic brilliance with industrial pragmatism.”',
                'author' => 'DR. SADHNA KAPOOR · CHANCELLOR',
                'extra_data' => '{"recognitions":[{"title":"UGC","label":"RECOGNISED"},{"title":"MPPURC","label":"APPROVED"},{"title":"AICTE","label":"APPROVED"}]}',
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'id' => 3,
                'section_key' => 'why_bhabha',
                'section_name' => 'Why Bhabha University',
                'title' => 'WHY BHABHA',
                'heading' => 'A university built<br>for <em>impact.</em>',
                'subheading' => 'From academic excellence to ecosystem — every dimension of the Bhabha experience is engineered for academic depth, global mobility and lifelong opportunity.',
                'content' => '',
                'media_url' => '',
                'quote' => '',
                'author' => '',
                'extra_data' => '{"features":[{"icon":"fa fa-certificate","title":"UGC Recognised","desc":"UGC recognised under 2(f)  with approvals from AICTE, PCI, BCI, DCI, NCTE.","url":""},{"icon":"fa fa-flask","title":"Research Excellence","desc":"120+ research labs, 250+ patents and 2,500+ publications.","url":""},{"icon":"fa fa-globe","title":"Global Collaborations","desc":"MoUs with 60+ international universities across 4 continents.","url":""},{"icon":"fa fa-mortar-board","title":"Outstanding Placements","desc":"98% placement rate with 300+ recruiters and packages up to ₹60 LPA.","url":""},{"icon":"fa fa-building-o","title":"Smart Campus","desc":"32-acre wifi-enabled green campus with smart classrooms.","url":""},{"icon":"fa fa-rocket","title":"Innovation Ecosystem","desc":"Incubation centre, student startups and industry mentoring.","url":""}]}',
                'status' => 1,
                'sort_order' => 3,
            ],
            [
                'id' => 4,
                'section_key' => 'virtual_tour',
                'section_name' => 'Virtual Tour Showcase',
                'title' => 'Explore Campus · 360° Drone View',
                'heading' => 'Virtual Tour of <em>Bhabha Campus</em>',
                'subheading' => 'Experience our breathtaking 32-acre green campus from the sky. Explore world-class academic blocks, research labs, sports arenas, and vibrant student life — all from right here.',
                'content' => '',
                'media_url' => 'upload/video/bhabha_video.mp4',
                'quote' => '',
                'author' => '',
                'extra_data' => '{"poster":"new-media/image/campus-aerial.png","badge1":"Live Campus Video","badge2":"Bhopal, MP","video_tabs":[{"label":"Aerial Drone","icon":"fa fa-plane","video_url":"upload/video/bhabha_video.mp4"},{"label":"Campus Tour Video","icon":"fa fa-film","video_url":"new-media/image/hero/bhabha_2.mp4"},{"label":"Academic & Labs","icon":"fa fa-flask","video_url":"new-media/image/hero/academic-lab.mp4"},{"label":"Student Life","icon":"fa fa-graduation-cap","video_url":"new-media/image/hero/bhabha_4.mp4"}],"info_cards":[{"icon":"fa fa-tree","title":"32-Acre Green Campus","desc":"Eco-friendly lush green campus with solar energy, botanical gardens, and spacious plazas."},{"icon":"fa fa-university","title":"25 Institutes","desc":"Engineering, Medical, Dental, Pharmacy, Law, Agriculture & Management blocks."},{"icon":"fa fa-flask","title":"120+ Modern Labs","desc":"Hi-tech practical skill labs, research wings, and state-of-art computing centers."},{"icon":"fa fa-hospital-o","title":"500-Bed Hospital","desc":"Full-fledged multi-speciality teaching hospital & clinical training facility."}],"cta_text":"Explore Full Virtual Tour","cta_url":"about.php#virtualTour"}',
                'status' => 1,
                'sort_order' => 4,
            ],
            [
                'id' => 5,
                'section_key' => 'research_innovation',
                'section_name' => 'Research & Innovation',
                'title' => 'RESEARCH & INNOVATION',
                'heading' => 'Knowledge that <em>moves</em> the<br>world forward.',
                'subheading' => 'From climate-resilient agriculture to AI in healthcare — our 120+ labs and research centres tackle the questions that matter most.',
                'content' => '',
                'media_url' => 'new-media/image/research-students.png',
                'quote' => '',
                'author' => '',
                'extra_data' => '{"metrics":[{"target":250,"value":"250","suffix":"+","prefix":"","commas":false,"label":"PATENTS FILED"},{"target":2500,"value":"2500","suffix":"+","prefix":"","commas":true,"label":"PUBLICATIONS"},{"target":"2.4","value":"2.4","suffix":" Cr","prefix":"₹","commas":false,"label":"ACTIVE GRANTS"},{"target":60,"value":"60","suffix":"+","prefix":"","commas":false,"label":"GLOBAL MOUS"}],"highlight_icon":"fa fa-flask","highlight_text":"Featured: DST-funded sustainable energy research lab — ₹2.4 Cr grant.","button_text":"EXPLORE RESEARCH →","button_url":"research.php"}',
                'status' => 1,
                'sort_order' => 5,
            ],
            [
                'id' => 6,
                'section_key' => 'global_network',
                'section_name' => 'Global Network & MoUs',
                'title' => 'INTERNATIONAL',
                'heading' => 'A truly <em>global</em> network.',
                'subheading' => 'International Career Pathways: Empowering students with career opportunities in key global hubs including America, Europe, and the Middle East.',
                'content' => '',
                'media_url' => '',
                'quote' => '',
                'author' => '',
                'extra_data' => '{"tags":["Saudi Arabia (KSA)","UAE","USA","UK","Germany","Canada","Singapore","Australia"],"button_text":"APPLY NOW →","button_url":"enquiry.php","yt_is_live":0,"yt_live_url":"","yt_video_url":"https://www.youtube.com/watch?v=z1tHsYdaPLY","yt_title":"Bhabha University Broadcast & Official Events","yt_desc":"Watch live broadcasts of convocation, expert guest lectures, campus fests & university events.","yt_channel_url":"https://www.youtube.com/channel/UCHyRBhcOyXt2CvTAW6JzP-g","yt_channel_btn":"Watch on YouTube →"}',
                'status' => 1,
                'sort_order' => 6,
            ],
            [
                'id' => 7,
                'section_key' => 'insta_reels',
                'section_name' => 'Campus Instagram Reels',
                'title' => 'LIFE AT BHABHA · INSTAGRAM REELS',
                'heading' => 'Inside the <em>University</em>',
                'subheading' => 'Watch real campus moments, student celebrations, and university highlights directly from our official Instagram feed.',
                'content' => '',
                'media_url' => '',
                'quote' => '',
                'author' => '',
                'extra_data' => '{"reels":[{"id":"reel-1","title":"Campus Celebrations & Events","code":"Dbr0ycHAi-x","embed_url":"https://www.instagram.com/p/Dbr0ycHAi-x/embed/","insta_url":"https://www.instagram.com/reel/Dbr0ycHAi-x/"},{"id":"reel-2","title":"Annual Fest & Activities","code":"DanDix7AeZq","embed_url":"https://www.instagram.com/p/DanDix7AeZq/embed/","insta_url":"https://www.instagram.com/reel/DanDix7AeZq/"},{"id":"reel-3","title":"Hi-Tech Skill Labs & Practical","code":"Dacmhdnj8hJ","embed_url":"https://www.instagram.com/p/Dacmhdnj8hJ/embed/","insta_url":"https://www.instagram.com/reel/Dacmhdnj8hJ/"},{"id":"reel-4","title":"University Highlights & Moments","code":"DaSehWXDgwj","embed_url":"https://www.instagram.com/p/DaSehWXDgwj/embed/","insta_url":"https://www.instagram.com/reel/DaSehWXDgwj/"}]}',
                'status' => 1,
                'sort_order' => 7,
            ],
            [
                'id' => 8,
                'section_key' => 'degree_programs',
                'section_name' => 'Degree Programs (UG, PG, Diploma, Ph.D)',
                'title' => 'PROGRAMS OFFERED',
                'heading' => '85+ programs across<br>every degree level.',
                'subheading' => 'Explore our comprehensive range of undergraduate, postgraduate, diploma, doctoral, and certificate programs.',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"source":"course_table","description":"Live synced to Course Master"}',
                'status' => 1,
                'sort_order' => 0,
            ],
            [
                'id' => 9,
                'section_key' => 'infrastructure_grid',
                'section_name' => 'Campus Facilities & Infrastructure Grid',
                'title' => 'CAMPUS & INFRASTRUCTURE',
                'heading' => 'World-class infrastructure<br>designed for excellence.',
                'subheading' => 'Modern campus equipped with advanced digital classrooms, 120+ research laboratories, sports complexes, hostels, and world-class amenities.',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"facilities":{"smart-classrooms":{"title":"Smart Classrooms","badge":"Digital Learning","desc":"Modern multimedia classrooms equipped with audio-visual equipment, digital podiums, interactive projection systems, and ergonomic seating to enhance interactive learning.","image":"upload/infrastructure/83e285d874ee031ad471ea4df94a1945.jpg","link":"infrastructure.php#smart-classrooms"},"research-labs":{"title":"Research & Innovation Labs","badge":"Advanced Research","desc":"Over 120+ cutting-edge laboratories for engineering, pharmacy, biotech, and applied sciences with sophisticated analytical instruments and modern computational facilities.","image":"new-media/image/research-students.png","link":"research.php"},"medical-centre":{"title":"Medical & Health Centre","badge":"Healthcare & Wellness","desc":"Dedicated on-campus medical centre with qualified doctors, round-the-clock nursing staff, first-aid support, and ambulance facility for student and faculty wellness.","image":"upload/infrastructure/e24d4326ba8712763cc0e1484f66dc4d.jpg","link":"infrastructure.php#health-centre"},"hostels":{"title":"Boys & Girls Hostels","badge":"Student Living","desc":"Safe, hygienic, and spacious residential facilities on campus with high-speed internet, recreational zones, 24/7 security surveillance, and mess facilities.","image":"upload/infrastructure/f26b29937f258d4966b0be4de6bea02d.jpg","link":"infrastructure.php#hostel"},"auditorium":{"title":"Auditorium & Seminar Hall","badge":"Events & Convocations","desc":"Acoustically treated grand auditorium with state-of-the-art sound systems, digital projection, and stage lighting for seminars, guest lectures, and convocations.","image":"new-media/image/auditorium-hall-1.jpg","link":"infrastructure.php#seminar-hall"},"open-auditorium":{"title":"Open Auditorium & Amphitheatre","badge":"Cultural & Arts Arena","desc":"Expansive open-air amphitheatre designed for cultural fests, annual functions, youth festivals, musical concerts, and student talent showcases.","image":"new-media/image/auditorium-hall-2.jpg","link":"infrastructure.php#open-auditorium"},"innovation-hub":{"title":"Innovation & Incubation Hub","badge":"Startups & Patents","desc":"University incubation centre providing mentorship, seed-grant assistance, prototyping workspace, and patent support to turn innovative ideas into successful enterprises.","image":"new-media/image/bhabha-engineering-building.jpg","link":"research.php#incubation"},"sports-complex":{"title":"Sports Complex & Gymnasium","badge":"Athletics & Fitness","desc":"World-class sports infrastructure featuring cricket grounds, football arena, basketball and volleyball courts, indoor games, and a modern fitness gymnasium.","image":"upload/infrastructure/08ba91f6cd604afe6629e3c47afc8dfa.jpg","link":"activities.php"},"cafeteria":{"title":"Central Cafeteria & Food Court","badge":"Dining & Refreshments","desc":"Spacious and hygienic food court offering nutritious multi-cuisine meals, healthy snacks, hot beverages, and social seating zones for campus life.","image":"new-media/image/cafeteria.jpg","link":"infrastructure.php#cafeteria"},"transport":{"title":"Transport & Bus Fleet","badge":"Safe Commute","desc":"Comprehensive fleet of 50+ university buses connecting all major sectors of Bhopal, Mandideep, Sehore, and adjoining regions with GPS tracking.","image":"upload/infrastructure/6bcbeeeeb305c48b78ec2ad6cb45b4bf.jpg","link":"infrastructure.php#transport"}}}',
                'status' => 1,
                'sort_order' => 0,
            ],
            [
                'id' => 10,
                'section_key' => 'campus_life',
                'section_name' => 'Campus Life & Facilities (4 Highlights)',
                'title' => 'CAMPUS LIFE & INFRASTRUCTURE',
                'heading' => 'World-class <em>facilities &amp; environment.</em>',
                'subheading' => 'A 32-acre expansive green ecosystem equipped with advanced academic infrastructure, renewable research facilities, live media broadcasting studios, and modern simulation laboratories.',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"cards":[{"badge":"Central Library","icon":"fa fa-book","title":"Central Library","desc":"50,000+ books, digital e-journals & silent reading halls","image":"images/library.jpg","link":"infrastructure.php#library"},{"badge":"Green Campus","icon":"fa fa-sun-o","title":"Solar & Green Energy","desc":"Eco-friendly campus with advanced solar research wing","image":"images/solar.jpg","link":"solar.php"},{"badge":"Community Radio","icon":"fa fa-microphone","title":"Radio Popcorn 90.4 FM","desc":"Community radio station broadcasting student media projects","image":"images/radio.jpg","link":"radio.php"},{"badge":"Skill & Simulation","icon":"fa fa-cogs","title":"Modern Skill Labs","desc":"Hands-on training facilities for engineering, pharmacy and nursing","image":"images/skill_lab.jpg","link":"infrastructure.php#labs"}]}',
                'status' => 1,
                'sort_order' => 0,
            ],
            [
                'id' => 11,
                'section_key' => 'hall_of_fame',
                'section_name' => 'Hall of Fame & Placement Highlights Slider',
                'title' => 'STUDENT ACHIEVEMENTS',
                'heading' => 'Hall of Fame &amp; Placement Highlights',
                'subheading' => 'Celebrating the extraordinary milestones, elite packages, and national government selections of our alumni and graduating scholars.',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"posters":[{"src":"upload/media/highest-package-60lpa.png","title":"Mr. Anurag Kumar - ₹60.0 LPA at CPP","alt":"Mr. Anurag Kumar Highest Package 60 LPA Bhabha University","category":"Highest Placement (₹60 LPA)"},{"src":"upload/media/alumni_harikesh_singh_ies_rank68.jpg","title":"Harikesh Singh - AIR Rank 68 in UPSC IES 2025","alt":"Harikesh Singh AIR Rank 68 UPSC IES Bhabha University","category":"UPSC IES Selection"},{"src":"upload/media/alumni_shubham_srivastava_nhsrcl.jpg","title":"Shubham Kumar Srivastava - ₹12.0 LPA at NHSRCL","alt":"Shubham Kumar Srivastava NHSRCL 12 LPA Bhabha University","category":"PSU Placement (₹12 LPA)"},{"src":"upload/media/alumni_rakesh_roy_dhariwal.jpg","title":"Mr. Rakesh Kumar Roy - ₹7.44 LPA at Dhariwal Buildtech","alt":"Mr. Rakesh Kumar Roy Dhariwal Buildtech Bhabha University","category":"Corporate Placement"},{"src":"upload/media/alumni_anshuman_singh_ies.jpg","title":"Anshuman Singh - Indian Engineering Services (UPSC IES)","alt":"Anshuman Singh Selected in UPSC IES Bhabha University","category":"UPSC IES Selection"},{"src":"upload/media/alumni_kamlesh_kumar_ies.jpg","title":"Kamlesh Kumar - Indian Engineering Services (UPSC IES)","alt":"Kamlesh Kumar Selected in UPSC IES Bhabha University","category":"UPSC IES Selection"},{"src":"upload/media/alumni_nidhi_shukla_dte.jpg","title":"Nidhi Shukla - Selected in DTE / PSU Placement","alt":"Nidhi Shukla DTE PSU Placement Bhabha University","category":"Govt / PSU Placement"},{"src":"upload/media/alumni_vikash_chandra_iit_kanpur.jpg","title":"Vikash Chandra - M.Tech Selection at IIT Kanpur","alt":"Vikash Chandra IIT Kanpur Selection Bhabha University","category":"Higher Studies (IIT)"}]}',
                'status' => 1,
                'sort_order' => 0,
            ],
            [
                'id' => 12,
                'section_key' => 'accreditations',
                'section_name' => 'Statutory Approvals & Accreditations (Logos)',
                'title' => 'ACCREDITATIONS & APPROVALS',
                'heading' => 'Statutory Approvals &amp; Recognitions',
                'subheading' => 'Bhabha University is recognized and approved by premier national statutory authorities and regulatory councils.',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"items":[{"img":"images/ugc_new_logo.jpg","alt":"UGC - University Grants Commission","name":"UGC","desc":"Section 2(f)","link":"approvals.php"},{"img":"images/AICT.png","alt":"AICTE - All India Council for Technical Education","name":"AICTE","desc":"Approved","link":"approvals.php"},{"img":"images/PCI.png","alt":"PCI - Pharmacy Council of India","name":"PCI","desc":"Approved","link":"approvals.php"},{"img":"images/bci.png","alt":"BCI - Bar Council of India","name":"BCI","desc":"Approved","link":"approvals.php"},{"img":"images/dci.png","alt":"DCI - Dental Council of India","name":"DCI","desc":"Approved","link":"approvals.php"},{"img":"images/nci.png","alt":"NCTE - National Council for Teacher Education","name":"NCTE","desc":"Approved","link":"approvals.php"},{"img":"images/MPNRC.png","alt":"MPNRC - Madhya Pradesh Nurses Registration Council","name":"MPNRC","desc":"Recognized","link":"approvals.php"},{"img":"images/mp_govt_logo.jpg","alt":"Government of Madhya Pradesh","name":"MP Govt.","desc":"Recognized","link":"approvals.php"},{"img":"images/nch_logo.png","alt":"NCH - National Commission for Homoeopathy","name":"NCH","desc":"Approved","link":"approvals.php"}]}',
                'status' => 1,
                'sort_order' => 0,
            ],
            [
                'id' => 13,
                'section_key' => 'cta_journey',
                'section_name' => 'Journey Starts Now (Admissions CTA Banner)',
                'title' => 'ADMISSIONS OPEN · 2026-27',
                'heading' => 'Your journey starts now.',
                'subheading' => 'Applications open across all 25 institutes. Speak to an advisor, download the prospectus, or apply online in minutes.',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"btn1_text":"APPLY NOW","btn1_url":"enquiry.php","btn2_text":"DOWNLOAD PROSPECTUS","btn2_url":"https://drive.google.com/file/d/1jhIfUzZbjtOWSCnYu77C0MM5C8U5vumt/view","btn3_text":"SCHEDULE CALL","btn3_phone":"07554246498"}',
                'status' => 1,
                'sort_order' => 0,
            ],
            [
                'id' => 14,
                'section_key' => 'achievements_ticker',
                'section_name' => 'Our Achievements Marquee Ticker',
                'title' => 'OUR ACHIEVEMENTS :',
                'heading' => 'University Achievements Ticker',
                'subheading' => '',
                'content' => null,
                'media_url' => null,
                'quote' => null,
                'author' => null,
                'extra_data' => '{"items":["1. Bhabha University has been consistently ranked as top university in Madhya Pradesh.","2. Bhabha University is a top private university in Bhopal as well as Madhya Pradesh.","3. Globally recognized centre of excellence in teaching, research and innovation.","4. UGC Recognized & Chartered under the State Private University Act."]}',
                'status' => 1,
                'sort_order' => 0,
            ]
        ];
    }
}

if (!function_exists('bu_ensure_homepage_sections_schema')) {
    function bu_ensure_homepage_sections_schema($db) {
        $result = [
            'table_created' => false,
            'cols_added' => 0,
            'rows_inserted' => 0,
            'total_rows' => 0,
            'errors' => []
        ];
        
        if (!$db || !is_object($db)) {
            $result['errors'][] = 'Database connection object not available';
            return $result;
        }
        
        // 1. Check if table exists
        try {
            $tables = $db->rawQuery("SHOW TABLES LIKE 'homepage_sections'");
            if (empty($tables)) {
                $createSql = "CREATE TABLE IF NOT EXISTS `homepage_sections` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `section_key` varchar(50) NOT NULL,
                  `section_name` varchar(100) NOT NULL,
                  `title` varchar(255) DEFAULT NULL,
                  `heading` varchar(255) DEFAULT NULL,
                  `subheading` text DEFAULT NULL,
                  `content` longtext DEFAULT NULL,
                  `media_url` varchar(255) DEFAULT NULL,
                  `quote` varchar(255) DEFAULT NULL,
                  `author` varchar(150) DEFAULT NULL,
                  `extra_data` longtext DEFAULT NULL,
                  `status` tinyint(1) NOT NULL DEFAULT 1,
                  `sort_order` int(11) NOT NULL DEFAULT 0,
                  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                  PRIMARY KEY (`id`),
                  UNIQUE KEY `section_key` (`section_key`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                $db->rawQuery($createSql);
                $result['table_created'] = true;
            }
        } catch (\Throwable $e) {
            $result['errors'][] = 'Table check/create error: ' . $e->getMessage();
        }
        
        // 2. Ensure columns exist
        try {
            $cols = $db->rawQuery("SHOW COLUMNS FROM `homepage_sections`");
            $existingCols = [];
            if (is_array($cols)) {
                foreach ($cols as $c) {
                    $existingCols[] = strtolower($c['Field'] ?? '');
                }
            }
            
            $reqCols = [
                'id'           => "INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                'section_key'  => "VARCHAR(50) NOT NULL",
                'section_name' => "VARCHAR(100) NOT NULL",
                'title'        => "VARCHAR(255) DEFAULT NULL",
                'heading'      => "VARCHAR(255) DEFAULT NULL",
                'subheading'   => "TEXT DEFAULT NULL",
                'content'      => "LONGTEXT DEFAULT NULL",
                'media_url'    => "VARCHAR(255) DEFAULT NULL",
                'quote'        => "VARCHAR(255) DEFAULT NULL",
                'author'       => "VARCHAR(150) DEFAULT NULL",
                'extra_data'   => "LONGTEXT DEFAULT NULL",
                'status'       => "TINYINT(1) NOT NULL DEFAULT 1",
                'sort_order'   => "INT(11) NOT NULL DEFAULT 0",
                'updated_at'   => "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
            ];
            
            foreach ($reqCols as $colName => $colDef) {
                if (!in_array(strtolower($colName), $existingCols)) {
                    $db->rawQuery("ALTER TABLE `homepage_sections` ADD COLUMN `$colName` $colDef");
                    $result['cols_added']++;
                }
            }
        } catch (\Throwable $e) {
            $result['errors'][] = 'Column validation error: ' . $e->getMessage();
        }
        
        // 3. Ensure all 14 default rows exist
        try {
            $existingKeys = [];
            $rows = $db->rawQuery("SELECT `section_key` FROM `homepage_sections`");
            if (is_array($rows)) {
                foreach ($rows as $r) {
                    $existingKeys[] = $r['section_key'];
                }
            }
            
            $defaults = bu_get_default_homepage_sections();
            foreach ($defaults as $def) {
                if (!in_array($def['section_key'], $existingKeys)) {
                    $db->insert('homepage_sections', [
                        'section_key'  => $def['section_key'],
                        'section_name' => $def['section_name'],
                        'title'        => $def['title'],
                        'heading'      => $def['heading'],
                        'subheading'   => $def['subheading'],
                        'content'      => $def['content'],
                        'media_url'    => $def['media_url'],
                        'quote'        => $def['quote'],
                        'author'       => $def['author'],
                        'extra_data'   => $def['extra_data'],
                        'status'       => $def['status'],
                        'sort_order'   => $def['sort_order']
                    ]);
                    $result['rows_inserted']++;
                }
            }
            
            $result['total_rows'] = count($existingKeys) + $result['rows_inserted'];
        } catch (\Throwable $e) {
            $result['errors'][] = 'Seed sections error: ' . $e->getMessage();
        }
        
        return $result;
    }
}
