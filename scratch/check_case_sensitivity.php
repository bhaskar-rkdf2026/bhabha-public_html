<?php
// Script to check exact filesystem case matching for all require/include statements

$root = realpath(__DIR__ . '/../');
$phpFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));

$checked = 0;
$mismatches = [];

foreach ($phpFiles as $file) {
    if ($file->isDir() || $file->getExtension() !== 'php') continue;
    $path = $file->getRealPath();
    if (strpos($path, '.git') !== false || strpos($path, 'scratch') !== false) continue;
    
    $content = file_get_contents($path);
    preg_match_all('/(?:require|include|require_once|include_once)\s*[\(\'\"]+([^\'\"\;\)]+)[\'\"]+\)?/i', $content, $matches);
    
    if (!empty($matches[1])) {
        foreach ($matches[1] as $inc) {
            $inc = trim($inc, " '\"()");
            if (empty($inc) || strpos($inc, '$') !== false) continue; // skip dynamic variables
            
            $fileDir = dirname($path);
            $targetPath = realpath($fileDir . '/' . $inc);
            if (!$targetPath) {
                $targetPath = realpath($root . '/' . $inc);
            }
            if ($targetPath && file_exists($targetPath)) {
                $actualName = basename($targetPath);
                $expectedName = basename($inc);
                if (strcmp($actualName, $expectedName) !== 0 && strtolower($actualName) === strtolower($expectedName)) {
                    $mismatches[] = "In $path: included '$inc' but file on disk is '$actualName'";
                }
            }
        }
    }
}

echo "Total checked. Case mismatches: " . count($mismatches) . "\n";
foreach ($mismatches as $m) {
    echo "  - $m\n";
}
