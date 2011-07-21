<? $this->load->view("/partials/header"); ?>
<section id="login-section">
	<h2>New Client</h2>
	<? echo form_open('admin/new_client'); ?>
				<?php echo form_error('email-log', '<p class="error">', '</p>'); ?>
				<?php echo form_error('password-log', '<p class="error">', '</p>'); ?>
				<? if(isset($login_error)){ echo $login_error; } ?>
				<p class="input">
					<label for="cname">Client Name</label>
					<input type="text" name="cname"  id="cname" class="user-input required text"/>
					<label id="cname-error" class="error">Please enter an email</label>
				</p>
				
					<div class="clear"></div>
				<p class="input">
					<input type="submit" value="Submit Information" class="button submit" id="profile-submit">
				</p>
	</form>
</section>

<? $this->load->view("/partials/footer"); ?>