<?php 
include('config.php'); 

// Fetch dynamic program categories from database table `program`
global $db;
$db_categories = [];
if (isset($db) && is_object($db)) {
    try {
        $db_cats = $db->rawQuery("SELECT * FROM program ORDER BY id ASC");
        if (!empty($db_cats)) {
            // Sort by sort_order if column exists
            usort($db_cats, function($a, $b) {
                $sa = isset($a['sort_order']) ? (int)$a['sort_order'] : (int)$a['id'];
                $sb = isset($b['sort_order']) ? (int)$b['sort_order'] : (int)$b['id'];
                return $sa <=> $sb;
            });
            $icon_defaults = [
                'undergraduate' => 'fa-graduation-cap',
                'postgraduate'  => 'fa-book',
                'doctoral'      => 'fa-university',
                'diploma'       => 'fa-certificate',
                'certificate'   => 'fa-file-text-o',
                'integrated'    => 'fa-cubes'
            ];
            foreach ($db_cats as $dc) {
                if (isset($dc['status']) && (int)$dc['status'] === 0) continue;
                $c_name = trim($dc['program']);
                $c_slug = !empty($dc['slug']) ? $dc['slug'] : '';
                if (empty($c_slug)) {
                    if (stripos($c_name, 'integ') !== false) $c_slug = 'integrated';
                    elseif (stripos($c_name, 'post') !== false || stripos($c_name, 'pg') !== false) $c_slug = 'postgraduate';
                    elseif (stripos($c_name, 'phd') !== false || stripos($c_name, 'doc') !== false) $c_slug = 'doctoral';
                    elseif (stripos($c_name, 'dip') !== false) $c_slug = 'diploma';
                    elseif (stripos($c_name, 'cert') !== false) $c_slug = 'certificate';
                    elseif (stripos($c_name, 'grad') !== false || stripos($c_name, 'ug') !== false) $c_slug = 'undergraduate';
                    else $c_slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $c_name), '-'));
                }
                $c_icon = !empty($dc['icon']) ? $dc['icon'] : ($icon_defaults[$c_slug] ?? 'fa-graduation-cap');
                $c_title = (stripos($c_name, 'programme') === false && stripos($c_name, 'program') === false) ? $c_name . ' Programmes' : $c_name;
                $db_categories[$c_slug] = [
                    'id'    => (int)$dc['id'],
                    'label' => strtoupper($c_name),
                    'title' => $c_title,
                    'icon'  => $c_icon,
                    'slug'  => $c_slug
                ];
            }
        }
    } catch (\Throwable $e) {}
}

if (!isset($db_categories['integrated'])) {
    $db_categories['integrated'] = [
        'id'    => 6,
        'label' => 'INTEGRATED',
        'title' => 'Integrated Programmes',
        'icon'  => 'fa-cubes',
        'slug'  => 'integrated'
    ];
}

if (empty($db_categories)) {
    $db_categories = [
        'undergraduate' => ['id'=>3, 'label'=>'UNDERGRADUATE', 'title'=>'Under Graduate Programmes', 'icon'=>'fa-graduation-cap', 'slug'=>'undergraduate'],
        'postgraduate'  => ['id'=>2, 'label'=>'POSTGRADUATE',  'title'=>'Post Graduate Programmes',  'icon'=>'fa-book',           'slug'=>'postgraduate'],
        'doctoral'      => ['id'=>1, 'label'=>'DOCTORAL',      'title'=>'Doctoral (Ph.D) Programmes',  'icon'=>'fa-university',     'slug'=>'doctoral'],
        'diploma'       => ['id'=>4, 'label'=>'DIPLOMA',       'title'=>'Diploma Programmes',        'icon'=>'fa-certificate',    'slug'=>'diploma'],
        'certificate'   => ['id'=>5, 'label'=>'CERTIFICATE',   'title'=>'Certificate Programmes',    'icon'=>'fa-file-text-o',    'slug'=>'certificate'],
        'integrated'    => ['id'=>6, 'label'=>'INTEGRATED',    'title'=>'Integrated Programmes',     'icon'=>'fa-cubes',          'slug'=>'integrated']
    ];
}

$tab_categories = $db_categories;
$allowed_types = array_keys($tab_categories);

// Clean get parameter (handle trailing slash from URL rewrite)
$raw_type = isset($_GET['type']) ? $_GET['type'] : (isset($_GET['id']) ? $_GET['id'] : '');
$page_type = strtolower(trim($raw_type, "/ \t\n\r\0\x0B"));

// Common alias normalization
$alias_map = [
    'phd'                  => 'doctoral',
    'doc'                  => 'doctoral',
    'graduation'           => 'undergraduate',
    'ug'                   => 'undergraduate',
    'post-graduation'      => 'postgraduate',
    'pg'                   => 'postgraduate',
    'integrated-programmes'=> 'integrated',
    'integrated-programme' => 'integrated'
];
if (isset($alias_map[$page_type])) {
    $page_type = $alias_map[$page_type];
}

// Also check URI if rewrite didn't pass $_GET
if (empty($page_type) && isset($_SERVER['REQUEST_URI'])) {
    foreach ($allowed_types as $chk) {
        if (stripos($_SERVER['REQUEST_URI'], $chk) !== false) {
            $page_type = $chk;
            break;
        }
    }
}

if (!in_array($page_type, $allowed_types)) {
    $page_type = in_array('undergraduate', $allowed_types) ? 'undergraduate' : ($allowed_types[0] ?? 'undergraduate');
}

// Fetch all active courses directly from admin panel database table `course`
$all_programs = [];
$deg_heading = '85+ programs across every degree level.';

