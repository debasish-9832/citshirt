<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang = getLanguages();
?>
<?php 
	if(isset($data['id']) && $data['id'] != 0)
	{
?>
	<div class="modal-header">
		<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
		<h4 id="myModalLabel" class="modal-title"><?php echo language('my_account', $lang); ?></h4>
	</div>
	<div class="modal-body">
		<?php if(isset($msg) && $msg != ''){  ?>
			<div class="alert alert-success" style="margin: 0px;"><?php echo $msg; ?></div>
		<?php }  ?>
		<?php if(isset($error) && $error != ''){  ?>
			<div class="alert alert-danger" style="margin: 0px;"><?php echo $error; ?></div>
		<?php }  ?>
		<div class="row">
			<div class="col-sm-6">
				<ul class="login_info">
					<?php foreach($data as $key=>$val) {
						if($key == 'name')
						{
							echo '<li><strong>'.language('hi', $lang).',</strong> '.$val.'</li>';
						}elseif($key == 'username')
						{
							echo '<li><strong>'.language('user_username', $lang).':</strong> '.$val.'</li>';
						}elseif($key == 'email')
						{
							echo '<li><strong>'.language('user_email', $lang).':</strong> '.$val.'</li>';
						}elseif($key == 'admin' && $val != 0)
						{
							echo '<li><strong>'.language('admin', $lang).'</strong></li>';
						}elseif($key == 'id')
						{
							echo '<li><input type="hidden" id="user-id" value="'.$val.'"></li>';
						}
					} ?>
				</ul>
			</div>
			
			<div class="col-sm-6">
				<h4><?php language('user_change_password', $lang); ?></h4>
				<form id="fr-change-pass" style="margin-bottom: 5px;" role="form">
					<div class="form-group" style="display: table; width: 100%;">
						<label><?php echo language('user_new_password', $lang); ?></label>
						<input id="change-password" class="form-control input-sm validate required" type="password" placeholder="<?php echo language('user_new_password', $lang); ?>" data-minlength="6" data-maxlength="128" data-msg="<?php echo language('user_new_password_validate_msg', $lang); ?>" name="data[password]">
					</div>
					
					<div class="form-group" style="display: table; width: 100%;">
						<label><?php echo language('user_confirm_new_password', $lang); ?></label>
						<input id="change-cfpassword" class="form-control input-sm validate required" type="password" placeholder="<?php echo language('user_confirm_new_password', $lang); ?>" data-minlength="6" data-maxlength="128" data-msg="<?php echo language('user_confirm_new_password_validate_msg', $lang); ?>" name="cf_password">
					</div>
					<div class="form-group" style="display: table; width: 100%;">
						<button id="change-button" onclick="login('change_pass')" class="btn btn-default btn-primary" data-loading-text="<?php echo language('loading_btn', $lang); ?>" type="button"><?php echo language('save_btn', $lang); ?></button>
					</div>
					<?php echo $this->auth->getToken(); ?>
					<input class="ajax" type="hidden" name="ajax" value="1">
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		if(typeof login_url_post !== "undefined")
		{
			jQuery.ajax({
				type: "POST",
				url: login_url_post,
				data: "",
				dataType: "html",
				success: function(update) {
					jQuery('.module-login').html(update);
				}
			});
		}
	</script>
<?php }else{ ?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel"><?php echo language('user_login_now_or_sign_up', $lang); ?></h4>
	</div>

	<div class="modal-body">
		<?php if(isset($error)){  ?>
			<div class="alert alert-danger" style="margin: 0px;"><?php echo $error; ?></div>
		<?php }  ?>

		<div class="row">
			<!-- login form -->
			<div class="col-md-6">
				<h3><?php echo language('user_login', $lang); ?></h3>
				<form id="fr-login" role="form" style="margin-bottom: 5px;">						  						 
				  <div class="form-group">
					<label><?php echo language('user_your_email', $lang); ?>:</label>
					<input type="text" name="data[email]" id="login-email" class="form-control input-sm validate required" data-msg="<?php echo language('user_email_validate_msg', $lang); ?>" data-type="email" placeholder="<?php echo language('user_enter_email', $lang); ?>" value="<?php if(isset($data['email'])) echo $data['email'];?>">
				  </div>
				  <div class="form-group">
					<label><?php echo language('user_your_password', $lang); ?>:</label>
					<input type="password" name="data[password]" id="login-password" class="form-control input-sm validate required" data-msg="<?php echo language('user_password_validate_msg', $lang); ?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_your_password', $lang); ?>">
				  </div>
				  <a href="javascript:void(0)" title="" class="btn btn-default btn-primary" onclick="facebook_login()">
					<span class="login-facebook"></span>
					<?php echo language('user_login_with_facebook', $lang); ?>
				  </a>
				  <button type="button" onclick="login(this)" autocomplete="off" class="btn btn-default btn-warning" data-loading-text="<?php echo language('loading_btn', $lang); ?>"><?php echo language('login_btn', $lang); ?></button> 
				  <?php echo $this->auth->getToken(); ?>
				  <input type="hidden" name="ajax" value="1">
				</form>
				
				<a id="click_forgot" href="javascript:void(0)"><?php echo language('user_i_forgot_password', $lang); ?></a>
			</div>
			
			<!-- create account -->
			<div class="col-md-6">
				<h3><?php echo language('user_create_account', $lang); ?></h3>
				<form id="fr-register" role="form">						 
				  <div class="form-group">
					<label><?php echo language('user_username', $lang); ?>:</label>
					<input type="text" name="data[username]" id="create_username" class="form-control input-sm validate required" data-msg="<?php echo language('user_username_validate_msg', $lang); ?>" data-maxlength="200" data-minlength="2" placeholder="<?php echo language('user_username', $lang); ?>" value="<?php if(isset($data['username'])) echo $data['username'];?>">
				  </div>
				  <div class="form-group">
					<label><?php echo language('user_email_address', $lang); ?>:</label>
					<input type="email" name="data[email]" class="form-control input-sm validate required" id="create_email" data-msg="<?php echo language('user_email_validate_msg', $lang); ?>" data-type="email" placeholder="<?php echo language('user_enter_email', $lang); ?>" value="<?php if(isset($data['email'])) echo $data['email'];?>">
				  </div>
				  <div class="form-group">
					<label><?php echo language('user_password', $lang); ?>:</label>
					<input type="password" class="form-control input-sm validate required" name="data[password]" id="create_password" data-msg="<?php echo language('user_password_validate_msg', $lang); ?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_password', $lang); ?>">
				  </div>						  						 
				  <button type="button" onclick="login('register')" autocomplete="off" data-loading-text="<?php echo language('loading_btn', $lang); ?>" class="btn btn-default btn-primary"><?php echo language('register_btn', $lang); ?></button>
					<?php echo $this->auth->getToken(); ?>
					<input type="hidden" name="ajax" value="1">
				</form>
			</div>
		</div>
	</div>
<?php } ?>
