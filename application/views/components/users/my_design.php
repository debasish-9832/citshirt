<?php $lang = getLanguages(); ?>
<div class="profile">
	<h2><?php echo language('user_manage_design', $lang);?></h2>
	<hr/>
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_manage_design', $lang);?></h4>
				</div>
				<div class="panel-body">
					<!--
					<form action="<?php echo site_url('user/userdesign/default'); ?>" method="POST">
						<div class="row form-group">
							<div class="col-md-3">
								<input type="text" class="form-control" name="search" placeholder="<?php echo language('search_btn', $lang); ?>" value="<?php echo $this->session->userdata('search_design');?>" style="margin-left: 4px;"/>
							</div>
							
							<div class="col-md-2">
								<button class="btn btn-primary" type="submit"><?php echo language('search_btn', $lang); ?></button>
							</div>
						</div>
					</form>
					-->
					<?php if (count ($designs) == 0) { ?>
						<strong><?php echo language('data_not_found', $lang); ?></strong>
					<?php }else{ ?>
					
						<?php foreach($designs as $design) { ?>
						<div class="col-md-3 design-box">
							<a href="<?php echo site_url('design/index/'.$design->product_id .'/'. $design->product_options .'/'. $design->design_id); ?>">
								<img src="<?php echo base_url($design->image); ?>" class="img-responsive img-thumbnail" alt="">
							</a>
							<span class="design-action design-action-remove" onclick="removeDesign(this, '<?php echo $design->id; ?>')">
								<i class="red glyphicons remove_2"></i>
							</span>
						</div>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="pull-right"><?php echo $links; ?></div>
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
	function removeDesign(e, id)
	{
		var cf = confirm('<?php echo language('confirm_delete', $lang); ?>');
		if(cf)
		{
			jQuery.ajax({
				type: "POST",
				url: '<?php echo site_url('user/removedesign');?>/'+ id,
				dataType: 'html',
				data: {design_id : id},
				success: function(data){
					jQuery(e).parent('div').remove();
				}
			});
		}
	}
</script>