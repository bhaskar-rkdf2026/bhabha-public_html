<?php  
require_once('config.php');
checksession($_SESSION[LOGIN_ADMIN]['userName'], 'index.php');
require_once('inc.homepage_sections_schema.php');

// Automatic database self-healing check (safe & non-blocking)
try {
    bu_ensure_homepage_sections_schema($db);
} catch (\Throwable $e) {
    error_log("bu_ensure_homepage_sections_schema error: " . $e->getMessage());
}

$stat = array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
define("PAGE", 'homepage_sections.php');
define("TITLE", 'Home Page Sections');
define("DBTAB", 'homepage_sections');

if (!empty($_SESSION['success'])) {
    $stat['success'] = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    $stat['error'] = $_SESSION['error'];
    unset($_SESSION['error']);
}

// Manual database schema sync trigger
if ($action == "sync_db") {
    try {
        $syncRes = bu_ensure_homepage_sections_schema($db);
        $_SESSION["success"] = 'Homepage sections table and all 14 section rows verified successfully.';
    } catch (\Throwable $e) {
        $_SESSION["error"] = 'Schema sync error: ' . $e->getMessage();
    }
    redirect(PAGE);
}

// Helper to resolve media URL for admin previews
if (!function_exists('bu_admin_media_url')) {
    function bu_admin_media_url($path) {
        if (empty($path)) return '';
        $path = trim($path);
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0 || strpos($path, '//') === 0) {
            return $path;
        }
        return '../' . ltrim($path, '/');
    }
}

if (!function_exists('bu_parse_video_url')) {
    function bu_parse_video_url($url) {
        $url = trim($url ?? '');
        if (empty($url)) {
            return [
                'type' => 'empty',
                'id' => '',
                'embed' => '',
                'preview' => '',
                'url' => ''
            ];
        }

        // Vimeo
        if (preg_match('#(?:vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/[^\/]+\/videos\/|album\/(?:\d+\/)?video\/|manage\/videos\/|video\/|)|player\.vimeo\.com\/video\/)(\d+)(?:\/([a-zA-Z0-9]+))?#i', $url, $m)) {
            $vidId = $m[1];
            $hashParam = '';
            if (!empty($m[2])) {
                $hashParam = '&h=' . $m[2];
            } elseif (preg_match('/[?&]h=([a-zA-Z0-9]+)/i', $url, $hm)) {
                $hashParam = '&h=' . $hm[1];
            }
            return [
                'type' => 'vimeo',
                'id' => $vidId,
                'embed' => 'https://player.vimeo.com/video/' . $vidId . '?autoplay=1&loop=1&muted=1&background=1&autopause=0&controls=0&playsinline=1' . $hashParam,
                'preview' => 'https://player.vimeo.com/video/' . $vidId . '?autoplay=0&controls=1' . $hashParam,
                'url' => $url
            ];
        }

        // YouTube
        if (preg_match('#(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})#i', $url, $m)) {
            $vidId = $m[1];
            return [
                'type' => 'youtube',
                'id' => $vidId,
                'embed' => 'https://www.youtube-nocookie.com/embed/' . $vidId . '?autoplay=1&mute=1&loop=1&playlist=' . $vidId . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&disablekb=1&modestbranding=1&playsinline=1',
                'preview' => 'https://www.youtube-nocookie.com/embed/' . $vidId . '?autoplay=0&controls=1',
                'url' => $url
            ];
        }

        return [
            'type' => 'direct',
            'id' => '',
            'embed' => '',
            'preview' => '',
            'url' => $url
        ];
    }
}

// Quick status toggle via GET
if ($action == "toggle_status" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $db->where('id', $id);
        $curr = $db->getOne(DBTAB);
        if ($curr) {
            $newStatus = ($curr['status'] == 1) ? 0 : 1;
            $db->where('id', $id);
            $db->update(DBTAB, ['status' => $newStatus]);
            $_SESSION["success"] = 'Status updated successfully';
        }
    } catch (\Throwable $e) {
        $_SESSION["error"] = 'Status toggle error: ' . $e->getMessage();
    }
    redirect(PAGE);
}

// Helper for file upload
if (!function_exists('bu_handle_upload')) {
    function bu_handle_upload($fileArray, $targetDir = '../upload/media/') {
        if (!isset($fileArray['name']) || empty($fileArray['name'])) {
            return null;
        }
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0777, true);
        }
        $origName = basename($fileArray['name']);
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = ['mp4', 'webm', 'ogg', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'];
        if (in_array($ext, $allowed)) {
            $newFile = md5(microtime() . $origName) . '.' . $ext;
            if (move_uploaded_file($fileArray['tmp_name'], $targetDir . $newFile)) {
                return ltrim(str_replace('../', '', $targetDir), '/') . $newFile;
            }
        }
        return null;
    }
}

