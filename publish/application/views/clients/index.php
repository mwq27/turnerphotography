<? $this->load->view("/partials/header"); ?>
	
		<h1>Marcus Turner Photography:<br/> <?=$client?></h1>
		
		<? if($this->agent->is_browser('MSIE')){?>
			
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
	<? }else{ ?>
		
			
		<section id="photos">

		<?php 
			
			
			foreach($images as $row){
					echo "<img src='/images/".$row->filename."'/>";
				}
		
		
	 	?>
	
		</section>
		
		<? }	?>
<? $this->load->view("/partials/footer"); ?>