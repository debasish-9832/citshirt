<?php $lang = getLanguages(); ?>
<div class="profile">
	<h2><?php echo language('user_order_history', $lang);?></h2>
	<hr/>
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_list_orders', $lang);?></h5>
				</div>
				
				<div class="panel-body">
					<?php
					$attribute = array('class' => 'form-orders', 'id' => 'form-orders');		
					echo form_open(site_url('user/orderhistory'), $attribute);
					?>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4 col-xs-5">
								<?php 
									$search = array('name' => 'search', 'id' => 'search', 'class' => 'form-control datepicker', 'placeholder' => language('search_btn', $lang), 'autocomplete'=>'off', 'value'=>$this->session->userdata('search_order'));
									echo form_input($search);
								?>
							</div>
							<div class="col-sm-4 col-xs-5">
								<?php 
									$option_s = array('order_number' => language('user_order_number', $lang), 'date' => language('date', $lang));
									echo form_dropdown('option', $option_s, $this->session->userdata('option_order'), 'class="form-control" id="option_s"'); 
								?>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-primary"><?php echo language('search_btn', $lang);?></button>
							</div>
						</div>
					</div>
					
					<table id="sample-table-1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="center"><?php echo language('user_order_number', $lang); ?></th>
								<th class="center"><?php echo language('status', $lang); ?></th>
								<th class="center"><?php echo language('date', $lang); ?></th>
								<th class="center"><?php echo language('total', $lang); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($orders)) { ?>
							<?php $setting = getSettings(); ?>
							<?php foreach($orders as $order) { ?>
							<tr>
								<td class="center">
									<a href="<?php echo site_url('user/orderdetail/'.$order->id); ?>"><?php echo $order->order_number; ?></a>
								</td>
								<td class="center"><?php echo language($order->status, $lang); ?></td>
								<td class="center"><?php echo date("Y-m-d", strtotime($order->created_on)); ?></td>
								<td class="center"><?php echo settingValue($setting, 'currency_symbol', '$'); ?><?php echo number_format($order->total, 2); ?></td>
							</tr>
							<?php } ?>
							
						<?php } ?>
						</tbody>
					</table>
					<div class="pull-right">
						<?php echo $links; ?>
					</div>
					
					<?php //echo form_close(); ?> 
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
	
	if(jQuery('#option_s').val() == 'date')
	{
		jQuery('.datepicker').datepicker({
			setDate: '2015-02-07',
			dateFormat: 'yy-mm-dd'
		});		
	}
		
	jQuery('#option_s').change(function(){
		var check = jQuery(this).val();
		if(check == 'date')
		{
			jQuery('.datepicker').datepicker();
			jQuery('.datepicker').datepicker("option", "dateFormat", "yy-mm-dd");
		}else
		{
			jQuery('.datepicker').datepicker('destroy');
		}
	});
</script>