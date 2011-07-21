<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('image');
		$this->catid = $this->image->get_catids();
		
	}
	
	public function index()
	{
		$this->load->helper(array('url'));
		$cid = $this->uri->segment(2);	
		
		$data["title"] = "Marcus Turner Photography";
		$images = $this->image->get_all_images();
		$data["images"] = $images;
		$this->load->view('/home/index', $data);
	}
	
	
	
	
	public function category(){
		$this->load->helper(array('url'));
		
		
		$cat = $this->uri->segment(2);
		$data['title'] = "Marcus Turner Photography | " .$cat;
		$keys = array_keys($this->catid, $cat); 
		$data["catid"] = $keys[0];
		
		$images = $this->image->get_images($keys[0]);
		$data["images"] = $images;
		$this->load->view("/category/category", $data);
	}
	
	public function contact(){
		$this->load->helper(array('url', 'form'));
		$this->load->library('email');
		$data['title'] = 'Contact me';
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
    
		if ($this->form_validation->run() == FALSE){
			
			 
			 $this->load->view('home/contact', $data);
		}else{
			$name = $this->input->post('name', true);
			$email = $this->input->post('email', true);
			$type = $this->input->post('request', true);
			$comments = $this->input->post('comments', true);
			
			$this->email->from('no-reply@marcusturnerphotography.com', 'Marcus Turner Photography');
                $this->email->to('marques.woodson@gmail.com'); 
                $this->email->reply_to("no-reply@marcusturnerphotography.com", "No Reply"); 
                $this->email->bcc('marques.woodson@gmail.com'); 
                
                $this->email->subject('Your Last Call Vip Account Details');
                $this->email->message("<h2>Thank you for registering with Last Call VIP</h2>
                <ul style='list-style-type:none; font-size:14px; padding:0px;'>
                <li> {$name} {$email}</li>
                <li> {$comments}</li>
                </ul>
                <p>$type</p>
               
                ");  
          
                $this->email->send();
				$this->load->view('home/contact-success', $data);
		}
		
		
	}
	
	function uploadify_post(){
		$this->load->library(array('encrypt', 'email', 'upload', 'session', 'thumbnail'));
	
		$this->load->helper(array('form', 'url'));
		$this->load->model('clubs');
		$randstr = $this->rand_str();
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] .'/';
		$targetPaththmb = $_SERVER['DOCUMENT_ROOT'] .'/thumbs/';
		//Rename the file
		$targetFile =  str_replace('//','/',$targetPath).$randstr.$_FILES['Filedata']['name'];
		$targetFilethmb = str_replace('//','/',$targetPaththmb).$randstr.$_FILES['Filedata']['name'];
		//Shorter paths for the DB
		$shortpath = "/uploads/".$randstr.$_FILES['Filedata']['name'];
		$shortpathThmb = "/thumbs/".$randstr.$_FILES['Filedata']['name'];
		//echo $targetFile; exit;
		move_uploaded_file($tempFile,$targetFile);
	
		$this->thumbnail->thumbnail($targetFile);
   				// generate image_file, set filename to resize
		//$this->thumbnail->size_width(150);				// set width for thumbnail, or
		//$this->thumbnail->size_height(150);				// set height for thumbnail, or
		$this->thumbnail->size_auto(450);					// set the biggest width or height for thumbnail
		$this->thumbnail->jpeg_quality(80);				// set quality for jpeg only (0 - 100) (worst - best), default = 75

		//$thumb->show();						// show your thumbnail

		$this->thumbnail->save("{$targetFile}");
		
		//Save the little thumbnail now
		
		$this->thumbnail->size_width(65);				// set width for thumbnail, or
		$this->thumbnail->size_height(65);				// set height for thumbnail, or
		//$this->thumbnail->size_auto(250);					// set the biggest width or height for thumbnail
		$this->thumbnail->jpeg_quality(40);				// set quality for jpeg only (0 - 100) (worst - best), default = 75

		//$thumb->show();						// show your thumbnail

		$this->thumbnail->save("{$targetFilethmb}");
		//$thumb_path = "/thumbs/".$img[full_path];
		
	
		//$img_path = $img[full_path];
		
		//$img_path_arr = explode(".com", $img_path);
		//$img_path = $img_path_arr[1];
		$post_id = $this->input->post('post_id');
			
			$reg = $this->clubs->upload_post_img($post_id, $shortpath, $shortpathThmb);
		echo "1";
	}

	function upload(){
		$targetDir = $_SERVER['DOCUMENT_ROOT'].'/images/';

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
			
			//INSERT INTO IMAGES TABLE
			$this->image->new_images($fileName, $cat);
	}



}
