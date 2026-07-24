<?php
defined('PATH_LIB') or die("Restricted Access");

function redirect($url=NULL)
{
	if(is_null($url)) $url=curPageURL();
	if(headers_sent())
	{
		echo "<script>window.location='".$url."'</script>";
	}
	else
	{
		header("Location:".$url);
	}
	exit;
}

function chkHeader()
{
	if(strpos($_SERVER['HTTP_REFERER'],URL_ROOT)==0) return true;
	return false;
}

function setMsgPage($mod, $sec, $type, $note)
{
	//possible values for type
	//success
	//information
	//warning
	//error
	if(!isset($_SESSION['msg_er'])) $_SESSION['msg_er']=array();
	if(!isset($_SESSION['msg_er'][$mod])) $_SESSION['msg_er'][$mod]=array();
	if(!isset($_SESSION['msg_er'][$mod][$sec])) $_SESSION['msg_er'][$mod][$sec]=array();
	
	$_SESSION['msg_er'][$mod][$sec]['page']=array(
												  'type'=>$type,
												  'note'=>$note
												  );
}

function getMsgPage($mod, $sec)
{
	$return='';
	if(isset($_SESSION['msg_er'][$mod][$sec]['page']) && is_array($_SESSION['msg_er'][$mod][$sec]['page']) && count($_SESSION['msg_er'][$mod][$sec]['page'])>0)
	{
		$class=$_SESSION['msg_er'][$mod][$sec]['page']['type'];
		$return="<div class=\"notification ".$class."\">";
		$return.=$_SESSION['msg_er'][$mod][$sec]['page']['note'];
		$return.="</div>";
		
		unset($_SESSION['msg_er'][$mod][$sec]['page']);
	}
	
	clearErMsg($mod,$sec);
	
	return $return;
}

function setMsgField($mod, $sec, $field, $type, $note)
{
	//possible values for type
	//success
	//information
	//warning
	//error
	
	if(!isset($_SESSION['msg_er'])) $_SESSION['msg_er']=array();
	
	if(!isset($_SESSION['msg_er'][$mod])) $_SESSION['msg_er'][$mod]=array();
	if(!isset($_SESSION['msg_er'][$mod][$sec])) $_SESSION['msg_er'][$mod][$sec]=array();
	
	if(!isset($_SESSION['msg_er'][$mod][$sec]['field'])) $_SESSION['msg_er'][$mod][$sec]['field']=array();
	
	$_SESSION['msg_er'][$mod][$sec]['field'][$field]=array(
														   'type'=>$type,
														   'note'=>$note
														   );
}

function getMsgField($mod, $sec, $field)
{
	$return='';
	if(isset($_SESSION['msg_er'][$mod][$sec]['field'][$field]) && is_array($_SESSION['msg_er'][$mod][$sec]['field'][$field]) && count($_SESSION['msg_er'][$mod][$sec]['field'][$field])>0)
	{
		$class=$_SESSION['msg_er'][$mod][$sec]['field'][$field]['type'];
		$return="<span class=\"notification ".$class."\">";
		$return.=$_SESSION['msg_er'][$mod][$sec]['field'][$field]['note'];
		$return.="</span>";
		unset($_SESSION['msg_er'][$mod][$sec]['field'][$field]);
	}
	if(isset($_SESSION['msg_er'][$mod][$sec]['field']) && is_array($_SESSION['msg_er'][$mod][$sec]['field']) && count($_SESSION['msg_er'][$mod][$sec]['field'])===0) unset($_SESSION['msg_er'][$mod][$sec]['field']);
	
	clearErMsg($mod,$sec);
	
	return $return;
}

function clearErMsg($mod,$sec)
{
	if(isset($_SESSION['msg_er'][$mod][$sec]) && is_array($_SESSION['msg_er'][$mod][$sec]) && count($_SESSION['msg_er'][$mod][$sec])===0) unset($_SESSION['msg_er'][$mod][$sec]);
	
	if(isset($_SESSION['msg_er'][$mod]) && is_array($_SESSION['msg_er'][$mod]) && count($_SESSION['msg_er'][$mod])===0) unset($_SESSION['msg_er'][$mod]);
	
	if(isset($_SESSION['msg_er']) && is_array($_SESSION['msg_er']) && count($_SESSION['msg_er'])===0) unset($_SESSION['msg_er']);
}