if (isset($db) && is_object($db)) {
    try {
        $raw_courses = $db->rawQuery("
            SELECT c.*, p.program AS prog_name, d.title AS dept_title 
            FROM course c 
            LEFT JOIN program p ON c.program = p.id 
            LEFT JOIN department d ON c.department = d.id 
            WHERE (c.status = 1 OR c.status IS NULL) 
            ORDER BY c.id ASC
        ");
        
        if (!empty($raw_courses) && is_array($raw_courses)) {
            foreach ($raw_courses as $rc) {
                $c_name = trim($rc['course']);
                if (empty($c_name)) continue;

                $p_name = strtolower(trim($rc['prog_name'] ?? ''));
                $p_slug = !empty($rc['prog_slug']) ? strtolower(trim($rc['prog_slug'])) : '';
                if (empty($p_slug)) {
                    if (strpos($p_name, 'integ') !== false) $p_slug = 'integrated';
                    elseif (strpos($p_name, 'post') !== false || strpos($p_name, 'pg') !== false) $p_slug = 'postgraduate';
                    elseif (strpos($p_name, 'phd') !== false || strpos($p_name, 'doc') !== false) $p_slug = 'doctoral';
                    elseif (strpos($p_name, 'dip') !== false) $p_slug = 'diploma';
                    elseif (strpos($p_name, 'cert') !== false) $p_slug = 'certificate';
                    elseif (strpos($p_name, 'grad') !== false || strpos($p_name, 'under') !== false) $p_slug = 'undergraduate';
                }
                $p_id = (int)($rc['program'] ?? 0);
                
                // Determine all applicable levels (UG, PG, Doctoral, Diploma, Certificate, Integrated, etc.)
                $levels = [];
                
                // If program table defines a slug, use it directly
                if (!empty($p_slug) && isset($tab_categories[$p_slug])) {
                    $levels[] = $p_slug;
                }

                // Integrated Programmes (id 6 or keyword)
                if ($p_id === 6 || strpos($p_name, 'integ') !== false || $p_slug === 'integrated' || stripos($c_name, 'bscbed') !== false || stripos($c_name, 'integrated') !== false || stripos($c_name, 'b.sc. b.ed') !== false || stripos($c_name, 'ba.bed') !== false || stripos($c_name, 'ba bed') !== false) {
                    if (!in_array('integrated', $levels)) $levels[] = 'integrated';
                }

                // Certificate
                if ($p_id === 5 || strpos($p_name, 'cert') !== false || stripos($c_name, 'cert') !== false || stripos($c_name, 'certificate') !== false || stripos($c_name, 'skill') !== false) {
                    if (!in_array('certificate', $levels)) $levels[] = 'certificate';
                }

                // Diploma
                if ($p_id === 4 || strpos($p_name, 'dip') !== false || stripos($c_name, 'diploma') !== false || stripos($c_name, 'poly') !== false || stripos($c_name, 'd.') === 0 || stripos($c_name, 'd.pharm') !== false || stripos($c_name, 'dca') !== false || stripos($c_name, 'pgdca') !== false || stripos($c_name, 'gnm') !== false || stripos($c_name, 'dmlt') !== false || stripos($c_name, 'd.el.ed') !== false) {
                    if (!in_array('diploma', $levels)) $levels[] = 'diploma';
                }

                // Doctoral
                if ($p_id === 1 || strpos($p_name, 'doc') !== false || strpos($p_name, 'phd') !== false || strpos($p_name, 'ph.d') !== false || stripos($c_name, 'ph.d') !== false || stripos($c_name, 'phd') !== false) {
                    if (!in_array('doctoral', $levels)) $levels[] = 'doctoral';
                }

                // Postgraduate
                if ($p_id === 2 || strpos($p_name, 'post') !== false || strpos($p_name, 'pg') !== false || stripos($c_name, 'm.') === 0 || stripos($c_name, 'mba') !== false || stripos($c_name, 'mca') !== false || stripos($c_name, 'mds') !== false || stripos($c_name, 'm.tech') !== false || stripos($c_name, 'm.pharm') !== false || stripos($c_name, 'msc') !== false || stripos($c_name, 'm.sc') !== false || stripos($c_name, 'm.com') !== false || stripos($c_name, 'm.ed') !== false || stripos($c_name, 'm.lib') !== false || (stripos($c_name, 'ma') === 0 && strlen($c_name) <= 10)) {
                    if (!in_array('postgraduate', $levels)) $levels[] = 'postgraduate';
                }

                // Undergraduate
                if (!in_array('integrated', $levels) && ($p_id === 3 || strpos($p_name, 'grad') !== false || strpos($p_name, 'under') !== false || strpos($p_name, 'ug') !== false || stripos($c_name, 'b.') === 0 || stripos($c_name, 'bba') !== false || stripos($c_name, 'bca') !== false || stripos($c_name, 'bds') !== false || stripos($c_name, 'b.tech') !== false || stripos($c_name, 'b.pharm') !== false || stripos($c_name, 'bsc') !== false || (stripos($c_name, 'ba') === 0 && stripos($c_name, 'ballb') === false && strlen($c_name) <= 10) || stripos($c_name, 'b.com') !== false || stripos($c_name, 'b.ed') !== false || stripos($c_name, 'bhms') !== false || stripos($c_name, 'bmlt') !== false || stripos($c_name, 'bhmct') !== false || stripos($c_name, 'b.lib') !== false || stripos($c_name, 'l.l.b') !== false || stripos($c_name, 'llb') !== false || stripos($c_name, 'ballb') !== false)) {
                    if (!in_array('undergraduate', $levels)) $levels[] = 'undergraduate';
                }

                if (empty($levels)) {
                    $levels[] = !empty($p_slug) ? $p_slug : 'undergraduate';
                }

                // Extract Duration and Eligibility from details
                $duration = '';
                $eligibility = '';
                
                if (!empty($rc['details'])) {
                    $det_text = strip_tags($rc['details']);
                    if (preg_match('/(\d+(?:\.\d+)?\s*(?:years?|yrs?|months?))/i', $det_text, $dur_match)) {
                        $duration = trim($dur_match[1]);
                    }
                    if (preg_match('/eligibility\s*[:\-]?\s*([^,\n\r<]+)/i', $det_text, $elig_match)) {
                        $raw_elig = trim($elig_match[1]);
                        // Only accept short clean text without table header or paragraph noise
                        if (
                            strlen($raw_elig) <= 26 &&
                            stripos($raw_elig, 'criteria') === false &&
                            stripos($raw_elig, 'approved') === false &&
                            stripos($raw_elig, 'seats') === false &&
                            stripos($raw_elig, 'department') === false &&
                            stripos($raw_elig, '&') !== 0 &&
                            stripos($raw_elig, 'college') === false &&
                            stripos($raw_elig, 'semesters') === false
                        ) {
                            $eligibility = $raw_elig;
                        }
                    }
                }

                // Standard concise durations (limited length)
                if (empty($duration) || strlen($duration) > 16) {
                    if (in_array('integrated', $levels)) $duration = '4 Years';
                    elseif (in_array('certificate', $levels) && count($levels) === 1) $duration = '6 Months';
                    elseif (in_array('doctoral', $levels)) $duration = '3-5 yrs';
                    elseif (in_array('postgraduate', $levels)) $duration = '2 yrs';
                    elseif (in_array('diploma', $levels)) $duration = (stripos($c_name, 'pharm') !== false ? '2 yrs' : (stripos($c_name, 'hotel') !== false ? '1 yr / 6 Mo' : '3 yrs'));
                    elseif (stripos($c_name, 'b.tech') !== false || stripos($c_name, 'b.pharm') !== false || stripos($c_name, 'nursing') !== false) $duration = '4 yrs';
                    elseif (stripos($c_name, 'bds') !== false || stripos($c_name, 'bhms') !== false || stripos($c_name, 'ballb') !== false) $duration = '5 yrs';
                    else $duration = '3 yrs';
                }

                // Standard concise eligibility (short & clean like all other cards)
                if (empty($eligibility) || strlen($eligibility) > 26) {
                    if (in_array('integrated', $levels)) $eligibility = '10+2 Science 50%';
                    elseif (in_array('certificate', $levels) && count($levels) === 1) $eligibility = '10+2 Any Stream';
                    elseif (in_array('doctoral', $levels)) $eligibility = 'Master Degree 55%';
                    elseif (in_array('postgraduate', $levels)) $eligibility = (stripos($c_name, 'm.tech') !== false ? 'B.Tech / BE' : (stripos($c_name, 'mca') !== false ? 'BCA / Grad' : 'Graduation 50%'));
                    elseif (in_array('diploma', $levels)) $eligibility = (stripos($c_name, 'pharm') !== false ? '10+2 PCB/PCM' : '10th / 10+2 Pass');
                    elseif (stripos($c_name, 'b.tech') !== false) $eligibility = '10+2 PCM 50%';
                    elseif (stripos($c_name, 'b.pharm') !== false || stripos($c_name, 'nursing') !== false) $eligibility = '10+2 PCB 50%';
                    elseif (stripos($c_name, 'bds') !== false || stripos($c_name, 'bhms') !== false) $eligibility = 'NEET-UG / 10+2 PCB';
                    elseif (stripos($c_name, 'b.ed') !== false) $eligibility = 'Graduation 50%';
                    else $eligibility = '10+2 Any Stream';
                }

                // Final safety limit
                $eligibility = mb_strimwidth($eligibility, 0, 26, '...');
                $duration = mb_strimwidth($duration, 0, 16, '...');

                // Clean card title display
                $card_title = $c_name;
                if (stripos($card_title, '4 Years Integrated') !== false) {
                    $card_title = 'B.Sc. B.Ed.';
                }

                $all_programs[] = [
                    'id'          => $rc['id'],
                    'title'       => $card_title,
                    'full_title'  => $c_name,
                    'levels'      => $levels,
                    'level'       => $levels[0],
                    'duration'    => $duration,
                    'eligibility' => $eligibility,
                    'department'  => $rc['dept_title'] ?? '',
                    'tag'         => (in_array('integrated', $levels) ? 'NEW' : 'FEATURED'),
                    'detail_url'  => href('eligibility.php', 'id=' . $rc['id'])
                ];
            }

            // Also ensure standard university skill certificate courses are included if certificate count is low
            $cert_count = count(array_filter($all_programs, function($p) {
                return (!empty($p['levels']) && in_array('certificate', $p['levels'])) || ($p['level'] ?? '') === 'certificate';
            }));

            if ($cert_count < 6) {
                $additional_certs = [
                    ['title'=>'Certificate in Digital Marketing & AI Tools', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 Any Stream', 'tag'=>'TRENDING'],
                    ['title'=>'Certificate in Cyber Security & Ethical Hacking', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 / IT Interest', 'tag'=>'FEATURED'],
                    ['title'=>'Certificate in Full Stack Web Development', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 / BCA / B.Tech', 'tag'=>'FEATURED'],
                    ['title'=>'Certificate in Data Science & Machine Learning', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 with Math / Grad', 'tag'=>'FEATURED'],
                    ['title'=>'Certificate in Dental Assistant & Oral Hygiene', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 PCB / Any', 'tag'=>'POPULAR'],
                    ['title'=>'Certificate in Hospital Administration', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'Graduation / 10+2', 'tag'=>'POPULAR'],
                    ['title'=>'Certificate in Solar Energy & Electrical Systems', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'6 Months', 'eligibility'=>'10+2 / ITI / Dip', 'tag'=>'POPULAR'],
                    ['title'=>'Certificate in Foreign Language (French / German)', 'levels'=>['certificate'], 'level'=>'certificate', 'duration'=>'3 Months', 'eligibility'=>'Open to All Students', 'tag'=>'POPULAR'],
                ];
                foreach ($additional_certs as $ac) {
                    $all_programs[] = $ac;
                }
            }

            // Ensure Integrated Programmes courses are present if database does not contain them yet
            $has_integrated = false;
            foreach ($all_programs as $p) {
                if (!empty($p['levels']) && in_array('integrated', $p['levels'])) {
                    $has_integrated = true;
                    break;
                }
            }
            if (!$has_integrated) {
                $all_programs[] = [
                    'id'          => 55,
                    'title'       => 'B.Sc. B.Ed.',
                    'full_title'  => 'B.Sc. B.Ed. (4 Years Integrated)',
                    'levels'      => ['integrated'],
                    'level'       => 'integrated',
                    'duration'    => '4 Years',
                    'eligibility' => '10+2 Science (PCM/PCB) 50%',
                    'department'  => 'Faculty of Education & Science',
                    'tag'         => 'NEW',
                    'detail_url'  => href('eligibility.php', 'id=55')
                ];
                $all_programs[] = [
                    'id'          => 56,
                    'title'       => 'BA B.Ed.',
                    'full_title'  => 'BA B.Ed. (4 Years Integrated)',
                    'levels'      => ['integrated'],
                    'level'       => 'integrated',
                    'duration'    => '4 Years',
                    'eligibility' => '10+2 Any Stream 50%',
                    'department'  => 'Faculty of Education & Arts',
                    'tag'         => 'POPULAR',
                    'detail_url'  => href('eligibility.php', 'id=56')
                ];
            }
        }
    } catch (\Throwable $e) {}
}

// Fallback comprehensive courses list if database is empty
if (empty($all_programs)) {
    $all_programs = [
        // Integrated Programmes
        ['id'=>55, 'title'=>'B.Sc. B.Ed.', 'full_title'=>'B.Sc. B.Ed. (4 Years Integrated)', 'level'=>'integrated', 'levels'=>['integrated'], 'duration'=>'4 Years', 'eligibility'=>'10+2 Science (PCM/PCB) 50%', 'tag'=>'NEW', 'detail_url'=>href('eligibility.php', 'id=55')],
        ['id'=>56, 'title'=>'BA B.Ed.', 'full_title'=>'BA B.Ed. (4 Years Integrated)', 'level'=>'integrated', 'levels'=>['integrated'], 'duration'=>'4 Years', 'eligibility'=>'10+2 Any Stream 50%', 'tag'=>'POPULAR', 'detail_url'=>href('eligibility.php', 'id=56')],

        // Undergraduate
        ['title'=>'B.Tech CSE', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCM 60%', 'tag'=>'FEATURED'],
        ['title'=>'B.Tech Mechanical', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCM 50%', 'tag'=>'FEATURED'],
        ['title'=>'B.Tech Civil', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCM 50%', 'tag'=>'POPULAR'],
        ['title'=>'B.Tech EC', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCM 50%', 'tag'=>'POPULAR'],
        ['title'=>'B.Tech AI & Data Science', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCM 60%', 'tag'=>'TRENDING'],
        ['title'=>'B.Pharm', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCB/PCM', 'tag'=>'FEATURED'],
        ['title'=>'BDS (Dental)', 'level'=>'undergraduate', 'duration'=>'5 yrs', 'eligibility'=>'NEET-UG / 10+2 PCB', 'tag'=>'FEATURED'],
        ['title'=>'BCA', 'level'=>'undergraduate', 'duration'=>'3 yrs', 'eligibility'=>'10+2 Any Stream', 'tag'=>'FEATURED'],
        ['title'=>'BA LLB', 'level'=>'undergraduate', 'duration'=>'5 yrs', 'eligibility'=>'10+2 50%', 'tag'=>'FEATURED'],
        ['title'=>'BBA', 'level'=>'undergraduate', 'duration'=>'3 yrs', 'eligibility'=>'10+2 50%', 'tag'=>'FEATURED'],
        ['title'=>'B.Sc Nursing', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 PCB', 'tag'=>'FEATURED'],
        ['title'=>'B.Com (Hons)', 'level'=>'undergraduate', 'duration'=>'3 yrs', 'eligibility'=>'10+2 Commerce/Any', 'tag'=>'FEATURED'],
        ['title'=>'B.Sc Agriculture', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 Science/Agri', 'tag'=>'POPULAR'],
        ['title'=>'B.Sc Biotechnology', 'level'=>'undergraduate', 'duration'=>'3 yrs', 'eligibility'=>'10+2 PCB 50%', 'tag'=>'POPULAR'],
        ['title'=>'BPT (Physiotherapy)', 'level'=>'undergraduate', 'duration'=>'4.5 yrs', 'eligibility'=>'10+2 PCB 50%', 'tag'=>'POPULAR'],
        ['title'=>'BHMCT (Hotel Mgmt)', 'level'=>'undergraduate', 'duration'=>'4 yrs', 'eligibility'=>'10+2 Any Stream', 'tag'=>'POPULAR'],
        ['title'=>'B.Ed', 'level'=>'undergraduate', 'duration'=>'2 yrs', 'eligibility'=>'Graduation 50%', 'tag'=>'POPULAR'],
        ['title'=>'LLB', 'level'=>'undergraduate', 'duration'=>'3 yrs', 'eligibility'=>'Graduation 45%', 'tag'=>'POPULAR'],

        // Postgraduate
        ['title'=>'MBA Dual Specialization', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'Graduation 50%', 'tag'=>'FEATURED'],
        ['title'=>'MBA Hospital Management', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'Graduation 50%', 'tag'=>'POPULAR'],
        ['title'=>'M.Tech CSE', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Tech CSE / IT', 'tag'=>'FEATURED'],
        ['title'=>'M.Tech Thermal Engg', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Tech Mechanical', 'tag'=>'POPULAR'],
        ['title'=>'M.Tech VLSI Design', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Tech EC/EE', 'tag'=>'POPULAR'],
        ['title'=>'M.Tech Structural Engg', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Tech Civil', 'tag'=>'POPULAR'],
        ['title'=>'MCA', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'BCA / Graduation', 'tag'=>'FEATURED'],
        ['title'=>'M.Pharm Pharmaceutics', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Pharm 55%', 'tag'=>'FEATURED'],
        ['title'=>'M.Pharm Pharmacology', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Pharm 55%', 'tag'=>'POPULAR'],
        ['title'=>'MDS Conservative Dentistry', 'level'=>'postgraduate', 'duration'=>'3 yrs', 'eligibility'=>'BDS / NEET-MDS', 'tag'=>'FEATURED'],
        ['title'=>'MDS Orthodontics', 'level'=>'postgraduate', 'duration'=>'3 yrs', 'eligibility'=>'BDS / NEET-MDS', 'tag'=>'POPULAR'],
        ['title'=>'M.Sc Nursing', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Sc Nursing 55%', 'tag'=>'POPULAR'],
        ['title'=>'M.Sc Biotechnology', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Sc Bio/Chem', 'tag'=>'POPULAR'],
        ['title'=>'LLM (Corporate Law)', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'LLB 50%', 'tag'=>'POPULAR'],
        ['title'=>'M.Com', 'level'=>'postgraduate', 'duration'=>'2 yrs', 'eligibility'=>'B.Com 50%', 'tag'=>'POPULAR'],

        // Doctoral (Ph.D)
        ['title'=>'Ph.D Computer Science & Engg', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'M.Tech / ME / MCA 55%', 'tag'=>'FEATURED'],
        ['title'=>'Ph.D Management Studies', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'MBA / PGDM 55%', 'tag'=>'FEATURED'],
        ['title'=>'Ph.D Pharmaceutical Sciences', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'M.Pharm 55%', 'tag'=>'FEATURED'],
        ['title'=>'Ph.D Dental Sciences', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'MDS 55%', 'tag'=>'FEATURED'],
        ['title'=>'Ph.D Mechanical Engineering', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'M.Tech Mech 55%', 'tag'=>'POPULAR'],
        ['title'=>'Ph.D Civil Engineering', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'M.Tech Civil 55%', 'tag'=>'POPULAR'],
        ['title'=>'Ph.D Biotechnology & Life Sciences', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'M.Sc Bio/Life Sci 55%', 'tag'=>'POPULAR'],
        ['title'=>'Ph.D Law & Legal Studies', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'LLM 55%', 'tag'=>'POPULAR'],
        ['title'=>'Ph.D Commerce & Economics', 'level'=>'doctoral', 'duration'=>'3-5 yrs', 'eligibility'=>'M.Com 55%', 'tag'=>'POPULAR'],

        // Diploma
        ['title'=>'Diploma Mechanical Engineering', 'level'=>'diploma', 'duration'=>'3 yrs', 'eligibility'=>'10th Pass with Science/Math', 'tag'=>'FEATURED'],
        ['title'=>'Diploma Civil Engineering', 'level'=>'diploma', 'duration'=>'3 yrs', 'eligibility'=>'10th Pass with Science/Math', 'tag'=>'FEATURED'],
        ['title'=>'Diploma Electrical Engineering', 'level'=>'diploma', 'duration'=>'3 yrs', 'eligibility'=>'10th Pass with Science/Math', 'tag'=>'POPULAR'],
        ['title'=>'Diploma Computer Science', 'level'=>'diploma', 'duration'=>'3 yrs', 'eligibility'=>'10th Pass with Science/Math', 'tag'=>'FEATURED'],
        ['title'=>'D.Pharm (Pharmacy)', 'level'=>'diploma', 'duration'=>'2 yrs', 'eligibility'=>'10+2 PCB/PCM', 'tag'=>'FEATURED'],
        ['title'=>'GNM (General Nursing & Midwifery)', 'level'=>'diploma', 'duration'=>'3 yrs', 'eligibility'=>'10+2 PCB / Any 40%', 'tag'=>'POPULAR'],
        ['title'=>'DMLT (Medical Lab Technology)', 'level'=>'diploma', 'duration'=>'2 yrs', 'eligibility'=>'10+2 Science 45%', 'tag'=>'POPULAR'],
        ['title'=>'Diploma in Hotel Management', 'level'=>'diploma', 'duration'=>'1 yr', 'eligibility'=>'10+2 Any Stream', 'tag'=>'POPULAR'],

        // Certificate
        ['title'=>'Certificate in Digital Marketing & AI', 'level'=>'certificate', 'duration'=>'6 months', 'eligibility'=>'10+2 Any Stream', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Cyber Security & Ethical Hacking', 'level'=>'certificate', 'duration'=>'6 months', 'eligibility'=>'10+2 / IT Interest', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Full Stack Web Development', 'level'=>'certificate', 'duration'=>'6 months', 'eligibility'=>'10+2 / BCA / B.Tech', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Data Science & Machine Learning', 'level'=>'certificate', 'duration'=>'6 months', 'eligibility'=>'10+2 with Math / Grad', 'tag'=>'FEATURED'],
        ['title'=>'Certificate in Dental Assistant & Hygiene', 'level'=>'certificate', 'duration'=>'6 months', 'eligibility'=>'10+2 PCB', 'tag'=>'POPULAR'],
        ['title'=>'Certificate in Hospital Administration', 'level'=>'certificate', 'duration'=>'6 months', 'eligibility'=>'Graduation Any Stream', 'tag'=>'POPULAR'],
        ['title'=>'Certificate in Foreign Language (German/French)', 'level'=>'certificate', 'duration'=>'3 months', 'eligibility'=>'Open to All Students', 'tag'=>'POPULAR'],
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Academic Programmes &amp; Courses | Bhabha University Bhopal</title>
<meta name="description" content="Explore 85+ Undergraduate, Postgraduate, Doctoral, Diploma and Certificate programmes offered at Bhabha University Bhopal. Check course duration, eligibility and apply online.">
<meta name="keywords" content="Bhabha University programmes, UG courses, PG courses, PhD admissions, engineering, pharmacy, medical, dental, management Bhopal">

<?php include('inc.meta.php'); ?>

<style>
/* ================================================================
   BHABHA UNIVERSITY – PROGRAMMES PAGE STYLING
   ================================================================ */
.bu-prog-page-wrapper {
  background-color: #FAF7F2;
  min-height: 100vh;
  width: 100%;
}

/* Hero Banner */
.bu-prog-hero {
  background: linear-gradient(135deg, #071338 0%, #0A1B54 60%, #112874 100%);
  color: #FFFFFF;
  padding: 60px 20px 50px 20px;
  position: relative;
  overflow: hidden;
}
.bu-prog-hero::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -10%;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(255,193,7,0.12) 0%, rgba(255,193,7,0) 70%);
  border-radius: 50%;
  pointer-events: none;
}
.bu-prog-hero-container {
  max-width: 1240px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}
.bu-prog-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.bu-prog-breadcrumb a {
  color: #FFC107;
  text-decoration: none;
  transition: color 0.2s;
}
.bu-prog-breadcrumb a:hover {
  color: #FFE082;
}
.bu-prog-hero-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 38px;
  font-weight: 800;
  line-height: 1.2;
  color: #FFFFFF;
  margin: 0 0 12px 0;
}
.bu-prog-hero-title span {
  color: #FFC107;
}
.bu-prog-hero-desc {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.88);
  max-width: 780px;
  margin: 0;
  line-height: 1.6;
}

/* Main Content Container */
.bu-prog-content-section {
  padding: 50px 20px 90px 20px;
}
.bu-prog-main-container {
  max-width: 1240px;
  margin: 0 auto;
}

/* Filter Bar (Search + Quick Counts) */
.bu-prog-filter-panel {
  background: #FFFFFF;
  border-radius: 16px;
  padding: 24px 30px;
  margin-bottom: 35px;
  box-shadow: 0 8px 30px rgba(10, 27, 84, 0.06);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  border: 1px solid rgba(10, 27, 84, 0.05);
}
.bu-prog-search-wrap {
  position: relative;
  flex: 1;
  min-width: 280px;
}
.bu-prog-search-wrap input {
  width: 100%;
  padding: 14px 20px 14px 48px;
  border: 1.5px solid #E2E8F0;
  border-radius: 50px;
  font-size: 14.5px;
  font-weight: 500;
  color: #0A1B54;
  outline: none;
  background: #F8FAFC;
  transition: all 0.25s ease;
  box-sizing: border-box;
}
.bu-prog-search-wrap input:focus {
  background: #FFFFFF;
  border-color: #0A1B54;
  box-shadow: 0 0 0 4px rgba(10, 27, 84, 0.08);
}
.bu-prog-search-icon {
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  color: #94A3B8;
  font-size: 16px;
}
.bu-prog-quick-count {
  font-size: 14px;
  font-weight: 700;
  color: #0A1B54;
  background: rgba(255, 193, 7, 0.15);
  padding: 8px 16px;
  border-radius: 20px;
  border: 1px solid rgba(255, 193, 7, 0.4);
}

/* Degree Tabs Row */
.bu-prog-tabs-bar {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
  margin-bottom: 35px;
  border-bottom: 2px solid rgba(10, 27, 84, 0.08);
  padding-bottom: 16px;
}
.bu-prog-tab-btn {
  background: #FFFFFF;
  border: 1.5px solid #E2E8F0;
  color: #475569;
  font-size: 13px;
  font-weight: 700;
  padding: 11px 22px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.22s ease;
  outline: none;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bu-prog-tab-btn i {
  font-size: 14px;
  transition: color 0.2s;
}
.bu-prog-tab-btn:hover {
  background: #0A1B54;
  border-color: #0A1B54;
  color: #FFFFFF;
}
.bu-prog-tab-btn.active {
  background: #0A1B54;
  border-color: #0A1B54;
  color: #FFC107;
  box-shadow: 0 6px 20px rgba(10, 27, 84, 0.22);
}
.bu-prog-tab-btn.active i {
  color: #FFC107;
}

/* Grids */
.bu-prog-grid-pane {
  display: none;
}
.bu-prog-grid-pane.active {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 22px;
}

/* Program Card (Exact match with Homepage Section Design) */
.bu-prog-card {
  background: #FFFFFF;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border: 1px solid rgba(0, 0, 0, 0.04);
  position: relative;
  cursor: pointer;
}
.bu-prog-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(10, 27, 84, 0.12);
  border-color: rgba(255, 193, 7, 0.5);
}
.bu-prog-card-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.bu-prog-card-icon {
  color: #D99B00;
  display: flex;
  align-items: center;
  justify-content: center;
}
.bu-prog-card-tag {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  color: #D99B00;
  background: rgba(217, 155, 0, 0.1);
  padding: 3px 8px;
  border-radius: 4px;
}
.bu-prog-card-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 20px;
  font-weight: 700;
  color: #0A1B54;
  margin: 0 0 18px 0;
  line-height: 1.3;
}
.bu-prog-card-title a {
  color: inherit;
  text-decoration: none;
  transition: color 0.2s ease;
}
.bu-prog-card:hover .bu-prog-card-title a {
  color: #061D7C;
}
.bu-prog-card-details {
  display: flex;
  flex-direction: column;
  gap: 8px;
  border-top: 1px solid #F1F5F9;
  padding-top: 14px;
  margin-bottom: 16px;
}
.bu-prog-detail-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12.5px;
}
.bu-prog-detail-row span {
  color: #64748B;
  font-weight: 500;
}
.bu-prog-detail-row strong {
  color: #0F172A;
  font-weight: 700;
  text-align: right;
  max-width: 65%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.bu-prog-card-actions {
  display: flex;
  gap: 8px;
  align-items: center;
}
.bu-prog-card-view {
  flex: 1;
  background: #FAF7F2;
  color: #0A1B54;
  font-size: 11.5px;
  font-weight: 700;
  text-align: center;
  padding: 10px 8px;
  border-radius: 6px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border: 1px solid rgba(10, 27, 84, 0.15);
  transition: all 0.22s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}
.bu-prog-card-view:hover {
  background: #0A1B54;
  border-color: #0A1B54;
  color: #FFC107;
  text-decoration: none;
}
.bu-prog-card-apply {
  flex: 1;
  background: #FFC107;
  color: #0A1B54;
  font-size: 11.5px;
  font-weight: 800;
  text-align: center;
  padding: 10px 8px;
  border-radius: 6px;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border: 1px solid #FFC107;
  transition: all 0.22s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}
.bu-prog-card-apply:hover {
  background: #061D7C;
  border-color: #061D7C;
  color: #FFFFFF;
  text-decoration: none;
  box-shadow: 0 4px 12px rgba(6, 29, 124, 0.25);
}

/* No results state */
.bu-prog-no-results {
  grid-column: 1 / -1;
  text-align: center;
  padding: 60px 20px;
  background: #FFFFFF;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.bu-prog-no-results i {
  font-size: 48px;
  color: #CBD5E1;
  margin-bottom: 16px;
  display: block;
}
.bu-prog-no-results h4 {
  font-size: 18px;
  font-weight: 700;
  color: #0A1B54;
  margin-bottom: 8px;
}
.bu-prog-no-results p {
  color: #64748B;
  font-size: 14px;
  margin: 0;
}

/* Responsive queries */
@media (max-width: 1199px) {
  .bu-prog-grid-pane.active {
    grid-template-columns: repeat(3, 1fr);
  }
}
@media (max-width: 991px) {
  .bu-prog-grid-pane.active {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  .bu-prog-hero-title {
    font-size: 30px;
  }
}
@media (max-width: 600px) {
  .bu-prog-grid-pane.active {
    grid-template-columns: 1fr;
  }
  .bu-prog-tab-btn {
    flex: 1;
    font-size: 11px;
    padding: 9px 12px;
    justify-content: center;
  }
  .bu-prog-hero-title {
    font-size: 24px;
  }
}
</style>
</head>
<body>

<div class="bu-prog-page-wrapper">
  
  <!-- HEADER START -->
  <?php include('inc.header.php'); ?>
  <!-- HEADER END -->

  <!-- Hero Section -->
  <section class="bu-prog-hero">
    <div class="bu-prog-hero-container">
      <div class="bu-prog-breadcrumb">
        <a href="<?php echo href('index.php'); ?>"><i class="fa fa-home"></i> Home</a>
        <span>&rsaquo;</span>
        <span>Academic Programmes</span>
      </div>
      <h1 class="bu-prog-hero-title">Academic <span>Programmes</span> &amp; Courses</h1>
      <p class="bu-prog-hero-desc">Discover our comprehensive range of 85+ multi-disciplinary programmes across Engineering, Pharmacy, Dental, Nursing, Management, Law, Computer Applications and Applied Sciences.</p>
    </div>
  </section>

  <!-- Main Content Area -->
  <section class="bu-prog-content-section" id="progSection">
    <div class="bu-prog-main-container">

      <!-- Filter / Search Bar -->
      <div class="bu-prog-filter-panel">
        <div class="bu-prog-search-wrap">
          <i class="fa fa-search bu-prog-search-icon"></i>
          <input type="text" id="progSearchInput" placeholder="Search course by name, eligibility (e.g. B.Tech, Pharmacy, MBA, 10+2)...">
        </div>
        <div class="bu-prog-quick-count" id="progCountBadge">
          <i class="fa fa-graduation-cap mr-1"></i> <span id="progCountNumber"><?php echo count($all_programs); ?></span> Programmes Available
        </div>
      </div>

      <!-- Tab Buttons -->
      <div class="bu-prog-tabs-bar" id="progTabs">
        <?php foreach ($tab_categories as $t_key => $t_info): ?>
          <button type="button" 
                  class="bu-prog-tab-btn <?php echo ($t_key === $page_type) ? 'active' : ''; ?>" 
                  data-target="<?php echo $t_key; ?>">
            <i class="fa <?php echo $t_info['icon']; ?>"></i> <?php echo $t_info['label']; ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Grids per Category -->
      <div class="bu-prog-grids-wrapper">
        <?php foreach ($tab_categories as $t_key => $t_info): 
          $category_items = array_filter($all_programs, function($p) use ($t_key) {
              if (!empty($p['levels']) && is_array($p['levels'])) {
                  return in_array($t_key, $p['levels']);
              }
              return isset($p['level']) && strtolower(trim($p['level'])) === strtolower($t_key);
          });
        ?>
          <div class="bu-prog-grid-pane <?php echo ($t_key === $page_type) ? 'active' : ''; ?>" id="pane-<?php echo $t_key; ?>" data-category="<?php echo $t_key; ?>">
            <?php if (!empty($category_items)): ?>
              <?php foreach ($category_items as $item): 
                $course_url = !empty($item['id']) ? href('eligibility.php', 'id=' . $item['id']) : (!empty($item['detail_url']) ? $item['detail_url'] : href('course.php'));
                $apply_name = !empty($item['full_title']) ? $item['full_title'] : (!empty($item['title']) ? $item['title'] : '');
                $apply_url  = href('enquiry.php') . (!empty($apply_name) ? '?course=' . urlencode($apply_name) : '');
              ?>
                <div class="bu-prog-card" 
                     data-title="<?php echo htmlspecialchars(strtolower($item['title'] ?? '')); ?>" 
                     data-eligibility="<?php echo htmlspecialchars(strtolower($item['eligibility'] ?? '')); ?>" 
                     data-level="<?php echo $t_key; ?>"
                     onclick="window.location.href='<?php echo $course_url; ?>';"
                     title="Click to view course specifications, duration, intake & eligibility">
                  <div>
                    <div class="bu-prog-card-top">
                      <span class="bu-prog-card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                          <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                      </span>
                      <span class="bu-prog-card-tag"><?php echo htmlspecialchars($item['tag'] ?? 'FEATURED'); ?></span>
                    </div>
                    <h3 class="bu-prog-card-title">
                      <a href="<?php echo $course_url; ?>" onclick="event.stopPropagation();">
                        <?php echo htmlspecialchars($item['title'] ?? ''); ?>
                      </a>
                    </h3>
                  </div>

                  <div>
                    <div class="bu-prog-card-details">
                      <div class="bu-prog-detail-row">
                        <span>Duration</span>
                        <strong><?php echo htmlspecialchars($item['duration'] ?? 'N/A'); ?></strong>
                      </div>
                      <div class="bu-prog-detail-row">
                        <span>Eligibility</span>
                        <strong><?php echo htmlspecialchars($item['eligibility'] ?? '10+2 Pass'); ?></strong>
                      </div>
                    </div>
                    <div class="bu-prog-card-actions">
                      <a href="<?php echo $course_url; ?>" class="bu-prog-card-view" onclick="event.stopPropagation();">
                        Details <i class="fa fa-info-circle ml-1"></i>
                      </a>
                      <a href="<?php echo $apply_url; ?>" class="bu-prog-card-apply" onclick="event.stopPropagation();">
                        Apply Now <i class="fa fa-arrow-right ml-1"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="bu-prog-no-results">
                <i class="fa fa-folder-open-o"></i>
                <h4>No programmes found in this category</h4>
                <p>Please contact university admissions cell for customized course offerings.</p>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- FOOTER START -->
  <?php include('inc.footer.php'); ?>
  <!-- FOOTER END -->

</div>

<?php include('inc.footer.js.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const tabButtons = document.querySelectorAll('#progTabs .bu-prog-tab-btn');
  const panes = document.querySelectorAll('.bu-prog-grid-pane');
  const searchInput = document.getElementById('progSearchInput');
  const countNumber = document.getElementById('progCountNumber');

  let currentCategory = '<?php echo $page_type; ?>';
  let searchQuery = '';

  function switchTab(categoryKey, updateUrl = true) {
    currentCategory = categoryKey;

    tabButtons.forEach(btn => {
      if (btn.getAttribute('data-target') === categoryKey) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });

    panes.forEach(pane => {
      if (pane.getAttribute('data-category') === categoryKey) {
        pane.classList.add('active');
      } else {
        pane.classList.remove('active');
      }
    });

    filterGrid();

    if (updateUrl && window.history.pushState) {
      const catRegex = new RegExp('/+(' + validCats.join('|') + ')/?$', 'i');
      const baseUrl = window.location.pathname.replace(catRegex, '').replace(/\/+$/, '');
      const newUrl = baseUrl + '/' + categoryKey + '/';
      window.history.pushState({ category: categoryKey }, '', newUrl);
    }
  }

  function filterGrid() {
    const activePane = document.querySelector(`.bu-prog-grid-pane[data-category="${currentCategory}"]`);
    if (!activePane) return;

    const cards = activePane.querySelectorAll('.bu-prog-card');
    let visibleCount = 0;

    cards.forEach(card => {
      const title = card.getAttribute('data-title') || '';
      const elig = card.getAttribute('data-eligibility') || '';

      if (!searchQuery || title.includes(searchQuery) || elig.includes(searchQuery)) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (countNumber) {
      countNumber.textContent = visibleCount;
    }
  }

  const validCats = <?php echo json_encode(array_keys($tab_categories)); ?>;

  function detectActiveCategory() {
    // 1. From Hash (#diploma)
    const hash = window.location.hash.replace('#', '').toLowerCase();
    if (validCats.includes(hash)) return hash;

    // 2. From Search Param (?type=postgraduate)
    const urlParams = new URLSearchParams(window.location.search);
    const typeParam = (urlParams.get('type') || urlParams.get('id') || '').toLowerCase().replace('/', '');
    if (validCats.includes(typeParam)) return typeParam;

    // 3. From Pathname (/programmes/postgraduate/)
    const path = window.location.pathname.toLowerCase();
    for (const cat of validCats) {
      if (path.indexOf('/' + cat) !== -1 || path.indexOf(cat) !== -1) {
        return cat;
      }
    }

    return '<?php echo $page_type; ?>';
  }

  tabButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const target = this.getAttribute('data-target');
      switchTab(target, true);
    });
  });

  if (searchInput) {
    searchInput.addEventListener('input', function() {
      searchQuery = this.value.trim().toLowerCase();
      filterGrid();
    });
  }

  // Intercept header dropdown clicks when already on programmes page
  document.querySelectorAll('a[href*="programmes"]').forEach(function(link) {
    link.addEventListener('click', function(e) {
      const href = (this.getAttribute('href') || '').toLowerCase();
      for (const cat of validCats) {
        if (href.indexOf(cat) !== -1) {
          e.preventDefault();
          switchTab(cat, true);
          const progSec = document.getElementById('progSection');
          if (progSec) {
            progSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
          break;
        }
      }
    });
  });

  // Handle browser back/forward buttons
  window.addEventListener('popstate', function() {
    const activeCat = detectActiveCategory();
    switchTab(activeCat, false);
  });

  // Activate detected initial tab
  const initialCategory = detectActiveCategory();
  switchTab(initialCategory, false);
});
</script>

</body>
</html>
