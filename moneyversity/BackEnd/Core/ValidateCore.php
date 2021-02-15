<?php
//declare strict type:
declare(strict_types = 1); 

	//get certain functions such as htmlentities and other parameters......
	
	//the function:
	function validate($anyDataEntity){
		$sanitizedData = SanitizedCore($anyDataEntity);
		return $sanitizedData; 
	}

	function SanitizedCore($anyDataEntity){
		if (ctype_alpha($anyDataEntity) || ctype_alnum($anyDataEntity) || 
				ctype_digit($anyDataEntity)
			&& (strlen($anyDataEntity) > 4)
		){
			SanitizeLogic($anyDataEntity);
		} else {
			SanitizeLogic($anyDataEntity);
		}
	}

	function SanitizeLogic($anyDataEntity){

		//Removes any html from the string and turns it into &lt;
		$anyDataEntity = htmlentities($anyDataEntity);

		//Strips html and PHP tags
		$anyDataEntity = strip_tags($anyDataEntity); 

		if (get_magic_quotes_gpc())
		{
			// Gets rid of unwanted quotes
			$anyDataEntity = stripslashes($anyDataEntity); 
		}
		return $anyDataEntity;
	}
?>