<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('image');
		$this->catid = $this->image->get_catids();
		
	}
	
	public function index()
	{
		
		$this->load->helper("form");
		$data["title"] = "Marcus Turner Photography";
		
		$data['categories']	 = $this->catid;
		if($this->session->userdata("logged_in") == 1){
			
			$this->load->view('admin/index', $data);
		}else{
			$this->load->view('admin/login', $data);
		}
	}
	
	public function registration(){
		$this->load->helper("form");
		$data["title"] = "Marcus Turner Photography";
		$this->load->view('/admin/reg-form', $data);
	}
	
	public function login(){
		$this->load->helper(array('form', 'encode'));
		$this->load->model('admin_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email-log', 'Email', 'trim|required');
		$this->form_validation->set_rules('password-log', 'Password', 'trim|required');
    
		if ($this->form_validation->run() == FALSE){
			
			 $data['title'] = 'Admin Login';
			 $this->load->view('admin/index', $data);
		}else{
			$username = $this->input->post('email-log', TRUE);
			$password = $this->input->post('password-log', TRUE);
     
			//Try and log the user in
			$log_res = $this->admin_model->login_user($username, $password);
			
			if($log_res){
				
								$user_array = $log_res[0];
								$login_time = date("Y-m-d g:i:s");
								$user_info = array(
							   	'email'  => $username,
							  	'login_time' => $login_time,
							 	
							 	'username' => $user_array->username,
							  	'logged_in' => TRUE
							  );
						       		$this->session->set_userdata($user_info);
								  //$month = 2592000 + time(); 
						      //set_cookie('LCVIP', $user_array->firstname, $month);
						      redirect("http://".$_SERVER['SERVER_NAME']."/".$user_array->username);

				}else{
				
				  $data['login_error'] = "<p class='login-error'>Username and password do not match</p>";
				  //$this->session->set_flashdata('login',"<p class='error'>Username and password do not match</p>" );
						  
			    	$data['title'] = 'Home | EasyTags';
					$this->load->view('admin/index', $data);
				
				}
			
		}
		
	}

	function register(){
		$this->load->helper(array('form', 'url', 'encode'));
		$this->load->model('admin_model');
		$this->load->library('form_validation');
		$email = $this->input->post("email", TRUE);
		$password = $this->input->post("password", TRUE);
		
		
		
		
		$this->form_validation->set_rules('email', 'Email address', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		//$this->form_validation->set_rules('password_conf', 'Password confirmation', 'trim|required|matches[password]');
		if ($this->form_validation->run() == FALSE){
			
			 $data['title'] = 'Register | EasyTags Mobile';
			 //$this->session->set_flashdata('reg-error', 'Oops, something went wrong.  Please check your entries and try again');
			 $this->load->view('admin/index');
			 
		}else{
			
			$reg = $this->admin_model->register($email, $password);
			if($reg != "fail"){
									
									$login_time = date("Y-m-d g:i:s");
									$user_info = array(
								   'username'  => $email,
								 
								   'user_id' => $reg,
								  'login_time' => $login_time,
								 'login_type' => 'admin',
								  'logged_in' => TRUE
								  );
								 
						  
					$this->session->set_userdata($user_info);
					$redirect = "http://".$_SERVER['SERVER_NAME']."/admin/index";
					
					redirect($redirect);
				
			}
		}
		
	}

	function logout(){
			
			$this->load->helper(array('form', 'url'));
      		$this->session->unset_userdata('id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('tag_id');
			$this->session->unset_userdata('logged_in');
     	  	$this->session->sess_destroy();
		    redirect("/");
	}

	function new_image(){
		$this->load->helper(array('form', 'url'));
		$catid = $this->uri->segment(3);
		$cat = $this->catid[$catid];
		$data["catid"] = $catid;
		$data["category"] = $cat;
		$this->load->view("admin/new-image", $data);
		
		
	}

	function upload(){
		$this->load->helper(array('url'));	
		$targetDir = $_SERVER['DOCUMENT_ROOT'].'/images/';
		$catid = $this->uri->segment(3);
		
			//$cleanupTargetDir = false; // Remove old files
			//$maxFileAge = 60 * 60; // Temp file age in seconds
			
			// 5 minutes execution time
			@set_time_limit(5 * 60);
			
			// Uncomment this one to fake upload time
			// usleep(5000);
			
			// Get parameters
			$chunk = isset($_REQUEST["chunk"]) ? $_REQUEST["chunk"] : 0;
			$chunks = isset($_REQUEST["chunks"]) ? $_REQUEST["chunks"] : 0;
			$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
			
			// Clean the fileName for security reasons
			$fileName = preg_replace('/[^\w\._]+/', '', $fileName);
			
			// Make sure the fileName is unique but only if chunking is disabled
			if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
				$ext = strrpos($fileName, '.');
				$fileName_a = substr($fileName, 0, $ext);
				$fileName_b = substr($fileName, $ext);
			
				$count = 1;
				while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
					$count++;
			
				$fileName = $fileName_a . '_' . $count . $fileName_b;
			}
			
			// Create target dir
			if (!file_exists($targetDir))
				@mkdir($targetDir);
			
			// Remove old temp files
			/* this doesn't really work by now
				
			if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
				while (($file = readdir($dir)) !== false) {
					$filePath = $targetDir . DIRECTORY_SEPARATOR . $file;
			
					// Remove temp files if they are older than the max age
					if (preg_match('/\\.tmp$/', $file) && (filemtime($filePath) < time() - $maxFileAge))
						@unlink($filePath);
				}
			
				closedir($dir);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			*/
			//INSERT INTO IMAGES TABLE
					$this->image->new_image($fileName, $catid);
			// Look for the content type header
			if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
				$contentType = $_SERVER["HTTP_CONTENT_TYPE"];
			
			if (isset($_SERVER["CONTENT_TYPE"]))
				$contentType = $_SERVER["CONTENT_TYPE"];
			
			// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
			if (strpos($contentType, "multipart") !== false) {
				if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
					// Open temp file
					
					$out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
					if ($out) {
						// Read binary input stream and append it to temp file
						$in = fopen($_FILES['file']['tmp_name'], "rb");
			
						if ($in) {
							while ($buff = fread($in, 4096))
								fwrite($out, $buff);
						} else
							die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
						fclose($in);
						fclose($out);
						@unlink($_FILES['file']['tmp_name']);
					} else
						die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
				} else
					die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			} else {
				// Open temp file
				$out = fopen($targetDir . DIRECTORY_SEPARATOR . $fileName, $chunk == 0 ? "wb" : "ab");
				if ($out) {
					// Read binary input stream and append it to temp file
					$in = fopen("php://input", "rb");
			
					if ($in) {
						while ($buff = fread($in, 4096))
							fwrite($out, $buff);
					} else
						die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			
					fclose($in);
					fclose($out);
				} else
					die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			}
			
			// Return JSON-RPC response
			die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
			
			
	}
	
}