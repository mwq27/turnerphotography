<?php
define('SALT_LENGTH', 15);
		/**
		* Encodes a string as base64, and sanitizes it for use in a CI URI.
		
		*/
		function url_base64_encode(&$str="")
		{
		    return strtr(
		            base64_encode($str),
		            array(
		                '+' => '.',
		                '=' => '-',
		                '/' => '~'
		            )
		        );
		}
		
		/**
		* Decodes a base64 string that was encoded by ci_base64_encode.
		
		*/
		function url_base64_decode(&$str="")
		{
		    return base64_decode(strtr(
		            $str, 
		            array(
		                '.' => '+',
		                '-' => '=',
		                '~' => '/'
		            )
		        ));
		}

  function generateHash($phrase, &$salt = null)
  {
  $key = '!@#$%^&*()_+=-{}][;";/?<>.,';
      if ($salt == '')
      {
    $salt = substr(hash('sha512',uniqid(rand(), true).$key.microtime()), 0, SALT_LENGTH);
      }
      else
      {
    $salt = substr($salt, 0, SALT_LENGTH);
      }
  
     return hash('sha512',$salt . $key .  $phrase);
  }


?>