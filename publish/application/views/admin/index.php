<? $this->load->view("/partials/header"); ?>
	
		
	
	<section id="admin-new-images">
		<?
			foreach($categories as $key => $val){
				echo "<a href='/admin/new_image/".$key."' >Add new ".$val." images";
			}
		?>
		<a href="/admin/new_client/">Add Client</a>
		
	</section>
	<hr>
	
	<section id="client-links">
		<h1>Client List</h1>
		
		<?
			foreach($all_clients as $key => $val){
				echo " <a href='/client/".$val->client."'>View ".$val->client."</a>";
				echo " <a href='/admin/client_uploads/".$val->client."'>Add Images for ".$val->client."</a>";
			}
			
		?>
	</section>
<? $this->load->view("/partials/footer"); ?>