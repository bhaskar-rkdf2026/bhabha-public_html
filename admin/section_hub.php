<?php
/**
 * section_hub.php
 * Bhabha University - Section-wise Visual Page Management Hub
 * Direct link mapping between Frontend Menu Tabs and Admin Edit Screens
 */
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');

$currPage = 'section_hub.php';
$activeSection = isset($_GET['section']) ? trim($_GET['section']) : 'all';

// Define the comprehensive mapping of Frontend Sections -> Admin Edit Targets
$sections = [
    'about' => [
        'title' => 'About University',
        'icon'  => 'mdi mdi-bank',
        'desc'  => 'Manage University Overview, Leadership, Vision, Mission, Infrastructure, Approvals & Accreditations.',
        'pages' => [
            [
                'title'       => 'University Overview & Story',
                'nav_path'    => 'Frontend Nav > About > University Overview',
                'live_url'    => URL_ROOT . 'university.php',
                'edit_url'    => 'university_overview.php',
                'icon'        => 'mdi mdi-bank',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Chancellor message, VC message, University history, key statistics & highlights.'
            ],
            [
                'title'       => 'Administration & Leadership',
                'nav_path'    => 'Frontend Nav > About > Administration & Leadership',
                'live_url'    => URL_ROOT . 'leadership.php',
                'edit_url'    => 'leadership.php',
                'add_url'     => 'leadership.php?action=add',
                'icon'        => 'mdi mdi-account-star',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Board of Governors, Chancellor, Pro-Chancellor, VC, Registrar, Deans and Directors.'
            ],
            [
                'title'       => 'Vision, Mission & Core Values',
                'nav_path'    => 'Frontend Nav > About > Vision & Mission / Values',
                'live_url'    => URL_ROOT . 'mission-vision.php',
                'edit_url'    => 'university_overview.php',
                'icon'        => 'mdi mdi-compass-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Institutional vision, mission statements, educational philosophy and core values.'
            ],
            [
                'title'       => 'Campus & Infrastructure',
                'nav_path'    => 'Frontend Nav > About > Campus & Infrastructure',
                'live_url'    => URL_ROOT . 'infrastructure.php',
                'edit_url'    => 'infrastructure.php',
                'add_url'     => 'infrastructure.php?action=add',
                'icon'        => 'mdi mdi-image-area',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Smart classrooms, laboratories, libraries, hostels, sports complex and auditorium photos.'
            ],
            [
                'title'       => 'Approvals & Recognitions',
                'nav_path'    => 'Frontend Nav > About > Approvals & Recognitions',
                'live_url'    => URL_ROOT . 'approvals.php',
                'edit_url'    => 'approvals.php',
                'add_url'     => 'approvals.php?action=add',
                'icon'        => 'mdi mdi-check-decagram',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'UGC, AICTE, PCI, DCI, INC, NCTE, BCI regulatory approval documents & certificates.'
            ],
            [
                'title'       => 'Cells & Committees',
                'nav_path'    => 'Frontend Nav > About > Cells & Committees',
                'live_url'    => URL_ROOT . 'advisory.php',
                'edit_url'    => 'advisory.php',
                'add_url'     => 'advisory.php?action=add',
                'icon'        => 'mdi mdi-account-group',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Advisory Board, Anti-Ragging Committee, Internal Complaints Committee (ICC), IQAC.'
            ],
            [
                'title'       => 'Awards & Achievements',
                'nav_path'    => 'Frontend Nav > About > Awards & Achievements',
                'live_url'    => URL_ROOT . 'awards.php',
                'edit_url'    => 'awards.php',
                'add_url'     => 'awards.php?action=add',
                'icon'        => 'mdi mdi-trophy',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'National and international honors, excellence awards, and university recognitions.'
            ],
            [
                'title'       => 'Affiliations & Collaborations',
                'nav_path'    => 'Frontend Nav > About > Affiliations',
                'live_url'    => URL_ROOT . 'affiliate.php',
                'edit_url'    => 'affiliate.php',
                'add_url'     => 'affiliate.php?action=add',
                'icon'        => 'mdi mdi-shield-check',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'State councils, professional bodies, and institutional affiliations.'
            ],
            [
                'title'       => 'Reports & Accreditations (NIRF / NAAC / Audit)',
                'nav_path'    => 'Frontend Nav > About > Audit Report / Reports',
                'live_url'    => URL_ROOT . 'auditreport.php',
                'edit_url'    => 'reports_accreditation.php',
                'add_url'     => 'reports_accreditation.php?action=add',
                'icon'        => 'mdi mdi-file-pdf-box',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Annual audit reports, financial disclosures, NIRF data, and UGC proforma documents.'
            ]
        ]
    ],
    'schools' => [
        'title' => 'Institutes',
        'icon'  => 'mdi mdi-school',
        'desc'  => 'Manage 16 Faculties/Institutes, Academic Departments, Sub-Departments, Courses and Branches.',
        'pages' => [
            [
                'title'       => 'Faculties & Institutes',
                'nav_path'    => 'Frontend Nav > Institutes > All Institutes',
                'live_url'    => URL_ROOT . 'institutes.php',
                'edit_url'    => 'institute.php',
                'add_url'     => 'institute.php?action=add',
                'icon'        => 'mdi mdi-city',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Engineering, Pharmacy, Dental, Management, Nursing, Paramedical, Agriculture, Law, etc.'
            ],
            [
                'title'       => 'Academic Departments',
                'nav_path'    => 'Frontend Nav > Institutes > Department View',
                'live_url'    => URL_ROOT . 'department.php',
                'edit_url'    => 'department.php',
                'add_url'     => 'department.php?action=add',
                'icon'        => 'mdi mdi-domain',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Department details, Head of Department (HOD) messages, faculties, and laboratory equipment.'
            ],
            [
                'title'       => 'Sub Departments & Units',
                'nav_path'    => 'Frontend Nav > Institutes > Sub-Departments',
                'live_url'    => URL_ROOT . 'institutes.php',
                'edit_url'    => 'sub_department.php',
                'add_url'     => 'sub_department.php?action=add',
                'icon'        => 'mdi mdi-folder-network',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Specialized wings, division labs, and branch centers under each department.'
            ],
            [
                'title'       => 'Courses, Intake & Eligibility',
                'nav_path'    => 'Frontend Nav > Admissions > Courses, Intake & Eligibility',
                'live_url'    => URL_ROOT . 'course.php',
                'edit_url'    => 'course.php',
                'add_url'     => 'course.php?action=add',
                'icon'        => 'mdi mdi-book-multiple',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'UG, PG, Diploma and Doctoral degree programs, sanctioned seats, durations and eligibility.'
            ],
            [
                'title'       => 'Branches & Specializations',
                'nav_path'    => 'Frontend Nav > Academics > Branch Directory',
                'live_url'    => URL_ROOT . 'institutes.php',
                'edit_url'    => 'branch.php',
                'add_url'     => 'branch.php?action=add',
                'icon'        => 'mdi mdi-source-branch',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'CSE, AI & Data Science, Mechanical, Pharmaceutics, Orthodontics, MBA Finance, etc.'
            ]
        ]
    ],
    'academics' => [
        'title' => 'Academics & Examinations',
        'icon'  => 'mdi mdi-book-open-page-variant',
        'desc'  => 'Manage Academic Calendars, Scheme & Syllabus, Examination Time Tables, Guidelines and E-Resources.',
        'pages' => [
            [
                'title'       => 'Academic Calendar',
                'nav_path'    => 'Frontend Nav > Academics > Academic Calendar',
                'live_url'    => URL_ROOT . 'academic.php',
                'edit_url'    => 'academic.php',
                'add_url'     => 'academic.php?action=add',
                'icon'        => 'mdi mdi-calendar-clock',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Session start dates, semester schedules, holiday lists, mid-term and final exam periods.'
            ],
            [
                'title'       => 'Scheme & Syllabus',
                'nav_path'    => 'Frontend Nav > Academics > Scheme & Syllabus',
                'live_url'    => URL_ROOT . 'syllabus.php',
                'edit_url'    => 'syllabus.php',
                'add_url'     => 'syllabus.php?action=add',
                'icon'        => 'mdi mdi-file-tree',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Course curriculum structures, semester-wise subject schemes and downloadable syllabus PDFs.'
            ],
            [
                'title'       => 'Examination Time Table',
                'nav_path'    => 'Frontend Nav > Academics > Exam Time Table',
                'live_url'    => URL_ROOT . 'time-table.php',
                'edit_url'    => 'timetable.php',
                'add_url'     => 'timetable.php?action=add',
                'icon'        => 'mdi mdi-calendar-text',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Upcoming semester exam schedules, shift timings, center notifications and time table PDFs.'
            ],
            [
                'title'       => 'Online Examination Guidelines',
                'nav_path'    => 'Frontend Nav > Academics > Online Examination Process',
                'live_url'    => URL_ROOT . 'page.php?id=16',
                'edit_url'    => 'pages.php?action=edit&id=16',
                'icon'        => 'mdi mdi-laptop-mac',
                'badge'       => 'Page #16',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Instructions for online examination portal, student login guidelines and dos & don\'ts.'
            ],
            [
                'title'       => 'MOUs & Academic Collaborations',
                'nav_path'    => 'Frontend Nav > Academics > MOU & Collaborations',
                'live_url'    => URL_ROOT . 'page.php?id=9',
                'edit_url'    => 'pages.php?action=edit&id=9',
                'icon'        => 'mdi mdi-handshake',
                'badge'       => 'Page #9',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Industry tie-ups, corporate partner MOUs, and international university academic linkages.'
            ],
            [
                'title'       => 'Online Video Resources & E-Learning',
                'nav_path'    => 'Frontend Nav > Academics > Online Video Resources',
                'live_url'    => URL_ROOT . 'page.php?id=8',
                'edit_url'    => 'pages.php?action=edit&id=8',
                'icon'        => 'mdi mdi-youtube',
                'badge'       => 'Page #8',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Faculty video lectures, digital course content links, NPTEL and Swayam e-learning links.'
            ],
            [
                'title'       => 'Previous Question Papers',
                'nav_path'    => 'Frontend Nav > Academics > Previous Question Papers',
                'live_url'    => URL_ROOT . 'BUQuestionPapers_demo.php',
                'edit_url'    => 'timetable.php',
                'icon'        => 'mdi mdi-file-question',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Previous years university question papers archive for student exam preparation.'
            ]
        ]
    ],
    'admissions' => [
        'title' => 'Admissions & Leads',
        'icon'  => 'mdi mdi-account-plus',
        'desc'  => 'Manage Student Registrations, Fee Structures, Bank Details, Course Enquiries and Helpline Numbers.',
        'pages' => [
            [
                'title'       => 'Online Registration & Applications',
                'nav_path'    => 'Frontend Nav > Admissions > Online Registration Form',
                'live_url'    => URL_ROOT . 'online-admission.php',
                'edit_url'    => 'admission.php',
                'icon'        => 'mdi mdi-account-check',
                'badge'       => 'Applications DB',
                'badge_cls'   => 'bu-badge-leads',
                'desc'        => 'View candidate admission applications, document attachments, applicant search and status.'
            ],
            [
                'title'       => 'Admission Enquiry & Leads',
                'nav_path'    => 'Frontend Nav > Admissions > Admission Enquiry & Eligibility',
                'live_url'    => URL_ROOT . 'enquiry.php',
                'edit_url'    => 'enquiry.php',
                'icon'        => 'mdi mdi-help-circle',
                'badge'       => 'Leads DB',
                'badge_cls'   => 'bu-badge-leads',
                'desc'        => 'Track prospective student enquiries submitted across website with quick filters & export.'
            ],
            [
                'title'       => 'Fee Structure (All Programs)',
                'nav_path'    => 'Frontend Nav > Admissions > Fee Structure',
                'live_url'    => URL_ROOT . 'fees.php',
                'edit_url'    => 'fees.php',
                'icon'        => 'mdi mdi-currency-inr',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Course tuition fees, semester fee breakdown, hostel fees, bus fees and payment rules.'
            ],
            [
                'title'       => 'University Bank Account Details',
                'nav_path'    => 'Frontend Nav > Admissions > University Bank Account Details',
                'live_url'    => URL_ROOT . 'page.php?id=1',
                'edit_url'    => 'pages.php?action=edit&id=1',
                'icon'        => 'mdi mdi-bank-transfer',
                'badge'       => 'Page #1',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Official university bank name, account numbers, IFSC codes, branch addresses & QR code info.'
            ],
            [
                'title'       => 'Admission Helpline & Contact Numbers',
                'nav_path'    => 'Frontend Nav > Admissions > Admission Helpline Numbers',
                'live_url'    => URL_ROOT . 'page.php?id=24',
                'edit_url'    => 'pages.php?action=edit&id=24',
                'icon'        => 'mdi mdi-phone-classic',
                'badge'       => 'Page #24',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Admission counseling mobile numbers, WhatsApp lines, email IDs and office working hours.'
            ],
            [
                'title'       => 'Online Fee Payment Instructions',
                'nav_path'    => 'Frontend Nav > Admissions > Online Fee Payment',
                'live_url'    => URL_ROOT . 'page.php?id=2',
                'edit_url'    => 'pages.php?action=edit&id=2',
                'icon'        => 'mdi mdi-credit-card-outline',
                'badge'       => 'Page #2',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Step-by-step guidance for online payment gateway, transaction receipts, refund policy.'
            ],
            [
                'title'       => 'Vocational Courses - Media & Journalism',
                'nav_path'    => 'Frontend Nav > Admissions > Vocational Courses - Media',
                'live_url'    => URL_ROOT . 'page.php?id=6',
                'edit_url'    => 'pages.php?action=edit&id=6',
                'icon'        => 'mdi mdi-video',
                'badge'       => 'Page #6',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Short term diploma and certificate vocational courses in media, broadcasting & editing.'
            ],
            [
                'title'       => 'General Contact Inquiries',
                'nav_path'    => 'Frontend Nav > Contact',
                'live_url'    => URL_ROOT . 'contact.php',
                'edit_url'    => 'inquiry.php',
                'icon'        => 'mdi mdi-email-open-outline',
                'badge'       => 'Inquiries DB',
                'badge_cls'   => 'bu-badge-leads',
                'desc'        => 'General visitor queries submitted via Contact Us form with reply tracking.'
            ]
        ]
    ],
    'research' => [
        'title' => 'Research & Innovation',
        'icon'  => 'mdi mdi-flask',
        'desc'  => 'Manage Research Labs, Commercial Products, Incubation Centre, Journals, Grants and PhD Scholars.',
        'pages' => [
            [
                'title'       => 'Research & Innovation Portal',
                'nav_path'    => 'Frontend Nav > Research > Research & Innovation Portal',
                'live_url'    => URL_ROOT . 'research.php',
                'edit_url'    => 'research.php',
                'icon'        => 'mdi mdi-flask-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Pharmacy research labs, commercial product launches, EDC incubation center, research domains.'
            ],
            [
                'title'       => 'Research at a Glance',
                'nav_path'    => 'Frontend Nav > Research > Research At Glance',
                'live_url'    => URL_ROOT . 'page.php?id=3',
                'edit_url'    => 'pages.php?action=edit&id=3',
                'icon'        => 'mdi mdi-chart-line',
                'badge'       => 'Page #3',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'University research overview, key stats, innovation roadmap and faculty achievements.'
            ],
            [
                'title'       => 'Funding Agencies & Grants',
                'nav_path'    => 'Frontend Nav > Research > Funding Agency',
                'live_url'    => URL_ROOT . 'page.php?id=4',
                'edit_url'    => 'pages.php?action=edit&id=4',
                'icon'        => 'mdi mdi-cash-multiple',
                'badge'       => 'Page #4',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'DST, SERB, MPCST, DBT and private funded research projects and sponsored grants.'
            ],
            [
                'title'       => 'Research Publications & Papers',
                'nav_path'    => 'Frontend Nav > Research > Publication',
                'live_url'    => URL_ROOT . 'page.php?id=5',
                'edit_url'    => 'pages.php?action=edit&id=5',
                'icon'        => 'mdi mdi-file-document',
                'badge'       => 'Page #5',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'SCOPUS, Web of Science, UGC CARE publications authored by Bhabha faculty & students.'
            ],
            [
                'title'       => 'Journals & Proceedings',
                'nav_path'    => 'Frontend Nav > Research > Journal',
                'live_url'    => URL_ROOT . 'page.php?id=15',
                'edit_url'    => 'pages.php?action=edit&id=15',
                'icon'        => 'mdi mdi-book-open',
                'badge'       => 'Page #15',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Peer-reviewed journals published by University institutes and editorial boards.'
            ],
            [
                'title'       => 'PhD Scholars Directory',
                'nav_path'    => 'Frontend Nav > Research > PhD Student (List)',
                'live_url'    => URL_ROOT . 'page.php?id=14',
                'edit_url'    => 'pages.php?action=edit&id=14',
                'icon'        => 'mdi mdi-school',
                'badge'       => 'Page #14',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'List of enrolled doctoral candidates, research guides, thesis topics and award years.'
            ],
            [
                'title'       => 'Conferences, Seminars & Workshops',
                'nav_path'    => 'Frontend Nav > Research > Conference /Seminar',
                'live_url'    => URL_ROOT . 'page.php?id=10',
                'edit_url'    => 'pages.php?action=edit&id=10',
                'icon'        => 'mdi mdi-presentation',
                'badge'       => 'Page #10',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'National/International conferences, faculty development programs (FDP) and symposiums.'
            ],
            [
                'title'       => 'Industrial Visits & Practical Training',
                'nav_path'    => 'Frontend Nav > Research > Industrial Visits',
                'live_url'    => URL_ROOT . 'page.php?id=11',
                'edit_url'    => 'pages.php?action=edit&id=11',
                'icon'        => 'mdi mdi-factory',
                'badge'       => 'Page #11',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Factory visits, power plant exposure, pharmaceutical plant tours and site trips.'
            ],
            [
                'title'       => 'Research & Tech Blogs',
                'nav_path'    => 'Frontend Nav > News & Media > Research & Tech Blogs',
                'live_url'    => URL_ROOT . 'blogs.php',
                'edit_url'    => 'blogs.php',
                'add_url'     => 'blogs.php?action=add',
                'icon'        => 'mdi mdi-newspaper',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Articles, emerging technology insights, AI trends and academic opinion pieces.'
            ]
        ]
    ],
    'placements' => [
        'title' => 'Placements & Careers',
        'icon'  => 'mdi mdi-briefcase-check',
        'desc'  => 'Manage Training & Placement Cell, Top Recruiters, Placement Testimonials and Job Vacancies.',
        'pages' => [
            [
                'title'       => 'Placement Cell & Overview',
                'nav_path'    => 'Frontend Nav > Placements > Training & Placement Cell',
                'live_url'    => URL_ROOT . 'placements.php',
                'edit_url'    => 'recruiters.php',
                'icon'        => 'mdi mdi-handshake-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'T&P cell message, highest packages, average CTC, industry partners and placement records.'
            ],
            [
                'title'       => 'Placement Recruiters & Corporate Partners',
                'nav_path'    => 'Frontend Nav > Placements > Our Major Recruiters',
                'live_url'    => URL_ROOT . 'placements.php',
                'edit_url'    => 'recruiters.php',
                'add_url'     => 'recruiters.php?action=add',
                'icon'        => 'mdi mdi-domain',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'TCS, Infosys, Wipro, Cipla, Sun Pharma, L&T, HCL and top hiring partner logos.'
            ],
            [
                'title'       => 'Star Alumni Achievers & Posters',
                'nav_path'    => 'Frontend Nav > Placements / Alumni > Distinguished Alumni',
                'live_url'    => URL_ROOT . 'alumni.php',
                'edit_url'    => 'alumni_achievers.php',
                'add_url'     => 'alumni_achievers.php?action=add',
                'icon'        => 'mdi mdi-star-circle',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => '60 LPA milestone packages, UPSC IES officers, IIT selections, and star alumni posters.'
            ],
            [
                'title'       => 'Student Placement Testimonials',
                'nav_path'    => 'Frontend Nav > Placements / Home > Testimonials',
                'live_url'    => URL_ROOT . 'placements.php',
                'edit_url'    => 'testimonial.php',
                'add_url'     => 'testimonial.php?action=add',
                'icon'        => 'mdi mdi-comment-account-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Placed student reviews, company logos, package packages, and alumni success stories.'
            ],
            [
                'title'       => 'Job Openings & Career Opportunities',
                'nav_path'    => 'Frontend Footer > Careers',
                'live_url'    => URL_ROOT . 'jobs.php',
                'edit_url'    => 'jobs.php',
                'add_url'     => 'jobs.php?action=add',
                'icon'        => 'mdi mdi-briefcase',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Faculty recruitment, administrative openings, professor vacancies and online job applications.'
            ]
        ]
    ],
    'news' => [
        'title' => 'News, Media & Events',
        'icon'  => 'mdi mdi-bullhorn',
        'desc'  => 'Manage Daily News Updates, Official Notices, Scroll Announcements, Events and Photo Galleries.',
        'pages' => [
            [
                'title'       => 'News Updates (Date-wise)',
                'nav_path'    => 'Frontend Nav > News & Media > Latest News & Events',
                'live_url'    => URL_ROOT . 'news.php',
                'edit_url'    => 'news.php',
                'add_url'     => 'news.php?action=add',
                'icon'        => 'mdi mdi-bullhorn-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-media',
                'desc'        => 'University happenings, press releases, dated news updates with attachments & filter support.'
            ],
            [
                'title'       => 'Official Notices & Circulars',
                'nav_path'    => 'Frontend Nav > News & Media > Official Notices',
                'live_url'    => URL_ROOT . 'notice.php',
                'edit_url'    => 'notice.php',
                'add_url'     => 'notice.php?action=add',
                'icon'        => 'mdi mdi-clipboard-text-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-media',
                'desc'        => 'Administrative orders, student circulars, examination updates and regulatory notifications.'
            ],
            [
                'title'       => 'Ticker Announcements',
                'nav_path'    => 'Frontend Top Header > Flash News',
                'live_url'    => URL_ROOT . 'index.php',
                'edit_url'    => 'announcements.php',
                'add_url'     => 'announcements.php?action=add',
                'icon'        => 'mdi mdi-bell-ring-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-media',
                'desc'        => 'Top header marquee ticker, flashing flash alerts and high-priority broadcast messages.'
            ],
            [
                'title'       => 'Events, Fests & Workshops',
                'nav_path'    => 'Frontend Nav > News & Media > Events',
                'live_url'    => URL_ROOT . 'index.php#events',
                'edit_url'    => 'events.php',
                'add_url'     => 'events.php?action=add',
                'icon'        => 'mdi mdi-calendar-star',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-media',
                'desc'        => 'Annual cultural fest, tech fest, sports meet, guest lectures and celebrity concerts.'
            ],
            [
                'title'       => 'Media Coverage & Press Clippings',
                'nav_path'    => 'Frontend Nav > News & Media > Media Coverage',
                'live_url'    => URL_ROOT . 'media.php',
                'edit_url'    => 'media.php',
                'add_url'     => 'media.php?action=add',
                'icon'        => 'mdi mdi-newspaper-variant-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-media',
                'desc'        => 'Print newspaper coverage clippings, TV channel video links and media kits.'
            ],
            [
                'title'       => 'Photo & Event Gallery',
                'nav_path'    => 'Frontend Nav > News & Media > Photo Gallery',
                'live_url'    => URL_ROOT . 'gallery.php',
                'edit_url'    => 'gallery.php',
                'add_url'     => 'gallery.php?action=add',
                'icon'        => 'mdi mdi-image-multiple-outline',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-media',
                'desc'        => 'Convocation ceremony photos, campus life albums, laboratory photos and seminar galleries.'
            ]
        ]
    ],
    'student' => [
        'title' => 'Student Corner & Governance',
        'icon'  => 'mdi mdi-account-group',
        'desc'  => 'Manage Grievance Cell, Alumni Network, Legal Policies, Magazines and Special Campus Features.',
        'pages' => [
            [
                'title'       => 'Student Grievance Redressal Cell',
                'nav_path'    => 'Frontend Header > Grievance Cell',
                'live_url'    => URL_ROOT . 'grievance.php',
                'edit_url'    => 'grievance.php',
                'icon'        => 'mdi mdi-comment-alert-outline',
                'badge'       => 'Grievances DB',
                'badge_cls'   => 'bu-badge-leads',
                'desc'        => 'Online student grievance submissions, committee reviews, tracking ticket numbers and resolutions.'
            ],
            [
                'title'       => 'Alumni Association & Registrations',
                'nav_path'    => 'Frontend Topbar > Alumni Portal',
                'live_url'    => URL_ROOT . 'alumni.php',
                'edit_url'    => 'alumni.php',
                'icon'        => 'mdi mdi-account-star-outline',
                'badge'       => 'Alumni DB',
                'badge_cls'   => 'bu-badge-leads',
                'desc'        => 'Registered alumni directory, batch records, career locations, alumni meetups.'
            ],
            [
                'title'       => 'Legal Policies & Disclosures',
                'nav_path'    => 'Frontend Footer > Policies',
                'live_url'    => URL_ROOT . 'privacy-policy.php',
                'edit_url'    => 'policies.php',
                'add_url'     => 'policies.php?action=add',
                'icon'        => 'mdi mdi-scale-balance',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Privacy Policy, Terms & Conditions, Anti-Ragging Policy, Equal Opportunity & RTI Disclosures.'
            ],
            [
                'title'       => 'Student Publications & Magazines',
                'nav_path'    => 'Frontend Nav > News & Media > University Magazine',
                'live_url'    => URL_ROOT . 'magazine.php',
                'edit_url'    => 'student_publications.php',
                'add_url'     => 'student_publications.php?action=add',
                'icon'        => 'mdi mdi-book-open-page-variant',
                'badge'       => 'Dedicated Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Annual university magazines, student creative writing e-books and departmental newsletters.'
            ],
            [
                'title'       => 'NAD (National Academic Depository)',
                'nav_path'    => 'Frontend Topbar > NAD',
                'live_url'    => URL_ROOT . 'page.php?id=25',
                'edit_url'    => 'pages.php?action=edit&id=25',
                'icon'        => 'mdi mdi-certificate-outline',
                'badge'       => 'Page #25',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'DigiLocker and NAD integration details, student academic degree verification process.'
            ],
            [
                'title'       => 'Solar Plant & Green Campus',
                'nav_path'    => 'Frontend > Sustainability',
                'live_url'    => URL_ROOT . 'page.php?id=22',
                'edit_url'    => 'pages.php?action=edit&id=22',
                'icon'        => 'mdi mdi-solar-power',
                'badge'       => 'Page #22',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'On-campus clean energy solar installation, capacity, environmental impact and green campus initiative.'
            ],
            [
                'title'       => 'Campus Radio (Bhabha Vani)',
                'nav_path'    => 'Frontend > Campus Radio',
                'live_url'    => URL_ROOT . 'page.php?id=23',
                'edit_url'    => 'pages.php?action=edit&id=23',
                'icon'        => 'mdi mdi-radio-tower',
                'badge'       => 'Page #23',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Community radio station frequency, live broadcast schedule, educational programs and student RJ team.'
            ]
        ]
    ],
    'system' => [
        'title' => 'System & SEO Settings',
        'icon'  => 'mdi mdi-cog-outline',
        'desc'  => 'Homepage Content Layout, SEO Meta Tags, Master Database Pages and System Configurations.',
        'pages' => [
            [
                'title'       => 'Homepage Sections Manager',
                'nav_path'    => 'Frontend > Homepage (index.php)',
                'live_url'    => URL_ROOT . 'index.php',
                'edit_url'    => 'homepage_sections.php',
                'icon'        => 'mdi mdi-view-quilt',
                'badge'       => 'System Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Control visibility, order, badges and content of all homepage sections & dynamic widgets.'
            ],
            [
                'title'       => 'SEO & Meta Tag Manager',
                'nav_path'    => 'All Pages > Google Search Indexing',
                'live_url'    => URL_ROOT,
                'edit_url'    => 'seo.php',
                'icon'        => 'mdi mdi-google',
                'badge'       => 'SEO Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Page titles, meta descriptions, focus keywords, OpenGraph image tags and canonical URLs.'
            ],
            [
                'title'       => 'Website Pages Directory (Page Table)',
                'nav_path'    => 'All Database Dynamic Pages',
                'live_url'    => URL_ROOT . 'pages.php',
                'edit_url'    => 'pages.php',
                'add_url'     => 'pages.php?action=add',
                'icon'        => 'mdi mdi-file-document-box-multiple',
                'badge'       => 'Page Table',
                'badge_cls'   => 'bu-badge-page',
                'desc'        => 'Direct table view of all 17+ static & dynamic HTML pages in the database.'
            ],
            [
                'title'       => 'General University Settings',
                'nav_path'    => 'Website Header, Footer & Global Contacts',
                'live_url'    => URL_ROOT,
                'edit_url'    => 'settings.php',
                'icon'        => 'mdi mdi-tune',
                'badge'       => 'System Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'University phone numbers, official email IDs, campus address, social media links.'
            ],
            [
                'title'       => 'Quick Footer Links Manager',
                'nav_path'    => 'Frontend Footer > Quick Links',
                'live_url'    => URL_ROOT,
                'edit_url'    => 'links.php',
                'add_url'     => 'links.php?action=add',
                'icon'        => 'mdi mdi-link-variant',
                'badge'       => 'System Module',
                'badge_cls'   => 'bu-badge-module',
                'desc'        => 'Government portals, UGC links, exam portals and external institutional hyperlinks.'
            ]
        ]
    ]
];

