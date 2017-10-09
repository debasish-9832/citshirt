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
<script src="<?php echo site_url();?>assets/plugins/validate/validate.js"></script>	
<?php 
	if($this->session->flashdata('error') != '')
		echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
	elseif($this->session->flashdata('msg') != '')
		echo '<div class="alert alert-success">'.$this->session->flashdata('msg').'</div>';
?>
<div class="col-sm-12">
	<form id="fr-forgot" class="form-horizontal" method="POST" action="<?php echo site_url().'users/forgotpassword';?>">
		<h2><?php echo language('user_forgot_password', $lang);?></h2>
		<span class="help-block"><?php echo language('user_forgot_password_help', $lang);?></span>
		<div class="form-group">
			<label class="col-sm-2"><?php echo language('user_your_email', $lang);?></label>
			<div class="col-sm-6">
				<input class="form-control validate required" type="text" data-msg="<?php echo language('user_email_validate_msg', $lang);?>" data-type="email" placeholder="<?php echo language('user_enter_email', $lang);?>" name="data[email]" value="<?php echo set_value('data[email]', '');?>"/>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2"></label>
			<div class="col-sm-6">
				<button class="btn btn-primary" type="submit"><?php echo language('send_btn', $lang);?></button>
				<a href="<?php echo site_url().'user/login';?>"><?php echo language('register_btn', $lang);?></a>
			</div>
		</div>
		<?php echo $this->auth->getToken(); ?>
	</form>
</div>

<script type="text/javascript">
	jQuery('#fr-forgot').validate();
</script>