<?php
include_once("config.php");
$branch=$_POST["branch"];
$db->where('branch',$branch);
$syllabus = $db->get('syllabus');
echo "<option>Select Sem / Year</option>";
if(is_array($syllabus) & count($syllabus)>0)
	{
		foreach($syllabus as $isyllabus)
		{
			echo "<option value=$isyllabus[id]>$isyllabus[heading]</option>";
		}
	}

?>