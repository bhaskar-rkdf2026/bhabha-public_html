<?php
class Validation
{
/*
Usage: 
alphanum, alpha, alphanospace, num, dec, email, url

$val = new Validation();
$val->addRule($value,'num','Field 1', true, false, false );
*/
	var $error = array();
	
	//field name, type, req, min, max, error msg//
	function addRule($field, $type, $label, $req=false, $min=false, $max=false)
	{
		if($req==true and trim($field) =='' and $type!='file')
		{
			$this->error[] = $label.' cannot be left blank.';
			return false;
		}		
		
		if($min)
		{
			if(strlen($field)<$min)
			{
				$this->error[] = "Minimum $min characters required in $label";
				return false;
			}
		}
		
		if($max)
		{
			if(strlen($field)>$max)
			{
				$this->error[] = "Maximum $max characters allowed in $label";
				return false;
			}
		}
		
		
		if($type=='alphanum')
		{
			$result = ereg ("^[A-Za-z0-9\ ]+$", $field);
			if (!$result)
			{
				$this->error[] = "Please enter valid characters in $label";
				return false;
			}		
		}
		elseif($type=='alpha')
		{
			$result = ereg ("^[A-Za-z\ ]+$", $field);
			if (!$result)
			{
				$this->error[] = "Please enter alphabets only in $label";
				return false;
			}		
		}
		elseif($type=='alphanospace')
		{
			$result = ereg ("^[A-Za-z\]+$", $field);
			if (!$result)
			{
				$this->error[] = "Please enter alphabets without space in $label";
				return false;
			}		
		}
		elseif($type=='alphanumnospace')
		{
			$result = ereg ("^[A-Za-z0-9\]+$", $field);
			if (!$result)
			{
				$this->error[] = "Space & Special Characters are not allowed in $label";
				return false;
			}		
		}
		//elseif($type=='facebook')
//		{
//			$result = explode(":", $field);
//			if (!$result)
//			{
//				$this->error[] = "Space not allowed in $label";
//				return false;
//			}		
//		}
		elseif($type=='num')
		{
			$result = ereg ("^[0-9\ ]+$", $field);
			if (!$result)
			{
				$this->error[] = "Please enter numbers only in $label";
				return false;
			}		
		}
		elseif($type=='decimal')
		{
			$result = ereg ("^[0-9\.]+$", $field);
			$pos=substr($field, 0, 1);
			if (!$result || $pos==0)
			{
				$this->error[] = "$label must be Numbers and Decimals or First Digit should not be zero";
				return false;
			}		
		}
		elseif($type=='pass')
		{
			$passPatern="/^(?=.*\d)([a-zA-Z0-9]){4,5}+([0-9]){1}$/";
			
			if(preg_match($passPatern,$field)==0)			
			{
				$this->error[]= "Passwords should be at least 5 characters long and include 1 number. Please try again.";
				return false;
			}
		}
        elseif($type=='stock')
		{
			$result = ereg ("^[0-9\]+$", $field);
			$pos=substr($field, 0, 1);
			if (!$result || $pos==0)
			{
				$this->error[] = "$label must be Numbers or First Digit should not be zero";
				return false;
			}		
		}
		elseif($type=='price')
		{
			$result = ereg ("^[0-9\.]+$", $field);
			$pos=substr($field, 0, 1);
			if (!$result || $pos==0)
			{
				$this->error[] = "$label must be Numbers/Decimals or First Digit should not be zero";
				return false;
			}		
		}
		elseif($type=='dec')
		{
			$result = ereg ("^[0-9\.]+$", $field);
			if (!$result)
			{
				$this->error[] = "Please enter numbers only in $label";
				return false;
			}		
		}
		elseif($type=='email')
		{			
			$result = ereg ("^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}(\.[a-zA-Z]{2,3})?(\.[a-zA-Z]{2,3})?$", $field );
			     
				if (!$result)
				{
					$this->error[] = "Please enter valid email address.";
					return false;
				}
		}
		elseif($type=='drop')
		{			
			if($field=="0")
			{
				$this->error[] = "Please Select $label.";
				return false;
			}
		}
		elseif($type=='file')
		{
			if (!$field)
			{
				$this->error[] = "$label is Required";
				return false;
			}		
		}
		elseif($type=='url')
		{
			
			$result = preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $field);
			if (!$result)
			{
				$this->error[] = "Please enter valid url in $label";
				return false;
			}
		}
		elseif($type=='contact')
		{	
		   //Pattrerns which we follow
		   // +91-9893111128
//			(+91)9893111128
//			1-(123)-123-1234
//			+1(123)-123-1234
//			123456789
//			(910)456-7890
			$result  = ereg("^\+?([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{8})$", $field );
			$result1 = ereg("^([\+][0-9]{2}\-)[0-9]{10}$", $field );
			$result2 = ereg("^([\(][0][0-9]{2}[\)])[\-][0-9]{10}$", $field );
			$result3 = ereg("^([\(][\+][0-9]{2}[\)])[0-9]{10}$", $field );
			
			if (!$result && !$result1 && !$result2 && !$result3)
			{
				$this->error[] = "Please enter valid $label.";
				return false;
			}
		 }
		
	}
	
	function oldPassword($field1,$field2)
	{
		if($field1!=$field2)	
		{
			$this->error[] = "Old Password doesn't match";
			return false;
		}
	}
	
	function confirmPassword($field1,$field2)
	{
		if($field1!=$field2)	
		{
			$this->error[] = "Password doesn't match";
			return false;
		}
	}
	
	
	function validate()
	{
		if(!count($this->error))
		{
			/*$stat = '';
			foreach($this->error as $k => $val)
			{
				$stat.=$val.'<br />';
			}*/
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	function errors()
	{
		
		return $this->error[0];		
		
	}
	function checkDateFormat($date,$label)
	{
	//match the format of the date
	if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
	{
	//check weather the date is valid of not
	if(checkdate($parts[2],$parts[3],$parts[1]))
	return true;
	else
	$this->error[] = "Please Enter Valid Date in $label";
	return false;
	}
	else
	$this->error[] = "Please Enter Valid Date in $label";
	return false;
	}
	
	function verifycaptcha($code1,$code2)
	{
		if($code1!=$code2)
		{
			$this->error[] = "Please enter valid verification code";
			return false;
		}
		else
		{
		   return true;
		}
	}
	

}
?>