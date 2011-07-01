<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('image');
		$this->catid = $this->image->get_catids();
		
	}
	
	public function index()
	{	$this->load->helper("form");
		$data["title"] = "Marcus Turner Photography";
		if($this->session->userdata("logged_in") == true){
			$this->load->view('/admin/index', $data);
		}else{
			$this->load->view('/admin/login', $data);
		}
	}
	
	public function registration(){
		$this->load->helper("form");
		$data["title"] = "Marcus Turner Photography";
		$this->load->view('/admin/reg-form', $data);
	}
	
	public function login(){
		$this->load->helper(array('form', 'encode'));
		$this->load->model('user');
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
			$log_res = $this->user->login_user($username, $password);
			
			if($log_res){
				
								$user_array = $log_res[0];
								$login_time = date("Y-m-d g:i:s");
								$user_info = array(
							   	'email'  => $username,
							  	'login_time' => $login_time,
							 	'tag_id' => $user_array->tag_id,
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
		$this->load->model('user');
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
			
			$reg = $this->admin->register($email, $password);
			if($reg != "fail"){
									
									$login_time = date("Y-m-d g:i:s");
									$user_info = array(
								   'username'  => $email,
								 
								   'user_id' => $reg,
								  'login_time' => $login_time,
								 'login_type' => 'site',
								  'logged_in' => TRUE
								  );
								 
						  
					$this->session->set_userdata($user_info);
					$redirect = "http://".$_SERVER['SERVER_NAME']."/admin";
					
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
	
}