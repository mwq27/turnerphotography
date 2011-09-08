<div class="hidden" id="msg-success">Message received</div>
<nav class="side-ul">
				<ul>
					<!--<li><a href="/c/Beauty">Beauty</a></li>-->
					<!--<li><a href="/c/Fashion">Fashion</a></li>-->
					<!--<li><a href="/c/Editorial">Editorial</a></li>-->
					<!-- #141414 -->
					
					<li><a href="/c/Men" class="<? echo ($this->uri->segment(2) == "Men")? "current": "" ;?>">Men</a></li>
					<li><a href="/c/Women" class="<? echo ($this->uri->segment(2) == "Women")? "current": "" ;?>">Women</a></li>
					<li><a href="/c/Personal" class="<? echo ($this->uri->segment(2) == "Personal")? "current": "" ;?>">Personal</a></li>
					<li>About Me</li>
					<li><a href="javascript:void(0)" rel="#cform" id="contactlink">Contact</a></li>
				</ul>
			</nav>
			
<div class="simple_overlay" id="cform">
		<? 
			$atts = array("id"=> "contactform");
			echo form_open("/content/contact", $atts);
		?>
	<h2>Get in touch with me</h2>
							<fieldset>
								<label for="name">Name</label>
								<input type="text" name="name" class="text" id="name"  placeholder="Your name" />
								<div id="name-error" class="hidden cfl">Please enter your name</div>
	
								<label for="email">E-mail</label>
								<input type="text" name="email" class="text" id="email"  placeholder="and e-email"  />
								<div id="email-error" class="hidden cfl">Please enter your email address</div>
	
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
								<div id="comments-error" class="hidden cfl">Please enter a few comments</div>
	
								<div id="error"></div>
								<input type="button" class="button submit" name="submit" id="csub" value="Send" />
							</fieldset>
	</form>
</div>
