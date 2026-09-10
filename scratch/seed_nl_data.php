<?php
require_once('config.php');

$db->where('page_key', 'newsletter');
$row = $db->getOne('site_portal_pages');
if ($row) {
    $content = [
        'latest' => [
            'title'      => 'Bhabha Chronicle — Q2 2026 Edition',
            'volume'     => 'Vol. 6 | Issue 2',
            'period'     => 'Apr – Jun 2026',
            'badge'      => 'LATEST RELEASE',
            'desc'       => 'Dive into the latest quarterly happenings across all 11 constituent institutes of Bhabha University, featuring major commercial research launches, international academic collaborations, NAAC updates, and our highest placement records.',
            'highlights' => [
                'Launch of 14 Commercial Herbal Formulations (15th August)',
                'Record campus placement offers with TCS, Infosys, Sun Pharma',
                'Inauguration of New AI & Robotics Centre of Excellence',
                'Faculty patent grants in advanced drug delivery systems'
            ],
            'pdf_url'    => 'upload/research/overview.pdf'
        ],
        'archive' => [
            [
                'title'  => 'New Horizons in Innovation & Academic Milestones',
                'vol'    => 'Vol. 6 | Issue 1',
                'date'   => 'Jan – Mar 2026',
                'size'   => '16 Pages • PDF',
                'topics' => [
                    'National Conference on Smart Computing & IoT Solutions',
                    'Annual Sports Meet & Cultural Fest \'Tarang 2026\'',
                    'Launch of Entrepreneurship & Incubation EDC Cell'
                ],
                'url'    => 'upload/research/overview.pdf'
            ],
            [
                'title'  => 'Convocation Special & Industry Collaboration Report',
                'vol'    => 'Vol. 5 | Issue 4',
                'date'   => 'Oct – Dec 2025',
                'size'   => '20 Pages • PDF',
                'topics' => [
                    '5th Annual University Convocation & Gold Medalists',
                    'MOU Signing with leading pharmaceutical & IT giants',
                    'Winter Faculty Development Programme (FDP) outcomes'
                ],
                'url'    => 'upload/research/overview.pdf'
            ],
            [
                'title'  => 'Pharmacy Research & Healthcare Outreach Focus',
                'vol'    => 'Vol. 5 | Issue 3',
                'date'   => 'Jul – Sep 2025',
                'size'   => '18 Pages • PDF',
                'topics' => [
                    'Community Health Camps conducted across Bhopal district',
                    'International Pharmacy Week & Clinical Trial Workshop',
                    'Student innovators receive State Science Council Grant'
                ],
                'url'    => 'upload/research/overview.pdf'
            ],
            [
                'title'  => 'Engineering Innovations & Smart Campus Upgrades',
                'vol'    => 'Vol. 5 | Issue 2',
                'date'   => 'Apr – Jun 2025',
                'size'   => '16 Pages • PDF',
                'topics' => [
                    'Solar-powered green campus initiative completion',
                    'Hackathon 2025 winners develop Agriculture IoT kit',
                    'Alumni Mentorship series conducted across all departments'
                ],
                'url'    => 'upload/research/overview.pdf'
            ],
            [
                'title'  => 'Academic Year Kickoff & Placement Milestones',
                'vol'    => 'Vol. 5 | Issue 1',
                'date'   => 'Jan – Mar 2025',
                'size'   => '14 Pages • PDF',
                'topics' => [
                    'Orientation of 2025 academic batch across 50+ courses',
                    'Over 850 campus placement offers recorded in Phase 1',
                    'IQAC quality enhancement framework rollout'
                ],
                'url'    => 'upload/research/overview.pdf'
            ],
            [
                'title'  => '20 Years of Educational Excellence — 2004 to 2024',
                'vol'    => 'Vol. 4 | Special Issue',
                'date'   => 'Annual Roundup 2024',
                'size'   => '32 Pages • PDF',
                'topics' => [
                    'Two-decade institutional milestone commemorative report',
                    'Notable Alumni hall of fame & global contributions',
                    'Strategic 2030 vision roadmap of Bhabha University'
                ],
                'url'    => 'upload/research/overview.pdf'
            ]
        ]
    ];

    $db->where('id', $row['id']);
    $db->update('site_portal_pages', [
        'content_data' => json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        'updated_at'   => date('Y-m-d H:i:s')
    ]);
    echo "Successfully seeded newsletter page with 6 editions and featured issue!\n";
} else {
    echo "Newsletter row not found in site_portal_pages!\n";
}
