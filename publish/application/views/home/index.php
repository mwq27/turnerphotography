<? $this->load->view("/partials/header"); ?>
	
		<h1>Marcus Turner Photography</h1>
	
		<div id="leftside" >
			<? $this->load->view("/partials/leftnav"); ?>

			
		</div>
		
		
	
	
	<div class="container">
		
		<div id="featured"> 
			
			<!--<img src="dummy-images/captions.jpg" data-caption="#htmlCaption" />-->
			<?
				foreach($images as $row){
					echo "<img src='/images/".$row->filename."'/>";
				}
			
			?>
			
		</div>
		
	</div>
	
	<div id="rightside" >
			<? $this->load->view("/partials/rightnav"); ?>
		</div>			


<? $this->load->view("/partials/footer"); ?>