	<? $this->load->view("/partials/header"); ?>
	<section id="reg-section">
	<h2>Admin Registration</h2>
	
	<? echo form_open('admin/register'); ?>
		
			<p class="input">
				<label for="email">Email</label>
				<input type="text" name="email" value="<? echo set_value('email'); ?>"  id="email" class="user-input required text"/>
				<label  id="fname-error"  class="error">Please enter your first name</label>
			</p>
			<div class="clear"></div>
			<p class= "input">
				<label for="password">Password</label>
				<input type="password" name="password"  id="password" class="user-input required text"/>
				<label id="fname-error" class="error">Please enter your first name</label>
			</p>
				<div class="clear"></div>
			
		
			<p class="input">
				
				<input type="submit" value="Submit Information" class="button submit" id="profile-submit">
			</p>
	</form>
</section>
<? $this->load->view("/partials/footer"); ?>