<? $this->load->view("/partials/header"); ?>
	
		<h1>Marcus Turner Photography</h1>
	
		<div id="leftside" >
			<? $this->load->view("/partials/leftnav"); ?>
			
		</div>
		
		
	
	
	<div class="container">
		
		
<? 
		$atts = array("id"=> "contactform");
		echo form_open("/content/contact", $atts);
?>
<h2>Get in touch with me</h2>
						<fieldset>
							<label for="name">Name</label>
							<input type="text" name="name" class="text" id="name"  placeholder="Your name" />

							<label for="email">E-mail</label>
							<input type="text" name="email" class="text" id="email"  placeholder="and e-email"  />

							<label for="subject">Type of request</label>

							<select name="request" id="request">
							  <option value="General">General</option>
							  <option value="Inquiry">Inquiry</option>
							  <option value="Pricing">Pricing</option>
							  <option value="Booking">Booking</option>
							  <option value="Other">Other</option>
						    </select>
			    
							<label for="comments">Comments</label>
							<textarea name="comments" id="comments" cols="30" rows="10"></textarea>

							<div id="error"></div>
							<input type="submit" class="button submit" name="submit" id="submit" value="Send" />
						</fieldset>
</form>

</div>			
<div id="rightside" >
			<? $this->load->view("/partials/rightnav"); ?>
		</div>


<? $this->load->view("/partials/footer"); ?>