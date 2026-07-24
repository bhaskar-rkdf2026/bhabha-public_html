<?php
include_once("config.php");
$course=$_POST["course"];
$db->where('course',$course);
$db->where('status',1);
$branch = $db->get('branch');
echo "<option>Select Branch</option>";
if(is_array($branch) & count($branch)>0)
	{
		foreach($branch as $ibranch)
		{
			echo "<option value=$ibranch[id]>$ibranch[branch]</option>";
		}
	}

?>