function setSort($mod,$sec,$val)
{
	if(!isset($_SESSION['sort'])) $_SESSION['sort']=array();
	if(!isset($_SESSION['sort'][$mod])) $_SESSION['sort'][$mod]=array();
	
	$_SESSION['sort'][$mod][$sec]=$val;
}

function getSort($mod,$sec)
{
	return $_SESSION['sort'][$mod][$sec];
}

function curPageURL() 
{
	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") 
	{
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} 
	else 
	{
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return $pageURL;
}

function getQueryString($aryQueryStr)
{
	$aryMatch=array();
	foreach($aryQueryStr as $opt=>$val) { $aryMatch[]=$opt.'='.urlencode($val); }
	return '?'.implode('&',$aryMatch);
}

function selected($needle,$haystack)
{
	if(is_array($haystack) && in_array($needle,$haystack)) { return 'selected="selected"'; }
	elseif(!is_array($haystack) && $needle===$haystack) { return 'selected="selected"'; }
	else { return ''; }
}

function checked($needle,$haystack)
{
	if(is_array($haystack) && in_array($needle,$haystack)) { return 'checked="checked"'; }
	elseif(!is_array($haystack) && $needle===$haystack) { return 'checked="checked"'; }
	else { return ''; }
}

function isValidDate($val)
{
	if(preg_match(REGX_DATE,$val))
	{
		list($year,$month,$date)=explode("-",$val);
		if(checkdate($month,$date,$year)) return true;
	}
	return false;
}

function getPaging($refUrl,$aryOpts,$pgCnt,$curPg)
{
//	echo $aryOpts." ".$pgCnt." ".$curPg;
	$return='';
	$return.='<div class="pagination">';
	if($curPg>1)
	{
		$aryOpts['pg']=1;
		$return.='<a href="'.$refUrl.getQueryString($aryOpts).'">First</a>';
		
		$aryOpts['pg']=$curPg-1;
		$return.='<a href="'.$refUrl.getQueryString($aryOpts).'">Prev</a>';
	}
	for($i=1;$i<=$pgCnt;$i++)
	{
		$aryOpts['pg']=$i;
		$return.='<a href="'.$refUrl.getQueryString($aryOpts).'" class="graybutton pagelink';
		if($curPg==$i) $return.=' active';
		$return.='" >'.$i.'</a>';
	}
	if($curPg<$pgCnt)
	{
		$aryOpts['pg']=$curPg+1;
		$return.='<a href="'.$refUrl.getQueryString($aryOpts).'">Next</a>';
		$aryOpts['pg']=$pgCnt;
		$return.='<a href="'.$refUrl.getQueryString($aryOpts).'">Last</a>';
	}
	$return.='</div>';
	return $return;
}

function isAdmin()
{
	if(isset($_SESSION[LOGIN_ADMIN]) && is_array($_SESSION[LOGIN_ADMIN]) && isset($_SESSION[LOGIN_ADMIN]['id'])) return true;
	return false;
}

function getFileSize($path)
{
	if(is_array($path) && count($path)>0)
	{
		//if(!file_exists($path)) return 0;
		//if(is_file($path)) return filesize($path);
		$ret = 0;
		foreach($path as $file)
			$ret+=getFileSize($file);
		return $ret;
	}
	else
	{
		if(!file_exists($path)) return 0;
		if(is_file($path)) return filesize($path);
	}
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
  
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
  
    $bytes /= pow(1024, $pow);
  
    return round($bytes, $precision) . ' ' . $units[$pow];
	//return $bytes;
}

function getRealIpAddr()
{
    if(!empty($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
    { 
		$ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
    { 
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    { 
		$ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function fetchSetting($mixVal)
{
	$aryReturn=array();
	$strSetting='';
	if(is_array($mixVal) && count($mixVal)>0)
	{
		$strSetting="'".implode("', '",$mixVal)."'";
	}
	elseif(trim($mixVal)!='')
	{
		$strSetting="'".$mixVal."'";
	}
	if(trim($strSetting)!='')
	{
		global $db;
		$arySetData=$db->getRows("select * from settings where `field` in (".$strSetting.")");
		if(is_array($arySetData) && count($arySetData)>0)
		{
			foreach($arySetData as $iSetData)
			{
				$aryReturn[$iSetData['field']]=$iSetData['value'];
			}
		}
	}
	return $aryReturn;
}

function getStatusImg($status)
{
	$aryImg=array(
				  '0'=>"status_inactive.png",
				  '1'=>"status_active.png"
				  );
	return '<img src="'.URL_ADMIN_IMG.$aryImg[$status].'" title="'.getStatusStr($status).'" />';
}

function getOptionImg($status)
{
	$aryImg=array(
				  '0'=>"cross.png",
				  '1'=>"tick.png"
				  );
	return '<img src="'.URL_ADMIN_IMG."icons/".$aryImg[$status].'" />';
}

function getStatusStr($val)
{
	if($val==0)
	{
		return "Inactive";
	}
	else
	{
		return "Active";
	}
}
function getOptionStr($val)
{
	if($val==0)
	{
		return "No";
	}
	else
	{
		return "Yes";
	}
}

function delete_directory($dirname)
{
	if (is_dir($dirname))
      $dir_handle = opendir($dirname);
   if (!$dir_handle)
      return false;
   while($file = readdir($dir_handle))
   {
      if ($file != "." && $file != "..")
	  {
         if (!is_dir($dirname.DS.$file))
            @unlink($dirname.DS.$file);
         else
            delete_directory($dirname.DS.$file);    
      }
   }
   closedir($dir_handle);
   @rmdir($dirname);
   return true;
}

function check_login($userType='User')
{
	if($userType=='User' && (!isset($_SESSION[LOGIN_USER]) || count($_SESSION[LOGIN_USER])==0))
		return false;
	elseif($userType=='Admin' && (!isset($_SESSION[LOGIN_ADMIN]) || count($_SESSION[LOGIN_ADMIN])==0))
		return false;
	return true;
}
function getPagingRest($refUrl,$aryOpts,$pgCnt,$curPg)
{
	$return='';
	$return.='';
	if($curPg>1)
	{
		$aryOpts['pg']=1;
		$return.='<a href="'.$refUrl.http_build_query($aryOpts).'"><div class="pageraking">First</div></a>';
		
		$aryOpts['pg']=$curPg-1;
		$return.='<a href="'.$refUrl.http_build_query($aryOpts).'"><div class="pageraking">Prev</div></a>';
	}
	for($i=1;$i<=$pgCnt;$i++)
	{
		$aryOpts['pg']=$i;
		$return.='<a href="'.$refUrl.http_build_query($aryOpts).'" class="pageraking_gry';
		if($curPg==$i) $return.=' active';
		$return.='" >'.$i.'</a>';
	}
	if($curPg<$pgCnt)
	{
		$aryOpts['pg']=$curPg+1;
		$return.='<a href="'.$refUrl.http_build_query($aryOpts).'"><div class="pageraking">Next</div></a>';
		$aryOpts['pg']=$pgCnt;
		$return.='<a href="'.$refUrl.http_build_query($aryOpts).'"><div class="pageraking">Last</div></a>';
	}
	$return.='';
	return $return;
}
function resizeVideo($markup, $dimensions)
{
    $w = $dimensions['width'];
    $h = $dimensions['height'];
    $patterns = array();
    $replacements = array();
    if( !empty($w) )
    {
        $patterns[] = '/width="([0-9]+)"/';
        $patterns[] = '/width:([0-9]+)/';
        $patterns[] = '/width="([0-9]+)px"/';
		
        $replacements[] = 'width="'.$w.'"';
        $replacements[] = 'width:'.$w;
		$replacements[] = 'width="'.$w.'px"';
    }
    if( !empty($h) )
    {
        $patterns[] = '/height="([0-9]+)"/';
        $patterns[] = '/height:([0-9]+)/';
        $patterns[] = '/height="([0-9]+)px"/';
		
        $replacements[] = 'height="'.$h.'"';
        $replacements[] = 'height:'.$h;
		$replacements[] = 'height="'.$h.'px"';
    }
    return preg_replace($patterns, $replacements, $markup);
}
function change_date_format_mdy($date){

//       list($year,$month,$day) = explode("-",$date);
//       $newdate = $month."-".$day."-".$year;
//       return $newdate;
//		 return DATE_FORMAT(date($date));
		 return date(DATE_FORMAT,strtotime($date));
}
function change_date_format_ymd($date){

       list($month,$day,$year) = explode("-",$date);
       $newdate = $year."-".$month."-".$day;
       return $newdate;
}

?>