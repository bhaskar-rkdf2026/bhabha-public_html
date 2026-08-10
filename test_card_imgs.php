<?php
$files = [
  'new-media/image/bhabha-engineering-building.jpg',
  'new-media/image/vision.jpeg',
  'new-media/image/bhabha-main-building.jpg',
  'new-media/image/campus-students.jpg',
  'images/vcpic.jpg',
  'extra-images/student-3.jpg',
  'extra-images/filterable5.jpg',
  'extra-images/intro-3.jpg',
  'new-media/image/campus-entrance.png'
];
foreach ($files as $f) {
  echo $f . ': ' . (file_exists(__DIR__ . '/' . $f) ? 'EXISTS (' . filesize(__DIR__ . '/' . $f) . ' bytes)' : 'NOT FOUND') . "\n";
}
