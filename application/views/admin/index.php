<? $this->load->view("/partials/header"); ?>
	
		
	
	<section id="admin-new-images">
		<?
			foreach($categories as $key => $val){
				echo "<a href='/admin/new_image/".$key."' >Add new ".$val." images";
			}
		?>
	
	</section>
		
<? $this->load->view("/partials/footer"); ?>