<?php
include_once("config.php");
$course = isset($_POST["course"]) ? $_POST["course"] : '';
echo '<option value="">-- Select Branch --</option>';
if (!empty($course)) {
    $db->where('course', $course);
    $db->where('status', 1);
    $branch = $db->get('branch');
    if (is_array($branch) && count($branch) > 0) {
        foreach ($branch as $ibranch) {
            echo '<option value="' . htmlspecialchars($ibranch['id']) . '">' . htmlspecialchars($ibranch['branch']) . '</option>';
        }
    }
}
?>