$files = @("index.php", "inc.gallery.php", "about.php", "inc.chancellor.php")

foreach ($file in $files) {
    if (Test-Path $file) {
        $content = Get-Content $file -Raw
        $content = [regex]::Replace($content, '(?i)<img(?![^>]*loading=)', '<img loading="lazy"')
        Set-Content $file $content
        Write-Host "Processed $file"
    }
}
