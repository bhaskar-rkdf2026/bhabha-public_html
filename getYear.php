<?php
include_once("config.php");
$branch = isset($_POST["branch"]) ? $_POST["branch"] : '';
echo '<option value="">-- Select Sem / Year --</option>';
if (!empty($branch)) {
    $db->where('branch', $branch);
    $syllabus = $db->get('syllabus');
    if (is_array($syllabus) && count($syllabus) > 0) {
        foreach ($syllabus as $isyllabus) {
            echo '<option value="' . htmlspecialchars($isyllabus['id']) . '">' . htmlspecialchars($isyllabus['heading']) . '</option>';
        }
    }
}
?>