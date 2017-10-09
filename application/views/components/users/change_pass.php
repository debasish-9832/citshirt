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
<div class="profile">
	<h2><?php echo language('user_change_password', $lang);?></h2>
	<hr/>
	<div class="row">
		<div class="col-md-9">
			<?php if($this->session->flashdata('error') != ''){  ?>
				<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
			<?php }  ?>
			<?php if($this->session->flashdata('msg') != ''){  ?>
				<div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
			<?php }  ?>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_change_password', $lang);?></h4>
				</div>
				
				<div class="panel-body">
					<form id="fr-change-pass" class="form-horizontal" method="POST" action="<?php echo site_url().'users/changepass';?>">
						<?php if(isset($this->user['id']) && $this->user['id'] != ''){?>
							<div class="form-group">
								<label class="col-md-3"><?php echo language('user_old_password', $lang);?></label>
								<div class="col-md-6">
									<input class="form-control validate required" type="password" data-msg="<?php echo language('user_old_password_validate_msg', $lang);?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_old_password', $lang);?>" name="data[old_password]">
								</div>
							</div>
						<?php } ?>
						
						<div class="form-group">
							<label class="col-md-3"><?php echo language('user_new_password', $lang);?></label>
							<div class="col-md-6">
								<input class="form-control validate required" type="password" data-msg="<?php echo language('user_new_password_validate_msg', $lang);?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_new_password', $lang);?>" name="data[password]">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3"><?php echo language('user_confirm_new_password', $lang);?></label>
							<div class="col-md-6">
								<input class="form-control validate required" type="password" data-msg="<?php echo language('user_confirm_new_password_validate_msg', $lang);?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_confirm_new_password', $lang);?>" name="cf_password">
							</div>
						</div>
						<input type="hidden" value="<?php echo $key;?>" name="key">
						<?php echo $this->auth->getToken(); ?>
						<div class="form-group">
							<label class="col-md-3"></label>
							<div class="col-md-6">
								<a href="<?php echo site_url('user/login'); ?>" class="btn btn-danger" ><?php echo language('cancel_btn', $lang); ?></a>
								<button class="btn btn-primary" type="submit"><?php echo language('save_btn', $lang);?></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_your_account', $lang);?></h4>
				</div>
				
				<div class="panel-body">
					<ul class="nav nav-list list-manager">
						<li <?php if(uri_string() == 'user/myaccount') echo 'class="active"';?>><a href="<?php echo site_url('user/myaccount'); ?>"><?php echo language('my_account', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/accountdetails') echo 'class="active"';?>><a href="<?php echo site_url('user/accountdetails'); ?>"><?php echo language('user_account_detail', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/changepass') echo 'class="active"';?>><a href="<?php echo site_url('user/changepass'); ?>"><?php echo language('user_change_password', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/orderhistory' || strpos(uri_string(), '/orderdetail')) echo 'class="active"';?>><a href="<?php echo site_url('user/orderhistory'); ?>"><?php echo language('user_order_history', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/userdesign/default') echo 'class="active"';?>><a href="<?php echo site_url('user/userdesign/default'); ?>"><?php echo language('user_manage_design', $lang);?></a></li>
						<li><a href="<?php echo site_url('users/logout'); ?>"><?php echo language('logout', $lang);?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery('#fr-change-pass').validate();
</script>