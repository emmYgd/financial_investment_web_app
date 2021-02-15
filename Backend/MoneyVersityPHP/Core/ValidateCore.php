<?php
namespace Backend\Core;

trait ValidateCore 
{
	//get certain functions such as htmlentities and other parameters......
	
	//the function:
	public function validate($anyDataEntity){
		$sanitizedData = SanitizedCore($anyDataEntity);
		return $sanitizedData; 
	}

	public function SanitizedCore($anyDataEntity){
		if (ctype_alpha($anyDataEntity) || ctype_alnum($anyDataEntity) || 
				ctype_digit($anyDataEntity)) 
			&& (strlen($anyDataEntity) > 4)
		){
			this->SanitizeLogic($anyDataEntity);
		} else {
			this->SanitizeLogic($anyDataEntity);
		}
	}

	public function SanitizeLogic($anyDataEntity){

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
}
?>