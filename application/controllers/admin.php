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
	
	
	public function new_client(){
		$this->load->helper(array('form', 'encode', 'url'));
		$this->load->model('admin_model');
		$this->load->library('form_validation');
		
		if($this->session->userdata("logged_in") == 0){
				redirect("http://".$_SERVER['SERVER_NAME']."/admin/");
		}else{
				
				$this->form_validation->set_rules('cname', 'Client Name', 'trim|required');
				
				
				
				if ($this->form_validation->run() == FALSE){
					
					$data["title"] = "Marcus Turner Photography | New Client Area";
				
					$this->load->view('/clients/add-client', $data);
				}else{
					$client = $this->input->post('cname', TRUE);
				
	     
					
					$client_res = $this->admin_model->new_client(url_title($client));
					if($client_res != "fail"){
						redirect(site_url()."/admin/client_uploads/".url_title($client));
					}
				}
		}
		
	}
	
	public function client_uploads(){
		
		$this->load->model("admin_model");
		
		$client = $this->uri->segment(3);
		
		$cid = $this->admin_model->get_client_id($client);
		$data['cid'] = $cid;
		$data['client'] = $client;
		$data["title"] = "Marcus Turner Photography | New Client Area";
		
		$this->load->view('/clients/add-images', $data);
		
		
	}
	
	public function registration(){
		$this->load->helper("form");
		$data["title"] = "Marcus Turner Photography";
		$this->load->view('/admin/reg-form', $data);
	}
	
	public function login(){
		//admin2@admin.com
		//chopshop
		$this->load->helper(array('form', 'encode'));
		$this->load->model('admin_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email-log', 'Email', 'trim|required');
		$this->form_validation->set_rules('password-log', 'Password', 'trim|required');
    
		if ($this->form_validation->run() == FALSE){
			
			 $data['title'] = 'Admin Login';
			 $this->load->view('admin/index', $data);
		}else{
			echo ""
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
						      redirect("http://".$_SERVER['SERVER_NAME']."/admin/");

				}else{
				
				  	$data['login_error'] = "<p class='login-error'>Username and password do not match</p>";
				  //$this->session->set_flashdata('login',"<p class='error'>Username and password do not match</p>" );
						  
			    	$data['title'] = 'Home | EasyTags';
					$this->load->view('admin/login', $data);
				
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
	
	public function client_upload(){
		echo "5"; exit;
		$this->load->helper(array('url', 'imgupload'));	
		$cid = $this->uri->segment(3);
		image_upload("client", $cid);
	}

	public function upload(){
		$this->load->helper(array('url', 'imgupload'));	
		$catid = $this->uri->segment(3);
		$this->imgupload->upload("category", $catid);
		
	}
	
}