<?php
require_once('config.php');

$tableSql = "CREATE TABLE IF NOT EXISTS `site_blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'tech',
  `category_name` varchar(150) DEFAULT 'AI & Tech',
  `author_name` varchar(150) NOT NULL DEFAULT 'Faculty Contributor',
  `author_role` varchar(255) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `read_time` varchar(50) DEFAULT '5 min read',
  `tags` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_cat` (`category`),
  KEY `idx_status` (`status`),
  KEY `idx_featured` (`is_featured`),
  KEY `idx_pdate` (`publish_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$db->rawQuery($tableSql);
echo "Table `site_blogs` created or confirmed successfully!\n";

// Check if records already exist
$count = $db->getValue('site_blogs', 'count(*)');
if ($count == 0) {
    $seedBlogs = [
        [
            'title'         => 'Commercializing Academic Research: How Bhabha University Developed 14 Proprietary Herbal & Pharmacy Formulations',
            'slug'          => 'commercializing-academic-research-14-formulations',
            'category'      => 'pharmacy',
            'category_name' => 'Pharmacy & Innovation',
            'author_name'   => 'Dr. S. K. Verma',
            'author_role'   => 'Dean, Research & Pharmaceutical Sciences • Bhabha University',
            'publish_date'  => '2026-08-15',
            'read_time'     => '5 min read',
            'tags'          => 'PharmaResearch, Patents, HerbalFormulations, Innovation',
            'summary'       => 'Translating laboratory discoveries into commercially viable healthcare products is the hallmark of modern university research. At Bhabha University, our dedicated team of pharmaceutical researchers, faculty innovators, and student scholars engineered 14 breakthrough formulations—from advanced antimicrobial ointments to herbal immunomodulators. Here is a look at the methodology, regulatory clearances, and the patent roadmap that made it possible.',
            'content'       => '<p>Translating laboratory discoveries into commercially viable healthcare products is the hallmark of modern university research. At Bhabha University, our dedicated team of pharmaceutical researchers, faculty innovators, and student scholars engineered 14 breakthrough formulations—from advanced antimicrobial ointments to herbal immunomodulators. Here is a look at the methodology, regulatory clearances, and the patent roadmap that made it possible.</p><p>Our state-of-the-art pharmaceutics and pharmacognosy laboratories operate under rigorous cGMP and GLP compliance protocols. The development pipeline engaged multi-disciplinary teams across chemical analysis, stability testing, microbial screening, and clinical safety validations.</p><p>Key commercial approvals achieved include FSSAI, MSME, and MP State Drug Licensing. For further licensing inquiries or collaborative R&D programs, please contact our Directorate of Research.</p>',
            'is_featured'   => 1,
            'status'        => 1
        ],
        [
            'title'         => 'Architecting Resilient Cloud Infrastructure with Edge AI',
            'slug'          => 'architecting-resilient-cloud-edge-ai',
            'category'      => 'tech',
            'category_name' => 'AI & Tech',
            'author_name'   => 'Prof. Amit Sen',
            'author_role'   => 'Dept. of Computer Science & Engineering',
            'publish_date'  => '2026-07-20',
            'read_time'     => '4 min read',
            'tags'          => 'CloudComputing, EdgeAI, IoT',
            'summary'       => 'How distributed edge computing and lightweight machine learning models are transforming real-time data processing in IoT sensors and smart manufacturing.',
            'content'       => '<p>Edge computing brings computation and data storage closer to the sources of data. This improves response times and saves bandwidth. When integrated with lightweight Edge AI models, devices can perform real-time inferences without continuous cloud connectivity, critical in autonomous vehicles, smart farming, and hospital telemedicine equipment.</p><p>In this article, we evaluate tensor quantization methods and resource-constrained inference engines suited for industrial microcontroller platforms tested within our campus robotics and automation lab.</p>',
            'is_featured'   => 0,
            'status'        => 1
        ],
        [
            'title'         => 'Next-Generation Targeted Drug Delivery via Lipid Nanoparticles',
            'slug'          => 'next-generation-targeted-drug-delivery-lnps',
            'category'      => 'pharmacy',
            'category_name' => 'Pharmacy & Health',
            'author_name'   => 'Dr. Manisha Joshi',
            'author_role'   => 'Faculty of Pharmacy',
            'publish_date'  => '2026-06-12',
            'read_time'     => '6 min read',
            'tags'          => 'Nanomedicine, DrugDelivery, PharmaResearch',
            'summary'       => 'A comprehensive exploration of lipid nanoparticle systems in oncology and mRNA therapeutics, minimizing systemic side effects and improving bioavailability.',
            'content'       => '<p>Targeted drug delivery represents one of the most promising frontiers in modern pharmacotherapy. By encapsulating therapeutic agents in engineered lipid nanoparticles (LNPs), drugs can bypass biological barriers and release active ingredients specifically at diseased tissue sites.</p><p>Our research team has synthesized novel ionizable lipids that demonstrate heightened cell transfection rates while reducing non-target organ accumulation in preclinical models.</p>',
            'is_featured'   => 0,
            'status'        => 1
        ],
        [
            'title'         => 'Mastering Technical & HR Interviews in Top Tier Companies',
            'slug'          => 'mastering-technical-hr-interviews-top-companies',
            'category'      => 'career',
            'category_name' => 'Career & Placements',
            'author_name'   => 'T&P Cell Advisory',
            'author_role'   => 'Training & Placement Directorate',
            'publish_date'  => '2026-05-18',
            'read_time'     => '5 min read',
            'tags'          => 'PlacementTips, CareerGrowth, InterviewSkills',
            'summary'       => 'Essential strategies for engineering and management students preparing for campus placement rounds with IT majors, banking giants, and MNCs.',
            'content'       => '<p>Cracking campus placements requires a balance of core domain competence, problem-solving dexterity, and soft skills communication. Focus on Data Structures, fundamental business case studies, active listening, and showcasing live project contributions during technical rounds.</p><p>Mock behavioral interviews and peer problem-solving groups conducted each semester provide students with hands-on exposure to high-pressure screening stages.</p>',
            'is_featured'   => 0,
            'status'        => 1
        ],
        [
            'title'         => 'Navigating the Patent Filing Process for Student Innovators',
            'slug'          => 'navigating-patent-filing-process-student-innovators',
            'category'      => 'research',
            'category_name' => 'Patents & Research',
            'author_name'   => 'IPR Cell Coordinator',
            'author_role'   => 'IPR & Incubation Cell',
            'publish_date'  => '2026-04-10',
            'read_time'     => '7 min read',
            'tags'          => 'Patents, IPR, Innovation',
            'summary'       => 'Step-by-step guidance on prior-art search, patent drafting, provisional applications, and institutional support provided by Bhabha University IPR Cell.',
            'content'       => '<p>Protecting intellectual property early in the development lifecycle gives inventors a significant competitive edge. Bhabha University provides comprehensive legal and financial assistance for eligible student and faculty inventions via our IPR Facilitation Cell.</p><p>We walk aspiring inventors through Indian Patent Office classification schemas, novelty requirements, and drafting claims that withstand scrutiny during examination phases.</p>',
            'is_featured'   => 0,
            'status'        => 1
        ],
        [
            'title'         => 'Sustainable Energy Harvesting for Smart Cities & Campus IoT',
            'slug'          => 'sustainable-energy-harvesting-smart-cities',
            'category'      => 'tech',
            'category_name' => 'AI & Tech',
            'author_name'   => 'Dept. of Electrical Engg',
            'author_role'   => 'Faculty of Engineering & Technology',
            'publish_date'  => '2026-03-25',
            'read_time'     => '4 min read',
            'tags'          => 'CleanTech, GreenEnergy, SmartCampus',
            'summary'       => 'Examining low-power micro-generators, piezoelectric pavements, and solar rooftop integration tested on the Bhabha University green campus.',
            'content'       => '<p>Transitioning towards carbon-neutral smart campuses requires innovative energy harvesting techniques. By deploying localized solar trackers and micro-wind installations, institutions can sustainably power smart streetlights and sensor networks.</p><p>Field measurements collected across 5 campus demonstration sites indicate an average 18% energy self-sufficiency during peak daytime operational loads.</p>',
            'is_featured'   => 0,
            'status'        => 1
        ],
        [
            'title'         => 'Effective Habits for Academic Excellence & Mental Well-being',
            'slug'          => 'effective-habits-academic-excellence-mental-wellbeing',
            'category'      => 'career',
            'category_name' => 'Career & Placements',
            'author_name'   => 'Student Counseling Cell',
            'author_role'   => 'Student Welfare & Counseling Cell',
            'publish_date'  => '2026-02-14',
            'read_time'     => '3 min read',
            'tags'          => 'StudentLife, StudyTips, MentalHealth',
            'summary'       => 'Practical psychological tools, active recall learning methods, and stress resilience practices for university scholars during exam seasons.',
            'content'       => '<p>Academic success is directly linked with cognitive balance and physical health. Implementing spaced repetition, scheduled digital detox intervals, and participating in extracurricular sports significantly enhances memory retention and reduces anxiety.</p><p>The Student Welfare cell hosts regular mindfulness circles, peer counseling seminars, and physical fitness workshops open to all undergraduate and postgraduate cohorts.</p>',
            'is_featured'   => 0,
            'status'        => 1
        ]
    ];

    foreach ($seedBlogs as $b) {
        $db->insert('site_blogs', $b);
    }
    echo "Seeded " . count($seedBlogs) . " initial blog posts into `site_blogs`!\n";
} else {
    echo "Table `site_blogs` already has $count records.\n";
}
