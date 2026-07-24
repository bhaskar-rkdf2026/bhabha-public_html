<?php
if(isset($_FILES['upload_domicile']) && count($_FILES['upload_domicile']['name']) > 0 && $_FILES['upload_domicile']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['upload_domicile']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['upload_domicile']['tmp_name'],UPLOAD.$newfile));
		{
			$data['upload_domicile'] = $newfile;
		}
	}
if(isset($_FILES['upload_caste']) && count($_FILES['upload_caste']['name']) > 0 && $_FILES['upload_caste']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['upload_caste']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['upload_caste']['tmp_name'],UPLOAD.$newfile));
		{
			$data['upload_caste'] = $newfile;
		}
	}
if(isset($_FILES['upload_income']) && count($_FILES['upload_income']['name']) > 0 && $_FILES['upload_income']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['upload_income']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['upload_income']['tmp_name'],UPLOAD.$newfile));
		{
			$data['upload_income'] = $newfile;
		}
	}
if(isset($_FILES['upload_high_school']) && count($_FILES['upload_high_school']['name']) > 0 && $_FILES['upload_high_school']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['upload_high_school']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['upload_high_school']['tmp_name'],UPLOAD.$newfile));
		{
			$data['upload_high_school'] = $newfile;
		}
	}
if(isset($_FILES['upload_higher_school']) && count($_FILES['upload_higher_school']['name']) > 0 && $_FILES['upload_higher_school']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['upload_higher_school']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['upload_higher_school']['tmp_name'],UPLOAD.$newfile));
		{
			$data['upload_higher_school'] = $newfile;
		}
	}
if(isset($_FILES['uploadg']) && count($_FILES['uploadg']['name']) > 0 && $_FILES['uploadg']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['uploadg']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		echo $_FILES['uploadg']['tmp_name'],UPLOAD.$newfile;
		if(move_uploaded_file($_FILES['uploadg']['tmp_name'],UPLOAD.$newfile));
		{
			$data['uploadg'] = $newfile;
		}
	}
if(isset($_FILES['uploadpg']) && count($_FILES['uploadpg']['name']) > 0 && $_FILES['uploadpg']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['uploadpg']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['uploadpg']['tmp_name'],UPLOAD.$newfile));
		{
			$data['uploadpg'] = $newfile;
		}
	}
if(isset($_FILES['aadhar_card']) && count($_FILES['aadhar_card']['name']) > 0 && $_FILES['aadhar_card']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['aadhar_card']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['aadhar_card']['tmp_name'],UPLOAD.$newfile));
		{
			$data['aadhar_card'] = $newfile;
		}
	}
if(isset($_FILES['photo']) && count($_FILES['photo']['name']) > 0 && $_FILES['photo']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['photo']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['photo']['tmp_name'],UPLOAD.$newfile));
		{
			$data['photo'] = $newfile;
		}
	}
if(isset($_FILES['otherdocx']) && count($_FILES['otherdocx']['name']) > 0 && $_FILES['otherdocx']['name'] != '')
	{
		$file_ext = end(explode('.', strtolower($_FILES['otherdocx']['name'])));
		$newfile=md5(microtime()).".".$file_ext;
		if(move_uploaded_file($_FILES['otherdocx']['tmp_name'],UPLOAD.$newfile));
		{
			$data['otherdocx'] = $newfile;
		}
	}
?>
