<? $this->load->view("/partials/header"); ?>
<section id="login-section">
	<h2>Admin Login</h2>
	<? echo form_open('/admin/login'); ?>
				<?php echo form_error('email-log', '<p class="error">', '</p>'); ?>
				<?php echo form_error('password-log', '<p class="error">', '</p>'); ?>
				<? if(isset($login_error)){ echo $login_error; } ?>
				<p class="input">
					<label for="email-log">Email</label>
					<input type="text" name="email-log"  id="email-log" class="user-input required text"/>
					<label id="fname-error" class="error">Please enter an email</label>
				</p>
				<div class="clear"></div>
				<p class="input">
					<label for="password-log">Password</label>
					<input type="password" name="password-log"  id="password-log" class="user-input required text"/>
					<label id="fname-error" class="error">Please enter your first name</label>
				</p>
					<div class="clear"></div>
				<p class="input">
					<input type="submit" value="Submit Information" class="button submit" id="profile-submit">
				</p>
	</form>
</section>

<? $this->load->view("/partials/footer"); ?>