// Handle Edit Submission
if (isset($_POST['submit'])) {
    $subAction = $_POST['action'] ?? ($_GET['action'] ?? '');
    $id = intval($_POST['id'] ?? ($_GET['id'] ?? 0));
    if ($subAction == "edit" && count($stat) == 0 && $id > 0) {
        $db->where('id', $id);
        $currSec = $db->getOne(DBTAB);
        $secKey = $currSec ? $currSec['section_key'] : '';
        
        $mediaUrl = trim($_POST['media_url'] ?? '');
        
        // Single file upload for main media if provided
        if (isset($_FILES['media_file']) && !empty($_FILES['media_file']['name'])) {
            $up = bu_handle_upload($_FILES['media_file'], '../upload/media/');
            if ($up) {
                $mediaUrl = $up;
            }
        }
        
        $extraArray = [];
        
        // 1. HERO VIDEO
        if ($secKey == 'hero_video') {
            $stats = [];
            if (isset($_POST['hero_stat_num']) && is_array($_POST['hero_stat_num'])) {
                foreach ($_POST['hero_stat_num'] as $k => $num) {
                    $numTrim = trim($num);
                    if ($numTrim !== '') {
                        $rawDigits = intval(preg_replace('/[^0-9]/', '', $numTrim));
                        $stats[] = [
                            'number' => $numTrim,
                            'suffix' => trim($_POST['hero_stat_suffix'][$k] ?? ''),
                            'commas' => ($rawDigits >= 1000),
                            'label'  => trim($_POST['hero_stat_lbl'][$k] ?? ''),
                            'url'    => trim($_POST['hero_stat_url'][$k] ?? '')
                        ];
                    }
                }
            }
            $poster = trim($_POST['hero_poster'] ?? 'new-media/image/campus-aerial.png');
            if (isset($_FILES['hero_poster_file']) && !empty($_FILES['hero_poster_file']['name'])) {
                $upPoster = bu_handle_upload($_FILES['hero_poster_file'], '../upload/media/');
                if ($upPoster) $poster = $upPoster;
            }
            $video2 = trim($_POST['hero_video_2'] ?? 'new-media/image/hero/bhabha_1.mp4');
            if (isset($_FILES['hero_video2_file']) && !empty($_FILES['hero_video2_file']['name'])) {
                $upVid2 = bu_handle_upload($_FILES['hero_video2_file'], '../upload/media/');
                if ($upVid2) $video2 = $upVid2;
            }
            $extraArray = [
                'poster'  => $poster,
                'video_2' => $video2,
                'stats'   => $stats
            ];
        } 
        // 2. CHANCELLOR
        elseif ($secKey == 'chancellor_welcome') {
            $recogs = [];
            if (isset($_POST['recog_title']) && is_array($_POST['recog_title'])) {
                foreach ($_POST['recog_title'] as $k => $rtitle) {
                    $rtitleTrim = trim($rtitle);
                    if (!empty($rtitleTrim)) {
                        $recogs[] = [
                            'title' => $rtitleTrim,
                            'label' => trim($_POST['recog_label'][$k] ?? '')
                        ];
                    }
                }
            }

            $mediaType = trim($_POST['chanc_media_type'] ?? 'video');
            $videoFit  = trim($_POST['chanc_video_fit'] ?? 'portrait');
            $imgUrl    = trim($_POST['chanc_image_url'] ?? '');
            if (isset($_FILES['chanc_image_file']) && !empty($_FILES['chanc_image_file']['name'])) {
                $upImg = bu_handle_upload($_FILES['chanc_image_file'], '../upload/media/');
                if ($upImg) {
                    $imgUrl = $upImg;
                }
            }

            if ($mediaType === 'image' && !empty($imgUrl)) {
                $mediaUrl = $imgUrl;
            }

            $extraArray = [
                'recognitions' => $recogs,
                'media_type'   => $mediaType,
                'video_fit'    => $videoFit,
                'image_url'    => $imgUrl
            ];
        } 
        // 3. WHY BHABHA (6+ Feature Points)
        elseif ($secKey == 'why_bhabha') {
            $feats = [];
            if (isset($_POST['why_title']) && is_array($_POST['why_title'])) {
                foreach ($_POST['why_title'] as $k => $wtitle) {
                    $wtitleTrim = trim($wtitle);
                    if (!empty($wtitleTrim)) {
                        $rawIcon = trim($_POST['why_icon'][$k] ?? 'fa fa-certificate');
                        if (!empty($rawIcon) && strpos($rawIcon, 'fa ') !== 0 && strpos($rawIcon, 'fas ') !== 0 && strpos($rawIcon, 'far ') !== 0 && strpos($rawIcon, 'fab ') !== 0) {
                            $rawIcon = 'fa ' . (strpos($rawIcon, 'fa-') === 0 ? $rawIcon : 'fa-' . $rawIcon);
                        }
                        $feats[] = [
                            'icon'  => $rawIcon,
                            'title' => $wtitleTrim,
                            'desc'  => trim($_POST['why_desc'][$k] ?? ''),
                            'url'   => trim($_POST['why_url'][$k] ?? '')
                        ];
                    }
                }
            }
            $extraArray = ['features' => $feats];
        } 
        // 4. VIRTUAL TOUR
        elseif ($secKey == 'virtual_tour') {
            // Video Tabs
            $vTabs = [];
            if (isset($_POST['vt_tab_label']) && is_array($_POST['vt_tab_label'])) {
                foreach ($_POST['vt_tab_label'] as $k => $tlabel) {
                    $tlabelTrim = trim($tlabel);
                    if (!empty($tlabelTrim)) {
                        $rawTabIcon = trim($_POST['vt_tab_icon'][$k] ?? 'fa fa-video-camera');
                        if (!empty($rawTabIcon) && strpos($rawTabIcon, 'fa ') !== 0 && strpos($rawTabIcon, 'fas ') !== 0 && strpos($rawTabIcon, 'far ') !== 0 && strpos($rawTabIcon, 'fab ') !== 0) {
                            $rawTabIcon = 'fa ' . (strpos($rawTabIcon, 'fa-') === 0 ? $rawTabIcon : 'fa-' . $rawTabIcon);
                        }
                        $tVid = trim($_POST['vt_tab_video'][$k] ?? '');
                        if (isset($_FILES['vt_tab_file']['name'][$k]) && !empty($_FILES['vt_tab_file']['name'][$k])) {
                            $uploadDir = '../upload/video/';
                            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
                            $origName = basename($_FILES['vt_tab_file']['name'][$k]);
                            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                            $allowed = ['mp4', 'webm', 'ogg'];
                            if (in_array($ext, $allowed)) {
                                $newF = md5(microtime() . $origName) . '.' . $ext;
                                if (move_uploaded_file($_FILES['vt_tab_file']['tmp_name'][$k], $uploadDir . $newF)) {
                                    $tVid = 'upload/video/' . $newF;
                                }
                            }
                        }
                        $vTabs[] = [
                            'label'     => $tlabelTrim,
                            'icon'      => $rawTabIcon,
                            'video_url' => $tVid
                        ];
                    }
                }
            }

            // Info Cards
            $cards = [];
            if (isset($_POST['vt_card_title']) && is_array($_POST['vt_card_title'])) {
                foreach ($_POST['vt_card_title'] as $k => $ctitle) {
                    $ctitleTrim = trim($ctitle);
                    if (!empty($ctitleTrim)) {
                        $rawCardIcon = trim($_POST['vt_card_icon'][$k] ?? 'fa fa-check');
                        if (!empty($rawCardIcon) && strpos($rawCardIcon, 'fa ') !== 0 && strpos($rawCardIcon, 'fas ') !== 0 && strpos($rawCardIcon, 'far ') !== 0 && strpos($rawCardIcon, 'fab ') !== 0) {
                            $rawCardIcon = 'fa ' . (strpos($rawCardIcon, 'fa-') === 0 ? $rawCardIcon : 'fa-' . $rawCardIcon);
                        }
                        $cards[] = [
                            'icon'  => $rawCardIcon,
                            'title' => $ctitleTrim,
                            'desc'  => trim($_POST['vt_card_desc'][$k] ?? '')
                        ];
                    }
                }
            }

            $vtPoster = trim($_POST['vt_poster'] ?? 'new-media/image/campus-aerial.png');
            if (isset($_FILES['vt_poster_file']) && !empty($_FILES['vt_poster_file']['name'])) {
                $upVt = bu_handle_upload($_FILES['vt_poster_file'], '../upload/media/');
                if ($upVt) $vtPoster = $upVt;
            }

            if (!empty($vTabs[0]['video_url'])) {
                $mediaUrl = $vTabs[0]['video_url'];
            }

            $extraArray = [
                'poster'     => $vtPoster,
                'badge1'     => trim($_POST['vt_badge1'] ?? 'Live Campus Video'),
                'badge2'     => trim($_POST['vt_badge2'] ?? 'Bhopal, MP'),
                'video_tabs' => $vTabs,
                'info_cards' => $cards,
                'cta_text'   => trim($_POST['vt_cta_text'] ?? 'Explore Full Virtual Tour'),
                'cta_url'    => trim($_POST['vt_cta_url'] ?? 'about.php#virtualTour')
            ];
        } 
        // 5. RESEARCH INNOVATION
        elseif ($secKey == 'research_innovation') {
            $metrics = [];
            if (isset($_POST['res_target']) && is_array($_POST['res_target'])) {
                foreach ($_POST['res_target'] as $k => $rtarg) {
                    $targetVal = intval(preg_replace('/[^0-9]/', '', $rtarg));
                    $metrics[] = [
                        'target' => $targetVal,
                        'value'  => (string)$targetVal,
                        'suffix' => trim($_POST['res_suffix'][$k] ?? ''),
                        'prefix' => trim($_POST['res_prefix'][$k] ?? ''),
                        'commas' => ($targetVal >= 1000),
                        'label'  => trim($_POST['res_label'][$k] ?? '')
                    ];
                }
            }
            $rawHlIcon = trim($_POST['res_highlight_icon'] ?? 'fa fa-flask');
            if (!empty($rawHlIcon) && strpos($rawHlIcon, 'fa ') !== 0 && strpos($rawHlIcon, 'fas ') !== 0 && strpos($rawHlIcon, 'far ') !== 0 && strpos($rawHlIcon, 'fab ') !== 0) {
                $rawHlIcon = 'fa ' . (strpos($rawHlIcon, 'fa-') === 0 ? $rawHlIcon : 'fa-' . $rawHlIcon);
            }
            $extraArray = [
                'metrics'        => $metrics,
                'highlight_icon' => $rawHlIcon,
                'highlight_text' => trim($_POST['res_highlight'] ?? ''),
                'button_text'    => trim($_POST['res_btn_text'] ?? 'EXPLORE RESEARCH →'),
                'button_url'     => trim($_POST['res_btn_url'] ?? 'research.php')
            ];
        } 
        // 6. GLOBAL NETWORK
        elseif ($secKey == 'global_network') {
            $tagsRaw = trim($_POST['glob_tags'] ?? '');
            $tags = array_filter(array_map('trim', explode(',', $tagsRaw)));
            $extraArray = [
                'tags'           => array_values($tags),
                'button_text'    => trim($_POST['glob_btn_text'] ?? 'APPLY NOW →'),
                'button_url'     => trim($_POST['glob_btn_url'] ?? 'enquiry.php'),
                'yt_is_live'     => isset($_POST['yt_is_live']) ? 1 : 0,
                'yt_live_url'    => trim($_POST['yt_live_url'] ?? ''),
                'yt_video_url'   => trim($_POST['yt_video_url'] ?? ''),
                'yt_title'       => trim($_POST['yt_title'] ?? ''),
                'yt_desc'        => trim($_POST['yt_desc'] ?? ''),
                'yt_channel_url' => trim($_POST['yt_channel_url'] ?? ''),
                'yt_channel_btn' => trim($_POST['yt_channel_btn'] ?? '')
            ];
        } 
        // 7. INSTA REELS
        elseif ($secKey == 'insta_reels') {
            $reels = [];
            if (isset($_POST['reel_url']) && is_array($_POST['reel_url'])) {
                foreach ($_POST['reel_url'] as $k => $rurl) {
                    $rurl = trim($rurl);
                    if (!empty($rurl)) {
                        $code = $rurl;
                        if (preg_match('/(?:reel|p)\/([A-Za-z0-9_-]+)/', $rurl, $m)) {
                            $code = $m[1];
                        }
                        $reels[] = [
                            'id'        => 'reel-' . ($k + 1),
                            'title'     => trim($_POST['reel_title'][$k] ?? ('Reel ' . ($k + 1))),
                            'code'      => $code,
                            'embed_url' => 'https://www.instagram.com/p/' . $code . '/embed/',
                            'insta_url' => 'https://www.instagram.com/reel/' . $code . '/'
                        ];
                    }
                }
            }
            $extraArray = [
                'reels'              => $reels,
                'footer_button_text' => trim($_POST['reels_btn_text'] ?? 'View Instagram Page →'),
                'footer_button_url'  => trim($_POST['reels_btn_url'] ?? 'https://www.instagram.com/bhabhauniversitybhopal/')
            ];
        } 
        // 8. DEGREE PROGRAMS (Dyna-linked to course table)
        elseif ($secKey == 'degree_programs') {
            $extraArray = [
                'source'      => 'course_table',
                'description' => 'Courses are dynamically fetched from Course Master (admin/course.php)'
            ];
        } 
        // 9. INFRASTRUCTURE GRID
        elseif ($secKey == 'infrastructure_grid') {
            $facs = [];
            if (isset($_POST['fac_title']) && is_array($_POST['fac_title'])) {
                foreach ($_POST['fac_title'] as $k => $ftitle) {
                    $ftitleTrim = trim($ftitle);
                    if (!empty($ftitleTrim)) {
                        $fKey = trim($_POST['fac_key'][$k] ?? '');
                        if (empty($fKey)) {
                            $fKey = preg_replace('/[^a-z0-9]+/', '-', strtolower($ftitleTrim));
                        }
                        $fImg = trim($_POST['fac_image'][$k] ?? '');
                        if (isset($_FILES['fac_file']['name'][$k]) && !empty($_FILES['fac_file']['name'][$k])) {
                            $uploadDir = '../upload/infrastructure/';
                            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
                            $origName = basename($_FILES['fac_file']['name'][$k]);
                            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                            if (in_array($ext, $allowed)) {
                                $newF = md5(microtime() . $origName) . '.' . $ext;
                                if (move_uploaded_file($_FILES['fac_file']['tmp_name'][$k], $uploadDir . $newF)) {
                                    $fImg = 'upload/infrastructure/' . $newF;
                                }
                            }
                        }
                        $facs[$fKey] = [
                            'title' => $ftitleTrim,
                            'badge' => trim($_POST['fac_badge'][$k] ?? 'Campus Facility'),
                            'desc'  => trim($_POST['fac_desc'][$k] ?? ''),
                            'image' => $fImg,
                            'link'  => trim($_POST['fac_link'][$k] ?? 'infrastructure.php')
                        ];
                    }
                }
            }
            $extraArray = ['facilities' => $facs];
        } 
        // 10. CAMPUS LIFE
        elseif ($secKey == 'campus_life') {
            $cards = [];
            if (isset($_POST['cl_title']) && is_array($_POST['cl_title'])) {
                foreach ($_POST['cl_title'] as $k => $clTitle) {
                    $clTitleTrim = trim($clTitle);
                    if (!empty($clTitleTrim)) {
                        $cImg = trim($_POST['cl_image'][$k] ?? '');
                        if (isset($_FILES['cl_file']['name'][$k]) && !empty($_FILES['cl_file']['name'][$k])) {
                            $uploadDir = '../upload/media/';
                            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
                            $origName = basename($_FILES['cl_file']['name'][$k]);
                            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                            if (in_array($ext, $allowed)) {
                                $newF = md5(microtime() . $origName) . '.' . $ext;
                                if (move_uploaded_file($_FILES['cl_file']['tmp_name'][$k], $uploadDir . $newF)) {
                                    $cImg = 'upload/media/' . $newF;
                                }
                            }
                        }
                        $cards[] = [
                            'title' => $clTitleTrim,
                            'badge' => trim($_POST['cl_badge'][$k] ?? ''),
                            'icon'  => trim($_POST['cl_icon'][$k] ?? 'fa fa-star'),
                            'desc'  => trim($_POST['cl_desc'][$k] ?? ''),
                            'image' => $cImg,
                            'link'  => trim($_POST['cl_link'][$k] ?? 'infrastructure.php')
                        ];
                    }
                }
            }
            $extraArray = ['cards' => $cards];
        } 
        // 11. HALL OF FAME
        elseif ($secKey == 'hall_of_fame') {
            $posters = [];
            if (isset($_POST['fame_title']) && is_array($_POST['fame_title'])) {
                foreach ($_POST['fame_title'] as $k => $fTitle) {
                    $fTitleTrim = trim($fTitle);
                    if (!empty($fTitleTrim)) {
                        $pImg = trim($_POST['fame_src'][$k] ?? '');
                        if (isset($_FILES['fame_file']['name'][$k]) && !empty($_FILES['fame_file']['name'][$k])) {
                            $uploadDir = '../upload/media/';
                            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
                            $origName = basename($_FILES['fame_file']['name'][$k]);
                            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                            if (in_array($ext, $allowed)) {
                                $newF = md5(microtime() . $origName) . '.' . $ext;
                                if (move_uploaded_file($_FILES['fame_file']['tmp_name'][$k], $uploadDir . $newF)) {
                                    $pImg = 'upload/media/' . $newF;
                                }
                            }
                        }
                        $posters[] = [
                            'title'    => $fTitleTrim,
                            'category' => trim($_POST['fame_cat'][$k] ?? 'Placement Milestone'),
                            'alt'      => trim($_POST['fame_alt'][$k] ?? $fTitleTrim),
                            'src'      => $pImg
                        ];
                    }
                }
            }
            $extraArray = ['posters' => $posters];
        } 
        // 12. ACCREDITATIONS
        elseif ($secKey == 'accreditations') {
            $items = [];
            if (isset($_POST['acc_name']) && is_array($_POST['acc_name'])) {
                foreach ($_POST['acc_name'] as $k => $aName) {
                    $aNameTrim = trim($aName);
                    if (!empty($aNameTrim)) {
                        $aImg = trim($_POST['acc_img'][$k] ?? '');
                        if (isset($_FILES['acc_file']['name'][$k]) && !empty($_FILES['acc_file']['name'][$k])) {
                            $uploadDir = '../upload/media/';
                            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
                            $origName = basename($_FILES['acc_file']['name'][$k]);
                            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
                            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                            if (in_array($ext, $allowed)) {
                                $newF = md5(microtime() . $origName) . '.' . $ext;
                                if (move_uploaded_file($_FILES['acc_file']['tmp_name'][$k], $uploadDir . $newF)) {
                                    $aImg = 'upload/media/' . $newF;
                                }
                            }
                        }
                        $items[] = [
                            'name' => $aNameTrim,
                            'desc' => trim($_POST['acc_desc'][$k] ?? 'Approved'),
                            'alt'  => trim($_POST['acc_alt'][$k] ?? $aNameTrim),
                            'img'  => $aImg,
                            'link' => trim($_POST['acc_link'][$k] ?? 'approvals.php')
                        ];
                    }
                }
            }
            $extraArray = ['items' => $items];
        } 
        // 13. CTA JOURNEY
        elseif ($secKey == 'cta_journey') {
            $extraArray = [
                'btn1_text'  => trim($_POST['cta_btn1_text'] ?? 'APPLY NOW'),
                'btn1_url'   => trim($_POST['cta_btn1_url'] ?? 'enquiry.php'),
                'btn2_text'  => trim($_POST['cta_btn2_text'] ?? 'DOWNLOAD PROSPECTUS'),
                'btn2_url'   => trim($_POST['cta_btn2_url'] ?? ''),
                'btn3_text'  => trim($_POST['cta_btn3_text'] ?? 'SCHEDULE CALL'),
                'btn3_phone' => trim($_POST['cta_btn3_phone'] ?? '07554246498')
            ];
        } 
        // 14. ACHIEVEMENTS & NEWS TICKER
        elseif ($secKey == 'achievements_ticker') {
            $source = trim($_POST['ticker_source'] ?? 'news');
            $items = [];
            if (isset($_POST['ach_item_title']) && is_array($_POST['ach_item_title'])) {
                foreach ($_POST['ach_item_title'] as $k => $aTitle) {
                    $aTitleTrim = trim($aTitle);
                    if (!empty($aTitleTrim)) {
                        $items[] = [
                            'title' => $aTitleTrim,
                            'url'   => trim($_POST['ach_item_url'][$k] ?? '')
                        ];
                    }
                }
            }
            $extraArray = [
                'source' => $source,
                'items'  => $items
            ];
        }
        
        $extraJson = !empty($extraArray) ? json_encode($extraArray, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : ($currSec['extra_data'] ?? '');
        
        if (count($stat) == 0) {
            $data = [
                "title"       => trim($_POST['title'] ?? ''),
                "heading"     => trim($_POST['heading'] ?? ''),
                "subheading"  => trim($_POST['subheading'] ?? ''),
                "content"     => trim($_POST['content'] ?? ''),
                "media_url"   => $mediaUrl,
                "quote"       => trim($_POST['quote'] ?? ''),
                "author"      => trim($_POST['author'] ?? ''),
                "extra_data"  => $extraJson,
                "status"      => isset($_POST['status']) ? 1 : 0
            ];
            
            try {
                $db->where('id', $id);
                $db->update(DBTAB, $data);
                unset($_POST);
                unset($_SESSION['form']);
                $_SESSION["success"] = 'Section Updated Successfully';
                redirect(PAGE);
            } catch (\Throwable $e) {
                $stat['error'] = 'Failed to update section: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title><?php echo TITLE; ?> - Admin Panel</title>
<?php include_once("inc.meta.php"); ?>
<!-- DataTables -->
<link href="<?php echo URL_PLUG;?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_PLUG;?>datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_PLUG;?>datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<style>
.section-badge-key {
    background: #0A1B54;
    color: #FFC107;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 4px;
    letter-spacing: 0.5px;
    display: inline-block;
}
.status-badge-active {
    background: #28a745;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 12px;
}
.status-badge-inactive {
    background: #dc3545;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 12px;
}
.help-tip {
    font-size: 12px;
    color: #6c757d;
    margin-top: 4px;
    display: block;
}
.simple-card-group {
    background: #f8f9fc;
    border: 1px solid #e3e6f0;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
    margin-bottom: 25px;
}
.simple-card-title {
    font-size: 15px;
    font-weight: 700;
    color: #0A1B54;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    border-bottom: 2px solid #eaecf4;
    padding-bottom: 8px;
}
.simple-item-box {
    background: #ffffff;
    border: 1px solid #d1d3e2;
    border-radius: 6px;
    padding: 14px;
    margin-bottom: 15px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    position: relative;
}
.btn-delete-row {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 2px 8px;
    font-size: 11px;
}
.bu-live-thumb-wrap {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-top: 6px;
    background: #f1f5f9;
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
}
.bu-live-thumb-img {
    width: 54px;
    height: 54px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #94a3b8;
    background: #fff;
}
.bu-live-video-preview {
    max-width: 100%;
    max-height: 180px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    background: #000;
    margin-top: 6px;
}
.bu-icon-badge-preview {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: #0A1B54;
    color: #FFC107;
    border-radius: 4px;
    font-size: 16px;
}
</style>
</head>
<body>
<div id="wrapper">
  <?php include_once("inc.top.php"); ?>
  <?php include_once("inc.menu.php"); ?>
  
  <div class="content-page">
    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title-box">
              <h4 class="page-title"><i class="mdi mdi-home"></i> <?php echo TITLE; ?></h4>
            </div>
          </div>
        </div>
        
        <?php if ($action == "edit"): 
            $secId = intval($_GET['id'] ?? ($_POST['id'] ?? 0));
            $aryData = null;
            try {
                $db->where('id', $secId);
                $aryData = $db->getOne(DBTAB);
            } catch (\Throwable $e) {
                try {
                    bu_ensure_homepage_sections_schema($db);
                    $db->where('id', $secId);
                    $aryData = $db->getOne(DBTAB);
                } catch (\Throwable $e2) {}
            }
            if (!$aryData) {
                redirect(PAGE);
            }
            $extra = !empty($aryData['extra_data']) ? json_decode($aryData['extra_data'], true) : [];
        ?>
        <!-- EDIT SECTION FORM -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="mt-0 header-title"><i class="fa fa-edit text-primary"></i> Edit Section: <?php echo htmlspecialchars($aryData['section_name']); ?></h4>
                    <span class="section-badge-key"><?php echo htmlspecialchars($aryData['section_key']); ?></span>
                  </div>
                  <a href="<?php echo PAGE; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
                </div>
                
                <div style="margin-bottom:15px;"> <?php echo msg($stat); ?></div>
                
                <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $aryData['id']; ?>">
                  <input type="hidden" name="action" value="edit">
                  
                  <div class="row">
                    <!-- Title / Badge -->
                    <div class="form-group col-md-6">
                      <label>Top Badge / Label</label>
                      <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($aryData['title']); ?>" />
                      <small class="help-tip">Small uppercase badge shown above heading (e.g., "AERIAL · BHOPAL CAMPUS", "WHY BHABHA")</small>
                    </div>
                    
                    <!-- Heading -->
                    <div class="form-group col-md-6">
                      <label>Main Section Heading</label>
                      <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($aryData['heading']); ?>" />
                      <small class="help-tip">Supports HTML tags like &lt;em&gt;italic gold&lt;/em&gt; and &lt;br&gt;</small>
                    </div>
                  </div>
                  
                  <!-- Subheading / Description -->
                  <div class="form-group">
                    <label>Subheading / Intro Paragraph</label>
                    <textarea name="subheading" class="form-control" rows="3"><?php echo htmlspecialchars($aryData['subheading']); ?></textarea>
                    <small class="help-tip">Brief subtitle or introductory text displayed below the heading</small>
                  </div>
                  
                  <!-- Chancellor Specific Fields -->
                  <?php if ($aryData['section_key'] == 'chancellor_welcome'): ?>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Quote Text</label>
                      <input type="text" name="quote" class="form-control" value="<?php echo htmlspecialchars($aryData['quote']); ?>" />
                      <small class="help-tip">Chancellor highlight quote on video/photo card</small>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Quote Author</label>
                      <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($aryData['author']); ?>" />
                      <small class="help-tip">E.g., "DR. SADHNA KAPOOR · CHANCELLOR"</small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Chancellor Message (Full Content)</label>
                    <textarea name="content" class="form-control ckeditor" rows="5"><?php echo $aryData['content']; ?></textarea>
                  </div>
                  
                  <!-- Recognitions tags for Chancellor -->
                  <?php $recogs = !empty($extra['recognitions']) ? $extra['recognitions'] : []; ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title"><i class="fa fa-shield text-success"></i> Chancellor Recognition Badges (3 Items)</div>
                    <div class="row">
                      <?php for ($i = 0; $i < 3; $i++): 
                        $rc = $recogs[$i] ?? ['title' => '', 'label' => ''];
                      ?>
                      <div class="col-md-4 mb-2">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Badge #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Title (e.g. UGC / AICTE)</small>
                            <input type="text" name="recog_title[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($rc['title']); ?>">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Status (e.g. RECOGNISED / APPROVED)</small>
                            <input type="text" name="recog_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($rc['label']); ?>">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <!-- Main Media / Video URL & Live Preview for Chancellor -->
                  <?php if (in_array($aryData['section_key'], ['chancellor_welcome'])): 
                    $chancMediaType = $extra['media_type'] ?? (preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $aryData['media_url']) ? 'image' : 'video');
                    $chancVideoFit  = $extra['video_fit'] ?? 'portrait';
                    $chancImageUrl  = !empty($extra['image_url']) ? $extra['image_url'] : (preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $aryData['media_url']) ? $aryData['media_url'] : 'assets/images/vcpic.jpg');
                  ?>
                  <div class="simple-card-group">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="simple-card-title mb-0">
                        <i class="fa fa-photo text-primary"></i> Chancellor Media (Video or Photo Mode)
                      </div>
                      <div class="btn-group btn-group-toggle">
                        <label class="btn btn-sm <?php echo ($chancMediaType === 'video') ? 'btn-primary active font-weight-bold' : 'btn-outline-primary'; ?>" id="lbl_mtype_vid" onclick="toggleChancellorMediaType('video')">
                          <input type="radio" name="chanc_media_type" value="video" id="mtype_vid" <?php echo ($chancMediaType === 'video') ? 'checked' : ''; ?> style="display:none;"> <i class="fa fa-video-camera"></i> Video Mode
                        </label>
                        <label class="btn btn-sm <?php echo ($chancMediaType === 'image') ? 'btn-success active font-weight-bold' : 'btn-outline-success'; ?>" id="lbl_mtype_img" onclick="toggleChancellorMediaType('image')">
                          <input type="radio" name="chanc_media_type" value="image" id="mtype_img" <?php echo ($chancMediaType === 'image') ? 'checked' : ''; ?> style="display:none;"> <i class="fa fa-image"></i> Photo / Image Mode
                        </label>
                      </div>
                    </div>

                    <!-- 1. VIDEO SETTINGS PANEL -->
                    <div id="chanc_video_panel" style="<?php echo ($chancMediaType === 'image') ? 'display:none;' : ''; ?>">
                      <div class="row">
                        <div class="col-md-7 form-group">
                          <label class="font-weight-bold"><i class="fa fa-film text-info"></i> Video URL (Vimeo / YouTube / .mp4)</label>
                          <input type="text" name="media_url" class="form-control" value="<?php echo htmlspecialchars($aryData['media_url']); ?>" placeholder="https://vimeo.com/... or https://youtube.com/... or new-media/image/hero/sadhna-mam.mp4" />
                          <small class="help-tip">Paste <strong>Vimeo</strong> link, <strong>YouTube</strong> link, or local <strong>.mp4</strong> path.</small>
                        </div>
                        <div class="col-md-5 form-group">
                          <label class="font-weight-bold"><i class="fa fa-upload text-info"></i> Or Upload Video File (.mp4)</label>
                          <input type="file" name="media_file" class="form-control-file" accept="video/mp4,video/webm" />
                          <small class="help-tip">Uploads directly to <code>upload/media/</code></small>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-7 form-group">
                          <label class="font-weight-bold"><i class="fa fa-arrows-alt text-secondary"></i> Video Fit Mode (Black Space Remove)</label>
                          <select name="chanc_video_fit" class="form-control form-control-sm">
                            <option value="portrait" <?php echo ($chancVideoFit === 'portrait') ? 'selected' : ''; ?>>Portrait / Full Bleed 9:16 (Recommended for Phone/Vertical Video - NO Black Bars)</option>
                            <option value="landscape" <?php echo ($chancVideoFit === 'landscape') ? 'selected' : ''; ?>>Landscape / Widescreen 16:9 (Cover Full Box)</option>
                            <option value="fit" <?php echo ($chancVideoFit === 'fit') ? 'selected' : ''; ?>>Fit Center (Standard)</option>
                          </select>
                          <small class="help-tip">Default <strong>Portrait</strong> option removes all black borders on the sides for phone/reel videos.</small>
                        </div>
                      </div>

                      <?php if (!empty($aryData['media_url']) && $chancMediaType !== 'image'): 
                        $vInfo = bu_parse_video_url($aryData['media_url']);
                        $mResolved = bu_admin_media_url($aryData['media_url']);
                        $isVid = preg_match('/\.(mp4|webm|ogg)$/i', $aryData['media_url']);
                      ?>
                      <div class="mt-2">
                        <small class="font-weight-bold text-muted d-block mb-1">Current Video Preview:</small>
                        <?php if ($vInfo['type'] === 'vimeo' || $vInfo['type'] === 'youtube'): ?>
                          <div class="mt-2" style="max-width:320px;">
                            <div class="embed-responsive embed-responsive-16by9 rounded shadow-sm border" style="background:#000;">
                              <iframe class="embed-responsive-item" src="<?php echo $vInfo['preview']; ?>" allowfullscreen></iframe>
                            </div>
                            <span class="badge badge-success mt-1"><i class="fa fa-check"></i> <?php echo ucfirst($vInfo['type']); ?> Video (ID: <?php echo htmlspecialchars($vInfo['id']); ?>)</span>
                          </div>
                        <?php elseif ($isVid): ?>
                          <video src="<?php echo $mResolved; ?>" controls class="bu-live-video-preview" style="max-height:160px;"></video>
                        <?php endif; ?>
                      </div>
                      <?php endif; ?>
                    </div>

                    <!-- 2. PHOTO / IMAGE SETTINGS PANEL -->
                    <div id="chanc_image_panel" style="<?php echo ($chancMediaType !== 'image') ? 'display:none;' : ''; ?>">
                      <div class="row">
                        <div class="col-md-7 form-group">
                          <label class="font-weight-bold"><i class="fa fa-picture-o text-success"></i> Chancellor Photo / Image URL</label>
                          <input type="text" name="chanc_image_url" class="form-control" value="<?php echo htmlspecialchars($chancImageUrl); ?>" placeholder="assets/images/vcpic.jpg or upload/media/..." />
                          <small class="help-tip">Image path or external URL (e.g. <code>assets/images/vcpic.jpg</code>)</small>
                        </div>
                        <div class="col-md-5 form-group">
                          <label class="font-weight-bold"><i class="fa fa-upload text-success"></i> Or Upload New Photo (.jpg, .png, .webp)</label>
                          <input type="file" name="chanc_image_file" class="form-control-file" accept="image/*" />
                          <small class="help-tip">Recommended: Portrait photo (600x700px)</small>
                        </div>
                      </div>

                      <?php if (!empty($chancImageUrl)): 
                        $imgResolved = bu_admin_media_url($chancImageUrl);
                      ?>
                      <div class="mt-2">
                        <small class="font-weight-bold text-muted d-block mb-1">Current Photo Preview:</small>
                        <div class="bu-live-thumb-wrap">
                          <img src="<?php echo $imgResolved; ?>" alt="Chancellor" class="bu-live-thumb-img" style="width:70px; height:80px; object-fit:cover; border-radius:4px;">
                          <div>
                            <span class="font-weight-bold d-block"><?php echo basename($chancImageUrl); ?></span>
                            <a href="<?php echo $imgResolved; ?>" target="_blank" class="small text-primary"><i class="fa fa-external-link"></i> View Full Image</a>
                          </div>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>

                  </div>
                  <?php endif; ?>
                  
                  <!-- ============================================== -->
                  <!-- SECTION-SPECIFIC SIMPLE FIELDS                 -->
                  <!-- ============================================== -->
                  
                  <!-- 1. HERO VIDEO & STATS BAR FIELDS -->
                  <?php if ($aryData['section_key'] == 'hero_video'): 
                    $stats = !empty($extra['stats']) ? $extra['stats'] : [];
                    $heroPoster = $extra['poster'] ?? 'new-media/image/campus-aerial.png';
                    $heroVid2 = $extra['video_2'] ?? 'new-media/image/hero/bhabha_1.mp4';
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-video-camera text-primary"></i> Hero Background Videos &amp; Poster Image (Live Previews)
                    </div>
                    
                    <!-- Video 1 -->
                    <div class="simple-item-box mb-3">
                      <label class="text-primary font-weight-bold"><i class="fa fa-film"></i> Primary Hero Video (Background Loop)</label>
                      <div class="row">
                        <div class="col-md-7 form-group mb-1">
                          <small class="text-muted">Video 1 URL (Vimeo / YouTube / .mp4)</small>
                          <input type="text" name="media_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($aryData['media_url']); ?>" placeholder="https://vimeo.com/... or https://youtu.be/... or new-media/image/hero/bhabha_2.mp4">
                        </div>
                        <div class="col-md-5 form-group mb-1">
                          <small class="text-muted">Or Upload Video 1 (.mp4)</small>
                          <input type="file" name="media_file" class="form-control-file">
                        </div>
                      </div>
                      <small class="text-muted d-block mb-2"><i class="fa fa-info-circle text-info"></i> Supports <strong>Vimeo</strong> URLs (e.g. <code>https://vimeo.com/123456789</code>), <strong>YouTube</strong> URLs, or local/uploaded <strong>.mp4</strong> video files.</small>
                      <?php if (!empty($aryData['media_url'])): 
                        $v1Info = bu_parse_video_url($aryData['media_url']);
                        if ($v1Info['type'] === 'vimeo' || $v1Info['type'] === 'youtube'):
                      ?>
                        <div class="mt-2" style="max-width:320px;">
                          <div class="embed-responsive embed-responsive-16by9 rounded shadow-sm border" style="background:#000;">
                            <iframe class="embed-responsive-item" src="<?php echo $v1Info['preview']; ?>" allowfullscreen></iframe>
                          </div>
                          <span class="badge badge-success mt-1"><i class="fa fa-check"></i> <?php echo ucfirst($v1Info['type']); ?> Video (ID: <?php echo htmlspecialchars($v1Info['id']); ?>)</span>
                        </div>
                      <?php else: ?>
                        <video src="<?php echo bu_admin_media_url($aryData['media_url']); ?>" controls class="bu-live-video-preview" style="max-height:140px;"></video>
                      <?php endif; ?>
                      <?php endif; ?>
                    </div>

                    <!-- Video 2 -->
                    <div class="simple-item-box mb-3">
                      <label class="text-primary font-weight-bold"><i class="fa fa-film"></i> Secondary / Fallback Hero Video</label>
                      <div class="row">
                        <div class="col-md-7 form-group mb-1">
                          <small class="text-muted">Video 2 URL (Vimeo / YouTube / .mp4)</small>
                          <input type="text" name="hero_video_2" class="form-control form-control-sm" value="<?php echo htmlspecialchars($heroVid2); ?>" placeholder="https://vimeo.com/... or https://youtu.be/... or new-media/image/hero/bhabha_1.mp4">
                        </div>
                        <div class="col-md-5 form-group mb-1">
                          <small class="text-muted">Or Upload Video 2 (.mp4)</small>
                          <input type="file" name="hero_video2_file" class="form-control-file">
                        </div>
                      </div>
                      <small class="text-muted d-block mb-2"><i class="fa fa-info-circle text-info"></i> Fallback video or alternate source. Supports <strong>Vimeo</strong>, <strong>YouTube</strong>, or <strong>.mp4</strong>.</small>
                      <?php if (!empty($heroVid2)): 
                        $v2Info = bu_parse_video_url($heroVid2);
                        if ($v2Info['type'] === 'vimeo' || $v2Info['type'] === 'youtube'):
                      ?>
                        <div class="mt-2" style="max-width:320px;">
                          <div class="embed-responsive embed-responsive-16by9 rounded shadow-sm border" style="background:#000;">
                            <iframe class="embed-responsive-item" src="<?php echo $v2Info['preview']; ?>" allowfullscreen></iframe>
                          </div>
                          <span class="badge badge-success mt-1"><i class="fa fa-check"></i> <?php echo ucfirst($v2Info['type']); ?> Video (ID: <?php echo htmlspecialchars($v2Info['id']); ?>)</span>
                        </div>
                      <?php else: ?>
                        <video src="<?php echo bu_admin_media_url($heroVid2); ?>" controls class="bu-live-video-preview" style="max-height:140px;"></video>
                      <?php endif; ?>
                      <?php endif; ?>
                    </div>

                    <!-- Poster Image -->
                    <div class="simple-item-box">
                      <label class="text-primary font-weight-bold"><i class="fa fa-picture-o"></i> Hero Video Poster Image (Before Video Loads)</label>
                      <div class="row">
                        <div class="col-md-7 form-group mb-1">
                          <small class="text-muted">Poster Image URL / Path</small>
                          <input type="text" name="hero_poster" class="form-control form-control-sm" value="<?php echo htmlspecialchars($heroPoster); ?>">
                        </div>
                        <div class="col-md-5 form-group mb-1">
                          <small class="text-muted">Or Upload Poster (.jpg, .png)</small>
                          <input type="file" name="hero_poster_file" class="form-control-file">
                        </div>
                      </div>
                      <?php if (!empty($heroPoster)): ?>
                        <div class="bu-live-thumb-wrap mt-1">
                          <img src="<?php echo bu_admin_media_url($heroPoster); ?>" alt="Poster" class="bu-live-thumb-img">
                          <span class="small font-weight-bold text-muted"><?php echo basename($heroPoster); ?></span>
                        </div>
                      <?php endif; ?>
                    </div>

                    <!-- Hero Stats -->
                    <div class="simple-card-title mt-4">
                      <i class="fa fa-bar-chart text-success"></i> Hero Stats Bar Counters (8 Items)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 8; $i++): 
                        $st = $stats[$i] ?? ['number' => '', 'suffix' => '', 'label' => '', 'url' => ''];
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Stat #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Target Number</small>
                            <input type="text" name="hero_stat_num[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($st['number']); ?>" placeholder="e.g. 15000">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Suffix (e.g. + or % or ac)</small>
                            <input type="text" name="hero_stat_suffix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['suffix']); ?>" placeholder="e.g. +">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Label Text</small>
                            <input type="text" name="hero_stat_lbl[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['label']); ?>" placeholder="e.g. STUDENTS ENROLLED">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Target Link (Optional)</small>
                            <input type="text" name="hero_stat_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($st['url'] ?? ''); ?>" placeholder="online-admission.php">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 2. WHY BHABHA (6+ FEATURE POINTS) -->
                  <?php if ($aryData['section_key'] == 'why_bhabha'): 
                    $feats = !empty($extra['features']) ? $extra['features'] : [
                        ['icon' => 'fa fa-certificate', 'title' => 'UGC Recognised', 'desc' => 'UGC recognised under Section 2(f) with approvals from AICTE, PCI, BCI, DCI, NCTE.', 'url' => 'approvals.php'],
                        ['icon' => 'fa fa-flask', 'title' => 'Research Excellence', 'desc' => '120+ research labs, 250+ patents and 2,500+ publications.', 'url' => 'research.php'],
                        ['icon' => 'fa fa-globe', 'title' => 'Global Collaborations', 'desc' => 'MoUs with 60+ international universities across 4 continents.', 'url' => 'page.php?id=9'],
                        ['icon' => 'fa fa-mortar-board', 'title' => 'Outstanding Placements', 'desc' => '98% placement rate with 300+ recruiters and packages up to ₹60 LPA.', 'url' => 'placements.php'],
                        ['icon' => 'fa fa-building-o', 'title' => 'Smart Campus', 'desc' => '32-acre wifi-enabled green campus with smart classrooms.', 'url' => 'infrastructure.php'],
                        ['icon' => 'fa fa-rocket', 'title' => 'Innovation Ecosystem', 'desc' => 'Incubation centre, student startups and industry mentoring.', 'url' => 'research.php#incubation-edc']
                    ];
                  ?>
                  <div class="simple-card-group">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="simple-card-title mb-0">
                        <i class="fa fa-graduation-cap text-primary"></i> Why Bhabha Key Feature Cards (Points &amp; Badges)
                      </div>
                      <button type="button" class="btn btn-sm btn-success" onclick="addWhyBhabhaRow()"><i class="fa fa-plus"></i> Add New Point</button>
                    </div>
                    <div id="whyBhabhaRowsContainer" class="row">
                      <?php foreach ($feats as $k => $f): 
                        $fIcon = !empty($f['icon']) ? $f['icon'] : 'fa fa-star';
                      ?>
                      <div class="col-md-6 mb-3 why-feat-item">
                        <div class="simple-item-box">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.why-feat-item').remove();">&times; Remove</button>
                          <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="bu-icon-badge-preview mr-2"><i class="<?php echo htmlspecialchars($fIcon); ?>"></i></span>
                            <label class="text-primary font-weight-bold mb-0">Feature Point #<?php echo $k + 1; ?></label>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-8 form-group mb-1">
                              <small class="text-muted">Point Title</small>
                              <input type="text" name="why_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($f['title'] ?? ''); ?>" placeholder="e.g. UGC Recognised">
                            </div>
                            <div class="col-md-4 form-group mb-1">
                              <small class="text-muted">FontAwesome Icon</small>
                              <input type="text" name="why_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($fIcon); ?>" placeholder="fa fa-certificate">
                            </div>
                          </div>
                          
                          <div class="form-group mb-1">
                            <small class="text-muted">Description Text</small>
                            <textarea name="why_desc[]" class="form-control form-control-sm" rows="2" placeholder="Point description..."><?php echo htmlspecialchars($f['desc'] ?? ''); ?></textarea>
                          </div>
                          
                          <div class="form-group mb-0">
                            <small class="text-muted">Explore Details Link / URL</small>
                            <input type="text" name="why_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['url'] ?? ''); ?>" placeholder="approvals.php">
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 3. VIRTUAL TOUR 360 -->
                  <?php if ($aryData['section_key'] == 'virtual_tour'): 
                    $vtPoster = $extra['poster'] ?? 'new-media/image/campus-aerial.png';
                    $vtTabs = !empty($extra['video_tabs']) ? $extra['video_tabs'] : [
                        ['label' => 'Aerial Drone', 'icon' => 'fa fa-plane', 'video_url' => 'upload/video/bhabha_video.mp4'],
                        ['label' => 'Campus Tour Video', 'icon' => 'fa fa-film', 'video_url' => 'new-media/image/hero/bhabha_2.mp4'],
                        ['label' => 'Academic & Labs', 'icon' => 'fa fa-flask', 'video_url' => 'new-media/image/hero/academic-lab.mp4'],
                        ['label' => 'Student Life', 'icon' => 'fa fa-graduation-cap', 'video_url' => 'new-media/image/hero/bhabha_4.mp4']
                    ];
                    $vtCards = !empty($extra['info_cards']) ? $extra['info_cards'] : ($extra['cards'] ?? [
                        ['icon' => 'fa fa-tree', 'title' => '32-Acre Green Campus', 'desc' => 'Eco-friendly lush green campus with solar energy, botanical gardens, and spacious plazas.'],
                        ['icon' => 'fa fa-university', 'title' => '25 Institutes', 'desc' => 'Engineering, Medical, Dental, Pharmacy, Law, Agriculture & Management blocks.'],
                        ['icon' => 'fa fa-flask', 'title' => '120+ Modern Labs', 'desc' => 'Hi-tech practical skill labs, research wings, and state-of-art computing centers.'],
                        ['icon' => 'fa fa-hospital-o', 'title' => '500-Bed Hospital', 'desc' => 'Full-fledged multi-speciality teaching hospital & clinical training facility.']
                    ]);
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title"><i class="fa fa-street-view text-primary"></i> Virtual Tour Video Poster &amp; Floating Badges</div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label>Video Poster Image URL</label>
                        <input type="text" name="vt_poster" class="form-control form-control-sm" value="<?php echo htmlspecialchars($vtPoster); ?>">
                        <?php if (!empty($vtPoster)): ?>
                          <div class="bu-live-thumb-wrap mt-1">
                            <img src="<?php echo bu_admin_media_url($vtPoster); ?>" alt="Poster" class="bu-live-thumb-img">
                            <span class="small font-weight-bold text-muted"><?php echo basename($vtPoster); ?></span>
                          </div>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Or Upload New Poster</label>
                        <input type="file" name="vt_poster_file" class="form-control-file">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label>Badge 1 Text (Overlay Left)</label>
                        <input type="text" name="vt_badge1" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['badge1'] ?? 'Live Campus Video'); ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Badge 2 Text (Overlay Right)</label>
                        <input type="text" name="vt_badge2" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['badge2'] ?? 'Bhopal, MP'); ?>">
                      </div>
                    </div>
                    
                    <!-- 4 Interactive Video Tabs -->
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                      <div class="simple-card-title mb-0 border-0 p-0">
                        <i class="fa fa-film text-danger"></i> Interactive Video Tabs (<?php echo count($vtTabs); ?> Tabs)
                      </div>
                      <button type="button" class="btn btn-sm btn-success" onclick="addVirtualTourTab()"><i class="fa fa-plus"></i> Add Video Tab</button>
                    </div>
                    <div id="vtTabsRowsContainer" class="row">
                      <?php foreach ($vtTabs as $k => $vtTab): 
                        $tIcon = !empty($vtTab['icon']) ? $vtTab['icon'] : 'fa fa-video-camera';
                        $tVid = !empty($vtTab['video_url']) ? $vtTab['video_url'] : '';
                      ?>
                      <div class="col-md-6 mb-3 vt-tab-item">
                        <div class="simple-item-box" style="border-color:#4e73df;">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.vt-tab-item').remove();">&times; Remove</button>
                          <div class="d-flex align-items-center mb-2">
                            <span class="bu-icon-badge-preview mr-2"><i class="<?php echo htmlspecialchars($tIcon); ?>"></i></span>
                            <label class="text-primary font-weight-bold mb-0">Video Tab #<?php echo $k + 1; ?></label>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Tab Label</small>
                              <input type="text" name="vt_tab_label[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($vtTab['label'] ?? ''); ?>" placeholder="e.g. Aerial Drone">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="vt_tab_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tIcon); ?>" placeholder="fa fa-plane">
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Video URL (Vimeo / YouTube / .mp4)</small>
                              <input type="text" name="vt_tab_video[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($tVid); ?>" placeholder="https://vimeo.com/... or https://youtu.be/... or upload/video/...">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Or Upload Video (.mp4)</small>
                              <input type="file" name="vt_tab_file[]" class="form-control-file">
                            </div>
                          </div>
                          <small class="text-muted d-block mb-1"><i class="fa fa-info-circle text-info"></i> Supports <strong>Vimeo</strong> link, <strong>YouTube</strong> link, or uploaded <strong>.mp4</strong></small>

                          <?php if (!empty($tVid)): 
                            $vtInfo = bu_parse_video_url($tVid);
                            if ($vtInfo['type'] === 'vimeo' || $vtInfo['type'] === 'youtube'):
                          ?>
                            <div class="mt-2" style="max-width:300px;">
                              <small class="text-muted font-weight-bold d-block mb-1"><i class="fa fa-play-circle"></i> Live Video Preview (<?php echo ucfirst($vtInfo['type']); ?>):</small>
                              <div class="embed-responsive embed-responsive-16by9 rounded shadow-sm border" style="background:#000;">
                                <iframe class="embed-responsive-item" src="<?php echo $vtInfo['preview']; ?>" allowfullscreen></iframe>
                              </div>
                            </div>
                          <?php else: ?>
                            <div class="mt-2">
                              <small class="text-muted font-weight-bold d-block"><i class="fa fa-play-circle"></i> Live Video Preview:</small>
                              <video src="<?php echo bu_admin_media_url($tVid); ?>" controls class="bu-live-video-preview" style="max-height:130px;"></video>
                            </div>
                          <?php endif; ?>
                          <?php endif; ?>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>

                    <!-- 4 Side Feature Cards -->
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                      <div class="simple-card-title mb-0 border-0 p-0">
                        <i class="fa fa-th-list text-info"></i> Side Feature Highlight Cards (<?php echo count($vtCards); ?> Cards)
                      </div>
                      <button type="button" class="btn btn-sm btn-success" onclick="addVirtualTourCard()"><i class="fa fa-plus"></i> Add Feature Card</button>
                    </div>
                    <div id="vtCardsRowsContainer" class="row">
                      <?php foreach ($vtCards as $k => $vc): 
                        $cIcon = !empty($vc['icon']) ? $vc['icon'] : 'fa fa-check';
                      ?>
                      <div class="col-md-6 mb-3 vt-card-item">
                        <div class="simple-item-box" style="border-color:#36b9cc;">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.vt-card-item').remove();">&times; Remove</button>
                          <div class="d-flex align-items-center mb-2">
                            <span class="bu-icon-badge-preview mr-2"><i class="<?php echo htmlspecialchars($cIcon); ?>"></i></span>
                            <label class="text-info font-weight-bold mb-0">Feature Card #<?php echo $k + 1; ?></label>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-8 form-group mb-1">
                              <small class="text-muted">Card Title</small>
                              <input type="text" name="vt_card_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($vc['title'] ?? ''); ?>" placeholder="e.g. 32-Acre Green Campus">
                            </div>
                            <div class="col-md-4 form-group mb-1">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="vt_card_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($cIcon); ?>" placeholder="fa fa-tree">
                            </div>
                          </div>
                          
                          <div class="form-group mb-0">
                            <small class="text-muted">Short Description</small>
                            <textarea name="vt_card_desc[]" class="form-control form-control-sm" rows="2" placeholder="Feature card description..."><?php echo htmlspecialchars($vc['desc'] ?? ''); ?></textarea>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    
                    <div class="row mt-3">
                      <div class="col-md-6 form-group">
                        <label>Explore Button Text</label>
                        <input type="text" name="vt_cta_text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['cta_text'] ?? 'Explore Full Virtual Tour'); ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Explore Button Link</label>
                        <input type="text" name="vt_cta_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['cta_url'] ?? 'about.php#virtualTour'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 4. RESEARCH & INNOVATION -->
                  <?php if ($aryData['section_key'] == 'research_innovation'): 
                    $metrics = !empty($extra['metrics']) ? $extra['metrics'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title"><i class="fa fa-flask text-primary"></i> Research Section Main Photo &amp; Live Preview</div>
                    <div class="row">
                      <div class="col-md-7 form-group">
                        <label>Photo URL / Path</label>
                        <input type="text" name="media_url" class="form-control" value="<?php echo htmlspecialchars($aryData['media_url']); ?>">
                      </div>
                      <div class="col-md-5 form-group">
                        <label>Or Upload New Photo</label>
                        <input type="file" name="media_file" class="form-control-file">
                      </div>
                    </div>
                    <?php if (!empty($aryData['media_url'])): ?>
                      <div class="bu-live-thumb-wrap mb-3">
                        <img src="<?php echo bu_admin_media_url($aryData['media_url']); ?>" alt="Research" class="bu-live-thumb-img" style="width:70px; height:70px;">
                        <div>
                          <span class="font-weight-bold d-block"><?php echo basename($aryData['media_url']); ?></span>
                          <a href="<?php echo bu_admin_media_url($aryData['media_url']); ?>" target="_blank" class="small text-primary"><i class="fa fa-external-link"></i> Full View</a>
                        </div>
                      </div>
                    <?php endif; ?>

                    <div class="simple-card-title mt-4"><i class="fa fa-line-chart text-success"></i> Research Metrics (4 Counters)</div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $m = $metrics[$i] ?? ['target' => '', 'suffix' => '', 'prefix' => '', 'label' => ''];
                        $mVal = !empty($m['target']) ? $m['target'] : ($m['value'] ?? '');
                      ?>
                      <div class="col-md-3 col-sm-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Metric #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Target Number</small>
                            <input type="text" name="res_target[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($mVal); ?>" placeholder="e.g. 250">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Prefix (e.g. ₹)</small>
                            <input type="text" name="res_prefix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['prefix'] ?? ''); ?>" placeholder="e.g. ₹">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Suffix (e.g. + or Cr)</small>
                            <input type="text" name="res_suffix[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['suffix'] ?? ''); ?>" placeholder="e.g. +">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Metric Label</small>
                            <input type="text" name="res_label[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($m['label'] ?? ''); ?>" placeholder="e.g. PATENTS FILED">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>

                    <div class="simple-card-title mt-3"><i class="fa fa-bullhorn text-warning"></i> Featured Grant Highlight &amp; Button</div>
                    <div class="row">
                      <div class="col-md-3 form-group">
                        <label>Highlight Icon</label>
                        <input type="text" name="res_highlight_icon" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['highlight_icon'] ?? 'fa fa-flask'); ?>">
                      </div>
                      <div class="col-md-9 form-group">
                        <label>Highlight Card Text</label>
                        <input type="text" name="res_highlight" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['highlight_text'] ?? 'Featured: DST-funded sustainable energy research lab — ₹2.4 Cr grant.'); ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label>Explore Button Text</label>
                        <input type="text" name="res_btn_text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['button_text'] ?? 'EXPLORE RESEARCH →'); ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Explore Button Link</label>
                        <input type="text" name="res_btn_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['button_url'] ?? 'research.php'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 5. GLOBAL NETWORK & YOUTUBE LIVE -->
                  <?php if ($aryData['section_key'] == 'global_network'): 
                    $tagsList = !empty($extra['tags']) && is_array($extra['tags']) ? implode(', ', $extra['tags']) : 'Saudi Arabia (KSA), UAE, USA, UK, Germany, Canada, Singapore, Australia';
                    $ytIsLive = !empty($extra['yt_is_live']) ? 1 : 0;
                    $ytLiveUrl = $extra['yt_live_url'] ?? '';
                    $ytVideoUrl = $extra['yt_video_url'] ?? 'https://www.youtube.com/watch?v=zUsj1r_9wuM';
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title"><i class="fa fa-globe text-primary"></i> Partner Countries &amp; Universities Badges</div>
                    <div class="form-group">
                      <label>Partner Countries / Universities (Comma Separated)</label>
                      <textarea name="glob_tags" class="form-control" rows="2"><?php echo htmlspecialchars($tagsList); ?></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label>Apply Button Text</label>
                        <input type="text" name="glob_btn_text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['button_text'] ?? 'APPLY NOW →'); ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Apply Button Link</label>
                        <input type="text" name="glob_btn_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['button_url'] ?? 'enquiry.php'); ?>">
                      </div>
                    </div>

                    <div class="simple-card-title mt-4 text-danger"><i class="fa fa-youtube-play"></i> YouTube Live Telecast / Featured Broadcast</div>
                    <div class="form-group bg-white p-3 border rounded mb-3">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="ytLiveSwitch" name="yt_is_live" value="1" <?php echo ($ytIsLive == 1) ? 'checked' : ''; ?>>
                        <label class="custom-control-label font-weight-bold text-danger" for="ytLiveSwitch">
                          <span class="badge badge-danger mr-1">🔴 LIVE</span> Enable YouTube Live Telecast Mode (Streaming Live Now)
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="text-danger font-weight-bold">Live Telecast Video URL / ID</label>
                        <input type="text" name="yt_live_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ytLiveUrl); ?>" placeholder="https://www.youtube.com/watch?v=...">
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Regular / Featured Video URL</label>
                        <input type="text" name="yt_video_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($ytVideoUrl); ?>" placeholder="https://www.youtube.com/watch?v=zUsj1r_9wuM">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 6. CAMPUS INSTAGRAM REELS -->
                  <?php if ($aryData['section_key'] == 'insta_reels'): 
                    $reels = !empty($extra['reels']) ? $extra['reels'] : [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title"><i class="fa fa-instagram text-danger"></i> Campus Instagram Reels (4 Items)</div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $r = $reels[$i] ?? ['title' => '', 'insta_url' => ''];
                      ?>
                      <div class="col-md-6 mb-3">
                        <div class="simple-item-box">
                          <label class="text-primary font-weight-bold">Instagram Reel #<?php echo $i + 1; ?></label>
                          <div class="form-group mb-2">
                            <small class="text-muted">Reel Title / Activity Name</small>
                            <input type="text" name="reel_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($r['title']); ?>" placeholder="Title">
                          </div>
                          <div class="form-group mb-0">
                            <small class="text-muted">Instagram Reel URL</small>
                            <input type="text" name="reel_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($r['insta_url']); ?>" placeholder="https://www.instagram.com/reel/...">
                          </div>
                          <?php if (!empty($r['insta_url'])): ?>
                            <div class="mt-2">
                              <a href="<?php echo htmlspecialchars($r['insta_url']); ?>" target="_blank" class="small text-danger"><i class="fa fa-instagram"></i> Test Reel Link</a>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-6 form-group">
                        <label>Profile Button Text</label>
                        <input type="text" name="reels_btn_text" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['footer_button_text'] ?? 'View Instagram Page →'); ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Instagram Page Link</label>
                        <input type="text" name="reels_btn_url" class="form-control form-control-sm" value="<?php echo htmlspecialchars($extra['footer_button_url'] ?? 'https://www.instagram.com/bhabhauniversitybhopal/'); ?>">
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 7. DEGREE PROGRAMS (CONNECTED TO COURSE MASTER) -->
                  <?php if ($aryData['section_key'] == 'degree_programs'): 
                    // Query live active courses from course table for preview
                    $live_courses = [];
                    try {
                        $live_courses = $db->rawQuery("
                            SELECT c.id, c.course, c.program, c.details, p.program AS prog_name 
                            FROM course c 
                            LEFT JOIN program p ON c.program = p.id 
                            WHERE (c.status = 1 OR c.status IS NULL) 
                            ORDER BY c.id ASC
                        ");
                    } catch (\Throwable $e) {}
                  ?>
                  <div class="card mb-4" style="border: 2px solid #0A1B54; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(10,27,84,0.08);">
                    <div class="card-header text-white d-flex flex-wrap justify-content-between align-items-center" style="background-color: #0A1B54 !important; padding: 14px 20px;">
                      <div>
                        <h5 class="mb-1 text-white font-weight-bold"><i class="fa fa-graduation-cap text-warning mr-1"></i> Course Master Live Integration (Active)</h5>
                        <small style="color: #cbd5e1;">Courses on the Homepage are loaded automatically from the central Course Master. You do not need to create duplicate cards here.</small>
                      </div>
                      <div class="mt-2 mt-md-0">
                        <a href="course.php" class="btn btn-warning btn-sm font-weight-bold" target="_blank"><i class="fa fa-list"></i> Open Course Master</a>
                        <a href="course.php?action=add" class="btn btn-success btn-sm font-weight-bold ml-1" target="_blank"><i class="fa fa-plus"></i> Add New Course</a>
                      </div>
                    </div>
                    <div class="card-body bg-light" style="padding: 20px;">
                      <div class="alert alert-info mb-3" style="background-color: #e0f2fe; border-color: #bae6fd; color: #0369a1;">
                        <i class="fa fa-info-circle mr-1"></i> <strong>How it works:</strong> The homepage dynamically displays the top 8 courses from each academic level (Undergraduate, Postgraduate, Diploma, etc.) directly from your <code>course</code> database table. To add, edit details, or change eligibility, use the <strong>Course Master</strong> menu.
                      </div>
                      <div class="table-responsive bg-white rounded border">
                        <table class="table table-sm table-hover mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th style="width: 70px;">ID</th>
                              <th>Course Name</th>
                              <th>Level / Program</th>
                              <th>Duration / Eligibility</th>
                              <th class="text-right" style="width: 170px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($live_courses)): 
                              foreach (array_slice($live_courses, 0, 15) as $lc): 
                                $det = strip_tags($lc['details'] ?? '');
                                if (strlen($det) > 65) $det = substr($det, 0, 62) . '...';
                            ?>
                            <tr>
                              <td><span class="badge badge-secondary">#<?php echo $lc['id']; ?></span></td>
                              <td><strong class="text-primary"><?php echo htmlspecialchars($lc['course']); ?></strong></td>
                              <td><span class="badge badge-info"><?php echo htmlspecialchars($lc['prog_name'] ?: 'Undergraduate'); ?></span></td>
                              <td><small class="text-muted"><?php echo htmlspecialchars($det ?: 'Standard Criteria'); ?></small></td>
                              <td class="text-right">
                                <a href="course.php?id=<?php echo $lc['id']; ?>&action=edit" target="_blank" class="btn btn-xs btn-outline-primary"><i class="fa fa-pencil"></i> Edit Course</a>
                              </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr><td colspan="5" class="text-center py-3 text-muted">No courses found in database table.</td></tr>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                      <?php if (count($live_courses) > 15): ?>
                        <div class="text-center mt-3">
                          <small class="text-muted">Showing 15 of <?php echo count($live_courses); ?> active courses. <a href="course.php" target="_blank" class="font-weight-bold">View and manage all courses in Course Master →</a></small>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 8. CAMPUS FACILITIES & INFRASTRUCTURE GRID -->
                  <?php if ($aryData['section_key'] == 'infrastructure_grid'): 
                    $facilities = $extra['facilities'] ?? [];
                  ?>
                  <div class="simple-card-group">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="simple-card-title mb-0">
                        <i class="fa fa-building text-primary"></i> Campus Facilities Cards &amp; Interactive Popups
                      </div>
                      <button type="button" class="btn btn-sm btn-success" onclick="addInfraFacilityRow()"><i class="fa fa-plus"></i> Add New Facility</button>
                    </div>
                    <div id="infraFacRowsContainer" class="row">
                      <?php 
                      $f_idx = 0;
                      foreach ($facilities as $fKey => $f): 
                        $f_idx++;
                        $fImg = $f['image'] ?? '';
                      ?>
                      <div class="col-md-6 mb-3 infra-fac-item">
                        <div class="simple-item-box">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.infra-fac-item').remove();">&times; Remove</button>
                          <label class="text-primary font-weight-bold">Facility #<?php echo $f_idx; ?>: <?php echo htmlspecialchars($f['title'] ?? ''); ?></label>
                          <input type="hidden" name="fac_key[]" value="<?php echo htmlspecialchars($fKey); ?>">
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Facility Title</small>
                              <input type="text" name="fac_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($f['title'] ?? ''); ?>" placeholder="Title">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Badge Category</small>
                              <input type="text" name="fac_badge[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['badge'] ?? ''); ?>" placeholder="e.g. Digital Learning">
                            </div>
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Description (Popup Details)</small>
                            <textarea name="fac_desc[]" class="form-control form-control-sm" rows="2"><?php echo htmlspecialchars($f['desc'] ?? ''); ?></textarea>
                          </div>
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Image Path</small>
                              <input type="text" name="fac_image[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($fImg); ?>">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Or Upload New Image</small>
                              <input type="file" name="fac_file[]" class="form-control-file">
                            </div>
                          </div>
                          <?php if (!empty($fImg)): ?>
                            <div class="bu-live-thumb-wrap mb-2">
                              <img src="<?php echo bu_admin_media_url($fImg); ?>" alt="Facility" class="bu-live-thumb-img">
                              <span class="small font-weight-bold text-muted"><?php echo basename($fImg); ?></span>
                            </div>
                          <?php endif; ?>
                          <div class="form-group mb-0">
                            <small class="text-muted">Detailed Page Link</small>
                            <input type="text" name="fac_link[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($f['link'] ?? 'infrastructure.php'); ?>">
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 9. CAMPUS LIFE (4 HIGHLIGHT CARDS) -->
                  <?php if ($aryData['section_key'] == 'campus_life'): 
                    $cl_cards = $extra['cards'] ?? [];
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-leaf text-success"></i> Campus Life &amp; Environment (4 Highlight Cards)
                    </div>
                    <div class="row">
                      <?php for ($i = 0; $i < 4; $i++): 
                        $c = $cl_cards[$i] ?? ['title' => '', 'badge' => '', 'icon' => 'fa fa-book', 'desc' => '', 'image' => '', 'link' => ''];
                        $cImg = $c['image'] ?? '';
                        $cIcon = !empty($c['icon']) ? $c['icon'] : 'fa fa-star';
                      ?>
                      <div class="col-md-6 mb-3">
                        <div class="simple-item-box">
                          <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="bu-icon-badge-preview mr-2"><i class="<?php echo htmlspecialchars($cIcon); ?>"></i></span>
                            <label class="text-primary font-weight-bold mb-0">Highlight Card #<?php echo $i + 1; ?></label>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-6 form-group mb-1">
                              <small class="text-muted">Card Title</small>
                              <input type="text" name="cl_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($c['title']); ?>" placeholder="Title">
                            </div>
                            <div class="col-md-3 form-group mb-1">
                              <small class="text-muted">Badge</small>
                              <input type="text" name="cl_badge[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['badge']); ?>" placeholder="Badge">
                            </div>
                            <div class="col-md-3 form-group mb-1">
                              <small class="text-muted">Icon Class</small>
                              <input type="text" name="cl_icon[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($cIcon); ?>" placeholder="fa fa-book">
                            </div>
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Short Description</small>
                            <input type="text" name="cl_desc[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['desc']); ?>" placeholder="Description">
                          </div>
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Image Path</small>
                              <input type="text" name="cl_image[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($cImg); ?>">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Or Upload Image</small>
                              <input type="file" name="cl_file[]" class="form-control-file">
                            </div>
                          </div>
                          <?php if (!empty($cImg)): ?>
                            <div class="bu-live-thumb-wrap mb-2">
                              <img src="<?php echo bu_admin_media_url($cImg); ?>" alt="Card" class="bu-live-thumb-img">
                              <span class="small font-weight-bold text-muted"><?php echo basename($cImg); ?></span>
                            </div>
                          <?php endif; ?>
                          <div class="form-group mb-0">
                            <small class="text-muted">Link / URL</small>
                            <input type="text" name="cl_link[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($c['link']); ?>" placeholder="infrastructure.php">
                          </div>
                        </div>
                      </div>
                      <?php endfor; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 10. HALL OF FAME & PLACEMENT HIGHLIGHTS SLIDER -->
                  <?php if ($aryData['section_key'] == 'hall_of_fame'): 
                    $posters = $extra['posters'] ?? [];
                  ?>
                  <div class="simple-card-group">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="simple-card-title mb-0">
                        <i class="fa fa-trophy text-warning"></i> Achiever Posters / Hall of Fame Slider Items
                      </div>
                      <button type="button" class="btn btn-sm btn-success" onclick="addFamePosterRow()"><i class="fa fa-plus"></i> Add New Poster</button>
                    </div>
                    <div id="famePostersContainer" class="row">
                      <?php foreach ($posters as $k => $p): 
                        $pImg = $p['src'] ?? '';
                      ?>
                      <div class="col-md-6 mb-3 fame-poster-item">
                        <div class="simple-item-box">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.fame-poster-item').remove();">&times; Remove</button>
                          <label class="text-primary font-weight-bold">Poster #<?php echo $k + 1; ?>: <?php echo htmlspecialchars($p['title'] ?? ''); ?></label>
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Achiever Name &amp; Package Title</small>
                              <input type="text" name="fame_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($p['title'] ?? ''); ?>" placeholder="Mr. Anurag Kumar - ₹60.0 LPA">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Category Pill Badge</small>
                              <input type="text" name="fame_cat[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['category'] ?? ''); ?>" placeholder="Highest Placement (₹60 LPA)">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Poster Image Path</small>
                              <input type="text" name="fame_src[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($pImg); ?>">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Or Upload Poster</small>
                              <input type="file" name="fame_file[]" class="form-control-file">
                            </div>
                          </div>
                          <?php if (!empty($pImg)): ?>
                            <div class="bu-live-thumb-wrap mb-2">
                              <img src="<?php echo bu_admin_media_url($pImg); ?>" alt="Poster" class="bu-live-thumb-img" style="height:65px; width:65px;">
                              <span class="small font-weight-bold text-muted"><?php echo basename($pImg); ?></span>
                            </div>
                          <?php endif; ?>
                          <div class="form-group mb-0">
                            <small class="text-muted">Image Alt Text (SEO)</small>
                            <input type="text" name="fame_alt[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($p['alt'] ?? ''); ?>" placeholder="Alt text">
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 11. STATUTORY APPROVALS & ACCREDITATIONS -->
                  <?php if ($aryData['section_key'] == 'accreditations'): 
                    $acc_items = $extra['items'] ?? [];
                  ?>
                  <div class="simple-card-group">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="simple-card-title mb-0">
                        <i class="fa fa-certificate text-primary"></i> Statutory Approvals &amp; Accreditations Logos
                      </div>
                      <button type="button" class="btn btn-sm btn-success" onclick="addAccreditationRow()"><i class="fa fa-plus"></i> Add New Approval</button>
                    </div>
                    <div id="accredRowsContainer" class="row">
                      <?php foreach ($acc_items as $k => $item): 
                        $aImg = $item['img'] ?? '';
                      ?>
                      <div class="col-md-4 col-sm-6 mb-3 accred-item">
                        <div class="simple-item-box">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.accred-item').remove();">&times; Remove</button>
                          <label class="text-primary font-weight-bold">Council #<?php echo $k + 1; ?>: <?php echo htmlspecialchars($item['name'] ?? ''); ?></label>
                          <div class="form-group mb-1">
                            <small class="text-muted">Council Name (e.g. UGC, AICTE, PCI)</small>
                            <input type="text" name="acc_name[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($item['name'] ?? ''); ?>" placeholder="UGC">
                          </div>
                          <div class="form-group mb-1">
                            <small class="text-muted">Status / Recognition Text</small>
                            <input type="text" name="acc_desc[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($item['desc'] ?? ''); ?>" placeholder="Section 2(f) / Approved">
                          </div>
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Logo Path</small>
                              <input type="text" name="acc_img[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($aImg); ?>">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Or Upload Logo</small>
                              <input type="file" name="acc_file[]" class="form-control-file">
                            </div>
                          </div>
                          <?php if (!empty($aImg)): ?>
                            <div class="bu-live-thumb-wrap mb-2">
                              <img src="<?php echo bu_admin_media_url($aImg); ?>" alt="Logo" class="bu-live-thumb-img" style="height:40px; width:50px; object-fit:contain;">
                              <span class="small font-weight-bold text-muted"><?php echo basename($aImg); ?></span>
                            </div>
                          <?php endif; ?>
                          <div class="form-group mb-0">
                            <small class="text-muted">Link / Target Page</small>
                            <input type="text" name="acc_link[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($item['link'] ?? 'approvals.php'); ?>" placeholder="approvals.php">
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 12. JOURNEY STARTS NOW CTA BANNER -->
                  <?php if ($aryData['section_key'] == 'cta_journey'): ?>
                  <div class="simple-card-group" style="background: #fffdf5; border-color: #ffe8a1;">
                    <div class="simple-card-title" style="color: #946c00; border-bottom-color: #ffe8a1;">
                      <i class="fa fa-bullhorn text-warning"></i> Admissions CTA Banner &amp; Action Buttons
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Button 1: Apply Online</label>
                        <div class="input-group mb-2">
                          <input type="text" name="cta_btn1_text" class="form-control" value="<?php echo htmlspecialchars($extra['btn1_text'] ?? 'APPLY NOW'); ?>" placeholder="Button Text">
                          <input type="text" name="cta_btn1_url" class="form-control" value="<?php echo htmlspecialchars($extra['btn1_url'] ?? 'enquiry.php'); ?>" placeholder="URL / Link">
                        </div>
                      </div>
                      <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Button 2: Download Prospectus</label>
                        <div class="input-group mb-2">
                          <input type="text" name="cta_btn2_text" class="form-control" value="<?php echo htmlspecialchars($extra['btn2_text'] ?? 'DOWNLOAD PROSPECTUS'); ?>" placeholder="Button Text">
                          <input type="text" name="cta_btn2_url" class="form-control" value="<?php echo htmlspecialchars($extra['btn2_url'] ?? ''); ?>" placeholder="PDF / Drive Link">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label class="font-weight-bold">Button 3: Schedule Call</label>
                        <div class="input-group mb-2">
                          <input type="text" name="cta_btn3_text" class="form-control" value="<?php echo htmlspecialchars($extra['btn3_text'] ?? 'SCHEDULE CALL'); ?>" placeholder="Button Text">
                          <input type="text" name="cta_btn3_phone" class="form-control" value="<?php echo htmlspecialchars($extra['btn3_phone'] ?? '07554246498'); ?>" placeholder="Phone Number">
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- 13. OUR ACHIEVEMENTS & NEWS TICKER -->
                  <?php if ($aryData['section_key'] == 'achievements_ticker'): 
                    $tSource = $extra['source'] ?? 'news';
                    $ach_items = $extra['items'] ?? [];
                    // Fetch current live news for preview from news table
                    $db->orderBy('news_date', 'desc');
                    $db->orderBy('id', 'desc');
                    $liveNewsList = $db->get('news', 12);
                  ?>
                  <div class="simple-card-group">
                    <div class="simple-card-title">
                      <i class="fa fa-bullhorn text-warning"></i> Marquee Ticker Source &amp; Configuration
                    </div>
                    
                    <div class="form-group bg-white p-3 border rounded mb-3">
                      <label class="font-weight-bold text-primary mb-2">Ticker Data Source:</label>
                      <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="srcNews" name="ticker_source" value="news" class="custom-control-input" <?php echo ($tSource === 'news') ? 'checked' : ''; ?> onchange="toggleTickerMode('news')">
                        <label class="custom-control-label font-weight-bold" for="srcNews">
                          <i class="fa fa-newspaper-o text-success mr-1"></i> Live News Coverage from Database (Direct Clickable links redirecting to <code>news.php</code>)
                        </label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="srcCustom" name="ticker_source" value="custom" class="custom-control-input" <?php echo ($tSource === 'custom') ? 'checked' : ''; ?> onchange="toggleTickerMode('custom')">
                        <label class="custom-control-label font-weight-bold" for="srcCustom">
                          <i class="fa fa-pencil-square-o text-info mr-1"></i> Custom Ticker Headlines (Enter custom titles and optional target links)
                        </label>
                      </div>
                    </div>

                    <!-- Live News Preview Box -->
                    <div id="liveNewsPreviewBox" class="p-3 bg-light border rounded mb-3" style="<?php echo ($tSource === 'news') ? '' : 'display:none;'; ?>">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-weight-bold text-success"><i class="fa fa-check-circle"></i> Active News Coverage Articles in Ticker (<?php echo count($liveNewsList); ?> Items):</span>
                        <a href="news.php" target="_blank" class="btn btn-xs btn-primary"><i class="fa fa-external-link"></i> Manage News Articles in Admin</a>
                      </div>
                      <ul class="mb-0 pl-3">
                        <?php foreach ($liveNewsList as $ln): ?>
                          <li class="small mb-1">
                            <strong><?php echo htmlspecialchars($ln['title']); ?></strong>
                            <span class="text-muted">&rarr; links to <code>news.php?id=<?php echo $ln['id']; ?></code> (<?php echo !empty($ln['news_date']) ? $ln['news_date'] : ''; ?>)</span>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>

                    <!-- Custom Items Container -->
                    <div id="customTickerContainer" style="<?php echo ($tSource === 'custom') ? '' : 'display:none;'; ?>">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="font-weight-bold text-muted">Custom Ticker Items:</div>
                        <button type="button" class="btn btn-sm btn-success" onclick="addAchievementRow()"><i class="fa fa-plus"></i> Add Ticker Item</button>
                      </div>
                      <div id="achItemsContainer">
                        <?php foreach ($ach_items as $k => $achItem): 
                          $aTitle = is_array($achItem) ? ($achItem['title'] ?? '') : $achItem;
                          $aUrl = is_array($achItem) ? ($achItem['url'] ?? '') : '';
                        ?>
                        <div class="simple-item-box mb-2 ach-item-row" style="border-color:#ffc107;">
                          <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.ach-item-row').remove();">&times; Remove</button>
                          <div class="row">
                            <div class="col-md-7 form-group mb-1">
                              <small class="text-muted">Headline Title</small>
                              <input type="text" name="ach_item_title[]" class="form-control form-control-sm font-weight-bold" value="<?php echo htmlspecialchars($aTitle); ?>" placeholder="e.g. Admissions open 2026-27">
                            </div>
                            <div class="col-md-5 form-group mb-1">
                              <small class="text-muted">Target Redirect URL (Optional)</small>
                              <input type="text" name="ach_item_url[]" class="form-control form-control-sm" value="<?php echo htmlspecialchars($aUrl); ?>" placeholder="e.g. news.php or online-admission.php">
                            </div>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <!-- Status Checkbox -->
                  <div class="form-group mt-3">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="statusCheck" name="status" value="1" <?php echo ($aryData['status'] == 1) ? 'checked' : ''; ?>>
                      <label class="custom-control-label" for="statusCheck"><strong>Section Active (Visible on Home Page)</strong></label>
                    </div>
                    <small class="help-tip">Uncheck to temporarily hide this section from the Home Page without deleting it.</small>
                  </div>
                  
                  <hr>
                  <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-save"></i> Save Changes</button>
                  <a href="<?php echo PAGE; ?>" class="btn btn-warning waves-effect waves-light">Cancel</a>
                </form>
                
              </div>
            </div>
          </div>
        </div>
        
        <?php else: ?>
        <!-- LIST VIEW -->
        <div class="row">
          <div class="col-12">
            <div class="card m-b-20">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <h4 class="mt-0 header-title"><i class="fa fa-list text-primary"></i> Homepage Sections List</h4>
                    <p class="text-muted mb-0">Manage and update all major interactive, branding, and content sections of the Bhabha University Home Page.</p>
                  </div>
                  <div>
                    <a href="<?php echo PAGE; ?>?action=sync_db" class="btn btn-sm btn-outline-primary" title="Check &amp; Sync Database Table"><i class="fa fa-database"></i> Sync DB Schema</a>
                    <a href="fix_homepage_sections_db.php" class="btn btn-sm btn-outline-info ml-1" title="Run Database Diagnostic Wizard"><i class="fa fa-wrench"></i> Diagnostics</a>
                  </div>
                </div>
                
                <div style="margin-bottom:15px;"> <?php echo msg($stat); ?></div>
                
                <div class="table-responsive">
                  <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th style="width:50px;">#</th>
                        <th>Section Name</th>
                        <th>Section Key</th>
                        <th>Heading / Title</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:140px;">Last Updated</th>
                        <th style="width:100px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sections = [];
                      $queryErr = null;
                      try {
                          $db->orderBy('id', 'ASC');
                          $sections = $db->get(DBTAB);
                      } catch (\Throwable $e) {
                          $queryErr = $e->getMessage();
                          try {
                              bu_ensure_homepage_sections_schema($db);
                              $db->orderBy('id', 'ASC');
                              $sections = $db->get(DBTAB);
                              $queryErr = null;
                          } catch (\Throwable $e2) {
                              $queryErr = $e2->getMessage();
                          }
                      }
                      if ($queryErr) {
                          echo '<tr><td colspan="7" class="text-center text-danger font-weight-bold p-4"><i class="fa fa-exclamation-triangle"></i> Database table error: ' . htmlspecialchars($queryErr) . '<br><a href="'.PAGE.'?action=sync_db" class="btn btn-sm btn-primary mt-2"><i class="fa fa-refresh"></i> Run Auto-Repair Now</a></td></tr>';
                      } elseif (is_array($sections) && count($sections) > 0) {
                          $i = 1;
                          foreach ($sections as $sec) {
                              $statusHtml = ($sec['status'] == 1) 
                                  ? '<a href="'.PAGE.'?id='.$sec['id'].'&action=toggle_status" title="Click to Deactivate"><span class="status-badge-active">Active</span></a>'
                                  : '<a href="'.PAGE.'?id='.$sec['id'].'&action=toggle_status" title="Click to Activate"><span class="status-badge-inactive">Inactive</span></a>';
                              $cleanHeading = strip_tags($sec['heading']);
                              if (strlen($cleanHeading) > 60) {
                                  $cleanHeading = substr($cleanHeading, 0, 57) . '...';
                              }
                              $secIcons = [
                                  'hero_video'          => 'fa fa-video-camera',
                                  'chancellor_welcome'  => 'fa fa-user-circle',
                                  'why_bhabha'          => 'fa fa-graduation-cap',
                                  'virtual_tour'        => 'fa fa-street-view',
                                  'research_innovation' => 'fa fa-flask',
                                  'global_network'      => 'fa fa-globe',
                                  'insta_reels'         => 'fa fa-instagram',
                                  'degree_programs'     => 'fa fa-th-large',
                                  'infrastructure_grid' => 'fa fa-building',
                                  'campus_life'         => 'fa fa-leaf',
                                  'hall_of_fame'        => 'fa fa-trophy',
                                  'accreditations'      => 'fa fa-certificate',
                                  'cta_journey'         => 'fa fa-bullhorn',
                                  'achievements_ticker' => 'fa fa-line-chart'
                              ];
                              $iconClass = $secIcons[$sec['section_key']] ?? 'fa fa-cube';
                      ?>
                      <tr>
                        <td><strong><?php echo $i++; ?></strong></td>
                        <td>
                          <i class="<?php echo $iconClass; ?> text-primary mr-1"></i> <strong><?php echo htmlspecialchars($sec['section_name']); ?></strong>
                        </td>
                        <td>
                          <span class="section-badge-key"><?php echo htmlspecialchars($sec['section_key']); ?></span>
                        </td>
                        <td>
                          <?php echo htmlspecialchars($cleanHeading ?: $sec['title']); ?>
                        </td>
                        <td>
                          <?php echo $statusHtml; ?>
                        </td>
                        <td>
                          <small class="text-muted"><?php echo date('d M Y, h:i A', strtotime($sec['updated_at'])); ?></small>
                        </td>
                        <td>
                          <a href="<?php echo PAGE; ?>?id=<?php echo $sec['id']; ?>&action=edit" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                        </td>
                      </tr>
                      <?php 
                          }
                      } else {
                      ?>
                      <tr>
                        <td colspan="7" class="text-center">No sections found.</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        
      </div>
    </div>
    <?php include_once("inc.footer.php"); ?>
  </div>
</div>

<script>
function addWhyBhabhaRow() {
    const container = document.getElementById('whyBhabhaRowsContainer');
    const div = document.createElement('div');
    div.className = 'col-md-6 mb-3 why-feat-item';
    div.innerHTML = `
      <div class="simple-item-box" style="border-color:#28a745;">
        <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.why-feat-item').remove();">&times; Remove</button>
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="bu-icon-badge-preview mr-2"><i class="fa fa-certificate"></i></span>
          <label class="text-success font-weight-bold mb-0">New Feature Point</label>
        </div>
        <div class="row">
          <div class="col-md-8 form-group mb-1">
            <small class="text-muted">Point Title</small>
            <input type="text" name="why_title[]" class="form-control form-control-sm font-weight-bold" placeholder="e.g. Industry Collaborations">
          </div>
          <div class="col-md-4 form-group mb-1">
            <small class="text-muted">FontAwesome Icon</small>
            <input type="text" name="why_icon[]" class="form-control form-control-sm" value="fa fa-certificate" placeholder="fa fa-certificate">
          </div>
        </div>
        <div class="form-group mb-1">
          <small class="text-muted">Description Text</small>
          <textarea name="why_desc[]" class="form-control form-control-sm" rows="2" placeholder="Point description..."></textarea>
        </div>
        <div class="form-group mb-0">
          <small class="text-muted">Explore Details Link / URL</small>
          <input type="text" name="why_url[]" class="form-control form-control-sm" value="about.php" placeholder="about.php">
        </div>
      </div>
    `;
    container.appendChild(div);
}

function addInfraFacilityRow() {
    const container = document.getElementById('infraFacRowsContainer');
    const div = document.createElement('div');
    div.className = 'col-md-6 mb-3 infra-fac-item';
    div.innerHTML = `
      <div class="simple-item-box" style="border-color:#28a745;">
        <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.infra-fac-item').remove();">&times; Remove</button>
        <label class="text-success font-weight-bold">New Facility</label>
        <input type="hidden" name="fac_key[]" value="">
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Facility Title</small>
            <input type="text" name="fac_title[]" class="form-control form-control-sm font-weight-bold" placeholder="e.g. Robotics & AI Lab">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Badge Category</small>
            <input type="text" name="fac_badge[]" class="form-control form-control-sm" placeholder="e.g. Innovation Hub">
          </div>
        </div>
        <div class="form-group mb-1">
          <small class="text-muted">Description (Popup Details)</small>
          <textarea name="fac_desc[]" class="form-control form-control-sm" rows="2" placeholder="Facility description..."></textarea>
        </div>
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Image URL / Path</small>
            <input type="text" name="fac_image[]" class="form-control form-control-sm" placeholder="upload/infrastructure/...">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Or Upload Image</small>
            <input type="file" name="fac_file[]" class="form-control-file">
          </div>
        </div>
        <div class="form-group mb-0">
          <small class="text-muted">Detailed Page Link</small>
          <input type="text" name="fac_link[]" class="form-control form-control-sm" value="infrastructure.php" placeholder="infrastructure.php">
        </div>
      </div>
    `;
    container.appendChild(div);
}

function addFamePosterRow() {
    const container = document.getElementById('famePostersContainer');
    const div = document.createElement('div');
    div.className = 'col-md-6 mb-3 fame-poster-item';
    div.innerHTML = `
      <div class="simple-item-box" style="border-color:#28a745;">
        <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.fame-poster-item').remove();">&times; Remove</button>
        <label class="text-success font-weight-bold">New Achiever Poster</label>
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Achiever Name &amp; Package Title</small>
            <input type="text" name="fame_title[]" class="form-control form-control-sm font-weight-bold" placeholder="Mr. John Doe - ₹25 LPA at Amazon">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Category Pill Badge</small>
            <input type="text" name="fame_cat[]" class="form-control form-control-sm" placeholder="MNC Placement (₹25 LPA)">
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Poster Image Path</small>
            <input type="text" name="fame_src[]" class="form-control form-control-sm" placeholder="upload/media/...">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Or Upload Poster</small>
            <input type="file" name="fame_file[]" class="form-control-file">
          </div>
        </div>
        <div class="form-group mb-0">
          <small class="text-muted">Image Alt Text (SEO)</small>
          <input type="text" name="fame_alt[]" class="form-control form-control-sm" placeholder="Achiever placement poster">
        </div>
      </div>
    `;
    container.appendChild(div);
}

function addAccreditationRow() {
    const container = document.getElementById('accredRowsContainer');
    const div = document.createElement('div');
    div.className = 'col-md-4 col-sm-6 mb-3 accred-item';
    div.innerHTML = `
      <div class="simple-item-box" style="border-color:#28a745;">
        <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.accred-item').remove();">&times; Remove</button>
        <label class="text-success font-weight-bold">New Council</label>
        <div class="form-group mb-1">
          <small class="text-muted">Council Name</small>
          <input type="text" name="acc_name[]" class="form-control form-control-sm font-weight-bold" placeholder="e.g. NBA / NAAC">
        </div>
        <div class="form-group mb-1">
          <small class="text-muted">Status / Recognition Text</small>
          <input type="text" name="acc_desc[]" class="form-control form-control-sm" value="Approved" placeholder="Approved / Accredited">
        </div>
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Logo Path</small>
            <input type="text" name="acc_img[]" class="form-control form-control-sm" placeholder="images/... or upload/media/...">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Or Upload Logo</small>
            <input type="file" name="acc_file[]" class="form-control-file">
          </div>
        </div>
        <div class="form-group mb-0">
          <small class="text-muted">Link / Target Page</small>
          <input type="text" name="acc_link[]" class="form-control form-control-sm" value="approvals.php" placeholder="approvals.php">
        </div>
      </div>
    `;
    container.appendChild(div);
}

function toggleTickerMode(mode) {
    const liveBox = document.getElementById('liveNewsPreviewBox');
    const customBox = document.getElementById('customTickerContainer');
    if (mode === 'news') {
        if (liveBox) liveBox.style.display = 'block';
        if (customBox) customBox.style.display = 'none';
    } else {
        if (liveBox) liveBox.style.display = 'none';
        if (customBox) customBox.style.display = 'block';
    }
}

function addAchievementRow() {
    const container = document.getElementById('achItemsContainer');
    const count = container.querySelectorAll('.ach-item-row').length + 1;
    const div = document.createElement('div');
    div.className = 'simple-item-box mb-2 ach-item-row';
    div.style.borderColor = '#ffc107';
    div.innerHTML = `
      <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.ach-item-row').remove();">&times; Remove</button>
      <div class="row">
        <div class="col-md-7 form-group mb-1">
          <small class="text-muted">Headline Title #${count}</small>
          <input type="text" name="ach_item_title[]" class="form-control form-control-sm font-weight-bold" placeholder="e.g. Entrance Examination Results Announced">
        </div>
        <div class="col-md-5 form-group mb-1">
          <small class="text-muted">Target Redirect URL</small>
          <input type="text" name="ach_item_url[]" class="form-control form-control-sm" placeholder="e.g. news.php or result.php">
        </div>
      </div>
    `;
    container.appendChild(div);
}

function addVirtualTourTab() {
    const container = document.getElementById('vtTabsRowsContainer');
    const count = container.querySelectorAll('.vt-tab-item').length + 1;
    const div = document.createElement('div');
    div.className = 'col-md-6 mb-3 vt-tab-item';
    div.innerHTML = `
      <div class="simple-item-box" style="border-color:#4e73df;">
        <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.vt-tab-item').remove();">&times; Remove</button>
        <div class="d-flex align-items-center mb-2">
          <span class="bu-icon-badge-preview mr-2"><i class="fa fa-film"></i></span>
          <label class="text-primary font-weight-bold mb-0">Video Tab #${count}</label>
        </div>
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Tab Label</small>
            <input type="text" name="vt_tab_label[]" class="form-control form-control-sm font-weight-bold" placeholder="e.g. Research Labs View">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Icon Class</small>
            <input type="text" name="vt_tab_icon[]" class="form-control form-control-sm" value="fa fa-film" placeholder="fa fa-film">
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 form-group mb-1">
            <small class="text-muted">Video URL (Vimeo / YouTube / .mp4)</small>
            <input type="text" name="vt_tab_video[]" class="form-control form-control-sm" placeholder="https://vimeo.com/... or https://youtu.be/... or upload/video/...">
          </div>
          <div class="col-md-5 form-group mb-1">
            <small class="text-muted">Or Upload Video (.mp4)</small>
            <input type="file" name="vt_tab_file[]" class="form-control-file">
          </div>
        </div>
        <small class="text-muted d-block mb-1"><i class="fa fa-info-circle text-info"></i> Supports Vimeo, YouTube link or .mp4</small>
      </div>
    `;
    container.appendChild(div);
}

function addVirtualTourCard() {
    const container = document.getElementById('vtCardsRowsContainer');
    const count = container.querySelectorAll('.vt-card-item').length + 1;
    const div = document.createElement('div');
    div.className = 'col-md-6 mb-3 vt-card-item';
    div.innerHTML = `
      <div class="simple-item-box" style="border-color:#36b9cc;">
        <button type="button" class="btn btn-xs btn-danger btn-delete-row" onclick="this.closest('.vt-card-item').remove();">&times; Remove</button>
        <div class="d-flex align-items-center mb-2">
          <span class="bu-icon-badge-preview mr-2"><i class="fa fa-check"></i></span>
          <label class="text-info font-weight-bold mb-0">Feature Card #${count}</label>
        </div>
        <div class="row">
          <div class="col-md-8 form-group mb-1">
            <small class="text-muted">Card Title</small>
            <input type="text" name="vt_card_title[]" class="form-control form-control-sm font-weight-bold" placeholder="e.g. Advanced Sports Complex">
          </div>
          <div class="col-md-4 form-group mb-1">
            <small class="text-muted">Icon Class</small>
            <input type="text" name="vt_card_icon[]" class="form-control form-control-sm" value="fa fa-check" placeholder="fa fa-check">
          </div>
        </div>
        <div class="form-group mb-0">
          <small class="text-muted">Short Description</small>
          <textarea name="vt_card_desc[]" class="form-control form-control-sm" rows="2" placeholder="Feature card description..."></textarea>
        </div>
      </div>
    `;
    container.appendChild(div);
}
function toggleChancellorMediaType(type) {
    var vPanel = document.getElementById('chanc_video_panel');
    var iPanel = document.getElementById('chanc_image_panel');
    var radV = document.getElementById('mtype_vid');
    var radI = document.getElementById('mtype_img');
    var lblV = document.getElementById('lbl_mtype_vid');
    var lblI = document.getElementById('lbl_mtype_img');
    if (!vPanel || !iPanel) return;
    if (type === 'image') {
        vPanel.style.display = 'none';
        iPanel.style.display = 'block';
        if (radI) radI.checked = true;
        if (radV) radV.checked = false;
        if (lblI) { lblI.className = 'btn btn-sm btn-success active font-weight-bold'; }
        if (lblV) { lblV.className = 'btn btn-sm btn-outline-primary'; }
    } else {
        vPanel.style.display = 'block';
        iPanel.style.display = 'none';
        if (radV) radV.checked = true;
        if (radI) radI.checked = false;
        if (lblV) { lblV.className = 'btn btn-sm btn-primary active font-weight-bold'; }
        if (lblI) { lblI.className = 'btn btn-sm btn-outline-success'; }
    }
}
</script>

<?php include_once("inc.footer.js.php"); ?>
</body>
</html>
