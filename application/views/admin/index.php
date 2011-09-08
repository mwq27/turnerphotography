<? $this->load->view("/partials/header.html"); ?>
	
		
	
	<section id="admin-new-images">
		<?
			foreach($categories as $key => $val){
				echo "<a href='/admin/new_image/".$key."' >Add new ".$val["category"]." images";
			}
		?>
		<a href="/admin/new_client/">Add Client</a>
		
	</section>
	
	<section id="enable-cats">
		<h1>Available Categories</h1>
		<?
			foreach($categories as $key => $val){
				($val["active"] == 1) ? $act = "class='active'": $act = "";
				($val["active"] == 0) ? $inact = "class='inactive'": $inact = "";
				echo "<p><span class='cat-line'>".$val['category']. "</span><small id='enab' ".$act." >Enabled</small> / <small id='disab' ".$inact.">Disabled</small></p>";
			}
		?>
		
		
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