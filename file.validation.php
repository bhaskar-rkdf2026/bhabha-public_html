<?php 
if($_FILES['upload_domicile']['name'] != '')
		{
			$filename = basename($_FILES['upload_domicile']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['upload_caste']['name'] != '')
		{
			$filename = basename($_FILES['upload_caste']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['upload_income']['name'] != '')
		{
			$filename = basename($_FILES['upload_income']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['upload_high_school']['name'] != '')
		{
			$filename = basename($_FILES['upload_high_school']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['upload_higher_school']['name'] != '')
		{
			$filename = basename($_FILES['upload_higher_school']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['uploadg']['name'] != '')
		{
			$filename = basename($_FILES['uploadg']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['uploadpg']['name'] != '')
		{
			$filename = basename($_FILES['uploadpg']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['aadhar_card']['name'] != '')
		{
			$filename = basename($_FILES['aadhar_card']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['photo']['name'] != '')
		{
			$filename = basename($_FILES['photo']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
if($_FILES['otherdocx']['name'] != '')
		{
			$filename = basename($_FILES['otherdocx']['name']);
			$ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
			if($ext != '' && !in_array($ext,array('jpeg','jpg','png','pdf','docx')))
			{
				$stat["error"] = "Only JPG,PNG,PDF & DOCX Files are allowed.";
			}
		}
		
?>