// Calculate totals
$totalPagesCount = 0;
foreach ($sections as $secKey => $secData) {
    $totalPagesCount += count($secData['pages']);
}

// Filter pages based on active section
$displaySections = [];
if ($activeSection === 'all' || !isset($sections[$activeSection])) {
    $displaySections = $sections;
} else {
    $displaySections[$activeSection] = $sections[$activeSection];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>Section-wise Page Manager - Bhabha University Admin</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php include_once("inc.meta.php"); ?>
</head>
<body class="fixed-left">
<div id="wrapper">
  <?php include_once("inc.menu.php"); ?>
  <div class="content-page">
    <div class="content">
      <?php include_once("inc.top.php"); ?>
      
      <div class="page-content-wrapper">
        <div class="container-fluid">

          <!-- Breadcrumbs -->
          <div class="row">
            <div class="col-sm-12">
              <div class="page-title-box">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <h4 class="page-title m-0">Section-wise Page Manager</h4>
                    <p class="text-muted m-0" style="font-size: 13px;">
                      Frontend ke main menu ke according sare pages organized hain. Kisi bhi page ko 1-click me edit ya live view karein.
                    </p>
                  </div>
                  <div class="col-md-4 text-right">
                    <a href="pages.php?action=add" class="btn btn-warning btn-sm shadow-sm" style="font-weight:700; color:#0A1B54 !important; background:#FFC107 !important; border:none; border-radius:6px; padding:7px 14px;">
                      <i class="mdi mdi-plus-circle"></i> Add New Page
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Section Banner -->
          <div class="bu-hub-header">
            <div class="bu-hub-title">
              <i class="<?php echo ($activeSection === 'all' || !isset($sections[$activeSection])) ? 'mdi mdi-view-dashboard-outline' : $sections[$activeSection]['icon']; ?>" style="color: #FFC107;"></i>
              <span><?php echo ($activeSection === 'all' || !isset($sections[$activeSection])) ? 'All Website Sections & Pages Directory' : $sections[$activeSection]['title']; ?></span>
            </div>
            <p class="bu-hub-subtitle">
              <?php echo ($activeSection === 'all' || !isset($sections[$activeSection])) ? 'Ab aapko koi bhi page dhundne ki zaroorat nahi hai. Frontend Navigation tabs (About, Institutes, Academics, Admissions, Research, Placements, News) ke according categorized hain.' : $sections[$activeSection]['desc']; ?>
            </p>
          </div>

          <!-- Section Filter Navigation Pills -->
          <div class="bu-hub-nav">
            <a href="section_hub.php?section=all" class="bu-hub-pill <?php echo ($activeSection === 'all') ? 'active' : ''; ?>">
              <i class="mdi mdi-apps"></i> All Sections (<?php echo $totalPagesCount; ?>)
            </a>
            <?php foreach ($sections as $k => $sec): ?>
              <a href="section_hub.php?section=<?php echo $k; ?>" class="bu-hub-pill <?php echo ($activeSection === $k) ? 'active' : ''; ?>">
                <i class="<?php echo $sec['icon']; ?>"></i> <?php echo $sec['title']; ?> (<?php echo count($sec['pages']); ?>)
              </a>
            <?php endforeach; ?>
          </div>

          <!-- Live Instant Search Box -->
          <div class="bu-hub-search-box">
            <i class="mdi mdi-magnify"></i>
            <input type="text" id="hubPageSearch" class="form-control" placeholder="Search any page by name, topic, or module (e.g. Fee, Leadership, Syllabus, Exam, Bank, Research, Approvals)..." autocomplete="off">
          </div>

          <!-- Sections and Page Cards -->
          <?php foreach ($displaySections as $secKey => $sec): ?>
            <div class="bu-section-block mb-4" data-section="<?php echo $secKey; ?>">
              
              <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 2px solid #E2E8F0;">
                <h5 class="m-0" style="font-weight: 800; color: #0A1B54; font-size: 17px;">
                  <i class="<?php echo $sec['icon']; ?> text-warning mr-1"></i> <?php echo $sec['title']; ?>
                  <span class="badge badge-secondary" style="font-size: 11px; vertical-align: middle; margin-left: 6px; background: #64748B;"><?php echo count($sec['pages']); ?> Pages</span>
                </h5>
                <span class="text-muted" style="font-size: 12px;"><?php echo $sec['desc']; ?></span>
              </div>

              <div class="bu-hub-grid">
                <?php foreach ($sec['pages'] as $page): ?>
                  <div class="bu-hub-card" data-title="<?php echo strtolower(htmlspecialchars($page['title'] . ' ' . $page['desc'] . ' ' . $page['nav_path'])); ?>">
                    
                    <div>
                      <div class="bu-hub-card-header">
                        <div class="bu-hub-icon-wrap">
                          <i class="<?php echo $page['icon']; ?>"></i>
                        </div>
                        <div style="flex: 1; min-width: 0;">
                          <div class="d-flex align-items-center justify-content-between">
                            <span class="bu-hub-badge <?php echo $page['badge_cls']; ?>"><?php echo $page['badge']; ?></span>
                          </div>
                          <h6 class="bu-hub-card-title mt-1"><?php echo $page['title']; ?></h6>
                          <span class="bu-hub-card-route"><i class="mdi mdi-compass-outline mr-1"></i><?php echo $page['nav_path']; ?></span>
                        </div>
                      </div>

                      <p class="bu-hub-card-desc"><?php echo $page['desc']; ?></p>
                    </div>

                    <div class="bu-hub-card-footer">
                      <a href="<?php echo $page['live_url']; ?>" target="_blank" class="bu-btn-hub-live" title="Open Frontend Page in new tab">
                        <i class="mdi mdi-open-in-new"></i> View Live
                      </a>

                      <div class="d-flex align-items-center" style="gap: 6px;">
                        <?php if (!empty($page['add_url'])): ?>
                          <a href="<?php echo $page['add_url']; ?>" class="btn btn-sm btn-outline-primary" style="font-size:11.5px; font-weight:700; border-radius:6px; padding:6px 10px;" title="Add New Item">
                            <i class="mdi mdi-plus"></i> Add
                          </a>
                        <?php endif; ?>

                        <a href="<?php echo $page['edit_url']; ?>" class="bu-btn-hub-edit" title="Click to Edit this page">
                          <i class="mdi mdi-square-edit-outline"></i> Edit Page
                        </a>
                      </div>
                    </div>

                  </div>
                <?php endforeach; ?>
              </div>

            </div>
          <?php endforeach; ?>

          <div id="noResultsMsg" class="text-center py-5" style="display: none; background:#FFFFFF; border-radius:12px; border:1px dashed #CBD5E1; margin-bottom:30px;">
            <i class="mdi mdi-file-search-outline" style="font-size: 48px; color: #94A3B8;"></i>
            <h5 class="mt-3 font-weight-bold" style="color: #0A1B54;">No matching page found</h5>
            <p class="text-muted" style="font-size: 13px;">Try searching with different keywords like "fee", "overview", "syllabus", "exam", "mou", or "leadership".</p>
          </div>

        </div>
      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>

<?php include_once("inc.footer.js.php"); ?>

<script>
$(document).ready(function() {
  $('#hubPageSearch').on('input', function() {
    var query = $(this).val().toLowerCase().trim();
    var visibleCards = 0;

    $('.bu-hub-card').each(function() {
      var data = $(this).data('title') || '';
      if (query === '' || data.indexOf(query) !== -1) {
        $(this).show();
        visibleCards++;
      } else {
        $(this).hide();
      }
    });

    // Check section headers
    $('.bu-section-block').each(function() {
      var visibleInSection = $(this).find('.bu-hub-card:visible').length;
      if (visibleInSection > 0) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });

    if (visibleCards === 0) {
      $('#noResultsMsg').show();
    } else {
      $('#noResultsMsg').hide();
    }
  });
});
</script>

</body>
</html>
