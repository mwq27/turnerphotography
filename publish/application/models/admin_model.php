<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
		function db_safe($data) {
	  
		    if(!is_numeric($data) && $data != ""){
		  
		        $safe_data = mysql_real_escape_string(htmlentities(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8')) or die(mysql_error());
		        return $safe_data;
		    }else return $data;
	  	}
		
		function get_client_id($client){
			$this->db->select("id")->from("clients")->where("client", $client);
			$query = $this->db->get();
			return $query->result();
			
		}
		
		function clients(){
			$this->db->select("id, client")->from("clients");
			$query = $this->db->get();
			return $query->result();
		}
		
		
		function login_user($uname, $pword)
		{
			
			//$p = mysql_fetch_array($run);
			
			$sql = "select salt, password from users where username = '{$uname}' limit 1";
			$run = mysql_query($sql);
			$p = mysql_fetch_array($run);
                        //check if club_id is set
		      $salt = $p["salt"];
		   
		      $db_pword = $p['password'];
		      $hashed_password = generateHash($pword, $salt);
			
			if($hashed_password  == $db_pword){
			 //success
			
			   $sql = "select * from users where username = '{$uname}' limit 1";
					  
		         $query = $this->db->query($sql);
		        
		        
		        return $query->result();
          
     		 }else{  return false;			
			
			}
		}
		
		function new_client($client){
			$client = $this->db_safe($client);
			$date = date("Y-m-d g:i:s");
			$sql = "insert into clients set client = '{$client}', created_at = '{$date}'";
					
			$query = $this->db->query($sql);
			if($query){
				return $this->db->insert_id();
			}else return "fail";
		}
		
		function register($email, $pword)
		{
			
			$email = $this->db_safe($email);
		   
		    $pword = $this->db_safe($pword);
			
			
		    $salt = '';
		      //$pword = db_safe($email);
		  
		    $pword = generateHash($pword, $salt);
			
			$sql = "insert into users set username = '{$email}', password = '{$pword}', salt='{$salt}'";
					
			$query = $this->db->query($sql);
			if($query){
				return $this->db->insert_id();
			}else return "fail";
					
		}	
		
		function update_user($email, $name, $bname, $about_s, $about_l, $tagline, $tagid, $networks)
		{
			
			$email = $this->db_safe($email);
		    $name = $this->db_safe($name);
			$bname = $this->db_safe($bname);
			$about_s = $this->db_safe($about_s);
			$about_l = $this->db_safe($about_l);
		    
			$tagline = $this->db_safe($tagline);
			
		  
			$date = date("Y-m-d g:i:s");
			$sql = "update users set email = '{$email}',  name = '{$name}', business = '{$bname}', networks = '{$networks}', about_short = '{$about_s}', about_long = '{$about_l}',  tagline = '{$tagline}', updated_at = '{$date}' where tag_id = '{$tagid}'";
					
			$query = $this->db->query($sql);
			if($query){
				return $this->db->insert_id();
			}else return "fail";
					
		}
		
		function update_profile($data, $hours, $social){
				$data['updated_at'] = date("Y-m-d g:i:s");
				
				
				//update the users info
				$res = $this->db->update('users', $data, "tag_id = ".$data['tag_id']); 
				
				if($hours != null){
					
					
						foreach($hours as $key => $vh){
								$insert_arr = array(
								'day' => $key,
								'open' => $vh["open"],
								'close' => $vh['close'],
								'tagid' => $data['tag_id'],
								'updated_at' => date("Y-m-d g:i:s")
								
							);
							$check_hours = $this->db->query("select tagid from hours where tagid = '{$data[tag_id]}' and day = '{$key}' limit 1");
								if($check_hours->num_rows() == 0){
									$insert_arr = array(
									'day' => $key,
									'open' => $vh["open"],
									'close' => $vh['close'],
									'tagid' => $data['tag_id'],
									'created_at' => date("Y-m-d g:i:s")
									
								);
								$hour_update = $this->db->insert('hours', $insert_arr);
							}else{
								$hour_update = $this->db->update('hours', $insert_arr, "day = '".$key."' and tagid = ". $data["tag_id"]);
							
							}
							
						}
	
				}
				
				
				
				//Social insert/update
				
				if($social != null){

					
					foreach($social as $key => $val){
							$insert_arr = array(
								'network' => $key,
								'username' => $val,
								'tag_id' => $data["tag_id"],
								'updated_at' => date("Y-m-d g:i:s")
								
							);
							$check_soc = $this->db->query("select network from social where network = '{$key}' and tag_id = '{$data[tag_id]}' limit 1");
							if($check_soc->num_rows() == 0){
								$insert_arr = array(
								'network' => $key,
								'username' => $val,
								'tag_id' => $data["tag_id"],
								'created_at' => date("Y-m-d g:i:s")
								
							);
								$soc_update = $this->db->insert('social', $insert_arr);
							}else{
								$soc_update = $this->db->update('social', $insert_arr, "network = '".$key."' and tag_id = ". $data["tag_id"]);
							}
						}
					
					}
				
				if($res){
					return $data['username'];
				}else
				{
					return "fail";
				}
			
		}

		function update_logo($tag, $path){
			$insert_arr = array(
								'logo' => $path,
								'updated_at' => date("Y-m-d g:i:s")
								);
			$logo_update = $this->db->update('users', $insert_arr, "tag_id = ". $tag);
			
		}
}

	