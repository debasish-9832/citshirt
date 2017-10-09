<?php $lang = getLanguages(); ?>
<div class="profile">
	<h2><?php echo language('my_account', $lang);?></h2>
	<hr/>
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_account_manager', $lang);?></h4>
				</div>
				<div class="panel-body">
					<div class="manager-item">
						<i class="fa fa-user fa-2x pull-left"></i>
						<a href="<?php echo site_url('user/accountdetails'); ?>"><?php echo language('user_account_detail', $lang);?></a>
						<p><?php echo language('user_account_detail_help', $lang);?></p>
					</div>
					
					<div class="manager-item">
						<i class="fa fa-key fa-2x pull-left"></i>
						<a href="<?php echo site_url('user/changepass'); ?>"><?php echo language('user_change_password', $lang);?></a>
						<p><?php echo language('user_change_password_help', $lang);?></p>
					</div>
					
					<div class="manager-item">
						<i class="fa fa-book fa-2x pull-left"></i>
						<a href="<?php echo site_url('user/orderhistory'); ?>"><?php echo language('user_order_history', $lang);?></a>
						<p><?php echo language('user_order_history_help', $lang);?></p>
					</div>
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