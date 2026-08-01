<?php
$files = ['alumni.php', 'contact.php', 'enquiry.php', 'enquiry1.php', 'grievance.php', 'online-admission.php'];
foreach($files as $f) {
  if(!file_exists($f)) {
     echo "\n[ERROR] File not found: $f\n";
     continue;
  }
  $c = file_get_contents($f);
  preg_match_all('/\$_POST\[[\'"]([^\'"]+)[\'"]\]/', $c, $m1);
  $post = array_unique($m1[1]);
  preg_match_all('/name=[\'"]([^\'"]+)[\'"]/', $c, $m2);
  $html = array_unique($m2[1]);
  
  $missing = array_diff($post, $html);
  $extra = array_diff($html, $post);
  echo "\nChecking $f...\n";
  if(empty($missing) && empty($extra)) echo "  [OK] Matched\n";
  if(!empty($missing)) echo "  [!] Missing in HTML: " . implode(', ', $missing) . "\n";
  if(!empty($extra)) echo "  [?] Extra in HTML: " . implode(', ', $extra) . "\n";
}
?>
