<? $this->load->view("/partials/header"); ?>
	
		
	
	<section id="admin-new-images">
		<h2>Client: <?=$client?> image upload </h2>
		
	</section>
		<h3><a href="/admin">Back to admin home</a></h3>
		
		
	<div id="uploader">
		
	</div>
		
		


<? $this->load->view("/partials/footer"); ?>
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : '/admin/client_upload/<?=$cid?>/',
		max_file_size : '10mb',
		unique_names : true,
		drop_element: 'drop',
		multiple_queues: true,

		// Resize images on clientside if we can
		//resize : {width : 620, height : 440, quality : 90},

		// Specify what files to browse for
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		],

		// Flash settings
		flash_swf_url : '/js/libs/plupload.flash.swf',

		// Silverlight settings
		silverlight_xap_url : '/js/libs/plupload.silverlight.xap'
	});

	// Client side form validation
	$('form').submit(function(e) {
		var uploader = $('#uploader').pluploadQueue();

		// Validate number of uploaded files
		if (uploader.total.uploaded == 0) {
			// Files in queue upload them first
			if (uploader.files.length > 0) {
				// When all files are uploaded submit form
				uploader.bind('UploadProgress', function() {
					if (uploader.total.uploaded == uploader.files.length)
						$('form').submit();
				});

				uploader.start();
				 uploader.bind('Error', function(error){
                    console.log(error);
                });
			} else
				alert('You must at least upload one file.');

			e.preventDefault();
		}
	});
});
</script>